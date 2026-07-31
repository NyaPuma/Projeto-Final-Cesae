import { qs, formToObject, post, saveToken } from './utils';

function getMsgEl() {
    return qs('#msg');
}

function updateMsg(message, type) {
    const msg = getMsgEl();
    if (!msg) return;
    msg.classList.remove('hidden');
    msg.className = 'mt-5 min-h-[42px] rounded-2xl text-center text-sm font-medium flex items-center justify-center transition-all ' +
        (type === 'error'
            ? 'text-red-600 dark:text-red-400 bg-red-500/5 border border-red-500/10'
            : type === 'loading'
                ? 'text-amber-600 dark:text-amber-400 animate-pulse'
                : 'text-emerald-600 dark:text-emerald-400 bg-emerald-500/5 border border-emerald-500/10');
    msg.textContent = message;
}

function setButtonLoading(btn, loading) {
    if (!btn) return;
    btn.disabled = loading;
    btn.classList.toggle('opacity-80', loading);
    btn.classList.toggle('cursor-not-allowed', loading);
    if (loading) {
        btn.innerHTML = '<span class="inline-flex items-center gap-2"><svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" class="opacity-20"></circle><path fill="currentColor" class="opacity-90" d="M4 12a8 8 0 018-8V0A12 12 0 000 12h4z"></path></svg> A autenticar...</span>';
    } else {
        btn.innerHTML = 'Entrar no Sistema <svg class="w-4 h-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>';
    }
}

function initPasswordToggle() {
    const btn = qs('#togglePassword');
    const input = qs('#loginPassword') || qs('#password');
    if (!btn || !input) return;
    btn.addEventListener('click', () => {
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        btn.textContent = isPassword ? 'Ocultar' : 'Mostrar';
    });
}

export function initLogin() {
    const form = qs('#loginForm');
    if (!form) return;
    initPasswordToggle();
    form.addEventListener('submit', submitLogin);
}

async function submitLogin(event) {
    event.preventDefault();
    const form = event.currentTarget;
    const button = qs('button[type="submit"]', form);
    const data = formToObject(form);

    if (data.email) data.email = data.email.trim();

    setButtonLoading(button, true);
    updateMsg('A verificar credenciais no servidor...', 'loading');

    try {
        const response = await post('/login', {
            email: data.email,
            password: data.password
        });

        if (!response.ok) {
            updateMsg(response.data.message || 'Credenciais de acesso incorretas.', 'error');
            setButtonLoading(button, false);
            return;
        }

        if (response.data.token) {
            saveToken(response.data.token, response.data.user);
        }

        updateMsg('Autentica\u00e7\u00e3o bem-sucedida! A redirecionar...', 'success');
        setButtonLoading(button, false);

        setTimeout(() => {
            window.location.href = '/ui';
        }, 500);

    } catch (error) {
        updateMsg('Falha cr\u00edtica na comunica\u00e7\u00e3o com o servidor.', 'error');
        setButtonLoading(button, false);
    }
}
