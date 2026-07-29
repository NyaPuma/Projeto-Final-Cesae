/**
 * Analytics KPI Renderer
 * Renders KPI cards for the analytics dashboard
 */

export function renderKPIs(element, data) {
    if (!element) return;
    
    const cards = [
        { title: "Tempo Médio de Resolução", value: `${Math.round(data.average_resolution_minutes || 0)} min`, icon: "🛠️", color: "indigo", subtitle: "MTTR" },
        { title: "Tempo Médio de Espera", value: `${Math.round(data.average_waiting_minutes || 0)} min`, icon: "⏱️", color: "blue", subtitle: "Tempo até atribuição" },
        { title: "Tickets Abertos", value: data.open_tickets || 0, icon: "📂", color: "amber", subtitle: "Ocorrências ativas" },
        { title: "Tickets Resolvidos", value: data.closed_tickets || 0, icon: "✅", color: "emerald", subtitle: "Intervenções concluídas" }
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
        elements.metricMttr.textContent = `${Math.round(data.average_resolution_minutes || 0)} min`;
    }
    if (elements.metricWaiting) {
        elements.metricWaiting.textContent = `${Math.round(data.average_waiting_minutes || 0)} min`;
    }
    if (elements.metricSla) {
        elements.metricSla.textContent = `${data.sla_success}%`;
    }
    if (elements.metricAvailability) {
        elements.metricAvailability.textContent = `${data.system_availability}%`;
    }
}
