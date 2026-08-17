# -*- coding: utf-8 -*-
"""Parser for Laravel PHP lang files (array-based) + helpers.

Recreated 2026-08-14 after /tmp/opencode was wiped. Mirrors the behaviour of
the original php_lang_audit.py used during Fase 1/2:

- load_php_file(path) -> nested dict from a `<?php return [ ... ];` file.
- flatten(d) -> {'group.sub.key': value, ...} for leaf values.
- PHP single-quoted strings: only \\\\ and \\' are escapes (others kept verbatim).
- PHP double-quoted strings: standard escapes (\\", \\\\, \\n, \\t, \\r, \\$, ...).
"""

import re


def php_literal(raw, quote):
    """Decode a PHP string literal body `raw` that was enclosed in `quote` (' or \")."""
    if quote == "'":
        return raw.replace("\\'", "'").replace("\\\\", "\\")
    out = []
    i = 0
    n = len(raw)
    while i < n:
        c = raw[i]
        if c == "\\" and i + 1 < n:
            nxt = raw[i + 1]
            mapping = {
                "n": "\n",
                "t": "\t",
                "r": "\r",
                "v": "\v",
                "f": "\f",
                "e": "\x1b",
                "$": "$",
                '"': '"',
                "\\": "\\",
                "'": "'",
            }
            if nxt in mapping:
                out.append(mapping[nxt])
                i += 2
                continue
            # \xNN / \NNN octal / \u{...}
            m = re.match(r"x([0-9A-Fa-f]{1,2})", raw[i + 1:])
            if m:
                out.append(chr(int(m.group(1), 16)))
                i += 1 + len(m.group(0))
                continue
            m = re.match(r"[0-7]{1,3}", raw[i + 1:])
            if m:
                out.append(chr(int(m.group(0), 8)))
                i += 1 + len(m.group(0))
                continue
            m = re.match(r"u\{([0-9A-Fa-f]+)\}", raw[i + 1:])
            if m:
                out.append(chr(int(m.group(1), 16)))
                i += 1 + len(m.group(0))
                continue
            out.append(nxt)
            i += 2
            continue
        out.append(c)
        i += 1
    return "".join(out)


def _parse_value(text, pos):
    """Parse one PHP value starting at text[pos]; return (value, new_pos)."""
    n = len(text)
    while pos < n and text[pos] in " \t\r\n":
        pos += 1
    c = text[pos]
    if c in "'\"":
        quote = c
        i = pos + 1
        buf = []
        while i < n:
            ch = text[i]
            if ch == "\\" and quote == "'":
                buf.append(ch)
                buf.append(text[i + 1])
                i += 2
                continue
            if ch == "\\" and quote == '"':
                buf.append(ch)
                buf.append(text[i + 1])
                i += 2
                continue
            if ch == quote:
                val = php_literal("".join(buf), quote)
                return val, i + 1
            buf.append(ch)
            i += 1
        raise ValueError("unterminated string")
    if c == "[":
        return _parse_array(text, pos)
    m = re.match(r"-?\d+", text[pos:])
    if m:
        return int(m.group(0)), pos + len(m.group(0))
    m = re.match(r"null|true|false", text[pos:])
    if m:
        word = m.group(0)
        if word == "null":
            return None, pos + 4
        return word == "true", pos + len(word)
    raise ValueError("unexpected value at %r..." % text[pos:pos + 20])


def _parse_array(text, pos):
    """Parse `[ ... ]` starting at text[pos] (which is '[')."""
    n = len(text)
    result = {}
    order = []
    i = pos + 1
    while i < n:
        while i < n and text[i] in " \t\r\n,":
            i += 1
        if i >= n:
            break
        if text[i] == "]":
            return result, i + 1
        if text[i] == "/" and text[i + 1:i + 2] in ("/", "*"):
            # comment
            if text[i + 1] == "/":
                j = text.find("\n", i)
            else:
                j = text.find("*/", i)
                if j == -1:
                    j = n
                j += 2
            i = j
            continue
        key, i = _parse_value(text, i)
        while i < n and text[i] in " \t\r\n":
            i += 1
        if text[i] == "=" and text[i + 1] == ">":
            i += 2
        val, i = _parse_value(text, i)
        if isinstance(key, str) or isinstance(key, int):
            result[key] = val
            order.append(key)
    return result, i


def load_php_file(path):
    with open(path, encoding="utf-8") as f:
        text = f.read()
    m = re.search(r"return\s*(\[)", text, re.S)
    if not m:
        return {}
    arr, _ = _parse_array(text, m.start(1))
    return arr


def flatten(d, prefix=""):
    out = {}
    for k, v in d.items():
        if isinstance(v, dict):
            out.update(flatten(v, prefix + str(k) + "."))
        else:
            out[prefix + str(k)] = v
    return out
