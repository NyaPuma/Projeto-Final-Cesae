import { authHeaderJson } from '../utils/api.js';

function getForm() {
    return document.getElementById('profileForm');
}

function getMessageElement() {
    return document.getElementById('profileMessage');
}

function getSubmitButton() {
    return document.getElementById('submitBtn');
}

function getMessages(form) {
    return {
        validation: form?.dataset.validationMessage || 'Introduza um nome para continuar.',
        saving: form?.dataset.savingMessage || 'A guardar alterações...',
        success: form?.dataset.successMessage || 'Perfil atualizado com sucesso.',
        error: form?.dataset.errorMessage || 'Não foi possível atualizar o perfil.',
    };
}

function setMessage(message, tone = 'neutral') {
    const element = getMessageElement();

    if (!element) {
        return;
    }

    const tones = {
        neutral: 'min-h-6 text-sm font-medium text-[var(--text-soft)]',
        success: 'min-h-6 text-sm font-medium text-emerald-600 dark:text-emerald-400',
        error: 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400',
    };

    element.textContent = message;
    element.className = tones[tone] || tones.neutral;
}

async function updateProfile(event) {
    event.preventDefault();

    const form = getForm();
    const submitBtn = getSubmitButton();
    const messages = getMessages(form);

    const name = document.getElementById('profileName')?.value.trim() || '';
    const currentPassword = document.getElementById('currentPassword')?.value || '';
    const newPassword = document.getElementById('newPassword')?.value || '';

    if (!name) {
        setMessage(messages.validation, 'error');
        return;
    }

    setMessage(messages.saving, 'neutral');

    if (submitBtn) {
        submitBtn.disabled = true;
    }

    try {
        const res = await fetch('/profile/update', {
            method: 'POST',
            credentials: 'same-origin',
            headers: authHeaderJson(),
            body: JSON.stringify({
                name,
                current_password: currentPassword,
                new_password: newPassword,
            })
        });

        const data = await res.json().catch(() => ({}));

        if (!res.ok) {
            throw new Error(data.message || messages.error);
        }

        if (data.user?.name) {
            localStorage.setItem('user_name', data.user.name);
            document.getElementById('displayUserName')?.replaceChildren(document.createTextNode(data.user.name));
            document.getElementById('displayUserAvatar')?.replaceChildren(document.createTextNode(data.user.name.charAt(0).toUpperCase()));
        }

        if (data.user?.profile?.name) {
            localStorage.setItem('user_role', data.user.profile.name);
        }

        const currentPasswordField = document.getElementById('currentPassword');
        const newPasswordField = document.getElementById('newPassword');

        if (currentPasswordField) currentPasswordField.value = '';
        if (newPasswordField) newPasswordField.value = '';

        setMessage(messages.success, 'success');
    } catch (error) {
        setMessage(error.message || messages.error, 'error');
    } finally {
        if (submitBtn) {
            submitBtn.disabled = false;
        }
    }
}

function init() {
    const profileForm = getForm();

    if (!profileForm) {
        return;
    }

    profileForm.addEventListener('submit', updateProfile);
}

export { init };
