/**
 * Locale Modal — JS controller.
 *
 * Manages open/close, language search, Intl preview,
 * and locale switch form submission.
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
                <span class="locale-modal__preview-label"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg></span>
                <span class="locale-modal__preview-value">${dateStr}</span>
            </span>
            <span class="locale-modal__preview-item">
                <span class="locale-modal__preview-label"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></span>
                <span class="locale-modal__preview-value">${timeStr}</span>
            </span>
            <span class="locale-modal__preview-item">
                <span class="locale-modal__preview-label">#</span>
                <span class="locale-modal__preview-value">${numberStr}</span>
            </span>
            <span class="locale-modal__preview-item">
                <span class="locale-modal__preview-label"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg></span>
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
