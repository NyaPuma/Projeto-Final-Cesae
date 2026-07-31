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

    {{-- Contentor Principal do Formulário --}}
    <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-8 shadow-sm">

        <div class="mb-6 border-b border-[var(--border)] pb-4">
            <h2 class="text-sm font-bold text-[var(--text)]">{{ __('Novo pedido de intervenção') }}</h2>
            <p class="text-xs text-[var(--text-soft)] mt-0.5">{{ __('Descreva a situação de forma objetiva para que a equipa técnica possa agir rapidamente.') }}</p>
        </div>

        <form id="createTicketForm" class="space-y-6">

            {{-- Título do Pedido --}}
            <div>
                <label class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Título do Pedido *') }}</label>
                <input type="text" id="ticketTitle" name="title" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 transition-all" placeholder="{{ __('Ex.: Ruído anómalo no motor principal do torno') }}">
            </div>

            {{-- Descrição Detalhada --}}
            <div>
                <label class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Descrição Detalhada *') }}</label>
                <textarea id="ticketDescription" name="description" rows="4" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 resize-none transition-all" placeholder="{{ __('Detalhe o problema ocorrido, ruídos, fugas ou comportamentos fora do normal...') }}"></textarea>
            </div>

            {{-- Nível de Urgência / Prioridade (Cards Interativos) --}}
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Nível de Urgência / Prioridade *') }}</label>
                    <span class="text-[10px] text-[var(--text-soft)]">{{ __('Selecione o impacto real na produção') }}</span>
                </div>

                <input type="hidden" id="ticketPriority" name="priority" value="média" required>

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
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Manutenção Ligeira. Anomalia menor sem risco imediato.') }}</p>
                    </div>

                    {{-- Card Média (Selecionado por defeito) --}}
                    <div type="button" data-priority="média"
                        class="priority-card cursor-pointer rounded-2xl border-2 border-amber-500 bg-[var(--surface-2)] p-4 transition-all shadow-sm">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-amber-400">{{ __('Média') }}</span>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                        </div>
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Degradação Parcial. Funcionamento condicionado.') }}</p>
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
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Paragem Crítica. Linha ou máquina inoperacional.') }}</p>
                    </div>

                    {{-- Card Crítica --}}
                    <div type="button" data-priority="crítica"
                        class="priority-card cursor-pointer rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 transition-all hover:border-purple-600/50">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-rose-500">{{ __('Crítica') }}</span>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                        </div>
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Emergência Imediata. Risco de acidente.') }}</p>
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
                        <input type="text" id="equipmentSearchInput" autocomplete="off" placeholder="{{ __('Escreva para pesquisar equipamento, série ou sala...') }}"
                            class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary transition-all">
                    </div>

                    {{-- ID escondido para submissão --}}
                    <input type="hidden" id="selectedEquipmentId" name="equipment_id" required>

                    {{-- Caixa de Sugestões / Dropdown de Autocomplete --}}
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

            {{-- Botão de Submissão --}}
            <div class="mt-6">
                <button type="submit" id="submitBtn" class="inline-flex items-center justify-center rounded-xl px-6 py-3 text-xs font-black uppercase tracking-wider transition hover:opacity-90 disabled:opacity-50 shadow-lg shadow-orange-500/20 bg-primary text-white cursor-pointer">
                    {{ __('Guardar Ticket') }}
                </button>
            </div>
        </form>
    </div>
</x-ui.partials.page-card>
@endsection






