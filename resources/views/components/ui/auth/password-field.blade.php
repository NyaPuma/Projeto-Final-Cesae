{{--
|--------------------------------------------------------------------------
| Password Input Component
|--------------------------------------------------------------------------
|
| Password input with validation support, auto-fill and visibility toggle.
| • 100% free of inline CSS or JS.
| • Reactive visibility controlled via Alpine.js without global scripts.
| • ID duplication prevention (essential in forms with multiple inputs).
|
--}}

@props([
    'id',
    'name',
    'label',
    'autocomplete' => null,
    'placeholder' => '••••••••',
    'required' => false,
    'toggle' => false,
    'toggleLabel' => __('common.Mostrar'),
    'hideLabel' => __('common.Ocultar'),
    'toggle_label' => null, // Backward compatibility with snake_case
])

@php
    $resolvedToggleLabel = $toggle_label ?? $toggleLabel;
    $toggleButtonId = $id . '-toggle';
@endphp

<x-ui.form.field :id="$id" :label="$label" :required="$required">
    <div class="relative" @if($toggle) x-data="{ show: false }" @endif>
        <x-ui.form.input
            :id="$id"
            :name="$name"
            type="password"
            @if($toggle) x-bind:type="show ? 'text' : 'password'" @endif
            :autocomplete="$autocomplete"
            :placeholder="$placeholder"
            :required="$required"
            {{ $attributes->merge(['class' => 'py-3.5 transition' . ($toggle ? ' pr-20' : '')]) }}
        />

        @if($toggle)
            <x-ui.buttons.button
                type="button"
                id="{{ $toggleButtonId }}"
                @click="show = !show"
                @click.prevent
                aria-controls="{{ $id }}"
                x-bind:aria-pressed="show.toString()"
                variant="secondary"
                size="xs"
                weight="semibold"
                class="absolute right-2 top-1/2 -translate-y-1/2 px-2.5 shadow-none"
            >
                <span x-text="show ? @js($hideLabel) : @js($resolvedToggleLabel)">
                    {{ $resolvedToggleLabel }}
                </span>
            </x-ui.buttons.button>
        @endif
    </div>
</x-ui.form.field>
