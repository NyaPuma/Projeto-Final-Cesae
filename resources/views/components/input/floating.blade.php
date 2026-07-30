{{--
|--------------------------------------------------------------------------
| Floating Label Input Component
|--------------------------------------------------------------------------
|
| Input com label flutuante com suporte a A11y e validação nativa Laravel.
| • Integração automática com Request Validation e Old Input do Laravel.
| • Sanitização robusta de IDs para campos complexos (pontos e arrays).
| • Ligações ARIA rigorosas (aria-describedby, aria-invalid).
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => ' ',
    'required' => false,
    'readonly' => false,
    'disabled' => false,
    'autocomplete' => null,
    'hint' => null,
    'error' => null,
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'floating_' . uniqid());

    // Resolução automática de erros do Laravel caso a prop error não venha preenchida
    $laravelError = $safeName ? $errors->first($safeName) : null;
    $resolvedError = $error ?? $laravelError;
    $hasError = !empty($resolvedError);

    // Definição dos IDs para conexões ARIA
    $hintId = $hint ? "{$defaultId}-hint" : null;
    $errorId = $hasError ? "{$defaultId}-error" : null;
    $describedBy = array_filter([$hintId, $errorId]);

    // Valor inicial considerando o old input do Laravel
    $initialValue = $safeName ? old($safeName, $value) : $value;
@endphp

<div {{ $attributes->except(['id', 'name', 'type', 'value', 'placeholder', 'required', 'readonly', 'disabled', 'autocomplete'])->class([
    'ui-floating',
    'ui-floating--error' => $hasError,
    'ui-floating--disabled' => $disabled,
    'ui-floating--readonly' => $readonly,
]) }}>
    <input
        id="{{ $defaultId }}"
        @if($safeName) name="{{ $safeName }}" @endif
        type="{{ $type }}"
        value="{{ $initialValue }}"
        placeholder="{{ $placeholder }}"
        @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
        class="ui-floating__input @error($safeName) ui-floating__input--error @enderror"
        @if($required) required @endif
        @if($readonly) readonly @endif
        @if($disabled) disabled @endif
        @if($hasError) aria-invalid="true" @else aria-invalid="false" @endif
        @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
        {{ $attributes->only(['id', 'name', 'type', 'value', 'placeholder', 'required', 'readonly', 'disabled', 'autocomplete']) }}
    >

    @if($label)
        <label for="{{ $defaultId }}" class="ui-floating__label">
            {{ $label }}
            @if($required)
                <span class="ui-floating__required-marker" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    {{-- Dica de Ajuda (Hint) --}}
    @if($hint)
        <x-ui.input.hint id="{{ $hintId }}">{{ $hint }}</x-ui.input.hint>
    @endif

    {{-- Mensagem de Erro do Laravel --}}
    @if($hasError)
        <x-ui.input.error id="{{ $errorId }}">{{ $resolvedError }}</x-ui.input.error>
    @endif
</div>
