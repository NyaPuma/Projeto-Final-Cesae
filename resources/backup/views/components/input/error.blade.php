{{--
|--------------------------------------------------------------------------
| Input Error Component (Otimizado)
|--------------------------------------------------------------------------
|
| Exibe mensagens de erro de forma semântica e acessível.
| • Suporte total ao slot (HTML personalizado).
| • Prioridade: Slot > Prop > Laravel Error Bag.
|
--}}

@props([
    'name' => null,
    'icon' => true,
    'message' => null,
])

@php
    // Prioridade de conteúdo: Slot > Mensagem manual > Erro do formulário
    $hasError = ($name && $errors->has($name)) || $message || $slot->isNotEmpty();
    $errorMessage = $slot->isNotEmpty() ? $slot : ($message ?? ($name ? $errors->first($name) : null));
@endphp

@if($hasError)
    <p {{ $attributes->class(['ui-input-error']) }} role="alert" aria-live="polite">

        @if($icon)
            <span class="ui-input-error__icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 3C7.03 3 3 7.03 3 12s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9z" />
                </svg>
            </span>
        @endif

        <span class="ui-input-error__text">
            {{ $errorMessage }}
        </span>
    </p>
@endif
