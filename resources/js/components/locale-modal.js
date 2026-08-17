/**
 * Locale Modal — controlador JS.
 *
 * Gere abertura/fecho, pesquisa de idiomas, pré-visualização Intl
 * e submissão do formulário de troca de locale.
 */

let modal, overlay, container, searchInput, previewEl, previewDefault;
let form, formInput;
let cards = [];
let sections = [];
let triggerEl = null;

/* ---------- helpers ---------- */

function getFocusable() {
    if (!container) return [];
    return [...container.querySelectorAll(
        'button:not([disabled]):not([hidden]), input:not([disabled]):not([hidden]), [tabindex]:not([tabindex="-1"])'
    )].filter(el => !el.closest('.locale-modal__card--hidden') && el.offsetParent !== null);
}

function debounce(fn, ms) {
    let t;
    return (...a) => { clearTimeout(t); t = setTimeout(() => fn(...a), ms); };
}

/* ---------- open / close ---------- */

function openModal(trigger) {
    if (!modal) return;
    triggerEl = trigger || document.activeElement;
    modal.removeAttribute('hidden');

    // Force reflow so the transition fires
    void modal.offsetHeight;

    modal.classList.add('locale-modal--open');
    modal.classList.remove('locale-modal--closing');
    document.body.style.overflow = 'hidden';

    // Focus the search input after transition
    setTimeout(() => {
        if (searchInput) searchInput.focus();
    }, 80);
}

function closeModal() {
    if (!modal || !modal.classList.contains('locale-modal--open')) return;

    modal.classList.add('locale-modal--closing');
    modal.classList.remove('locale-modal--open');

    setTimeout(() => {
        modal.setAttribute('hidden', '');
        modal.classList.remove('locale-modal--closing');
        document.body.style.overflow = '';

        // Restore focus
        if (triggerEl && typeof triggerEl.focus === 'function') {
            triggerEl.focus();
        }
    }, 260);
}

/* ---------- search ---------- */

function filterCards(query) {
    const q = (query || '').toLowerCase().trim();

    cards.forEach(card => {
        const searchData = card.getAttribute('data-search') || '';
        const match = !q || searchData.includes(q);
        card.classList.toggle('locale-modal__card--hidden', !match);
    });

    // Hide sections where all cards are hidden
    sections.forEach(section => {
        const sectionCards = section.querySelectorAll('.locale-modal__card');
        const anyVisible = [...sectionCards].some(c => !c.classList.contains('locale-modal__card--hidden'));
        section.classList.toggle('locale-modal__section--hidden', !anyVisible);
    });
}

const debouncedFilter = debounce(filterCards, 100);

/* ---------- preview ---------- */

function showPreview(locale, currency) {
    if (!previewEl) return;
    const now = new Date();

    try {
        const dateStr = new Intl.DateTimeFormat(locale, {
            day: '2-digit', month: '2-digit', year: 'numeric'
        }).format(now);

        const timeStr = new Intl.DateTimeFormat(locale, {
            hour: '2-digit', minute: '2-digit', second: '2-digit'
        }).format(now);

        const numberStr = new Intl.NumberFormat(locale).format(1234567.89);

        let currencyStr = '';
        try {
            currencyStr = new Intl.NumberFormat(locale, {
                style: 'currency', currency: currency || 'EUR'
            }).format(1234.56);
        } catch {
            currencyStr = '—';
        }

        previewEl.innerHTML = `
            <span class="locale-modal__preview-item">
                <span class="locale-modal__preview-label">📅</span>
                <span class="locale-modal__preview-value">${dateStr}</span>
            </span>
            <span class="locale-modal__preview-item">
                <span class="locale-modal__preview-label">🕐</span>
                <span class="locale-modal__preview-value">${timeStr}</span>
            </span>
            <span class="locale-modal__preview-item">
                <span class="locale-modal__preview-label">#</span>
                <span class="locale-modal__preview-value">${numberStr}</span>
            </span>
            <span class="locale-modal__preview-item">
                <span class="locale-modal__preview-label">💰</span>
                <span class="locale-modal__preview-value">${currencyStr}</span>
            </span>
        `;
    } catch {
        resetPreview();
    }
}

