@props([
    'id',
    'name',
    'rows' => 4,
    'placeholder' => null,
    'required' => false,
    'resize' => 'none',
])

<textarea
    {{ $attributes->merge(array_filter([
        'id' => $id,
        'name' => $name,
        'rows' => $rows,
        'placeholder' => $placeholder,
        'required' => $required ? true : null,
        'class' => 'w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none focus:border-primary focus:ring-4 focus:ring-primary/15' . ($resize === 'none' ? ' resize-none' : ''),
    ], static fn ($value) => !is_null($value))) }}
></textarea>
