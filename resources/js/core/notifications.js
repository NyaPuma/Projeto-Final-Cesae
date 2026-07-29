/**
 * Notifications Module
 * Handles notification fetching, display, and polling
 */

import { authHeader, isAuthenticated } from './auth.js';

let notificationCount = 0;
let notificationsVisible = false;
let notifPollInterval = null;

export function toggleNotifications() {
    const dropdown = document.getElementById('notificationDropdown');
    if (!dropdown) return;
    notificationsVisible = !notificationsVisible;
    dropdown.classList.toggle('hidden', !notificationsVisible);
    if (notificationsVisible) {
        fetchNotifications();
    }
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
        const notifications = data.notifications || data.data || data || [];

        // Se não houver notificações
        if (!notifications.length || notifications.length === 0) {
            list.innerHTML = `
                <p class="text-xs text-(--text-soft) text-center py-6 italic">
                    🔕 Sem notificações
                </p>
            `;
            if (badge) badge.classList.add('hidden');
            if (countLabel) countLabel.innerText = '0 por ler';
            notificationCount = 0;
            return;
        }

        // Contar não lidas
        const unreadCount = notifications.filter(n => !n.is_read && !n.read_at).length;
        notificationCount = unreadCount;

        // Atualizar badge
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

        // Renderizar lista (mostrar últimas 20)
        const items = notifications.slice(0, 20);
        list.innerHTML = items.map(n => {
            const isUnread = !n.is_read && !n.read_at;
            const icon = n.type?.includes('approved') ? '✅' :
                        n.type?.includes('rejected') ? '❌' :
                        n.type?.includes('budget_request') ? '💰' :
                        n.type?.includes('auto_approved') ? '🟢' :
                        n.type?.includes('closed') ? '🔧' :
                        n.type?.includes('budget_submitted') ? '📋' :
                        n.type?.includes('priority_override') ? '⚠️' : '📌';
            return `
                <div class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-(--surface-2) transition-all ${isUnread ? 'bg-primary/5 border-l-2 border-primary' : ''} ${n.link ? 'cursor-pointer' : ''}" onclick="${n.link ? `window.location='${n.link}'; markNotifRead(${n.id})` : ''}">
                    <span class="text-base flex-shrink-0 mt-0.5">${icon}</span>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-(--text) leading-tight ${isUnread ? '' : 'opacity-70'}">${n.title || ''}</p>
                        <p class="text-[10px] text-(--text-soft) mt-0.5 line-clamp-2">${n.message || n.description || ''}</p>
                        <p class="text-[9px] text-(--text-soft) mt-1 opacity-50">${n.created_at ? new Date(n.created_at).toLocaleDateString('pt-PT', { day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' }) : ''}</p>
                    </div>
                    ${isUnread ? '<span class="w-2 h-2 rounded-full bg-primary flex-shrink-0 mt-1.5"></span>' : ''}
                </div>
            `;
        }).join('') + (notifications.length > 20 ? `
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
    // Fechar dropdown ao clicar fora
    document.addEventListener('click', (e) => {
        const container = document.getElementById('notificationBellContainer');
        const dropdown = document.getElementById('notificationDropdown');
        if (container && dropdown && !container.contains(e.target) && !dropdown.classList.contains('hidden')) {
            dropdown.classList.add('hidden');
            notificationsVisible = false;
        }
    });
}
