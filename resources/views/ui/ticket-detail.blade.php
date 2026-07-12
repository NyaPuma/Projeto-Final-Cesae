@extends('ui.layout')

@section('content')
<script>
// Marcar que esta página requer autenticação
window.requireAuthOnLoad = true;
</script>

@component('ui.partials('page-card', [
    'title' => 'Detalhes do Ticket',
    'subtitle' => 'Consulte o estado detalhado da ocorrência, atribua técnicos e partilhe comentários internos.',
    'actions' => '<a href="/ui/tickets" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all"><svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> Voltar à listagem</a>'
])

    <div class="grid gap-6 xl:grid-cols-[1.2fr_0.8fr] animate-[fadeIn_0.3s_ease-out]">

        {{-- Coluna Esquerda: Informações Principais do Ticket --}}
        <div class="rounded-2xl border border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm h-fit">
            <div id="ticketDetails" class="space-y-4 text-xs text-[var(--text-soft)]">
                <div class="flex items-center justify-center py-12 gap-2">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <p class="text-sm font-medium text-[var(--text-soft)]">A carregar dados estruturados do ticket...</p>
                </div>
            </div>
        </div>

        {{-- Coluna Direita: Interações, Comentários e Fotos --}}
        <div class="space-y-6">

            {{-- 🤖 ASSISTENTE DE ALOCAÇÃO INTELIGENTE (Injetado via JS apenas para Admins) --}}
            <div id="aiAssistantContainer"></div>

            {{-- Secção de Comentários Internos --}}
            <div class="rounded-2xl border border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] border-b border-[var(--border)] pb-2.5 mb-3">Comentários internos</h3>
                <div id="commentsSection" class="text-xs text-[var(--text-soft)] max-h-60 overflow-y-auto pr-1">
                    <p class="italic py-2">A atualizar histórico de notas técnicas...</p>
                </div>
            </div>

            {{-- Formulário para Adicionar Comentário --}}
            <div class="rounded-2xl border border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-3">Adicionar comentário</h3>
                <form id="commentForm" class="space-y-3">
                    <label for="commentText" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Mensagem</label>
                    <textarea id="commentText" rows="3" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-[var(--text)] transition-all resize-none" placeholder="Escreva uma nota ou atualização para a equipa..."></textarea>
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-[var(--text)] text-[var(--surface)] text-xs font-bold rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer">
                        Enviar comentário
                    </button>
                </form>
            </div>

            {{-- Secção e Upload de Fotografias --}}
            <div class="rounded-2xl border border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-3">Evidências Fotográficas</h3>
                <form id="photoForm" class="space-y-3 border-b border-[var(--border)] pb-4 mb-3">
                    <label for="photoInput" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Anexo de fotografia</label>
                    <div class="flex items-center justify-between w-full rounded-xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5">
                        <input id="photoInput" type="file" accept="image/*" class="block w-full text-xs text-[var(--text-soft)] file:mr-3 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-[var(--text)]/5 dark:file:bg-[var(--surface)]/10 file:text-[var(--text)] cursor-pointer">
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center px-3 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all cursor-pointer">
                        Enviar fotografia
                    </button>
                </form>
                <div id="photosSection" class="text-xs text-[var(--text-soft)]">
                    <p class="italic">Nenhuma evidência carregada.</p>
                </div>
            </div>

            {{-- Painel de Gestão e Atribuição Manual --}}
            <div class="rounded-2xl border border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] mb-3">Painel de Atribuição</h3>
                <div class="space-y-4">
                    <div>
                        <label for="assignTechnicianId" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">ID do Técnico (Manual)</label>
                        <input id="assignTechnicianId" type="number" min="1" placeholder="Ex: 12" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-1.5 text-xs text-[var(--text)] outline-none focus:border-[var(--text)] transition-all">
                    </div>

                    <div class="flex flex-wrap gap-2 pt-1">
                        <button id="btnAssignManual" type="button" class="inline-flex items-center justify-center px-4 py-2 bg-[var(--text)] text-[var(--surface)] text-xs font-bold rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer">
                            Atribuir Técnico
                        </button>
                        <button id="btnAssignAuto" type="button" class="inline-flex items-center justify-center px-3 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all cursor-pointer">
                            Atribuição Automática
                        </button>
                    </div>

                    <div class="border-t border-[var(--border)] pt-3">
                        <button id="btnReopen" type="button" class="w-full inline-flex items-center justify-center px-3 py-2 bg-amber-500/10 hover:bg-amber-500/15 border border-amber-500/20 text-xs font-bold text-amber-600 dark:text-amber-400 rounded-xl transition-all cursor-pointer">
                            Reabrir Este Ticket
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sistema Dinâmico de Notificações Internas --}}
    <div id="ticketMessage" class="mt-4 min-h-6 text-xs font-medium transition-all duration-300 px-1"></div>

