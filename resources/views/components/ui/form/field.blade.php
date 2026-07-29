@props([
    'id' => null,
    'label',
    'required' => false,
])

<div>
    <label {{ $id ? 'for="' . e($id) . '"' : '' }} class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)">
        {{ $label }}@if($required) * @endif
    </label>

    {{ $slot }}
</div>
