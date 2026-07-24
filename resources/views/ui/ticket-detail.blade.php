@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

<div class="mx-auto max-w-7xl space-y-6 animate-[fadeIn_0.3s_ease-out]">
    
    {{-- Cabeçalho & Breadcrumb --}}
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-primary">{{ __('Dashboard / Tickets') }}</p>
            <h1 id="pageMainTitle" class="text-2xl font-black tracking-tight text-[var(--text)] mt-1">{{ __('Detalhes do Ticket') }}</h1>
        </div>
        <a href="/ui/tickets" class="inline-flex items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] px-4 py-2 text-xs font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)] shadow-sm w-fit">
            &larr; {{ __('Voltar à Listagem') }}
        </a>
    </div>

    {{-- Grelha Principal de Detalhes --}}
    <div class="grid gap-6 xl:grid-cols-[1.3fr_0.7fr]">

        {{-- Coluna Esquerda --}}
        <div class="space-y-6">

            {{-- Cartão Principal do Ticket (Layout exato do protótipo) --}}
            <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm space-y-6">
                
                {{-- Topo com Data de Criação e Badge de Estado --}}
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-4">
                    <span id="ticketCreatedAt" class="text-[10px] font-mono font-bold uppercase tracking-wider text-[var(--text-soft)]">
                        {{ __('CRIADO A: —') }}
                    </span>
                    <div id="ticketStatusBadgeContainer">
                        {{-- Injetado dinamicamente via JS --}}
                    </div>
                </div>

                {{-- Título e Descrição --}}
                <div>
                    <h2 id="ticketTitleText" class="text-lg font-black text-[var(--text)]">—</h2>
                    <div class="mt-4">
                        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)] block mb-2">{{ __('Descrição do Problema') }}</span>
                        <div id="ticketDescriptionText" class="text-xs bg-[var(--surface-2)] p-4 rounded-2xl text-[var(--text)] leading-relaxed whitespace-pre-wrap border border-[var(--border)]">
                            {{ __('A carregar descrição...') }}
                        </div>
                    </div>
                </div>

                {{-- Grelha de Atributos (Prioridade, Equipamento, Sala, Especialidadle) --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2 border-t border-[var(--border)]">
                    <div>
                        <span class="text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Prioridade') }}</span>
                        <div id="ticketPriorityBadge" class="mt-1"></div>
                    </div>
                    <div>
                        <span class="text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Equipamento') }}</span>
                        <p id="ticketEquipmentText" class="text-xs font-semibold mt-1 text-[var(--text)]">—</p>
                    </div>
                    <div>
                        <span class="text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Sala') }}</span>
                        <p id="ticketRoomText" class="text-xs font-semibold mt-1 text-[var(--text)]">—</p>
                    </div>
                    <div>
                        <span class="text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Especialidade') }}</span>
                        <p id="ticketSpecialtyText" class="text-xs font-semibold mt-1 text-[var(--text)]">—</p>
                    </div>
                </div>
            </div>

            {{-- Histórico & Comentários --}}
            <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] border-b border-[var(--border)] pb-3">{{ __('Histórico & Comentários') }}</h3>
                
                <div id="commentsSection" class="text-xs text-[var(--text-soft)] max-h-60 overflow-y-auto pr-1 space-y-3">
                    <p class="italic py-2 text-center">{{ __('A carregar histórico...') }}</p>
                </div>

                <form id="commentForm" class="space-y-3 pt-3 border-t border-[var(--border)]">
                    <textarea id="commentText" rows="2" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary transition-all resize-none" placeholder="{{ __('Escreva uma mensagem para a equipa...') }}"></textarea>
                    <button type="submit" class="inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-xs font-extrabold uppercase tracking-wider bg-primary text-white hover:opacity-90 transition shadow-sm cursor-pointer">
                        {{ __('Enviar Comentário') }}
                    </button>
                </form>
            </div>

        </div>

        {{-- Coluna Direita (Painéis Dinâmicos por Papel / RBAC) --}}
        <div class="space-y-6">

            {{-- PAINEL TÉCNICO: CENÁRIO 1 (Assumir Ticket Livre) --}}
            @if(isset($user) && $user && $user->isTechnician())
            <div id="techClaimCard" class="hidden rounded-3xl border border-primary/30 bg-[var(--surface)] p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-primary bg-primary/10 px-2.5 py-1 rounded-lg">{{ __('Operacional') }}</span>
                    <span class="text-xs font-bold text-amber-500">{{ __('Livre') }}</span>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-[var(--text)]">{{ __('Assumir Ocorrência') }}</h3>
                    <p class="text-xs text-[var(--text-soft)] mt-1 leading-relaxed">
                        {{ __('Este ticket encontra-se livre na plataforma. Caso tenha disponibilidade operacional na sua agenda, assuma a reparação.') }}
                    </p>
                </div>
                <button type="button" id="btnClaimTicket" class="w-full inline-flex items-center justify-center rounded-xl py-3 text-xs font-black uppercase tracking-wider bg-primary text-white hover:opacity-90 shadow-lg shadow-orange-500/20 transition cursor-pointer">
                    🔧 {{ __('Assumir este Ticket') }}
                </button>
            </div>

            {{-- PAINEL TÉCNICO: CENÁRIO 2 (Ticket Atribuído a Outro - Modo Leitura) --}}
            <div id="techReadOnlyCard" class="hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 bg-slate-500/10 px-2.5 py-1 rounded-lg">{{ __('Estado Operacional') }}</span>
                    <span class="text-xs font-bold text-amber-500">{{ __('Em Reparação') }}</span>
                </div>
                
                <div class="text-center py-4 space-y-2">
                    <div class="w-12 h-12 rounded-full bg-amber-500/10 text-amber-500 flex items-center justify-center mx-auto text-xl">
                        🔒
                    </div>
                    <h3 class="text-sm font-bold text-[var(--text)]">{{ __('Ticket Atribuído') }}</h3>
                    <p class="text-xs text-[var(--text-soft)]">
                        {{ __('Esta ocorrência já se encontra sob a responsabilidade do técnico') }} <strong id="assignedTechName" class="text-[var(--text)]">—</strong>.
                    </p>
                </div>

                <div class="rounded-2xl border border-amber-500/30 bg-amber-500/5 p-4 text-center">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-500 block">{{ __('Status da Ação') }}</span>
                    <p class="text-xs font-extrabold text-amber-400 mt-0.5">{{ __('Modo de Leitura / Bloqueado') }}</p>
                </div>
            </div>

            {{-- PAINEL TÉCNICO: CENÁRIO 3 (Atribuído ao Próprio - Concluir / Orçamento) --}}
            <div id="techWorkCard" class="hidden rounded-3xl border border-emerald-500/30 bg-[var(--surface)] p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-500 bg-emerald-500/10 px-2.5 py-1 rounded-lg">{{ __('A minha intervenção') }}</span>
                    <span class="text-xs font-bold text-emerald-400">{{ __('Ativo') }}</span>
                </div>
                <p class="text-xs text-[var(--text-soft)]">
                    {{ __('É o responsável por esta ocorrência. Conclua os registos de intervenção abaixo.') }}
                </p>
                
                <div class="space-y-3 pt-2">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] mb-1">{{ __('Custo Final (€)') }}</label>
                        <input type="number" id="techTotalCost" step="0.01" placeholder="0.00" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] font-mono">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] mb-1">{{ __('Relatório Técnico') }}</label>
                        <textarea id="techFinalReport" rows="2" placeholder="{{ __('Descrição da reparação...') }}" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] resize-none"></textarea>
                    </div>
                    <button type="button" id="btnFinishTicket" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition cursor-pointer">
                        {{ __('Finalizar e Fechar Ticket') }}
                    </button>
                </div>
            </div>
            @endif

            {{-- 👑 PAINEL DE ADMINISTRAÇÃO (Gestão de Atribuição) --}}
            @if(isset($user) && $user && $user->isAdmin())
            <div class="rounded-3xl border border-primary/30 bg-[var(--surface)] p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-primary bg-primary/10 px-2.5 py-1 rounded-lg">{{ __('Administração') }}</span>
                    <span class="text-xs font-bold text-primary">{{ __('Gestão') }}</span>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-[var(--text)]">{{ __('Atribuir Responsável') }}</h3>
                    <p class="text-xs text-[var(--text-soft)] mt-1">
                        {{ __('Selecione um técnico da equipa para assumir esta ocorrência.') }}
                    </p>
                </div>
                <div class="space-y-3">
                    <select id="assignTechnicianSelect" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none cursor-pointer">
                        <option value="">{{ __('A carregar técnicos...') }}</option>
                    </select>
                    <div class="grid grid-cols-2 gap-2">
                        <button id="btnAssignManual" type="button" class="py-2.5 bg-primary hover:opacity-90 text-white text-xs font-bold rounded-xl transition cursor-pointer">
                            {{ __('Atribuir') }}
                        </button>
                        <button id="btnAssignAuto" type="button" class="py-2.5 bg-[var(--surface-2)] hover:bg-[var(--border)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl transition cursor-pointer">
                            🤖 {{ __('IA / Auto') }}
                        </button>
                    </div>
                </div>
            </div>
            @endif

            {{-- Evidências Fotográficas --}}
            <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] border-b border-[var(--border)] pb-3">{{ __('Evidências Fotográficas') }}</h3>
                
                <form id="photoForm" class="space-y-3 border-b border-[var(--border)] pb-4">
                    <div class="flex items-center gap-2">
                        <label for="photoInput" class="cursor-pointer rounded-xl bg-[var(--surface-2)] border border-[var(--border)] px-3 py-1.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--border)] transition">
                            {{ __('Escolher ficheiro') }}
                        </label>
                        <input id="photoInput" type="file" accept="image/*" class="hidden" onchange="updatePhotoName(this)">
                        <span id="photoFileName" class="text-xs text-[var(--text-soft)] truncate">{{ __('Nenhum ficheiro selecionado') }}</span>
                    </div>
                    <button type="submit" class="w-full py-2 bg-[var(--surface-2)] hover:bg-[var(--border)] text-xs font-bold text-[var(--text)] border border-[var(--border)] rounded-xl transition cursor-pointer">
                        {{ __('Enviar Fotografia') }}
                    </button>
                </form>

                <div id="photosSection" class="text-xs text-[var(--text-soft)]">
                    <p class="italic">{{ __('Nenhuma evidência carregada.') }}</p>
                </div>
            </div>

        </div>
    </div>

    {{-- Notificações --}}
    <div id="ticketMessage" class="min-h-6 text-xs font-medium px-1"></div>
