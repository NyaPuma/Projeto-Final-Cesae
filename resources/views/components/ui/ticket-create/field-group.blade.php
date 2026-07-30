@props([
    'label',
    'required' => false,
])

<x-ui.form.field :label="$label" :required="$required">
    {{ $slot }}
</x-ui.form.field>
