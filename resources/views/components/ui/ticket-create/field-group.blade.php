{{--
|-------------------------------------------------------------------------- |
Form Field Wrapper Component (Otimizado)
|-------------------------------------------------------------------------- |
| Componente wrapper para campos de formulário.
| • Encaminha corretamente todos os atributos adicionais via $attributes.
| • 100% livre de CSS ou JS inline.
| --}}
@props([
    'label' => null,
    'required' => false,
])

<x-ui.form.field :label="$label" :required="$required" {{ $attributes }}>
    {{ $slot }}
</x-ui.form.field>
