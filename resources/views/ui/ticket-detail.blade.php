@extends('ui.layout')

@section('content')
<script>
// Indica que a vista requer autenticação ao carregar
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Detalhes do Ticket'),
    'subtitle' => __('Fluxo Orçamental ACCEPT: Consulta de estado, aprovações administrativas e gestão técnica.'),
    'actions' => '<a href="/ui/tickets" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all"><svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> ' . __('Voltar à listagem') . '</a>'
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
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-3">{{ __('Adicionar Comentário') }}</h3>
                <form id="commentForm" class="space-y-3">
                    <textarea id="commentText" rows="2" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-[var(--text)] transition-all resize-none" placeholder="{{ __('Escreva uma mensagem para a equipa...') }}"></textarea>
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-[var(--text)] text-[var(--surface)] text-xs font-bold rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer">
                        {{ __('Enviar') }}
                    </button>
                </form>
            </div>

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
                    <h3 class="text-sm font-bold text-[var(--text)]">{{ __('Atenção: Tickets Urgentes Pendentes') }}</h3>
                    <p id="priorityWarningText" class="text-xs text-[var(--text-soft)] mt-1">
                        {{ __('Existem tickets de prioridade mais alta por atender. Recomenda-se resolvê-los primeiro.') }}
                    </p>
                    <div id="priorityWarningDetails" class="mt-2 p-3 rounded-xl bg-amber-500/5 border border-amber-500/20 text-xs space-y-1 hidden">
                        <p class="font-semibold text-amber-600 dark:text-amber-400">{{ __('Detalhes:') }}</p>
                        <p id="priorityWarningCount" class="text-[var(--text-soft)]"></p>
                        <p id="priorityWarningCurrent" class="text-[var(--text-soft)]"></p>
                    </div>
                </div>
            </div>
            <div class="flex gap-2 pt-2">
                <button id="btnViewUrgentTickets" type="button" class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-amber-500 hover:bg-amber-400 text-black text-xs font-bold rounded-xl shadow-sm transition-all cursor-pointer">
                    🔥 {{ __('Ver Tickets Urgentes') }}
                </button>
                <button id="btnForceStartTicket" type="button" class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-[var(--border)] hover:bg-rose-500/10 hover:text-rose-500 text-[var(--text)] text-xs font-bold rounded-xl transition-all cursor-pointer border border-transparent hover:border-rose-500/20">
                    {{ __('Iniciar Mesmo Assim') }}
                </button>
                <button id="btnCancelPriority" type="button" class="inline-flex items-center justify-center px-3 py-2.5 bg-[var(--surface-2)] text-[var(--text-soft)] text-xs font-semibold rounded-xl hover:bg-[var(--border)] transition-all cursor-pointer">
                    ✕
                </button>
            </div>
        </div>
    </div>

@endcomponent
@endsection

@push('scripts')
<script>
const ticketId = {{ json_encode($ticketId ?? $ticket->id ?? null) }};

const priorityColors = {
    baixa:   'border border-emerald-500/10 bg-emerald-500/5 text-emerald-600 dark:text-emerald-400',
    média:   'border border-amber-500/15 bg-amber-500/5 text-amber-600 dark:text-amber-400',
    alta:    'border border-orange-500/15 bg-orange-500/5 text-orange-600 dark:text-orange-400',
    crítica: 'border border-rose-500/20 bg-rose-500/5 text-rose-600 dark:text-rose-400',
};

const priorityLabels = {
    baixa:   "{{ __('Baixa') }}",
    média:   "{{ __('Média') }}",
    alta:    "{{ __('Alta') }}",
    crítica: "{{ __('Crítica') }}"
};

const statusLabels = {
    'aberto':             "{{ __('Aberto') }}",
    'aberta':             "{{ __('Aberta') }}",
    'em curso':           "{{ __('Em Curso') }}",
    'pendente orçamento': "{{ __('Pendente Orçamento') }}",
    'recusada':           "{{ __('Recusada') }}",
    'recusado':           "{{ __('Recusado') }}",
    'fechado':            "{{ __('Fechado') }}",
    'fechada':            "{{ __('Fechada') }}"
};

