import Chart from 'chart.js/auto';

/**
 * Analytics Dashboard Manager
 * Responsável por gerir a atualização e renderização do dashboard.
 */
class AnalyticsDashboard {
    constructor() {
        this.charts = { status: null, trend: null, cost: null, equipment: null };
        this.refreshTimer = null;
        this.lastData = null;
        this.elements = this.getElements();

        // Expor para a janela global apenas o necessário para triggers externos
        window.refreshAnalyticsDashboard = () => this.refresh();

        this.init();
    }

    getElements() {
        return {
            kpiPanel: document.getElementById("kpiPanel"),
            analyticsMessage: document.getElementById("analyticsMessage"),
            statusChart: document.getElementById("statusChart"),
            trendChart: document.getElementById("trendChart"),
            costChart: document.getElementById("costChart"),
            equipmentChart: document.getElementById("equipmentChart"),
            equipmentLegend: document.getElementById("equipmentLegend"),
            equipmentTotal: document.getElementById("equipmentTotal"),
            activityTimeline: document.getElementById("activityTimeline"),
            topEquipments: document.getElementById("topEquipments"),
            topRooms: document.getElementById("topRooms"),
            topTechnicians: document.getElementById("topTechnicians"),
            metricMttr: document.getElementById("metricMttr"),
            metricWaiting: document.getElementById("metricWaiting"),
            metricSla: document.getElementById("metricSla"),
            metricAvailability: document.getElementById("metricAvailability")
        };
    }

    async init() {
        if (!this.elements.kpiPanel) return;

        await this.refresh();
        this.startAutoRefresh();

        document.addEventListener("visibilitychange", () => {
            document.hidden ? this.stopAutoRefresh() : this.refresh();
        });

        window.addEventListener("beforeunload", () => this.cleanup());
        window.addEventListener("theme-changed", () => this.handleThemeChange());
    }

    async refresh() {
        this.setLoading(true);
        try {
            const data = await this.fetchAnalytics();
            if (data) {
                this.lastData = data;
                this.updateUI(data);
            }
        } finally {
            this.setLoading(false);
        }
    }

    handleThemeChange() {
        if (this.lastData) {
            this.updateUI(this.lastData);
        }
    }

    setLoading(isLoading) {
        if (isLoading) this.clearMessage();
    }

