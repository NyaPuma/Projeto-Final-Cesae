{{--
|--------------------------------------------------------------------------
| Page Header Component
|--------------------------------------------------------------------------
|
| Cabeçalho modular para secções com eyebrow, título de grande destaque e descrição.
| • 100% livre de CSS ou JS inline.
| • Suporte a atributos globais e customização de margens via $attributes.
| • Verificações defensivas robustas para elementos opcionais.
|
--}}

@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
])

<div {{ $attributes->class(['mb-8']) }}>
    @if($eyebrow)
        <x-ui.text.eyebrow as="p" size="md" tracking="widest">
            {{ $eyebrow }}
        </x-ui.text.eyebrow>
    @endif

    @if($title)
        <h2 class="mt-3 text-3xl font-black tracking-tight text-[var(--text)]">
            {{ $title }}
        </h2>
    @endif

    @if($description)
        <p class="mt-3 text-sm leading-7 text-[var(--text-soft)]">
            {{ $description }}
        </p>
    @endif
</div>
