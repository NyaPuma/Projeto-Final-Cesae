@props([
    'id' => 'msg',
    'hidden' => true,
    'class' => '',
])

<div
    id="{{ $id }}"
    aria-live="polite"
    class="{{ trim(($hidden ? 'hidden ' : '') . 'min-h-[48px] items-center justify-center rounded-2xl border border-(--border) bg-(--surface-2) px-4 text-sm font-medium text-[var(--text-soft)] ' . $class) }}"
></div>
