{{--
|--------------------------------------------------------------------------
| Card QR Code Component
|--------------------------------------------------------------------------
|
| Apresenta códigos QR vetoriais para ativos, links, bilhetes e validações.
| • Geração vetorial em SVG (otimizado sem CSS/JS inline).
| • Nível de correção de erros elevado ('H') para máxima durabilidade de leitura.
| • Resolução unificada de conteúdos e etiquetas (props ou slots nomeados).
| • Estrutura semântica <figure> e <figcaption> com acessibilidade A11y.
| • Suporte a ação de download nativa (data URI) ou delegação via data-attributes.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'value' => null,            // Dados/URL a codificar no QR Code
    'label' => null,            // Rótulo textual visível e explicativo
    'size' => 'md',             // 'sm', 'md', 'lg', 'xl'
    'download' => false,        // Ativa botão/link de transferência
    'downloadName' => 'qrcode', // Nome do ficheiro ao transferir
    'correction' => 'H',        // Correção de erros: 'L', 'M', 'Q', 'H'
    'tag' => 'figure',          // Tag HTML semântica
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['figure', 'div', 'section'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'figure';

    // Mapeamento de dimensões para a geração do SVG do QR Code
    $sizeMap = [
        'xs' => 64,
        'sm' => 96,
        'md' => 144,
        'lg' => 192,
        'xl' => 256,
    ];

    $validSizeKey = in_array(mb_strtolower($size), array_keys($sizeMap), true) ? mb_strtolower($size) : 'md';
    $pixelSize = $sizeMap[$validSizeKey];

    // Validação do nível de correção de erros
    $validCorrection = in_array(strtoupper($correction), ['L', 'M', 'Q', 'H'], true) ? strtoupper($correction) : 'H';

    // Resolução de slots e conteúdos
    $valueContent = $value ?? ($slot->isNotEmpty() ? $slot->toHtml() : null);
    $labelContent = $label ?? $labelSlot ?? null;

    // Acessibilidade WCAG
    $accessibleLabel = is_string($labelContent) ? "Código QR para {$labelContent}" : 'Código QR de identificação';

    // Gerador de SVG do QR Code (Seguro contra erros de classe ausente)
    $qrSvg = null;
    if (!empty($valueContent) && class_exists('QrCode')) {
        try {
            $qrSvg = QrCode::format('svg')
                ->size($pixelSize)
                ->errorCorrection($validCorrection)
                ->generate((string) $valueContent);
        } catch (\Throwable $e) {
            $qrSvg = null;
        }
    }

    // Geração de Data URI para Download Nativo (sem dependência de JS inline)
    $downloadDataUri = $qrSvg ? 'data:image/svg+xml;charset=utf-8,' . rawurlencode($qrSvg) : null;
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-qrcode',
        "ui-card-qrcode--{$validSizeKey}",
        'ui-card-qrcode--has-label' => !empty($labelContent),
        'ui-card-qrcode--empty' => empty($qrSvg),
    ]) }}
    role="img"
    aria-label="{{ $accessibleLabel }}"
>
    {{-- ÁREA DO CÓDIGO QR / PLACEHOLDER --}}
    <div class="ui-card-qrcode__wrapper">
        @if($qrSvg)
            <div class="ui-card-qrcode__svg-container" aria-hidden="true">
                {!! $qrSvg !!}
            </div>
        @else
            <div class="ui-card-qrcode__placeholder">
                <svg class="ui-card-qrcode__placeholder-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.008v.008H6.75V6.75zM6.75 16.5h.008v.008H6.75V16.5zM16.5 6.75h.008v.008H16.5V6.75zM13.5 13.5h2.25v2.25H13.5v-2.25zM13.5 18h2.25v2.25H13.5V18zM18 13.5h2.25v2.25H18v-2.25zM18 18h2.25v2.25H18V18z" />
                </svg>
                <span class="ui-card-qrcode__placeholder-text">Código QR indisponível</span>
            </div>
        @endif
    </div>

    {{-- LEGENDA / RÓTULO TEXTUAL --}}
    @if($labelContent)
        @if($validTag === 'figure')
            <figcaption class="ui-card-qrcode__label">
                {{ $labelContent }}
            </figcaption>
        @else
            <div class="ui-card-qrcode__label">
                {{ $labelContent }}
            </div>
        @endif
    @endif

    {{-- BOTÃO / LINK DE DOWNLOAD --}}
    @if($download && $qrSvg)
        <div class="ui-card-qrcode__actions">
            <a
                href="{{ $downloadDataUri }}"
                download="{{ $downloadName }}.svg"
                class="ui-card-qrcode__download-link"
                data-action="download-qr"
                data-qr-value="{{ $valueContent }}"
            >
                <svg class="ui-card-qrcode__download-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                <span class="ui-card-qrcode__download-text">Exportar QR</span>
            </a>
        </div>
    @endif
</{{ $validTag }}>
