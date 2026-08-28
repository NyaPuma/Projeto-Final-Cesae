/**
 * Analytics Chart Renderers
 * Handles rendering of all Chart.js instances
 */

import Chart from 'chart.js/auto';
import { getThemeColors } from './helpers.js';

/**
 * Determines if a dataset has no presentable values.
 */
function isEmpty(data) {
    return !data || data.length === 0 || data.every(v => v === 0 || v === null || v === undefined);
}

function getAnalyticsDataTranslations() {
    const configured = window.SGM_ANALYTICS_DATA_I18N || {};
    const body = document.body?.dataset || {};

    return {
        urgent: configured.urgent || body.analyticsDataUrgent || 'Urgent',
        normal: configured.normal || body.analyticsDataNormal || 'Normal',
        web: configured.web || body.analyticsDataWeb || 'Web',
        qr: configured.qr || body.analyticsDataQr || 'QR code',
        api: configured.api || body.analyticsDataApi || 'API',
        mobile: configured.mobile || body.analyticsDataMobile || 'Mobile',
        phone: configured.phone || body.analyticsDataPhone || 'Phone',
        ticket_updated: configured.ticket_updated || body.analyticsDataTicketUpdated || 'Ticket updated',
        ticket_assigned: configured.ticket_assigned || body.analyticsDataTicketAssigned || 'Ticket assigned',
        comment_added: configured.comment_added || body.analyticsDataCommentAdded || 'Comment added',
        attachment_added: configured.attachment_added || body.analyticsDataAttachmentAdded || 'Attachment added',
        budget_request: configured.budget_request || body.analyticsDataBudgetRequest || 'Budget request',
    };
}

/**
 * Draws a readable empty state on the canvas when no data exists.
 */
function drawEmptyMessage(canvas) {
    const colors = getThemeColors();
    const ctx = canvas.getContext('2d');
    const width = canvas.clientWidth || 300;
    const height = canvas.clientHeight || 200;

    ctx.clearRect(0, 0, width, height);
    ctx.fillStyle = colors.textSoft;
    ctx.font = '600 13px system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('Sem dados para apresentar', width / 2, height / 2);
}

