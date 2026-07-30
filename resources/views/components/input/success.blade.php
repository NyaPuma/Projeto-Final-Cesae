{{--
|--------------------------------------------------------------------------
| Input Success Component
|--------------------------------------------------------------------------
|
| Mensagem de feedback de sucesso acessível e performática.
| • 100% livre de CSS ou JS inline.
| • Conformidade WCAG completa (role="status", aria-live="polite").
| • Suporte a ícones opcionais e slots flexíveis.
|
--}}

@props([
    'show' => true,
    'icon' => true,
])

@if($show)
    <p
        {{ $attributes->class([
            'ui-input-success',
        ])->merge([
            'role' => 'status',
            'aria-live' => 'polite',
        ]) }}
    >
        @if($icon)
            <span class="ui-input-success__icon" aria-hidden="true">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    aria-hidden="true"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
        @endif

        <span class="ui-input-success__text">
            {{ $slot }}
        </span>
    </p>
@endif
