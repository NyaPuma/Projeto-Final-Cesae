/**
 * Ticket Detail Module
 * Handles ticket detail view with budget management, technician actions, and admin approvals
 */

import { authHeader, authHeaderJson, authHeaderFormData, isAdmin } from '../utils/api.js';

let ticketId = null;
let budgetItemCounter = 0;

const priorityColors = {
    baixa: 'border border-emerald-500/10 bg-emerald-500/5 text-emerald-600 dark:text-emerald-400',
    média: 'border border-amber-500/15 bg-amber-500/5 text-amber-600 dark:text-amber-400',
    alta: 'border border-orange-500/15 bg-orange-500/5 text-orange-600 dark:text-orange-400',
    crítica: 'border border-purple-500/20 bg-purple-500/5 text-purple-600 dark:text-purple-400',
};

const priorityLabels = {
    baixa: 'Baixa',
    média: 'Média',
    alta: 'Alta',
    crítica: 'Crítica'
};

const statusLabels = {
    'aberto': 'Aberto',
    'aberta': 'Aberta',
    'em curso': 'Em Curso',
    'fechado': 'Fechado',
    'fechada': 'Fechada'
};

function showMessage(msg, isError = false) {
    const el = document.getElementById('ticketMessage');
    if (!el) return;
    el.innerText = msg;
    el.className = `mt-4 min-h-6 text-xs font-medium transition-all duration-300 px-1 ${isError ? 'text-rose-500' : 'text-emerald-500'}`;
    setTimeout(() => { el.innerText = ''; }, 5000);
}

