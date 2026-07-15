{{--
|--------------------------------------------------------------------------
| Input Hint Component (Otimizado)
|--------------------------------------------------------------------------
|
| Exibe texto de ajuda abaixo dos inputs.
| • Variantes visuais (default, warning, success).
| • Gestão dinâmica de ícones.
|
--}}

@props([
    'id' => null,
    'variant' => 'default', // default, warning, error, success
    'icon' => false,
])

<p
    @if($id) id="{{ $id }}" @endif
    {{ $attributes->class([
        'ui-input-hint',
        "ui-input-hint--{$variant}",
    ]) }}
>
    @if($icon)
        <span class="ui-input-hint__icon" aria-hidden="true">
            {{-- Se icon for 'true', renderiza o padrão, caso contrário renderiza o conteúdo --}}
            @if($icon === true)
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            @else
                {!! $icon !!}
            @endif
        </span>
    @endif

    <span class="ui-input-hint__text">
        {{ $slot }}
    </span>
</p>
