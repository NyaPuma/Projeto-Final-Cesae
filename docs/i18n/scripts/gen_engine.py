#!/usr/bin/env python3
"""Word-level translator engine for generating locale files."""
import sys, os, re

SCRIPT_DIR = os.path.dirname(os.path.abspath(__file__))
sys.path.insert(0, SCRIPT_DIR)

en_gb_dir = os.path.join(SCRIPT_DIR, '..', '..', '..', 'lang', 'en-GB')
en_values = {}
for fname in sorted(os.listdir(en_gb_dir)):
    if not fname.endswith('.php'):
        continue
    domain = fname.replace('.php', '')
    with open(os.path.join(en_gb_dir, fname), 'r') as f:
        content = f.read()
    for match in re.finditer(r"'([^']+)'\s*=>\s*'((?:[^'\\]|\\.)*)'", content):
        en_values[f"{domain}.{match.group(1)}"] = match.group(2)

exec(open(os.path.join(SCRIPT_DIR, 'translations_zh_CN.py')).read())
zh_T = T.copy()


def gen_locale(code, word_dict, exact_dict=None):
    if exact_dict is None:
        exact_dict = {}
    sorted_words = sorted(word_dict.items(), key=lambda x: -len(x[0]))

    def translate_string(en_str):
        if en_str in exact_dict:
            return exact_dict[en_str]
        placeholders = {}
        def save_placeholder(m):
            key = f"__PH{len(placeholders)}__"
            placeholders[key] = m.group(0)
            return key
        s = re.sub(r':[a-zA-Z_]+', save_placeholder, en_str)
        s = re.sub(r'\{[^}]+\}\|[^}]+', save_placeholder, s)
        for eng, tgt in sorted_words:
            s = s.replace(eng, tgt)
        for key, val in placeholders.items():
            s = s.replace(key, val)
        return s

    T_out = {}
    for key in zh_T.keys():
        en_val = en_values.get(key, zh_T[key])
        T_out[key] = translate_string(en_val)

    out_path = os.path.join(SCRIPT_DIR, f'translations_{code.replace("-","_")}.py')
    with open(out_path, 'w', encoding='utf-8') as f:
        f.write('T = {\n')
        items = list(T_out.items())
        for i, (k, v) in enumerate(items):
            f.write(f"    {repr(k)}: {repr(v)}{',' if i < len(items)-1 else ''}\n")
        f.write('}\n')
    return len(T_out)
