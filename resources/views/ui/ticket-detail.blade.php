@extends('ui.layout')

@section('content')
<script>
    window.requireAuthOnLoad = true;
</script>

<div class="mx-auto max-w-7xl space-y-4 animate-[fadeIn_0.3s_ease-out]">
    
    {{-- Cabeçalho & Breadcrumb --}}
    <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-[9px] font-extrabold uppercase tracking-[0.25em] text-primary">{{ __('Dashboard / Tickets') }}</p>
            <h1 id="pageMainTitle" class="text-xl font-black tracking-tight text-[var(--text)] mt-0.5">{{ __('Detalhes do Ticket') }}</h1>
        </div>
        <a href="/ui/tickets" class="inline-flex items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3.5 py-1.5 text-xs font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)] shadow-sm w-fit">
            &larr; {{ __('Voltar à Listagem') }}
        </a>
    </div>

    {{-- Grelha Principal de Detalhes --}}
    <div class="grid gap-4 xl:grid-cols-[1.2fr_0.8fr] items-start">

        {{-- COLUNA ESQUERDA --}}
        <div class="space-y-4">

            {{-- 1. Cartão Principal do Ticket --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm space-y-3">
                
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2.5">
                    <span id="ticketCreatedAt" class="text-[9px] font-mono font-bold uppercase tracking-wider text-[var(--text-soft)]">
                        {{ __('CRIADO A: —') }}
                    </span>
                    <div id="ticketStatusBadgeContainer"></div>
                </div>

                <div>
                    <h2 id="ticketTitleText" class="text-base font-black text-[var(--text)]">—</h2>
                    <div class="mt-2">
                        <span class="text-[9px] font-bold uppercase tracking-[0.15em] text-[var(--text-soft)] block mb-1">{{ __('Descrição do Problema') }}</span>
                        <div id="ticketDescriptionText" class="text-xs bg-[var(--surface-2)] p-3 rounded-xl text-[var(--text)] leading-relaxed whitespace-pre-wrap border border-[var(--border)]">
                            {{ __('A carregar descrição...') }}
                        </div>
                    </div>
                </div>

                {{-- Grelha de Atributos --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2 border-t border-[var(--border)]">
                    <div>
                        <span class="text-[8px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Prioridade') }}</span>
                        <div id="ticketPriorityBadge" class="mt-0.5"></div>
                    </div>
                    <div>
                        <span class="text-[8px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Equipamento') }}</span>
                        <p id="ticketEquipmentText" class="text-xs font-semibold mt-0.5 text-[var(--text)] truncate">—</p>
                    </div>
                    <div>
                        <span class="text-[8px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Sala') }}</span>
                        <p id="ticketRoomText" class="text-xs font-semibold mt-0.5 text-[var(--text)] truncate">—</p>
                    </div>
                    <div>
                        <span class="text-[8px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Especialidade') }}</span>
                        <p id="ticketSpecialtyText" class="text-xs font-semibold mt-0.5 text-[var(--text)] truncate">—</p>
                    </div>
                </div>
            </div>

            {{-- 2. Histórico & Comentários --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] border-b border-[var(--border)] pb-2">{{ __('Histórico & Comentários') }}</h3>
                
                <div id="commentsSection" class="text-xs text-[var(--text-soft)] max-h-40 overflow-y-auto pr-1 space-y-2">
                    <p class="italic py-1 text-center text-[11px]">{{ __('A carregar histórico...') }}</p>
                </div>

                <form id="commentForm" class="flex gap-2 items-center pt-2 border-t border-[var(--border)]">
                    <input id="commentText" type="text" required class="flex-1 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none focus:border-primary transition-all" placeholder="{{ __('Escreva uma mensagem...') }}">
                    <button type="submit" class="inline-flex items-center justify-center rounded-xl px-4 py-2 text-xs font-extrabold uppercase tracking-wider bg-primary text-white hover:opacity-90 transition shadow-sm cursor-pointer whitespace-nowrap">
                        {{ __('Enviar') }}
                    </button>
                </form>
            </div>

            {{-- 3. Evidências Fotográficas --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)]">{{ __('Evidências Fotográficas') }}</h3>
                    <span class="text-[9px] font-bold text-[var(--text-soft)] uppercase tracking-wider">{{ __('Anexos') }}</span>
                </div>
                
                <form id="photoForm" onsubmit="uploadPhoto(event)" class="flex items-center gap-2 border-b border-[var(--border)] pb-3">
                    <label for="photoInput" class="cursor-pointer rounded-xl bg-[var(--surface-2)] border border-[var(--border)] px-3 py-1.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--border)] transition whitespace-nowrap">
                        📷 {{ __('Escolher') }}
                    </label>
                    <input id="photoInput" type="file" accept="image/*" class="hidden" onchange="updatePhotoName(this)">
                    <span id="photoFileName" class="text-xs text-[var(--text-soft)] truncate flex-1 block">{{ __('Nenhum ficheiro') }}</span>
                    
                    <button type="submit" id="btnUploadPhoto" class="py-1.5 px-3 bg-primary hover:opacity-90 text-xs font-bold text-white rounded-xl transition cursor-pointer whitespace-nowrap">
                        {{ __('Enviar') }}
                    </button>
                </form>

                <div id="photosSection" class="text-xs text-[var(--text-soft)]">
                    <p class="italic text-[11px]">{{ __('A carregar imagens...') }}</p>
                </div>
            </div>

        </div>

        {{-- COLUNA DIREITA (Painéis Operacionais e Administrativos) --}}
        <div class="space-y-4">

            @php
                $currentUser = auth()->user();
            @endphp

            {{-- Painel de Administração --}}
            @if($currentUser && method_exists($currentUser, 'isAdmin') && $currentUser->isAdmin())
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-orange-500 bg-orange-500/10 border border-orange-500/20 rounded-lg">
                        {{ __('Painel do Admin') }}
                    </span>
                    <span id="adminTicketId" class="text-xs font-mono font-bold text-[var(--text-soft)]">#{{ $ticketId ?? $ticket->id ?? '' }}</span>
                </div>

                <div>
                    <h3 class="text-xs font-bold text-[var(--text)]">{{ __('Atribuição de Técnico') }}</h3>
                    <p class="text-[11px] text-[var(--text-soft)] mt-0.5 leading-tight">
                        {{ __('Defina manualmente o responsável ou solicite à IA para triagem automática.') }}
                    </p>
                </div>

                <div class="space-y-2 pt-1">
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)] mb-1">{{ __('Selecionar Técnico') }}</label>
                        <select id="assignTechnicianSelect" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none cursor-pointer">
                            <option value="">{{ __('A carregar técnicos...') }}</option>
                        </select>
                    </div>

                    <div class="space-y-2 pt-1">
                        <button id="btnAssignManual" type="button" class="w-full py-2 bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold rounded-xl border border-slate-700 shadow-sm transition cursor-pointer">
                            {{ __('Atribuir Técnico') }}
                        </button>

                        <button id="btnAssignAuto" type="button" class="w-full py-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-extrabold rounded-xl shadow-md transition cursor-pointer flex items-center justify-center gap-1.5">
                            ✨ {{ __('Atribuição Automática (IA)') }}
                        </button>
                    </div>
                </div>
            </div>

            {{-- Validação Orçamental (Admin) --}}
            <div id="adminBudgetApprovalCard" class="hidden rounded-2xl border border-amber-500/40 bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-amber-500 bg-amber-500/10 border border-amber-500/20 rounded-lg">
                        {{ __('Aprovação Orçamental') }}
                    </span>
                    <span id="pendingBudgetAmount" class="text-xs font-black text-amber-400">0.00 €</span>
                </div>

                <div>
                    <h3 class="text-xs font-bold text-[var(--text)]">{{ __('Validar Orçamento Estimado') }}</h3>
                    <p class="text-[11px] text-[var(--text-soft)] mt-0.5 leading-tight">
                        {{ __('O técnico submeteu um pedido acima da autonomia de aprovação.') }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-2 pt-1">
                    <button type="button" onclick="decideBudget('approved')" class="py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl shadow-sm transition cursor-pointer flex items-center justify-center gap-1">
                        ✅ {{ __('Validar') }}
                    </button>
                    <button type="button" onclick="decideBudget('rejected')" class="py-2 bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold rounded-xl shadow-sm transition cursor-pointer flex items-center justify-center gap-1">
                        ❌ {{ __('Rejeitar') }}
                    </button>
                </div>
            </div>
            @endif

            {{-- Painéis Operacionais do Técnico --}}
            @if($currentUser && method_exists($currentUser, 'isTechnician') && $currentUser->isTechnician())
            <div id="techClaimCard" class="hidden rounded-2xl border border-primary/30 bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <span class="text-[9px] font-bold uppercase tracking-widest text-primary bg-primary/10 px-2 py-0.5 rounded-lg">{{ __('Operacional') }}</span>
                    <span class="text-xs font-bold text-amber-500">{{ __('Livre') }}</span>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-[var(--text)]">{{ __('Assumir Ocorrência') }}</h3>
                    <p class="text-[11px] text-[var(--text-soft)] mt-0.5 leading-tight">
                        {{ __('Este ticket não tem técnico atribuído. Registe a ocorrência na sua lista de intervenções.') }}
                    </p>
                </div>
                <button type="button" id="btnClaimTicket" onclick="claimTicket()" class="w-full inline-flex items-center justify-center rounded-xl py-2.5 text-xs font-black uppercase tracking-wider bg-primary text-white hover:opacity-90 shadow-md shadow-orange-500/20 transition cursor-pointer">
                    🔧 {{ __('Assumir este Ticket') }}
                </button>
            </div>

            <div id="techBudgetCard" class="hidden rounded-2xl border border-orange-500/30 bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)]">{{ __('1. Avaliação Orçamental') }}</h3>
                </div>
                <p class="text-[11px] text-[var(--text-soft)] leading-tight">
                    {{ __('Custos superiores a 100€ requerem aprovação prévia da Administração.') }}
                </p>

                <form id="budgetForm" onsubmit="submitBudget(event)" class="space-y-3 pt-1">
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)] mb-1.5">{{ __('Itens do Orçamento') }}</label>
                        <div id="budgetItemsContainer" class="space-y-1.5 mb-2"></div>
                        <button type="button" onclick="addBudgetItemRow()" class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-bold text-orange-500 bg-orange-500/10 border border-orange-500/30 rounded-lg hover:bg-orange-500/20 transition cursor-pointer">
                            + {{ __('ADICIONAR ITEM') }}
                        </button>
                    </div>

                    <div class="p-2.5 bg-[var(--surface-2)] border border-[var(--border)] rounded-xl flex items-center justify-between">
                        <span class="text-[10px] font-bold uppercase text-[var(--text-soft)]">{{ __('Total Estimado') }}</span>
                        <span id="calculatedBudgetTotal" class="text-sm font-extrabold text-[var(--text)]">0.00 €</span>
                    </div>

                    <input type="hidden" id="estimatedBudgetInput" name="estimatedBudget">

                    <button type="submit" class="w-full py-2.5 px-3 bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold rounded-xl shadow-sm transition cursor-pointer">
                        {{ __('Submeter Orçamento') }}
                    </button>
                </form>

                <div class="pt-2 border-t border-[var(--border)]">
                    <button type="button" onclick="releaseTicket()" class="w-full py-2 px-3 bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/30 text-xs font-bold rounded-xl shadow-sm transition cursor-pointer flex items-center justify-center gap-1.5">
                        ↩️ {{ __('Devolver / Libertar Ocorrência') }}
                    </button>
                </div>
            </div>

            <div id="techPendingApprovalCard" class="hidden rounded-2xl border border-amber-500/30 bg-amber-500/5 p-4 shadow-sm space-y-2 text-center">
                <div class="w-8 h-8 rounded-full bg-amber-500/10 text-amber-500 flex items-center justify-center mx-auto text-sm font-bold">⏳</div>
                <h3 class="text-xs font-bold text-[var(--text)]">{{ __('Aguardar Validação Orçamental') }}</h3>
                <p class="text-[11px] text-[var(--text-soft)] leading-tight">
                    {{ __('Orçamento acima de 100.00€. A aguardar validação da gestão.') }}
                </p>
            </div>

            <div id="techWorkCard" class="hidden rounded-2xl border border-emerald-500/30 bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <span class="text-[9px] font-bold uppercase tracking-widest text-emerald-500 bg-emerald-500/10 px-2 py-0.5 rounded-lg">{{ __('A minha intervenção') }}</span>
                    <span class="text-xs font-bold text-emerald-400">{{ __('Autorizado') }}</span>
                </div>
                <p class="text-[11px] text-[var(--text-soft)] leading-tight">
                    {{ __('Trabalhos autorizados. Proceda à intervenção e registe o desfecho.') }}
                </p>
                
                <div class="space-y-2.5 pt-1">
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)] mb-1">{{ __('Custo Final (€)') }}</label>
                        <input type="number" id="techTotalCost" step="0.01" placeholder="0.00" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-1.5 text-xs text-[var(--text)] font-mono">
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)] mb-1">{{ __('Relatório Técnico') }}</label>
                        <textarea id="techFinalReport" rows="2" placeholder="{{ __('Descrição do serviço executado...') }}" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-1.5 text-xs text-[var(--text)] resize-none"></textarea>
                    </div>
                    <button type="button" id="btnFinishTicket" onclick="finishTicket()" class="w-full py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition cursor-pointer">
                        {{ __('Finalizar e Fechar Ticket') }}
                    </button>
                </div>
            </div>

            <div id="techReadOnlyCard" class="hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm space-y-2">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <span class="text-[9px] font-bold uppercase tracking-widest text-slate-400 bg-slate-500/10 px-2 py-0.5 rounded-lg">{{ __('Estado') }}</span>
                    <span class="text-xs font-bold text-amber-500">{{ __('Em Curso') }}</span>
                </div>
                <p class="text-xs text-[var(--text-soft)] text-center py-1">
                    {{ __('Atribuído ao técnico') }} <strong id="assignedTechName" class="text-[var(--text)]">—</strong>.
                </p>
            </div>
            @endif

        </div>
    </div>

    <div id="ticketMessage" class="min-h-5 text-xs font-medium px-1"></div>
