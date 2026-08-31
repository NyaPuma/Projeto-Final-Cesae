import { authPatch, authPost } from '../../utils/api.js';

function extractError(data) {
    let errorText = data.message || 'An error occurred while saving the part.';
    if (data.errors) {
        errorText = Object.values(data.errors).flat().join(' ');
    }
    return errorText;
}

function buildPayload(mode) {
    const payload = {
        sku: document.getElementById('partSku').value.trim(),
        name: document.getElementById('partName').value.trim(),
        brand: document.getElementById('partBrand').value.trim(),
        manufacturer_ref: document.getElementById('partManufacturerRef').value.trim(),
        part_category_id: document.getElementById('partCategory').value || null,
        unit_of_measure: document.getElementById('partUnit').value,
        cost_price: document.getElementById('partCostPrice').value,
        tax_rate_id: document.getElementById('partTaxRate').value || null,
        sale_price: document.getElementById('partSalePrice').value || null,
        min_stock: document.getElementById('partMinStock').value,
        max_stock: document.getElementById('partMaxStock').value || null,
        location: document.getElementById('partLocation').value.trim(),
        description: document.getElementById('partDescription').value.trim(),
        technical_notes: document.getElementById('partTechnicalNotes').value.trim(),
        active: document.getElementById('partActive')?.checked ?? true,
    };

    if (mode === 'create') {
        payload.current_stock = document.getElementById('partCurrentStock')?.value || 0;
    }

    return payload;
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

    const mode = form.dataset.partFormMode;
    const id = form.dataset.partId || null;

    showMessage(message, mode === 'edit' ? (window.SGM_UI_I18N?.saving || 'Saving...') : (window.SGM_UI_I18N?.saving || 'Saving part...'), false);
    submitBtn.disabled = true;

    const payload = buildPayload(mode);
    const request = mode === 'edit' && id
        ? authPatch(`/admin/parts/${id}`, payload)
        : authPost('/admin/parts', payload);

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
                ? (window.SGM_UI_I18N?.updatedSuccess || 'Part updated successfully!')
                : (window.SGM_UI_I18N?.createdSuccess || 'Part created successfully!'), false);
            message.className = 'min-h-6 text-sm font-medium text-success';
            setTimeout(() => { window.location.href = '/ui/stock/parts'; }, 1500);
        })
        .catch(err => {
            showMessage(message, err.message, true);
            submitBtn.disabled = false;
        });
}

function init() {
    const form = document.getElementById('partForm');
    if (form) {
        form.addEventListener('submit', handleSubmit);
    }
}

export { init };
