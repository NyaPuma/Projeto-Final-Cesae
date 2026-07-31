import { fetchCurrentUser } from './api.js';
import { showAddEquipmentButton } from './dom.js';

function isAdminUser(user) {
    return user?.is_admin || user?.role === 'admin' || user?.type === 'admin';
}

export async function revealAdminActions() {
    const storedUser = localStorage.getItem('user');

    if (storedUser) {
        try {
            const user = JSON.parse(storedUser);
            if (isAdminUser(user)) {
                showAddEquipmentButton();
                return;
            }
        } catch {}
    }

    const user = await fetchCurrentUser();
    if (isAdminUser(user?.user || user)) {
        showAddEquipmentButton();
    }
}
