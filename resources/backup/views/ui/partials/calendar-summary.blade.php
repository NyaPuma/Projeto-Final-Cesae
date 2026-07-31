@props(['eventsTotal' => '--', 'monthTotal' => '--'])

<div class="bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 shadow-sm h-fit space-y-8"
    aria-labelledby="summary-title">
    <div>
        <span
            class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.14em] text-primary">
            <span class="h-2 w-2 rounded-full bg-primary" aria-hidden="true"></span>
            {{ __('Agenda Inteligente') }}
        </span>
        <h3 id="summary-title" class="mt-4 text-lg font-bold text-[var(--text)]">
            {{ __('Resumo Operacional') }}
        </h3>
        <p class="text-xs text-[var(--text-soft)] mt-1.5">{{ __('Métricas da agenda atual') }}</p>
    </div>

    <hr class="border-[var(--border)]" aria-hidden="true">

    <div class="grid grid-cols-2 xl:grid-cols-1 gap-6 lg:gap-8">
        <div class="p-6 bg-[var(--surface-2)] border border-[var(--border)] rounded-2xl">
            <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                {{ __('Total de Eventos') }}
            </p>
            <p class="text-4xl font-black text-[var(--text)] mt-2" id="eventsTotal" aria-live="polite">
                {{ $eventsTotal }}
            </p>
        </div>

        <div class="p-6 bg-[var(--surface-2)] border border-[var(--border)] rounded-2xl">
            <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                {{ __('Este Mês') }}
            </p>
            <p class="text-4xl font-black text-[var(--text)] mt-2" id="monthTotal" aria-live="polite">
                {{ $monthTotal }}
            </p>
        </div>
    </div>

    <div class="p-6 border border-[var(--border)] rounded-2xl bg-opacity-40 bg-[var(--surface-2)]">
        <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
            {{ __('Próxima Intervenção') }}
        </p>
        <div class="flex items-center gap-3 mt-3">
            <span class="relative flex h-2.5 w-2.5" aria-hidden="true">
                <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-primary"></span>
            </span>
            <p class="text-sm font-semibold text-[var(--text)]">
                {{ __('Sincronização Ativa') }}
            </p>
        </div>
    </div>
</div>
