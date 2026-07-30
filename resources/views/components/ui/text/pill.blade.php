{{--
|-------------------------------------------------------------------------- |
Pill / Badge Component (Otimizado)
|-------------------------------------------------------------------------- |
| Componente para exibição de rótulos, badges e estados em formato pílula.
| • Cores padronizadas via Tailwind e variáveis CSS do tema.
| • 100% livre de CSS ou JS inline.
| --}}
@props([
    'tone' => 'neutral',
    'size' => 'sm',
])

@php
    $toneClasses = match ($tone) {
        'primary' => 'border-primary/20 bg-primary/10 text-primary',
        'success' => 'border-emerald-500/20 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
        'warning' => 'border-amber-500/20 bg-amber-500/10 text-amber-600 dark:text-amber-400',
        'danger' => 'border-red-500/20 bg-red-500/10 text-red-600 dark:text-red-400',
        'neutral', default => 'border-[var(--border)] bg-[var(--surface-2)] text-[var(--text)]',
    };

    $sizeClasses = match ($size) {
        'xs' => 'px-3 py-1 text-[11px] tracking-[0.16em]',
        'sm' => 'px-3 py-1.5 text-xs tracking-[0.18em]',
        default => 'px-3 py-1.5 text-xs tracking-[0.18em]',
    };
@endphp

<span {{ $attributes->merge(['class' => trim('inline-flex w-fit items-center rounded-full border font-semibold uppercase ' . $sizeClasses . ' ' . $toneClasses)]) }}>
    {{ $slot }}
</span>
