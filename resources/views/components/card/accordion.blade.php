{{--
|--------------------------------------------------------------------------
| Card Accordion Component (Otimizado)
|--------------------------------------------------------------------------
|
| Secções expansíveis e semânticas baseadas em HTML5 nativo (<details>).
| • Totalmente acessível via teclado e leitores de ecrã por padrão.
| • Chevron dinâmico e interativo em substituição ao indicador textual "+".
| • Utilização de diretivas modernas do Laravel Blade para classes.
|
--}}

@props([
    'title' => null,
    'icon' => null,
    'open' => false,
    'border' => true,
])

<details
    {{ $attributes->class([
        'ui-card-accordion',
        'ui-card-accordion--border' => $border,
    ]) }}
    @if($open) open @endif
>
    <summary class="ui-card-accordion__header">
        <div class="ui-card-accordion__title">
            {{-- Ícone opcional da secção --}}
            @if($icon)
                <span class="ui-card-accordion__icon" aria-hidden="true">
                    {!! $icon !!}
                </span>
            @endif

            {{-- Texto do Título --}}
            <span class="ui-card-accordion__text">
                {{ $title }}
            </span>
        </div>

        {{-- Chevron rotativo em vez do caractere estático "+" --}}
        <span class="ui-card-accordion__indicator" aria-hidden="true">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
        </span>
    </summary>

    {{-- Conteúdo Revelado --}}
    <div class="ui-card-accordion__content">
        {{ $slot }}
    </div>
</details>