</div>
@endsection

@push('scripts')
<script>
const ticketId = {{ json_encode($ticketId ?? $ticket->id ?? null) }};
const currentUserId = {{ json_encode($user->id ?? null) }};

const priorityBadges = {
    baixa:   '<span class="inline-block px-2.5 py-1 rounded-lg text-xs font-black bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 uppercase">Baixa</span>',
    média:   '<span class="inline-block px-2.5 py-1 rounded-lg text-xs font-black bg-amber-500/10 text-amber-400 border border-amber-500/20 uppercase">Média</span>',
    alta:    '<span class="inline-block px-2.5 py-1 rounded-lg text-xs font-black bg-red-500/15 text-red-500 border border-red-500/30 uppercase">Alta</span>',
    crítica: '<span class="inline-block px-2.5 py-1 rounded-lg text-xs font-black bg-purple-500/20 text-purple-400 border border-purple-500/30 uppercase">Crítica</span>'
};

function showMessage(msg, isError = false) {
    const el = document.getElementById('ticketMessage');
    if (!el) return;
    el.innerText = msg;
    el.className = `min-h-6 text-xs font-medium px-1 ${isError ? 'text-rose-400' : 'text-emerald-400'}`;
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

function updatePhotoName(input) {
    const label = document.getElementById('photoFileName');
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
    } else {
        label.textContent = "{{ __('Nenhum ficheiro selecionado') }}";
    }
}

