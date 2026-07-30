{{--
|--------------------------------------------------------------------------
| Switch Component
|--------------------------------------------------------------------------
|
| Toggle switch acessível com suporte a estados, validação e A11y.
| • 100% livre de CSS ou JS inline.
| • Sanitização robusta de IDs para campos complexos (pontos e arrays).
| • Integração nativa com Request Validation e Old Input do Laravel.
| • Acessibilidade WCAG avançada (aria-invalid, aria-describedby).
|
--}}

@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'description' => null,
    'hint' => null,
    'error' => null,
    'success' => null,
    'checked' => false,
    'disabled' => false,
    'required' => false,
    'value' => '1',
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'switch_' . uniqid());

    // Resolução automática de erros do Laravel caso a prop error não venha preenchida
    $laravelError = $safeName ? $errors->first($safeName) : null;
    $resolvedError = $error ?? $laravelError;
    $hasError = !empty($resolvedError);
    $hasSuccess = !empty($success);

    // Definição dos IDs para conexões ARIA
    $hintId = $hint ? "{$defaultId}-hint" : null;
    $errorId = $hasError ? "{$defaultId}-error" : null;
    $successId = $hasSuccess ? "{$defaultId}-success" : null;
    $describedBy = array_filter([$hintId, $errorId, $successId]);

    // Tratamento correto do estado checked considerando o old input do Laravel para checkboxes
    $isChecked = old($safeName) !== null ? (old($safeName) == $value) : $checked;
@endphp

<div {{ $attributes->except(['id', 'name', 'type', 'value', 'checked', 'disabled', 'required'])->class([
    'ui-switch',
    'ui-switch--invalid' => $hasError,
    'ui-switch--success' => $hasSuccess,
    'ui-switch--disabled' => $disabled,
]) }}>
    <label class="ui-switch__wrapper" for="{{ $defaultId }}">
        <input
            id="{{ $defaultId }}"
            class="ui-switch__input"
            type="checkbox"
            @if($safeName) name="{{ $safeName }}" @endif
            value="{{ $value }}"
            @checked($isChecked)
            @if($disabled) disabled @endif
            @if($required) required @endif
            @if($hasError) aria-invalid="true" @else aria-invalid="false" @endif
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
            {{ $attributes->only(['id', 'name', 'type', 'value', 'checked', 'disabled', 'required']) }}
        >

        <span class="ui-switch__control" aria-hidden="true">
            <span class="ui-switch__thumb"></span>
        </span>

        @if($label || $description)
            <span class="ui-switch__content">
                @if($label)
                    <span class="ui-switch__label">
                        {{ $label }}
                        @if($required)
                            <span class="ui-switch__required-marker" aria-hidden="true">*</span>
                        @endif
                    </span>
                @endif
                @if($description)
                    <span class="ui-switch__description">{{ $description }}</span>
                @endif
            </span>
        @endif
    </label>

    {{-- Dica de Ajuda (Hint) --}}
    @if($hint && !$hasError && !$hasSuccess)
        <div id="{{ $hintId }}">
            <x-ui.input.hint>{{ $hint }}</x-ui.input.hint>
        </div>
    @endif

    {{-- Mensagem de Erro do Laravel --}}
    @if($hasError)
        <div id="{{ $errorId }}">
            <x-ui.input.error>{{ $resolvedError }}</x-ui.input.error>
        </div>
    @endif

    {{-- Mensagem de Sucesso --}}
    @if($hasSuccess)
        <div id="{{ $successId }}">
            <x-ui.input.success>{{ $success }}</x-ui.input.success>
        </div>
    @endif
</div>
