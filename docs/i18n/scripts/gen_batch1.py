#!/usr/bin/env python3
"""Generate az-AZ, be-BY, bs-BA, ca-AD, cnr-ME, et-EE, hr-HR, is-IS, ka-GE, lt-LT, lv-LV."""
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

def gen_locale(code, trans_dict):
    T_out = {}
    for key in zh_T.keys():
        en_val = en_values.get(key, zh_T[key])
        T_out[key] = trans_dict.get(en_val, trans_dict.get(zh_T[key], en_val))
    out_path = os.path.join(SCRIPT_DIR, f'translations_{code.replace("-","_")}.py')
    with open(out_path, 'w', encoding='utf-8') as f:
        f.write('T = {\n')
        items = list(T_out.items())
        for i, (k, v) in enumerate(items):
            f.write(f"    {repr(k)}: {repr(v)}{',' if i < len(items)-1 else ''}\n")
        f.write('}\n')
    return len(T_out)

# Common shared translations for European languages
COMMON = {
    'Average Resolution Time': None,  # locale-specific
    'Average Waiting Time': None,
    'Open Tickets': None,
    'Resolved Tickets': None,
    'min': None, 'h': None, 'd': None,
    'API': 'API', 'Web': 'Web', 'Mobile': 'Mobile', 'QR Code': 'QR Code', 'OK': 'OK',
    'MTTR': 'MTTR', 'SKU': 'SKU', 'SLA': 'SLA', 'NIF': 'NIF',
    'part_id': 'part_id', '\u2014': '\u2014', 'Y-m-d': 'Y-m-d',
    'Y-m-d H:i:s': 'Y-m-d H:i:s', 'd': 'd', 'h': 'h',
}
