const priorityColors = {
    baixa: 'border border-emerald-500/10 bg-emerald-500/5 text-emerald-600 dark:text-emerald-400',
    média: 'border border-amber-500/15 bg-amber-500/5 text-amber-600 dark:text-amber-400',
    alta: 'border border-orange-500/15 bg-orange-500/5 text-orange-600 dark:text-orange-400',
    crítica: 'border border-purple-500/20 bg-purple-500/5 text-purple-600 dark:text-purple-400',
};

const priorityLabels = {
    baixa: 'Baixa',
    média: 'Média',
    alta: 'Alta',
    crítica: 'Crítica',
};

const statusLabels = {
    aberto: 'Aberto',
    aberta: 'Aberta',
    'em curso': 'Em Curso',
    fechado: 'Fechado',
    fechada: 'Fechada',
};

function resolveStatusBadge(statusClean, statusName) {
    if (statusClean === 'em curso') {
        return '<span class="inline-block rounded-lg border border-emerald-500/20 bg-emerald-500/10 px-2 py-0.5 text-[11px] font-bold uppercase tracking-tight text-emerald-600 dark:text-emerald-400">⚙️ Em Curso</span>';
    }

    if (statusClean === 'fechada' || statusClean === 'fechado') {
        return '<span class="inline-block rounded-lg bg-[var(--text-soft)]/10 px-2 py-0.5 text-[11px] font-bold uppercase tracking-tight text-[var(--text-soft)]">Fechada</span>';
    }

    return `<span class="inline-block rounded-lg bg-blue-500/10 px-2 py-0.5 text-[11px] font-bold uppercase tracking-tight text-blue-600 dark:text-blue-400">${statusLabels[statusClean] ?? statusName ?? 'N/A'}</span>`;
}

export function renderTicketDetails(ticket) {
    const details = document.getElementById('ticketDetails');
    if (!details) return;

    const statusName = typeof ticket.status === 'object' && ticket.status !== null
        ? ticket.status.name
        : (typeof ticket.status === 'string' ? ticket.status : null);
    const statusClean = (statusName || '').toLowerCase();
    const priorityClass = priorityColors[ticket.priority] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]';
    const statusBadge = resolveStatusBadge(statusClean, statusName);

    details.innerHTML = `
        <div class="mb-5 border-b border-[var(--border)] pb-4">
            <div class="flex items-center justify-between gap-4">
                <span class="rounded-lg bg-[var(--surface-2)] px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)] font-mono">ID Ocorrência #${ticket.id}</span>
                <div class="flex gap-1.5">${statusBadge}</div>
            </div>
            <h2 class="mt-3 text-base font-bold text-[var(--text)]">${ticket.title}</h2>
        </div>

        <div class="space-y-5">
            <div>
                <span class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Descrição da Ocorrência</span>
                <div class="rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-3.5 text-xs leading-relaxed text-[var(--text)] whitespace-pre-wrap">${ticket.description || 'Nenhuma descrição providenciada.'}</div>
            </div>

            <div class="grid grid-cols-2 gap-x-4 gap-y-4 pt-2">
                <div>
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Nível de Prioridade</span>
                    <span class="mt-1 inline-block rounded-lg px-2 py-0.5 text-[11px] font-bold uppercase tracking-tight ${priorityClass}">${priorityLabels[ticket.priority] ?? ticket.priority}</span>
                </div>
                <div>
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Equipamento / Ativo</span>
                    <p class="mt-1 text-xs font-semibold text-[var(--text)]">${ticket.equipment ? ticket.equipment.name : '<span class="font-normal text-[var(--text-soft)]">—</span>'}</p>
                </div>
                <div>
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Sala / Localização</span>
                    <p class="mt-1 text-xs font-semibold text-[var(--text)]">${ticket.room ? ticket.room.name : '<span class="font-normal text-[var(--text-soft)]">—</span>'}</p>
                </div>
                <div>
                    <span class="block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Técnico Atribuído</span>
                    <p class="mt-1 text-xs font-semibold text-[var(--text)]">${ticket.technician ? ticket.technician.name : '<span class="font-normal italic text-rose-500">Pendente de atribuição</span>'}</p>
                </div>
            </div>
        </div>
    `;

    return {
        statusName,
        statusClean,
    };
}