</div>

{{-- Modal de Visualização de Imagens --}}
<div id="imagePreviewModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4" onclick="this.classList.add('hidden')">
    <div class="relative max-w-4xl max-h-[90vh] flex flex-col items-center">
        <img id="previewModalImg" src="" alt="Imagem ampliada" class="max-w-full max-h-[85vh] rounded-2xl shadow-2xl object-contain">
        <span class="text-white text-xs mt-3 opacity-70">{{ __('Clique em qualquer lugar para fechar') }}</span>
    </div>
</div>
@endsection

@push('scripts')
<script>
const ticketId = {{ json_encode($ticketId ?? (isset($ticket) ? $ticket->id : null)) }};
const currentUserId = {{ json_encode(auth()->id() ?? null) }};

const priorityBadges = {
    baixa:   '<span class="inline-block px-2 py-0.5 rounded-lg text-[10px] font-black bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 uppercase">Baixa</span>',
    média:   '<span class="inline-block px-2 py-0.5 rounded-lg text-[10px] font-black bg-amber-500/10 text-amber-400 border border-amber-500/20 uppercase">Média</span>',
    alta:    '<span class="inline-block px-2 py-0.5 rounded-lg text-[10px] font-black bg-red-500/15 text-red-500 border border-red-500/30 uppercase">Alta</span>',
    crítica: '<span class="inline-block px-2 py-0.5 rounded-lg text-[10px] font-black bg-purple-500/20 text-purple-400 border border-purple-500/30 uppercase">Crítica</span>'
};

