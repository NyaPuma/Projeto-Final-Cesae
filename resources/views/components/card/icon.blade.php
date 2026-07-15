{{--
|--------------------------------------------------------------------------
| Card Icon Component (Otimizado)
|--------------------------------------------------------------------------
|
| Responsável por renderizar e estilizar ícones visuais em cards e dashboards.
| • Várias formas (círculo, arredondado, quadrado).
| • Estilos visuais contemporâneos (sólido, subtil com fundo pastel, contornado).
| • Suporte híbrido: aceita string de ícone direto na prop ou slot HTML livre.
|
--}}

@props([
    'icon' => null,             // Nome do ícone ou string SVG direta (opcional)
    'size' => 'md',             // 'xs', 'sm', 'md', 'lg', 'xl'
    'variant' => 'primary',     // 'primary', 'secondary', 'success', 'warning', 'danger', 'info', 'gray'
    'shape' => 'rounded',       // 'rounded', 'circle', 'square'
    'styling' => 'subtle',      // 'subtle' (fundo pastel), 'solid' (sólido), 'bordered' (apenas contorno), 'plain' (só ícone)
])

<div
    {{ $attributes->class([
        'ui-card-icon',
        "ui-card-icon--{$size}",
        "ui-card-icon--variant-{$variant}",
        "ui-card-icon--shape-{$shape}",
        "ui-card-icon--style-{$styling}",
    ])->merge([
        'aria-hidden' => 'true', // Oculta de leitores de ecrã por padrão (ícone decorativo)
    ]) }}
>
    @if($icon)
        {!! $icon !!}
    @else
        {{ $slot }}
    @endif
</div>