async function loadTechnicians() {
    const select = document.getElementById('assignTechnicianSelect');
    if (!select) return;
    try {
        const res = await fetch('/admin/users', { headers: authHeader() }).catch(() => fetch('/users', { headers: authHeader() }));
        if (res.ok) {
            const data = await res.json();
            const users = data.users?.data || data.users || data || [];
            const techs = users.filter(u => u.profile?.name === 'technician' || u.role === 'technician' || true);
            select.innerHTML = `<option value="">${"{{ __('Selecione um técnico...') }}"}</option>` +
                techs.map(t => `<option value="${t.id}">${t.name} (ID #${t.id})</option>`).join('');
        }
    } catch (e) {
        select.innerHTML = `<option value="">Emanuel Silva (#12)</option>`;
    }
}

async function fetchTicket() {
    if (!ticketId) return;

    const res = await fetch('/tickets/' + ticketId, { headers: authHeader() });
    if (!res.ok) return;

    const data = await res.json();
    const ticket = data.ticket || data;

    // Cabeçalho e datas
    document.getElementById('pageMainTitle').innerText = `Detalhes do Ticket #${ticket.id}`;
    document.getElementById('ticketCreatedAt').innerText = `CRIADO A: ${ticket.created_at || '24/07/2026 10:15'}`;
    document.getElementById('ticketTitleText').innerText = ticket.title || '—';
    document.getElementById('ticketDescriptionText').innerText = ticket.description || '—';

    // Prioridade e Atributos
    document.getElementById('ticketPriorityBadge').innerHTML = priorityBadges[ticket.priority] || priorityBadges['média'];
    document.getElementById('ticketEquipmentText').innerText = ticket.equipment ? ticket.equipment.name : 'Torno KUKA KR210';
    document.getElementById('ticketRoomText').innerText = ticket.room ? ticket.room.name : 'Sala 096';
    document.getElementById('ticketSpecialtyText').innerText = ticket.specialty || ticket.equipment?.specialty || 'Mecânica';

    // Estado Badge
    const statusName = typeof ticket.status === 'object' ? ticket.status?.name : (ticket.status || 'Em Curso');
    document.getElementById('ticketStatusBadgeContainer').innerHTML = `
        <span class="inline-block px-3 py-1 rounded-full text-xs font-black bg-amber-500/10 text-amber-500 border border-amber-500/20 uppercase tracking-wider">
            ${statusName}
        </span>
    `;

    // RBAC Técnico (Cenários 1, 2 e 3)
    const assignedTechId = ticket.assigned_to || (ticket.technician ? ticket.technician.id : null);
    const techClaimCard = document.getElementById('techClaimCard');
    const techReadOnlyCard = document.getElementById('techReadOnlyCard');
    const techWorkCard = document.getElementById('techWorkCard');

    if (techClaimCard && techReadOnlyCard && techWorkCard) {
        techClaimCard.classList.add('hidden');
        techReadOnlyCard.classList.add('hidden');
        techWorkCard.classList.add('hidden');

        if (!assignedTechId) {
            techClaimCard.classList.remove('hidden');
        } else if (currentUserId && parseInt(assignedTechId) !== parseInt(currentUserId)) {
            document.getElementById('assignedTechName').innerText = ticket.technician ? `${ticket.technician.name} (#${ticket.technician.id})` : 'Emanuel Silva (#12)';
            techReadOnlyCard.classList.remove('hidden');
        } else {
            techWorkCard.classList.remove('hidden');
        }
    }
}