function showMessage(msg, isError = false) {
    const el = document.getElementById('ticketMessage');
    if (!el) return;
    el.innerText = msg;
    el.className = `min-h-5 text-xs font-medium px-1 ${isError ? 'text-rose-400' : 'text-emerald-400'}`;
    setTimeout(() => { if (el) el.innerText = ''; }, 5000);
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
    if (label) {
        label.textContent = input.files && input.files[0] ? input.files[0].name : "{{ __('Nenhum ficheiro') }}";
    }
}

function openImageModal(url) {
    const modal = document.getElementById('imagePreviewModal');
    const img = document.getElementById('previewModalImg');
    if (modal && img) {
        img.src = url;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function renderPhotos(ticket) {
    const sec = document.getElementById('photosSection');
    if (!sec) return;

    const photos = [];

    if (ticket.attachments && Array.isArray(ticket.attachments)) {
        ticket.attachments.forEach(att => {
            if (att.path) {
                const url = att.path.startsWith('http') ? att.path : `/storage/${att.path}`;
                photos.push({ url, name: att.file_name || 'Anexo' });
            }
        });
    }

    const directPath = ticket.photo_path || ticket.image_path;
    if (directPath) {
        const directUrl = directPath.startsWith('http') ? directPath : `/storage/${directPath}`;
        if (!photos.some(p => p.url === directUrl)) {
            photos.unshift({ url: directUrl, name: 'Foto Original' });
        }
    }

    if (photos.length === 0) {
        sec.innerHTML = `<p class="italic text-[11px] text-[var(--text-soft)] text-center py-2">{{ __('Nenhuma evidência carregada.') }}</p>`;
        return;
    }

    sec.innerHTML = `
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 pt-1">
            ${photos.map(p => `
                <div class="group relative rounded-xl border border-[var(--border)] overflow-hidden bg-[var(--surface-2)] aspect-video cursor-pointer" onclick="openImageModal('${p.url}')">
                    <img src="${p.url}" alt="${p.name}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" onerror="this.src='/images/placeholder-image.png'">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="text-white text-[10px] font-bold">🔍 {{ __('Ver') }}</span>
                    </div>
                </div>
            `).join('')}
        </div>
    `;
}

async function uploadPhoto(e) {
    e.preventDefault();
    const input = document.getElementById('photoInput');
    if (!input || !input.files || !input.files[0]) {
        showMessage("{{ __('Selecione um ficheiro de imagem primeiro.') }}", true);
        return;
    }

    const btn = document.getElementById('btnUploadPhoto');
    if (btn) { btn.disabled = true; btn.innerText = "{{ __('A carregar...') }}"; }

    const formData = new FormData();
    formData.append('photo', input.files[0]);
    formData.append('image', input.files[0]);

    try {
        const headers = authHeader();
        delete headers['Content-Type'];

        const res = await fetch(`/tickets/${ticketId}/photos`, {
            method: 'POST',
            headers: headers,
            body: formData
        });

        if (res.ok) {
            showMessage("{{ __('Fotografia adicionada com sucesso!') }}");
            input.value = '';
            document.getElementById('photoFileName').textContent = "{{ __('Nenhum ficheiro') }}";
            await fetchTicket();
        } else {
            const data = await res.json().catch(() => ({}));
            showMessage(data.message || "{{ __('Erro ao enviar imagem.') }}", true);
        }
    } catch (err) {
        showMessage("{{ __('Erro na comunicação com o servidor.') }}", true);
    } finally {
        if (btn) { btn.disabled = false; btn.innerText = "{{ __('Enviar') }}"; }
    }
}

function addBudgetItemRow(desc = '', qty = 1, price = 0, type = 'labor') {
    const container = document.getElementById('budgetItemsContainer');
    if (!container) return;

    const rowId = 'budget_row_' + Date.now() + '_' + Math.floor(Math.random() * 1000);
    const div = document.createElement('div');
    div.id = rowId;
    div.className = "flex flex-wrap items-center gap-1.5 bg-[var(--surface-2)] p-1.5 rounded-xl border border-[var(--border)]";

    div.innerHTML = `
        <select name="type" class="rounded-lg border border-[var(--border)] bg-[var(--surface)] px-1.5 py-1 text-[11px] text-[var(--text)] outline-none">
            <option value="labor" ${type === 'labor' ? 'selected' : ''}>🛠️ M. Obra</option>
            <option value="material" ${type === 'material' ? 'selected' : ''}>📦 Material</option>
        </select>
        <input type="text" name="description" placeholder="Item" value="${desc}" required
            class="flex-1 min-w-[90px] rounded-lg border border-[var(--border)] bg-[var(--surface)] px-2 py-1 text-[11px] text-[var(--text)] outline-none">
        <input type="number" name="quantity" min="1" step="1" value="${qty}" required oninput="calculateBudgetTotal()"
            class="w-12 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-1 py-1 text-[11px] text-[var(--text)] text-center outline-none">
        <input type="number" name="unit_price" min="0" step="0.01" value="${price}" required oninput="calculateBudgetTotal()"
            class="w-16 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-1.5 py-1 text-[11px] text-[var(--text)] text-right outline-none">
        <button type="button" onclick="removeBudgetItemRow('${rowId}')" class="text-rose-400 hover:text-rose-500 font-bold px-1 text-xs cursor-pointer">&times;</button>
    `;

    container.appendChild(div);
    calculateBudgetTotal();
}

function removeBudgetItemRow(rowId) {
    const row = document.getElementById(rowId);
    if (row) {
        row.remove();
        calculateBudgetTotal();
    }
}

function calculateBudgetTotal() {
    const container = document.getElementById('budgetItemsContainer');
    if (!container) return;

    let total = 0;
    const rows = container.querySelectorAll('div[id^="budget_row_"]');
    rows.forEach(row => {
        const qty = parseFloat(row.querySelector('input[name="quantity"]')?.value) || 0;
        const price = parseFloat(row.querySelector('input[name="unit_price"]')?.value) || 0;
        total += (qty * price);
    });

    const formatted = total.toFixed(2);
    const labelTotal = document.getElementById('calculatedBudgetTotal');
    const inputTotal = document.getElementById('estimatedBudgetInput');
    if (labelTotal) labelTotal.innerText = formatted + ' €';
    if (inputTotal) inputTotal.value = formatted;
}

async function submitBudget(e) {
    e.preventDefault();
    const container = document.getElementById('budgetItemsContainer');
    const rows = container ? container.querySelectorAll('div[id^="budget_row_"]') : [];
    
    if (rows.length === 0) {
        showMessage("{{ __('Adicione pelo menos um item ao orçamento.') }}", true);
        return;
    }

    const budget_details = [];
    rows.forEach(row => {
        budget_details.push({
            type: row.querySelector('select[name="type"]')?.value || 'labor',
            description: row.querySelector('input[name="description"]')?.value || 'Item de intervenção',
            quantity: parseFloat(row.querySelector('input[name="quantity"]')?.value) || 1,
            unit_price: parseFloat(row.querySelector('input[name="unit_price"]')?.value) || 0
        });
    });

    calculateBudgetTotal();
    const estimatedBudget = parseFloat(document.getElementById('estimatedBudgetInput')?.value) || 0;

    if (estimatedBudget <= 0) {
        showMessage("{{ __('O valor total deve ser superior a 0.00€.') }}", true);
        return;
    }

    try {
        const res = await fetch(`/tickets/${ticketId}/budget`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ estimatedBudget, budget_details })
        });

        const data = await res.json();
        if (res.ok) {
            showMessage(data.message || "{{ __('Orçamento submetido com sucesso!') }}");
            await fetchTicket();
        } else {
            showMessage(data.message || "{{ __('Erro ao submeter orçamento.') }}", true);
        }
    } catch (e) {
        showMessage("{{ __('Erro ao comunicar com o servidor.') }}", true);
    }
}