export function renderStatusChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const breakdown = data.ticket_status_breakdown || { labels: [], data: [] };
    const statusTranslations = window.SGM_TICKET_DETAIL_I18N?.status || {};
    const statusLabels = breakdown.labels.map((label) => {
        const key = String(label).toLowerCase().trim();
        const aliases = {
            abertos: statusTranslations.aberto,
            aberto: statusTranslations.aberto,
            'em curso': statusTranslations['em curso'],
            'pendente de orçamento': statusTranslations['pendente de orçamento'],
            'pendente orçamento': statusTranslations['pendente orçamento'],
            fechados: statusTranslations.fechado,
            fechado: statusTranslations.fechado,
        };

        return aliases[key] || label;
    });

    if (isEmpty(breakdown.data)) {
        drawEmptyMessage(canvas);
        return null;
    }

    return new Chart(canvas, {
        type: 'bar',
        data: {
            labels: statusLabels,
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
    const statusTranslations = window.SGM_TICKET_DETAIL_I18N?.status || {};

    if (isEmpty(trend.open) && isEmpty(trend.in_progress) && isEmpty(trend.closed)) {
        drawEmptyMessage(canvas);
        return null;
    }

    return new Chart(canvas, {
        type: 'bar',
        data: {
            labels: trend.labels,
            datasets: [
                {
                    label: statusTranslations.aberto || 'Open',
                    data: trend.open,
                    backgroundColor: 'rgba(59, 130, 246, 0.85)',
                    borderRadius: 6
                },
                {
                    label: statusTranslations['em curso'] || 'In progress',
                    data: trend.in_progress,
                    backgroundColor: 'rgba(245, 158, 11, 0.85)',
                    borderRadius: 6
                },
                {
                    label: statusTranslations.fechado || 'Closed',
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

    if (isEmpty(cost.data)) {
        drawEmptyMessage(canvas);
        return null;
    }

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
    const analyticsTranslations = window.SGM_ANALYTICS_I18N || {};
    const ticketsLabel = analyticsTranslations.tickets || document.body?.dataset.analyticsTickets || 'Tickets';
    const priorityTranslations = window.SGM_TICKETS_I18N?.priority || {};
    const priorityLabels = priority.labels.map((label) => priorityTranslations[String(label).toLowerCase()] || label);

    if (totalElement) {
        totalElement.innerHTML = `
            <span class="text-4xl font-black text-(--text)">${total}</span>
            <span class="mt-1 text-xs font-bold uppercase tracking-widest text-(--text-soft)">${ticketsLabel}</span>
        `;
    }

    if (isEmpty(priority.data)) {
        drawEmptyMessage(canvas);
        if (legendElement) legendElement.innerHTML = '';
        return null;
    }

    const chart = new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: priorityLabels,
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
        legendElement.innerHTML = priorityLabels.map((label, idx) => {
            const count = priority.data[idx];
            const pct = total > 0 ? Math.round((count / total) * 100) : 0;
            let colorClass = '';
            if (idx === 0) colorClass = 'bg-success';
            else if (idx === 1) colorClass = 'bg-warning';
            else colorClass = 'bg-danger';

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

// ============================================================
// New charts
// ============================================================

function baseOptions(colors, legend = false) {
    return {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: legend ? {
                position: 'top',
                labels: { color: colors.text, font: { weight: '600', size: 11 } }
            } : { display: false }
        }
    };
}

function axesOptions(colors) {
    return {
        x: {
            grid: { display: false },
            ticks: { color: colors.textSoft, font: { weight: '600', size: 11 } }
        },
        y: {
            grid: { color: colors.border },
            ticks: { color: colors.textSoft, font: { weight: '600', size: 11 } },
            border: { dash: [4, 4] }
        }
    };
}

function horizontalAxesOptions(colors) {
    return {
        x: {
            grid: { color: colors.border },
            ticks: { color: colors.textSoft, font: { weight: '600', size: 11 } },
            border: { dash: [4, 4] }
        },
        y: {
            grid: { display: false },
            ticks: { color: colors.textSoft, font: { weight: '600', size: 11 } }
        }
    };
}

/**
 * Monthly SLA (%). Null values represent months with no closed tickets.
 */
export function renderSlaChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const sla = data.monthly_sla || { labels: [], data: [] };

    if (isEmpty(sla.data)) {
        drawEmptyMessage(canvas);
        return null;
    }

    return new Chart(canvas, {
        type: 'line',
        data: {
            labels: sla.labels,
            datasets: [{
                label: 'SLA (%)',
                data: sla.data,
                borderColor: colors.primary,
                borderWidth: 3,
                backgroundColor: 'rgba(79, 70, 229, 0.08)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: colors.primary,
                pointRadius: 3,
                spanGaps: true
            }]
        },
        options: {
            ...baseOptions(colors),
            scales: axesOptions(colors)
        }
    });
}

/**
 * MTTR mensal (minutos).
 */
export function renderMttrChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const mttr = data.monthly_mttr || { labels: [], data: [] };

    if (isEmpty(mttr.data)) {
        drawEmptyMessage(canvas);
        return null;
    }

    return new Chart(canvas, {
        type: 'line',
        data: {
            labels: mttr.labels,
            datasets: [{
                label: 'MTTR (min)',
                data: mttr.data,
                borderColor: 'rgba(245, 158, 11, 0.9)',
                borderWidth: 3,
                backgroundColor: 'rgba(245, 158, 11, 0.08)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'rgba(245, 158, 11, 1)',
                pointRadius: 3,
                spanGaps: true
            }]
        },
        options: {
            ...baseOptions(colors),
            scales: axesOptions(colors)
        }
    });
}

/**
 * Tickets by urgency (doughnut).
 */
export function renderUrgencyChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const urgency = data.by_urgency || { labels: [], data: [] };
    const analyticsDataTranslations = getAnalyticsDataTranslations();
    const urgencyLabels = urgency.labels.map((label) => {
        const key = String(label).toLowerCase().trim();
        return key === 'urgentes' ? (analyticsDataTranslations.urgent || label)
            : key === 'normais' ? (analyticsDataTranslations.normal || label) : label;
    });

    if (isEmpty(urgency.data)) {
        drawEmptyMessage(canvas);
        return null;
    }

    return new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: urgencyLabels,
            datasets: [{
                data: urgency.data,
                backgroundColor: ['rgba(239, 68, 68, 0.85)', 'rgba(59, 130, 246, 0.85)'],
                borderWidth: 0,
                cutout: '72%'
            }]
        },
        options: {
            ...baseOptions(colors, true),
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: colors.text, font: { weight: '600', size: 11 }, boxWidth: 12 }
                }
            }
        }
    });
}

