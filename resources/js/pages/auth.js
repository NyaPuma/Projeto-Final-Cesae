/**
 * Authentication Pages Module
 * Gestão da autenticação (login, register, etc.)
 */

/**
 * Initialize login form
 */
export function initLogin() {
    const loginForm = document.getElementById('loginForm');
    const loginEmail = document.getElementById('loginEmail');
    const loginPassword = document.getElementById('loginPassword');
    const togglePasswordBtn = document.getElementById('togglePassword');
    const msg = document.getElementById('msg');

    if (!loginForm) {
        if (process.env.NODE_ENV === 'development') {
            console.warn('[Login] #loginForm not found');
        }
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
        msg.className = 'mb-6 min-h-[48px] items-center justify-center rounded-2xl border px-4 text-sm font-medium flex ' +
            (type === 'error'
                ? 'border-red-300 bg-red-50 text-red-700 dark:border-red-800 dark:bg-red-950/30 dark:text-red-400'
                : 'border-emerald-300 bg-emerald-50 text-emerald-700 dark:border-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-400');
        msg.textContent = message;
    }

    /**
     * Toggle password visibility
     */
    function togglePassword() {
        if (!loginPassword || !togglePasswordBtn) return;
        
        const isPassword = loginPassword.type === 'password';
        loginPassword.type = isPassword ? 'text' : 'password';
        togglePasswordBtn.textContent = isPassword ? "{{ __('Ocultar') }}" : "{{ __('Mostrar') }}";
    }

    /**
     * Handle form submission
     * @param {Event} event - Submit event
     */
    async function handleLoginSubmit(event) {
        event.preventDefault();
        if (!loginEmail || !loginPassword) return;

        // Set loading state
        const submitBtn = loginForm.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-80', 'cursor-not-allowed');
            submitBtn.innerHTML = `<span class="inline-flex items-center gap-2"><svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" class="opacity-20"></circle><path fill="currentColor" class="opacity-90" d="M4 12a8 8 0 018-8V0A12 12 0 000 12h4z"></path></svg>{{ __('A autenticar...') }}</span>`;
        }

        setMsg("{{ __('A verificar as suas credenciais...') }}", 'success');

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
                setMsg(j.message || "{{ __('Credenciais inválidas.') }}", 'error');
                
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-80', 'cursor-not-allowed');
                    submitBtn.innerHTML = `{{ __('Entrar no sistema') }} <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>`;
                }
                return;
            }

            // Save token
            if (j.token) {
                document.cookie = `api_token=${j.token}; path=/; max-age=2592000; SameSite=Lax`;
                try {
                    localStorage.setItem('api_token', j.token);
                    localStorage.setItem('user_name', j.user?.name || 'Utilizador');
                    localStorage.setItem('user_role', j.user?.profile?.name || 'user');
                } catch (e) {}
            }

            setMsg("{{ __('Autenticação bem-sucedida! A redirecionar...') }}", 'success');
            
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-80', 'cursor-not-allowed');
                submitBtn.innerHTML = `{{ __('Entrar no sistema') }} <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>`;
            }
            
            setTimeout(() => { window.location.href = '/ui'; }, 500);
        } catch (err) {
            setMsg("{{ __('Falha crítica na comunicação com o servidor.') }}", 'error');
            
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-80', 'cursor-not-allowed');
                submitBtn.innerHTML = `{{ __('Entrar no sistema') }} <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>`;
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
