/**
 * Authentication Pages Module
 * Gestão da autenticação (login, register, etc.)
 */

/**
 * Initialize login form
 */
export function initLogin() {
    const loginForm = document.getElementById('loginForm');
    const loginEmail = document.getElementById('email') || document.getElementById('loginEmail');
    const loginPassword = document.getElementById('password') || document.getElementById('loginPassword');
    const togglePasswordBtn = document.getElementById('togglePassword');
    const msg = document.getElementById('msg');

    if (!loginForm) {
        return;
    }

    /**
     * Display message to user
     * @param {string} message - Message text
     * @param {string} type - Message type (error/success)
     */
    function setMsg(message, type) {
        if (!msg) return;
        
        msg.classList.remove('hidden');
        msg.className = 'mt-4 text-center text-xs font-bold p-3 rounded-xl border animate-[fadeIn_0.2s_ease-out] flex items-center justify-center ' +
            (type === 'error'
                ? 'border-red-500/20 bg-red-500/10 text-red-600 dark:text-red-400'
                : 'border-emerald-500/20 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400');
        msg.textContent = message;
    }

    /**
     * Toggle password visibility
     */
    function togglePassword() {
        if (!loginPassword || !togglePasswordBtn) return;
        
        const isPassword = loginPassword.type === 'password';
        loginPassword.type = isPassword ? 'text' : 'password';
        togglePasswordBtn.textContent = isPassword ? 'Ocultar' : 'Mostrar';
    }

    /**
     * Handle form submission
     * @param {Event} event - Submit event
     */
    async function handleLoginSubmit(event) {
        event.preventDefault();
        if (!loginEmail || !loginPassword) return;

        const submitBtn = loginForm.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-80', 'cursor-not-allowed');
            submitBtn.innerHTML = `<span class="inline-flex items-center gap-2"><svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" class="opacity-20"></circle><path fill="currentColor" class="opacity-90" d="M4 12a8 8 0 018-8V0A12 12 0 000 12h4z"></path></svg> A autenticar...</span>`;
        }

        setMsg('A verificar as suas credenciais...', 'success');

        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        try {
            const res = await fetch('/login', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    ...(csrf ? { 'X-CSRF-TOKEN': csrf } : {})
                },
                body: JSON.stringify({
                    email: loginEmail.value,
                    password: loginPassword.value
                })
            });

            const j = await res.json().catch(() => ({}));

            if (res.status !== 200) {
                setMsg(j.message || 'Credenciais inválidas.', 'error');
                
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-80', 'cursor-not-allowed');
                    submitBtn.innerHTML = `Entrar no sistema <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>`;
                }
                return;
            }

            // Guardar token em ambos os formatos para compatibilidade total
            if (j.token) {
                document.cookie = `api_token=${j.token}; path=/; max-age=2592000; SameSite=Lax`;
                document.cookie = `auth_token=${j.token}; path=/; max-age=2592000; SameSite=Lax`;
                try {
                    localStorage.setItem('api_token', j.token);
                    localStorage.setItem('auth_token', j.token);
                    localStorage.setItem('user_name', j.user?.name || 'Utilizador');
                    localStorage.setItem('user_role', j.user?.profile?.name || 'user');
                } catch (e) {}
            }

            setMsg('Autenticação bem-sucedida! A redirecionar...', 'success');
            
            setTimeout(() => { window.location.href = '/ui'; }, 500);
        } catch (err) {
            setMsg('Falha crítica na comunicação com o servidor.', 'error');
            
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-80', 'cursor-not-allowed');
                submitBtn.innerHTML = `Entrar no sistema <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>`;
            }
        }
    }

    // Event Listeners
    togglePasswordBtn?.addEventListener('click', togglePassword);
    loginForm?.addEventListener('submit', handleLoginSubmit);
}

/**
 * Initialize all auth pages
 */
export function initAuth() {
    initLogin();
}

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAuth);
} else {
    initAuth();
}