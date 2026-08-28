/**
 * Localization Modal — JS controller.
 *
 * Manages open/close, tabs, search, and auto-save
 * of localization preferences.
 */

let modal, overlay, container;
let tabs = [];
let panels = [];
let cards = [];
let activeTab = null;
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

function openModal(tabKey, trigger) {
    if (!modal) return;
    triggerEl = trigger || document.activeElement;

    if (tabKey && tabs.length) {
        switchTab(tabKey);
    }

    modal.removeAttribute('hidden');
    void modal.offsetHeight;
    modal.classList.add('locale-modal--open');
    modal.classList.remove('locale-modal--closing');
    document.body.style.overflow = 'hidden';

    setTimeout(() => {
        const firstInput = container.querySelector('.locale-modal__search-input, .localization-modal__tab--active');
        if (firstInput) firstInput.focus();
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

        if (triggerEl && typeof triggerEl.focus === 'function') {
            triggerEl.focus();
        }
    }, 260);
}

/* ---------- tabs ---------- */

function switchTab(key) {
    if (activeTab === key) return;
    activeTab = key;

    tabs.forEach(tab => {
        const isTarget = tab.getAttribute('data-tab') === key;
        tab.classList.toggle('localization-modal__tab--active', isTarget);
        tab.setAttribute('aria-selected', isTarget ? 'true' : 'false');
    });

    panels.forEach(panel => {
        const isTarget = panel.getAttribute('data-tab-panel') === key;
        panel.classList.toggle('localization-modal__tab-panel--active', isTarget);
        panel.toggleAttribute('hidden', !isTarget);
    });
}

/* ---------- search ---------- */

function filterCards(query) {
    const q = (query || '').toLowerCase().trim();

    cards.forEach(card => {
        const searchData = card.getAttribute('data-search') || '';
        const match = !q || searchData.includes(q);
        card.classList.toggle('locale-modal__card--hidden', !match);
    });
}

const debouncedFilter = debounce(filterCards, 100);

/* ---------- save ---------- */

async function savePreference(url, data) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify(data),
    });

    if (!response.ok) {
        throw new Error('Preference update failed');
    }

    return response.json();
}

/* ---------- selection ---------- */

async function selectLanguage(card) {
    const locale = card.getAttribute('data-locale');
    if (!locale) return;

    card.classList.add('locale-modal__card--loading');

    try {
        await savePreference(modal.dataset.updateLanguageUrl, { language: locale });
        location.reload();
    } catch (err) {
        console.error('[LocalizationModal] Failed to save language:', err);
        card.classList.remove('locale-modal__card--loading');
    }
}

async function selectCurrency(card) {
    const currency = card.getAttribute('data-currency');
    if (!currency) return;

    card.classList.add('locale-modal__card--loading');

    try {
        await savePreference(modal.dataset.updateCurrencyUrl, { currency });
        location.reload();
    } catch {
        card.classList.remove('locale-modal__card--loading');
    }
}

async function selectDateFormat(card) {
    const format = card.getAttribute('data-date-format');
    if (!format) return;

    card.classList.add('locale-modal__card--loading');

    try {
        await savePreference(modal.dataset.updateDateFormatUrl, { date_format: format });
        location.reload();
    } catch {
        card.classList.remove('locale-modal__card--loading');
    }
}

async function selectTimeFormat(card) {
    const format = card.getAttribute('data-time-format');
    if (!format) return;

    card.classList.add('locale-modal__card--loading');

    try {
        await savePreference(modal.dataset.updateTimeFormatUrl, { time_format: format });
        location.reload();
    } catch {
        card.classList.remove('locale-modal__card--loading');
    }
}

async function selectNumberFormat(card) {
    const encoded = card.getAttribute('data-number-format-encoded');
    if (!encoded) return;

    card.classList.add('locale-modal__card--loading');

    try {
        await savePreference(modal.dataset.updateNumberFormatUrl, { number_format: encoded });
        location.reload();
    } catch {
        card.classList.remove('locale-modal__card--loading');
    }
}

/* ---------- keyboard ---------- */

function handleKeydown(e) {
    if (!modal || !modal.classList.contains('locale-modal--open')) return;

    if (e.key === 'Escape') {
        e.preventDefault();
        closeModal();
        return;
    }

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
}

/* ---------- init ---------- */

export function initLocalizationModal() {
    modal = document.getElementById('localizationModal');
    if (!modal) return;
    overlay = modal.querySelector('.locale-modal__overlay');
    container = modal.querySelector('.locale-modal__container');
    tabs = [...modal.querySelectorAll('.localization-modal__tab')];
    panels = [...modal.querySelectorAll('.localization-modal__tab-panel')];
    cards = [...modal.querySelectorAll('.locale-modal__card')];
    activeTab = tabs[0]?.getAttribute('data-tab') || null;

    // Close triggers
    modal.querySelectorAll('[data-close-modal]').forEach(el => {
        el.addEventListener('click', closeModal);
    });

    // Tab clicks
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            switchTab(tab.getAttribute('data-tab'));
        });
    });

    // Card selections
    cards.forEach(card => {
        card.addEventListener('click', () => {
            if (card.hasAttribute('data-locale')) {
                selectLanguage(card);
            } else if (card.hasAttribute('data-currency')) {
                selectCurrency(card);
            } else if (card.hasAttribute('data-date-format')) {
                selectDateFormat(card);
            } else if (card.hasAttribute('data-time-format')) {
                selectTimeFormat(card);
            } else if (card.hasAttribute('data-number-format')) {
                selectNumberFormat(card);
            }
        });
    });

    // Open triggers
    document.querySelectorAll('[data-action="open-locale-modal"]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            openModal(btn.dataset.tab || null, btn);
        });
    });

    console.log('[LocalizationModal] Initialized', { cards: cards.length, tabs: tabs.length });

    // Keyboard
    document.addEventListener('keydown', handleKeydown);
}

window.openLocalizationModal = openModal;
