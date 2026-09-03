import { createPlan, deletePlan, fetchPlan, fetchPlans, updatePlan } from './plans/api.js';
import { bindPagination, clearPlanFilters, renderLoadingState } from './plans/dom.js';
import { renderEmptyState, renderErrorState, renderPagination, renderPlans, renderResultsCount, showFeedback } from './plans/render.js';
import { plansState, setCurrentPage } from './plans/state.js';
import { SmartPicker, partShape, equipmentShape } from '../../core/smart-picker.js';

const intervalLabels = { days: 'Days', usage_hours: 'Usage hours', cycles: 'Cycles' };

const partPickerI18n = {
    loading: window.SGM_UI_I18N?.loading || 'A carregar...',
    noResults: window.SGM_UI_I18N?.noResults || 'Sem resultados para a pesquisa.',
    error: window.SGM_UI_I18N?.error || 'Erro ao carregar.',
};

function initPartRowPicker(row) {
    const group = row.querySelector('[data-part-search]')?.closest('.relative');
    if (!group) return null;
    return new SmartPicker(group, {
        inputEl: group.querySelector('[data-part-search]'),
        listEl: group.querySelector('[data-part-list]'),
        hiddenEl: group.querySelector('[data-part-id]'),
        endpoint: '/stock/parts',
        resourceKey: 'parts',
        shape: partShape,
        i18n: partPickerI18n,
    });
}

let equipmentPicker = null;
let partRowPickers = [];

async function loadPlans(page = 1) {
    setCurrentPage(page);
    renderLoadingState();

    try {
        const data = await fetchPlans(page);
        if (!data) return;

        const plans = data.plans?.data ?? data.plans ?? [];
        const pagination = data.pagination ?? {};
        const total = pagination.total ?? plans.length;

        renderResultsCount(total);

        if (!plans.length) {
            renderEmptyState();
            return;
        }

        renderPlans(plans);
        renderPagination(pagination, page);
    } catch (error) {
        showFeedback(error.message, true);
        renderErrorState(error.message);
    }
}

function initPartRow(row, part = null) {
    row.querySelector('[data-part-search]').value = part ? part.name : '';
    row.querySelector('[data-part-id]').value = part ? part.id : '';
    row.querySelector('[data-expected-qty]').value = part ? part.expected_quantity : '';

    const picker = initPartRowPicker(row);
    if (picker) {
        partRowPickers.push(picker);
        if (part) {
            picker.shape = { ...partShape, id: () => part.id };
            picker.setSelected(part.id, part);
        }
    }

    row.querySelector('[data-part-row-remove]').addEventListener('click', () => {
        const idx = partRowPickers.indexOf(picker);
        if (idx !== -1) partRowPickers.splice(idx, 1);
        if (picker) picker.destroy();
        row.remove();
    });

    return picker;
}

function addPartRow(part = null) {
    const container = document.getElementById('plPartsContainer');
    const template = firstPartRow();
    if (!container || !template) return;
    const row = template.cloneNode(true);
    container.appendChild(row);
    initPartRow(row, part);
}

function buildPartsPayload() {
    return Array.from(document.querySelectorAll('#plPartsContainer [data-part-row]'))
        .map((row) => ({
            part_id: Number(row.querySelector('[data-part-id]').value || 0),
            expected_quantity: Number(row.querySelector('[data-expected-qty]').value || 1),
        }))
        .filter((entry) => entry.part_id > 0);
}

function resetForm() {
    const form = document.getElementById('planForm');
    form.dataset.planFormMode = 'create';
    form.dataset.planId = '';

    document.getElementById('plName').value = '';
    equipmentPicker?.clear();
    document.getElementById('plIntervalType').value = 'days';
    document.getElementById('plIntervalValue').value = '';
    document.getElementById('plDescription').value = '';
    document.getElementById('plActive').checked = true;

    document.querySelectorAll('#plPartsContainer [data-part-row]').forEach((row, index) => {
        if (index > 0) row.remove();
    });
    partRowPickers = [];
    const firstRow = firstPartRow();
    initPartRow(firstRow, null);

    document.getElementById('planFormTitle').textContent = 'New maintenance plan';
    document.getElementById('plMessage').textContent = '';
}

