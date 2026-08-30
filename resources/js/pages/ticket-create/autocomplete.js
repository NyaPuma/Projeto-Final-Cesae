import { authHeader } from '../../utils/api.js';

let allEquipments = [];

const FALLBACK_EQUIPMENTS = [
    { id: 1, name: "Torno CNC KUKA KR210", serial: "SN-KUKA-096", room: { name: "Sala 096" } },
    { id: 2, name: "Empilhador Elétrico Toyota", serial: "SN-TOY-881", room: { name: "Armazém Sul" } },
    { id: 3, name: "Sistema de Climatização / AC", serial: "AC-IND-045", room: { name: "Sala 045" } },
    { id: 4, name: "Compressor de Ar Industrial", serial: "CMP-9002", room: { name: "Oficina B" } },
    { id: 5, name: "Impressora Industrial HP", serial: "HP-3D-90", room: { name: "Escritório Central" } },
];

async function fetchEquipments() {
    const endpoints = ['/admin/equipment', '/equipments', '/api/equipments'];
    for (const url of endpoints) {
        try {
            const res = await fetch(url, { headers: authHeader() });
            if (!res.ok) continue;
            const data = await res.json();
            const list = data.equipments?.data || data.equipments || data || [];
            if (list.length > 0) return list;
        } catch (e) {}
    }
    return [];
}

function renderSuggestions(matches, suggestionsBox, searchInput, hiddenIdInput) {
    if (matches.length === 0) {
        suggestionsBox.innerHTML = '<div class="p-3 text-xs text-[var(--text-soft)] italic">' + (window.SGM_TICKET_DETAIL_I18N?.noEquipmentFound || 'No equipment found.') + '</div>';
        suggestionsBox.classList.remove('hidden');
        return;
    }

    suggestionsBox.innerHTML = matches
        .map(
            (eq) => `
                <div class="equipment-option p-3 hover:bg-[var(--surface-2)] transition cursor-pointer text-xs flex justify-between items-center"
                     data-id="${eq.id}" data-name="${eq.name}">
                    <div>
                        <span class="font-bold text-[var(--text)] block">${eq.name}</span>
                        <span class="text-xs text-[var(--text-soft)]">${eq.serial ? ' • ' + eq.serial : ''}${eq.room?.name ? ' • ' + eq.room.name : ''}</span>
                    </div>
                    <span class="text-xs font-mono font-bold text-primary">#${eq.id}</span>
                </div>
            `
        )
        .join('');

    suggestionsBox.classList.remove('hidden');
}

function onInput(searchInput, suggestionsBox, hiddenIdInput) {
    const query = searchInput.value.trim().toLowerCase();
    hiddenIdInput.value = '';

    if (query.length === 0) {
        suggestionsBox.classList.add('hidden');
        return;
    }

    const matches = allEquipments.filter((eq) => {
        const nameMatch = (eq.name || '').toLowerCase().includes(query);
        const serialMatch = (eq.serial || '').toLowerCase().includes(query);
        const roomMatch = (eq.room?.name || '').toLowerCase().includes(query);
        return nameMatch || serialMatch || roomMatch;
    });

    renderSuggestions(matches, suggestionsBox, searchInput, hiddenIdInput);
}

function onSuggestionClick(event, suggestionsBox, searchInput, hiddenIdInput) {
    const option = event.target.closest('.equipment-option');
    if (!option) return;

    hiddenIdInput.value = option.getAttribute('data-id');
    searchInput.value = option.getAttribute('data-name');
    suggestionsBox.classList.add('hidden');
}

function onOutsideClick(event, searchInput, suggestionsBox) {
    if (!searchInput.contains(event.target) && !suggestionsBox.contains(event.target)) {
        suggestionsBox.classList.add('hidden');
    }
}

export async function initAutocomplete() {
    const searchInput = document.getElementById('equipmentSearchInput');
    const suggestionsBox = document.getElementById('equipmentSuggestions');
    const hiddenIdInput = document.getElementById('selectedEquipmentId');

    if (!searchInput || !suggestionsBox || !hiddenIdInput) return;

    allEquipments = await fetchEquipments();
    if (allEquipments.length === 0) {
        allEquipments = FALLBACK_EQUIPMENTS;
    }

    searchInput.addEventListener('input', () => onInput(searchInput, suggestionsBox, hiddenIdInput));
    suggestionsBox.addEventListener('click', (e) => onSuggestionClick(e, suggestionsBox, searchInput, hiddenIdInput));
    document.addEventListener('click', (e) => onOutsideClick(e, searchInput, suggestionsBox));
}
