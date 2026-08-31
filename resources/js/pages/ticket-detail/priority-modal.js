/**
 * Ticket Priority Warning Modal Actions Module
 */
import { authHeader } from '../../utils/api.js';
import { state } from './state.js';
import { hidePriorityWarning } from './workflow.js';
import { showMessage } from './ui.js';

const translations = () => window.SGM_TICKET_DETAIL_I18N || {};

export function bindPriorityModalActions(fetchTicket) {
    const viewUrgentButton = document.getElementById('btnViewUrgentTickets');
    const forceActionButton = document.getElementById('btnForceStartTicket');

    viewUrgentButton?.addEventListener('click', async () => {
        hidePriorityWarning();
        const pendingId = state.pendingTicketId || state.ticketId;

        try {
            viewUrgentButton.disabled = true;
            viewUrgentButton.innerHTML = '<span class="w-4 h-4 border-2 border-black/30 border-t-black rounded-full animate-spin"></span> Locating...;

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
                showMessage(data.message || translations().connectionError || 'Connection error.', true);
                return;
            }

            showMessage(state.pendingActionType === 'close'
                ? (translations().interventionClosed || 'Intervention completed and ticket closed!')
                : (translations().repairStarted || 'Repair started successfully!'));
            await fetchTicket();
        } catch {
            showMessage(translations().connectionError || 'Connection error.', true);
        }
    });
}
