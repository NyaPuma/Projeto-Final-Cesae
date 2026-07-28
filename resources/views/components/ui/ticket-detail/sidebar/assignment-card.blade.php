<x-ui.ticket-detail.sidebar-card :title="__('Gestão de Atribuição')">
    <div class="space-y-3">
        <input id="assignTechnicianId" type="number" min="1" placeholder="{{ __('ID do Técnico') }}" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-1.5 text-xs text-[var(--text)] outline-none transition-all focus:border-[var(--text)]">
        <div class="flex gap-2">
            <button id="btnAssignManual" type="button" class="inline-flex items-center justify-center rounded-xl bg-[var(--text)] px-3 py-2 text-xs font-bold text-[var(--surface)] shadow-sm transition-all hover:opacity-90 cursor-pointer">{{ __('Atribuir') }}</button>
            <button id="btnAssignAuto" type="button" class="inline-flex items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-xs font-semibold text-[var(--text)] transition-all hover:bg-[var(--surface-2)] cursor-pointer">{{ __('Automático') }}</button>
        </div>
    </div>
</x-ui.ticket-detail.sidebar-card>
