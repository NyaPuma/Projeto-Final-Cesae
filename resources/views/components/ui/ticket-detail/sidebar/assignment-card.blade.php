{{--|-------------------------------------------------------------------------- |Ticket Assignment Sidebar Card Component (Otimizado)Cartão lateral para gestão e atribuição de técnicos a tickets, comsuporte a persistência de dados (old()) e sem CSS/JS inline.--}}<x-ui.ticket-detail.sidebar-card :title="__('Gestão de Atribuição')"><div class="space-y-3">
    <x-ui.form.input
        id="assignTechnicianId"
        name="technician_id"
        type="number"
        min="1"
        :value="old('technician_id')"
        :placeholder="__('ID do Técnico')"
        class="rounded-xl px-3 py-1.5 text-xs focus:border-[var(--text)]"
    />

    <div class="flex gap-2">
        <x-ui.buttons.button
            id="btnAssignManual"
            type="button"
            variant="dark"
            size="sm"
            weight="bold"
        >
            {{ __('Atribuir') }}
        </x-ui.buttons.button>

        <x-ui.buttons.button
            id="btnAssignAuto"
            type="button"
            variant="secondary"
            size="sm"
            weight="semibold"
        >
            {{ __('Automático') }}
        </x-ui.buttons.button>
    </div>
</div>
</x-ui.ticket-detail.sidebar-card>
