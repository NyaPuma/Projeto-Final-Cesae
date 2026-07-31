{{--
|--------------------------------------------------------------------------
| UI Card Wrapper Component
|--------------------------------------------------------------------------
|
| Componente base para cartões ou contentores genéricos com cantos arredondados e sombras.
| • Cabeçalho opcional com título, descrição e ícone para identificação rápida da secção.
| • Tone 'danger' para zonas de perigo com realce de alerta subtil.
| • 100% livre de CSS ou JS inline.
| • Sintaxe de variáveis CSS corrigida e segura para o Tailwind.
| • Encaminhamento dinâmico de atributos globais via $attributes.
|
--}}

@props([
    'title' => null,
    'description' => null,
    'icon' => null,
    'iconVariant' => 'primary',
    'tone' => 'default',
])

@php
    $toneClasses = [
        'default' => 'border-[var(--border)] bg-[var(--surface)]',
        'danger' => 'border-red-500/20 dark:border-red-500/30 bg-red-50/50 dark:bg-red-950/10',
    ][$tone] ?? 'border-[var(--border)] bg-[var(--surface)]';
@endphp

<div {{ $attributes->merge(['class' => 'rounded-3xl border p-6 shadow-sm ' . $toneClasses]) }}>
    @if($title || $icon)
        <div class="mb-6 flex items-start gap-4">
            @if($icon)
                <span
                    @class([
                        'flex h-10 w-10 shrink-0 items-center justify-center rounded-xl',
                        'bg-primary/10 text-primary' => $iconVariant === 'primary',
                        'bg-red-500/10 text-red-500' => $iconVariant === 'danger',
                    ])
                    aria-hidden="true"
                >
                    @if(is_string($icon) && str_starts_with(trim($icon), '<svg'))
                        {!! $icon !!}
                    @else
                        {{ $icon }}
                    @endif
                </span>
            @endif

            <div>
                @if($title)
                    <h2 class="text-lg font-semibold text-[var(--text)]">{{ $title }}</h2>
                @endif

                @if($description)
                    <p class="mt-1 text-sm text-[var(--text-soft)]">{{ $description }}</p>
                @endif
            </div>
        </div>
    @endif

    {{ $slot }}
</div>
