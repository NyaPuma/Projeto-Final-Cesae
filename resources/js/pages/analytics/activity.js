/**
 * Analytics Activity and Lists Renderer
 * Renders activity timeline and summary lists
 */

export function renderActivity(element, data) {
    if (!element) return;
    const activities = data.recent_activity || [];
    if (activities.length === 0) {
        element.innerHTML = `
            <div class="p-6 text-center text-xs text-soft">Sem atividade recente.</div>
        `;
        return;
    }
    element.innerHTML = activities.map(act => `
        <div class="flex items-start gap-5 p-6 hover:bg-[var(--surface-2)]/30 transition-colors duration-150">
            <div class="mt-1 flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                <span class="text-sm">📝</span>
            </div>
            <div class="flex-1">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <h3 class="font-semibold text-sm text-[var(--text)]">${act.title}</h3>
                    <span class="text-xs text-[var(--text-soft)]">${act.time}</span>
                </div>
                <p class="mt-1 text-xs text-[var(--text-soft)]">${act.description}</p>
            </div>
        </div>
    `).join("");
}

export function renderList(element, items) {
    if (!element) return;
    if (!items || items.length === 0) {
        element.innerHTML = `<div class="p-5 text-center text-xs text-[var(--text-soft)]">Sem dados disponíveis</div>`;
        return;
    }
    element.innerHTML = items.map((item, idx) => `
        <div class="flex items-center justify-between p-4 hover:bg-[var(--surface-2)]/30 transition-colors duration-150">
            <div class="flex items-center gap-3">
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-[var(--surface-2)] text-xs font-bold text-[var(--text-soft)]">${idx + 1}</span>
                <span class="text-xs font-semibold text-[var(--text)]">${item.name}</span>
            </div>
            <span class="text-xs font-bold text-primary">${item.total} <span class="font-medium text-[var(--text-soft)]">${item.subtitle || ''}</span></span>
        </div>
    `).join("");
}

export function renderSummary(elements, data) {
    renderList(elements.topEquipments, data.top_equipments);
    renderList(elements.topRooms, data.top_rooms);
    renderList(elements.topTechnicians, data.top_technicians);
}
