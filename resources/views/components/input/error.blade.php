{{--
|--------------------------------------------------------------------------
| Input Error Component
|--------------------------------------------------------------------------
|
| Exibe mensagens de erro de forma semântica e acessível.
| • Prioridade inteligente: Slot (HTML customizado) > Prop de Mensagem > Laravel Error Bag.
| • Suporte a IDs opcionais para integração perfeita com aria-describedby.
| • Acessibilidade WCAG completa (role="alert", aria-live="polite").
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'id' => null,
    'name' => null,
    'icon' => true,
    'message' => null,
])

@php
    // Determina se existe um erro ativo (via nome no Request, prop manual ou slot preenchido)
    $hasError = ($name && $errors->has($name)) || !empty($message) || $slot->isNotEmpty();

    // Resolução do texto de erro padrão (caso o slot não seja utilizado)
    $errorText = $message ?? ($name ? $errors->first($name) : null);
@endphp

@if($hasError)
    <p
        {{ $attributes->class(['ui-input-error']) }}
        @if($id) id="{{ $id }}" @endif
        role="alert"
        aria-live="polite"
    >
        @if($icon)
            <span class="ui-input-error__icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M12 3C7.03 3 3 7.03 3 12s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9z" />
                </svg>
            </span>
        @endif

        <span class="ui-input-error__text">
            @if($slot->isNotEmpty())
                {{ $slot }}
            @else
                {{ $errorText }}
            @endif
        </span>
    </p>
@endif
