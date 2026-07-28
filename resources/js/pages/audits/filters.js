import { clearAuditFilters, getAuditFilters } from './dom.js';

function matchesAudit(audit, filters) {
    const searchPool = [
        audit.id,
        audit.user?.name,
        audit.user,
        audit.username,
        audit.operator,
        audit.auditable_type,
        audit.entity,
        audit.auditable_id,
        audit.reference,
    ].map((value) => String(value || '').toLowerCase());

    const matchesSearch = !filters.q || searchPool.some((value) => value.includes(filters.q));
    const matchesEvent = !filters.event || String(audit.event || '').toLowerCase() === filters.event;

    return matchesSearch && matchesEvent;
}

export function filterAudits(audits) {
    const filters = getAuditFilters();
    return audits.filter((audit) => matchesAudit(audit, filters));
}

export function resetAuditFilters() {
    clearAuditFilters();
}