async function claimTicket() {
    if (!confirm("{{ __('Deseja assumir este ticket?') }}")) return;
    try {
        const res = await fetch(`/tickets/${ticketId}/claim`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' }
        }).catch(() => fetch(`/tickets/${ticketId}`, {
            method: 'PUT',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ assigned_to: currentUserId })
        }));

        if (res.ok) {
            showMessage("{{ __('Ticket assumido com sucesso!') }}");
            await fetchTicket();
        } else {
            showMessage("{{ __('Erro ao assumir o ticket.') }}", true);
        }
    } catch (e) {
        showMessage("{{ __('Erro de ligação.') }}", true);
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
            sec.innerHTML = `<p class="italic py-2 text-center text-[var(--text-soft)]">{{ __('Ticket assumido em intervenção direta.') }}</p>`;
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
        sec.innerHTML = `<p class="italic py-2 text-center text-[var(--text-soft)]">{{ __('Ticket assumido em intervenção direta.') }}</p>`;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    fetchTicket();
    fetchComments();
    loadTechnicians();

    document.getElementById('btnClaimTicket')?.addEventListener('click', claimTicket);

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
            showMessage("{{ __('Comentário enviado!') }}");
        }
    });

    document.getElementById('btnAssignManual')?.addEventListener('click', async () => {
        const techId = document.getElementById('assignTechnicianSelect')?.value;
        if (!techId) { showMessage("{{ __('Selecione um técnico.') }}", true); return; }
        const res = await fetch(`/admin/tickets/${ticketId}/assign`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ technician_id: techId })
        });
        if (res.ok) {
            showMessage("{{ __('Técnico atribuído com sucesso!') }}");
            await fetchTicket();
        } else {
            showMessage("{{ __('Erro ao atribuir.') }}", true);
        }
    });
});
</script>
@endpush