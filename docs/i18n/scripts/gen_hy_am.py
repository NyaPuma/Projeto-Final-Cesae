#!/usr/bin/env python3
"""Generate Armenian (hy-AM) translations from zh-CN source."""
import sys, re, ast
sys.path.insert(0, '.')
from translations_zh_CN import T as cn

# Armenian translation map: key -> Armenian value
# Keys that are identical or technical terms stay the same
SKIP = {
    'API', 'CSV', 'Excel', 'ID', 'MTTR', 'NIF', 'OK', 'PDF', 'QR Code',
    'SKU', 'SLA', 'Swagger', 'Web', 'cURL', 'part_id', 'Round-robin',
    'Y-m-d', 'Y-m-d H:i:s', 'd', 'div', '—',
}

T = {}
for key, zh_val in cn.items():
    # For now, keep technical terms
    if zh_val in SKIP or re.match(r'^[A-Za-z0-9_\-\.]+$', zh_val):
        T[key] = zh_val
        continue
    # Placeholder for non-technical values
    T[key] = zh_val  # Will be replaced

# Print count
print(f'Generated {len(T)} keys (placeholder values)')
