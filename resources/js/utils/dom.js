/**
 * DOM Utilities Module
 * Shared utility functions for DOM manipulation and common UI operations
 */

/**
 * Get element by ID with null check
 * @param {string} id - Element ID
 * @returns {HTMLElement|null} Element or null
 */
export function getElement(id) {
    return document.getElementById(id);
}

/**
 * Get element by ID, throw error if not found
 * @param {string} id - Element ID
 * @returns {HTMLElement} Element
 * @throws {Error} If element not found
 */
export function getElementOrThrow(id) {
    const el = document.getElementById(id);
    if (!el) throw new Error(`Element with id "${id}" not found`);
    return el;
}

/**
 * Get element value by ID
 * @param {string} id - Element ID
 * @returns {string} Element value or empty string
 */
export function getValue(id) {
    const el = document.getElementById(id);
    return el ? el.value : '';
}

/**
 * Set element value by ID
 * @param {string} id - Element ID
 * @param {string} value - Value to set
 */
export function setValue(id, value) {
    const el = document.getElementById(id);
    if (el) el.value = value;
}

/**
 * Get element text content by ID
 * @param {string} id - Element ID
 * @returns {string} Element text content or empty string
 */
export function getText(id) {
    const el = document.getElementById(id);
    return el ? el.textContent : '';
}

/**
 * Set element text content by ID
 * @param {string} id - Element ID
 * @param {string} text - Text to set
 */
export function setText(id, text) {
    const el = document.getElementById(id);
    if (el) el.textContent = text;
}

/**
 * Set element HTML content by ID
 * @param {string} id - Element ID
 * @param {string} html - HTML to set
 */
export function setHTML(id, html) {
    const el = document.getElementById(id);
    if (el) el.innerHTML = html;
}

/**
 * Add CSS class to element by ID
 * @param {string} id - Element ID
 * @param {...string} classes - Classes to add
 */
export function addClass(id, ...classes) {
    const el = document.getElementById(id);
    if (el) el.classList.add(...classes);
}

/**
 * Remove CSS class from element by ID
 * @param {string} id - Element ID
 * @param {...string} classes - Classes to remove
 */
export function removeClass(id, ...classes) {
    const el = document.getElementById(id);
    if (el) el.classList.remove(...classes);
}

/**
 * Toggle CSS class on element by ID
 * @param {string} id - Element ID
 * @param {string} className - Class to toggle
 * @param {boolean} force - Force add/remove
 */
export function toggleClass(id, className, force) {
    const el = document.getElementById(id);
    if (el) el.classList.toggle(className, force);
}

/**
 * Check if element has class by ID
 * @param {string} id - Element ID
 * @param {string} className - Class to check
 * @returns {boolean} True if element has class
 */
export function hasClass(id, className) {
    const el = document.getElementById(id);
    return el ? el.classList.contains(className) : false;
}

/**
 * Show element by ID (remove hidden class)
 * @param {string} id - Element ID
 */
export function show(id) {
    const el = document.getElementById(id);
    if (el) {
        el.classList.remove('hidden');
        el.style.display = '';
    }
}

/**
 * Hide element by ID (add hidden class)
 * @param {string} id - Element ID
 */
export function hide(id) {
    const el = document.getElementById(id);
    if (el) {
        el.classList.add('hidden');
        el.style.display = 'none';
    }
}

/**
 * Disable element by ID
 * @param {string} id - Element ID
 */
export function disable(id) {
    const el = document.getElementById(id);
    if (el) el.disabled = true;
}

/**
 * Enable element by ID
 * @param {string} id - Element ID
 */
export function enable(id) {
    const el = document.getElementById(id);
    if (el) el.disabled = false;
}

/**
 * Set button loading state
 * @param {string} id - Button ID
 * @param {boolean} loading - Loading state
 * @param {string} loadingText - Text to show when loading
 * @param {string} normalText - Text to show when not loading
 */
export function setButtonLoading(id, loading, loadingText = 'A processar...', normalText = null) {
    const btn = document.getElementById(id);
    if (!btn) return;
    
    btn.disabled = loading;
    btn.classList.toggle('opacity-80', loading);
    btn.classList.toggle('cursor-not-allowed', loading);
    
    if (loading) {
        btn.dataset.originalText = btn.textContent;
        btn.innerHTML = `<span class="inline-flex items-center gap-2"><svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" class="opacity-20"></circle><path fill="currentColor" class="opacity-90" d="M4 12a8 8 0 018-8V0A12 12 0 000 12h4z"></path></svg>${loadingText}</span>`;
    } else {
        btn.textContent = normalText || btn.dataset.originalText || btn.textContent;
    }
}

/**
 * Show message in element
 * @param {string} id - Message element ID
 * @param {string} message - Message text
 * @param {boolean} isError - Whether message is an error
 */
