import { authHeader } from '../../utils/api.js';
import { state } from './state.js';
import { showMessage } from './ui.js';

const translations = () => window.SGM_TICKET_DETAIL_I18N || {};

function getAssignmentPayload(technicianId) {
    return {
        technician_id: technicianId,
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
        showMessage(data.message || translations().assignError || 'Error assigning technician.', true);
        return;
    }

    showMessage(data.message || translations().assignSuccess || 'Technician assigned successfully.');
    await onSuccess();
}

export function bindAssignmentActions(onSuccess) {
    const manualButton = document.getElementById('btnAssignManual');
    const autoButton = document.getElementById('btnAssignAuto');
    const technicianInput = document.getElementById('assignTechnicianId');

    manualButton?.addEventListener('click', async () => {
        const technicianId = parseInt(technicianInput?.value || '', 10);

        if (!technicianId) {
            showMessage(translations().assignInvalidId || 'Enter a valid technician ID.', true);
            return;
        }

        await assignTechnician(technicianId, onSuccess);
    });

    autoButton?.addEventListener('click', async () => {
        await assignTechnician(null, onSuccess);
    });
}
