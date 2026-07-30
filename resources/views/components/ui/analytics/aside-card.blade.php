{{--
|--------------------------------------------------------------------------
| Stat Card Component
|--------------------------------------------------------------------------
|
| Cartão modular para exibição de métricas, KPIs ou estatísticas rápidas.
| • 100% livre de CSS ou JS inline.
| • Suporte híbrido a valores via propriedade ou slot flexível.
| • Sintaxe de variáveis CSS corrigida para o Tailwind.
|
--}}

@props([
    'label' => null,
    'value' => null,
])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-5 py-4 shadow-xs transition-all']) }}>
    @if($label)
        <x-ui.text.eyebrow tracking="tight">
            {{ $label }}
        </x-ui.text.eyebrow>
    @endif

    <p class="mt-2 text-lg font-bold text-[var(--text)]">
        {{ $value ?? $slot }}
    </p>
</div>
