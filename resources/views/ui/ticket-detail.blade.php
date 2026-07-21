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
            @if(auth()->check() && (auth()->user()->role === 'tecnico' || (auth()->user()->profile->name ?? null) === 'tecnico' || auth()->user()->is_technician || (method_exists(auth()->user(), 'isTechnician') && auth()->user()->isTechnician())))
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
                        </div>
                    </div>
                </div>

                {{-- FORMULÁRIO 1: SUBMETER CUSTO ESTIMADO ($estimatedBudget) --}}
                <div id="techBudgetSubmitCard" class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm space-y-3">
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-2.5">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)]">{{ __('1. Avaliação Orçamental Inicial') }}</h3>
                        <span class="text-[9px] font-mono bg-[var(--surface-2)] text-[var(--text-soft)] px-2 py-0.5 rounded-md font-bold">{{ __('Regra ACCEPT') }}</span>
                    </div>
                    <p class="text-xs text-[var(--text-soft)]">
                        {{ __('Introduza o custo estimado da reparação. Se o valor for superior ao limiar (threshold), o ticket aguardará autorização.') }}
                    </p>

                    <form id="techBudgetForm" class="space-y-3 pt-1">
                        <div>
                            <label for="techEstimatedCostInput" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                                {{ __('Custo Estimado ($estimatedBudget €)') }}
                            </label>
                            <input id="techEstimatedCostInput" type="number" step="0.01" placeholder="{{ __('Ex: 75.00') }}" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs font-mono text-[var(--text)] outline-none focus:border-[var(--text)] transition-all">
                        </div>

                        <button type="button" id="btnSubmitEstimatedBudget" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-primary text-white text-xs font-bold rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer">
                            {{ __('Submeter Validação Orçamental') }}
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
            @if(auth()->check() && (auth()->user()->role === 'admin' || (auth()->user()->profile->name ?? null) === 'admin' || auth()->user()->is_admin || (method_exists(auth()->user(), 'isAdmin') && auth()->user()->isAdmin())))
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
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Custo Solicitado ($estimatedBudget)') }}</span>
                        <p class="text-xs text-[var(--text-soft)] mt-0.5">{{ __('Técnico:') }} <span id="budgetTechnicianName" class="font-semibold text-[var(--text)]">—</span></p>
                    </div>
                    <div class="text-right">
                        <span id="budgetEstimatedCost" class="text-2xl font-black font-mono text-amber-500 dark:text-amber-400">0.00 €</span>
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
            @if(auth()->check() && (auth()->user()->role === 'admin' || (auth()->user()->profile->name ?? null) === 'admin' || auth()->user()->is_admin || (method_exists(auth()->user(), 'isAdmin') && auth()->user()->isAdmin())))
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
        return {{ (auth()->check() && (auth()->user()->is_admin || (method_exists(auth()->user(), 'isAdmin') && auth()->user()->isAdmin()))) ? 'true' : 'false' }};
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

    const priColor = priorityColors[ticket.priority] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]';
    const statusClean = (ticket.status ?? ticket.status_id ?? 'N/A').toString().toLowerCase();

    // Renderização do Badge de Estado conforme especificações do ACCEPT
    let statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-blue-500/10 text-blue-600 dark:text-blue-400 uppercase tracking-tight">${statusLabels[statusClean] ?? ticket.status}</span>`;

    if (statusClean === 'em curso') {
        statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 uppercase tracking-tight">⚙️ {{ __('Em Curso') }}</span>`;
    } else if (statusClean === 'pendente orçamento' || statusClean === 'pendente_orçamento') {
        statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-amber-500/20 text-amber-600 dark:text-amber-400 border border-amber-500/30 uppercase tracking-tight">⏳ {{ __('Pendente Orçamento') }}</span>`;
    } else if (statusClean === 'recusada' || statusClean === 'recusado') {
        statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-rose-500/15 text-rose-600 dark:text-rose-400 border border-rose-500/30 uppercase tracking-tight">❌ {{ __('Recusada') }}</span>`;
    } else if (statusClean === 'fechada' || statusClean === 'fechado') {
        statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-[var(--text-soft)]/10 text-[var(--text-soft)] uppercase tracking-tight">{{ __('Fechada') }}</span>`;
    }

    // Preenchimento dos Detalhes
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

    // -------------------------------------------------------------
    // GESTÃO DINÂMICA DE VISIBILIDADE SEGUNDO O FLUXO DO ACCEPT
    // -------------------------------------------------------------
    const isPendenteOrcamento = statusClean === 'pendente orçamento' || statusClean === 'pendente_orçamento';
    const isRecusada = statusClean === 'recusada' || statusClean === 'recusado';
    const estimatedAmount = parseFloat(ticket.budget_amount || ticket.estimated_cost || ticket.estimatedBudget || 0);
    const threshold = parseFloat(ticket.threshold || 50.00);

    // Gestão do Painel Técnico
    const techCompletionCard = document.getElementById('techCompletionCard');
    const techBlockedCard = document.getElementById('techBlockedCard');
    const techRejectedCard = document.getElementById('techRejectedCard');

    if (techCompletionCard && techBlockedCard && techRejectedCard) {
        // Reset às visibilidades
        techCompletionCard.classList.add('hidden');
        techBlockedCard.classList.add('hidden');
        techRejectedCard.classList.add('hidden');

        if (isRecusada) {
            techRejectedCard.classList.remove('hidden');
            if (ticket.technical_report) {
                document.getElementById('techRejectedReason').innerText = ticket.technical_report;
            }
        } else if (isPendenteOrcamento) {
            techBlockedCard.classList.remove('hidden');
        } else {
            // Se o ticket está "Em Curso" ou "Aberto" (Dentro do limiar ou Aprovado)
            techCompletionCard.classList.remove('hidden');
        }
    }

    // Gestão do Painel Admin (Apenas Visível se "Pendente Orçamento" ou Solicitado)
    const budgetCard = document.getElementById('budgetApprovalCard');
    if (budgetCard && checkCurrentUserIsAdmin()) {
        if (isPendenteOrcamento || ticket.budget_requested) {
            document.getElementById('budgetEstimatedCost').innerText = estimatedAmount.toFixed(2) + ' €';
            document.getElementById('budgetThresholdDisplay').innerText = threshold.toFixed(2) + ' €';
            document.getElementById('budgetTechnicianName').innerText = ticket.technician ? ticket.technician.name : "{{ __('Técnico de Campo') }}";
            budgetCard.classList.remove('hidden');
        } else {
            budgetCard.classList.add('hidden');
        }
    }
}