function showMessage(msg, isError = false) {
    const el = document.getElementById('ticketMessage');
    if (!el) return;
    el.innerText = msg;
    el.className = `mt-4 min-h-6 text-xs font-medium transition-all duration-300 px-1 ${isError ? 'text-rose-500' : 'text-emerald-500'}`;
    setTimeout(() => { el.innerText = ''; }, 5000);
}

function authHeader() {
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) {
        headers['Authorization'] = 'Bearer ' + token;
        headers['X-Auth-Token'] = token;
    }
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

    return headers;
}

function checkCurrentUserIsAdmin() {
    try {
        const token = localStorage.getItem('api_token');
        if (!token) return false;
        const base64Url = token.split('.')[1];
        const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        const payload = JSON.parse(window.atob(base64));
        return payload.role === 'admin' || payload.isAdmin === true;
    } catch (e) {
        // Fallback para o $user passado pela view
        const userFromView = @json($user ?? null);
        if (userFromView && userFromView.profile) {
            return userFromView.profile.name === 'admin';
        }
        return false;
    }
}

async function fetchTicket() {
    if (!ticketId) {
        console.error("ID do Ticket não fornecido.");
        return;
    }

    const res = await fetch('/tickets/' + ticketId, { headers: authHeader() });
    if(res.status === 401) { alert("{{ __('Autenticação necessária. Faça login.') }}"); window.location='/ui/login'; return; }
    if(!res.ok) { const j = await res.json(); alert(j.message || "{{ __('Erro a carregar ticket') }}"); return; }

    const data = await res.json();
    const ticket = data.ticket || data;

    // Corrige o status: pode vir como objeto {name: "..."} ou string
    const statusName = typeof ticket.status === 'object' && ticket.status !== null
        ? ticket.status.name
        : (typeof ticket.status === 'string' ? ticket.status : null);
    const statusClean = (statusName || '').toLowerCase();

    const priColor = priorityColors[ticket.priority] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]';

    let statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-blue-500/10 text-blue-600 dark:text-blue-400 uppercase tracking-tight">${statusLabels[statusClean] ?? statusName ?? 'N/A'}</span>`;

    if (statusClean === 'em curso') {
        statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 uppercase tracking-tight">⚙️ {{ __('Em Curso') }}</span>`;
    } else if (statusClean === 'pendente orçamento' || statusClean === 'pendente_orçamento') {
        statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-amber-500/20 text-amber-600 dark:text-amber-400 border border-amber-500/30 uppercase tracking-tight">⏳ {{ __('Pendente Orçamento') }}</span>`;
    } else if (statusClean === 'recusada' || statusClean === 'recusado') {
        statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-rose-500/15 text-rose-600 dark:text-rose-400 border border-rose-500/30 uppercase tracking-tight">❌ {{ __('Recusada') }}</span>`;
    } else if (statusClean === 'fechada' || statusClean === 'fechado') {
        statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-[var(--text-soft)]/10 text-[var(--text-soft)] uppercase tracking-tight">{{ __('Fechada') }}</span>`;
    }

    document.getElementById('ticketDetails').innerHTML = `
        <div class="border-b border-[var(--border)] pb-4 mb-5">
            <div class="flex items-center justify-between gap-4">
                <span class="text-[10px] font-mono font-bold text-[var(--text-soft)] uppercase tracking-wider bg-[var(--surface-2)] px-2 py-0.5 rounded-lg">{{ __('ID Ocorrência') }} #${ticket.id}</span>
                <div class="flex gap-1.5">${statusBadge}</div>
            </div>
            <h2 class="text-base font-bold text-[var(--text)] mt-3">${ticket.title}</h2>
        </div>

        <div class="space-y-5">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block mb-1.5">{{ __('Descrição da Ocorrência') }}</span>
                <div class="text-xs bg-[var(--surface-2)] p-3.5 rounded-xl text-[var(--text)] leading-relaxed whitespace-pre-wrap border border-[var(--border)]">${ticket.description || "{{ __('Nenhuma descrição providenciada.') }}"}</div>
            </div>

            <div class="grid grid-cols-2 gap-x-4 gap-y-4 pt-2">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Nível de Prioridade') }}</span>
                    <span class="inline-block mt-1 px-2 py-0.5 rounded-lg text-[11px] font-bold uppercase tracking-tight ${priColor}">${priorityLabels[ticket.priority] ?? ticket.priority}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Equipamento / Ativo') }}</span>
                    <p class="text-xs font-semibold mt-1 text-[var(--text)]">${ticket.equipment ? ticket.equipment.name : '<span class="text-[var(--text-soft)] font-normal">—</span>'}</p>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Sala / Localização') }}</span>
                    <p class="text-xs font-semibold mt-1 text-[var(--text)]">${ticket.room ? ticket.room.name : '<span class="text-[var(--text-soft)] font-normal">—</span>'}</p>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Técnico Atribuído') }}</span>
                    <p class="text-xs font-semibold mt-1 text-[var(--text)]">${ticket.technician ? ticket.technician.name : '<span class="text-rose-500 font-normal italic">{{ __('Pendente de atribuição') }}</span>'}</p>
                </div>
            </div>
        </div>
    `;

    const isPendenteOrcamento = statusClean === 'pendente orçamento' || statusClean === 'pendente_orçamento';
    const isRecusada = statusClean === 'recusada' || statusClean === 'recusado';
    const isClosed = statusClean === 'fechada' || statusClean === 'fechado';
    const isEmCurso = statusClean === 'em curso' || statusClean === 'em curso';
    const estimatedAmount = parseFloat(ticket.budget_amount || ticket.estimated_cost || ticket.estimatedBudget || 0);
    const threshold = parseFloat(ticket.threshold || 50.00);

    // 🐛 FIX: Determinar o estado correto do orçamento
    const budgetWasSubmitted  = ticket.budget_requested === true || ticket.budget_requested === 1 || ticket.budget_requested === '1';
    const budgetIsPending     = ticket.budget_status === 'pending';
    const budgetIsApproved    = ticket.budget_status === 'approved';
    const budgetWasAutoApproved = budgetWasSubmitted && !ticket.budget_status && !isPendenteOrcamento;

    const techCompletionCard = document.getElementById('techCompletionCard');
    const techBlockedCard = document.getElementById('techBlockedCard');
    const techRejectedCard = document.getElementById('techRejectedCard');
    const techApprovedCard = document.getElementById('techApprovedCard');
    const techBudgetSubmitCard = document.getElementById('techBudgetSubmitCard');

    if (techCompletionCard && techBlockedCard && techRejectedCard && techApprovedCard && techBudgetSubmitCard) {
        // Esconder todos primeiro
        techCompletionCard.classList.add('hidden');
        techBlockedCard.classList.add('hidden');
        techRejectedCard.classList.add('hidden');
        techApprovedCard.classList.add('hidden');
        techBudgetSubmitCard.classList.add('hidden');

if (isRecusada) {
            // Ticket recusado (orçamento rejeitado)
            techRejectedCard.classList.remove('hidden');
            if (ticket.budget_feedback) {
                const fbEl = document.getElementById('techRejectedFeedback');
                if (fbEl) {
                    fbEl.textContent = '📋 ' + ticket.budget_feedback;
                    fbEl.classList.remove('hidden');
                }
            }
        } else if (isClosed) {
            // Ticket fechado com sucesso (reparação concluída)
            techApprovedCard.classList.remove('hidden');
            techCompletionCard.classList.add('hidden');
            const approvedTitleEl = techApprovedCard?.querySelector('h3');
            if (approvedTitleEl) approvedTitleEl.textContent = '{{ __('Reparação Concluída') }}';
            const approvedTextEl = techApprovedCard?.querySelector('p');
            if (approvedTextEl) approvedTextEl.textContent = '{{ __('O ticket foi fechado com sucesso.') }}';
        } else if (isPendenteOrcamento || (budgetWasSubmitted && budgetIsPending)) {
            // Pendente de aprovação orçamental
            techBlockedCard.classList.remove('hidden');
        } else if (budgetIsApproved || budgetWasAutoApproved) {
            // Orçamento já aprovado (pelo admin ou auto-aprovado) → mostrar conclusão
            techApprovedCard.classList.remove('hidden');
            techCompletionCard.classList.remove('hidden');
        } else if (isEmCurso && !budgetWasSubmitted) {
            // Em curso, sem orçamento ainda → mostrar formulário de submissão
            techBudgetSubmitCard.classList.remove('hidden');
        } else {
            // Fallback: ticket em curso com algum estado não mapeado
            techBudgetSubmitCard.classList.remove('hidden');
        }
    }

    const budgetCard = document.getElementById('budgetApprovalCard');
    if (budgetCard && checkCurrentUserIsAdmin()) {
        if (isPendenteOrcamento || (budgetWasSubmitted && budgetIsPending)) {
            document.getElementById('budgetEstimatedCost').innerText = estimatedAmount.toFixed(2) + ' €';
            document.getElementById('budgetThresholdDisplay').innerText = threshold.toFixed(2) + ' €';
            document.getElementById('budgetTechnicianName').innerText = ticket.technician ? ticket.technician.name : "{{ __('Técnico de Campo') }}";
            budgetCard.classList.remove('hidden');

            // Renderiza orçamento detalhado para o admin
            renderBudgetDetailsForAdmin(ticket.budget_details);
        } else {
            budgetCard.classList.add('hidden');
        }
    }
}

