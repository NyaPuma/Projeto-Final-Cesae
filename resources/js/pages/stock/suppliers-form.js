import { authPatch, authPost } from '../../utils/api.js';

function extractError(data) {
    let errorText = data.message || 'An error occurred while saving the supplier.';
    if (data.errors) {
        errorText = Object.values(data.errors).flat().join(' ');
    }
    return errorText;
}

function buildPayload() {
    return {
        name: document.getElementById('supplierName').value.trim(),
        nif: document.getElementById('supplierNif').value.trim(),
        contact: document.getElementById('supplierContact').value.trim(),
        email: document.getElementById('supplierEmail').value.trim(),
        address: document.getElementById('supplierAddress').value.trim(),
        avg_lead_time_days: document.getElementById('supplierLeadTime').value || null,
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

    const mode = form.dataset.supplierFormMode;
    const id = form.dataset.supplierId || null;

    showMessage(message, mode === 'edit' ? (window.SGM_UI_I18N?.saving || 'Saving...') : (window.SGM_UI_I18N?.saving || 'Saving supplier...'), false);
    submitBtn.disabled = true;

    const payload = buildPayload();
    const request = mode === 'edit' && id
        ? authPatch(`/admin/suppliers/${id}`, payload)
        : authPost('/admin/suppliers', payload);

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
                ? (window.SGM_UI_I18N?.updatedSuccess || 'Supplier updated successfully!')
                : (window.SGM_UI_I18N?.createdSuccess || 'Supplier created successfully!'), false);
            message.className = 'min-h-6 text-sm font-medium text-success';
            setTimeout(() => { window.location.href = '/ui/stock/suppliers'; }, 1500);
        })
        .catch(err => {
            showMessage(message, err.message, true);
            submitBtn.disabled = false;
        });
}

function init() {
    const form = document.getElementById('supplierForm');
    if (form) {
        form.addEventListener('submit', handleSubmit);
    }
}

export { init };
