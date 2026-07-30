{{--
|--------------------------------------------------------------------------
| Metric Card Component
|--------------------------------------------------------------------------
|
| Cartão estatístico para exibição de métricas com título, valor, ícone e descrição.
| • 100% livre de CSS ou JS inline.
| • Sintaxe de variáveis CSS corrigida e segura para o Tailwind.
| • Suporte a atributos globais via $attributes.
| • Verificações defensivas para elementos opcionais.
|
--}}

@props([
    'eyebrow' => null,
    'value_id' => null,
    'default_value' => '--',
    'description' => null,
    'icon_bg_class' => 'bg-emerald-500/10',
    'icon_color_class' => null,
    'icon' => null,
])

<article {{ $attributes->class(['rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-7 shadow-xs']) }}>
    <div class="flex items-center justify-between">
        <div>
            @if($eyebrow)
                <x-ui.text.eyebrow as="p">{{ $eyebrow }}</x-ui.text.eyebrow>
            @endif

            <h3
                @if($value_id) id="{{ $value_id }}" @endif
                class="mt-4 text-4xl font-black text-[var(--text)]"
            >
                {{ $default_value }}
            </h3>
        </div>

        @if($icon)
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl {{ $icon_bg_class }}" aria-hidden="true">
                {!! $icon !!}
            </div>
        @endif
    </div>

    @if($description)
        <p class="mt-6 text-sm text-[var(--text-soft)]">{{ $description }}</p>
    @endif
</article>
