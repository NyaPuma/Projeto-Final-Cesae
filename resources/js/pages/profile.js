/**
 * Profile Management Module
 * Handles profile update functionality
 */

import { authHeaderJson } from '../utils/api.js';

async function updateProfile(event) {
    event.preventDefault();
    const message = document.getElementById('profileMessage');
    const form = document.getElementById('profileForm');
    const submitBtn = document.getElementById('submitBtn');

    const name = document.getElementById('profileName').value.trim();
    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;

    if (!name) {
        message.textContent = "{{ __('Introduza um nome para continuar.') }}";
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
        return;
    }

    message.textContent = "{{ __('A guardar alterações...') }}";
    message.className = 'min-h-6 text-sm font-medium text-[var(--text-soft)]';
    submitBtn.disabled = true;

    try {
        const res = await fetch('/profile/update', {
            method: 'POST',
            headers: authHeaderJson(),
            body: JSON.stringify({
                name,
                current_password: currentPassword,
                new_password: newPassword,
            })
        });

        const data = await res.json().catch(() => ({}));
        if (!res.ok) {
            throw new Error(data.message || "{{ __('Não foi possível atualizar o perfil.') }}");
        }

        if (data.user?.name) {
            localStorage.setItem('user_name', data.user.name);
            const displayUserName = document.getElementById('displayUserName');
            const displayUserAvatar = document.getElementById('displayUserAvatar');
            if (displayUserName) displayUserName.textContent = data.user.name;
            if (displayUserAvatar) displayUserAvatar.textContent = data.user.name.charAt(0).toUpperCase();
        }
        if (data.user?.profile?.name) {
            localStorage.setItem('user_role', data.user.profile.name);
        }

        document.getElementById('currentPassword').value = '';
        document.getElementById('newPassword').value = '';

        message.textContent = "{{ __('Perfil atualizado com sucesso.') }}";
        message.className = 'min-h-6 text-sm font-medium text-emerald-600 dark:text-emerald-400';
    } catch (error) {
        message.textContent = error.message || "{{ __('Não foi possível atualizar o perfil.') }}";
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
    } finally {
        submitBtn.disabled = false;
    }
}

function init() {
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', updateProfile);
    }
}

export { init };
