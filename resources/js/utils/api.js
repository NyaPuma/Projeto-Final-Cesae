/**
 * API Utilities Module
 * Shared utility functions for API calls, authentication headers, and common operations
 */

/**
 * Get authentication headers for API requests
 * @returns {Object} Headers object with Authorization and CSRF token
 */
export function authHeader() {
    const token = localStorage.getItem('auth_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) headers['Authorization'] = 'Bearer ' + token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

    return headers;
}

/**
 * Get authentication headers with JSON content type
 * @returns {Object} Headers object with Authorization, CSRF token, and Content-Type
 */
export function authHeaderJson() {
    const headers = authHeader();
    headers['Content-Type'] = 'application/json';
    return headers;
}

/**
 * Get authentication headers for form data (multipart)
 * @returns {Object} Headers object with Authorization and CSRF token (no Content-Type)
 */
export function authHeaderFormData() {
    const token = localStorage.getItem('auth_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) headers['Authorization'] = 'Bearer ' + token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

    return headers;
}

/**
 * Check if user is authenticated
 * @returns {boolean} True if auth token exists
 */
export function isAuthenticated() {
    return !!localStorage.getItem('auth_token');
}

/**
 * Check if current user is admin
 * @returns {boolean} True if user has admin role
 */
export function isAdmin() {
    const bodyDataset = document.body?.dataset || {};
    if (bodyDataset.userAdmin !== undefined) return bodyDataset.userAdmin === '1' || bodyDataset.userAdmin === 'true';
    if (localStorage.getItem('user_role') === 'admin') return true;

    try {
        const token = localStorage.getItem('auth_token');
        if (!token) return false;
        const base64Url = token.split('.')[1];
        const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        const payload = JSON.parse(window.atob(base64));
        return payload.role === 'admin' || payload.isAdmin === true;
    } catch (e) {
        return false;
    }
}

/**
 * Get current user from JWT token
 * @returns {Object|null} User payload or null
 */
export function getCurrentUser() {
    try {
        const token = localStorage.getItem('auth_token');
        if (!token) return null;
        const base64Url = token.split('.')[1];
        const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        return JSON.parse(window.atob(base64));
    } catch (e) {
        return null;
    }
}

/**
 * Logout user
 */
export function logout() {
    localStorage.removeItem('auth_token');
    localStorage.removeItem('api_token');
    localStorage.removeItem('user_name');
    localStorage.removeItem('user_role');
    localStorage.removeItem('theme');
    localStorage.removeItem('theme_name');
    document.cookie = 'auth_token=; path=/; max-age=0; SameSite=Lax';
    document.cookie = 'api_token=; path=/; max-age=0; SameSite=Lax';
    window.location.href = '/ui/login';
}

/**
 * Generic API GET request with auth headers
 * @param {string} url - API endpoint
 * @param {Object} options - Additional fetch options
 * @returns {Promise<Response>} Fetch response
 */
export async function authGet(url, options = {}) {
    return fetch(url, {
        method: 'GET',
        headers: authHeader(),
        ...options
    });
}

/**
 * Generic API POST request with auth headers
 * @param {string} url - API endpoint
 * @param {Object} data - Request body data
 * @param {Object} options - Additional fetch options
 * @returns {Promise<Response>} Fetch response
 */
export async function authPost(url, data, options = {}) {
    return fetch(url, {
        method: 'POST',
        headers: authHeaderJson(),
        body: JSON.stringify(data),
        ...options
    });
}

/**
 * Generic API PATCH request with auth headers
 * @param {string} url - API endpoint
 * @param {Object} data - Request body data
 * @param {Object} options - Additional fetch options
 * @returns {Promise<Response>} Fetch response
 */
export async function authPatch(url, data, options = {}) {
    return fetch(url, {
        method: 'PATCH',
        headers: authHeaderJson(),
        body: JSON.stringify(data),
        ...options
    });
}

/**
 * Generic API DELETE request with auth headers
 * @param {string} url - API endpoint
 * @param {Object} options - Additional fetch options
 * @returns {Promise<Response>} Fetch response
 */
export async function authDelete(url, options = {}) {
    return fetch(url, {
        method: 'DELETE',
        headers: authHeader(),
        ...options
    });
}

/**
 * Generic API PUT request with auth headers
 * @param {string} url - API endpoint
 * @param {Object} data - Request body data
 * @param {Object} options - Additional fetch options
 * @returns {Promise<Response>} Fetch response
 */
export async function authPut(url, data, options = {}) {
    return fetch(url, {
        method: 'PUT',
        headers: authHeaderJson(),
        body: JSON.stringify(data),
        ...options
    });
}
