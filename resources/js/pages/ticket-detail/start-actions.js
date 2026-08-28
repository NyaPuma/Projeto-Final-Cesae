/**
 * Ticket Detail Repair Start Actions Module
 */
import { authHeader } from '../../utils/api.js';
import { state } from './state.js';
import { showPriorityWarning } from './workflow.js';
import { showMessage } from './ui.js';

export function bindRepairStartActions(fetchTicket) {
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

                showMessage(data.message || 'Existem tickets mais prioritários por atender.', true);
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
            document.getElementById('priorityWarningModal')?.classList.add('hidden');
            await fetchTicket();
        } catch {
            showMessage('Erro de conexão.', true);
        } finally {
            if (forceButton) {
                forceButton.disabled = false;
                forceButton.innerHTML = '<svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg> Forçar Início (ignorar prioritários)';
                forceButton.classList.add('hidden');
            }
            if (startButton) startButton.classList.remove('hidden');
        }
    });
}
