@extends('ui.layout')

@section('content')
<script>
// Marcar que esta página requer autenticação
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Detalhes do Ticket'),
    'subtitle' => __('Consulte o estado detalhado da ocorrência, aprove orçamentos e atribua técnicos.'),
    'actions' => '<a href="/ui/tickets" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all"><svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> ' . __('Voltar à listagem') . '</a>'
])

    <div class="grid gap-6 xl:grid-cols-[1.2fr_0.8fr] animate-[fadeIn_0.3s_ease-out]">

        {{-- Coluna Esquerda: Informações Principais do Ticket + Menu do Técnico + Aprovação de Orçamento (Admin) --}}
        <div class="space-y-6">

            {{-- Detalhes da Ocorrência --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm h-fit">
                <div id="ticketDetails" class="space-y-4 text-xs text-[var(--text-soft)]">
                    <div class="flex items-center justify-center py-12 gap-2">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        <p class="text-sm font-medium text-[var(--text-soft)]">{{ __('A carregar dados estruturados do ticket...') }}</p>
                    </div>
                </div>
            </div>

            {{-- 🛠️ NOVO: PAINEL DE INTERVENÇÃO E ORÇAMENTO (Apenas Visível para Técnicos) --}}
            @if(($user->profile->name ?? null) === 'tecnico' || ($user->role ?? null) === 'tecnico' || (auth()->user() && auth()->user()->is_technician))
            <div id="techInterventionSection" class="space-y-6">

                {{-- Estado 1: Concluir Intervenção (Autonomia Aprovada / Dentro do Limiar) --}}
                <div id="techCompletionCard" class="rounded-2xl border border-emerald-500/20 bg-[var(--surface)] p-6 shadow-sm space-y-5">
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <div class="space-y-1">
                            <span class="inline-block bg-emerald-500/10 text-emerald-500 text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-md border border-emerald-500/20">
                                {{ __('Autonomia Aprovada') }}
                            </span>
                            <h3 class="text-sm font-bold text-[var(--text)] flex items-center gap-2 pt-1">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.428 15.428a2 2 0 002.143-.231l5.531-5.531a2 2 0 000-2.828l-1.257-1.257a2 2 0 00-2.828 0l-5.531 5.531a2 2 0 00-.231 2.143L3 21l3.571-3.571z"></path>
                                </svg>
                                {{ __('Concluir Intervenção') }}
                            </h3>
                            <p class="text-xs text-[var(--text-soft)]">
                                {{ __('Registe os custos finais das peças/mão de obra para fechar a ocorrência.') }}
                            </p>
                        </div>
                    </div>

                    <form id="techCompletionForm" class="space-y-4">
                        {{-- Custo Total Registado --}}
                        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-4 space-y-2">
                            <div class="flex items-center justify-between">
                                <label for="techTotalCost" class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">
                                    {{ __('Custo Total Registado (€)') }}
                                </label>
                                <span class="text-[10px] font-bold text-emerald-500 bg-emerald-500/10 px-2 py-0.5 rounded-md border border-emerald-500/20">
                                    ✓ ≤ 50.00 € ({{ __('Isento de Admin') }})
                                </span>
                            </div>
                            <input id="techTotalCost" type="number" step="0.01" value="49.00" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-lg font-mono font-extrabold text-emerald-500 outline-none focus:border-emerald-500 transition-all">
                        </div>

                        {{-- Relatório Técnico Final --}}
                        <div>
                            <label for="techFinalReport" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                                {{ __('Relatório Técnico Final') }}
                            </label>
                            <textarea id="techFinalReport" rows="3" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-[var(--text)] transition-all resize-none" placeholder="{{ __('Descreva a intervenção efetuada...') }}">{{ __('Fusível de 10A substituído e testes de carga efetuados com sucesso. Maquinaria pronta a operar.') }}</textarea>
                        </div>

                        <button type="button" id="btnFinishTicket" class="w-full inline-flex items-center justify-center px-4 py-3 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-sm transition-all cursor-pointer gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                            {{ __('Finalizar e Fechar Ticket') }}
                        </button>
                    </form>
                </div>

                {{-- Bloco de Notas Rápidas do Técnico --}}
                <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)]">{{ __('Notas Rápidas') }}</h3>
                    <textarea id="techQuickNotes" rows="2" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-[var(--text)] transition-all resize-none" placeholder="{{ __('Notas de apoio interno...') }}">{{ __('Peça adquirida no stock interno da fábrica.') }}</textarea>
                </div>

                {{-- Estado 2: Submeter Novo Orçamento (Caso necessite de aprovação > 50€) --}}
                <div id="techBudgetSubmitCard" class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm space-y-3">
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-2.5">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)]">{{ __('Submeter Novo Orçamento') }}</h3>
                        <span class="text-[9px] font-mono bg-[var(--surface-2)] text-[var(--text-soft)] px-2 py-0.5 rounded-md font-bold">{{ __('Exemplo') }}</span>
                    </div>
                    <p class="text-xs text-[var(--text-soft)]">
                        {{ __('Se detetar custos de componentes durante a reparação que excedam os 50.00 €:') }}
                    </p>

                    <form id="techBudgetForm" class="space-y-3 pt-1">
                        <div>
                            <label for="techEstimatedCostInput" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                                {{ __('Custo Estimado (€)') }}
                            </label>
                            <input id="techEstimatedCostInput" type="number" step="0.01" placeholder="{{ __('Ex: 150.00') }}" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs font-mono text-[var(--text)] outline-none focus:border-[var(--text)] transition-all">
                        </div>

                        <button type="button" id="btnRequestAuthorization" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-amber-800/80 hover:bg-amber-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all cursor-pointer">
                            {{ __('Solicitar Autorização') }}
                        </button>
                    </form>
                </div>

            </div>
            @endif

            {{-- 💰 PAINEL DE AUTORIZAÇÃO ORÇAMENTAL (Apenas Visível para Admins - INTACTO) --}}
            @if(($user->profile->name ?? null) === 'admin')
            <div id="budgetApprovalCard" class="relative rounded-2xl border border-amber-500/30 bg-[var(--surface)] p-6 shadow-sm space-y-4 overflow-hidden hidden">
                {{-- Etiqueta Superior AÇÃO REQUERIDA --}}
                <div class="absolute top-0 left-0">
                    <span class="inline-block bg-amber-500 text-black text-[9px] font-extrabold uppercase tracking-widest px-3 py-1 rounded-br-xl shadow-sm">
                        {{ __('Ação Requerida') }}
                    </span>
                </div>

                <div class="pt-2">
                    <h3 class="text-sm font-bold text-[var(--text)] flex items-center gap-2">
                        <span class="text-base">💰</span> {{ __('Autorização Orçamental') }}
                    </h3>
                    <p class="text-xs text-[var(--text-soft)] mt-1">
                        {{ __('O custo estimado pela equipa técnica ultrapassa o limiar de autonomia') }} (<strong class="text-[var(--text)] font-mono" id="budgetThreshold">50.00 €</strong>).
                    </p>
                </div>

                {{-- Bloco Custo Estimado --}}
                <div class="rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-4 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Custo Estimado') }}</span>
                        <p class="text-xs text-[var(--text-soft)] mt-0.5">{{ __('Pelo técnico') }} <span id="budgetTechnicianName" class="font-semibold text-[var(--text)]">—</span></p>
                    </div>
                    <div class="text-right">
                        <span id="budgetEstimatedCost" class="text-2xl font-black font-mono text-amber-500 dark:text-amber-400">0.00 €</span>
                    </div>
                </div>

                {{-- Formulário Parecer e Ações --}}
                <form id="budgetForm" class="space-y-3">
                    <div>
                        <label for="budgetFeedback" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                            {{ __('Parecer / Feedback do Admin') }}
                        </label>
                        <textarea id="budgetFeedback" rows="2" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-[var(--text)] transition-all resize-none" placeholder="{{ __('Opcional se aprovar. Obrigatório em caso de recusa...') }}"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3 pt-1">
                        <button type="button" id="btnApproveBudget" class="inline-flex items-center justify-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl shadow-sm transition-all cursor-pointer gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                            {{ __('Aprovar') }}
                        </button>
                        <button type="button" id="btnRejectBudget" class="inline-flex items-center justify-center px-4 py-2.5 bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/30 text-rose-500 text-xs font-bold rounded-xl shadow-sm transition-all cursor-pointer gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                            {{ __('Recusar') }}
                        </button>
                    </div>
                </form>
            </div>
            @endif

        </div>

        {{-- Coluna Direita: Interações, Comentários e Fotos --}}
        <div class="space-y-6">

            {{-- 🤖 ASSISTENTE DE ALOCAÇÃO INTELIGENTE (Injetado via JS apenas para Admins) --}}
            <div id="aiAssistantContainer"></div>

            {{-- Secção de Comentários Internos --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] border-b border-[var(--border)] pb-2.5 mb-3">{{ __('Comentários internos') }}</h3>
                <div id="commentsSection" class="text-xs text-[var(--text-soft)] max-h-60 overflow-y-auto pr-1">
                    <p class="italic py-2">{{ __('A atualizar histórico de notas técnicas...') }}</p>
                </div>
            </div>

            {{-- Formulário para Adicionar Comentário --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-3">{{ __('Adicionar comentário') }}</h3>
                <form id="commentForm" class="space-y-3">
                    <label for="commentText" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Mensagem') }}</label>
                    <textarea id="commentText" rows="3" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-[var(--text)] transition-all resize-none" placeholder="{{ __('Escreva uma nota ou atualização para a equipa...') }}"></textarea>
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-[var(--text)] text-[var(--surface)] text-xs font-bold rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer">
                        {{ __('Enviar comentário') }}
                    </button>
                </form>
            </div>

            {{-- Secção e Upload de Fotografias --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-3">{{ __('Evidências Fotográficas') }}</h3>
                <form id="photoForm" class="space-y-3 border-b border-[var(--border)] pb-4 mb-3">
                    <label for="photoInput" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Anexo de fotografia') }}</label>
                    <div class="flex items-center justify-between w-full rounded-xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5">
                        <input id="photoInput" type="file" accept="image/*" class="block w-full text-xs text-[var(--text-soft)] file:mr-3 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-[var(--text)]/5 dark:file:bg-[var(--surface)]/10 file:text-[var(--text)] cursor-pointer">
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center px-3 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all cursor-pointer">
                        {{ __('Enviar fotografia') }}
                    </button>
                </form>
                <div id="photosSection" class="text-xs text-[var(--text-soft)]">
                    <p class="italic">{{ __('Nenhuma evidência carregada.') }}</p>
                </div>
            </div>

            {{-- Painel de Gestão e Atribuição Manual (Apenas Admin) --}}
            @if(($user->profile->name ?? null) === 'admin')
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-3">{{ __('Painel de Atribuição') }}</h3>
                <div class="space-y-4">
                    <div>
                        <label for="assignTechnicianId" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('ID do Técnico (Manual)') }}</label>
                        <input id="assignTechnicianId" type="number" min="1" placeholder="{{ __('Ex: 12') }}" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-1.5 text-xs text-[var(--text)] outline-none focus:border-[var(--text)] transition-all">
                    </div>

                    <div class="flex flex-wrap gap-2 pt-1">
                        <button id="btnAssignManual" type="button" class="inline-flex items-center justify-center px-4 py-2 bg-[var(--text)] text-[var(--surface)] text-xs font-bold rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer">
                            {{ __('Atribuir Técnico') }}
                        </button>
                        <button id="btnAssignAuto" type="button" class="inline-flex items-center justify-center px-3 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all cursor-pointer">
                            {{ __('Atribuição Automática') }}
                        </button>
                    </div>

                    <div class="border-t border-[var(--border)] pt-3">
                        <button id="btnReopen" type="button" class="w-full inline-flex items-center justify-center px-3 py-2 bg-amber-500/10 hover:bg-amber-500/15 border border-amber-500/20 text-xs font-bold text-amber-600 dark:text-amber-400 rounded-xl transition-all cursor-pointer">
                            {{ __('Reabrir Este Ticket') }}
                        </button>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

    {{-- Sistema Dinâmico de Notificações Internas --}}
    <div id="ticketMessage" class="mt-4 min-h-6 text-xs font-medium transition-all duration-300 px-1"></div>

@endcomponent
@endsection

@push('scripts')
<script>
// Fallback defensivo caso o controller envie $ticket em vez de $ticketId diretamente
const ticketId = {{ json_encode($ticketId ?? $ticket->id ?? null) }};

// Mapeamento de cores para consistência visual global
const priorityColors = {
    baixa:   'border border-emerald-500/10 bg-emerald-500/5 text-emerald-600 dark:text-emerald-400',
    média:   'border border-amber-500/15 bg-amber-500/5 text-amber-600 dark:text-amber-400',
    alta:    'border border-orange-500/15 bg-orange-500/5 text-orange-600 dark:text-orange-400',
    crítica: 'border border-rose-500/20 bg-rose-500/5 text-rose-600 dark:text-rose-400',
};

// Dicionário de tradução para prioridades dinâmicas vindas da API
const priorityLabels = {
    baixa:   "{{ __('Baixa') }}",
    média:   "{{ __('Média') }}",
    alta:    "{{ __('Alta') }}",
    crítica: "{{ __('Crítica') }}"
};

// Dicionário de tradução para estados dinâmicos vindos da API
const statusLabels = {
    'aberto':            "{{ __('Aberto') }}",
    'aberta':            "{{ __('Aberta') }}",
    'em curso':          "{{ __('Em Curso') }}",
    'pendente orçamento':"{{ __('Pendente Orçamento') }}",
    'fechado':           "{{ __('Fechado') }}",
    'fechada':           "{{ __('Fechada') }}"
};

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
        return {{ (auth()->user() && (auth()->user()->is_admin || (method_exists(auth()->user(), 'isAdmin') && auth()->user()->isAdmin()))) ? 'true' : 'false' }};
    }
}

async function fetchTicket(){
    const res = await fetch('/tickets/' + ticketId, {headers: authHeader()});
    if(res.status===401){ alert("{{ __('Autenticação necessária. Faça login.') }}"); window.location='/ui/login'; return; }
    if(!res.ok){ const j=await res.json(); alert(j.message || "{{ __('Erro a carregar ticket') }}"); return; }
    const data = await res.json();
    const ticket = data.ticket;

    const priColor = priorityColors[ticket.priority] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]';
    const statusClean = (ticket.status ?? 'N/A').toLowerCase();

    const statusLabel = statusLabels[statusClean] ?? ticket.status;
    let statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-blue-500/10 text-blue-600 dark:text-blue-400 uppercase tracking-tight">${statusLabel}</span>`;

    if (statusClean === 'em curso') {
        statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-amber-500/10 text-amber-600 dark:text-amber-400 uppercase tracking-tight">{{ __('Em Curso') }}</span>`;
    } else if (statusClean === 'pendente orçamento' || statusClean === 'pendente_orçamento') {
        statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-amber-500/20 text-amber-600 dark:text-amber-400 uppercase tracking-tight border border-amber-500/30">⏳ {{ __('Pendente Orçamento') }}</span>`;
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
                <div class="text-xs bg-[var(--surface-2)] p-3.5 rounded-xl text-[var(--text)] leading-relaxed whitespace-pre-wrap border border-[var(--border)]">${ticket.description || "{{ __('Nenhuma descrição detalhada providenciada.') }}"}</div>
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
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Especialista Atribuído') }}</span>
                    <p class="text-xs font-semibold mt-1 text-[var(--text)]">${ticket.technician ? ticket.technician.name : '<span class="text-rose-500 dark:text-rose-400 font-normal italic">{{ __('Pendente de atribuição') }}</span>'}</p>
                </div>
            </div>

            <div class="border-t border-[var(--border)] pt-4 grid grid-cols-2 gap-3 text-[11px] text-[var(--text-soft)] font-semibold">
                <div class="flex justify-between border-b border-[var(--border)]/50 pb-1.5"><span>{{ __('Abertura:') }}</span> <span class="font-mono text-[var(--text)]">${ticket.opened_at || '—'}</span></div>
                <div class="flex justify-between border-b border-[var(--border)]/50 pb-1.5"><span>{{ __('Em Curso:') }}</span> <span class="font-mono text-[var(--text)]">${ticket.in_progress_at || '—'}</span></div>
                <div class="flex justify-between border-b border-[var(--border)]/50 pb-1.5"><span>{{ __('Fecho:') }}</span> <span class="font-mono text-[var(--text)]">${ticket.closed_at || '—'}</span></div>
                <div class="flex justify-between border-b border-[var(--border)]/50 pb-1.5"><span>{{ __('Reabertura:') }}</span> <span class="font-mono text-[var(--text)]">${ticket.reopened_at || '—'}</span></div>
            </div>
        </div>
    `;

    // Processar Exibição do Cartão de Orçamento se for Admin e houver orçamento / pendência
    if (checkCurrentUserIsAdmin()) {
        fetchAiRecommendation();

        const budgetCard = document.getElementById('budgetApprovalCard');
        if (budgetCard) {
            // Mostra o menu de aprovação se houver orçamento associado ou se o estado for 'pendente orçamento'
            const estimatedCost = ticket.estimated_cost || ticket.orcamento_estimado || 185.00; // Valor dinâmico da API
            const technicianName = ticket.technician ? ticket.technician.name : (ticket.tecnico_nome || "{{ __('Técnico Atribuído') }}");

            document.getElementById('budgetEstimatedCost').innerText = parseFloat(estimatedCost).toFixed(2) + ' €';
            document.getElementById('budgetTechnicianName').innerText = technicianName;

            // Exibir o card
            budgetCard.classList.remove('hidden');
        }
    }
}

async function handleBudgetAction(action) {
    const feedback = document.getElementById('budgetFeedback').value.trim();

    if (action === 'reject' && !feedback) {
        showMessage("{{ __('Por favor, introduza um parecer/justificação ao recusar o orçamento.') }}", true);
        return;
    }

    const res = await fetch(`/admin/tickets/${ticketId}/budget`, {
        method: 'POST',
        headers: {
            ...authHeader(),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            action: action, // 'approve' ou 'reject'
            feedback: feedback
        })
    });

    const data = await res.json();
    if (res.ok) {
        showMessage(action === 'approve' ? "{{ __('Orçamento aprovado com sucesso!') }}" : "{{ __('Orçamento recusado.') }}");
        document.getElementById('budgetFeedback').value = '';
        await fetchTicket();
    } else {
        showMessage(data.message || "{{ __('Erro ao processar ação no orçamento.') }}", true);
    }
}

// Event Listeners para botões do Admin
document.getElementById('btnApproveBudget')?.addEventListener('click', () => handleBudgetAction('approve'));
document.getElementById('btnRejectBudget')?.addEventListener('click', () => handleBudgetAction('reject'));

// Submissão do Formulário de Conclusão de Intervenção pelo Técnico
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
        showMessage("{{ __('Intervenção concluída e ticket fechado com sucesso!') }}");
        await fetchTicket();
    } else {
        showMessage(data.message || "{{ __('Erro ao finalizar ticket.') }}", true);
    }
});

// Pedido de Autorização de Orçamento pelo Técnico (> 50€)
document.getElementById('btnRequestAuthorization')?.addEventListener('click', async () => {
    const estimatedCost = parseFloat(document.getElementById('techEstimatedCostInput')?.value) || 0;

    if (!estimatedCost || estimatedCost <= 0) {
        showMessage("{{ __('Introduza um valor estimado válido.') }}", true);
        return;
    }

    const res = await fetch(`/tickets/${ticketId}/request-budget`, {
        method: 'POST',
        headers: { ...authHeader(), 'Content-Type': 'application/json' },
        body: JSON.stringify({ estimated_cost: estimatedCost })
    });

    const data = await res.json();
    if (res.ok) {
        showMessage("{{ __('Solicitação de autorização orçamental enviada ao Administrador!') }}");
        await fetchTicket();
    } else {
        showMessage(data.message || "{{ __('Erro ao submeter pedido de autorização.') }}", true);
    }
});

async function fetchAiRecommendation() {
    const container = document.getElementById('aiAssistantContainer');
    container.innerHTML = `
        <div class="rounded-2xl border border-primary/20 bg-[var(--surface)] p-5 shadow-sm animate-pulse">
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary">
                <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                {{ __('O Assistente IA está a processar a melhor alocação...') }}
            </div>
        </div>
    `;

    try {
        const res = await fetch('/admin/tickets/' + ticketId, { headers: authHeader() });
        if (!res.ok) throw new Error('API Indisponível');

        const data = await res.json();

        if (data.tecnico_id) {
            container.innerHTML = `
                <div class="rounded-2xl border border-blue-500/20 bg-[var(--surface)] p-5 shadow-sm">
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-2.5 mb-3">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                            {{ __('Assistente de Alocação IA') }}
                        </h3>
                        <span class="text-[9px] font-mono bg-blue-500/10 text-blue-600 px-1.5 py-0.5 rounded-md font-bold uppercase">gpt-4o-mini</span>
                    </div>
                    <div class="space-y-3">
                        <p class="text-xs text-[var(--text-soft)] leading-relaxed">
                            <span class="font-bold text-[var(--text)] block mb-1">💡 {{ __('Sugestão Operacional:') }}</span>
                            ${data.justificacao}
                        </p>
                        <button onclick="approveAiRecommendation(${data.tecnico_id})" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-xl shadow-sm hover:bg-blue-700 transition-all cursor-pointer gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                            {{ __('Aprovar e Atribuir Técnico') }}
                        </button>
                    </div>
                </div>
            `;
        } else {
            container.innerHTML = `
                <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 text-xs text-[var(--text-soft)] italic flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    ${data.justificacao || "{{ __('A IA não conseguiu determinar o técnico ideal de momento.') }}"}
                </div>
            `;
        }
    } catch (err) {
        container.innerHTML = '';
    }
}

async function approveAiRecommendation(tecnicoId) {
    const res = await fetch(`/admin/tickets/${ticketId}/atribuir`, {
        method: 'PATCH',
        headers: {
            ...authHeader(),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ tecnico_id: tecnicoId })
    });

    if (res.ok) {
        document.getElementById('aiAssistantContainer').innerHTML = '';
        await fetchTicket();
        showMessage("{{ __('Técnico alocado com sucesso via Inteligência Artificial!') }}");
    } else {
        const data = await res.json();
        showMessage(data.message || "{{ __('Erro ao processar atribuição da IA.') }}", true);
    }
}

async function fetchComments(){
    const res = await fetch('/tickets/' + ticketId + '/comments', {headers: authHeader()});
    if(res.status===401){ alert("{{ __('Autenticação necessária. Faça login.') }}"); window.location='/ui/login'; return; }
    if(!res.ok){ document.getElementById('commentsSection').innerText = "{{ __('Erro a carregar comentários') }}"; return; }
    const data = await res.json();
    const section = document.getElementById('commentsSection');

    if(!data.comments.length){
        section.innerHTML = '<p class="text-xs italic py-1 opacity-70">{{ __('Nenhum comentário registado neste ticket.') }}</p>';
        return;
    }

    section.innerHTML = '<div class="space-y-2.5">' + data.comments.map(c => `
        <div class="p-3 rounded-xl border border-[var(--border)] bg-[var(--surface-2)]">
            <div class="flex items-center justify-between mb-1 gap-4">
                <span class="font-bold text-[var(--text)]">${c.user ? c.user.name : "{{ __('Técnico') }}"}</span>
                <span class="text-[10px] font-mono text-[var(--text-soft)]">${c.created_at}</span>
            </div>
            <p class="text-xs text-[var(--text)] whitespace-pre-wrap leading-relaxed">${c.comment}</p>
        </div>
    `).join('') + '</div>';
}

async function showMessage(message, error = false){
    const el = document.getElementById('ticketMessage');
    el.className = `mt-4 min-h-6 text-xs font-semibold p-2.5 rounded-xl border ${error ? 'bg-red-500/5 border-red-500/20 text-red-600 dark:text-red-400' : 'bg-emerald-500/5 border-emerald-500/20 text-emerald-600 dark:text-emerald-400'}`;
    el.innerText = message;
    setTimeout(() => { el.innerText = ''; el.className = 'mt-4 min-h-6 text-xs font-medium px-1'; }, 5000);
}

async function fetchPhotos(){
    const res = await fetch('/tickets/' + ticketId + '/photos', {headers: authHeader()});
    if(!res.ok) return;
    const data = await res.json();
    const section = document.getElementById('photosSection');

    if(!data.attachments || !data.attachments.length){
        section.innerHTML = '<div class="rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-4 text-xs text-[var(--text-soft)]">{{ __('Nenhuma fotografia associada.') }}</div>';
        return;
    }

    section.innerHTML = '<div class="grid grid-cols-2 gap-3">' +
        data.attachments.map((a) => {
            const isImage = a.mime_type && a.mime_type.startsWith('image/');
            const imgUrl  = '/storage/' + a.path;
            if (isImage) {
                return `<div class="rounded-xl overflow-hidden border border-[var(--border)] bg-[var(--surface-2)] group shadow-sm">
                    <a href="${imgUrl}" target="_blank" title="${a.file_name}">
                        <img src="${imgUrl}" alt="${a.file_name}" class="w-full h-24 object-cover group-hover:opacity-85 transition-opacity duration-150">
                    </a>
                    <div class="p-1.5 border-t border-[var(--border)]">
                        <p class="text-[10px] text-[var(--text-soft)] truncate font-semibold">${a.file_name}</p>
                    </div>
                </div>`;
            }
            return `<div class="rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-2.5 flex flex-col justify-between shadow-sm min-h-[96px]">
                <p class="font-bold text-[var(--text)] text-[11px] line-clamp-2">${a.file_name}</p>
                <p class="text-[9px] font-mono text-[var(--text-soft)] uppercase tracking-wider mt-2">${a.mime_type || "{{ __('Ficheiro') }}"}</p>
            </div>`;
        }).join('') +
    '</div>';
}

document.getElementById('commentForm')?.addEventListener('submit', async (event) => {
    event.preventDefault();
    const comment = document.getElementById('commentText').value.trim();
    if(!comment){ showMessage("{{ __('Escreva um comentário antes de enviar.') }}", true); return; }

    const res = await fetch('/tickets/' + ticketId + '/comments', {
        method: 'POST',
        headers: { ...authHeader(), 'Content-Type': 'application/json' },
        body: JSON.stringify({comment}),
    });
    const data = await res.json();
    if(!res.ok){ showMessage(data.message || JSON.stringify(data), true); return; }
    document.getElementById('commentText').value = '';
    await fetchComments();
    showMessage("{{ __('Comentário adicionado com sucesso.') }}");
});

document.getElementById('photoForm')?.addEventListener('submit', async (event) => {
    event.preventDefault();
    const input = document.getElementById('photoInput');
    if(!input.files.length){ showMessage("{{ __('Selecione uma fotografia antes de enviar.') }}", true); return; }
    const formData = new FormData();
    formData.append('photo', input.files[0]);

    const res = await fetch('/tickets/' + ticketId + '/photos', {
        method: 'POST',
        headers: authHeader(),
        body: formData,
    });
    const data = await res.json();
    if(!res.ok){ showMessage(data.message || JSON.stringify(data), true); return; }
    input.value = '';
    await fetchPhotos();
    showMessage("{{ __('Fotografia enviada com sucesso.') }}");
});

document.addEventListener('DOMContentLoaded', () => {
    fetchTicket();
    fetchComments();
    fetchPhotos();
});
</script>
@endpush