@endcomponent
@endsection

@push('scripts')
<script>
const ticketId = {{ json_encode($ticketId) }};

// Mapeamento de cores para consistência visual global usando backgrounds translúcidos nativos
const priorityColors = {
    baixa:   'border border-emerald-500/10 bg-emerald-500/5 text-emerald-600 dark:text-emerald-400',
    média:   'border border-amber-500/15 bg-amber-500/5 text-amber-600 dark:text-amber-400',
    alta:    'border border-orange-500/15 bg-orange-500/5 text-orange-600 dark:text-orange-400',
    crítica: 'border border-rose-500/20 bg-rose-500/5 text-rose-600 dark:text-rose-400',
};

function authHeader(){
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) headers['X-Auth-Token'] = token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

    return headers;
}

// Helper utilitário para decodificar JWT localmente e saber se o utilizador atual é Admin
function checkCurrentUserIsAdmin() {
    try {
        const token = localStorage.getItem('api_token');
        if (!token) return false;
        // Divide as 3 secções do JWT e decodifica a secção Payload
        const base64Url = token.split('.')[1];
        const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        const payload = JSON.parse(window.atob(base64));
        // Ajusta para o campo exato onde o vosso AuthController guarda a role (ex: role, profile, ou profile_id)
        return payload.role === 'admin' || payload.isAdmin === true;
    } catch (e) {
        // Fallback defensivo por Blade caso o token local use encriptação opaca
        return {{ auth()->user()?->isAdmin() ? 'true' : 'false' }};
    }
}

async function fetchTicket(){
    const res = await fetch('/tickets/' + ticketId, {headers: authHeader()});
    if(res.status===401){ alert('Autenticação necessária. Faça login.'); window.location='/ui/login'; return; }
    if(!res.ok){ const j=await res.json(); alert(j.message || 'Erro a carregar ticket'); return; }
    const data = await res.json();
    const ticket = data.ticket;

    const priColor = priorityColors[ticket.priority] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]';
    const statusClean = (ticket.status ?? 'N/A').toLowerCase();

    let statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-blue-500/10 text-blue-600 dark:text-blue-400 uppercase tracking-tight">${ticket.status}</span>`;
    if (statusClean === 'em curso') {
        statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-amber-500/10 text-amber-600 dark:text-amber-400 uppercase tracking-tight">Em Curso</span>`;
    } else if (statusClean === 'fechada' || statusClean === 'fechado') {
        statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-[var(--text-soft)]/10 text-[var(--text-soft)] uppercase tracking-tight">Fechada</span>`;
    }

    document.getElementById('ticketDetails').innerHTML = `
        <div class="border-b border-[var(--border)] pb-4 mb-5">
            <div class="flex items-center justify-between gap-4">
                <span class="text-[10px] font-mono font-bold text-[var(--text-soft)] uppercase tracking-wider bg-[var(--surface-2)] px-2 py-0.5 rounded-lg">ID Ocorrência #${ticket.id}</span>
                <div class="flex gap-1.5">${statusBadge}</div>
            </div>
            <h2 class="text-base font-bold text-[var(--text)] mt-3">${ticket.title}</h2>
        </div>

        <div class="space-y-5">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block mb-1.5">Descrição da Ocorrência</span>
                <div class="text-xs bg-[var(--surface-2)] p-3.5 rounded-xl text-[var(--text)] leading-relaxed whitespace-pre-wrap border border-[var(--border)]">${ticket.description || 'Nenhuma descrição detalhada providenciada.'}</div>
            </div>

            <div class="grid grid-cols-2 gap-x-4 gap-y-4 pt-2">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">Nível de Prioridade</span>
                    <span class="inline-block mt-1 px-2 py-0.5 rounded-lg text-[11px] font-bold uppercase tracking-tight ${priColor}">${ticket.priority}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">Equipamento / Ativo</span>
                    <p class="text-xs font-semibold mt-1 text-[var(--text)]">${ticket.equipment ? ticket.equipment.name : '<span class="text-[var(--text-soft)] font-normal">—</span>'}</p>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">Sala / Localização</span>
                    <p class="text-xs font-semibold mt-1 text-[var(--text)]">${ticket.room ? ticket.room.name : '<span class="text-[var(--text-soft)] font-normal">—</span>'}</p>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">Especialista Atribuído</span>
                    <p class="text-xs font-semibold mt-1 text-[var(--text)]">${ticket.technician ? ticket.technician.name : '<span class="text-rose-500 dark:text-rose-400 font-normal italic">Pendente de atribuição</span>'}</p>
                </div>
            </div>

            <div class="border-t border-[var(--border)] pt-4 grid grid-cols-2 gap-3 text-[11px] text-[var(--text-soft)] font-semibold">
                <div class="flex justify-between border-b border-[var(--border)]/50 pb-1.5"><span>Abertura:</span> <span class="font-mono text-[var(--text)]">${ticket.opened_at || '—'}</span></div>
                <div class="flex justify-between border-b border-[var(--border)]/50 pb-1.5"><span>Em Curso:</span> <span class="font-mono text-[var(--text)]">${ticket.in_progress_at || '—'}</span></div>
                <div class="flex justify-between border-b border-[var(--border)]/50 pb-1.5"><span>Fecho:</span> <span class="font-mono text-[var(--text)]">${ticket.closed_at || '—'}</span></div>
                <div class="flex justify-between border-b border-[var(--border)]/50 pb-1.5"><span>Reabertura:</span> <span class="font-mono text-[var(--text)]">${ticket.reopened_at || '—'}</span></div>
            </div>
        </div>
    `;

    // Ativar e renderizar o bloco da IA de forma assíncrona apenas se o utilizador for Admin
    if (checkCurrentUserIsAdmin()) {
        fetchAiRecommendation();
    }
}