async function handleBudgetAction(action) {
    const feedback = document.getElementById('budgetFeedback')?.value.trim();

    if (action === 'reject' && !feedback) {
        showMessage("{{ __('Ao recusar o orçamento, é obrigatório inserir uma justificação/feedback.') }}", true);
        return;
    }

    const res = await fetch(`/admin/tickets/${ticketId}/budget-decision`, {
        method: 'POST',
        headers: { ...authHeader(), 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: action, feedback: feedback })
    });

    const data = await res.json();
    if (res.ok) {
        showMessage(action === 'approve' ? "{{ __('Orçamento Aprovado! Ticket desbloqueado para Em Curso.') }}" : "{{ __('Orçamento Recusado. Reparação Abortada.') }}");
        if (document.getElementById('budgetFeedback')) document.getElementById('budgetFeedback').value = '';
        await fetchTicket();
    } else {
        showMessage(data.message || "{{ __('Erro ao processar decisão orçamental.') }}", true);
    }
}

async function fetchComments() {
    const sec = document.getElementById('commentsSection');
    if (!sec) return;
    try {
        const res = await fetch(`/tickets/${ticketId}/comments`, { headers: authHeader() });
        if (!res.ok) return;
        const data = await res.json();
        const comments = data.comments || data;
        if (!comments || comments.length === 0) {
            sec.innerHTML = `<p class="italic py-1 text-[var(--text-soft)]">{{ __('Sem mensagens registadas.') }}</p>`;
            return;
        }
        sec.innerHTML = comments.map(c => `
            <div class="border-b border-[var(--border)]/50 py-2 space-y-1">
                <div class="flex justify-between font-bold text-[var(--text)]">
                    <span>${c.user ? c.user.name : "{{ __('Sistema') }}"}</span>
                    <span class="font-mono text-[10px] text-[var(--text-soft)]">${c.created_at || ''}</span>
                </div>
                <p class="text-[var(--text-soft)]">${c.comment || c.message || ''}</p>
            </div>
        `).join('');
    } catch (e) {
        sec.innerHTML = `<p class="italic py-1 text-rose-500">{{ __('Erro ao carregar histórico.') }}</p>`;
    }
}

