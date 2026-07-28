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

    if (token) {
        if (box) {
            box.innerHTML = `
                <div class="space-y-2">
                    <a href="${profileUrl}" class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-[var(--on-primary)] shadow-sm shadow-primary/20 hover:bg-[var(--primary-hover)] transition-all duration-200 text-center">
                        Ver Perfil
                    </a>
                    <button
                        data-action="logout"
                        class="w-full inline-flex items-center justify-center rounded-xl bg-[var(--border)] hover:bg-red-500/10 hover:text-red-600 dark:hover:text-red-400 px-4 py-2.5 text-xs font-semibold text-[var(--text)] border border-transparent hover:border-red-500/20 transition-all duration-200 cursor-pointer"
                    >
                        Terminar Sessão
                    </button>
                </div>
            `;
        }

        if (boxMobile) {
            boxMobile.innerHTML = `
                <div class="space-y-2">
                    <a href="${profileUrl}" class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-[var(--on-primary)] shadow-sm shadow-primary/20 hover:bg-[var(--primary-hover)] transition-all duration-200 text-center">
                        Ver Perfil
                    </a>
                    <button
                        data-action="logout"
                        class="w-full inline-flex items-center justify-center rounded-xl bg-[var(--border)] hover:bg-red-500/10 hover:text-red-600 dark:hover:text-red-400 px-4 py-2.5 text-xs font-semibold text-[var(--text)] border border-transparent hover:border-red-500/20 transition-all duration-200 cursor-pointer"
                    >
                        Terminar Sessão
                    </button>
                </div>
            `;
        }

        if (topbarUser) {
            topbarUser.innerHTML = `
                <a href="${profileUrl}" class="flex items-center gap-3 rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 transition hover:bg-[var(--surface-2)]">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary font-bold text-xs text-[var(--on-primary)] shadow-sm">
                        ${name.charAt(0).toUpperCase()}
                    </div>
                    <div class="hidden md:block">
                        <div class="text-sm font-semibold text-[var(--text)] leading-none">${name}</div>
                        <div class="mt-1.5 text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)]">${role}</div>
                    </div>
                </a>
            `;
        }
    } else {
        if (box) {
            box.innerHTML = `
                <a
                    href="${loginUrl}"
                    class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-[var(--on-primary)] shadow-sm shadow-primary/10 transition-all duration-200 hover:opacity-90 text-center"
                >
                    Iniciar Sessão
                </a>
            `;
        }

        if (boxMobile) {
            boxMobile.innerHTML = `
                <a
                    href="${loginUrl}"
                    class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-[var(--on-primary)] shadow-sm shadow-primary/10 transition-all duration-200 hover:opacity-90 text-center"
                >
                    Iniciar Sessão
                </a>
            `;
        }

        if (topbarUser) {
            topbarUser.innerHTML = `
                <a href="${loginUrl}" class="inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-[var(--on-primary)] shadow-sm shadow-primary/10 transition-all duration-200 hover:opacity-90">
                    Login / Registo
                </a>
            `;
        }
    }
}
