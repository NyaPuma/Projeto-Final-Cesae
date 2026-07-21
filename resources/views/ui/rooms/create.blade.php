@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Criar sala'),
    'subtitle' => __('Registe uma nova sala para organizar o inventário e integrar os ativos por localização.'),
    'actions' => '<a href="/ui/rooms" class="inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">← ' . __('Voltar') . '</a>'
])
    <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
        <div class="grid gap-6 lg:grid-cols-2">
            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Nome da sala') }}</label>
                <input type="text" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="{{ __('Ex.: Sala de Servidores A') }}">
            </div>
            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Pavilhão / edifício') }}</label>
                <input type="text" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="{{ __('Ex.: Edifício Norte') }}">
            </div>
        </div>
        <div class="mt-6 flex flex-wrap gap-3">
            <button type="button" class="inline-flex items-center justify-center rounded-2xl bg-primary px-4 py-3 text-sm font-semibold text-black transition hover:opacity-90">{{ __('Guardar sala') }}</button>
            <a href="/ui/rooms" class="inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-4 py-3 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">{{ __('Cancelar') }}</a>
        </div>
    </div>
@endcomponent
@endsection