async function decideBudget(decision) {
    if (!confirm(decision === 'approved' ? "{{ __('Deseja APROVAR este orçamento?') }}" : "{{ __('Deseja RECUSAR este orçamento?') }}")) return;

    try {
        const res = await fetch(`/admin/tickets/${ticketId}/budget-decision`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ decision })
        });

        if (res.ok) {
            showMessage(decision === 'approved' ? "{{ __('Orçamento APROVADO com sucesso!') }}" : "{{ __('Orçamento RECUSADO.') }}");
            await fetchTicket();
        } else {
            showMessage("{{ __('Erro ao processar decisão orçamental.') }}", true);
        }
    } catch (e) {
        showMessage("{{ __('Erro de ligação com o servidor.') }}", true);
    }
}

async function finishTicket() {
    const cost = parseFloat(document.getElementById('techTotalCost')?.value || 0);
    const report = (document.getElementById('techFinalReport')?.value || '').trim();

    try {
        const res = await fetch(`/tickets/${ticketId}/close`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ actual_cost: cost, report: report })
        });

        if (res.ok) {
            showMessage("{{ __('Ticket concluído e fechado com sucesso!') }}");
            await fetchTicket();
        } else {
            const err = await res.json().catch(() => ({}));
            showMessage(err.message || "{{ __('Erro ao fechar o ticket.') }}", true);
        }
    } catch (e) {
        showMessage("{{ __('Erro de ligação.') }}", true);
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
            select.innerHTML = `<option value="">{{ __('Selecione um técnico...') }}</option>` +
                techs.map(t => `<option value="${t.id}">${t.name} (ID #${t.id})</option>`).join('');
        }
    } catch (e) {
        select.innerHTML = `<option value="">{{ __('Falha ao carregar técnicos') }}</option>`;
    }
}

