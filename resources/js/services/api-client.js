/**
 * API Client Service
 * Serviço centralizado para comunicação com a API
 */

/**
 * Base URL da API
 */
const API_BASE_URL = '/api';

/**
 * Get authentication headers
 * @returns {Object} Headers object
 */
function getAuthHeaders() {
    const token = localStorage.getItem('api_token') || getCookie('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
    
    return {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': csrfToken
    };
}

/**
 * Get cookie value by name
 * @param {string} name - Cookie name
 * @returns {string|null} Cookie value or null
 */
function getCookie(name) {
    return document.cookie.split('; ').reduce((acc, cookie) => {
        const [key, value] = cookie.split('=');
        return key === name ? value : acc;
    }, null);
}

/**
 * Generic GET request
 * @param {string} endpoint - API endpoint
 * @param {Object} params - Query parameters
 * @returns {Promise} Fetch response
 */
export async function get(endpoint, params = {}) {
    const url = new URL(`${API_BASE_URL}${endpoint}`);
    Object.entries(params).forEach(([key, value]) => {
        if (value !== undefined && value !== null) {
            url.searchParams.append(key, value);
        }
    });

    try {
        const response = await fetch(url.toString(), {
            method: 'GET',
            headers: {
                ...getAuthHeaders(),
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        console.error('[API GET Error]:', error);
        throw error;
    }
}

/**
 * Generic POST request
 * @param {string} endpoint - API endpoint
 * @param {Object} data - Request body
 * @returns {Promise} Fetch response
 */
export async function post(endpoint, data = {}) {
    const url = `${API_BASE_URL}${endpoint}`;

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                ...getAuthHeaders(),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json().catch(() => ({}));

        if (!response.ok) {
            throw new Error(result.message || `HTTP error! status: ${response.status}`);
        }

        return result;
    } catch (error) {
        console.error('[API POST Error]:', error);
        throw error;
    }
}

/**
 * Generic PUT request
 * @param {string} endpoint - API endpoint
 * @param {Object} data - Request body
 * @returns {Promise} Fetch response
 */
export async function put(endpoint, data = {}) {
    const url = `${API_BASE_URL}${endpoint}`;

    try {
        const response = await fetch(url, {
            method: 'PUT',
            headers: {
                ...getAuthHeaders(),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json().catch(() => ({}));

        if (!response.ok) {
            throw new Error(result.message || `HTTP error! status: ${response.status}`);
        }

        return result;
    } catch (error) {
        console.error('[API PUT Error]:', error);
        throw error;
    }
}

/**
 * Generic DELETE request
 * @param {string} endpoint - API endpoint
 * @returns {Promise} Fetch response
 */
export async function del(endpoint) {
    const url = `${API_BASE_URL}${endpoint}`;

    try {
        const response = await fetch(url, {
            method: 'DELETE',
            headers: getAuthHeaders()
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        console.error('[API DELETE Error]:', error);
        throw error;
    }
}

/**
 * Form data to object converter
 * @param {HTMLFormElement} form - Form element
 * @returns {Object} Form data as object
 */
export function formToObject(form) {
    const formData = new FormData(form);
    const object = {};
    
    formData.forEach((value, key) => {
        object[key] = value;
    });
    
    return object;
}
