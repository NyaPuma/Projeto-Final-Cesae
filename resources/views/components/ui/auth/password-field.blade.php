@props([
    'id',
    'name',
    'label',
    'autocomplete' => null,
    'placeholder' => '••••••••',
    'required' => false,
    'toggle' => false,
    'toggle_label' => __('Mostrar'),
])

<x-ui.form.field :id="$id" :label="$label" :required="$required">
    <div class="relative">
        <x-ui.form.input
            :id="$id"
            :name="$name"
            type="password"
            :autocomplete="$autocomplete"
            :placeholder="$placeholder"
            :required="$required"
            {{ $attributes->merge(['class' => 'py-3.5 transition' . ($toggle ? ' pr-12' : '')]) }}
        />

        @if($toggle)
            <x-ui.buttons.button type="button" id="togglePassword" variant="secondary" size="xs" weight="semibold" class="absolute right-2 top-1/2 -translate-y-1/2 px-2.5 shadow-none">
                {{ $toggle_label }}
            </x-ui.buttons.button>
        @endif
    </div>
</x-ui.form.field>
