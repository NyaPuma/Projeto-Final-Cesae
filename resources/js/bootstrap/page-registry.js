import { initExportActions, initPrintActions } from '../pages/analytics/export.js';
import { initPublicTicketForm } from '../pages/ticket-public.js';

const pageRegistry = {
    dashboard: () => import('../pages/dashboard.js'),
    'ticket-detail': () => import('../pages/ticket-detail.js'),
    calendar: () => import('../pages/calendar.js'),
    audits: () => import('../pages/audits.js'),
    profile: () => import('../pages/profile.js'),
    rooms: () => import('../pages/rooms-management.js'),
    equipments: () => import('../pages/equipments-management.js'),
    tickets: () => import('../pages/tickets-management.js'),
    users: () => import('../pages/users-management.js'),
    'users-create': () => import('../pages/users-form.js'),
    'users-edit': () => import('../pages/users-form.js'),
    'user-detail': () => import('../pages/users-form.js'),
    'equipments-create': () => import('../pages/equipments-form.js'),
    'equipments-edit': () => import('../pages/equipments-form.js'),
    'rooms-create': () => import('../pages/rooms-form.js'),
    'rooms-edit': () => import('../pages/rooms-form.js'),
    analytics: () => import('../pages/analytics/index.js'),
    'ticket-create': () => import('../pages/ticket-create.js'),
    'definicoes-aparencia': () => import('../pages/definicoes-aparencia.js'),
    'definicoes-sistema': () => import('../pages/definicoes-sistema.js'),
    'auth-reset': () => import('../pages/auth-reset.js'),
    'stock-dashboard': () => import('../pages/stock/dashboard.js'),
    'stock-parts': () => import('../pages/stock/parts.js'),
    'stock-parts-create': () => import('../pages/stock/parts-form.js'),
    'stock-parts-edit': () => import('../pages/stock/parts-form.js'),
    'stock-suppliers': () => import('../pages/stock/suppliers.js'),
    'stock-suppliers-create': () => import('../pages/stock/suppliers-form.js'),
    'stock-suppliers-edit': () => import('../pages/stock/suppliers-form.js'),
    'stock-movements': () => import('../pages/stock/movements.js'),
    'stock-tax-rates': () => import('../pages/stock/tax-rates.js'),
    'stock-categories': () => import('../pages/stock/categories.js'),
    'stock-plans': () => import('../pages/stock/plans.js'),
    docs: () => import('../pages/swagger.js'),
    'equipment-detail': () => import('../pages/equipments-management.js'),
    'equipment-qr': () => import('../pages/equipments-management.js'),
    'room-detail': () => import('../pages/rooms-management.js'),
    'stock-part-detail': () => import('../pages/stock/parts.js'),
    preferences: () => null,
    error: () => null,
};

export function bootPageModules(root = document) {
    initExportActions();
    initPrintActions();
    initPublicTicketForm();

    const page = root.body?.dataset.page;

    if (!page || !pageRegistry[page]) {
        return;
    }

    pageRegistry[page]().then((module) => {
        if (module?.init) {
            module.init();
        }
    });
}
