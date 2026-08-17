/**
 * Analytics KPI Renderer
 * Renders KPI cards for the analytics dashboard
 */

import { formatNumber, formatPercent } from '../../utils/locale.js';

function getTranslations() {
    const configured = window.SGM_ANALYTICS_I18N || {};
    const body = document.body?.dataset || {};
    const value = (key, fallback) => configured[key] || body[`analytics${key.charAt(0).toUpperCase()}${key.slice(1)}`] || fallback;

    return {
        resolution: value('resolution', 'Average Resolution Time'),
        waiting: value('waiting', 'Average Waiting Time'),
        open: value('open', 'Open Tickets'),
        resolved: value('resolved', 'Resolved Tickets'),
        mttr: value('mttr', 'MTTR'),
        assignment: value('assignment', 'Time to assignment'),
        active: value('active', 'Active incidents'),
        completed: value('completed', 'Completed interventions'),
        minutes: value('minutes', 'min'),
        hours: value('hours', 'h'),
        days: value('days', 'd'),
    };
}

function formatMinutes(minutes) {
    const translations = getTranslations();
    const rounded = Math.round(minutes || 0);
    if (rounded < 60) return `${rounded} ${translations.minutes || 'min'}`;
    const hours = rounded / 60;
    if (hours < 48) {
        const whole = Math.floor(hours);
        const rem = Math.round((hours - whole) * 60);
        return rem
            ? `${whole}${translations.hours || 'h'} ${rem}${translations.minutes || 'min'}`
            : `${whole}${translations.hours || 'h'}`;
    }
    const days = rounded / 1440;
    const wholeDays = Math.floor(days);
    const remHours = Math.round((days - wholeDays) * 24);
    return remHours
        ? `${wholeDays}${translations.days || 'd'} ${remHours}${translations.hours || 'h'}`
        : `${wholeDays}${translations.days || 'd'}`;
}

export function renderKPIs(element, data) {
    if (!element) return;

    const translations = getTranslations();
    const cards = [
        { title: translations.resolution || 'Average Resolution Time', value: formatMinutes(data.average_resolution_minutes), icon: "🛠️", color: "indigo", subtitle: translations.mttr || "MTTR" },
        { title: translations.waiting || 'Average Waiting Time', value: formatMinutes(data.average_waiting_minutes), icon: "⏱️", color: "blue", subtitle: translations.assignment || "Time to assignment" },
        { title: translations.open || 'Open Tickets', value: formatNumber(data.open_tickets || 0), icon: "📂", color: "amber", subtitle: translations.active || "Active incidents" },
        { title: translations.resolved || 'Resolved Tickets', value: formatNumber(data.closed_tickets || 0), icon: "✅", color: "emerald", subtitle: translations.completed || "Completed interventions" }
    ];

    element.innerHTML = cards.map(card => {
        let colorClasses = '';
        if (card.color === 'indigo') {
            colorClasses = 'bg-primary/10 text-primary border-primary/20';
        } else if (card.color === 'blue') {
            colorClasses = 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/20';
        } else if (card.color === 'amber') {
            colorClasses = 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-500/20';
        } else {
            colorClasses = 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/20';
        }

        return `
            <article class="group overflow-hidden rounded-3xl border border-(--border) bg-(--surface) transition-all duration-350 hover:-translate-y-1 hover:shadow-xl p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-(--text-soft)">${card.title}</p>
                        <h3 class="mt-5 text-4xl font-black tracking-tight text-(--text)">${card.value}</h3>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl ${colorClasses.split(' ').slice(0,2).join(' ')}">
                        <span class="text-2xl">${card.icon}</span>
                    </div>
                </div>
                <div class="mt-8">
                    <span class="rounded-full px-3 py-1.5 text-xs font-bold ${colorClasses}">
                        ${card.subtitle}
                    </span>
                </div>
            </article>
        `;
    }).join("");
}

export function renderOperationalMetrics(elements, data) {
    if (elements.metricMttr) {
        elements.metricMttr.textContent = formatMinutes(data.average_resolution_minutes);
    }
    if (elements.metricWaiting) {
        elements.metricWaiting.textContent = formatMinutes(data.average_waiting_minutes);
    }
    if (elements.metricSla) {
        elements.metricSla.textContent = formatPercent(data.sla_success);
    }
    if (elements.metricAvailability) {
        elements.metricAvailability.textContent = formatPercent(data.system_availability);
    }
}
