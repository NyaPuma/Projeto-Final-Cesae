/**
 * Ticket Creation Module
 * Handles ticket creation form with priority selection
 */

import { authHeaderJson, authHeaderFormData } from '../utils/api.js';

function selectPriority(priority) {
    document.getElementById('ticketPriority').value = priority;

    const cards = document.querySelectorAll('.priority-card');
    cards.forEach(card => {
        const cardPriority = card.getAttribute('data-priority');

        card.classList.remove('border-2', 'border-emerald-500', 'border-amber-500', 'border-red-500', 'border-purple-600', 'shadow-sm');
        card.classList.add('border', 'border-[var(--border)]');

        if (cardPriority === priority) {
            card.classList.remove('border', 'border-[var(--border)]');
            card.classList.add('border-2', 'shadow-sm');
            if (priority === 'baixa') card.classList.add('border-emerald-500');
            if (priority === 'media') card.classList.add('border-amber-500');
            if (priority === 'alta') card.classList.add('border-red-500');
            if (priority === 'critica') card.classList.add('border-purple-600');
        }
    });
}

function updateFileName(input) {
    const label = document.getElementById('fileName');
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
    } else {
        label.textContent = "{{ __('Nenhum ficheiro selecionado') }}";
    }
}

async function handleFormSubmit(e) {
    e.preventDefault();
    const message = document.getElementById('formMessage');
    const submitBtn = document.getElementById('submitBtn');

    const title = document.getElementById('ticketTitle').value.trim();
    const description = document.getElementById('ticketDescription').value.trim();
    const priority = document.getElementById('ticketPriority').value;
    const equipment_id = document.getElementById('equipmentId').value.trim();

    message.textContent = "{{ __('A guardar ticket...') }}";
    message.className = 'min-h-6 text-sm font-medium text-[var(--text-soft)]';
    submitBtn.disabled = true;

    try {
        const payload = { title, description, priority };
        const eqId = parseInt(equipment_id, 10);
        if (equipment_id && !isNaN(eqId) && eqId > 0) {
            payload.equipment_id = eqId;
        }

        const res = await fetch('/tickets', {
            method: 'POST',
            headers: authHeaderJson(),
            body: JSON.stringify(payload)
        });

        const data = await res.json().catch(() => ({}));

        if (!res.ok) {
            let errorText = data.message || "Erro ao criar ticket.";
            if (data.errors) {
                errorText = Object.values(data.errors).flat().join(' ');
            }
            throw new Error(errorText);
        }

        message.textContent = "Ticket criado com sucesso!";
        message.className = 'min-h-6 text-sm font-medium text-emerald-600 dark:text-emerald-400';
        const redirectUrl = document.getElementById('createTicketForm')?.dataset.redirectUrl || '/ui/tickets';
        setTimeout(() => { window.location.href = redirectUrl; }, 1500);
    } catch (err) {
        message.textContent = err.message;
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
        submitBtn.disabled = false;
    }
}

function init() {
    const form = document.getElementById('createTicketForm');
    if (form) {
        form.addEventListener('submit', handleFormSubmit);
    }

    // Set up priority card click handlers using event delegation
    document.addEventListener('click', (e) => {
        const card = e.target.closest('.priority-card');
        if (card) {
            const priority = card.getAttribute('data-priority');
            if (priority) selectPriority(priority);
        }
    });

    // Set up file input change handler
    const fileInput = document.getElementById('ticketImage');
    if (fileInput) {
        fileInput.addEventListener('change', updateFileName);
    }
}

export { init };
