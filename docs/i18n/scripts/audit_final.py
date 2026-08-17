import json, sys, os
sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))
from php_lang_audit import load_php_file, flatten

ROOT = os.path.abspath(os.path.join(os.path.dirname(os.path.abspath(__file__)), '..', '..', '..'))
LANG = os.path.join(ROOT, 'lang')
JSON_ARCHIVE = os.path.join(ROOT, 'docs', 'i18n', 'archive-json')
locales = sorted([d for d in os.listdir(LANG) if os.path.isdir(os.path.join(LANG, d))])

def locale_data(loc):
    json_path = os.path.join(LANG, loc + '.json')
    js = {}
    if os.path.exists(json_path):
        with open(json_path, encoding='utf-8') as f:
            js = json.load(f)
    else:
        archive = os.path.join(JSON_ARCHIVE, loc + '.json')
        if os.path.exists(archive):
            with open(archive, encoding='utf-8') as f:
                js = json.load(f)
    php_domains = {}
    dpath = os.path.join(LANG, loc)
    for fn in sorted(os.listdir(dpath)):
        if fn.endswith('.php'):
            full = os.path.join(dpath, fn)
            d = load_php_file(full)
            php_domains[fn[:-4]] = flatten(d)
    return js, php_domains

def paths(loc):
    js, php = locale_data(loc)
    json_paths = set(js.keys())
    php_paths = set()
    for dom, flat in php.items():
        for k, v in flat.items():
            php_paths.add(dom + '.' + k)
    return js, php, json_paths, php_paths

# ---- Reference: en-US (canonical; identical key set to en-GB)
ref_js, ref_php, ref_json_paths, ref_php_paths = paths('en-US')
ref_all = ref_json_paths | ref_php_paths
print('=== REFERENCE en-US ===')
print('JSON paths:', len(ref_json_paths))
print('PHP paths:', len(ref_php_paths))
print('UNION canonical paths:', len(ref_all))
print('JSON-only paths (lacuna estrutural da fonte):', len(ref_json_paths - ref_php_paths))
print('PHP-only paths (chaves estruturais):', len(ref_php_paths - ref_json_paths))
print()

rows = []
for loc in locales:
    js, php, jp, pp = paths(loc)
    missing = ref_all - (jp | pp)
    extra = (jp | pp) - ref_all
    present = (jp | pp) & ref_all
    json_empty = [k for k in jp & ref_json_paths if not isinstance(js[k], str) or js[k].strip()=='']
    json_identity = [k for k in jp & ref_json_paths if isinstance(js[k], str) and js[k]==k]
    php_empty = []
    php_identity = []
    for dom, flat in php.items():
        for k, v in flat.items():
            path = dom+'.'+k
            if path in ref_php_paths:
                if v=='' or (isinstance(v,str) and v.strip()==''):
                    php_empty.append(path)
                elif v==k:
                    php_identity.append(path)
    n_present = len(present)
    n_total = len(ref_all)
    pct = round(100.0*n_present/n_total, 1)
    has_json = os.path.exists(os.path.join(LANG, loc+'.json'))
    has_php = len(php)>0
    rows.append((loc, len(jp), len(pp), n_present, n_total, pct,
                 len(missing), len(extra), len(json_empty), len(json_identity), len(php_empty), len(php_identity),
                 has_json, has_php, len(js), len(php)))

print(f"{'LOCALE':8} {'JSON':>4} {'PHPuniq':>7} {'PHPleaves':>9} {'present':>7} {'total':>5} {'%':>6} {'miss':>4} {'extra':>5} {'jEmpty':>6} {'jIdent':>6} {'pEmpty':>6} {'pIdent':>6}")
for r in rows:
    loc, jp, pp, pres, tot, pct, miss, extra, je, ji, pe, pi, hj, hp, jn, pn = r
    print(f'{loc:8} {jp:4d} {pp:7d} {jn+pn:9d} {pres:7d} {tot:5d} {pct:6.1f} {miss:4d} {extra:5d} {je:6d} {ji:6d} {pe:6d} {pi:6d}')
print()
OUT_DIR = os.path.join(ROOT, 'docs', 'i18n', 'review')
os.makedirs(OUT_DIR, exist_ok=True)
json.dump([{'locale':r[0],'json_keys':r[14],'php_leaves':r[15],'json_paths':r[1],'php_paths':r[2],
            'present':r[3],'total':r[4],'pct':r[5],'missing':r[6],'extra':r[7],
            'json_empty':r[8],'json_identity':r[9],'php_empty':r[10],'php_identity':r[11],
            'has_json':r[12],'has_php':r[13]} for r in rows], open(os.path.join(OUT_DIR, 'audit_summary.json'),'w'), ensure_ascii=False, indent=1)
print('saved', os.path.join(OUT_DIR, 'audit_summary.json'))
