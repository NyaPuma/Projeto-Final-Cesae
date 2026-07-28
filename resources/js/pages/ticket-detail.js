import { authHeader } from '../utils/api.js';
import { setTicketId, state } from './ticket-detail/state.js';
import { renderTicketDetails } from './ticket-detail/details.js';
import { addBudgetItem, recalcBudgetTotal, renderBudgetDetailsForAdmin } from './ticket-detail/budget.js';
import { fetchComments, bindCommentForm } from './ticket-detail/comments.js';
import { fetchPhotos, bindPhotoForm, deletePhoto } from './ticket-detail/photos.js';
import { bindAssignmentActions } from './ticket-detail/assignment.js';
import { finishTicket, handleBudgetAction, hidePriorityWarning, showPriorityWarning, submitBudget } from './ticket-detail/workflow.js';
import { showMessage } from './ticket-detail/ui.js';

function currentUserIsAdmin() {
    return localStorage.getItem('user_role') === 'admin';
}

async function fetchTicket() {
    if (!state.ticketId) {
        console.error('ID do Ticket não fornecido.');
        return;
    }

    const response = await fetch(`/tickets/${state.ticketId}`, { headers: authHeader() });
    if (response.status === 401) {
        alert('Autenticação necessária. Faça login.');
        window.location = '/ui/login';
        return;
    }
    if (!response.ok) {
        const error = await response.json();
        alert(error.message || 'Erro a carregar ticket');
        return;
    }

    const data = await response.json();
    const ticket = data.ticket || data;
    const { statusClean } = renderTicketDetails(ticket) || {};

    const isClosed = statusClean === 'fechada' || statusClean === 'fechado';
    const isOpen = statusClean === 'aberta' || statusClean === 'aberto';
    const isInProgress = statusClean === 'em curso';
    const estimatedAmount = parseFloat(ticket.budget_amount || ticket.estimated_cost || ticket.estimatedBudget || 0);
    const threshold = parseFloat(ticket.threshold || 50.0);
    const budgetWasSubmitted = ticket.budget_requested === true || ticket.budget_requested === 1 || ticket.budget_requested === '1';
    const budgetIsPending = ticket.budget_status === 'pending';
    const budgetIsApproved = ticket.budget_status === 'approved';
    const budgetWasAutoApproved = budgetWasSubmitted && !ticket.budget_status;

    const technicianCards = ['techStartCard', 'techCompletionCard', 'techBlockedCard', 'techRejectedCard', 'techApprovedCard', 'techBudgetSubmitCard']
        .map((id) => document.getElementById(id));

    if (technicianCards.every(Boolean)) {
        technicianCards.forEach((card) => card.classList.add('hidden'));

        if (budgetIsPending) {
            document.getElementById('techBlockedCard').classList.remove('hidden');
        } else if (isClosed) {
            const approvedCard = document.getElementById('techApprovedCard');
            const completionCard = document.getElementById('techCompletionCard');
            approvedCard.classList.remove('hidden');
            completionCard.classList.add('hidden');
            approvedCard.querySelector('h3').textContent = 'Reparação Concluída';
            approvedCard.querySelector('p').textContent = 'O ticket foi fechado com sucesso.';
        } else if (budgetIsApproved || budgetWasAutoApproved) {
            document.getElementById('techApprovedCard').classList.remove('hidden');
            document.getElementById('techCompletionCard').classList.remove('hidden');
        } else if (isInProgress && !budgetWasSubmitted) {
            document.getElementById('techBudgetSubmitCard').classList.remove('hidden');
        } else if (isOpen && !budgetIsPending) {
            document.getElementById('techStartCard').classList.remove('hidden');
        } else {
            document.getElementById('techBudgetSubmitCard').classList.remove('hidden');
        }
    }

    const budgetCard = document.getElementById('budgetApprovalCard');
    if (budgetCard && currentUserIsAdmin()) {
        if (budgetIsPending) {
            document.getElementById('budgetEstimatedCost').innerText = `${estimatedAmount.toFixed(2)} €`;
            document.getElementById('budgetThresholdDisplay').innerText = `${threshold.toFixed(2)} €`;
            document.getElementById('budgetTechnicianName').innerText = ticket.technician ? ticket.technician.name : 'Técnico de Campo';
            budgetCard.classList.remove('hidden');
            renderBudgetDetailsForAdmin(ticket.budget_details);
        } else {
            budgetCard.classList.add('hidden');
        }
    }
}

