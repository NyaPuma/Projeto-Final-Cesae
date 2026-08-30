import { authHeader } from '../../utils/api.js';
import { getForm, getFormData, getMessage, getSubmitButton, getFileInput } from './dom.js';

const translations = () => window.SGM_TICKET_DETAIL_I18N || {};

function setFormMessage(text, state = 'neutral') {
    const message = getMessage();
    if (!message) return;

    const classes = {
        neutral: 'min-h-6 text-xs font-medium text-[var(--text-soft)]',
        success: 'min-h-6 text-xs font-medium text-success',
        error: 'min-h-6 text-xs font-medium text-danger',
    };

    message.textContent = text;
    message.className = classes[state] || classes.neutral;
}

async function submitForm(event) {
    event.preventDefault();

    const submitButton = getSubmitButton();
    const { title, description, priority, equipmentId } = getFormData();

    if (!equipmentId) {
        setFormMessage(translations().invalidEquipment || 'Please select a valid equipment from the suggestions list.', 'error');
        document.getElementById('equipmentSearchInput')?.focus();
        return;
    }

    setFormMessage(translations().ticketSaving || 'Saving ticket...');
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
            let errorText = data.message || translations().ticketCreateError || 'Error creating ticket.';
            if (data.errors) {
                errorText = Object.values(data.errors).flat().join(' ');
            }
            throw new Error(errorText);
        }

        setFormMessage(translations().ticketCreated || 'Ticket created successfully!', 'success');
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
