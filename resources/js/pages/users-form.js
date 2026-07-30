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
        if (!res.ok) throw new Error('Não foi possível carregar os perfis.');

        const data = await res.json();
        const profiles = data.profiles || [];

        select.innerHTML = '<option value="">Selecione um perfil...</option>';
        select.removeAttribute('disabled');

        profiles.forEach(p => {
            const opt = document.createElement('option');
            opt.value = p.id;

            let label = p.name;
            if (p.name === 'admin') label = 'Administrador';
            else if (p.name === 'technician') label = 'Técnico de Manutenção';
            else if (p.name === 'user') label = 'Utilizador Comum';

            opt.textContent = label;

            if (targetProfileId && String(p.id) === String(targetProfileId)) {
                opt.selected = true;
            }

            select.appendChild(opt);
        });
    } catch (e) {
        console.error('Erro ao carregar perfis:', e);
        select.innerHTML = '<option value="">Erro ao carregar perfis de acesso</option>';
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

    message.textContent = 'A guardar utilizador...';
    message.className = 'min-h-6 text-sm font-medium text-[var(--text-soft)]';
    submitBtn.disabled = true;

    authPost('/admin/users', { name, email, password, profile_id, active })
    .then(res => res.json().catch(() => ({})))
    .then(data => {
        if (!data.ok && data.status !== undefined) {
            let errorText = data.message || 'Erro ao criar utilizador.';
            if (data.errors) {
                errorText = Object.values(data.errors).flat().join(' ');
            }
            throw new Error(errorText);
        }
        
        if (data.message && data.message.includes('Erro')) {
            throw new Error(data.message);
        }

        message.textContent = 'Utilizador criado com sucesso!';
        message.className = 'min-h-6 text-sm font-medium text-emerald-600 dark:text-emerald-400';
        setTimeout(() => { window.location.href = '/ui/users'; }, 1500);
    })
    .catch(err => {
        message.textContent = err.message;
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
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

    const payload = { name, email, profile_id, active };

    if (password) {
        payload.password = password;
    }

    message.textContent = 'A guardar alterações...';
    message.className = 'min-h-6 text-sm font-medium text-[var(--text-soft)]';
    submitBtn.disabled = true;

    authPatch(`/admin/users/${targetUserId}`, payload)
    .then(res => res.json().catch(() => ({})))
    .then(data => {
        if (!data.ok && data.status !== undefined) {
            let errorText = data.message || 'Erro ao editar utilizador.';
            if (data.errors) {
                errorText = Object.values(data.errors).flat().join(' ');
            }
            throw new Error(errorText);
        }

        if (data.message && data.message.includes('Erro')) {
            throw new Error(data.message);
        }

        message.textContent = 'Utilizador atualizado com sucesso! A redirecionar...';
        message.className = 'min-h-6 text-sm font-medium text-emerald-600 dark:text-emerald-400';
        setTimeout(() => { window.location.href = '/ui/users'; }, 1500);
    })
    .catch(err => {
        message.textContent = err.message;
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
        submitBtn.disabled = false;
    });
}

function init() {
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
