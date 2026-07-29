/**
 * DOM Elements Manipulation Module
 */

export function getElement(id) {
    return document.getElementById(id);
}

export function getElementOrThrow(id) {
    const el = document.getElementById(id);
    if (!el) throw new Error(`Element with id "${id}" not found`);
    return el;
}

export function getValue(id) {
    const el = document.getElementById(id);
    return el ? el.value : '';
}

export function setValue(id, value) {
    const el = document.getElementById(id);
    if (el) el.value = value;
}

export function getText(id) {
    const el = document.getElementById(id);
    return el ? el.textContent : '';
}

export function setText(id, text) {
    const el = document.getElementById(id);
    if (el) el.textContent = text;
}

export function setHTML(id, html) {
    const el = document.getElementById(id);
    if (el) el.innerHTML = html;
}

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

export function append(parentId, child) {
    const parent = document.getElementById(parentId);
    if (parent) parent.appendChild(child);
}

export function remove(id) {
    const el = document.getElementById(id);
    if (el) el.remove();
}

export function clear(id) {
    const el = document.getElementById(id);
    if (el) el.innerHTML = '';
}
