import { authDelete, authPatch, authPost } from '../../utils/api.js';

function extractError(data) {
    let errorText = data.message || 'Ocorreu um erro.';
    if (data.errors) {
        errorText = Object.values(data.errors).flat().join(' ');
    }
    return errorText;
}

function showMessage(element, text, isError) {
    element.textContent = text;
    element.className = 'text-xs font-medium ' + (isError
        ? 'text-red-600 dark:text-red-400'
        : 'text-(--text-soft)');
}

function resetForm(form) {
    form.dataset.categoryFormMode = 'create';
    form.dataset.categoryId = '';
    document.getElementById('catName').value = '';
    document.getElementById('catActive').checked = true;
    document.getElementById('categoryFormTitle').textContent = '➕ Nova categoria';
    document.getElementById('catMessage').textContent = '';
}

async function submitHandler(e) {
    e.preventDefault();
    const form = e.target;
    const message = document.getElementById('catMessage');
    const submitBtn = document.getElementById('catSubmit');

    const mode = form.dataset.categoryFormMode;
    const id = form.dataset.categoryId;

    const payload = {
        name: document.getElementById('catName').value.trim(),
        active: document.getElementById('catActive').checked,
    };

    submitBtn.disabled = true;
    showMessage(message, 'A guardar...', false);

    try {
        const response = mode === 'edit' && id
            ? await authPatch(`/admin/part-categories/${id}`, payload)
            : await authPost('/admin/part-categories', payload);
        const data = await response.json().catch(() => ({}));

        if (!response.ok) throw new Error(extractError(data));

        showMessage(message, data.message || 'Guardado com sucesso!');
        message.className = 'text-xs font-medium text-emerald-600 dark:text-emerald-400';
        resetForm(form);
        window.location.reload();
    } catch (err) {
        showMessage(message, err.message, true);
    } finally {
        submitBtn.disabled = false;
    }
}

function handleEdit(button) {
    document.getElementById('catName').value = button.dataset.name || '';
    document.getElementById('catActive').checked = button.dataset.active === '1';

    const form = document.getElementById('categoryForm');
    form.dataset.categoryFormMode = 'edit';
    form.dataset.categoryId = button.dataset.categoryEdit;
    document.getElementById('categoryFormTitle').textContent = '✏️ Editar categoria';
    document.getElementById('catMessage').textContent = '';
}

async function handleDelete(id) {
    const message = document.getElementById('catMessage');
    showMessage(message, 'A desativar categoria...', false);

    try {
        const response = await authDelete(`/admin/part-categories/${id}`);
        const data = await response.json().catch(() => ({}));

        if (!response.ok) throw new Error(extractError(data));

        window.location.reload();
    } catch (err) {
        showMessage(message, err.message, true);
    }
}

function init() {
    const form = document.getElementById('categoryForm');
    if (form) form.addEventListener('submit', submitHandler);

    document.getElementById('catReset')?.addEventListener('click', () => resetForm(form));

    document.querySelectorAll('[data-category-edit]').forEach((button) => {
        button.addEventListener('click', () => handleEdit(button));
    });

    document.querySelectorAll('[data-category-delete]').forEach((button) => {
        button.addEventListener('click', () => {
            if (window.confirm('Tem a certeza que pretende desativar esta categoria?')) {
                handleDelete(button.dataset.categoryDelete);
            }
        });
    });
}

export { init };
