/**
 * Equipment Form Module
 * Handles the equipment create/edit form submission via the admin API.
 */

import { authPatch, authPost } from '../utils/api.js';

function extractError(data) {
    let errorText = data.message || 'Ocorreu um erro ao guardar o equipamento.';
    if (data.errors) {
        errorText = Object.values(data.errors).flat().join(' ');
    }
    return errorText;
}

function buildPayload() {
    return {
        name: document.getElementById('eqName').value.trim(),
        serial: document.getElementById('eqSerial').value.trim(),
        asset_tag: document.getElementById('eqAssetTag').value.trim(),
        category_id: document.getElementById('eqCategory').value || null,
        room_id: document.getElementById('eqRoom').value || null,
        status: document.getElementById('eqStatus').value,
        brand: document.getElementById('eqBrand').value.trim(),
        model: document.getElementById('eqModel').value.trim(),
        manufacturer: document.getElementById('eqManufacturer').value.trim(),
        purchase_date: document.getElementById('eqPurchaseDate').value || null,
        warranty_until: document.getElementById('eqWarrantyUntil').value || null,
        active: document.getElementById('eqActive').checked,
        notes: document.getElementById('eqNotes').value.trim(),
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

    const mode = form.dataset.equipmentFormMode;
    const id = form.dataset.equipmentId || null;

    showMessage(message, mode === 'edit' ? 'A guardar alterações...' : 'A guardar equipamento...', false);
    submitBtn.disabled = true;

    const payload = buildPayload();
    const request = mode === 'edit' && id
        ? authPatch(`/admin/equipment/${id}`, payload)
        : authPost('/admin/equipment', payload);

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
                ? 'Equipamento atualizado com sucesso!'
                : 'Equipamento criado com sucesso!', false);
            message.className = 'min-h-6 text-sm font-medium text-success';
            setTimeout(() => { window.location.href = '/ui/equipments'; }, 1500);
        })
        .catch(err => {
            showMessage(message, err.message, true);
            submitBtn.disabled = false;
        });
}

function init() {
    const form = document.getElementById('equipmentForm');
    if (form) {
        form.addEventListener('submit', handleSubmit);
    }
}

export { init };
