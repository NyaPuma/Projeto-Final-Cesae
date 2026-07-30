import { authHeader } from '../../utils/api.js';
import { getForm, getFormData, getMessage, getSubmitButton, getFileInput } from './dom.js';

function setFormMessage(text, state = 'neutral') {
    const message = getMessage();
    if (!message) return;

    const classes = {
        neutral: 'min-h-6 text-xs font-medium text-[var(--text-soft)]',
        success: 'min-h-6 text-xs font-medium text-emerald-400',
        error: 'min-h-6 text-xs font-medium text-red-400',
    };

    message.textContent = text;
    message.className = classes[state] || classes.neutral;
}

async function submitForm(event) {
    event.preventDefault();

    const submitButton = getSubmitButton();
    const { title, description, priority, equipmentId } = getFormData();

    if (!equipmentId) {
        setFormMessage('Por favor, selecione um equipamento v\u00e1lido a partir da lista de sugest\u00f5es.', 'error');
        document.getElementById('equipmentSearchInput')?.focus();
        return;
    }

    setFormMessage('A guardar ticket...');
    if (submitButton) submitButton.disabled = true;

    try {
        const imageInput = getFileInput();
        let response;

        if (imageInput?.files?.length > 0) {
            const formData = new FormData();
            formData.append('title', title);
            formData.append('description', description);
            formData.append('priority', priority);
            formData.append('equipment_id', equipmentId);
            formData.append('image', imageInput.files[0]);

            const headers = authHeader();
            delete headers['Content-Type'];

            response = await fetch('/tickets', {
                method: 'POST',
                headers,
                body: formData,
            });
        } else {
            const headers = authHeader();
            headers['Content-Type'] = 'application/json';

            response = await fetch('/tickets', {
                method: 'POST',
                headers,
                body: JSON.stringify({ title, description, priority, equipment_id: parseInt(equipmentId, 10) }),
            });
        }

        const data = await response.json().catch(() => ({}));

        if (!response.ok) {
            let errorText = data.message || 'Erro ao criar ticket.';
            if (data.errors) {
                errorText = Object.values(data.errors).flat().join(' ');
            }
            throw new Error(errorText);
        }

        setFormMessage('Ticket criado com sucesso!', 'success');
        window.setTimeout(() => {
            window.location.href = '/ui/tickets';
        }, 1500);
    } catch (error) {
        setFormMessage(error.message, 'error');
        if (submitButton) submitButton.disabled = false;
    }
}

export function bindTicketCreateForm() {
    getForm()?.addEventListener('submit', submitForm);
}
