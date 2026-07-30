{{--
|-------------------------------------------------------------------------- |
| Form Field Wrapper Component (Otimizado)
|-------------------------------------------------------------------------- |
| Envolve campos de formulário gerindo rótulos, estados de obrigatoriedade
| e espaçamentos de forma totalmente acessível e semântica.
|--}}
@props([
    'id' => null,
    'label' => null,
    'required' => false,
])

<div {{ $attributes->merge(['class' => 'space-y-1.5']) }}>
    @if($label)
        <label
            {{ $id ? 'for="' . e($id) . '"' : '' }}
            class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]"
        >
            {{ $label }}

            @if($required)
                <span class="text-danger ml-0.5" aria-hidden="true">*</span>
                <span class="sr-only">({{ __('obrigatório') }})</span>
            @endif
        </label>
    @endif

    {{ $slot }}
</div>
