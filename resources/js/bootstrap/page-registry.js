import { init as initDashboard } from '../pages/dashboard.js';
import { init as initTicketDetail } from '../pages/ticket-detail.js';
import { init as initCalendar } from '../pages/calendar.js';
import { init as initAudits } from '../pages/audits.js';
import { init as initProfile } from '../pages/profile.js';
import { init as initRoomsManagement } from '../pages/rooms-management.js';
import { init as initEquipmentsManagement } from '../pages/equipments-management.js';
import { init as initTicketCreate } from '../pages/ticket-create.js';
import { init as initAuthReset } from '../pages/auth-reset.js';
import { init as initTicketsManagement } from '../pages/tickets-management.js';
import { init as initUsersManagement } from '../pages/users-management.js';
import { init as initUsersForm } from '../pages/users-form.js';
import { init as initEquipmentsForm } from '../pages/equipments-form.js';
import { init as initRoomsForm } from '../pages/rooms-form.js';
import { init as initAnalytics } from '../pages/analytics/index.js';
import { init as initThemeAppearance } from '../pages/definicoes-aparencia.js';
import { init as initSystemSettings } from '../pages/definicoes-sistema.js';
import { init as initStockDashboard } from '../pages/stock/dashboard.js';
import { init as initStockParts } from '../pages/stock/parts.js';
import { init as initStockPartsForm } from '../pages/stock/parts-form.js';
import { init as initStockSuppliers } from '../pages/stock/suppliers.js';
import { init as initStockSuppliersForm } from '../pages/stock/suppliers-form.js';
import { init as initStockMovements } from '../pages/stock/movements.js';
import { init as initStockTaxRates } from '../pages/stock/tax-rates.js';
import { init as initStockCategories } from '../pages/stock/categories.js';
import { init as initStockPlans } from '../pages/stock/plans.js';
import { initExportActions, initPrintActions } from '../pages/analytics/export.js';
import { initPublicTicketForm } from '../pages/ticket-public.js';
import { init as initSwagger } from '../pages/swagger.js';

const pageRegistry = {
    dashboard: initDashboard,
    'ticket-detail': initTicketDetail,
    calendar: initCalendar,
    audits: initAudits,
    profile: initProfile,
    rooms: initRoomsManagement,
    equipments: initEquipmentsManagement,
    tickets: initTicketsManagement,
    users: initUsersManagement,
    'users-create': initUsersForm,
    'users-edit': initUsersForm,
    'user-detail': initUsersForm,
    'equipments-create': initEquipmentsForm,
    'equipments-edit': initEquipmentsForm,
    'rooms-create': initRoomsForm,
    'rooms-edit': initRoomsForm,
    analytics: initAnalytics,
    'ticket-create': initTicketCreate,
    'definicoes-aparencia': initThemeAppearance,
    'definicoes-sistema': initSystemSettings,
    'auth-reset': initAuthReset,
    'stock-dashboard': initStockDashboard,
    'stock-parts': initStockParts,
    'stock-parts-create': initStockPartsForm,
    'stock-parts-edit': initStockPartsForm,
    'stock-suppliers': initStockSuppliers,
    'stock-suppliers-create': initStockSuppliersForm,
    'stock-suppliers-edit': initStockSuppliersForm,
    'stock-movements': initStockMovements,
    'stock-tax-rates': initStockTaxRates,
    'stock-categories': initStockCategories,
    'stock-plans': initStockPlans,
    docs: initSwagger,
};

export function bootPageModules(root = document) {
    initExportActions();
    initPrintActions();
    initPublicTicketForm();

    const page = root.body?.dataset.page;

    if (!page || !pageRegistry[page]) {
        return;
    }

    pageRegistry[page]();
}