async function fetchAiRecommendation() {
    const container = document.getElementById('aiAssistantContainer');
    container.innerHTML = `
        <div class="rounded-2xl border border-primary/20 bg-[var(--surface)] p-5 shadow-sm animate-pulse">
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary">
                <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                O Assistente IA está a processar a melhor alocação...
            </div>
        </div>
    `;

    try {
        // Consome o endpoint real do vosso AdminTicketController que liga ao AIService
        const res = await fetch('/admin/tickets/' + ticketId, { headers: authHeader() });
        if (!res.ok) throw new Error('API Indisponível');
        
        // Como o endpoint do Admin devolve o JSON mastigado pelo prompt da OpenAI
        const data = await res.json();
        
        if (data.tecnico_id) {
            container.innerHTML = `
                <div class="rounded-2xl border border-blue-500/20 bg-[var(--surface)] p-5 shadow-sm">
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-2.5 mb-3">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                            Assistente de Alocação IA
                        </h3>
                        <span class="text-[9px] font-mono bg-blue-500/10 text-blue-600 px-1.5 py-0.5 rounded-md font-bold uppercase">gpt-4o-mini</span>
                    </div>
                    <div class="space-y-3">
                        <p class="text-xs text-[var(--text-soft)] leading-relaxed">
                            <span class="font-bold text-[var(--text)] block mb-1">💡 Sugestão Operacional:</span>
                            ${data.justificacao}
                        </p>
                        <button onclick="approveAiRecommendation(${data.tecnico_id})" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-xl shadow-sm hover:bg-blue-700 transition-all cursor-pointer gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                            Aprovar e Atribuir Técnico
                        </button>
                    </div>
                </div>
            ];
        } else {
            container.innerHTML = `
                <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 text-xs text-[var(--text-soft)] italic flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    ${data.justificacao || 'A IA não conseguiu determinar o técnico ideal de momento.'}
                </div>
            `;
        }
    } catch (err) {
        container.innerHTML = ''; // Oculta defensivamente se houver falha de rede
    }
}

async function approveAiRecommendation(tecnicoId) {
    const res = await fetch(`/admin/tickets/${ticketId}/atribuir`, {
        method: 'POST', // Usamos POST com spoofing do PATCH nativo do Laravel
        headers: authHeader(),
        body: JSON.stringify({
            _method: 'PATCH',
            tecnico_id: tecnicoId
        })
    });
    
    if (res.ok) {
        document.getElementById('aiAssistantContainer').innerHTML = '';
        await fetchTicket();
        showMessage('Técnico alocado com sucesso via Inteligência Artificial!');
    } else {
        const data = await res.json();
        showMessage(data.message || 'Erro ao processar atribuição da IA.', true);
    }
}

async function fetchComments(){
    const res = await fetch('/tickets/' + ticketId + '/comments', {headers: authHeader()});
    if(res.status===401){ alert('Autenticação necessária. Faça login.'); window.location='/ui/login'; return; }
    if(!res.ok){ document.getElementById('commentsSection').innerText = 'Erro a carregar comentários'; return; }
    const data = await res.json();
    const section = document.getElementById('commentsSection');

    if(!data.comments.length){
        section.innerHTML = '<p class="text-xs italic py-1 opacity-70">Nenhum comentário registado neste ticket.</p>';
        return;
    }

    section.innerHTML = '<div class="space-y-2.5">' + data.comments.map(c => `
        <div class="p-3 rounded-xl border border-[var(--border)] bg-[var(--surface-2)]">
            <div class="flex items-center justify-between mb-1 gap-4">
                <span class="font-bold text-[var(--text)]">${c.user ? c.user.name : 'Técnico'}</span>
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
        section.innerHTML = '<div class="rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-4 text-xs text-[var(--text-soft)]">Nenhuma fotografia associada.</div>';
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
                <p class="text-[9px] font-mono text-[var(--text-soft)] uppercase tracking-wider mt-2">${a.mime_type || 'Ficheiro'}</p>
            </div>`;
        }).join('') +
    '</div>';
}

async function postComment(event){
    event.preventDefault();
    const comment = document.getElementById('commentText').value.trim();
    if(!comment){ showMessage('Escreva um comentário antes de enviar.', true); return; }
    const res = await fetch('/tickets/' + ticketId + '/comments', {
        method: 'POST',
        headers: authHeader(),
        body: JSON.stringify({comment}),
    });
    const data = await res.json();
    if(!res.ok){ showMessage(data.message || JSON.stringify(data), true); return; }
    document.getElementById('commentText').value = '';
    await fetchComments();
    showMessage('Comentário adicionado com sucesso.');
}

async function uploadPhoto(event){
    event.preventDefault();
    const input = document.getElementById('photoInput');
    if(!input.files.length){ showMessage('Selecione uma fotografia antes de enviar.', true); return; }
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
    showMessage('Fotografia enviada com sucesso.');
}

async function assignTechnician(manual){
    const payload = {};
    if(manual){
        const technicianId = document.getElementById('assignTechnicianId').value;
        if(!technicianId){ showMessage('Informe o ID do técnico para atribuição manual.', true); return; }
        payload.technician_id = parseInt(technicianId, 10);
    }

    const res = await fetch('/tickets/' + ticketId + '/assign-technician', {
        method: 'POST',
        headers: authHeader(),
        body: JSON.stringify(payload),
    });
    const data = await res.json();
    if(!res.ok){ showMessage(data.message || JSON.stringify(data), true); return; }
    document.getElementById('assignTechnicianId').value = '';
    await fetchTicket();
    showMessage('Técnico atribuído com sucesso.');
}

async function reopenTicket(){
    const res = await fetch('/tickets/' + ticketId + '/reopen', {
        method: 'POST',
        headers: authHeader(),
    });
    const data = await res.json();
    if(!res.ok){ showMessage(data.message || JSON.stringify(data), true); return; }
    await fetchTicket();
    showMessage('Ticket reaberto com sucesso.');
}

window.addEventListener('load', () => {
    fetchTicket();
    fetchComments();
    fetchPhotos();
    document.getElementById('commentForm').addEventListener('submit', postComment);
    document.getElementById('photoForm').addEventListener('submit', uploadPhoto);
    document.getElementById('btnAssignManual').addEventListener('click', () => assignTechnician(true));
    document.getElementById('btnAssignAuto').addEventListener('click', () => assignTechnician(false));
    document.getElementById('btnReopen').addEventListener('click', reopenTicket);
});
</script>
@endpush