async function fetchPhotos() {
    const sec = document.getElementById('photosSection');
    if (!sec) return;
    try {
        const res = await fetch(`/tickets/${ticketId}/photos`, { headers: authHeader() });
        if (!res.ok) return;
        const data = await res.json();
        const attachments = data.attachments || data;
        if (!attachments || attachments.length === 0) {
            sec.innerHTML = `<p class="italic text-[var(--text-soft)]">{{ __('Nenhuma evidência carregada.') }}</p>`;
            return;
        }
        sec.innerHTML = `<div class="grid grid-cols-2 gap-3">${attachments.map(a => {
            const isImage = a.mime_type && a.mime_type.startsWith('image/');
            const imgUrl = '/storage/' + a.path;
            if (isImage) {
                return `<div class="rounded-xl overflow-hidden border border-[var(--border)] bg-[var(--surface-2)] group shadow-sm relative">
                    <a href="${imgUrl}" target="_blank" title="${a.file_name}">
                        <img src="${imgUrl}" alt="${a.file_name}" class="w-full h-24 object-cover group-hover:opacity-85 transition-opacity duration-150">
                    </a>
                    <button onclick="deletePhoto(${a.id})" type="button" class="absolute top-1 right-1 bg-red-500/80 hover:bg-red-600 text-white rounded-lg p-1 shadow-sm transition-all cursor-pointer z-10" title="{{ __('Remover fotografia') }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>
                    </button>
                    <div class="p-1.5 border-t border-[var(--border)]">
                        <p class="text-[10px] text-[var(--text-soft)] truncate font-semibold">${a.file_name}</p>
                    </div>
                </div>`;
            }
            return `<div class="rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-2.5 flex flex-col justify-between shadow-sm min-h-[96px] relative">
                <div class="flex items-start justify-between gap-2">
                    <p class="font-bold text-[var(--text)] text-[11px] line-clamp-2">${a.file_name}</p>
                    <button onclick="deletePhoto(${a.id})" type="button" class="flex-shrink-0 bg-red-500/80 hover:bg-red-600 text-white rounded-lg p-1 shadow-sm transition-all cursor-pointer" title="{{ __('Remover ficheiro') }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>
                    </button>
                </div>
                <p class="text-[9px] font-mono text-[var(--text-soft)] uppercase tracking-wider mt-2">${a.mime_type || "{{ __('Ficheiro') }}"}</p>
            </div>`;
        }).join('')}</div>`;
    } catch (e) {
        sec.innerHTML = `<p class="italic text-rose-500">{{ __('Erro ao carregar fotografias.') }}</p>`;
    }
}

