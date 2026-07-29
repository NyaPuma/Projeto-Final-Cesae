/**
 * DOM Traversal, Query and Interaction Module
 */

export function closest(element, selector) {
    return element ? element.closest(selector) : null;
}

export function query(parentId, selector) {
    const parent = document.getElementById(parentId);
    return parent ? parent.querySelector(selector) : null;
}

export function queryAll(parentId, selector) {
    const parent = document.getElementById(parentId);
    return parent ? parent.querySelectorAll(selector) : [];
}

export function focus(id) {
    const el = document.getElementById(id);
    if (el) el.focus();
}

export function blur(id) {
    const el = document.getElementById(id);
    if (el) el.blur();
}

export function scrollIntoView(id, options = { behavior: 'smooth', block: 'nearest' }) {
    const el = document.getElementById(id);
    if (el) el.scrollIntoView(options);
}

export function isVisible(id) {
    const el = document.getElementById(id);
    if (!el) return false;
    return el.offsetParent !== null && !el.classList.contains('hidden');
}

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

export function showMessage(id, message, isError = false) {
    const el = document.getElementById(id);
    if (!el) return;
    el.textContent = message;
    el.className = el.className.replace(/text-(emerald|rose)-\d+/g, '');
    el.classList.add(isError ? 'text-rose-500' : 'text-emerald-500');
    el.classList.remove('hidden');
}

export function clearMessage(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.textContent = '';
    el.classList.add('hidden');
}

export function waitForElement(id, timeout = 5000) {
    return new Promise((resolve, reject) => {
        const el = document.getElementById(id);
        if (el) return resolve(el);
        const observer = new MutationObserver(() => {
            const el = document.getElementById(id);
            if (el) { observer.disconnect(); resolve(el); }
        });
        observer.observe(document.body, { childList: true, subtree: true });
        setTimeout(() => { observer.disconnect(); reject(new Error(`Element "${id}" not found within ${timeout}ms`)); }, timeout);
    });
}
