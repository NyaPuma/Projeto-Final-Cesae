/**
 * Dashboard Module
 * Handles dashboard metrics and KPI loading
 */

import { authHeader } from '../utils/api.js';

async function loadMetrics() {
    const userRole = document.querySelector('meta[name="user-role"]')?.content || '';

    const panel = document.getElementById('metricsPanel');

    if (!panel) return;

    if (userRole !== 'admin') {
        panel.innerHTML = `
            <div class="rounded-xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5 col-span-full text-center">
                <p class="text-xs text-[var(--text-soft)]">Painel de métricas operacionais disponível apenas para perfis autorizados (Técnicos/Gestores).</p>
            </div>
        `;
        return;
    }

    panel.innerHTML = `
        <div class="col-span-full text-xs text-[var(--text-soft)] animate-pulse" aria-live="polite">
            A ler indicadores analíticos em tempo real...
        </div>
    `;

    try {
        const res = await fetch('/analytics', { headers: authHeader() });
        if (!res.ok) throw new Error('Falha na comunicação de dados');

        const data = await res.json();

        const metrics = [
            ['Tempo médio de resolução', `${data.average_resolution_minutes ?? 0} min`],
            ['Tempo médio de espera', `${data.average_waiting_minutes ?? 0} min`],
            ['Tickets em aberto', `${data.open_tickets ?? 0}`],
            ['Tickets fechados', `${data.closed_tickets ?? 0}`],
        ];

        panel.innerHTML = metrics.map(([label, value]) => `
            <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-[0_1px_2px_rgba(0,0,0,0.01)] animate-[fadeIn_0.3s_ease-out]">
                <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">${label}</p>
                <p class="mt-2 text-2xl font-semibold tracking-tight text-[var(--text)]">${value}</p>
            </div>
        `).join('');

    } catch (err) {
        panel.innerHTML = `
            <div class="rounded-xl border border-red-500/20 bg-red-500/5 p-4 col-span-full text-xs text-red-600 dark:text-red-400">
                Não foi possível carregar os indicadores analíticos do servidor.
            </div>
        `;
    }
}

function init() {
    window.addEventListener('DOMContentLoaded', loadMetrics);
}

export { init };
