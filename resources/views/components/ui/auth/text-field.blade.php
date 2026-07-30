{{--
|--------------------------------------------------------------------------
| Form Input Component Wrapper
|--------------------------------------------------------------------------
|
| Componente wrapper para campos de formulário padrão com suporte a rótulos e validação.
| • 100% livre de CSS ou JS inline.
| • Preservação automática de dados via função old() em falhas de validação.
| • Limpeza de carateres invisíveis para perfeita compilação no motor Blade.
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

<x-ui.form.field :id="$id" :label="$label" :required="$required">
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