async function fetchTicket() {
    if (!ticketId) return;

    try {
        const res = await fetch('/tickets/' + ticketId, { headers: authHeader() });
        if (!res.ok) return;

        const data = await res.json();
        const ticket = data.ticket || data;

        document.getElementById('pageMainTitle').innerText = `Detalhes do Ticket #${ticket.id}`;
        document.getElementById('ticketCreatedAt').innerText = `CRIADO A: ${ticket.created_at || '—'}`;
        document.getElementById('ticketTitleText').innerText = ticket.title || '—';
        document.getElementById('ticketDescriptionText').innerText = ticket.description || '—';

        const pBadge = priorityBadges[ticket.priority] || priorityBadges['média'];
        document.getElementById('ticketPriorityBadge').innerHTML = pBadge;
        document.getElementById('ticketEquipmentText').innerText = ticket.equipment ? ticket.equipment.name : '—';
        document.getElementById('ticketRoomText').innerText = ticket.room ? ticket.room.name : '—';
        document.getElementById('ticketSpecialtyText').innerText = ticket.specialty || ticket.equipment?.specialty || 'Mecânica';

        const statusName = typeof ticket.status === 'object' ? ticket.status?.name : (ticket.status || 'Aberto');
        document.getElementById('ticketStatusBadgeContainer').innerHTML = `
            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-black bg-amber-500/10 text-amber-500 border border-amber-500/20 uppercase tracking-wider">
                ${statusName}
            </span>
        `;

        renderPhotos(ticket);

        const assignedTechId = ticket.assigned_to || (ticket.technician ? ticket.technician.id : null);
        
        const techClaimCard = document.getElementById('techClaimCard');
        const techReadOnlyCard = document.getElementById('techReadOnlyCard');
        const techBudgetCard = document.getElementById('techBudgetCard');
        const techPendingApprovalCard = document.getElementById('techPendingApprovalCard');
        const techWorkCard = document.getElementById('techWorkCard');

        if (techClaimCard && techReadOnlyCard && techBudgetCard && techWorkCard && techPendingApprovalCard) {
            techClaimCard.classList.add('hidden');
            techReadOnlyCard.classList.add('hidden');
            techBudgetCard.classList.add('hidden');
            techPendingApprovalCard.classList.add('hidden');
            techWorkCard.classList.add('hidden');

            if (!assignedTechId) {
                techClaimCard.classList.remove('hidden');
            } else if (currentUserId && parseInt(assignedTechId) !== parseInt(currentUserId)) {
                const techNameSpan = document.getElementById('assignedTechName');
                if (techNameSpan) {
                    techNameSpan.innerText = ticket.technician ? `${ticket.technician.name} (#${ticket.technician.id})` : `#${assignedTechId}`;
                }
                techReadOnlyCard.classList.remove('hidden');
            } else {
                const statusSlug = (statusName || '').toLowerCase();
                const budgetStatus = ticket.budget_status;
                const hasRequestedBudget = ticket.budget_requested === true || ticket.budget_requested === 1;

                if (!hasRequestedBudget && (statusSlug.includes('abert') || statusSlug.includes('curso'))) {
                    techBudgetCard.classList.remove('hidden');
                    const container = document.getElementById('budgetItemsContainer');
                    if (container && container.children.length === 0) {
                        addBudgetItemRow('Intervenção técnica padrão', 1, 30, 'labor');
                    }
                } else if (statusSlug.includes('pendente') || budgetStatus === 'pending') {
                    techPendingApprovalCard.classList.remove('hidden');
                } else {
                    techWorkCard.classList.remove('hidden');
                }
            }
        }

        const adminBudgetCard = document.getElementById('adminBudgetApprovalCard');
        if (adminBudgetCard) {
            const statusSlug = (statusName || '').toLowerCase();
            if (statusSlug.includes('pendente') || ticket.budget_status === 'pending') {
                adminBudgetCard.classList.remove('hidden');
                const pBudget = document.getElementById('pendingBudgetAmount');
                if (pBudget) pBudget.innerText = (parseFloat(ticket.budget_amount) || 0).toFixed(2) + ' €';
            } else {
                adminBudgetCard.classList.add('hidden');
            }
        }
    } catch (e) {
        console.error('Erro ao carregar detalhes do ticket:', e);
    }
}