async function deletePhoto(photoId) {
    if (!confirm("{{ __('Tem a certeza que pretende remover esta fotografia?') }}")) return;

    const res = await fetch('/tickets/' + ticketId + '/photos/' + photoId, {
        method: 'DELETE',
        headers: authHeader(),
    });
    const data = await res.json();
    if (!res.ok) { showMessage(data.message || "{{ __('Erro ao remover fotografia.') }}", true); return; }
    await fetchPhotos();
    showMessage("{{ __('Fotografia removida com sucesso.') }}");
}

// ─── Orçamento Detalhado: Gestão de Itens com Recalculo Automático ───
let budgetItemCounter = 0;

function recalcBudgetTotal() {
    let total = 0;
    let materialTotal = 0;
    let laborTotal = 0;
    document.querySelectorAll('.budget-item').forEach(item => {
        const type = item.querySelector('.item-type')?.value || 'material';
        const qty = parseFloat(item.querySelector('.item-qty')?.value) || 0;
        const price = parseFloat(item.querySelector('.item-price')?.value) || 0;
        let subtotal = 0;
        
        if (type === 'labor') {
            // Mão de obra: horas × taxa horária
            subtotal = qty * price;
            laborTotal += subtotal;
        } else {
            // Material: quantidade × preço unitário
            subtotal = qty * price;
            materialTotal += subtotal;
        }
        
        const subEl = item.querySelector('.item-subtotal');
        if (subEl) subEl.textContent = subtotal.toFixed(2) + '€';
        total += subtotal;
    });
    const display = document.getElementById('techTotalEstimatedDisplay');
    if (display) display.textContent = total.toFixed(2) + ' €';
    const input = document.getElementById('techEstimatedCostInput');
    if (input) {
        input.value = total.toFixed(2);
    }
    return total;
}

function addBudgetItem(description = '', qty = 1, price = 0, type = 'material') {
    const container = document.getElementById('budgetItemsContainer');
    if (!container) return;
    const index = budgetItemCounter++;
    const div = document.createElement('div');
    div.className = 'budget-item grid grid-cols-[auto_1fr_80px_80px_60px_30px] gap-2 items-center';
    div.dataset.index = index;
    const pricePlaceholder = type === 'material' ? 'P. Unit' : '\u20AC/Hora';
    div.innerHTML = `
        <select class="item-type rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-1.5 py-1.5 text-[10px] font-bold uppercase tracking-wider text-[var(--text)] outline-none focus:border-[var(--text)] transition-all cursor-pointer">
            <option value="material" ${type === 'material' ? 'selected' : ''}>🔩 {{ __('Mat.') }}</option>
            <option value="labor" ${type === 'labor' ? 'selected' : ''}>👷 {{ __('M.O.') }}</option>
        </select>
        <input type="text" class="item-desc rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2.5 py-1.5 text-[11px] text-[var(--text)] outline-none focus:border-[var(--text)] transition-all" placeholder="{{ __('Descrição') }}" value="${description}">
        <input type="number" class="item-qty rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-1.5 text-[11px] font-mono text-[var(--text)] outline-none focus:border-[var(--text)] transition-all" placeholder="{{ __('Qtd/H') }}" min="1" value="${qty}">
        <input type="number" step="0.01" class="item-price rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-1.5 text-[11px] font-mono text-[var(--text)] outline-none focus:border-[var(--text)] transition-all" placeholder="${pricePlaceholder}" min="0" value="${price}">
        <span class="item-subtotal text-[11px] font-mono font-bold text-[var(--text)] pt-2 text-right">${(qty * price).toFixed(2)}\u20AC</span>
        <button type="button" class="btn-remove-item text-rose-400 hover:text-rose-500 transition-all cursor-pointer p-1" title="{{ __('Remover item') }}">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    `;
    container.appendChild(div);
    // Atualizar automaticamente sem precisar de event listeners individuais
    recalcBudgetTotal();
}

