@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Salas'),
    'subtitle' => __('Consulte e organize as salas e a sua relação com os equipamentos do inventário.'),
    'actions' => '<a href="/ui/rooms/create" class="inline-flex items-center justify-center rounded-2xl bg-primary px-3 py-2 text-sm font-semibold text-black transition hover:opacity-90">+ ' . __('Nova sala') . '</a>'
])
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
            <p class="text-[10px] font-bold uppercase tracking-[0.25em] text-[var(--text-soft)]">{{ __('Visão geral') }}</p>
            <h2 class="mt-3 text-xl font-semibold tracking-tight text-[var(--text)]">{{ __('Gestão de espaços físicos') }}</h2>
            <p class="mt-3 text-sm leading-7 text-[var(--text-soft)]">{{ __('Cada sala pode ser associada a equipamentos, técnicos e tickets para facilitar a monitorização operacional.') }}</p>
        </div>
        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
            <p class="text-[10px] font-bold uppercase tracking-[0.25em] text-[var(--text-soft)]">{{ __('Estado') }}</p>
            <p class="mt-3 text-3xl font-black tracking-tight text-[var(--text)]">12</p>
            <p class="mt-2 text-sm text-[var(--text-soft)]">{{ __('Salas registadas no sistema.') }}</p>
        </div>
        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
            <p class="text-[10px] font-bold uppercase tracking-[0.25em] text-[var(--text-soft)]">{{ __('Próximo passo') }}</p>
            <p class="mt-3 text-sm leading-7 text-[var(--text-soft)]">{{ __('Crie ou edite entradas para manter a estrutura da infraestrutura atualizada.') }}</p>
        </div>
    </div>
@endcomponent
@endsection
