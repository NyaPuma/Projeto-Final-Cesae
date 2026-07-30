{{--
|--------------------------------------------------------------------------
| Section Header Component
|--------------------------------------------------------------------------
|
| Cabeçalho de secção reutilizável com eyebrow, título, descrição opcional e slot aside.
| • 100% livre de CSS ou JS inline.
| • Sintaxe de variáveis CSS corrigida e segura para o Tailwind.
| • Layout responsivo otimizado (stack no mobile, row no desktop).
| • Suporte a atributos globais via $attributes.
|
--}}

@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
])

<div {{ $attributes->class(['mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between']) }}>
    <div class="flex-1 min-w-0">
        @if($eyebrow)
            <x-ui.text.eyebrow>{{ $eyebrow }}</x-ui.text.eyebrow>
        @endif

        @if($title)
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-[var(--text)]">{{ $title }}</h2>
        @endif

        @if($description)
            <p class="mt-3 max-w-3xl text-sm leading-7 text-[var(--text-soft)]">{{ $description }}</p>
        @endif
    </div>

    @isset($aside)
        <div class="shrink-0">
            {{ $aside }}
        </div>
    @endisset
</div>