async function fetchTicket() {
    if (!ticketId) {
        console.error("ID do Ticket não fornecido.");
        return;
    }

    const res = await fetch('/tickets/' + ticketId, { headers: authHeader() });
    if(res.status === 401) { alert("Autenticação necessária. Faça login."); window.location='/ui/login'; return; }
    if(!res.ok) { const j = await res.json(); alert(j.message || "Erro a carregar ticket"); return; }

    const data = await res.json();
    const ticket = data.ticket || data;

    const statusName = typeof ticket.status === 'object' && ticket.status !== null
        ? ticket.status.name
        : (typeof ticket.status === 'string' ? ticket.status : null);
    const statusClean = (statusName || '').toLowerCase();

    const priColor = priorityColors[ticket.priority] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]';

    let statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-blue-500/10 text-blue-600 dark:text-blue-400 uppercase tracking-tight">${statusLabels[statusClean] ?? statusName ?? 'N/A'}</span>`;

    if (statusClean === 'em curso') {
        statusBadge = `<span class="inline-block px-2 py-0.5 rounded-lg text-[11px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 uppercase tracking-tight">⚙️ Em Curso</span>`;
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
                <div class="text-xs bg-[var(--surface-2)] p-3.5 rounded-xl text-[var(--text)] leading-relaxed whitespace-pre-wrap border border-[var(--border)]">${ticket.description || "Nenhuma descrição providenciada."}</div>
            </div>

            <div class="grid grid-cols-2 gap-x-4 gap-y-4 pt-2">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">Nível de Prioridade</span>
                    <span class="inline-block mt-1 px-2 py-0.5 rounded-lg text-[11px] font-bold uppercase tracking-tight ${priColor}">${priorityLabels[ticket.priority] ?? ticket.priority}</span>
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
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">Técnico Atribuído</span>
                    <p class="text-xs font-semibold mt-1 text-[var(--text)]">${ticket.technician ? ticket.technician.name : '<span class="text-rose-500 font-normal italic">Pendente de atribuição</span>'}</p>
                </div>
            </div>
        </div>
    `;

    const isClosed = statusClean === 'fechada' || statusClean === 'fechado';
    const isAberta = statusClean === 'aberta' || statusClean === 'aberto';
    const isEmCurso = statusClean === 'em curso' || statusClean === 'em curso';
    const estimatedAmount = parseFloat(ticket.budget_amount || ticket.estimated_cost || ticket.estimatedBudget || 0);
    const threshold = parseFloat(ticket.threshold || 50.00);

    const budgetWasSubmitted = ticket.budget_requested === true || ticket.budget_requested === 1 || ticket.budget_requested === '1';
    const budgetIsPending = ticket.budget_status === 'pending';
    const budgetIsApproved = ticket.budget_status === 'approved';
    const budgetWasAutoApproved = budgetWasSubmitted && !ticket.budget_status;

    const techStartCard = document.getElementById('techStartCard');
    const techCompletionCard = document.getElementById('techCompletionCard');
    const techBlockedCard = document.getElementById('techBlockedCard');
    const techRejectedCard = document.getElementById('techRejectedCard');
    const techApprovedCard = document.getElementById('techApprovedCard');
    const techBudgetSubmitCard = document.getElementById('techBudgetSubmitCard');

    if (techStartCard && techCompletionCard && techBlockedCard && techRejectedCard && techApprovedCard && techBudgetSubmitCard) {
        techStartCard.classList.add('hidden');
        techCompletionCard.classList.add('hidden');
        techBlockedCard.classList.add('hidden');
        techRejectedCard.classList.add('hidden');
        techApprovedCard.classList.add('hidden');
        techBudgetSubmitCard.classList.add('hidden');

        if (budgetIsPending) {
            techBlockedCard.classList.remove('hidden');
        } else if (isClosed) {
            techApprovedCard.classList.remove('hidden');
            techCompletionCard.classList.add('hidden');
            const approvedTitleEl = techApprovedCard?.querySelector('h3');
            if (approvedTitleEl) approvedTitleEl.textContent = 'Reparação Concluída';
            const approvedTextEl = techApprovedCard?.querySelector('p');
            if (approvedTextEl) approvedTextEl.textContent = 'O ticket foi fechado com sucesso.';
        } else if (budgetIsApproved || budgetWasAutoApproved) {
            techApprovedCard.classList.remove('hidden');
            techCompletionCard.classList.remove('hidden');
        } else if (isEmCurso && !budgetWasSubmitted) {
            techBudgetSubmitCard.classList.remove('hidden');
        } else if (isAberta && !budgetIsPending) {
            techStartCard.classList.remove('hidden');
        } else {
            techBudgetSubmitCard.classList.remove('hidden');
        }
    }

    const budgetCard = document.getElementById('budgetApprovalCard');
    if (budgetCard && checkCurrentUserIsAdmin()) {
        if (budgetIsPending) {
            document.getElementById('budgetEstimatedCost').innerText = estimatedAmount.toFixed(2) + ' €';
            document.getElementById('budgetThresholdDisplay').innerText = threshold.toFixed(2) + ' €';
            document.getElementById('budgetTechnicianName').innerText = ticket.technician ? ticket.technician.name : "Técnico de Campo";
            budgetCard.classList.remove('hidden');
            renderBudgetDetailsForAdmin(ticket.budget_details);
        } else {
            budgetCard.classList.add('hidden');
        }
    }
}

async function handleBudgetAction(action) {
    const feedback = document.getElementById('budgetFeedback')?.value.trim();

    if (action === 'reject' && !feedback) {
        showMessage("Ao recusar o orçamento, é obrigatório inserir uma justificação/feedback.", true);
        return;
    }

    const res = await fetch(`/admin/tickets/${ticketId}/approve-budget`, {
        method: 'PATCH',
        headers: { ...authHeader(), 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: action, feedback: feedback })
    });

    const data = await res.json();
    if (res.ok) {
        showMessage(action === 'approve' ? "Orçamento Aprovado! Ticket desbloqueado para Em Curso." : "Orçamento Recusado. Reparação Abortada.");
        if (document.getElementById('budgetFeedback')) document.getElementById('budgetFeedback').value = '';
        await fetchTicket();
    } else {
        showMessage(data.message || "Erro ao processar decisão orçamental.", true);
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
            sec.innerHTML = `<p class="italic py-1 text-[var(--text-soft)]">Sem mensagens registadas.</p>`;
            return;
        }
        sec.innerHTML = comments.map(c => `
            <div class="border-b border-[var(--border)]/50 py-2 space-y-1">
                <div class="flex justify-between font-bold text-[var(--text)]">
                    <span>${c.user ? c.user.name : "Sistema"}</span>
                    <span class="font-mono text-[10px] text-[var(--text-soft)]">${c.created_at || ''}</span>
                </div>
                <p class="text-[var(--text-soft)]">${c.comment || c.message || ''}</p>
            </div>
        `).join('');
    } catch (e) {
        sec.innerHTML = `<p class="italic py-1 text-rose-500">Erro ao carregar histórico.</p>`;
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
            sec.innerHTML = `<p class="italic text-[var(--text-soft)]">Nenhuma evidência carregada.</p>`;
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
                    <button data-action="delete-photo" data-photo-id="${a.id}" type="button" class="absolute top-1 right-1 bg-red-500/80 hover:bg-red-600 text-white rounded-lg p-1 shadow-sm transition-all cursor-pointer z-10" title="Remover fotografia">
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
                    <button data-action="delete-photo" data-photo-id="${a.id}" type="button" class="flex-shrink-0 bg-red-500/80 hover:bg-red-600 text-white rounded-lg p-1 shadow-sm transition-all cursor-pointer" title="Remover ficheiro">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>
                    </button>
                </div>
                <p class="text-[9px] font-mono text-[var(--text-soft)] uppercase tracking-wider mt-2">${a.mime_type || "Ficheiro"}</p>
            </div>`;
        }).join('')}</div>`;
    } catch (e) {
        sec.innerHTML = `<p class="italic text-rose-500">Erro ao carregar fotografias.</p>`;
    }
}

async function deletePhoto(photoId) {
    if (!confirm("Tem a certeza que pretende remover esta fotografia?")) return;

    const res = await fetch('/tickets/' + ticketId + '/photos/' + photoId, {
        method: 'DELETE',
        headers: authHeader(),
    });
    const data = await res.json();
    if (!res.ok) { showMessage(data.message || "Erro ao remover fotografia.", true); return; }
    await fetchPhotos();
    showMessage("Fotografia removida com sucesso.");
}

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
            subtotal = qty * price;
            laborTotal += subtotal;
        } else {
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
    const pricePlaceholder = type === 'material' ? 'P. Unit' : '€/Hora';
    div.innerHTML = `
        <select class="item-type rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-1.5 py-1.5 text-[10px] font-bold uppercase tracking-wider text-[var(--text)] outline-none focus:border-[var(--text)] transition-all cursor-pointer">
            <option value="material" ${type === 'material' ? 'selected' : ''}>🔩 Materiais</option>
            <option value="labor" ${type === 'labor' ? 'selected' : ''}>👷 Mão de Obra</option>
        </select>
        <input type="text" class="item-desc rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2.5 py-1.5 text-[11px] text-[var(--text)] outline-none focus:border-[var(--text)] transition-all" placeholder="Descrição" value="${description}">
        <input type="number" class="item-qty rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2.5 py-1.5 text-[11px] font-mono text-[var(--text)] outline-none focus:border-[var(--text)] transition-all" placeholder="Qtd/H" min="1" value="${qty}">
        <input type="number" step="0.01" class="item-price rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2.5 py-1.5 text-[11px] font-mono text-[var(--text)] outline-none focus:border-[var(--text)] transition-all" placeholder="${pricePlaceholder}" min="0" value="${price}">
        <span class="item-subtotal text-[11px] font-mono font-bold text-[var(--text)] pt-2 text-right">${(qty * price).toFixed(2)}€</span>
        <button type="button" data-action="remove-budget-item" class="btn-remove-item text-rose-400 hover:text-rose-500 transition-all cursor-pointer p-1" title="Remover item">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    `;
    container.appendChild(div);
    recalcBudgetTotal();
}

function getBudgetDetails() {
    const items = [];
    document.querySelectorAll('.budget-item').forEach(item => {
        const type = item.querySelector('.item-type')?.value || 'material';
        const description = item.querySelector('.item-desc')?.value.trim();
        const quantity = parseFloat(item.querySelector('.item-qty')?.value) || 0;
        const unitPrice = parseFloat(item.querySelector('.item-price')?.value) || 0;
        
        if (!description) return;
        
        if (type === 'labor') {
            items.push({
                type: 'labor',
                description: description,
                hours: quantity,
                hourly_rate: unitPrice
            });
        } else {
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
        const typeLabel = type === 'labor' ? 'Mão de Obra' : 'Materiais';
        
        return `<div class="flex justify-between items-center text-[11px] py-1 ${i > 0 ? 'border-t border-[var(--border)]/50' : ''}">
            <span class="text-[var(--text)] flex-1 truncate mr-2">${icon} ${item.description || 'Item'}</span>
            <span class="text-[var(--text-soft)] mx-2 whitespace-nowrap text-[10px]">${detailStr}</span>
            <span class="font-bold font-mono text-[var(--text)] whitespace-nowrap">${subtotal.toFixed(2)}€</span>
        </div>`;
    }).join('');
    
    if (materialTotal > 0 || laborTotal > 0) {
        list.innerHTML += `
            <div class="border-t-2 border-[var(--border)] pt-2 mt-2 space-y-1">
                ${materialTotal > 0 ? `
                <div class="flex justify-between items-center text-[10px]">
                    <span class="text-[var(--text-soft)] font-medium">🔩 Total Materiais</span>
                    <span class="font-bold font-mono text-[var(--text)]">${materialTotal.toFixed(2)}€</span>
                </div>` : ''}
                ${laborTotal > 0 ? `
                <div class="flex justify-between items-center text-[10px]">
                    <span class="text-[var(--text-soft)] font-medium">👷 Total Mão de Obra</span>
                    <span class="font-bold font-mono text-[var(--text)]">${laborTotal.toFixed(2)}€</span>
                </div>` : ''}
            </div>
        `;
    }
    
    if (totalSpan) totalSpan.textContent = total.toFixed(2) + ' €';
}

function showPriorityWarning(urgentCount, currentPriority, ticketIdParam, actionType = 'start', myUrgentCount = 0) {
    const modal = document.getElementById('priorityWarningModal');
    const countEl = document.getElementById('priorityWarningCount');
    const currentEl = document.getElementById('priorityWarningCurrent');
    const actionEl = document.getElementById('priorityWarningAction');
    
    if (!modal) return;
    
    if (countEl) {
        let countText = `🔥 ${urgentCount} ticket(s) de prioridade mais alta à espera`;
        if (myUrgentCount > 0) {
            countText += `<br><span class="text-amber-600 dark:text-amber-400 font-bold">👤 ${myUrgentCount} desse(s) estão atribuídos a si</span>`;
        }
        countEl.innerHTML = countText;
    }
    if (currentEl) {
        currentEl.textContent = `📌 Ticket atual: ${currentPriority}`;
    }
    if (actionEl) {
        if (actionType === 'close') {
            actionEl.textContent = 'Está prestes a fechar este ticket ignorando os mais urgentes.';
        } else {
            actionEl.textContent = 'Está prestes a iniciar este ticket ignorando os mais urgentes.';
        }
    }
    
    window._pendingTicketId = ticketIdParam;
    window._pendingActionType = actionType;
    
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
    window._pendingActionType = 'start';
}

function setupEventDelegation() {
    // Budget item input changes
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('item-qty') || e.target.classList.contains('item-price') || e.target.classList.contains('item-desc')) {
            recalcBudgetTotal();
        }
    });

    // Budget item type changes
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

    // Remove budget item
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

    // Delete photo
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-action="delete-photo"]');
        if (btn) {
            const photoId = btn.dataset.photoId;
            if (photoId) deletePhoto(parseInt(photoId));
        }
    });
}

function init() {
    // Get ticket ID from data attribute
    const container = document.querySelector('[data-ticket-id]');
    if (container) {
        ticketId = parseInt(container.dataset.ticketId);
    }

    fetchTicket();
    fetchComments();
    fetchPhotos();

    addBudgetItem('', 1, 0);

    document.getElementById('btnAddBudgetItem')?.addEventListener('click', () => addBudgetItem());
    document.getElementById('techEstimatedCostInput')?.setAttribute('readonly', 'readonly');

    document.getElementById('btnSubmitEstimatedBudget')?.addEventListener('click', async () => {
        const estimatedBudget = parseFloat(document.getElementById('techEstimatedCostInput')?.value) || 0;
        const budgetDetails = getBudgetDetails();

        if (estimatedBudget <= 0) {
            showMessage("Por favor, introduza um custo estimado válido.", true);
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
            showMessage(data.message || "Orçamento detalhado processado no sistema!");
            await fetchTicket();
        } else {
            showMessage(data.message || "Erro ao submeter orçamento detalhado.", true);
        }
    });

    document.getElementById('btnFinishTicket')?.addEventListener('click', async () => {
        const cost = parseFloat(document.getElementById('techTotalCost')?.value) || 0;
        const report = document.getElementById('techFinalReport')?.value.trim();

        if (cost <= 0) {
            showMessage("Por favor, introduza o custo final da intervenção.", true);
            return;
        }

        const res = await fetch(`/tickets/${ticketId}/close`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ actual_cost: cost, report: report })
        });

        const data = await res.json();
        if (res.ok) {
            showMessage("Intervenção concluída e ticket fechado!");
            await fetchTicket();
        } else {
            showMessage(data.message || "Erro ao fechar ticket.", true);
        }
    });

    document.getElementById('btnApproveBudget')?.addEventListener('click', () => handleBudgetAction('approve'));
    document.getElementById('btnRejectBudget')?.addEventListener('click', () => handleBudgetAction('reject'));

    document.getElementById('btnStartRepair')?.addEventListener('click', async () => {
        const startBtn = document.getElementById('btnStartRepair');
        const forceBtn = document.getElementById('btnStartRepairForce');
        
        if (startBtn) {
            startBtn.disabled = true;
            startBtn.innerHTML = '<span class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span> A verificar...';
        }
        
        try {
            const res = await fetch(`/technician/tickets/${ticketId}/start`, {
                method: 'PUT',
                headers: { ...authHeader(), 'Content-Type': 'application/json' },
                body: JSON.stringify({ force: false })
            });
            
            const data = await res.json();
            
            if (res.ok) {
                showMessage("Reparação iniciada com sucesso!");
                await fetchTicket();
                return;
            }
            
            if (res.status === 409 && data.warning) {
                showPriorityWarning(
                    data.urgent_tickets_count || 0,
                    data.current_priority || 'média',
                    ticketId,
                    'start',
                    data.my_urgent_tickets_count || 0
                );
                
                if (forceBtn) {
                    forceBtn.classList.remove('hidden');
                    startBtn?.classList.add('hidden');
                    
                    window._forceStartData = {
                        urgentCount: data.urgent_tickets_count || 0,
                        currentPriority: data.current_priority || 'média',
                        myUrgentCount: data.my_urgent_tickets_count || 0
                    };
                }
                
                showMessage(data.message || "⚠️ Existem tickets mais prioritários por atender.", true);
            } else {
                showMessage(data.message || "Erro ao iniciar reparação.", true);
            }
        } catch (e) {
            showMessage("Erro de conexão ao iniciar reparação.", true);
        } finally {
            if (startBtn && forceBtn?.classList.contains('hidden')) {
                startBtn.disabled = false;
                startBtn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"></path></svg>
                            Iniciar Intervenção`;
            }
        }
    });
    
    document.getElementById('btnStartRepairForce')?.addEventListener('click', async () => {
        const forceBtn = document.getElementById('btnStartRepairForce');
        const startBtn = document.getElementById('btnStartRepair');
        
        if (forceBtn) {
            forceBtn.disabled = true;
            forceBtn.innerHTML = '<span class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span> A iniciar...';
        }
        
        try {
            const res = await fetch(`/technician/tickets/${ticketId}/start`, {
                method: 'PUT',
                headers: { ...authHeader(), 'Content-Type': 'application/json' },
                body: JSON.stringify({ force: true })
            });
            
            const data = await res.json();
            
            if (res.ok) {
                showMessage("Reparação iniciada com sucesso (prioridades ignoradas)! O administrador foi notificado.");
                hidePriorityWarning();
                await fetchTicket();
            } else {
                showMessage(data.message || "Erro ao forçar início da reparação.", true);
            }
        } catch (e) {
            showMessage("Erro de conexão.", true);
        } finally {
            if (forceBtn) {
                forceBtn.disabled = false;
                forceBtn.innerHTML = '<span>⚠️</span> Forçar Início (ignorar prioritários)';
                forceBtn.classList.add('hidden');
                if (startBtn) startBtn.classList.remove('hidden');
            }
        }
    });

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
            showMessage("Mensagem enviada!");
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
            showMessage("Fotografia enviada!");
        }
    });

    window._pendingForceStart = false;
    window._pendingActionType = 'start';
    
    const btnViewUrgent = document.getElementById('btnViewUrgentTickets');
    const btnForceStart = document.getElementById('btnForceStartTicket');
    
    btnViewUrgent?.addEventListener('click', async function() {
        hidePriorityWarning();
        const pendingId = window._pendingTicketId || ticketId;
        
        try {
            btnViewUrgent.disabled = true;
            btnViewUrgent.innerHTML = '<span class="w-4 h-4 border-2 border-black/30 border-t-black rounded-full animate-spin"></span> A localizar...';
            
            const res = await fetch(`/tickets/most-urgent?exclude=${pendingId}`, { headers: authHeader() });
            if (res.ok) {
                const data = await res.json();
                if (data.ticket_id) {
                    window.location.href = `/ui/tickets/${data.ticket_id}`;
                    return;
                }
            }
            window.location.href = '/ui/tickets?priority=crítica';
        } catch (e) {
            window.location.href = '/ui/tickets?priority=crítica';
        }
    });
    
    btnForceStart?.addEventListener('click', async function() {
        hidePriorityWarning();
        const pendingId = window._pendingTicketId || ticketId;
        if (!pendingId) return;
        
        const actionType = window._pendingActionType || 'start';
        
        try {
            let res;
            let successMsgKey, errorMsgKey;
            
            if (actionType === 'close') {
                const cost = parseFloat(document.getElementById('techTotalCost')?.value) || 0;
                const report = document.getElementById('techFinalReport')?.value.trim();
                res = await fetch(`/tickets/${pendingId}/close`, {
                    method: 'POST',
                    headers: { ...authHeader(), 'Content-Type': 'application/json' },
                    body: JSON.stringify({ actual_cost: cost, report: report, force: true })
                });
                successMsgKey = "Intervenção concluída e ticket fechado!";
                errorMsgKey = "Erro ao fechar ticket.";
            } else {
                res = await fetch(`/technician/tickets/${pendingId}/start`, {
                    method: 'PUT',
                    headers: { ...authHeader(), 'Content-Type': 'application/json' },
                    body: JSON.stringify({ force: true })
                });
                successMsgKey = "Reparação iniciada com sucesso!";
                errorMsgKey = "Erro ao iniciar reparação.";
            }
            
            const data = await res.json();
            if (res.ok) {
                showMessage(successMsgKey);
                await fetchTicket();
            } else {
                showMessage(data.message || errorMsgKey, true);
            }
        } catch (e) {
            showMessage("Erro de conexão.", true);
        }
    });

    setupEventDelegation();
}

export { init };
