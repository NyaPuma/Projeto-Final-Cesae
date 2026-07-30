import { authHeader } from '../../utils/api.js';
import { state } from './state.js';
import { showMessage } from './ui.js';

function getAssignmentPayload(technicianId) {
    return {
        tecnico_id: technicianId,
    };
}

async function assignTechnician(technicianId, onSuccess) {
    const response = await fetch(`/tickets/${state.ticketId}/assign-technician`, {
        method: 'POST',
        headers: { ...authHeader(), 'Content-Type': 'application/json' },
        body: JSON.stringify(getAssignmentPayload(technicianId)),
    });

    const data = await response.json().catch(() => ({}));

    if (!response.ok) {
        showMessage(data.message || 'Erro ao atribuir técnico.', true);
        return;
    }

    showMessage(data.message || 'Técnico atribuído com sucesso.');
    await onSuccess();
}

export function bindAssignmentActions(onSuccess) {
    const manualButton = document.getElementById('btnAssignManual');
    const autoButton = document.getElementById('btnAssignAuto');
    const technicianInput = document.getElementById('assignTechnicianId');

    manualButton?.addEventListener('click', async () => {
        const technicianId = parseInt(technicianInput?.value || '', 10);

        if (!technicianId) {
            showMessage('Introduza um ID de técnico válido.', true);
            return;
        }

        await assignTechnician(technicianId, onSuccess);
    });

    autoButton?.addEventListener('click', async () => {
        await assignTechnician(null, onSuccess);
    });
}
