/**
 * Notifications Module
 * Handles notification fetching, display, and polling
 */

import { authHeader, isAuthenticated } from './auth.js';
import { formatDateTime } from '../utils/locale.js';

let notificationsVisible = false;
let notifPollInterval = null;

function closeLanguageDropdown() {
    const langDropdown = document.getElementById('langDropdown');
    const langBtn = document.getElementById('langDropdownBtn');
    if (langDropdown) {
        langDropdown.classList.remove('active');
    }
    if (langBtn) {
        langBtn.setAttribute('aria-expanded', 'false');
    }
}

export function toggleNotifications() {
    const dropdown = document.getElementById('notificationDropdown');
    if (!dropdown) return;

    notificationsVisible = !notificationsVisible;

    dropdown.classList.toggle('active', notificationsVisible);

    const bellBtn = document.getElementById('notificationBellBtn');
    if (bellBtn) {
        bellBtn.setAttribute('aria-expanded', notificationsVisible ? 'true' : 'false');
    }

    if (notificationsVisible) {
        closeLanguageDropdown();
        fetchNotifications();
    }
}

function toArray(value) {
    if (Array.isArray(value)) {
        return value;
    }
    if (value && Array.isArray(value.data)) {
        return value.data;
    }
    if (value && Array.isArray(value.notifications)) {
        return value.notifications;
    }
    return [];
}

function renderEmpty(list, badge, countLabel) {
    list.innerHTML = `
        <p class="text-xs text-(--text-soft) text-center py-6 italic">
            🔕 Sem notificações
        </p>
    `;
    if (badge) badge.classList.add('hidden');
    if (countLabel) countLabel.innerText = '0 por ler';
}

function notificationIcon(type) {
    if (type?.includes('approved')) return '✅';
    if (type?.includes('rejected')) return '❌';
    if (type?.includes('budget_request')) return '💰';
    if (type?.includes('auto_approved')) return '🟢';
    if (type?.includes('closed')) return '🔧';
    if (type?.includes('budget_submitted')) return '📋';
    if (type?.includes('priority_override')) return '⚠️';
    return '📌';
}

function renderItem(n) {
    const isUnread = !n.is_read && !n.read_at;
    const icon = notificationIcon(n.type);
    return `
        <div class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-(--surface-2) transition-all ${isUnread ? 'bg-primary/5 border-l-2 border-primary' : ''} ${n.link ? 'cursor-pointer' : ''}" ${n.link ? `data-notif-link="${n.link}" data-notif-id="${n.id}"` : ''}>
            <span class="text-base flex-shrink-0 mt-0.5">${icon}</span>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-bold text-(--text) leading-tight ${isUnread ? '' : 'opacity-70'}">${n.title || ''}</p>
                <p class="text-[10px] text-(--text-soft) mt-0.5 line-clamp-2">${n.message || n.description || ''}</p>
                <p class="text-[9px] text-(--text-soft) mt-1 opacity-50">${n.created_at ? formatDateTime(n.created_at) : ''}</p>
            </div>
            ${isUnread ? '<span class="w-2 h-2 rounded-full bg-primary flex-shrink-0 mt-1.5"></span>' : ''}
        </div>
    `;
}

async function fetchNotifications() {
    const list = document.getElementById('notificationList');
    const badge = document.getElementById('notificationBadge');
    const countLabel = document.getElementById('notifCountLabel');
    if (!list) return;

    try {
        const res = await fetch('/notifications', { headers: authHeader() });
        if (!res.ok) throw new Error('Failed');

        const data = await res.json();
        const notifications = toArray(data.notifications || data.data || data);

        if (!notifications.length) {
            renderEmpty(list, badge, countLabel);
            return;
        }

        const unreadCount = notifications.filter(n => !n.is_read && !n.read_at).length;

        if (badge) {
            if (unreadCount > 0) {
                badge.innerText = unreadCount > 99 ? '99+' : unreadCount;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }
        if (countLabel) {
            countLabel.innerText = unreadCount + ' por ler';
        }

        const items = notifications.slice(0, 20);
        list.innerHTML = items.map(renderItem).join('') + (notifications.length > 20 ? `
            <div class="text-center pt-2">
                <span class="text-[9px] text-(--text-soft) font-medium">+${notifications.length - 20} mais</span>
            </div>
        ` : '');
    } catch (e) {
        console.warn('Erro ao carregar notificações:', e);
        if (list) {
            list.innerHTML = `
                <p class="text-xs text-(--text-soft) text-center py-6 italic">⚠️ Erro ao carregar</p>
            `;
        }
    }
}

async function markNotifRead(id) {
    try {
        await fetch('/notifications/' + id, {
            method: 'PATCH',
            headers: authHeader()
        });
        fetchNotifications();
    } catch (e) {}
}

export function startNotificationPolling() {
    if (notifPollInterval) clearInterval(notifPollInterval);
    // Buscar imediatamente
    if (isAuthenticated()) {
        fetchNotifications();
    }
    // Repetir a cada 30s
    notifPollInterval = setInterval(() => {
        if (isAuthenticated()) {
            fetchNotifications();
        }
    }, 30000);
}

export function setupNotificationDropdown() {
    const container = document.getElementById('notificationBellContainer');
    const dropdown = document.getElementById('notificationDropdown');
    const bellBtn = document.getElementById('notificationBellBtn');

    // Cliques nos itens da lista (delegação evita eval/onclick inline)
    document.addEventListener('click', (e) => {
        const item = e.target.closest('[data-notif-link]');
        if (!item) return;

        const link = item.dataset.notifLink;
        const id = Number(item.dataset.notifId);

        if (link) {
            window.location.href = link;
        }
        if (id) {
            markNotifRead(id);
        }
    });

    // Fechar dropdown ao clicar fora
    document.addEventListener('click', (e) => {
        if (container && dropdown && !container.contains(e.target) && dropdown.classList.contains('active')) {
            dropdown.classList.remove('active');
            notificationsVisible = false;
            if (bellBtn) {
                bellBtn.setAttribute('aria-expanded', 'false');
            }
        }
    });
}
