/**
 * Analytics Dashboard Manager
 * Main orchestrator for the analytics dashboard
 */

import { fetchAnalytics, showMessage, clearMessage } from './helpers.js';
import { initExportActions } from './export.js';
import {
    renderStatusChart,
    renderTrendChart,
    renderCostChart,
    renderEquipmentChart,
    renderSlaChart,
    renderMttrChart,
    renderUrgencyChart,
    renderRoomChart,
    renderBudgetChart,
    renderSourceChart,
    renderCostByEquipmentChart,
    renderStockMonthlyChart,
    renderLowStockChart,
    renderNotificationsChart,
    renderUsersByRoleChart,
    destroyChart
} from './charts.js';
import { renderKPIs, renderOperationalMetrics } from './kpi.js';
import { renderActivity, renderSummary } from './activity.js';

class AnalyticsDashboard {
    constructor() {
        this.charts = {
            status: null, trend: null, cost: null, equipment: null,
            sla: null, mttr: null, urgency: null, room: null,
            budget: null, source: null, costByEquipment: null,
            stockMonthly: null, lowStock: null, notifications: null,
            usersByRole: null
        };
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
            slaChart: document.getElementById("slaChart"),
            mttrChart: document.getElementById("mttrChart"),
            urgencyChart: document.getElementById("urgencyChart"),
            roomChart: document.getElementById("roomChart"),
            budgetChart: document.getElementById("budgetChart"),
            sourceChart: document.getElementById("sourceChart"),
            costByEquipmentChart: document.getElementById("costByEquipmentChart"),
            stockMonthlyChart: document.getElementById("stockMonthlyChart"),
            lowStockChart: document.getElementById("lowStockChart"),
            notificationsChart: document.getElementById("notificationsChart"),
            usersByRoleChart: document.getElementById("usersByRoleChart"),
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
            const data = await fetchAnalytics();
            if (data) {
                this.lastData = data;
                this.updateUI(data);
            } else {
                showMessage(this.elements.analyticsMessage, "Erro ao carregar dados analíticos.", "error");
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
        if (isLoading) clearMessage(this.elements.analyticsMessage);
    }

    updateUI(data) {
        renderKPIs(this.elements.kpiPanel, data);
        this.charts.status = renderStatusChart(this.elements.statusChart, data, this.charts.status);
        this.charts.trend = renderTrendChart(this.elements.trendChart, data, this.charts.trend);
        this.charts.cost = renderCostChart(this.elements.costChart, data, this.charts.cost);
        this.charts.equipment = renderEquipmentChart(
            this.elements.equipmentChart, 
            data, 
            this.charts.equipment,
            this.elements.equipmentTotal,
            this.elements.equipmentLegend
        );
        renderOperationalMetrics(this.elements, data);
        renderActivity(this.elements.activityTimeline, data);
        renderSummary(this.elements, data);

        this.charts.sla = renderSlaChart(this.elements.slaChart, data, this.charts.sla);
        this.charts.mttr = renderMttrChart(this.elements.mttrChart, data, this.charts.mttr);
        this.charts.urgency = renderUrgencyChart(this.elements.urgencyChart, data, this.charts.urgency);
        this.charts.room = renderRoomChart(this.elements.roomChart, data, this.charts.room);
        this.charts.budget = renderBudgetChart(this.elements.budgetChart, data, this.charts.budget);
        this.charts.source = renderSourceChart(this.elements.sourceChart, data, this.charts.source);
        this.charts.costByEquipment = renderCostByEquipmentChart(this.elements.costByEquipmentChart, data, this.charts.costByEquipment);
        this.charts.stockMonthly = renderStockMonthlyChart(this.elements.stockMonthlyChart, data, this.charts.stockMonthly);
        this.charts.lowStock = renderLowStockChart(this.elements.lowStockChart, data, this.charts.lowStock);
        this.charts.notifications = renderNotificationsChart(this.elements.notificationsChart, data, this.charts.notifications);
        this.charts.usersByRole = renderUsersByRoleChart(this.elements.usersByRoleChart, data, this.charts.usersByRole);
    }

    cleanup() {
        this.stopAutoRefresh();
        Object.keys(this.charts).forEach(key => {
            this.charts[key] = destroyChart(this.charts[key]);
        });
    }

    startAutoRefresh() {
        this.stopAutoRefresh();
        this.refreshTimer = setInterval(() => this.refresh(), 60000);
    }

    stopAutoRefresh() {
        if (this.refreshTimer) clearInterval(this.refreshTimer);
    }
}

// Inicialização
export function init() {
    initExportActions();
    if (document.getElementById("kpiPanel")) {
        new AnalyticsDashboard();
    }
}
