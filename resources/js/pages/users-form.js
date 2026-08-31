/**
 * User Form Module
 * Handles user creation and edit forms
 */

import { authHeader, authPatch, authPost } from '../utils/api.js';

let targetUserId = null;
let targetProfileId = null;

async function loadProfiles() {
    const select = document.getElementById('userProfileId');
    if (!select) return;
    
    try {
        const res = await fetch('/admin/profiles', { headers: authHeader() });
        if (!res.ok) throw new Error(window.SGM_UI_I18N?.loadError || 'Unable to load the data at the moment.');

        const data = await res.json();
        const profiles = data.profiles || [];

        const translations = window.SGM_USER_MANAGEMENT_I18N || {};
        select.innerHTML = `<option value="">${translations.profileLoading || 'Select a profile...'}</option>`;
        select.removeAttribute('disabled');

        profiles.forEach(p => {
            const opt = document.createElement('option');
            opt.value = p.id;

            let label = p.name;
            if (p.name === 'admin') label = translations.admin || 'Administrator';
            else if (p.name === 'technician') label = translations.technician || 'Technician';
            else if (p.name === 'user') label = translations.user || 'User';

            opt.textContent = label;

            if (targetProfileId && String(p.id) === String(targetProfileId)) {
                opt.selected = true;
            }

            select.appendChild(opt);
        });
    } catch (e) {
        console.error((window.SGM_UI_I18N?.loadError || 'Error loading profiles:'), e);
        select.innerHTML = '<option value="">' + (window.SGM_USER_MANAGEMENT_I18N?.loadProfilesError || 'Error loading access profiles') + '</option>';
    }
}

function handleCreateSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const message = document.getElementById('formMessage');
    const submitBtn = document.getElementById('submitBtn');

    const name = document.getElementById('userName').value.trim();
    const email = document.getElementById('userEmail').value.trim();
    const password = document.getElementById('userPassword').value;
    const profile_id = document.getElementById('userProfileId').value;
    const active = document.getElementById('userActive').checked;
    const passwordConfirmation = document.getElementById('userPasswordConfirmation');

    if (password && passwordConfirmation && password !== passwordConfirmation.value) {
        const translations = window.SGM_USER_MANAGEMENT_I18N || {};
        message.textContent = translations.passwordMismatch || 'The passwords do not match.';
        message.className = 'min-h-6 text-sm font-medium text-danger';
        return;
    }

    message.textContent = (window.SGM_UI_I18N?.saving || 'Saving user...');
    message.className = 'min-h-6 text-sm font-medium text-[var(--text-soft)]';
    submitBtn.disabled = true;

    authPost('/admin/users', { name, email, password, profile_id, active })
    .then(res => res.json().catch(() => ({})))
    .then(data => {
        if (!data.ok && data.status !== undefined) {
            let errorText = data.message || (window.SGM_UI_I18N?.genericError || 'Error creating user.');
            if (data.errors) {
                errorText = Object.values(data.errors).flat().join(' ');
            }
            throw new Error(errorText);
        }
        
        if (data.message && data.message.includes('Erro')) {
            throw new Error(data.message);
        }

        message.textContent = (window.SGM_UI_I18N?.createdSuccess || 'User created successfully!');
        message.className = 'min-h-6 text-sm font-medium text-success';
        setTimeout(() => { window.location.href = '/ui/users'; }, 1500);
    })
    .catch(err => {
        message.textContent = err.message;
        message.className = 'min-h-6 text-sm font-medium text-danger';
        submitBtn.disabled = false;
    });
}

function handleEditSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const message = document.getElementById('formMessage');
    const submitBtn = document.getElementById('submitBtn');

    const name = document.getElementById('userName').value.trim();
    const email = document.getElementById('userEmail').value.trim();
    const password = document.getElementById('userPassword').value;
    const profile_id = document.getElementById('userProfileId').value;
    const active = document.getElementById('userActive').checked;
    const passwordConfirmation = document.getElementById('userPasswordConfirmation');

    if (password && passwordConfirmation && password !== passwordConfirmation.value) {
        const translations = window.SGM_USER_MANAGEMENT_I18N || {};
        message.textContent = translations.passwordMismatch || 'The passwords do not match.';
        message.className = 'min-h-6 text-sm font-medium text-danger';
        return;
    }

    const payload = { name, email, profile_id, active };

    if (password) {
        payload.password = password;
    }

    message.textContent = (window.SGM_UI_I18N?.saving || 'Saving changes...');
    message.className = 'min-h-6 text-sm font-medium text-[var(--text-soft)]';
    submitBtn.disabled = true;

    authPatch(`/admin/users/${targetUserId}`, payload)
    .then(res => res.json().catch(() => ({})))
    .then(data => {
        if (!data.ok && data.status !== undefined) {
            let errorText = data.message || (window.SGM_UI_I18N?.genericError || 'Error updating user.');
            if (data.errors) {
                errorText = Object.values(data.errors).flat().join(' ');
            }
            throw new Error(errorText);
        }

        if (data.message && data.message.includes('Erro')) {
            throw new Error(data.message);
        }

        message.textContent = (window.SGM_UI_I18N?.updatedSuccess || 'User updated successfully! Redirecting...');
        message.className = 'min-h-6 text-sm font-medium text-success';
        setTimeout(() => { window.location.href = '/ui/users'; }, 1500);
    })
    .catch(err => {
        message.textContent = err.message;
        message.className = 'min-h-6 text-sm font-medium text-danger';
        submitBtn.disabled = false;
    });
}

function initAvatarPreview() {
    const input = document.getElementById('avatarInput');
    const label = document.getElementById('avatarFileName');
    if (!input || !label) return;
    input.addEventListener('change', () => {
        label.textContent = input.files?.[0]?.name || (window.SGM_TICKET_MEDIA_I18N?.noFileSelected || 'No file selected');
    });
}

function init() {
    initAvatarPreview();
    const container = document.querySelector('[data-user-mode]');
    if (container) {
        const mode = container.dataset.userMode;
        if (mode === 'edit') {
            targetUserId = container.dataset.userId;
            targetProfileId = container.dataset.profileId;
        }
    }

    loadProfiles();

    const createForm = document.getElementById('createUserForm');
    if (createForm) {
        createForm.addEventListener('submit', handleCreateSubmit);
    }

    const editForm = document.getElementById('editUserForm');
    if (editForm) {
        editForm.addEventListener('submit', handleEditSubmit);
    }
}

export { init };
