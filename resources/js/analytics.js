/**
 * Analytics Dashboard Manager
 * Responsável por gerir a atualização e renderização do dashboard.
 */
class AnalyticsDashboard {
    constructor() {
        this.charts = { status: null, trend: null, cost: null, equipment: null };
        this.refreshTimer = null;
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
            topTechnicians: document.getElementById("topTechnicians")
        };
    }

    async init() {
        if (!this.elements.kpiPanel) return;

        // Aplicar tema global (dependência externa)
        if (typeof applyChartTheme === 'function') applyChartTheme();

        await this.refresh();
        this.startAutoRefresh();

        document.addEventListener("visibilitychange", () => {
            document.hidden ? this.stopAutoRefresh() : this.refresh();
        });

        window.addEventListener("beforeunload", () => this.cleanup());
    }

    async refresh() {
        this.setLoading(true);
        try {
            const data = await this.fetchAnalytics();
            if (data) this.updateUI(data);
        } finally {
            this.setLoading(false);
        }
    }

    setLoading(isLoading) {
        // Exemplo: desativar inputs ou mostrar um overlay se existisse
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

    // --- Renderers (Otimizados) ---

    renderKPIs(data) {
        const cards = [
            { title: "Tempo Médio de Resolução", value: `${Math.round(data.average_resolution_minutes || 0)} min`, icon: "🛠️", color: "emerald", subtitle: "MTTR" },
            { title: "Tempo Médio de Espera", value: `${Math.round(data.average_waiting_minutes || 0)} min`, icon: "⏱️", color: "blue", subtitle: "Tempo até atribuição" },
            { title: "Tickets Abertos", value: data.open_tickets || 0, icon: "📂", color: "amber", subtitle: "Ocorrências ativas" },
            { title: "Tickets Resolvidos", value: data.closed_tickets || 0, icon: "✅", color: "purple", subtitle: "Intervenções concluídas" }
        ];

        this.elements.kpiPanel.innerHTML = cards.map(card => `
            <article class="group overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)] transition-all hover:-translate-y-1 hover:shadow-xl p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-widest text-soft">${card.title}</p>
                        <h3 class="mt-5 text-4xl font-black tracking-tight">${card.value}</h3>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-${card.color}-500/10 text-${card.color}-500">
                        <span class="text-2xl">${card.icon}</span>
                    </div>
                </div>
                <div class="mt-8">
                    <span class="rounded-full px-3 py-1 text-xs font-semibold bg-${card.color}-500/10 text-${card.color}-600 dark:text-${card.color}-400">
                        ${card.subtitle}
                    </span>
                </div>
            </article>
        `).join("");
    }

    // ... Nota: O resto dos métodos de renderização (Charts, Ranking, etc)
    // seguem esta mesma lógica limpa de destruição de instâncias.

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
