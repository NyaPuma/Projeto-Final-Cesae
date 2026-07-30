{{--
|-------------------------------------------------------------------------- |
Back Link Component (Otimizado)
|-------------------------------------------------------------------------- |
| Componente especializado para navegação de retorno (Voltar).
| • Padronizado com o Design System.
| • Suporta ícones nativos ou personalizados via slot/prop.
| • 100% livre de CSS ou JS inline.
| --}}
@props([
    'href',
    'label' => null,
    'compact' => false,
    'icon' => null,
])

@php
    // Ícone SVG padrão de seta para a esquerda otimizado
    $defaultBackIcon = '<svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg>';

    $resolvedIcon = $icon ?? $defaultBackIcon;
@endphp

<x-ui.page-actions.base-link
    :href="$href"
    variant="secondary"
    :size="$compact ? 'compact' : 'sm'"
    weight="semibold"
    :icon="$resolvedIcon"
    icon-class="text-[var(--text-soft)]"
    {{ $attributes }}
>
    {{ $label ?? $slot }}
</x-ui.page-actions.base-link>
