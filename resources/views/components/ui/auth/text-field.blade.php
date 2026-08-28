{{--
|--------------------------------------------------------------------------
| Form Input Component Wrapper
|--------------------------------------------------------------------------
|
| Wrapper component for standard form fields with label and validation support.
| • 100% free of inline CSS or JS.
| • Automatic data preservation via old() function on validation failures.
| • Invisible character cleanup for perfect Blade engine compilation.
|
--}}

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

<x-ui.form.field :id="$id" :name="$name" :label="$label" :required="$required">
    <x-ui.form.input
        :id="$id"
        :name="$name"
        :type="$type"
        :autocomplete="$autocomplete"
        :placeholder="$placeholder"
        :required="$required"
        :value="old($name, $value)"
        {{ $attributes->merge(['class' => 'py-3.5 transition']) }}
    />
</x-ui.form.field>
