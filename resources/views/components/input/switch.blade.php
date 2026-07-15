{{--
|--------------------------------------------------------------------------
| Switch Component (Otimizado)
|--------------------------------------------------------------------------
|
| Toggle switch acessível com suporte a estados e Livewire/Alpine.
|
--}}

@props([
    'id' => null,
    'name',
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
    $id = $id ?? $name;
    $hasError = !!$error;
    $hasSuccess = !!$success;

    // IDs dinâmicos para acessibilidade
    $hintId = $id . '-hint';
    $errorId = $id . '-error';
    $successId = $id . '-success';
@endphp

<div @class(['ui-switch', 'ui-switch--invalid' => $hasError, 'ui-switch--success' => $hasSuccess])>
    <label class="ui-switch__wrapper" for="{{ $id }}">

        <input
            id="{{ $id }}"
            class="ui-switch__input"
            type="checkbox"
            name="{{ $name }}"
            value="{{ $value }}"
            @checked($checked)
            @disabled($disabled)
            @required($required)
            aria-describedby="{{ $hasError ? $errorId : ($hasSuccess ? $successId : ($hint ? $hintId : '')) }}"
            {{ $attributes }}
        >

        <span class="ui-switch__control" aria-hidden="true">
            <span class="ui-switch__thumb"></span>
        </span>

        @if($label || $description)
            <span class="ui-switch__content">
                @if($label)
                    <span class="ui-switch__label">{{ $label }}</span>
                @endif
                @if($description)
                    <span class="ui-switch__description">{{ $description }}</span>
                @endif
            </span>
        @endif
    </label>

    @if($hint)
        <div id="{{ $hintId }}"><x-ui.input.hint>{{ $hint }}</x-ui.input.hint></div>
    @endif

    @if($error)
        <div id="{{ $errorId }}"><x-ui.input.error>{{ $error }}</x-ui.input.error></div>
    @endif

    @if($success)
        <div id="{{ $successId }}"><x-ui.input.success>{{ $success }}</x-ui.input.success></div>
    @endif
</div>
