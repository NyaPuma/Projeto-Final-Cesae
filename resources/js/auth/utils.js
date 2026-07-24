/*
|--------------------------------------------------------------------------
| Authentication Utilities (Otimizado)
|--------------------------------------------------------------------------
|
| Funções auxiliares para API, DOM e Estado da UI.
|
*/

// Configurações
const STORAGE_PREFIX = '';  // Compatível com auth_token (sem prefixo) usado no login
const FETCH_TIMEOUT = 10000; // 10 segundos

/*
|--------------------------------------------------------------------------
| Seletores
|--------------------------------------------------------------------------
*/

export const qs = (selector, parent = document) => parent.querySelector(selector);
export const qsa = (selector, parent = document) => [...parent.querySelectorAll(selector)];

/*
|--------------------------------------------------------------------------
| CSRF & Headers
|--------------------------------------------------------------------------
*/

export const getCsrfToken = () => qs('meta[name="csrf-token"]')?.content ?? '';

export const getHeaders = (customHeaders = {}) => ({
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': getCsrfToken(),
    'X-Requested-With': 'XMLHttpRequest',
    ...customHeaders
});

/*
|--------------------------------------------------------------------------
| Fetch Wrapper (Com Timeout)
|--------------------------------------------------------------------------
*/

export async function request(url, options = {}) {
    const controller = new AbortController();
    const timeoutId = setTimeout(() => controller.abort(), FETCH_TIMEOUT);

    try {
        const response = await fetch(url, {
            ...options,
            headers: getHeaders(options.headers || {}),
            signal: controller.signal
        });

        clearTimeout(timeoutId);

        let data = {};
        try {
            data = await response.json();
        } catch {
            data = {};
        }

        return {
            ok: response.ok,
            status: response.status,
            data
        };
    } catch (error) {
        clearTimeout(timeoutId);

        // Retorna erro estruturado caso o timeout ou erro de rede ocorra
        return {
            ok: false,
            status: error.name === 'AbortError' ? 408 : 500,
            data: { message: error.message || 'Erro de conexão' }
        };
    }
}

export const post = (url, body = {}) => request(url, { method: 'POST', body: JSON.stringify(body) });
export const get = (url) => request(url, { method: 'GET' });

/*
|--------------------------------------------------------------------------
| Local Storage
|--------------------------------------------------------------------------
*/

export const saveToken = (token) => token && localStorage.setItem(`${STORAGE_PREFIX}auth_token`, token);
export const getToken = () => localStorage.getItem(`${STORAGE_PREFIX}auth_token`);
export const removeToken = () => localStorage.removeItem(`${STORAGE_PREFIX}auth_token`);

/*
|--------------------------------------------------------------------------
| UI Helpers
|--------------------------------------------------------------------------
*/

export const delay = (ms = 300) => new Promise(resolve => setTimeout(resolve, ms));

export const formToObject = (form) => Object.fromEntries(new FormData(form).entries());

export const show = (element) => element?.classList.remove('hidden');
export const hide = (element) => element?.classList.add('hidden');
export const toggle = (element, state) => element?.classList.toggle('hidden', !state);

/*
|--------------------------------------------------------------------------
| Button State (Com Acessibilidade Aumentada)
|--------------------------------------------------------------------------
*/

export function setButtonLoading(button, loading = true) {
    if (!button) return;

    const text = button.querySelector('.button-text');
    const loader = button.querySelector('.button-loader');

    // Acessibilidade WCAG
    button.disabled = loading;
    button.setAttribute('aria-busy', loading);
    button.setAttribute('aria-disabled', loading);

    if (text) text.classList.toggle('hidden', loading);
    if (loader) loader.classList.toggle('hidden', !loading);
}
