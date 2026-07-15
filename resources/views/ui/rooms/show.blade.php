@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => 'Detalhes da sala',
    'subtitle' => 'Visualize a informação principal da sala e os ativos associados.',
    'actions' => '<a href="/ui/rooms" class="inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">← Voltar</a>'
])
    <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
            <p class="text-[10px] font-bold uppercase tracking-[0.25em] text-[var(--text-soft)]">Informação</p>
            <h2 class="mt-3 text-2xl font-semibold tracking-tight text-[var(--text)]">Sala de Servidores A</h2>
            <p class="mt-3 text-sm leading-7 text-[var(--text-soft)]">Edifício Norte • Equipamentos monitorizados • Tickets associados ativos.</p>
        </div>
        <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface-2)]/70 p-6 shadow-sm">
            <p class="text-[10px] font-bold uppercase tracking-[0.25em] text-[var(--text-soft)]">Resumo operacional</p>
            <div class="mt-4 space-y-3">
                <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">3 equipamentos associados</div>
                <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">2 tickets em acompanhamento</div>
                <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">Disponível para manutenção preventiva</div>
            </div>
        </div>
    </div>
@endcomponent
@endsection
