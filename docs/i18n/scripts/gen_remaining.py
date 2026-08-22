#!/usr/bin/env python3
"""Generate translation files for remaining locales using en-GB as reference."""
import sys, os, re
sys.path.insert(0, '.')

# Read en-GB PHP files to get English values
en_gb_dir = '/home/nyapuma/Transferências/Projeto-Final-Cesae/lang/en-GB'
zh_cn_path = '/home/nyapuma/Transferências/Projeto-Final-Cesae/docs/i18n/scripts/translations_zh_CN.py'

# Read zh-CN keys
exec(open(zh_cn_path).read())
zh_keys = set(T.keys())

# Parse en-GB PHP files to get English values
en_values = {}
for fname in sorted(os.listdir(en_gb_dir)):
    if not fname.endswith('.php'):
        continue
    domain = fname.replace('.php', '')
    with open(os.path.join(en_gb_dir, fname), 'r') as f:
        content = f.read()
    # Extract key => value pairs
    for match in re.finditer(r"'([^']+)'\s*=>\s*'((?:[^'\\]|\\.)*)'", content):
        key = match.group(1)
        val = match.group(2)
        full_key = f"{domain}.{key}"
        en_values[full_key] = val

print(f"en-GB keys found: {len(en_values)}")
print(f"zh-CN keys: {len(zh_keys)}")

# Check overlap
overlap = zh_keys & set(en_values.keys())
print(f"Overlap: {len(overlap)}")

# Show some examples
for k in list(overlap)[:10]:
    print(f"  {k}: zh={T[k][:40]}... en={en_values[k][:40]}...")
