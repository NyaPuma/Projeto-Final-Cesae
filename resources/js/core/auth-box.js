/**
 * Auth Box Rendering Module
 * Handles rendering of authentication boxes in sidebar, mobile nav, and topbar
 */

import { getUserData } from './auth.js';

export function renderAuthBox(profileUrl, loginUrl) {
    const box = document.getElementById('authBox');
    const boxMobile = document.getElementById('authBoxMobile');
    const topbarUser = document.getElementById('topbarUser');

    if (!box && !boxMobile && !topbarUser) return;

    const userData = getUserData();
    const { name, role, token } = userData;
    const body = document.body;
    const translations = window.SGM_AUTH_I18N || {
        profile: body?.dataset.authProfile,
        logout: body?.dataset.authLogout,
        signin: body?.dataset.authSignin,
        loginRegister: body?.dataset.authLoginRegister,
    };

    if (token) {
        if (box) {
            box.innerHTML = `
                <div class="space-y-2">
                    <a href="${profileUrl}" class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-(--on-primary) shadow-sm shadow-primary/20 hover:bg-(--primary-hover) transition-all duration-200 text-center">
                        ${translations.profile || ''}
                    </a>
                    <button
                        data-action="logout"
                        class="w-full inline-flex items-center justify-center rounded-xl bg-(--border) hover:bg-danger/10 hover:text-danger px-4 py-2.5 text-xs font-semibold text-(--text) border border-transparent hover:border-danger/20 transition-all duration-200 cursor-pointer"
                    >
                        ${translations.logout || ''}
                    </button>
                </div>
            `;
        }

        if (boxMobile) {
            boxMobile.innerHTML = `
                <div class="space-y-2">
                    <a href="${profileUrl}" class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-(--on-primary) shadow-sm shadow-primary/20 hover:bg-(--primary-hover) transition-all duration-200 text-center">
                        ${translations.profile || ''}
                    </a>
                    <button
                        data-action="logout"
                        class="w-full inline-flex items-center justify-center rounded-xl bg-(--border) hover:bg-danger/10 hover:text-danger px-4 py-2.5 text-xs font-semibold text-(--text) border border-transparent hover:border-danger/20 transition-all duration-200 cursor-pointer"
                    >
                        ${translations.logout || ''}
                    </button>
                </div>
            `;
        }

        if (topbarUser) {
            topbarUser.innerHTML = `
                <a href="${profileUrl}" class="flex items-center gap-3 rounded-xl border border-solid border-[var(--border)] bg-(--surface) px-3 py-2 transition shadow-xs hover:border-[var(--border-hover)] hover:bg-(--surface-hover)">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary font-bold text-xs text-(--on-primary) shadow-sm">
                        ${name.charAt(0).toUpperCase()}
                    </div>
                    <div class="hidden md:block">
                        <div class="text-sm font-semibold text-(--text) leading-none">${name}</div>
                        <div class="mt-1.5 text-xs font-bold uppercase tracking-wider text-(--text-soft)">${role}</div>
                    </div>
                </a>
            `;
        }
    } else {
        if (box) {
            box.innerHTML = `
                <a
                    href="${loginUrl}"
                    class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-(--on-primary) shadow-sm shadow-primary/10 transition-all duration-200 hover:opacity-90 text-center"
                >
                    ${translations.signin || ''}
                </a>
            `;
        }

        if (boxMobile) {
            boxMobile.innerHTML = `
                <a
                    href="${loginUrl}"
                    class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-(--on-primary) shadow-sm shadow-primary/10 transition-all duration-200 hover:opacity-90 text-center"
                >
                    ${translations.signin || ''}
                </a>
            `;
        }

        if (topbarUser) {
            topbarUser.innerHTML = `
                <a href="${loginUrl}" class="inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-(--on-primary) shadow-sm shadow-primary/10 transition-all duration-200 hover:opacity-90">
                    ${translations.loginRegister || ''}
                </a>
            `;
        }
    }
}