// 🎯 Event Delegation: captura input/change em itens do orçamento
// Isto funciona para itens existentes e futuros sem precisar de attach manual
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('item-qty') || e.target.classList.contains('item-price') || e.target.classList.contains('item-desc')) {
        recalcBudgetTotal();
    }
});

// 🎯 Para mudanças no select de tipo (Material ↔ Mão de Obra)
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('item-type')) {
        const item = e.target.closest('.budget-item');
        if (!item) return;
        const priceInput = item.querySelector('.item-price');
        const isLabor = e.target.value === 'labor';
        priceInput.placeholder = isLabor ? '€/Hora' : 'P. Unit';
        recalcBudgetTotal();
    }
});

// 🎯 Para cliques no botão de remover (delegação)
document.addEventListener('click', function(e) {
    const removeBtn = e.target.closest('.btn-remove-item');
    if (removeBtn) {
        const item = removeBtn.closest('.budget-item');
        if (item) {
            item.remove();
            recalcBudgetTotal();
        }
    }
});

function getBudgetDetails() {
    const items = [];
    document.querySelectorAll('.budget-item').forEach(item => {
        const type = item.querySelector('.item-type')?.value || 'material';
        const description = item.querySelector('.item-desc')?.value.trim();
        const quantity = parseFloat(item.querySelector('.item-qty')?.value) || 0;
        const unitPrice = parseFloat(item.querySelector('.item-price')?.value) || 0;
        
        if (!description) return;
        
        if (type === 'labor') {
            // Mão de obra: hours × hourly_rate
            items.push({
                type: 'labor',
                description: description,
                hours: quantity,
                hourly_rate: unitPrice
            });
        } else {
            // Material: quantity × unit_price
            items.push({
                type: 'material',
                description: description,
                quantity: quantity,
                unit_price: unitPrice
            });
        }
    });
    return items;
}

function renderBudgetDetailsForAdmin(details) {
    const container = document.getElementById('budgetDetailsContainer');
    const list = document.getElementById('budgetDetailsList');
    const totalSpan = document.getElementById('budgetDetailsTotal');
    if (!container || !list) return;

    if (!details || !Array.isArray(details) || details.length === 0) {
        container.classList.add('hidden');
        return;
    }

    container.classList.remove('hidden');
    let total = 0;
    let materialTotal = 0;
    let laborTotal = 0;
    
    list.innerHTML = details.map((item, i) => {
        const type = item.type || 'material';
        let subtotal = 0;
        let detailStr = '';
        
        if (type === 'labor') {
            const hours = item.hours || 0;
            const rate = item.hourly_rate || 0;
            subtotal = hours * rate;
            laborTotal += subtotal;
            detailStr = `${hours}h × ${rate.toFixed(2)}€/h`;
        } else {
            const qty = item.quantity || 0;
            const price = item.unit_price || 0;
            subtotal = qty * price;
            materialTotal += subtotal;
            detailStr = `${qty} × ${price.toFixed(2)}€`;
        }
        
        total += subtotal;
        
        const icon = type === 'labor' ? '👷' : '🔩';
        const typeLabel = type === 'labor' ? 'M.O.' : 'Mat.';
        
        return `<div class="flex justify-between items-center text-[11px] py-1 ${i > 0 ? 'border-t border-[var(--border)]/50' : ''}">
            <span class="text-[var(--text)] flex-1 truncate mr-2">${icon} ${item.description || 'Item'}</span>
            <span class="text-[var(--text-soft)] mx-2 whitespace-nowrap text-[10px]">${detailStr}</span>
            <span class="font-bold font-mono text-[var(--text)] whitespace-nowrap">${subtotal.toFixed(2)}€</span>
        </div>`;
    }).join('');
    
    // Add summary with material vs labor breakdown
    if (materialTotal > 0 || laborTotal > 0) {
        list.innerHTML += `
            <div class="border-t-2 border-[var(--border)] pt-2 mt-2 space-y-1">
                ${materialTotal > 0 ? `
                <div class="flex justify-between items-center text-[10px]">
                    <span class="text-[var(--text-soft)] font-medium">🔩 {{ __('Total Materiais') }}</span>
                    <span class="font-bold font-mono text-[var(--text)]">${materialTotal.toFixed(2)}€</span>
                </div>` : ''}
                ${laborTotal > 0 ? `
                <div class="flex justify-between items-center text-[10px]">
                    <span class="text-[var(--text-soft)] font-medium">👷 {{ __('Total Mão de Obra') }}</span>
                    <span class="font-bold font-mono text-[var(--text)]">${laborTotal.toFixed(2)}€</span>
                </div>` : ''}
            </div>
        `;
    }
    
    if (totalSpan) totalSpan.textContent = total.toFixed(2) + ' €';
}

