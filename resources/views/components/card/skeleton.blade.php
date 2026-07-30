{{--
|--------------------------------------------------------------------------
| Card Skeleton Component
|--------------------------------------------------------------------------
|
| Estado de carregamento visual "Skeleton Screen" para cartões.
| • Animação "shimmer" ou "pulse" totalmente gerida via CSS externo (BEM).
| • Variedade natural nas linhas de texto através de classes de largura predefinidas (sem inline styles).
| • Acessibilidade WCAG completa (role="status", aria-busy="true", aria-label descritivo).
| • Modular e flexível: suporta header, media, corpo com linhas customizáveis e footer.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'lines' => 3,               // Número de linhas de texto placeholder no corpo
    'hasHeader' => true,        // Exibe o bloco de cabeçalho (ícone + título/subtítulo)
    'hasMedia' => false,        // Exibe bloco opcional para media/imagem placeholder
    'hasFooter' => false,       // Exibe o bloco de rodapé
    'tag' => 'div',             // Tag HTML semântica
    'label' => 'A carregar...', // Texto descritivo para leitores de ecrã
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['div', 'section', 'article'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Normalização do número de linhas
    $totalLines = max(0, (int) $lines);

    // Array de larguras predefinidas para dar efeito orgânico às linhas de texto (substitui o rand() inline)
    $lineClasses = [
        'ui-card-skeleton__line--w-100',
        'ui-card-skeleton__line--w-90',
        'ui-card-skeleton__line--w-85',
        'ui-card-skeleton__line--w-75',
        'ui-card-skeleton__line--w-60',
    ];
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-skeleton',
        'ui-card-skeleton--has-header' => $hasHeader,
        'ui-card-skeleton--has-media' => $hasMedia,
        'ui-card-skeleton--has-footer' => $hasFooter,
    ]) }}
    role="status"
    aria-busy="true"
    aria-label="{{ $label }}"
>
    {{-- Bloco de Cabeçalho Skeleton (Ícone + Títulos) --}}
    @if($hasHeader)
        <div class="ui-card-skeleton__header" aria-hidden="true">
            <div class="ui-card-skeleton__avatar"></div>
            <div class="ui-card-skeleton__heading">
                <div class="ui-card-skeleton__title"></div>
                <div class="ui-card-skeleton__subtitle"></div>
            </div>
        </div>
    @endif

    {{-- Bloco de Media Skeleton (Opcional) --}}
    @if($hasMedia)
        <div class="ui-card-skeleton__media" aria-hidden="true"></div>
    @endif

    {{-- Bloco do Corpo com Linhas de Texto Variadas --}}
    @if($totalLines > 0)
        <div class="ui-card-skeleton__body" aria-hidden="true">
            @for($i = 0; $i < $totalLines; $i++)
                @php
                    // Seleciona uma largura de forma determinística por ciclo para manter consistência no SSR
                    $widthClass = $lineClasses[$i % count($lineClasses)];
                @endphp
                <div class="ui-card-skeleton__line {{ $widthClass }}"></div>
            @endfor
        </div>
    @endif

    {{-- Bloco de Rodapé Skeleton --}}
    @if($hasFooter)
        <div class="ui-card-skeleton__footer" aria-hidden="true" role="presentation">
            <div class="ui-card-skeleton__button"></div>
            <div class="ui-card-skeleton__button ui-card-skeleton__button--alt"></div>
        </div>
    @endif
</{{ $validTag }}>
