@extends('ui.layout')

@section('page_key', 'ticket-detail')

@section('content')
<div data-ticket-id="{{ $ticketId ?? $ticket->id ?? null }}">
@component('ui.partials.page-card', [
    'title' => __('Detalhes do Ticket'),
    'subtitle' => __('Fluxo Orçamental ACCEPT: Consulta de estado, aprovações administrativas e gestão técnica.'),
    'actions' => '<a href="' . route('ui.tickets') . '" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all"><svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> ' . __('Voltar à listagem') . '</a>'
])

    <div class="grid gap-6 xl:grid-cols-[1.2fr_0.8fr] animate-[fadeIn_0.3s_ease-out]">

        {{-- Coluna Esquerda: Detalhes + Painel Técnico + Painel Admin --}}
        <div class="space-y-6">

            {{-- Detalhes do Ticket --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm h-fit">
                <div id="ticketDetails" class="space-y-4 text-xs text-[var(--text-soft)]">
                    <div class="flex items-center justify-center py-12 gap-2">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        <p class="text-sm font-medium text-[var(--text-soft)]">{{ __('A carregar dados do ticket...') }}</p>
                    </div>
                </div>
            </div>

            {{-- 🛠️ PAINEL DO TÉCNICO DE CAMPO --}}
            @if(isset($user) && $user && $user->isTechnician())
            <div id="techInterventionSection" class="space-y-6">

                {{-- 🟢 ESTADO: ABERTO — Iniciar Reparação (com verificação de prioridade) --}}
                <div id="techStartCard" class="hidden rounded-2xl border border-blue-500/30 bg-blue-500/5 p-6 shadow-sm space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-bold text-[var(--text)]">{{ __('Iniciar Reparação') }}</h3>
                            <p class="text-xs text-[var(--text-soft)] mt-1">
                                {{ __('Assuma a responsabilidade por este ticket e inicie a intervenção técnica. O sistema verificará se existem tickets mais prioritários pendentes.') }}
                            </p>
                        </div>
                    </div>

                    <div class="bg-blue-500/5 border border-blue-500/20 rounded-xl p-3 text-xs text-[var(--text-soft)]">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                            <span>{{ __('O ticket está no estado') }} <strong class="text-[var(--text)]">"{{ __('Aberta') }}"</strong>. {{ __('Clique no botão abaixo para começar.') }}</span>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-1">
                        <button id="btnStartRepair" type="button" class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold rounded-xl shadow-sm transition-all cursor-pointer gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"></path></svg>
                            {{ __('Iniciar Intervenção') }}
                        </button>
                        <button id="btnStartRepairForce" type="button" class="hidden flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-amber-600 hover:bg-amber-500 text-white text-xs font-bold rounded-xl shadow-sm transition-all cursor-pointer gap-2">
                            <span>⚠️</span>
                            {{ __('Forçar Início (ignorar prioritários)') }}
                        </button>
                    </div>
                </div>

                {{-- ESTADO: BLOQUEADO (Pendente Orçamento > Threshold) --}}
                <div id="techBlockedCard" class="hidden rounded-2xl border border-amber-500/30 bg-amber-500/5 p-6 shadow-sm space-y-3">
                    <div class="flex items-center gap-3 text-amber-600 dark:text-amber-400">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider">{{ __('Ticket Bloqueado — Pendente Orçamento') }}</h3>
                            <p class="text-xs text-[var(--text-soft)] mt-0.5">
                                {{ __('O custo estimado excede o limiar de autonomia. A intervenção está trancada até avaliação e aprovação do Administrador.') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- ESTADO: RECUSADO (Reparação Abortada) --}}
                <div id="techRejectedCard" class="hidden rounded-2xl border border-rose-500/30 bg-rose-500/5 p-6 shadow-sm space-y-3">
                    <div class="flex items-center gap-3 text-rose-600 dark:text-rose-400">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                        </svg>
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider">{{ __('Reparação Abortada') }}</h3>
                            <p class="text-xs text-[var(--text-soft)] mt-0.5" id="techRejectedReason">
                                {{ __('O orçamento para este ticket foi recusado pela Administração. A intervenção foi encerrada.') }}
                            </p>
                            <div id="techRejectedFeedback" class="hidden mt-2 p-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-xs"></div>
                        </div>
                    </div>
                </div>

                {{-- ESTADO: ORÇAMENTO APROVADO — Pode prosseguir --}}
                <div id="techApprovedCard" class="hidden rounded-2xl border border-emerald-500/30 bg-emerald-500/5 p-6 shadow-sm space-y-3">
                    <div class="flex items-center gap-3 text-emerald-600 dark:text-emerald-400">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider">{{ __('Orçamento Aprovado!') }}</h3>
                            <p class="text-xs text-[var(--text-soft)] mt-0.5">
                                {{ __('A Administração aprovou o orçamento. Pode prosseguir com a reparação e registar os custos finais.') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FORMULÁRIO 1: SUBMETER CUSTO ESTIMADO COM ORÇAMENTO DETALHADO --}}
                <div id="techBudgetSubmitCard" class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm space-y-3">
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-2.5">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)]">{{ __('1. Avaliação Orçamental Detalhada') }}</h3>
                        <span class="text-[9px] font-mono bg-[var(--surface-2)] text-[var(--text-soft)] px-2 py-0.5 rounded-md font-bold">{{ __('Regra ACCEPT') }}</span>
                    </div>
                    <p class="text-xs text-[var(--text-soft)]">
                        {{ __('Introduza o orçamento detalhado da reparação com os itens, quantidades e preços. Se o total exceder o limiar, o ticket aguardará autorização do Administrador.') }}
                    </p>

                    <form id="techBudgetForm" class="space-y-3 pt-1">
                        {{-- Tabela de Itens do Orçamento Detalhado --}}
                        <div class="space-y-2">
                            <label class="mb-1 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                                {{ __('Itens do Orçamento Detalhado') }}
                            </label>
<div id="budgetItemsContainer" class="space-y-2">
                                {{-- Itens adicionados dinamicamente via JS com event listeners automáticos --}}
                            </div>
                            <button type="button" id="btnAddBudgetItem" class="inline-flex items-center gap-1 px-2.5 py-1.5 text-[10px] font-bold uppercase tracking-wider text-primary border border-dashed border-[var(--border)] rounded-xl hover:bg-[var(--surface-2)] transition-all cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                                {{ __('Adicionar Item') }}
                            </button>
                        </div>

                        {{-- Total Estimado --}}
                        <div class="flex items-center justify-between rounded-xl bg-[var(--surface-2)] px-4 py-3 border border-[var(--border)]">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Total Estimado') }}</span>
                            <span id="techTotalEstimatedDisplay" class="text-lg font-black font-mono text-[var(--text)]">0.00 €</span>
                        </div>

                        <div>
                            <label for="techEstimatedCostInput" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                                {{ __('Custo Estimado Global (€)') }}
                            </label>
                            <input id="techEstimatedCostInput" type="number" step="0.01" placeholder="{{ __('Ex: 75.00') }}" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs font-mono text-[var(--text)] outline-none focus:border-[var(--text)] transition-all">
                        </div>

                        <button type="button" id="btnSubmitEstimatedBudget" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-primary text-white text-xs font-bold rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer">
                            {{ __('Submeter Orçamento Detalhado') }}
                        </button>
                    </form>
                </div>

                {{-- FORMULÁRIO 2: CONCLUIR INTERVENÇÃO (Ativo quando em Autonomia / Aprovado) --}}
                <div id="techCompletionCard" class="rounded-2xl border border-emerald-500/20 bg-[var(--surface)] p-6 shadow-sm space-y-5">
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <div class="space-y-1">
                            <span class="inline-block bg-emerald-500/10 text-emerald-500 text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-md border border-emerald-500/20">
                                {{ __('Autonomia / Autorizado') }}
                            </span>
                            <h3 class="text-sm font-bold text-[var(--text)] flex items-center gap-2 pt-1">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.428 15.428a2 2 0 002.143-.231l5.531-5.531a2 2 0 000-2.828l-1.257-1.257a2 2 0 00-2.828 0l-5.531 5.531a2 2 0 00-.231 2.143L3 21l3.571-3.571z"></path>
                                </svg>
                                {{ __('Concluir Intervenção') }}
                            </h3>
                            <p class="text-xs text-[var(--text-soft)]">
                                {{ __('Registe os custos finais e o relatório técnico para fechar o ticket.') }}
                            </p>
                        </div>
                    </div>

                    <form id="techCompletionForm" class="space-y-4">
                        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-4 space-y-2">
                            <label for="techTotalCost" class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">
                                {{ __('Custo Final Executado (€)') }}
                            </label>
                            <input id="techTotalCost" type="number" step="0.01" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-lg font-mono font-extrabold text-emerald-500 outline-none focus:border-emerald-500 transition-all" placeholder="0.00">
                        </div>

                        <div>
                            <label for="techFinalReport" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                                {{ __('Relatório Técnico Final') }}
                            </label>
                            <textarea id="techFinalReport" rows="3" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-[var(--text)] transition-all resize-none" placeholder="{{ __('Descreva o trabalho efetuado e peças substituídas...') }}"></textarea>
                        </div>

                        <button type="button" id="btnFinishTicket" class="w-full inline-flex items-center justify-center px-4 py-3 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-sm transition-all cursor-pointer gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                            {{ __('Finalizar e Fechar Ticket') }}
                        </button>
                    </form>
                </div>

            </div>
            @endif

            {{-- 💰 PAINEL DE DECISÃO DO ADMINISTRADOR --}}
            @if(isset($user) && $user && $user->isAdmin())
            <div id="budgetApprovalCard" class="relative rounded-2xl border border-amber-500/30 bg-[var(--surface)] p-6 shadow-sm space-y-4 overflow-hidden hidden">
                <div class="absolute top-0 left-0">
                    <span class="inline-block bg-amber-500 text-black text-[9px] font-extrabold uppercase tracking-widest px-3 py-1 rounded-br-xl shadow-sm">
                        {{ __('Ação Requerida') }}
                    </span>
                </div>

                <div class="pt-2">
                    <h3 class="text-sm font-bold text-[var(--text)] flex items-center gap-2">
                        <span class="text-base">💰</span> {{ __('Decisão Orçamental (Administração)') }}
                    </h3>
                    <p class="text-xs text-[var(--text-soft)] mt-1">
                        {{ __('O custo estimado ultrapassa o limiar financeiro (*threshold*) de') }} <strong class="text-[var(--text)] font-mono" id="budgetThresholdDisplay">50.00 €</strong>.
                    </p>
                </div>

                <div class="rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-4 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Custo Solicitado') }}</span>
                        <p class="text-xs text-[var(--text-soft)] mt-0.5">{{ __('Técnico:') }} <span id="budgetTechnicianName" class="font-semibold text-[var(--text)]">—</span></p>
                    </div>
                    <div class="text-right">
                        <span id="budgetEstimatedCost" class="text-2xl font-black font-mono text-amber-500 dark:text-amber-400">0.00 €</span>
                    </div>
                </div>

                {{-- Orçamento Detalhado (visível para o Admin) --}}
                <div id="budgetDetailsContainer" class="hidden rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-4 space-y-2">
                    <h4 class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        {{ __('Detalhe do Orçamento') }}
                    </h4>
                    <div id="budgetDetailsList" class="space-y-1.5">
                        {{-- Itens preenchidos dinamicamente --}}
                    </div>
                    <div class="flex justify-between items-center border-t border-[var(--border)] pt-2 mt-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Total') }}</span>
                        <span id="budgetDetailsTotal" class="text-sm font-black font-mono text-[var(--text)]">0.00 €</span>
                    </div>
                </div>

                <form id="budgetForm" class="space-y-3">
                    <div>
                        <label for="budgetFeedback" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                            {{ __('Justificação / Feedback (Obrigatório em Recusa)') }}
                        </label>
                        <textarea id="budgetFeedback" rows="2" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-[var(--text)] transition-all resize-none" placeholder="{{ __('Insira o parecer orçamental...') }}"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3 pt-1">
                        <button type="button" id="btnApproveBudget" class="inline-flex items-center justify-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl shadow-sm transition-all cursor-pointer gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                            {{ __('Aprovar Orçamento') }}
                        </button>
                        <button type="button" id="btnRejectBudget" class="inline-flex items-center justify-center px-4 py-2.5 bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/30 text-rose-500 text-xs font-bold rounded-xl shadow-sm transition-all cursor-pointer gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                            {{ __('Recusar Orçamento') }}
                        </button>
                    </div>
                </form>
            </div>
            @endif

        </div>

        {{-- Coluna Direita: Interações e Gestão --}}
        <div class="space-y-6">

            <div id="aiAssistantContainer"></div>

            {{-- Secção de Comentários Internos --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] border-b border-[var(--border)] pb-2.5 mb-3">{{ __('Histórico de Notas & Pareceres') }}</h3>
                <div id="commentsSection" class="text-xs text-[var(--text-soft)] max-h-60 overflow-y-auto pr-1">
                    <p class="italic py-2">{{ __('A carregar histórico...') }}</p>
                </div>
            </div>

            {{-- Formulário Adicionar Comentário --}}
            <x-ui.ticket-detail.comments-card />

            {{-- Evidências Fotográficas --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-3">{{ __('Evidências Fotográficas') }}</h3>
                <form id="photoForm" class="space-y-3 border-b border-[var(--border)] pb-4 mb-3">
                    <input id="photoInput" type="file" accept="image/*" class="block w-full text-xs text-[var(--text-soft)] file:mr-3 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-[var(--text)]/5 file:text-[var(--text)] cursor-pointer">
                    <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl hover:bg-[var(--surface-2)] transition-all cursor-pointer">
                        {{ __('Enviar Fotografia') }}
                    </button>
                </form>
                <div id="photosSection" class="text-xs text-[var(--text-soft)]">
                    <p class="italic">{{ __('Nenhuma evidência carregada.') }}</p>
                </div>
            </div>

            {{-- Painel Atribuição Admin --}}
            @if(isset($user) && $user && $user->isAdmin())
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-3">{{ __('Gestão de Atribuição') }}</h3>
                <div class="space-y-3">
                    <input id="assignTechnicianId" type="number" min="1" placeholder="{{ __('ID do Técnico') }}" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-1.5 text-xs text-[var(--text)] outline-none focus:border-[var(--text)] transition-all">
                    <div class="flex gap-2">
                        <button id="btnAssignManual" type="button" class="inline-flex items-center justify-center px-3 py-2 bg-[var(--text)] text-[var(--surface)] text-xs font-bold rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer">
                            {{ __('Atribuir') }}
                        </button>
                        <button id="btnAssignAuto" type="button" class="inline-flex items-center justify-center px-3 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl hover:bg-[var(--surface-2)] transition-all cursor-pointer">
                            {{ __('Automático') }}
                        </button>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

    {{-- Sistema Dinâmico de Notificações --}}
    <div id="ticketMessage" class="mt-4 min-h-6 text-xs font-medium transition-all duration-300 px-1"></div>

    {{-- ⚠️ Modal de Aviso de Prioridade (Ticket Urgente não Atendido) --}}
    <div id="priorityWarningModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-2xl p-6 max-w-md w-full mx-4 animate-[fadeIn_0.2s_ease-out] space-y-4">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-full bg-amber-500/20 flex items-center justify-center flex-shrink-0">
                    <span class="text-xl">⚠️</span>
                </div>
                <div class="flex-1">
                    <h3 class="text-sm font-bold text-[var(--text)]">{{ __('Atenção: Ticket Prioritário Pendente') }}</h3>
                    <p id="priorityWarningText" class="text-xs text-[var(--text-soft)] mt-1">
                        {{ __('Existe um ticket de prioridade mais alta por atender.') }}
                    </p>
                    <div id="priorityWarningDetails" class="mt-2 p-3 rounded-xl bg-amber-500/5 border border-amber-500/20 text-xs space-y-1">
                        <p class="font-semibold text-amber-600 dark:text-amber-400">{{ __('Detalhes:') }}</p>
                        <p id="priorityWarningCount" class="text-[var(--text-soft)]"></p>
                        <p id="priorityWarningCurrent" class="text-[var(--text-soft)]"></p>
                        <p id="priorityWarningAction" class="text-[var(--text-soft)] mt-1 text-[10px]"></p>
                    </div>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button id="btnForceStartTicket" type="button" class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-[var(--border)] hover:bg-rose-500/10 hover:text-rose-500 text-[var(--text)] text-xs font-bold rounded-xl transition-all cursor-pointer border border-transparent hover:border-rose-500/30">
                    {{ __('Sim, continuar') }}
                </button>
                <button id="btnViewUrgentTickets" type="button" class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-amber-500 hover:bg-amber-400 text-black text-xs font-bold rounded-xl shadow-sm transition-all cursor-pointer">
                    🔥 {{ __('Ir para ticket prioritário') }}
                </button>
            </div>
        </div>
    </div>

@endcomponent
</div>
@endsection

