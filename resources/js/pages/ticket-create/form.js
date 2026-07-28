import { authHeaderJson } from '../../utils/api.js';
import { getForm, getFormData, getMessage, getSubmitButton } from './dom.js';

function setFormMessage(text, state = 'neutral') {
    const message = getMessage();
    if (!message) return;

    const classes = {
        neutral: 'min-h-6 text-sm font-medium text-[var(--text-soft)]',
        success: 'min-h-6 text-sm font-medium text-emerald-600 dark:text-emerald-400',
        error: 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400',
    };

    message.textContent = text;
    message.className = classes[state] || classes.neutral;
}

function buildPayload() {
    const { title, description, priority, equipmentId } = getFormData();
    const payload = { title, description, priority };
    const parsedEquipmentId = parseInt(equipmentId, 10);

    if (equipmentId && !Number.isNaN(parsedEquipmentId) && parsedEquipmentId > 0) {
        payload.equipment_id = parsedEquipmentId;
    }

    return payload;
}

async function submitForm(event) {
    event.preventDefault();

    const submitButton = getSubmitButton();
    if (submitButton) submitButton.disabled = true;
    setFormMessage('A guardar ticket...');

    try {
        const response = await fetch('/tickets', {
            method: 'POST',
            headers: authHeaderJson(),
            body: JSON.stringify(buildPayload()),
        });

        const data = await response.json().catch(() => ({}));

        if (!response.ok) {
            let errorText = data.message || 'Erro ao criar ticket.';
            if (data.errors) {
                errorText = Object.values(data.errors).flat().join(' ');
            }
            throw new Error(errorText);
        }

        setFormMessage('Ticket criado com sucesso!', 'success');
        const redirectUrl = getForm()?.dataset.redirectUrl || '/ui/tickets';
        window.setTimeout(() => {
            window.location.href = redirectUrl;
        }, 1500);
    } catch (error) {
        setFormMessage(error.message, 'error');
        if (submitButton) submitButton.disabled = false;
    }
}

export function bindTicketCreateForm() {
    getForm()?.addEventListener('submit', submitForm);
}