// Submeter Custo Estimado pelo Técnico ($estimatedBudget)
async function submitEstimatedBudget() {
    const estimatedBudget = parseFloat(document.getElementById('techEstimatedCostInput')?.value) || 0;

    if (estimatedBudget <= 0) {
        showMessage("{{ __('Por favor, introduza um custo estimado válido.') }}", true);
        return;
    }

    const res = await fetch(`/tickets/${ticketId}/budget`, {
        method: 'POST',
        headers: { ...authHeader(), 'Content-Type': 'application/json' },
        body: JSON.stringify({ estimatedBudget: estimatedBudget })
    });

    const data = await res.json();
    if (res.ok) {
        showMessage(data.message || "{{ __('Custo estimado processado no sistema!') }}");
        await fetchTicket();
    } else {
        showMessage(data.message || "{{ __('Erro ao submeter estimativa orçamental.') }}", true);
    }
}

// Ação de Decisão do Administrador (Aprovar / Recusar)
async function handleBudgetAction(action) {
    const feedback = document.getElementById('budgetFeedback')?.value.trim();

    // Regra: Em caso de recusa, exige justificação (technical_report)
    if (action === 'reject' && !feedback) {
        showMessage("{{ __('Ao recusar o orçamento, é obrigatório inserir uma justificação/feedback.') }}", true);
        return;
    }

    const res = await fetch(`/admin/tickets/${ticketId}/budget-decision`, {
        method: 'POST',
        headers: { ...authHeader(), 'Content-Type': 'application/json' },
        body: JSON.stringify({
            action: action, // 'approve' ou 'reject'
            feedback: feedback
        })
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
        const photos = data.photos || data;
        if (!photos || photos.length === 0) {
            sec.innerHTML = `<p class="italic text-[var(--text-soft)]">{{ __('Nenhuma evidência carregada.') }}</p>`;
            return;
        }
        sec.innerHTML = `<div class="grid grid-cols-2 gap-2 pt-1">${photos.map(p => `
            <a href="${p.url}" target="_blank" class="block rounded-xl overflow-hidden border border-[var(--border)] hover:opacity-80 transition-all">
                <img src="${p.url}" class="w-full h-24 object-cover" alt="{{ __('Evidência') }}">
            </a>
        `).join('')}</div>`;
    } catch (e) {
        sec.innerHTML = `<p class="italic text-rose-500">{{ __('Erro ao carregar fotografias.') }}</p>`;
    }
}

// Inicialização de Listeners
document.addEventListener('DOMContentLoaded', () => {
    fetchTicket();
    fetchComments();
    fetchPhotos();

    // Eventos do Técnico
    document.getElementById('btnSubmitEstimatedBudget')?.addEventListener('click', submitEstimatedBudget);

    document.getElementById('btnFinishTicket')?.addEventListener('click', async () => {
        const cost = parseFloat(document.getElementById('techTotalCost')?.value) || 0;
        const report = document.getElementById('techFinalReport')?.value.trim();

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

    // Eventos do Administrador
    document.getElementById('btnApproveBudget')?.addEventListener('click', () => handleBudgetAction('approve'));
    document.getElementById('btnRejectBudget')?.addEventListener('click', () => handleBudgetAction('reject'));

    // Formulário de Comentários
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

    // Formulário de Fotos
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
});
</script>
@endpush
