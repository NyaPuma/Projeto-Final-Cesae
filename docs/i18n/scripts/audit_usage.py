# -*- coding: utf-8 -*-
"""Auditoria de USO REAL — mede a cobertura dos caminhos acedidos pelo código.

O audit_final.py compara todos os locales contra o conjunto canónico histórico
(união JSON+PHP = 2853), que inclui 1355 caminhos flat do JSON antigo que já não
são acedidos pelo app (Frente C eliminou os .json; o código usa apenas
`__('dominio.chave')`). Isso penaliza locais novos como ru-RU, que não têm
arquivo JSON histórico.

Este script extrai os caminhos efetivamente usados no código (app/, resources/,
routes/) e verifica a cobertura em cada locale PHP. É a métrica funcional.

Uso: python3 docs/i18n/scripts/audit_usage.py
"""
import os, re, sys

ROOT = os.path.abspath(os.path.join(os.path.dirname(os.path.abspath(__file__)), '..', '..', '..'))
sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))
from php_lang_audit import load_php_file, flatten

SEARCH_DIRS = ['app', 'resources', 'routes']
LANG = os.path.join(ROOT, 'lang')

PATTERN = re.compile(r"__\(\s*'((?:[^'\\]|\\.)*)'")

def used_paths():
    paths = set()
    for root_dir in SEARCH_DIRS:
        base = os.path.join(ROOT, root_dir)
        if not os.path.isdir(base):
            continue
        for dirpath, _, filenames in os.walk(base):
            for fn in filenames:
                if not fn.endswith('.php'):
                    continue
                full = os.path.join(dirpath, fn)
                with open(full, encoding='utf-8') as f:
                    content = f.read()
                for m in PATTERN.finditer(content):
                    key = m.group(1)
                    if re.match(r'^[a-zA-Z0-9_]+\.[\s\S]+$', key) and not key.startswith('\\'):
                        paths.add(key)
    return paths

def php_paths(locale):
    out = set()
    dpath = os.path.join(LANG, locale)
    if not os.path.isdir(dpath):
        return out
    for fn in sorted(os.listdir(dpath)):
        if fn.endswith('.php'):
            for k in flatten(load_php_file(os.path.join(dpath, fn))):
                out.add(fn[:-4] + '.' + k)
    return out

def main():
    used = used_paths()
    print('Caminhos usados no código (__("dominio.chave")):', len(used))
    print()
    print(f"{'LOCALE':8} {'usados cobertos':>14} {'total usados':>12} {'%':>6} {'em falta':>8}")
    locales = sorted(d for d in os.listdir(LANG) if os.path.isdir(os.path.join(LANG, d)))
    for loc in locales:
        have = php_paths(loc)
        missing = sorted(used - have)
        covered = len(used - set(missing))
        pct = round(100.0 * covered / len(used), 1) if used else 100.0
        print(f'{loc:8} {covered:14d} {len(used):12d} {pct:6.1f} {len(missing):8d}')
        if loc == 'ru-RU' and missing:
            print('   em falta ru-RU:')
            for m in missing:
                print('    -', m)

if __name__ == '__main__':
    main()
