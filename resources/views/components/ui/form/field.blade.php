{{--
|-------------------------------------------------------------------------- |
| Form Field Wrapper Component (Optimized)
|-------------------------------------------------------------------------- |
| Wraps form fields managing labels, required states
| and spacing in a fully accessible and semantic way.
|--}}
@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'required' => false,
])

@php
    $fieldId = $id ?? ($name ? str_replace(['.', '[', ']'], ['-', '', ''], $name) : null);
@endphp

<div {{ $attributes->merge(['class' => 'space-y-1.5']) }}>
    @if($label)
        <label
            @if($fieldId) for="{{ $fieldId }}" @endif
            class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]"
        >
            {{ $label }}

            @if($required)
                <span class="text-danger ml-0.5" aria-hidden="true">*</span>
                <span class="sr-only">({{ __('validation.obrigatório') }})</span>
            @endif
        </label>
    @endif

    {{ $slot }}
</div>
