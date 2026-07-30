{{--
|-------------------------------------------------------------------------- |
Priority Card Component
|-------------------------------------------------------------------------- |
| Componente de cartão para seleção de prioridades no formulário.
| • Suporte total a atributos externos e diretivas (wire:click, x-on, etc.).
| • Fallbacks seguros para prevenir erros caso variáveis opcionais falhem.
| • 100% livre de CSS ou JS inline.
| --}}
@props([
    'priority',
    'label',
    'title',
    'description',
    'active' => false,
    'dotClass' => 'bg-slate-500',
    'activeBorderClass' => 'border-[var(--primary)]',
    'hoverBorderClass' => 'hover:border-[var(--border-hover)]',
    // Compatibilidade retroativa com snake_case, caso já utilizes no projeto:
    'dot_class' => null,
    'active_border_class' => null,
    'hover_border_class' => null,
])

@php
    // Garante compatibilidade tanto com camelCase quanto com snake_case
    $dot = $dot_class ?? $dotClass;
    $activeBorder = $active_border_class ?? $activeBorderClass;
    $hoverBorder = $hover_border_class ?? $hoverBorderClass;
@endphp

<div
    data-priority="{{ $priority }}"
    {{ $attributes->class([
        'priority-card cursor-pointer rounded-2xl bg-[var(--surface-2)] p-4 transition-all',
        'border-2 shadow-sm' => $active,
        $activeBorder => $active,
        'border border-[var(--border)]' => ! $active,
        $hoverBorder => ! $active,
    ]) }}>

    <div class="mb-2 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span @class(['h-2.5 w-2.5 rounded-full', $dot])></span>
            <span class="text-xs font-bold text-[var(--text)]">{{ $label }}</span>
        </div>
        <span @class(['h-2 w-2 rounded-full', $active ? $dot : $dot . '/40'])></span>
    </div>

    <h4 class="mb-1 text-xs font-semibold text-[var(--text)]">{{ $title }}</h4>
    <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ $description }}</p>
</div>
