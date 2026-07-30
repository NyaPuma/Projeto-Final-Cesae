{{--
|--------------------------------------------------------------------------
| Equipment Modal View
|--------------------------------------------------------------------------
|
| Janela modal para registo e edição de equipamentos do sistema.
| • 100% livre de CSS ou JS inline.
| • Sintaxe de variáveis CSS corrigida e segura para o Tailwind.
| • Acessibilidade aprimorada com atributos ARIA para diálogos.
|
--}}

<div
    id="equipmentModal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="equipmentModalTitle"
    class="fixed inset-0 z-[9999] hidden items-center justify-center overflow-y-auto bg-black/60 p-4 backdrop-blur-sm"
>
    <div class="relative my-auto w-full max-w-lg rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xl transition-all">
        <h3 id="equipmentModalTitle" class="mb-4 text-base font-bold text-[var(--text)]">
            {{ __('Adicionar Equipamento') }}
        </h3>

        <form id="equipmentForm" class="space-y-4">
            <input id="equipmentId" name="id" type="hidden">

            <x-ui.form.field id="eqName" :label="__('Nome do Equipamento')" :required="true">
                <x-ui.form.input
                    id="eqName"
                    name="name"
                    type="text"
                    :required="true"
                    placeholder="Ex: Projetor Epson EB-2250U"
                    class="rounded-xl px-3 py-2.5 text-xs focus:border-orange-500 focus:ring-1 focus:ring-orange-500"
                />
            </x-ui.form.field>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <x-ui.form.field id="eqSerial" :label="__('Número de Série / Código')">
                    <x-ui.form.input
                        id="eqSerial"
                        name="serial"
                        type="text"
                        placeholder="Ex: SN-987654"
                        class="rounded-xl px-3 py-2.5 text-xs focus:border-orange-500 focus:ring-1 focus:ring-orange-500"
                    />
                </x-ui.form.field>

                <x-ui.form.field id="eqStatus" :label="__('Estado Operacional')">
                    <x-ui.form.select
                        id="eqStatus"
                        name="active"
                        class="rounded-xl px-3 py-2.5 text-xs focus:border-orange-500 focus:ring-1 focus:ring-orange-500"
                    >
                        <option value="1">{{ __('Operacional') }}</option>
                        <option value="0">{{ __('Fora de Serviço') }}</option>
                    </x-ui.form.select>
                </x-ui.form.field>
            </div>

            <div class="mt-6 flex items-center justify-end gap-2 border-t border-[var(--border)] pt-4">
                <x-ui.buttons.button
                    type="button"
                    data-action="close-equipment-modal"
                    variant="secondary"
                    size="sm"
                    weight="semibold"
                >
                    {{ __('Cancelar') }}
                </x-ui.buttons.button>

                <x-ui.buttons.submit variant="accent" size="sm" weight="bold">
                    {{ __('Guardar Equipamento') }}
                </x-ui.buttons.submit>
            </div>
        </form>
    </div>
</div>