/**
 * Tickets by room (horizontal bar).
 */
export function renderRoomChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const rooms = data.by_room || { labels: [], data: [] };

    if (isEmpty(rooms.data)) {
        drawEmptyMessage(canvas);
        return null;
    }

    return new Chart(canvas, {
        type: 'bar',
        data: {
            labels: rooms.labels,
            datasets: [{
                label: 'Tickets',
                data: rooms.data,
                backgroundColor: 'rgba(16, 185, 129, 0.85)',
                borderRadius: 6
            }]
        },
        options: {
            ...baseOptions(colors),
            indexAxis: 'y',
            scales: horizontalAxesOptions(colors)
        }
    });
}

/**
 * Budget status distribution (doughnut).
 */
export function renderBudgetChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const budget = data.by_budget_status || { labels: [], data: [] };

    if (isEmpty(budget.data)) {
        drawEmptyMessage(canvas);
        return null;
    }

    return new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: budget.labels,
            datasets: [{
                data: budget.data,
                backgroundColor: [
                    'rgba(245, 158, 11, 0.85)',
                    'rgba(16, 185, 129, 0.85)',
                    'rgba(239, 68, 68, 0.85)'
                ],
                borderWidth: 0,
                cutout: '72%'
            }]
        },
        options: {
            ...baseOptions(colors, true),
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: colors.text, font: { weight: '600', size: 11 }, boxWidth: 12 }
                }
            }
        }
    });
}

/**
 * Tickets por origem (doughnut).
 */
export function renderSourceChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const source = data.by_source || { labels: [], data: [] };
    const analyticsDataTranslations = getAnalyticsDataTranslations();
    const sourceLabels = source.labels.map((label) => {
        const key = String(label).toLowerCase().trim();
        return analyticsDataTranslations[key] || label;
    });

    if (isEmpty(source.data)) {
        drawEmptyMessage(canvas);
        return null;
    }

    const palette = [
        'rgba(59, 130, 246, 0.85)',
        'rgba(16, 185, 129, 0.85)',
        'rgba(245, 158, 11, 0.85)',
        'rgba(236, 72, 153, 0.85)',
        'rgba(139, 92, 246, 0.85)'
    ];

    return new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: sourceLabels,
            datasets: [{
                data: source.data,
                backgroundColor: sourceLabels.map((_, i) => palette[i % palette.length]),
                borderWidth: 0,
                cutout: '72%'
            }]
        },
        options: {
            ...baseOptions(colors, true),
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: colors.text, font: { weight: '600', size: 11 }, boxWidth: 12 }
                }
            }
        }
    });
}

/**
 * Intervention cost by equipment (horizontal bar).
 */
export function renderCostByEquipmentChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const cost = data.cost_by_equipment || { labels: [], data: [] };

    if (isEmpty(cost.data)) {
        drawEmptyMessage(canvas);
        return null;
    }

    return new Chart(canvas, {
        type: 'bar',
        data: {
            labels: cost.labels,
            datasets: [{
                label: 'Custo (€)',
                data: cost.data,
                backgroundColor: 'rgba(236, 72, 153, 0.85)',
                borderRadius: 6
            }]
        },
        options: {
            ...baseOptions(colors),
            indexAxis: 'y',
            scales: horizontalAxesOptions(colors)
        }
    });
}

