import { qs, formToObject, post, saveToken } from './utils';

function getMsgEl() {
    return qs('#msg');
}

function updateMsg(message, type) {
    const msg = getMsgEl();
    if (!msg) return;
    msg.classList.remove('hidden');
    msg.className = 'mb-6 min-h-[48px] items-center justify-center rounded-2xl border px-4 text-sm font-medium transition-all ' +
        (type === 'error'
            ? 'border-danger/20 bg-danger/5 text-danger'
            : type === 'loading'
                ? 'text-warning animate-pulse'
                : 'border-success/20 bg-success/5 text-success');
    msg.textContent = message;
}

const SPINNER_HTML = '<svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" class="opacity-20"></circle><path fill="currentColor" class="opacity-90" d="M4 12a8 8 0 018-8V0A12 12 0 000 12h4z"></path></svg>';

function setButtonLoading(btn, loading) {
    if (!btn) return;
    btn.disabled = loading;
    btn.setAttribute('aria-busy', String(loading));
    if (loading) {
        if (btn.dataset.originalContent === undefined) {
            btn.dataset.originalContent = btn.innerHTML;
        }
        btn.innerHTML = `<span class="inline-flex items-center gap-2">${SPINNER_HTML} A autenticar...</span>`;
    } else {
        btn.innerHTML = btn.dataset.originalContent || '';
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

        updateMsg('Autenticação bem-sucedida! A redirecionar...', 'success');
        setButtonLoading(button, false);

        setTimeout(() => {
            window.location.href = '/ui';
        }, 500);

    } catch (error) {
        updateMsg('Falha crítica na comunicação com o servidor.', 'error');
        setButtonLoading(button, false);
    }
}
