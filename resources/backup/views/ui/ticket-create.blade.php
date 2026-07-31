@extends('ui.layout')
@section('page_key', 'ticket-create')

@section('content')
<x-ui.partials.page-card
    :title="__('Criar Ticket')"
    :subtitle="__('Registe uma nova ocorrência de manutenção com contexto técnico e prioridade.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="'/ui/tickets'" :label="__('Voltar aos tickets')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    {{-- Contentor Principal do Formul├írio --}}
    <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-8 shadow-sm">

        <div class="mb-6 border-b border-[var(--border)] pb-4">
            <h2 class="text-sm font-bold text-[var(--text)]">{{ __('Novo pedido de interven├º├úo') }}</h2>
            <p class="text-xs text-[var(--text-soft)] mt-0.5">{{ __('Descreva a situa├º├úo de forma objetiva para que a equipa t├®cnica possa agir rapidamente.') }}</p>
        </div>

        <form id="createTicketForm" class="space-y-6">

            {{-- T├¡tulo do Pedido --}}
            <div>
                <label class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('T├¡tulo do Pedido *') }}</label>
                <input type="text" id="ticketTitle" name="title" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 transition-all" placeholder="{{ __('Ex.: Ru├¡do an├│malo no motor principal do torno') }}">
            </div>

            {{-- Descri├º├úo Detalhada --}}
            <div>
                <label class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Descri├º├úo Detalhada *') }}</label>
                <textarea id="ticketDescription" name="description" rows="4" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 resize-none transition-all" placeholder="{{ __('Detalhe o problema ocorrido, ru├¡dos, fugas ou comportamentos fora do normal...') }}"></textarea>
            </div>

            {{-- N├¡vel de Urg├¬ncia / Prioridade (Cards Interativos) --}}
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('N├¡vel de Urg├¬ncia / Prioridade *') }}</label>
                    <span class="text-[10px] text-[var(--text-soft)]">{{ __('Selecione o impacto real na produ├º├úo') }}</span>
                </div>

                <input type="hidden" id="ticketPriority" name="priority" value="m├®dia" required>

                <div class="grid gap-4 md:grid-cols-4">
                    {{-- Card Baixa --}}
                    <div type="button" data-priority="baixa"
                        class="priority-card cursor-pointer rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 transition-all hover:border-emerald-500/50">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-emerald-400">{{ __('Baixa') }}</span>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        </div>
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Manuten├º├úo Ligeira. Anomalia menor sem risco imediato.') }}</p>
                    </div>

                    {{-- Card M├®dia (Selecionado por defeito) --}}
                    <div type="button" data-priority="m├®dia"
                        class="priority-card cursor-pointer rounded-2xl border-2 border-amber-500 bg-[var(--surface-2)] p-4 transition-all shadow-sm">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-amber-400">{{ __('M├®dia') }}</span>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                        </div>
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Degrada├º├úo Parcial. Funcionamento condicionado.') }}</p>
                    </div>

                    {{-- Card Alta --}}
                    <div type="button" data-priority="alta"
                        class="priority-card cursor-pointer rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 transition-all hover:border-red-500/50">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-orange-400">{{ __('Alta') }}</span>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                        </div>
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Paragem Cr├¡tica. Linha ou m├íquina inoperacional.') }}</p>
                    </div>

                    {{-- Card Cr├¡tica --}}
                    <div type="button" data-priority="cr├¡tica"
                        class="priority-card cursor-pointer rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 transition-all hover:border-purple-600/50">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-rose-500">{{ __('Cr├¡tica') }}</span>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                        </div>
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Emerg├¬ncia Imediata. Risco de acidente.') }}</p>
                    </div>
                </div>
            </div>

            {{-- Equipamento (Autocomplete) & Imagem --}}
            <div class="grid gap-6 lg:grid-cols-2">
                {{-- AUTOCOMPLETAR EQUIPAMENTO --}}
                <div class="relative">
                    <label class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">
                        {{ __('Equipamento / Ativo Afetado *') }}
                    </label>

                    <div class="relative">
                        <input type="text" id="equipmentSearchInput" autocomplete="off" placeholder="{{ __('Escreva para pesquisar equipamento, s├®rie ou sala...') }}"
                            class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary transition-all">
                    </div>

                    {{-- ID escondido para submiss├úo --}}
                    <input type="hidden" id="selectedEquipmentId" name="equipment_id" required>

                    {{-- Caixa de Sugest├Áes / Dropdown de Autocomplete --}}
                    <div id="equipmentSuggestions" class="hidden absolute z-50 mt-1 w-full max-h-52 overflow-y-auto rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-2xl divide-y divide-[var(--border)]/50">
                    </div>
                </div>

                {{-- Inserir Imagem --}}
                <div>
                    <label class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Inserir Imagem (Opcional)') }}</label>
                    <div class="flex items-center gap-3 w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2">
                        <label for="ticketImage" class="cursor-pointer rounded-xl bg-[var(--surface)] border border-[var(--border)] px-3 py-1.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--surface-2)] transition">
                            {{ __('Escolher ficheiro') }}
                        </label>
                        <input type="file" id="ticketImage" accept="image/*" class="hidden">
                        <span id="fileName" class="text-xs text-[var(--text-soft)] truncate">{{ __('Nenhum ficheiro selecionado') }}</span>
                    </div>
                </div>
            </div>

            {{-- Mensagem de Feedback --}}
            <div id="formMessage" class="min-h-6 text-xs font-medium text-[var(--text-soft)]"></div>

            {{-- Bot├úo de Submiss├úo --}}
            <div class="mt-6">
                <button type="submit" id="submitBtn" class="inline-flex items-center justify-center rounded-xl px-6 py-3 text-xs font-black uppercase tracking-wider transition hover:opacity-90 disabled:opacity-50 shadow-lg shadow-orange-500/20 bg-primary text-white cursor-pointer">
                    {{ __('Guardar Ticket') }}
                </button>
            </div>
        </form>
    </div>
</x-ui.partials.page-card>
@endsection