function showMessage(text, isError) {
    const message = document.getElementById('plMessage');
    message.textContent = text;
    message.className = 'text-xs font-medium ' + (isError
        ? 'text-danger'
        : 'text-success');
}

function bindForm() {
    const form = document.getElementById('planForm');
    const submitBtn = document.getElementById('plSubmit');

    if (!form) return;

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const mode = form.dataset.planFormMode;
        const id = form.dataset.planId;

        const payload = {
            name: document.getElementById('plName').value.trim(),
            equipment_id: Number(document.getElementById('plEquipment').value),
            interval_type: document.getElementById('plIntervalType').value,
            interval_value: Number(document.getElementById('plIntervalValue').value),
            description: document.getElementById('plDescription').value.trim() || null,
            active: document.getElementById('plActive').checked,
            parts: buildPartsPayload(),
        };

        submitBtn.disabled = true;
        showMessage((window.SGM_UI_I18N?.saving || 'Saving plan...'), false);

        try {
            const data = mode === 'edit' && id
                ? await updatePlan(id, payload)
                : await createPlan(payload);

            showMessage(data.message || (window.SGM_UI_I18N?.savedSuccess || 'Plan saved successfully!'), false);
            resetForm();
            loadPlans(plansState.currentPage);
        } catch (error) {
            showMessage(error.message, true);
        } finally {
            submitBtn.disabled = false;
        }
    });

    document.getElementById('plReset')?.addEventListener('click', resetForm);
    document.getElementById('plAddPart')?.addEventListener('click', () => addPartRow());
}

async function handleEdit(id) {
    const message = document.getElementById('plMessage');

    try {
        const data = await fetchPlan(id);
        const plan = data.plan ?? {};

        document.getElementById('plName').value = plan.name || '';
        equipmentPicker?.setSelected(plan.equipment_id, plan.equipment || null);
        document.getElementById('plIntervalType').value = plan.interval_type || 'days';
        document.getElementById('plIntervalValue').value = plan.interval_value || '';
        document.getElementById('plDescription').value = plan.description || '';
        document.getElementById('plActive').checked = plan.active !== false;

        partRowPickers.forEach((picker) => picker.destroy());
        partRowPickers = [];
        document.querySelectorAll('#plPartsContainer [data-part-row]').forEach((row, index) => {
            if (index > 0) row.remove();
        });
        const firstRow = firstPartRow();

        (plan.parts ?? []).forEach((part, index) => {
            if (index === 0) {
                initPartRow(firstRow, part);
            } else {
                addPartRow(part);
            }
        });

        const form = document.getElementById('planForm');
        form.dataset.planFormMode = 'edit';
        form.dataset.planId = String(id);
        document.getElementById('planFormTitle').textContent = 'Edit maintenance plan';
        message.textContent = '';
    } catch (error) {
        showMessage(error.message, true);
    }
}

async function handleDelete(id) {
    const message = document.getElementById('plMessage');

    try {
        const data = await deletePlan(id);
        showMessage(data.message || (window.SGM_UI_I18N?.deletedSuccess || 'Plan deleted successfully!'), false);
        loadPlans(plansState.currentPage);
    } catch (error) {
        showMessage(error.message, true);
    }
}

function bindTableActions() {
    const tbody = document.getElementById('plansTableBody');
    if (!tbody) return;

    tbody.addEventListener('click', (event) => {
        const editButton = event.target.closest('[data-plan-edit]');
        if (editButton) {
            handleEdit(editButton.dataset.planEdit);
            return;
        }

        const deleteButton = event.target.closest('[data-plan-delete]');
        if (deleteButton && window.confirm((window.SGM_UI_I18N?.confirmDeletePlan || 'Are you sure you want to delete this maintenance plan?'))) {
            handleDelete(deleteButton.dataset.planDelete);
        }
    });
}

function bindFilters() {
    document.getElementById('filter_equipment')?.addEventListener('change', () => loadPlans(1));
}

function init() {
    bindForm();
    bindTableActions();
    bindFilters();
    bindPagination(loadPlans);
    loadPlans(plansState.currentPage);
}

export { init };