/**
 * Monthly stock movement (entries vs exits).
 */
export function renderStockMonthlyChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const stock = data.stock_monthly || { labels: [], in: [], out: [] };

    if (isEmpty(stock.in) && isEmpty(stock.out)) {
        drawEmptyMessage(canvas);
        return null;
    }

    return new Chart(canvas, {
        type: 'bar',
        data: {
            labels: stock.labels,
            datasets: [
                {
                    label: 'Entradas',
                    data: stock.in,
                    backgroundColor: 'rgba(16, 185, 129, 0.85)',
                    borderRadius: 4
                },
                {
                    label: 'Saídas',
                    data: stock.out,
                    backgroundColor: 'rgba(239, 68, 68, 0.85)',
                    borderRadius: 4
                }
            ]
        },
        options: {
            ...baseOptions(colors, true),
            scales: axesOptions(colors)
        }
    });
}

/**
 * Low stock parts (horizontal bar).
 */
export function renderLowStockChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const parts = data.low_stock_parts || { labels: [], data: [] };

    if (isEmpty(parts.data)) {
        drawEmptyMessage(canvas);
        return null;
    }

    return new Chart(canvas, {
        type: 'bar',
        data: {
            labels: parts.labels,
            datasets: [{
                label: 'Stock atual',
                data: parts.data,
                backgroundColor: 'rgba(239, 68, 68, 0.85)',
                borderRadius: 6
            }]
        },
        options: {
            ...baseOptions(colors),
            indexAxis: 'y',
            scales: horizontalAxesOptions(colors)
        }
    });
}

/**
 * Notifications by type (doughnut).
 */
export function renderNotificationsChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const notifications = data.notifications_by_type || { labels: [], data: [] };
    const analyticsDataTranslations = getAnalyticsDataTranslations();
    const notificationLabels = notifications.labels.map((label) => {
        const key = String(label).toLowerCase().trim();
        return analyticsDataTranslations[key] || label;
    });

    if (isEmpty(notifications.data)) {
        drawEmptyMessage(canvas);
        return null;
    }

    const palette = [
        'rgba(59, 130, 246, 0.85)',
        'rgba(16, 185, 129, 0.85)',
        'rgba(245, 158, 11, 0.85)',
        'rgba(236, 72, 153, 0.85)',
        'rgba(139, 92, 246, 0.85)',
        'rgba(239, 68, 68, 0.85)',
        'rgba(6, 182, 212, 0.85)',
        'rgba(132, 204, 22, 0.85)'
    ];

    return new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: notificationLabels,
            datasets: [{
                data: notifications.data,
                backgroundColor: notificationLabels.map((_, i) => palette[i % palette.length]),
                borderWidth: 0,
                cutout: '72%'
            }]
        },
        options: {
            ...baseOptions(colors, true),
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: colors.text, font: { weight: '600', size: 11 }, boxWidth: 12 }
                }
            }
        }
    });
}

/**
 * Users by role distribution (doughnut).
 */
export function renderUsersByRoleChart(canvas, data, existingChart) {
    if (!canvas) return null;
    if (existingChart) existingChart.destroy();

    const colors = getThemeColors();
    const roles = data.users_by_role || { labels: [], data: [] };

    if (isEmpty(roles.data)) {
        drawEmptyMessage(canvas);
        return null;
    }

    const palette = [
        'rgba(139, 92, 246, 0.85)',
        'rgba(16, 185, 129, 0.85)',
        'rgba(59, 130, 246, 0.85)',
        'rgba(245, 158, 11, 0.85)',
        'rgba(236, 72, 153, 0.85)'
    ];

    return new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: roles.labels,
            datasets: [{
                data: roles.data,
                backgroundColor: roles.labels.map((_, i) => palette[i % palette.length]),
                borderWidth: 0,
                cutout: '72%'
            }]
        },
        options: {
            ...baseOptions(colors, true),
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: colors.text, font: { weight: '600', size: 11 }, boxWidth: 12 }
                }
            }
        }
    });
}
