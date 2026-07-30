{{--
|-------------------------------------------------------------------------- |
| Section Header / Title Component (Otimizado)
|-------------------------------------------------------------------------- |
| Cabeçalho modular para secções, formulários ou cartões, composto por
| um título principal, descrição opcional e suporte a variáveis do Design System.
|--}}
@props([
    'title' => null,
    'description' => null,
])

@if($title)
    <div {{ $attributes->merge(['class' => 'mb-6']) }}>
        <h2 class="text-sm font-bold text-[var(--text)]">{{ $title }}</h2>

        @if($description)
            <p class="mt-0.5 text-xs text-[var(--text-soft)]">{{ $description }}</p>
        @endif
    </div>
@endif
