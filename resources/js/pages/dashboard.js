import { authHeader } from '../utils/api.js';

const i18n = () => window.SGM_DASHBOARD_I18N || {};

async function fetchAnalyticsStats() {
    const endpoints = ['/api/analytics/stats', '/analytics', '/analytics/stats'];
    for (const ep of endpoints) {
        try {
            const res = await fetch(ep, { headers: authHeader() });
            if (res.ok) {
                return await res.json();
            }
        } catch (e) {}
    }
    throw new Error('Falha na comunicação de dados analíticos');
}

async function loadMetrics() {
    const userRole = document.querySelector('meta[name="user-role"]')?.content || '';
    const panel = document.getElementById('metricsPanel');

    if (!panel) {
        loadRecentTickets();
        return;
    }

    if (userRole !== 'admin') {
        panel.innerHTML = `
            <div class="rounded-xl border border-dashed border-(--border) bg-(--surface-2) p-5 col-span-full text-center">
                <p class="text-xs text-(--text-soft)">${i18n().metricsAdminOnly || 'Métricas disponíveis apenas para Administrador.'}</p>
            </div>
        `;
        loadRecentTickets();
        return;
    }

    panel.innerHTML = `
        <div class="col-span-full text-xs text-(--text-soft) animate-pulse" aria-live="polite">
            ${i18n().loadingMetrics || 'A ler indicadores analíticos em tempo real...'}
        </div>
    `;

    try {
        const data = await fetchAnalyticsStats();

        panel.innerHTML = `
            <div class="rounded-2xl border border-(--border) bg-(--surface) p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] animate-[fadeIn_0.3s_ease-out] flex flex-col justify-between">
                <p class="text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">${i18n().resolution || 'Tempo Médio de Resolução'}</p>
                <p class="mt-2 text-2xl font-black text-(--text)">${data.average_resolution_human ?? '0h 0m'}</p>
                <p class="mt-0.5 text-xs font-semibold text-(--text-soft)">${data.average_resolution_minutes ?? 0} ${i18n().minutes || 'min'}</p>
            </div>
            <div class="rounded-2xl border border-(--border) bg-(--surface) p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] animate-[fadeIn_0.3s_ease-out] flex flex-col justify-between">
                <p class="text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">${i18n().waiting || 'Tempo Médio de Espera'}</p>
                <p class="mt-2 text-2xl font-black text-(--text)">${data.average_waiting_human ?? '0h 0m'}</p>
                <p class="mt-0.5 text-xs font-semibold text-(--text-soft)">${data.average_waiting_minutes ?? 0} ${i18n().minutes || 'min'}</p>
            </div>
            <div class="rounded-2xl border border-(--border) bg-(--surface) p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] animate-[fadeIn_0.3s_ease-out] flex flex-col justify-between">
                <p class="text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">${i18n().open || 'Tickets Abertos'}</p>
                <p class="mt-2 text-3xl font-black text-amber-500">${data.open_tickets ?? 0}</p>
            </div>
            <div class="rounded-2xl border border-(--border) bg-(--surface) p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] animate-[fadeIn_0.3s_ease-out] flex flex-col justify-between">
                <p class="text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">${i18n().closed || 'Tickets Fechados'}</p>
                <p class="mt-2 text-3xl font-black text-emerald-500">${data.closed_tickets ?? 0}</p>
            </div>
        `;
    } catch (err) {
        panel.innerHTML = `
            <div class="rounded-xl border border-red-500/20 bg-red-500/5 p-4 col-span-full text-xs text-red-600 dark:text-red-400">
                ${i18n().loadError || 'Não foi possível carregar os indicadores analíticos do servidor.'}
            </div>
        `;
    }

    loadRecentTickets();
}

async function loadRecentTickets() {
    const tableContainer = document.getElementById('recentTicketsTable');
    if (!tableContainer) return;

    const endpoints = ['/tickets?page=1&per_page=5', '/admin/tickets?page=1&per_page=5', '/api/tickets?page=1&per_page=5'];
    let tickets = [];

    for (const ep of endpoints) {
        try {
            const res = await fetch(ep, { headers: authHeader() });
            if (res.ok) {
                const data = await res.json();
                tickets = data.tickets?.data || data.tickets || data || [];
                if (tickets.length > 0) break;
            }
        } catch (e) {}
    }

    if (tickets.length === 0) {
        tableContainer.innerHTML = `<p class="text-xs text-(--text-soft) py-2">${i18n().noRecent || 'Nenhuma ocorrência recente registada.'}</p>`;
        return;
    }

    tableContainer.innerHTML = `
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="text-(--text-soft) border-b border-(--border) text-[10px] uppercase tracking-wider">
                    <th class="pb-2">ID</th>
                    <th class="pb-2">${i18n().title || 'Título'}</th>
                    <th class="pb-2">${i18n().priority || 'Prioridade'}</th>
                    <th class="pb-2 text-right">${i18n().action || 'Ação'}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-(--border)/50 text-(--text)">
                ${tickets.slice(0, 4).map(t => `
                    <tr>
                        <td class="py-2.5 font-mono text-(--text-soft)">#${t.id}</td>
                        <td class="py-2.5 font-semibold truncate max-w-[180px]">${t.title}</td>
                        <td class="py-2.5">
                            <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase ${
                                t.priority === 'alta' ? 'bg-red-500/10 text-red-500' :
                                t.priority === 'média' ? 'bg-amber-500/10 text-amber-500' : 'bg-emerald-500/10 text-emerald-500'
                            }">${t.priority_label || t.priority || 'média'}</span>
                        </td>
                        <td class="py-2.5 text-right">
                            <a href="/ui/tickets/${t.id}" class="text-primary hover:underline font-bold">${i18n().view || 'Ver'}</a>
                        </td>
                    </tr>
                `).join('')}
            </tbody>
        </table>
    `;
}

function init() {
    window.addEventListener('DOMContentLoaded', loadMetrics);
}

export { init };
