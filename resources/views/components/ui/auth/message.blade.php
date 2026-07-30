{{--
|--------------------------------------------------------------------------
| Message / Alert Container Component
|--------------------------------------------------------------------------
|
| Container dinâmico para exibição de mensagens de feedback e alertas com A11y.
| • 100% livre de CSS ou JS inline.
| • Sintaxe de variáveis CSS corrigida e segura para o Tailwind.
| • Gestão idiomática de classes e estados condicionais via $attributes.
|
--}}

@props([
    'id' => 'msg',
    'hidden' => true,
])

<div
    id="{{ $id }}"
    aria-live="polite"
    {{ $attributes->class([
        'hidden' => $hidden,
        'flex min-h-[48px] items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 text-sm font-medium text-[var(--text-soft)]',
    ]) }}
></div>