function bindTicketActions() {
    document.getElementById('btnAddBudgetItem')?.addEventListener('click', () => addBudgetItem());
    document.getElementById('techEstimatedCostInput')?.setAttribute('readonly', 'readonly');
    document.getElementById('btnSubmitEstimatedBudget')?.addEventListener('click', () => submitBudget(fetchTicket));
    document.getElementById('btnFinishTicket')?.addEventListener('click', () => finishTicket(fetchTicket));
    document.getElementById('btnApproveBudget')?.addEventListener('click', () => handleBudgetAction('approve', fetchTicket));
    document.getElementById('btnRejectBudget')?.addEventListener('click', () => handleBudgetAction('reject', fetchTicket));

    document.getElementById('btnStartRepair')?.addEventListener('click', async () => {
        const startButton = document.getElementById('btnStartRepair');
        const forceButton = document.getElementById('btnStartRepairForce');

        if (startButton) {
            startButton.disabled = true;
            startButton.innerHTML = '<span class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span> A verificar...';
        }

        try {
            const response = await fetch(`/technician/tickets/${state.ticketId}/start`, {
                method: 'PUT',
                headers: { ...authHeader(), 'Content-Type': 'application/json' },
                body: JSON.stringify({ force: false }),
            });

            const data = await response.json();

            if (response.ok) {
                showMessage('Reparação iniciada com sucesso!');
                await fetchTicket();
                return;
            }

            if (response.status === 409 && data.warning) {
                showPriorityWarning(data.urgent_tickets_count || 0, data.current_priority || 'média', state.ticketId, 'start', data.my_urgent_tickets_count || 0);

                if (forceButton) {
                    forceButton.classList.remove('hidden');
                    startButton?.classList.add('hidden');
                }

                showMessage(data.message || '⚠️ Existem tickets mais prioritários por atender.', true);
                return;
            }

            showMessage(data.message || 'Erro ao iniciar reparação.', true);
        } catch {
            showMessage('Erro de conexão ao iniciar reparação.', true);
        } finally {
            if (startButton && forceButton?.classList.contains('hidden')) {
                startButton.disabled = false;
                startButton.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"></path></svg> Iniciar Intervenção';
            }
        }
    });

    document.getElementById('btnStartRepairForce')?.addEventListener('click', async () => {
        const forceButton = document.getElementById('btnStartRepairForce');
        const startButton = document.getElementById('btnStartRepair');

        if (forceButton) {
            forceButton.disabled = true;
            forceButton.innerHTML = '<span class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span> A iniciar...';
        }

        try {
            const response = await fetch(`/technician/tickets/${state.ticketId}/start`, {
                method: 'PUT',
                headers: { ...authHeader(), 'Content-Type': 'application/json' },
                body: JSON.stringify({ force: true }),
            });

            const data = await response.json();

            if (!response.ok) {
                showMessage(data.message || 'Erro ao forçar início da reparação.', true);
                return;
            }

            showMessage('Reparação iniciada com sucesso (prioridades ignoradas)! O administrador foi notificado.');
            hidePriorityWarning();
            await fetchTicket();
        } catch {
            showMessage('Erro de conexão.', true);
        } finally {
            if (forceButton) {
                forceButton.disabled = false;
                forceButton.innerHTML = '<span>⚠️</span> Forçar Início (ignorar prioritários)';
                forceButton.classList.add('hidden');
            }
            if (startButton) startButton.classList.remove('hidden');
        }
    });
}