    async fetchAnalytics() {
        try {
            const response = await fetch("/analytics", {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    ...((typeof window.authHeader === "function") ? window.authHeader() : {})
                },
                credentials: "include"
            });

            if (!response.ok) throw new Error(`Status ${response.status}`);
            return await response.json();
        } catch (error) {
            console.error("Dashboard Error:", error);
            this.showMessage("Erro ao carregar dados analíticos.", "error");
            return null;
        }
    }

    updateUI(data) {
        this.renderKPIs(data);
        this.renderStatusChart(data);
        this.renderTrendChart(data);
        this.renderCostChart(data);
        this.renderEquipmentChart(data);
        this.renderOperationalMetrics(data);
        this.renderActivity(data);
        this.renderSummary(data);
    }

    // --- Helper to get colors from Tailwind/CSS variables ---
    getThemeColors() {
        const style = getComputedStyle(document.documentElement);
        const isDark = document.documentElement.classList.contains('dark');
        
        return {
            text: style.getPropertyValue('--text').trim() || (isDark ? '#f8fafc' : '#0f172a'),
            textSoft: style.getPropertyValue('--text-soft').trim() || (isDark ? '#cbd5e1' : '#475569'),
            border: style.getPropertyValue('--border').trim() || (isDark ? '#2d3748' : '#e2e8f0'),
            primary: style.getPropertyValue('--primary').trim() || '#4f46e5',
            primaryHover: style.getPropertyValue('--primary-hover').trim() || '#4338ca',
            primaryLight: style.getPropertyValue('--primary-light').trim() || 'rgba(79, 70, 229, 0.1)',
        };
    }

    // --- Renderers ---

    renderKPIs(data) {
        if (!this.elements.kpiPanel) return;
        
        const cards = [
            { title: "Tempo Médio de Resolução", value: `${Math.round(data.average_resolution_minutes || 0)} min`, icon: "🛠️", color: "indigo", subtitle: "MTTR" },
            { title: "Tempo Médio de Espera", value: `${Math.round(data.average_waiting_minutes || 0)} min`, icon: "⏱️", color: "blue", subtitle: "Tempo até atribuição" },
            { title: "Tickets Abertos", value: data.open_tickets || 0, icon: "📂", color: "amber", subtitle: "Ocorrências ativas" },
            { title: "Tickets Resolvidos", value: data.closed_tickets || 0, icon: "✅", color: "emerald", subtitle: "Intervenções concluídas" }
        ];

        this.elements.kpiPanel.innerHTML = cards.map(card => {
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
                <article class="group overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)] transition-all duration-350 hover:-translate-y-1 hover:shadow-xl p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--text-soft)]">${card.title}</p>
                            <h3 class="mt-5 text-4xl font-black tracking-tight text-[var(--text)]">${card.value}</h3>
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

    renderStatusChart(data) {
        if (!this.elements.statusChart) return;
        this.destroyChart('status');

        const colors = this.getThemeColors();
        const breakdown = data.ticket_status_breakdown || { labels: [], data: [] };

        this.charts.status = new Chart(this.elements.statusChart, {
            type: 'bar',
            data: {
                labels: breakdown.labels,
                datasets: [{
                    label: 'Tickets',
                    data: breakdown.data,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.85)',  // Blue
                        'rgba(245, 158, 11, 0.85)',  // Amber
                        'rgba(236, 72, 153, 0.85)',  // Pink
                        'rgba(16, 185, 129, 0.85)'   // Green
                    ],
                    borderRadius: 8,
                    borderWidth: 0,
                    barThickness: 32
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: colors.textSoft, font: { weight: '600', size: 11 } }
                    },
                    y: {
                        grid: { color: colors.border },
                        ticks: { color: colors.textSoft, font: { weight: '600', size: 11 } },
                        border: { dash: [4, 4] }
                    }
                }
            }
        });
    }

    renderTrendChart(data) {
        if (!this.elements.trendChart) return;
        this.destroyChart('trend');

        const colors = this.getThemeColors();
        const trend = data.monthly_tickets || { labels: [], open: [], in_progress: [], closed: [] };

        this.charts.trend = new Chart(this.elements.trendChart, {
            type: 'bar',
            data: {
                labels: trend.labels,
                datasets: [
                    {
                        label: 'Abertos',
                        data: trend.open,
                        backgroundColor: 'rgba(59, 130, 246, 0.85)',
                        borderRadius: 6
                    },
                    {
                        label: 'Em Curso',
                        data: trend.in_progress,
                        backgroundColor: 'rgba(245, 158, 11, 0.85)',
                        borderRadius: 6
                    },
                    {
                        label: 'Fechados',
                        data: trend.closed,
                        backgroundColor: 'rgba(16, 185, 129, 0.85)',
                        borderRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { color: colors.text, font: { weight: '600', size: 11 } }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: colors.textSoft, font: { weight: '600', size: 11 } }
                    },
                    y: {
                        grid: { color: colors.border },
                        ticks: { color: colors.textSoft, font: { weight: '600', size: 11 } },
                        border: { dash: [4, 4] }
                    }
                }
            }
        });
    }

    renderCostChart(data) {
        if (!this.elements.costChart) return;
        this.destroyChart('cost');

        const colors = this.getThemeColors();
        const cost = data.monthly_cost || { labels: [], data: [] };

        const canvas = this.elements.costChart;
        const ctx = canvas.getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, colors.primaryLight);
        gradient.addColorStop(1, 'rgba(79, 70, 229, 0)');

        this.charts.cost = new Chart(canvas, {
            type: 'line',
            data: {
                labels: cost.labels,
                datasets: [{
                    label: 'Custo (€)',
                    data: cost.data,
                    borderColor: colors.primary,
                    borderWidth: 3,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: colors.primary,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: colors.textSoft, font: { weight: '600', size: 11 } }
                    },
                    y: {
                        grid: { color: colors.border },
                        ticks: { color: colors.textSoft, font: { weight: '600', size: 11 } },
                        border: { dash: [4, 4] }
                    }
                }
            }
        });
    }

    renderEquipmentChart(data) {
        if (!this.elements.equipmentChart) return;
        this.destroyChart('equipment');

        const colors = this.getThemeColors();
        const priority = data.by_priority || { labels: [], data: [] };
        const total = priority.data.reduce((a, b) => a + b, 0);

        if (this.elements.equipmentTotal) {
            this.elements.equipmentTotal.innerHTML = `
                <span class="text-4xl font-black text-[var(--text)]">${total}</span>
                <span class="mt-1 text-[9px] font-bold uppercase tracking-widest text-[var(--text-soft)]">Tickets</span>
            `;
        }

        this.charts.equipment = new Chart(this.elements.equipmentChart, {
            type: 'doughnut',
            data: {
                labels: priority.labels,
                datasets: [{
                    data: priority.data,
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.85)', // Green/Low
                        'rgba(245, 158, 11, 0.85)',  // Amber/Medium
                        'rgba(239, 68, 68, 0.85)'    // Red/High
                    ],
                    borderWidth: 0,
                    cutout: '80%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Generate legends list
        if (this.elements.equipmentLegend) {
            this.elements.equipmentLegend.innerHTML = priority.labels.map((label, idx) => {
                const count = priority.data[idx];
                const pct = total > 0 ? Math.round((count / total) * 100) : 0;
                let colorClass = '';
                if (idx === 0) colorClass = 'bg-emerald-500';
                else if (idx === 1) colorClass = 'bg-amber-500';
                else colorClass = 'bg-red-500';

                return `
                    <div class="flex items-center justify-between text-xs font-semibold">
                        <div class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full ${colorClass}"></span>
                            <span class="text-[var(--text)]">${label}</span>
                        </div>
                        <span class="text-[var(--text-soft)]">${count} (${pct}%)</span>
                    </div>
                `;
            }).join("");
        }
    }

    renderOperationalMetrics(data) {
        if (this.elements.metricMttr) {
            this.elements.metricMttr.textContent = `${Math.round(data.average_resolution_minutes || 0)} min`;
        }
        if (this.elements.metricWaiting) {
            this.elements.metricWaiting.textContent = `${Math.round(data.average_waiting_minutes || 0)} min`;
        }
        if (this.elements.metricSla) {
            this.elements.metricSla.textContent = `${data.sla_success}%`;
        }
        if (this.elements.metricAvailability) {
            this.elements.metricAvailability.textContent = `${data.system_availability}%`;
        }
    }

    renderActivity(data) {
        if (!this.elements.activityTimeline) return;
        const activities = data.recent_activity || [];
        if (activities.length === 0) {
            this.elements.activityTimeline.innerHTML = `
                <div class="p-6 text-center text-xs text-soft">Sem atividade recente.</div>
            `;
            return;
        }
        this.elements.activityTimeline.innerHTML = activities.map(act => `
            <div class="flex items-start gap-5 p-6 hover:bg-[var(--surface-2)]/30 transition-colors duration-150">
                <div class="mt-1 flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <span class="text-sm">📝</span>
                </div>
                <div class="flex-1">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <h3 class="font-semibold text-sm text-[var(--text)]">${act.title}</h3>
                        <span class="text-xs text-[var(--text-soft)]">${act.time}</span>
                    </div>
                    <p class="mt-1 text-xs text-[var(--text-soft)]">${act.description}</p>
                </div>
            </div>
        `).join("");
    }

    renderSummary(data) {
        this.renderList(this.elements.topEquipments, data.top_equipments);
        this.renderList(this.elements.topRooms, data.top_rooms);
        this.renderList(this.elements.topTechnicians, data.top_technicians);
    }

    renderList(element, items) {
        if (!element) return;
        if (!items || items.length === 0) {
            element.innerHTML = `<div class="p-5 text-center text-xs text-[var(--text-soft)]">Sem dados disponíveis</div>`;
            return;
        }
        element.innerHTML = items.map((item, idx) => `
            <div class="flex items-center justify-between p-4 hover:bg-[var(--surface-2)]/30 transition-colors duration-150">
                <div class="flex items-center gap-3">
                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-[var(--surface-2)] text-xs font-bold text-[var(--text-soft)]">${idx + 1}</span>
                    <span class="text-xs font-semibold text-[var(--text)]">${item.name}</span>
                </div>
                <span class="text-xs font-bold text-primary">${item.total} <span class="font-medium text-[var(--text-soft)]">${item.subtitle || ''}</span></span>
            </div>
        `).join("");
    }

    destroyChart(name) {
        if (this.charts[name]) {
            this.charts[name].destroy();
            this.charts[name] = null;
        }
    }

    cleanup() {
        this.stopAutoRefresh();
        Object.keys(this.charts).forEach(key => this.destroyChart(key));
    }

    startAutoRefresh() {
        this.stopAutoRefresh();
        this.refreshTimer = setInterval(() => this.refresh(), 60000);
    }

    stopAutoRefresh() {
        if (this.refreshTimer) clearInterval(this.refreshTimer);
    }

    showMessage(message, type = "success") {
        if (!this.elements.analyticsMessage) return;
        const box = this.elements.analyticsMessage;
        box.className = `mt-6 rounded-2xl border px-5 py-4 text-sm font-medium ${type === 'error' ? 'border-red-300 bg-red-50 text-red-700' : 'border-emerald-300 bg-emerald-50 text-emerald-700'}`;
        box.textContent = message;
    }

    clearMessage() {
        if (this.elements.analyticsMessage) this.elements.analyticsMessage.className = "hidden";
    }
}

// Inicialização
document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById("kpiPanel")) {
        new AnalyticsDashboard();
    }
});
