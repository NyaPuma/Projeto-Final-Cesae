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
import { init as initAnalytics } from '../pages/analytics/index.js';

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
    'user-create': initUsersForm,
    'user-edit': initUsersForm,
    analytics: initAnalytics,
    'ticket-create': initTicketCreate,
    'auth-reset': initAuthReset,
};

export function bootPageModules(root = document) {
    const page = root.body?.dataset.page;

    if (!page || !pageRegistry[page]) {
        return;
    }

    pageRegistry[page]();
}
