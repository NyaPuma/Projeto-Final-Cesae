{{--
|--------------------------------------------------------------------------
| Card QR Code Component (Otimizado)
|--------------------------------------------------------------------------
|
| Apresenta códigos QR para ativos.
| • Inclui correção de erro 'H' para maior durabilidade.
| • Estrutura semântica para acessibilidade.
|
--}}

@props([
    'value' => null,
    'label' => null,
    'size' => 'md',
    'download' => false,
])

@php
    $sizeMap = ['sm' => 80, 'lg' => 180, 'md' => 120];
    $pixelSize = $sizeMap[$size] ?? 120;
@endphp

<div {{ $attributes->class([
    'ui-card-qrcode',
    "ui-card-qrcode--{$size}",
]) }}>

    <figure class="ui-card-qrcode__image" role="img" aria-label="Código QR para {{ $label ?? 'identificação' }}">
        @if($value)
            {!! QrCode::size($pixelSize)
                ->errorCorrection('H')
                ->generate($value) !!}
        @else
            <div class="ui-card-qrcode__placeholder">Sem código</div>
        @endif
    </figure>

    @if($label)
        <div class="ui-card-qrcode__label">
            {{ $label }}
        </div>
    @endif

    @if($download && $value)
        <button
            type="button"
            class="ui-card-qrcode__download"
            onclick="exportQrCode(this)"
            data-value="{{ $value }}"
        >
            Exportar QR
        </button>
    @endif
</div>
