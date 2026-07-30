{{--
|--------------------------------------------------------------------------
| UI Card Wrapper Component
|--------------------------------------------------------------------------
|
| Componente base para cartões ou contentores genéricos com cantos arredondados e sombras.
| • 100% livre de CSS ou JS inline.
| • Sintaxe de variáveis CSS corrigida e segura para o Tailwind.
| • Encaminhamento dinâmico de atributos globais via $attributes.
|
--}}

<div {{ $attributes->merge(['class' => 'rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm']) }}>
    {{ $slot }}
</div>
