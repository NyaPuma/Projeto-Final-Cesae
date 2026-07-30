@props([
    'id',
    'name',
    'label',
    'type' => 'text',
    'autocomplete' => null,
    'placeholder' => null,
    'required' => false,
    'value' => null,
])

<x-ui.form.field :id="$id" :label="$label" :required="$required">
    <x-ui.form.input
        :id="$id"
        :name="$name"
        :type="$type"
        :autocomplete="$autocomplete"
        :placeholder="$placeholder"
        :required="$required"
        :value="$value"
        {{ $attributes->merge(['class' => 'py-3.5 transition']) }}
    />
</x-ui.form.field>
