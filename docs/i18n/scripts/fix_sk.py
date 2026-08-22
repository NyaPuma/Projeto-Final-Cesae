import sys, re
sys.path.insert(0, '.')
from translations_sk_SK import T as sk
from translations_zh_CN import T as cn

expected_key = [k for k in cn if '\n' in k][0]
print(f'Expected key: {repr(expected_key)}')

if expected_key not in sk:
    sk[expected_key] = 'Zoznam záznamov auditu systému.\nChránené globálne cez middleware a overené cez Policy.'
    print('Added multi-line key')
else:
    print('Key already present')

# Also verify escaped-quote variants
for k in cn:
    if '\\"' in k:
        if k not in sk:
            sk[k] = cn[k]
            print(f'Added escaped-quote key: {repr(k)}')

# Write updated file
with open('translations_sk_SK.py', 'w', encoding='utf-8') as f:
    f.write('T = {\n')
    items = list(sk.items())
    for i, (k, v) in enumerate(items):
        key_repr = repr(k)
        val_repr = repr(v)
        comma = ',' if i < len(items) - 1 else ''
        f.write(f'    {key_repr}: {val_repr}{comma}\n')
    f.write('}\n')

print(f'File written with {len(sk)} keys')