function resetPreview() {
    if (!previewEl || !previewDefault) return;
    previewEl.innerHTML = '';
    previewEl.appendChild(previewDefault.cloneNode(true));
}

/* ---------- selection ---------- */

async function selectLocale(card) {
    if (!form || !formInput) return;
    const locale = card.getAttribute('data-locale');
    if (!locale) return;

    // Loading state
    card.classList.add('locale-modal__card--loading');

    formInput.value = locale;

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const response = await fetch(form.action, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Accept': 'text/html',
                'X-Requested-With': 'XMLHttpRequest',
                ...(csrf ? { 'X-CSRF-TOKEN': csrf } : {}),
                'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
            },
            body: new URLSearchParams(new FormData(form)),
        });

        if (!response.ok) throw new Error('Locale request failed');
        window.location.assign(response.url || window.location.href);
    } catch {
        HTMLFormElement.prototype.submit.call(form);
    }
}

/* ---------- keyboard ---------- */

function handleKeydown(e) {
    if (!modal || !modal.classList.contains('locale-modal--open')) return;

    // Escape
    if (e.key === 'Escape') {
        e.preventDefault();
        closeModal();
        return;
    }

    // Focus trap
    if (e.key === 'Tab') {
        const focusable = getFocusable();
        if (!focusable.length) return;

        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (e.shiftKey && document.activeElement === first) {
            e.preventDefault();
            last.focus();
        } else if (!e.shiftKey && document.activeElement === last) {
            e.preventDefault();
            first.focus();
        }
        return;
    }

    // Arrow navigation between cards
    if (['ArrowDown', 'ArrowUp', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
        const active = document.activeElement;
        if (!active || !active.classList.contains('locale-modal__card')) return;

        e.preventDefault();
        const visibleCards = cards.filter(c => !c.classList.contains('locale-modal__card--hidden'));
        const idx = visibleCards.indexOf(active);
        if (idx === -1) return;

        let next;
        if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
            next = visibleCards[idx + 1] || visibleCards[0];
        } else {
            next = visibleCards[idx - 1] || visibleCards[visibleCards.length - 1];
        }
        if (next) next.focus();
    }

    // Enter on card = select
    if (e.key === 'Enter') {
        const active = document.activeElement;
        if (active && active.classList.contains('locale-modal__card')) {
            e.preventDefault();
            selectLocale(active);
        }
    }
}

/* ---------- init ---------- */

export function initLocaleModal() {
    modal = document.getElementById('localeModal');
    if (!modal) return;

    overlay = modal.querySelector('.locale-modal__overlay');
    container = modal.querySelector('.locale-modal__container');
    searchInput = document.getElementById('localeSearchInput');
    previewEl = document.getElementById('localePreview');
    previewDefault = document.getElementById('localePreviewDefault');
    form = document.getElementById('localeForm');
    formInput = document.getElementById('localeFormInput');
    cards = [...modal.querySelectorAll('.locale-modal__card')];
    sections = [...modal.querySelectorAll('.locale-modal__section')];

    // Save default preview content
    if (previewDefault) {
        previewDefault = previewDefault.cloneNode(true);
    }

    // Open triggers
    document.querySelectorAll('[data-action="open-locale-modal"]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            openModal(btn);
        });
    });

    // Close triggers
    modal.querySelectorAll('[data-locale-modal-close]').forEach(el => {
        el.addEventListener('click', closeModal);
    });

    // Search
    if (searchInput) {
        searchInput.addEventListener('input', () => {
            debouncedFilter(searchInput.value);
        });
    }

    // Card hover → preview
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            const locale = card.getAttribute('data-locale');
            const currency = card.getAttribute('data-currency');
            showPreview(locale, currency);
        });

        card.addEventListener('focus', () => {
            const locale = card.getAttribute('data-locale');
            const currency = card.getAttribute('data-currency');
            showPreview(locale, currency);
        });

        card.addEventListener('click', () => selectLocale(card));
    });

    // Reset preview on mouse leave from body
    const body = modal.querySelector('.locale-modal__body');
    if (body) {
        body.addEventListener('mouseleave', resetPreview);
    }

    // Keyboard
    document.addEventListener('keydown', handleKeydown);
}
