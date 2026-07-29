<div id="roomModal" class="fixed inset-0 z-[9999] hidden items-center justify-center overflow-y-auto bg-black/60 p-4 backdrop-blur-sm">
    <div class="relative my-auto w-full max-w-md rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xl transition-all">
        <h3 id="roomModalTitle" class="mb-4 text-base font-bold text-[var(--text)]">{{ __('Dados da Sala') }}</h3>

        <form id="roomForm" class="space-y-4">
            <input id="roomId" name="id" type="hidden">

            <x-ui.form.field id="roomName" :label="__('Nome / Código da Sala')" :required="true">
                <x-ui.form.input id="roomName" name="name" type="text" :required="true" class="rounded-xl px-3 py-2.5 text-xs focus:border-orange-500 focus:ring-1 focus:ring-orange-500" />
            </x-ui.form.field>

            <x-ui.form.field id="roomLocation" :label="__('Localização')" :required="true">
                <x-ui.form.input id="roomLocation" name="location" type="text" :required="true" class="rounded-xl px-3 py-2.5 text-xs focus:border-orange-500 focus:ring-1 focus:ring-orange-500" />
            </x-ui.form.field>

            <div class="mt-6 flex items-center justify-end gap-2 border-t border-[var(--border)] pt-4">
                <x-ui.buttons.button type="button" data-action="close-room-modal" variant="secondary" size="sm" weight="semibold">
                    {{ __('Cancelar') }}
                </x-ui.buttons.button>
                <x-ui.buttons.submit variant="accent" size="sm" weight="bold">
                    {{ __('Guardar') }}
                </x-ui.buttons.submit>
            </div>
        </form>
    </div>
</div>
