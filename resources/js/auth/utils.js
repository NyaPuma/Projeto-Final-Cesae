/*
|--------------------------------------------------------------------------
| Authentication Utilities
|--------------------------------------------------------------------------
|
| Helper functions for API, DOM, and UI State.
|
*/

// Configuration
const STORAGE_PREFIX = '';  // Compatible with auth_token (no prefix) used in login
const FETCH_TIMEOUT = 10000; // 10 seconds

/*
|--------------------------------------------------------------------------
| Selectors
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

export const getHeaders = (customHeaders = {}) => {
    const headers = {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
        'X-Requested-With': 'XMLHttpRequest',
        ...customHeaders,
    };

    const token = getToken();

    if (token) {
        headers['Authorization'] = `Bearer ${token}`;
        headers['X-Auth-Token'] = token;
    }

    return headers;
};

/*
|--------------------------------------------------------------------------
| Fetch Wrapper (With Timeout)
|--------------------------------------------------------------------------
*/

export async function request(url, options = {}) {
    const controller = new AbortController();
    const timeoutId = setTimeout(() => controller.abort(), FETCH_TIMEOUT);

    try {
        const response = await fetch(url, {
            credentials: 'same-origin',
            ...options,
            headers: getHeaders(options.headers ?? {}),
            signal: controller.signal,
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
            data,
            redirected: response.redirected,
            url: response.url,
        };
    } catch (error) {
        clearTimeout(timeoutId);

        return {
            ok: false,
            status: error.name === 'AbortError' ? 408 : 500,
            data: {
                message: error.message || 'Erro de ligação',
            },
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

export const saveToken = (token, user = null) => {
    if (!token) return;
    localStorage.setItem(`${STORAGE_PREFIX}api_token`, token);
    localStorage.setItem(`${STORAGE_PREFIX}auth_token`, token);
    document.cookie = `api_token=${token}; path=/; max-age=2592000; SameSite=Lax`;
    document.cookie = `auth_token=${token}; path=/; max-age=2592000; SameSite=Lax`;
    if (user) {
        localStorage.setItem(`${STORAGE_PREFIX}user_name`, user.name || 'Utilizador');
        localStorage.setItem(`${STORAGE_PREFIX}user_role`, user.profile?.name || 'user');
    }
};
export const getToken = () => localStorage.getItem(`${STORAGE_PREFIX}api_token`) || localStorage.getItem(`${STORAGE_PREFIX}auth_token`);
export const removeToken = () => {
    localStorage.removeItem(`${STORAGE_PREFIX}api_token`);
    localStorage.removeItem(`${STORAGE_PREFIX}auth_token`);
};

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
| Button State (With Enhanced Accessibility)
|--------------------------------------------------------------------------
*/

export function setButtonLoading(button, loading = true) {
    if (!button) return;

    const text = button.querySelector('.button-text');
    const loader = button.querySelector('.button-loader');

    // WCAG Accessibility
    button.disabled = loading;
    button.setAttribute('aria-busy', loading);
    button.setAttribute('aria-disabled', loading);

    if (text) text.classList.toggle('hidden', loading);
    if (loader) loader.classList.toggle('hidden', !loading);
}
