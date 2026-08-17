#!/usr/bin/env python3
import sys
import json
import os

root = os.path.abspath(os.path.join(os.path.dirname(__file__), '..'))
manifest_path = os.path.join(root, 'docs', 'refactor', 'manifest.json')
progress_path = os.path.join(root, 'docs', 'refactor', 'progress.md')

def mark_folder_done(folder_name):
    with open(manifest_path, 'r', encoding='utf-8') as f:
        manifest = json.load(f)

    if folder_name in manifest['folders']:
        manifest['folders'][folder_name]['status'] = 'done'
        manifest['folders'][folder_name]['readme_status'] = 'done'
        for fpath in manifest['folders'][folder_name]['files']:
            manifest['folders'][folder_name]['files'][fpath]['status'] = 'done'

    with open(manifest_path, 'w', encoding='utf-8') as f:
        json.dump(manifest, f, indent=2, ensure_ascii=False)

    with open(progress_path, 'r', encoding='utf-8') as f:
        lines = f.readlines()

    new_lines = []
    in_target = False
    for line in lines:
        if line.startswith(f'### `{folder_name}`'):
            in_target = True
            # replace PENDING (0/N) with DONE (N/N)
            count = len(manifest['folders'].get(folder_name, {}).get('files', {}))
            line = f'### `{folder_name}` ({count} files) — DONE ({count}/{count})\n'
        elif in_target and line.startswith('### `'):
            in_target = False
        
        if in_target:
            if line.startswith('- [ ] '):
                line = '- [x] ' + line[6:]
            elif line.strip() == '- Folder README: pending':
                line = '- Folder README: done\n'

        new_lines.append(line)

    with open(progress_path, 'w', encoding='utf-8') as f:
        f.writelines(new_lines)

    print(f'Folder {folder_name} marked as DONE in manifest and progress.')

if __name__ == '__main__':
    if len(sys.argv) > 1:
        mark_folder_done(sys.argv[1])
    else:
        print('Usage: update_refactor_progress.py <folder_name>')