document.addEventListener('DOMContentLoaded', () => {
    fetchTicket();
    fetchComments();
    fetchPhotos();

    // ─── Orçamento Detalhado ───
    // Adicionar primeira linha automaticamente para o utilizador começar a preencher
    addBudgetItem('', 1, 0);

    document.getElementById('btnAddBudgetItem')?.addEventListener('click', () => addBudgetItem());

    // Input global apenas para leitura (o total é automático via recalcBudgetTotal)
    document.getElementById('techEstimatedCostInput')?.setAttribute('readonly', 'readonly');

    document.getElementById('btnSubmitEstimatedBudget')?.addEventListener('click', async () => {
        const estimatedBudget = parseFloat(document.getElementById('techEstimatedCostInput')?.value) || 0;
        const budgetDetails = getBudgetDetails();

        if (estimatedBudget <= 0) {
            showMessage("{{ __('Por favor, introduza um custo estimado válido.') }}", true);
            return;
        }

        const payload = { estimatedBudget: estimatedBudget };
        if (budgetDetails.length > 0) {
            payload.budget_details = budgetDetails;
        }

        const res = await fetch(`/tickets/${ticketId}/budget`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const data = await res.json();
        if (res.ok) {
            showMessage(data.message || "{{ __('Orçamento detalhado processado no sistema!') }}");
            await fetchTicket();
        } else {
            showMessage(data.message || "{{ __('Erro ao submeter orçamento detalhado.') }}", true);
        }
    });

    document.getElementById('btnFinishTicket')?.addEventListener('click', async () => {
        const cost = parseFloat(document.getElementById('techTotalCost')?.value) || 0;
        const report = document.getElementById('techFinalReport')?.value.trim();

        if (cost <= 0) {
            showMessage("{{ __('Por favor, introduza o custo final da intervenção.') }}", true);
            return;
        }

        const res = await fetch(`/tickets/${ticketId}/close`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ actual_cost: cost, report: report })
        });

        const data = await res.json();
        if (res.ok) {
            showMessage("{{ __('Intervenção concluída e ticket fechado!') }}");
            await fetchTicket();
        } else {
            showMessage(data.message || "{{ __('Erro ao fechar ticket.') }}", true);
        }
    });

    document.getElementById('btnApproveBudget')?.addEventListener('click', () => handleBudgetAction('approve'));
    document.getElementById('btnRejectBudget')?.addEventListener('click', () => handleBudgetAction('reject'));

    document.getElementById('commentForm')?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const text = document.getElementById('commentText').value.trim();
        if (!text) return;

        const res = await fetch(`/tickets/${ticketId}/comments`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ comment: text })
        });

        if (res.ok) {
            document.getElementById('commentText').value = '';
            fetchComments();
            showMessage("{{ __('Mensagem enviada!') }}");
        }
    });

    document.getElementById('photoForm')?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const fileInput = document.getElementById('photoInput');
        if (!fileInput.files.length) return;

        const formData = new FormData();
        formData.append('photo', fileInput.files[0]);

        const headers = authHeader();
        delete headers['Content-Type'];

        const res = await fetch(`/tickets/${ticketId}/photos`, {
            method: 'POST',
            headers: headers,
            body: formData
        });

        if (res.ok) {
            fileInput.value = '';
            fetchPhotos();
            showMessage("{{ __('Fotografia enviada!') }}");
        }
    });

    // ⚠️ Verificação de urgência ao iniciar reparação (se existir botão "Iniciar" no tech panel)
    // A lógica é disparada quando um técnico tenta iniciar um ticket
    // e o backend responde com 409 + warning
    
    // Estado global para controlar o fluxo de urgência
    window._pendingForceStart = false;
    
    const modal = document.getElementById('priorityWarningModal');
    const btnViewUrgent = document.getElementById('btnViewUrgentTickets');
    const btnForceStart = document.getElementById('btnForceStartTicket');
    const btnCancelPri = document.getElementById('btnCancelPriority');
    
    function showPriorityWarning(urgentCount, currentPriority, ticketId) {
        const modal = document.getElementById('priorityWarningModal');
        const countEl = document.getElementById('priorityWarningCount');
        const currentEl = document.getElementById('priorityWarningCurrent');
        const detailsEl = document.getElementById('priorityWarningDetails');
        
        if (!modal) return;
        
        if (countEl) {
            countEl.textContent = `🔥 ${urgentCount} {{ __('ticket(s) de prioridade mais alta à espera') }}`;
        }
        if (currentEl) {
            currentEl.textContent = `📌 {{ __('Tentou iniciar:') }} ${currentPriority}`;
        }
        if (detailsEl) {
            detailsEl.classList.remove('hidden');
        }
        
        // Guardar referência para usar nos handlers
        window._pendingTicketId = ticketId;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    
    function hidePriorityWarning() {
        const modal = document.getElementById('priorityWarningModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
        window._pendingTicketId = null;
        window._pendingForceStart = false;
    }
    
    // Botão "Ver Tickets Urgentes" → redireciona para lista com filtro por prioridade
    btnViewUrgent?.addEventListener('click', function() {
        hidePriorityWarning();
        window.location.href = '/ui/tickets?priority=alta';
    });
    
    // Botão "Iniciar Mesmo Assim" → força o start com force=true
    btnForceStart?.addEventListener('click', async function() {
        hidePriorityWarning();
        const pendingId = window._pendingTicketId || ticketId;
        if (!pendingId) return;
        
        try {
            const res = await fetch(`/technician/tickets/${pendingId}/start`, {
                method: 'PUT',
                headers: { ...authHeader(), 'Content-Type': 'application/json' },
                body: JSON.stringify({ force: true })
            });
            
            const data = await res.json();
            if (res.ok) {
                showMessage("{{ __('Reparação iniciada com sucesso!') }}");
                await fetchTicket();
            } else {
                showMessage(data.message || "{{ __('Erro ao iniciar reparação.') }}", true);
            }
        } catch (e) {
            showMessage("{{ __('Erro de conexão ao iniciar reparação.') }}", true);
        }
    });
    
    // Botão "✕" → fechar modal
    btnCancelPri?.addEventListener('click', hidePriorityWarning);
    
    // Intercetar o fetch original para começar o startTicket e tratar warning 409
    // Vamos modificar como os pedidos PUT /start funcionam interceptando globalmente
    const originalFetch = window.fetch;
    window.fetch = async function(url, options = {}) {
        const response = await originalFetch(url, options);
        
        // Intercetar respostas 409 (Conflict) de startTicket
        if (response.status === 409) {
            try {
                const data = await response.clone().json();
                if (data.warning && data.urgent_tickets_count > 0) {
                    showPriorityWarning(
                        data.urgent_tickets_count, 
                        data.current_priority || '{{ __("média") }}', 
                        data.ticket_id || ticketId
                    );
                    // Devolve um response modificado para não quebrar o fluxo
                    return new Response(JSON.stringify({ overridden: false, warning: true }), {
                        status: 200,
                        headers: { 'Content-Type': 'application/json' }
                    });
                }
            } catch (e) {
                // Se não conseguir parsear, passa a resposta original
            }
        }
        
        return response;
    };
});
</script>
@endpush

