import sys, os
sys.path.insert(0, '.')
from he_part1 import T as p1
from he_part2 import T as p2
from he_part3 import T as p3
from translations_zh_CN import T as cn
merged = {}
merged.update(p1)
merged.update(p2)
merged.update(p3)
miss = set(cn) - set(merged)
extra = set(merged) - set(cn)
print(f'Missing: {len(miss)}, Extra: {len(extra)}')
if miss:
    print(f'Missing keys: {sorted(miss)}')
if extra:
    print(f'Extra keys: {sorted(extra)}')
lines = ['# Hebrew (he-IL) translations for SGM platform', '# Generated for he-IL locale (2026-08-16)', 'T = {']
for k in sorted(merged.keys()):
    v = str(merged[k])
    v = v.replace(chr(92)+'n', '\\\\n')
    v = v.replace("'", "\\\\'")
    lines.append(f"    '{k}': '{v}',")
lines.append('}')
with open('translations_he_IL.py', 'w', encoding='utf-8') as f:
    f.write('\n'.join(lines))
print(f'Total keys written: {len(merged)}')
