/**
 * Room Form Module
 * Handles the room create/edit form submission via the admin API.
 */

import { authPatch, authPost } from '../utils/api.js';

function extractError(data) {
    let errorText = data.message || 'Ocorreu um erro ao guardar a sala.';
    if (data.errors) {
        errorText = Object.values(data.errors).flat().join(' ');
    }
    return errorText;
}

function buildPayload() {
    return {
        name: document.getElementById('roomName').value.trim(),
        code: document.getElementById('roomCode').value.trim(),
        building: document.getElementById('roomBuilding').value.trim(),
        floor: document.getElementById('roomFloor').value.trim(),
        location: document.getElementById('roomLocation').value.trim(),
        capacity: document.getElementById('roomCapacity').value !== ''
            ? Number(document.getElementById('roomCapacity').value)
            : null,
        description: document.getElementById('roomDescription').value.trim(),
        notes: document.getElementById('roomNotes').value.trim(),
        active: document.getElementById('roomActive').checked,
    };
}

function showMessage(element, text, isError) {
    element.textContent = text;
    element.className = 'min-h-6 text-sm font-medium ' + (isError
        ? 'text-danger'
        : 'text-[var(--text-soft)]');
}

function handleSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const message = document.getElementById('formMessage');
    const submitBtn = document.getElementById('submitBtn');

    const mode = form.dataset.roomFormMode;
    const id = form.dataset.roomId || null;

    showMessage(message, mode === 'edit' ? (window.SGM_UI_I18N?.saving || 'Saving changes...') : (window.SGM_UI_I18N?.saving || 'Saving room...'), false);
    submitBtn.disabled = true;

    const payload = buildPayload();
    const request = mode === 'edit' && id
        ? authPatch(`/admin/rooms/${id}`, payload)
        : authPost('/admin/rooms', payload);

    request
        .then(res => res.json().catch(() => ({})))
        .then(data => {
            if (data.status !== undefined && data.status >= 400) {
                throw new Error(extractError(data));
            }

            if (data.message && data.message.includes('Erro')) {
                throw new Error(data.message);
            }

            showMessage(message, mode === 'edit'
                ? (window.SGM_UI_I18N?.updatedSuccess || 'Room updated successfully!')
                : (window.SGM_UI_I18N?.createdSuccess || 'Room created successfully!'), false);
            message.className = 'min-h-6 text-sm font-medium text-success';
            setTimeout(() => { window.location.href = '/ui/rooms'; }, 1500);
        })
        .catch(err => {
            showMessage(message, err.message, true);
            submitBtn.disabled = false;
        });
}

function init() {
    const form = document.getElementById('roomForm');
    if (form) {
        form.addEventListener('submit', handleSubmit);
    }
}

export { init };
