import './api-client';
import './alpine';
import { initLocalizationModal } from './components/localization-modal';
import { initLayout } from './core/layout';
import { initLogin as initAuthLogin } from './auth/login';
import { bootPageModules } from './bootstrap/page-registry';

function initDropdowns() {
    document.addEventListener('click', (event) => {
        const trigger = event.target.closest('[data-dropdown-button]');
        const menus = document.querySelectorAll('[data-dropdown-menu]');

        if (trigger) {
            const menu = trigger.closest('[data-dropdown]')?.querySelector('[data-dropdown-menu]');
            menu?.classList.toggle('hidden');
            return;
        }

        menus.forEach((menu) => menu.classList.add('hidden'));
    });
}

function initTooltips(root = document) {
    root.querySelectorAll('[data-tooltip]').forEach((element) => {
        element.setAttribute('title', element.dataset.tooltip);
    });
}

function initAnimations(root = document) {
    const elements = root.querySelectorAll('[data-animate]');

    if (!elements.length) {
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            entry.target.classList.replace('opacity-0', 'opacity-100');
            entry.target.classList.replace('translate-y-3', 'translate-y-0');
            observer.unobserve(entry.target);
        });
    }, { threshold: 0.1 });

    elements.forEach((element) => {
        element.classList.add('opacity-0', 'translate-y-3', 'transition-all', 'duration-500');
        observer.observe(element);
    });
}

function initApp() {
    initLayout({
        loginUrl: '/ui/login',
        logoutUrl: '/logout',
        profileUrl: '/ui/profile',
        requireAuthOnLoad: false,
    });
    initAuthLogin();
    initDropdowns();
    initTooltips(document);
    initAnimations(document);
    initLocalizationModal();
    bootPageModules(document);
}

document.addEventListener('DOMContentLoaded', initApp);
