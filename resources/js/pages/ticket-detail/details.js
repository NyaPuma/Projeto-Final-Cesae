const priorityColors = {
    baixa: 'border border-emerald-500/10 bg-emerald-500/5 text-emerald-600 dark:text-emerald-400',
    média: 'border border-amber-500/15 bg-amber-500/5 text-amber-600 dark:text-amber-400',
    alta: 'border border-orange-500/15 bg-orange-500/5 text-orange-600 dark:text-orange-400',
    crítica: 'border border-purple-500/20 bg-purple-500/5 text-purple-600 dark:text-purple-400',
};

const translations = () => window.SGM_TICKET_DETAIL_I18N || {};

function resolveStatusBadge(statusClean, statusName) {
    if (statusClean === 'em curso') {
        return `<span class="inline-block rounded-lg border border-emerald-500/20 bg-emerald-500/10 px-2 py-0.5 text-[11px] font-bold uppercase tracking-tight text-emerald-600 dark:text-emerald-400">⚙️ ${translations().inProgress || ''}</span>`;
    }

    if (statusClean === 'fechada' || statusClean === 'fechado') {
        return `<span class="inline-block rounded-lg bg-(--text-soft)/10 px-2 py-0.5 text-[11px] font-bold uppercase tracking-tight text-(--text-soft)">${translations().closed || ''}</span>`;
    }

    return `<span class="inline-block rounded-lg bg-blue-500/10 px-2 py-0.5 text-[11px] font-bold uppercase tracking-tight text-blue-600 dark:text-blue-400">${translations().status?.[statusClean] || statusName || ''}</span>`;
}

export function renderTicketDetails(ticket) {
    const details = document.getElementById('ticketDetails');
    if (!details) return;

    const statusName = typeof ticket.status === 'object' && ticket.status !== null
        ? ticket.status.name
        : (typeof ticket.status === 'string' ? ticket.status : null);
    const statusClean = (statusName || '').toLowerCase();
    const priorityClass = priorityColors[ticket.priority] ?? 'border border-(--border) bg-(--surface-2) text-(--text-soft)';
    const statusBadge = resolveStatusBadge(statusClean, ticket.status_label);

    details.innerHTML = `
        <div class="mb-5 border-b border-(--border) pb-4">
            <div class="flex items-center justify-between gap-4">
                <span class="rounded-lg bg-(--surface-2) px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-(--text-soft) font-mono">${translations().incidentId || ''} #${ticket.id}</span>
                <div class="flex gap-1.5">${statusBadge}</div>
            </div>
            <h2 class="mt-3 text-base font-bold text-(--text)">${ticket.title}</h2>
        </div>

        <div class="space-y-5">
            <div>
                <span class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">${translations().description || ''}</span>
                <div class="rounded-xl border border-(--border) bg-(--surface-2) p-3.5 text-xs leading-relaxed text-(--text) whitespace-pre-wrap">${ticket.description || translations().noDescription || ''}</div>
            </div>

            <div class="grid grid-cols-2 gap-x-4 gap-y-4 pt-2">
                <div>
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">${translations().priorityLevel || ''}</span>
                    <span class="mt-1 inline-block rounded-lg px-2 py-0.5 text-[11px] font-bold uppercase tracking-tight ${priorityClass}">${ticket.priority_label || translations().priority?.[ticket.priority] || ''}</span>
                </div>
                <div>
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">${translations().equipment || ''}</span>
                    <p class="mt-1 text-xs font-semibold text-(--text)">${ticket.equipment ? ticket.equipment.name : '<span class="font-normal text-(--text-soft)">—</span>'}</p>
                </div>
                <div>
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">${translations().room || ''}</span>
                    <p class="mt-1 text-xs font-semibold text-(--text)">${ticket.room ? ticket.room.name : '<span class="font-normal text-(--text-soft)">—</span>'}</p>
                </div>
                <div>
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">${translations().technician || ''}</span>
                    <p class="mt-1 text-xs font-semibold text-(--text)">${ticket.technician ? ticket.technician.name : `<span class="font-normal italic text-rose-500">${translations().pendingAssignment || ''}</span>`}</p>
                </div>
                <div>
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">${translations().reportedBy || ''}</span>
                    <p class="mt-1 text-xs font-semibold text-(--text)">${ticket.reporter_name || (ticket.user ? ticket.user.name : '<span class="font-normal italic text-(--text-soft)">—</span>')}</p>
                    ${ticket.reporter_contact ? `<p class="mt-0.5 text-[10px] text-(--text-soft)">${ticket.reporter_contact}</p>` : ''}
                </div>
                <div>
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">${translations().source || ''}</span>
                    <p class="mt-1 text-xs font-semibold text-(--text)">${ticket.source === 'qr' ? `📷 ${translations().qrCode || ''}` : `<span class="font-normal text-(--text-soft)">${translations().web || ''}</span>`}</p>
                </div>
            </div>
        </div>
    `;

    return {
        statusName,
        statusClean,
    };
}
