export const state = {
    ticketId: null,
    budgetItemCounter: 0,
    pendingTicketId: null,
    pendingActionType: 'start',
    forceStartData: null,
};

export function setTicketId(ticketId) {
    state.ticketId = ticketId;
}

export function nextBudgetItemIndex() {
    return state.budgetItemCounter++;
}

export function setPendingAction({ ticketId, actionType = 'start', forceStartData = null }) {
    state.pendingTicketId = ticketId;
    state.pendingActionType = actionType;
    state.forceStartData = forceStartData;
}

export function resetPendingAction() {
    state.pendingTicketId = null;
    state.pendingActionType = 'start';
    state.forceStartData = null;
}
