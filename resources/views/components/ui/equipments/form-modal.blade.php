<div id="equipmentModal" class="fixed inset-0 z-[9999] hidden items-center justify-center overflow-y-auto bg-black/60 p-4 backdrop-blur-sm">
    <div class="relative my-auto w-full max-w-lg rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xl transition-all">
        <h3 id="equipmentModalTitle" class="mb-4 text-base font-bold text-[var(--text)]">{{ __('Adicionar Equipamento') }}</h3>

        <form id="equipmentForm" class="space-y-4">
            <input id="equipmentId" name="id" type="hidden">

            <div>
                <label for="eqName" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Nome do Equipamento') }}</label>
                <input id="eqName" name="name" type="text" required placeholder="Ex: Projetor Epson EB-2250U"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none transition-all focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="eqSerial" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Número de Série / Código') }}</label>
                    <input id="eqSerial" name="serial" type="text" placeholder="Ex: SN-987654"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none transition-all focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
                </div>

                <div>
                    <label for="eqStatus" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Estado Operacional') }}</label>
                    <select id="eqStatus" name="active" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none transition-all focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
                        <option value="1">{{ __('Operacional') }}</option>
                        <option value="0">{{ __('Fora de Serviço') }}</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-2 border-t border-[var(--border)] pt-4">
                <button type="button" data-action="close-equipment-modal" class="cursor-pointer rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2 text-xs font-semibold text-[var(--text)] transition-all hover:bg-[var(--border)]">
                    {{ __('Cancelar') }}
                </button>
                <button type="submit" class="cursor-pointer rounded-xl bg-orange-500 px-4 py-2 text-xs font-bold text-white shadow-sm transition-all hover:bg-orange-600">
                    {{ __('Guardar Equipamento') }}
                </button>
            </div>
        </form>
    </div>
</div>
