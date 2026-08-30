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
            ? 'border-danger/20 bg-danger/5 text-danger'
            : 'border-success/20 bg-success/5 text-success');
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
                setMsg(j.message || j.errors?.password?.[0] || (window.SGM_UI_I18N?.genericError || "Error resetting password."), 'error');
                setLoading(false);
                return;
            }

            setMsg((window.SGM_UI_I18N?.updatedSuccess || 'Password reset successfully! Redirecting to login...'), 'success');
            setLoading(false);
            setTimeout(() => { window.location.href = '/ui/login'; }, 2000);
        } catch (err) {
            setMsg("Falha na comunicação com o servidor.", 'error');
            setLoading(false);
        }
    });
}

export { init };
