export function getForm() {
    return document.getElementById('createTicketForm');
}

export function getMessage() {
    return document.getElementById('formMessage');
}

export function getSubmitButton() {
    return document.getElementById('submitBtn');
}

export function getPriorityInput() {
    return document.getElementById('ticketPriority');
}

export function getPriorityCards() {
    return document.querySelectorAll('.priority-card');
}

export function getFileInput() {
    return document.getElementById('ticketImage');
}

export function getFileNameLabel() {
    return document.getElementById('fileName');
}

export function getFormData() {
    return {
        title: document.getElementById('ticketTitle')?.value.trim() || '',
        description: document.getElementById('ticketDescription')?.value.trim() || '',
        priority: getPriorityInput()?.value || 'media',
        equipmentId: document.getElementById('equipmentId')?.value.trim() || '',
    };
}
