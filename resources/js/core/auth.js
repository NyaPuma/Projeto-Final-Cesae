/**
 * Authentication Module
 * Handles authentication state, headers, and session management
 */

export function authHeader() {
    const token = localStorage.getItem('auth_token');
    const headers = {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

    if (token) {
        headers['Authorization'] = 'Bearer ' + token;
    }
    return headers;
}

export function isAuthenticated() {
    return !!localStorage.getItem('auth_token');
}

export function requireAuth(loginUrl) {
    if (!isAuthenticated()) {
        window.location = loginUrl;
        return false;
    }
    return true;
}

export function logout(logoutUrl) {
    const token = localStorage.getItem('auth_token');
    const loginUrl = document.body?.dataset?.loginUrl || '/ui/login';

    fetch(logoutUrl, {
        method: 'POST',
        headers: Object.assign({
            'Content-Type': 'application/json'
        }, authHeader())
    })
    .catch(() => {
        // proceed to local cleanup even if the server call fails,
        // so the user is never left logged in
    })
    .finally(() => {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('api_token');
        localStorage.removeItem('user_name');
        localStorage.removeItem('user_role');
        localStorage.removeItem('theme');
        localStorage.removeItem('theme_name');
        document.cookie = 'auth_token=; path=/; max-age=0; SameSite=Lax';
        document.cookie = 'api_token=; path=/; max-age=0; SameSite=Lax';
        window.location = loginUrl;
    });
}

export function getUserData() {
    return {
        name: localStorage.getItem('user_name') || 'Utilizador',
        role: localStorage.getItem('user_role') || 'Utilizador',
        token: localStorage.getItem('auth_token')
    };
}

/**
 * The raw role slug of the authenticated user ('admin' | 'technician' | 'user'),
 * read from the `user-role` meta tag rendered by the server. Returns null when
 * no role is available (e.g. guest pages).
 */
export function getUserRole() {
    const el = document.querySelector('meta[name="user-role"]');
    return el ? el.getAttribute('content') : null;
}

/**
 * Whether the authenticated user is a technician.
 */
export function isTechnician() {
    return getUserRole() === 'technician';
}