function setupEventDelegation() {
    document.addEventListener('input', (event) => {
        if (event.target.classList.contains('item-qty') || event.target.classList.contains('item-price') || event.target.classList.contains('item-desc')) {
            recalcBudgetTotal();
        }
    });

    document.addEventListener('change', (event) => {
        if (!event.target.classList.contains('item-type')) return;

        const item = event.target.closest('.budget-item');
        if (!item) return;

        const priceInput = item.querySelector('.item-price');
        priceInput.placeholder = event.target.value === 'labor' ? '€/Hora' : 'P. Unit';
        recalcBudgetTotal();
    });

    document.addEventListener('click', (event) => {
        const removeButton = event.target.closest('.btn-remove-item');
        if (removeButton) {
            removeButton.closest('.budget-item')?.remove();
            recalcBudgetTotal();
            return;
        }

        const deletePhotoButton = event.target.closest('[data-action="delete-photo"]');
        if (deletePhotoButton?.dataset.photoId) {
            deletePhoto(parseInt(deletePhotoButton.dataset.photoId, 10));
            return;
        }
    });
}

function bindPriorityModalActions() {
    const viewUrgentButton = document.getElementById('btnViewUrgentTickets');
    const forceActionButton = document.getElementById('btnForceStartTicket');

    viewUrgentButton?.addEventListener('click', async () => {
        hidePriorityWarning();
        const pendingId = state.pendingTicketId || state.ticketId;

        try {
            viewUrgentButton.disabled = true;
            viewUrgentButton.innerHTML = '<span class="w-4 h-4 border-2 border-black/30 border-t-black rounded-full animate-spin"></span> A localizar...';

            const response = await fetch(`/tickets/most-urgent?exclude=${pendingId}`, { headers: authHeader() });
            if (response.ok) {
                const data = await response.json();
                if (data.ticket_id) {
                    window.location.href = `/ui/tickets/${data.ticket_id}`;
                    return;
                }
            }
            window.location.href = '/ui/tickets?priority=crítica';
        } catch {
            window.location.href = '/ui/tickets?priority=crítica';
        }
    });

    forceActionButton?.addEventListener('click', async () => {
        hidePriorityWarning();
        const pendingId = state.pendingTicketId || state.ticketId;
        if (!pendingId) return;

        try {
            let response;

            if (state.pendingActionType === 'close') {
                const cost = parseFloat(document.getElementById('techTotalCost')?.value) || 0;
                const report = document.getElementById('techFinalReport')?.value.trim();
                response = await fetch(`/tickets/${pendingId}/close`, {
                    method: 'POST',
                    headers: { ...authHeader(), 'Content-Type': 'application/json' },
                    body: JSON.stringify({ actual_cost: cost, report, force: true }),
                });
            } else {
                response = await fetch(`/technician/tickets/${pendingId}/start`, {
                    method: 'PUT',
                    headers: { ...authHeader(), 'Content-Type': 'application/json' },
                    body: JSON.stringify({ force: true }),
                });
            }

            const data = await response.json();

            if (!response.ok) {
                showMessage(data.message || 'Erro de conexão.', true);
                return;
            }

            showMessage(state.pendingActionType === 'close' ? 'Intervenção concluída e ticket fechado!' : 'Reparação iniciada com sucesso!');
            await fetchTicket();
        } catch {
            showMessage('Erro de conexão.', true);
        }
    });
}

export function init() {
    const container = document.querySelector('[data-ticket-id]');
    if (container?.dataset.ticketId) {
        setTicketId(parseInt(container.dataset.ticketId, 10));
    }

    fetchTicket();
    fetchComments();
    fetchPhotos();
    addBudgetItem('', 1, 0);

    bindTicketActions();
    bindCommentForm();
    bindPhotoForm();
    bindAssignmentActions(fetchTicket);
    bindPriorityModalActions();
    setupEventDelegation();
}
