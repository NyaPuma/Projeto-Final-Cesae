import { getPriorityCards, getPriorityInput } from './dom.js';

const priorityBorders = {
    baixa: 'border-emerald-500',
    media: 'border-amber-500',
    alta: 'border-red-500',
    critica: 'border-purple-600',
};

export function selectPriority(priority) {
    const input = getPriorityInput();
    if (input) input.value = priority;

    getPriorityCards().forEach((card) => {
        const cardPriority = card.getAttribute('data-priority');

        card.classList.remove('border-2', 'border-emerald-500', 'border-amber-500', 'border-red-500', 'border-purple-600', 'shadow-sm');
        card.classList.add('border', 'border-(--border)');

        if (cardPriority !== priority) return;

        card.classList.remove('border', 'border-(--border)');
        card.classList.add('border-2', 'shadow-sm');

        const activeBorder = priorityBorders[priority];
        if (activeBorder) card.classList.add(activeBorder);
    });
}

export function bindPrioritySelection() {
    document.addEventListener('click', (event) => {
        const card = event.target.closest('.priority-card');
        if (!card) return;

        const priority = card.getAttribute('data-priority');
        if (priority) selectPriority(priority);
    });
}
