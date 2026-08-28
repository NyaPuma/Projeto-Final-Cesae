import { getPriorityCards, getPriorityInput } from './dom.js';

const priorityBorders = {
    baixa: 'border-success',
    média: 'border-warning',
    media: 'border-warning',
    alta: 'border-danger',
    crítica: 'border-purple-600',
    critica: 'border-purple-600',
};

export function selectPriority(priority) {
    const input = getPriorityInput();
    if (input) input.value = priority;

    getPriorityCards().forEach((card) => {
        const cardPriority = card.getAttribute('data-priority');

        card.classList.remove('border-2', 'border-emerald-500', 'border-amber-500', 'border-red-500', 'border-success', 'border-warning', 'border-danger', 'border-orange-500', 'border-rose-500', 'shadow-sm');
        card.classList.add('border', 'border-[var(--border)]');
        card.setAttribute('aria-checked', 'false');

        if (cardPriority !== priority) return;

        card.classList.remove('border', 'border-[var(--border)]');
        card.classList.add('border-2', 'shadow-sm');
        card.setAttribute('aria-checked', 'true');

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

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Enter' && event.key !== ' ') return;
        const card = event.target.closest('.priority-card');
        if (!card) return;

        event.preventDefault();
        const priority = card.getAttribute('data-priority');
        if (priority) selectPriority(priority);
    });
}
