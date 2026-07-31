{{--
|--------------------------------------------------------------------------
| Card Actions Component (Otimizado)
|--------------------------------------------------------------------------
|
| Área dedicada para ações rápidas, botões e ícones dentro de um card.
| • Suporta posicionamento absoluto (flutuante sobre imagens/conteúdo).
| • Alinhamento baseado em Flexbox ('start', 'center', 'end', 'between').
| • Tags HTML dinâmicas para respeitar a semântica de cabeçalhos/rodapés.
|
--}}

@props([
    'position' => 'end',  // 'start', 'center', 'end', 'between'
    'gap' => 'sm',         // 'none', 'xs', 'sm', 'md', 'lg'
    'absolute' => false,   // Se true, fixa o grupo no canto superior direito do card
    'tag' => 'div',        // Permite mudar para 'header', 'footer' ou 'aside'
])

<{{ $tag }}
    {{ $attributes->class([
        'ui-card-actions',
        "ui-card-actions--{$position}",
        "ui-card-actions--gap-{$gap}",
        'ui-card-actions--absolute' => $absolute,
    ]) }}
>
    {{ $slot }}
</{{ $tag }}>
