import { nextBudgetItemIndex } from './state.js';
import { formatCurrency } from '../../utils/locale.js';

export function recalcBudgetTotal() {
    let total = 0;

    document.querySelectorAll('.budget-item').forEach((item) => {
        const quantity = parseFloat(item.querySelector('.item-qty')?.value) || 0;
        const price = parseFloat(item.querySelector('.item-price')?.value) || 0;
        const subtotal = quantity * price;

        const subtotalElement = item.querySelector('.item-subtotal');
        if (subtotalElement) subtotalElement.textContent = formatCurrency(subtotal);

        total += subtotal;
    });

    const totalDisplay = document.getElementById('techTotalEstimatedDisplay');
    const totalInput = document.getElementById('techEstimatedCostInput');

    if (totalDisplay) totalDisplay.textContent = formatCurrency(total);
    if (totalInput) totalInput.value = total.toFixed(2);

    return total;
}

export function addBudgetItem(description = '', quantity = 1, price = 0, type = 'material') {
    const container = document.getElementById('budgetItemsContainer');
    if (!container) return;

    const index = nextBudgetItemIndex();
    const pricePlaceholder = type === 'labor' ? '€/Hora' : 'P. Unit';
    const item = document.createElement('div');

    item.className = 'budget-item grid grid-cols-[auto_1fr_80px_80px_60px_30px] items-center gap-2';
    item.dataset.index = index;
    item.innerHTML = `
        <select class="item-type rounded-lg border border-(--border) bg-(--surface-2) px-1.5 py-1.5 text-[10px] font-bold uppercase tracking-wider text-(--text) outline-none transition-all focus:border-(--text) cursor-pointer">
            <option value="material" ${type === 'material' ? 'selected' : ''}>🔩 Materiais</option>
            <option value="labor" ${type === 'labor' ? 'selected' : ''}>👷 Mão de Obra</option>
        </select>
        <input type="text" class="item-desc rounded-lg border border-(--border) bg-(--surface-2) px-2.5 py-1.5 text-[11px] text-(--text) outline-none transition-all focus:border-(--text)" placeholder="Descrição" value="${description}">
        <input type="number" class="item-qty rounded-lg border border-(--border) bg-(--surface-2) px-2.5 py-1.5 text-[11px] font-mono text-(--text) outline-none transition-all focus:border-(--text)" placeholder="Qtd/H" min="1" value="${quantity}">
        <input type="number" step="0.01" class="item-price rounded-lg border border-(--border) bg-(--surface-2) px-2.5 py-1.5 text-[11px] font-mono text-(--text) outline-none transition-all focus:border-(--text)" placeholder="${pricePlaceholder}" min="0" value="${price}">
        <span class="item-subtotal pt-2 text-right text-[11px] font-bold font-mono text-(--text)">${formatCurrency(quantity * price)}</span>
        <button type="button" data-action="remove-budget-item" class="btn-remove-item p-1 text-rose-400 transition-all hover:text-rose-500 cursor-pointer" title="Remover item">
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    `;

    container.appendChild(item);
    recalcBudgetTotal();
}

export function getBudgetDetails() {
    const items = [];

    document.querySelectorAll('.budget-item').forEach((item) => {
        const type = item.querySelector('.item-type')?.value || 'material';
        const description = item.querySelector('.item-desc')?.value.trim();
        const quantity = parseFloat(item.querySelector('.item-qty')?.value) || 0;
        const unitPrice = parseFloat(item.querySelector('.item-price')?.value) || 0;

        if (!description) return;

        if (type === 'labor') {
            items.push({
                type: 'labor',
                description,
                hours: quantity,
                hourly_rate: unitPrice,
            });
            return;
        }

        items.push({
            type: 'material',
            description,
            quantity,
            unit_price: unitPrice,
        });
    });

    return items;
}

export function renderBudgetDetailsForAdmin(details) {
    const container = document.getElementById('budgetDetailsContainer');
    const list = document.getElementById('budgetDetailsList');
    const total = document.getElementById('budgetDetailsTotal');

    if (!container || !list) return;

    if (!details || !Array.isArray(details) || details.length === 0) {
        container.classList.add('hidden');
        return;
    }

    container.classList.remove('hidden');

    let totalAmount = 0;
    let materialTotal = 0;
    let laborTotal = 0;

    list.innerHTML = details.map((item, index) => {
        const type = item.type || 'material';
        let subtotal = 0;
        let detail = '';

        if (type === 'labor') {
            const hours = item.hours || 0;
            const rate = item.hourly_rate || 0;
            subtotal = hours * rate;
            laborTotal += subtotal;
            detail = `${hours}h × ${formatCurrency(rate)}/h`;
        } else {
            const quantity = item.quantity || 0;
            const unitPrice = item.unit_price || 0;
            subtotal = quantity * unitPrice;
            materialTotal += subtotal;
            detail = `${quantity} × ${formatCurrency(unitPrice)}`;
        }

        totalAmount += subtotal;

        const icon = type === 'labor' ? '👷' : '🔩';

        return `
            <div class="flex items-center justify-between py-1 text-[11px] ${index > 0 ? 'border-t border-(--border)/50' : ''}">
                <span class="mr-2 flex-1 truncate text-(--text)">${icon} ${item.description || 'Item'}</span>
                <span class="mx-2 whitespace-nowrap text-[10px] text-(--text-soft)">${detail}</span>
                <span class="whitespace-nowrap font-bold font-mono text-(--text)">${formatCurrency(subtotal)}</span>
            </div>
        `;
    }).join('');

    if (materialTotal > 0 || laborTotal > 0) {
        list.innerHTML += `
            <div class="mt-2 space-y-1 border-t-2 border-(--border) pt-2">
                ${materialTotal > 0 ? `<div class="flex items-center justify-between text-[10px]"><span class="font-medium text-(--text-soft)">🔩 Total Materiais</span><span class="font-bold font-mono text-(--text)">${formatCurrency(materialTotal)}</span></div>` : ''}
                ${laborTotal > 0 ? `<div class="flex items-center justify-between text-[10px]"><span class="font-medium text-(--text-soft)">👷 Total Mão de Obra</span><span class="font-bold font-mono text-(--text)">${formatCurrency(laborTotal)}</span></div>` : ''}
            </div>
        `;
    }

    if (total) total.textContent = formatCurrency(totalAmount);
}
