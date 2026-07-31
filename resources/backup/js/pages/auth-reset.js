/**
 * Password Reset Module
 * Handles password reset form submission
 */

import { authHeaderJson } from '../utils/api.js';

function setMsg(message, type) {
    const msg = document.getElementById('msg');
    if (!msg) return;
    
    msg.classList.remove('hidden');
    msg.className = 'mb-6 min-h-[48px] items-center justify-center rounded-2xl border px-4 text-sm font-medium flex ' +
        (type === 'error'
            ? 'border-red-300 bg-red-50 text-red-700 dark:border-red-800 dark:bg-red-950/30 dark:text-red-400'
            : 'border-emerald-300 bg-emerald-50 text-emerald-700 dark:border-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-400');
    msg.textContent = message;
}

function setLoading(loading) {
    const btn = document.querySelector('#resetForm button[type="submit"]');
    if (!btn) return;
    btn.disabled = loading;
    btn.classList.toggle('opacity-80', loading);
    btn.classList.toggle('cursor-not-allowed', loading);
    btn.innerHTML = loading
        ? `<span class="inline-flex items-center gap-2"><svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" class="opacity-20"></circle><path fill="currentColor" class="opacity-90" d="M4 12a8 8 0 018-8V0A12 12 0 000 12h4z"></path></svg>A processar...</span>`
        : `Repor password <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>`;
}

function init() {
    const resetForm = document.getElementById('resetForm');
    if (!resetForm) return;

    resetForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const email = document.getElementById('resetEmail').value;
        const password = document.getElementById('resetPassword').value;
        const passwordConfirmation = document.getElementById('resetPasswordConfirmation').value;
        const token = document.querySelector('input[name="token"]').value;

        if (password !== passwordConfirmation) {
            setMsg("As passwords não coincidem.", 'error');
            return;
        }

        if (password.length < 8) {
            setMsg("A password deve ter pelo menos 8 caracteres.", 'error');
            return;
        }

        setLoading(true);

        try {
            const res = await fetch('/api/password/reset', {
                method: 'POST',
                credentials: 'include',
                headers: authHeaderJson(),
                body: JSON.stringify({ email, password, password_confirmation: passwordConfirmation, token })
            });

            const j = await res.json().catch(() => ({}));

            if (res.status !== 200) {
                setMsg(j.message || j.errors?.password?.[0] || "Erro ao repor password.", 'error');
                setLoading(false);
                return;
            }

            setMsg("Password reposta com sucesso! A redirecionar para o login...", 'success');
            setLoading(false);
            setTimeout(() => { window.location.href = '/ui/login'; }, 2000);
        } catch (err) {
            setMsg("Falha na comunicação com o servidor.", 'error');
            setLoading(false);
        }
    });
}

export { init };
