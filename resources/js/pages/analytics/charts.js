/**
 * Analytics Chart Renderers
 * Handles rendering of all Chart.js instances
 */

import Chart from 'chart.js/auto';
import { getThemeColors } from './helpers.js';

export function renderStatusChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const breakdown = data.ticket_status_breakdown || { labels: [], data: [] };

    return new Chart(canvas, {
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

export function renderTrendChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const trend = data.monthly_tickets || { labels: [], open: [], in_progress: [], closed: [] };

    return new Chart(canvas, {
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

export function renderCostChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const cost = data.monthly_cost || { labels: [], data: [] };

    const ctx = canvas.getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, colors.primaryLight);
    gradient.addColorStop(1, 'rgba(79, 70, 229, 0)');

    return new Chart(canvas, {
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

export function renderEquipmentChart(canvas, data, existingChart, totalElement, legendElement) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const priority = data.by_priority || { labels: [], data: [] };
    const total = priority.data.reduce((a, b) => a + b, 0);

    if (totalElement) {
        totalElement.innerHTML = `
            <span class="text-4xl font-black text-(--text)">${total}</span>
            <span class="mt-1 text-[9px] font-bold uppercase tracking-widest text-(--text-soft)">Tickets</span>
        `;
    }

    const chart = new Chart(canvas, {
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
    if (legendElement) {
        legendElement.innerHTML = priority.labels.map((label, idx) => {
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
                        <span class="text-(--text)">${label}</span>
                    </div>
                    <span class="text-(--text-soft)">${count} (${pct}%)</span>
                </div>
            `;
        }).join("");
    }

    return chart;
}

export function destroyChart(chart) {
    if (chart) {
        chart.destroy();
        return null;
    }
    return chart;
}
