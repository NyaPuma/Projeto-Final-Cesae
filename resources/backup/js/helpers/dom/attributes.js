/**
 * DOM Attributes, Classes and Visibility Module
 */

export function addClass(id, ...classes) {
    const el = document.getElementById(id);
    if (el) el.classList.add(...classes);
}

export function removeClass(id, ...classes) {
    const el = document.getElementById(id);
    if (el) el.classList.remove(...classes);
}

export function toggleClass(id, className, force) {
    const el = document.getElementById(id);
    if (el) el.classList.toggle(className, force);
}

export function hasClass(id, className) {
    const el = document.getElementById(id);
    return el ? el.classList.contains(className) : false;
}

export function show(id) {
    const el = document.getElementById(id);
    if (el) {
        el.classList.remove('hidden');
        el.style.display = '';
    }
}

export function hide(id) {
    const el = document.getElementById(id);
    if (el) {
        el.classList.add('hidden');
        el.style.display = 'none';
    }
}

export function disable(id) {
    const el = document.getElementById(id);
    if (el) el.disabled = true;
}

export function enable(id) {
    const el = document.getElementById(id);
    if (el) el.disabled = false;
}

export function getData(id, attribute) {
    const el = document.getElementById(id);
    return el ? el.dataset[attribute] : null;
}

export function setData(id, attribute, value) {
    const el = document.getElementById(id);
    if (el) el.dataset[attribute] = value;
}