export function showMessage(id, message, isError = false) {
    const el = document.getElementById(id);
    if (!el) return;
    
    el.textContent = message;
    el.className = el.className.replace(/text-(emerald|rose)-\d+/g, '');
    el.classList.add(isError ? 'text-rose-500' : 'text-emerald-500');
    el.classList.remove('hidden');
}

/**
 * Clear message in element
 * @param {string} id - Message element ID
 */
export function clearMessage(id) {
    const el = document.getElementById(id);
    if (!el) return;
    
    el.textContent = '';
    el.classList.add('hidden');
}

/**
 * Get data attribute from element
 * @param {string} id - Element ID
 * @param {string} attribute - Data attribute name (without 'data-')
 * @returns {string|null} Data attribute value
 */
export function getData(id, attribute) {
    const el = document.getElementById(id);
    return el ? el.dataset[attribute] : null;
}

/**
 * Set data attribute on element
 * @param {string} id - Element ID
 * @param {string} attribute - Data attribute name (without 'data-')
 * @param {string} value - Value to set
 */
export function setData(id, attribute, value) {
    const el = document.getElementById(id);
    if (el) el.dataset[attribute] = value;
}

/**
 * Find closest element by selector
 * @param {HTMLElement} element - Starting element
 * @param {string} selector - CSS selector
 * @returns {HTMLElement|null} Closest matching element
 */
export function closest(element, selector) {
    return element ? element.closest(selector) : null;
}

/**
 * Query selector within element
 * @param {string} parentId - Parent element ID
 * @param {string} selector - CSS selector
 * @returns {HTMLElement|null} Matching element
 */
export function query(parentId, selector) {
    const parent = document.getElementById(parentId);
    return parent ? parent.querySelector(selector) : null;
}

/**
 * Query all elements within parent
 * @param {string} parentId - Parent element ID
 * @param {string} selector - CSS selector
 * @returns {NodeList} Matching elements
 */
export function queryAll(parentId, selector) {
    const parent = document.getElementById(parentId);
    return parent ? parent.querySelectorAll(selector) : [];
}

/**
 * Create element with attributes
 * @param {string} tag - HTML tag name
 * @param {Object} attributes - Element attributes
 * @param {string} content - Inner HTML content
 * @returns {HTMLElement} Created element
 */
export function createElement(tag, attributes = {}, content = '') {
    const el = document.createElement(tag);
    
    Object.entries(attributes).forEach(([key, value]) => {
        if (key === 'className') {
            el.className = value;
        } else if (key.startsWith('data-')) {
            el.dataset[key.replace('data-', '')] = value;
        } else {
            el.setAttribute(key, value);
        }
    });
    
    if (content) el.innerHTML = content;
    return el;
}

/**
 * Append element to parent
 * @param {string} parentId - Parent element ID
 * @param {HTMLElement} child - Child element to append
 */
export function append(parentId, child) {
    const parent = document.getElementById(parentId);
    if (parent) parent.appendChild(child);
}

/**
 * Remove element by ID
 * @param {string} id - Element ID
 */
export function remove(id) {
    const el = document.getElementById(id);
    if (el) el.remove();
}

/**
 * Clear element content by ID
 * @param {string} id - Element ID
 */
export function clear(id) {
    const el = document.getElementById(id);
    if (el) el.innerHTML = '';
}

/**
 * Focus element by ID
 * @param {string} id - Element ID
 */
export function focus(id) {
    const el = document.getElementById(id);
    if (el) el.focus();
}

/**
 * Blur element by ID
 * @param {string} id - Element ID
 */
export function blur(id) {
    const el = document.getElementById(id);
    if (el) el.blur();
}

/**
 * Scroll element into view
 * @param {string} id - Element ID
 * @param {Object} options - ScrollIntoViewOptions
 */
export function scrollIntoView(id, options = { behavior: 'smooth', block: 'nearest' }) {
    const el = document.getElementById(id);
    if (el) el.scrollIntoView(options);
}

/**
 * Check if element is visible
 * @param {string} id - Element ID
 * @returns {boolean} True if element is visible
 */
export function isVisible(id) {
    const el = document.getElementById(id);
    if (!el) return false;
    return el.offsetParent !== null && !el.classList.contains('hidden');
}

/**
 * Wait for element to appear in DOM
 * @param {string} id - Element ID
 * @param {number} timeout - Timeout in milliseconds
 * @returns {Promise<HTMLElement>} Promise resolving to element
 */
export function waitForElement(id, timeout = 5000) {
    return new Promise((resolve, reject) => {
        const el = document.getElementById(id);
        if (el) return resolve(el);
        
        const observer = new MutationObserver(() => {
            const el = document.getElementById(id);
            if (el) {
                observer.disconnect();
                resolve(el);
            }
        });
        
        observer.observe(document.body, { childList: true, subtree: true });
        
        setTimeout(() => {
            observer.disconnect();
            reject(new Error(`Element "${id}" not found within ${timeout}ms`));
        }, timeout);
    });
}