async function claimTicket() {
    if (!confirm("{{ __('Deseja assumir este ticket?') }}")) return;
    try {
        const res = await fetch(`/tickets/${ticketId}/claim`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' }
        });

        if (res.ok) {
            showMessage("{{ __('Ticket assumido com sucesso!') }}");
            await fetchTicket();
        } else {
            const data = await res.json().catch(() => ({}));
            showMessage(data.message || "{{ __('Erro ao assumir o ticket.') }}", true);
        }
    } catch (e) {
        showMessage("{{ __('Erro de ligação.') }}", true);
    }
}

async function releaseTicket() {
    if (!confirm("{{ __('Tem a certeza que deseja libertar esta ocorrência?') }}")) return;
    try {
        const res = await fetch(`/tickets/${ticketId}/release`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' }
        });

        if (res.ok) {
            showMessage("{{ __('Ocorrência libertada com sucesso!') }}");
            await fetchTicket();
        } else {
            showMessage("{{ __('Erro ao libertar a ocorrência.') }}", true);
        }
    } catch (e) {
        showMessage("{{ __('Erro de ligação.') }}", true);
    }
}

async function fetchComments() {
    const sec = document.getElementById('commentsSection');
    if (!sec || !ticketId) return;
    try {
        const res = await fetch(`/tickets/${ticketId}/comments`, { headers: authHeader() });
        if (!res.ok) return;
        const data = await res.json();
        const comments = data.comments || data;
        if (!comments || comments.length === 0) {
            sec.innerHTML = `<p class="italic py-2 text-center text-[var(--text-soft)]">{{ __('Nenhum comentário registado.') }}</p>`;
            return;
        }
        sec.innerHTML = comments.map(c => `
            <div class="border-b border-[var(--border)]/50 py-1.5 space-y-0.5">
                <div class="flex justify-between font-bold text-[var(--text)]">
                    <span>${c.user ? c.user.name : "{{ __('Sistema') }}"}</span>
                    <span class="font-mono text-[9px] text-[var(--text-soft)]">${c.created_at || ''}</span>
                </div>
                <p class="text-[var(--text-soft)] text-xs">${c.comment || c.message || ''}</p>
            </div>
        `).join('');
    } catch (e) {
        sec.innerHTML = `<p class="italic py-2 text-center text-[var(--text-soft)]">{{ __('Nenhum comentário registado.') }}</p>`;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    fetchTicket();
    fetchComments();
    loadTechnicians();

    document.getElementById('commentForm')?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const textInput = document.getElementById('commentText');
        const text = textInput ? textInput.value.trim() : '';
        if (!text) return;

        const res = await fetch(`/tickets/${ticketId}/comments`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ comment: text })
        });
        if (res.ok) {
            if (textInput) textInput.value = '';
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
            showMessage("{{ __('Erro ao atribuir técnico.') }}", true);
        }
    });

    document.getElementById('btnAssignAuto')?.addEventListener('click', async () => {
        const res = await fetch(`/admin/tickets/${ticketId}/assign`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({})
        });
        if (res.ok) {
            showMessage("{{ __('Técnico atribuído automaticamente via IA!') }}");
            await fetchTicket();
        } else {
            showMessage("{{ __('Erro ao atribuir via IA.') }}", true);
        }
    });
});
</script>
@endpush