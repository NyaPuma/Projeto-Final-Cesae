# -*- coding: utf-8 -*-
"""Gerador genérico de locales PHP.

Lê a estrutura de chaves de en-GB (canónico) e gera lang/{LOCALE}/*.php com as
traduções do dicionário em `translations_{LOCALE}.py` (módulo `T`).

Uso:
    python3 docs/i18n/scripts/build_locale.py ru-RU
    python3 docs/i18n/scripts/build_locale.py uk-UA

Dependências:
    - docs/i18n/scripts/translations_{LOCALE}.py  (módulo com dict `T`)
    - docs/i18n/scripts/php_lang_audit.py
"""
import os, sys

sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))
from php_lang_audit import load_php_file

ROOT = os.path.abspath(os.path.join(os.path.dirname(os.path.abspath(__file__)), '..', '..', '..'))
EN_DIR = os.path.join(ROOT, 'lang', 'en-GB')

def main():
    if len(sys.argv) != 2:
        print('uso: python3 build_locale.py <LOCALE>  (ex.: ru-RU, uk-UA, bg-BG)')
        sys.exit(2)
    locale = sys.argv[1]
    mod_name = 'translations_' + locale.replace('-', '_')
    try:
        mod = __import__(mod_name)
    except ImportError:
        print('ERRO: módulo %s não encontrado (cria o dicionário antes).' % mod_name)
        sys.exit(1)
    T = mod.T

    locale_dir = os.path.join(ROOT, 'lang', locale)

    missing = []
    for dom in sorted(os.listdir(EN_DIR)):
        if not dom.endswith('.php'):
            continue
        d = load_php_file(os.path.join(EN_DIR, dom))
        base = dom[:-4]
        def walk(dd, prefix=''):
            for k, v in dd.items():
                p = prefix + str(k)
                if isinstance(v, dict):
                    walk(v, p + '.')
                else:
                    key = base + '.' + p
                    if key not in T:
                        missing.append(key)
        walk(d)
    if missing:
        print('FALTAM %d traduções em %s:' % (len(missing), locale))
        for m in sorted(missing):
            print('  ', m)
        sys.exit(1)

    os.makedirs(locale_dir, exist_ok=True)
    for dom in sorted(os.listdir(EN_DIR)):
        if not dom.endswith('.php'):
            continue
        d = load_php_file(os.path.join(EN_DIR, dom))
        base = dom[:-4]
        out = ['<?php', '', 'return [']
        def emit(dd, prefix='', indent=0):
            pad = '    ' * (indent + 1)
            for k, v in dd.items():
                p = prefix + str(k)
                key_lit = "'" + k.replace("\\", "\\\\").replace("'", "\\'") + "'"
                if isinstance(v, dict):
                    out.append('%s%s => [' % (pad, key_lit))
                    emit(v, p + '.', indent + 1)
                    out.append('%s],' % pad)
                else:
                    val = T[base + '.' + p]
                    val_lit = "'" + val.replace("\\", "\\\\").replace("'", "\\'") + "'"
                    out.append('%s%s => %s,' % (pad, key_lit, val_lit))
        emit(d)
        out.append('];')
        out.append('')
        path = os.path.join(locale_dir, dom)
        with open(path, 'w', encoding='utf-8') as f:
            f.write('\n'.join(out))
        print('gerado', dom)

if __name__ == '__main__':
    main()
