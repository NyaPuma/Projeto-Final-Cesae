/**
 * Theme Management Module
 * Gestão de temas emparelhados por família de cor (14 claros + 14 escuros).
 *
 * O modo claro/escuro autoritativo vem do tema guardado no servidor
 * (meta `theme-mode`). Em contas admin, o botão do painel troca para o
 * equivalente da mesma família (ex.: laranja claro <-> laranja escuro) e
 * guarda-o automaticamente em theme_settings. Em contas não-admin a
 * alternância é local (CSS + localStorage).
 */

const THEME_COLOR_KEYS = {
    primary: '--color-primary',
    text: '--color-text',
    text_soft: '--color-text-soft',
    surface: '--color-surface',
    surface_alt: '--color-surface-alt',
    border: '--color-border',
    ticket_open: '--color-ticket-open',
    ticket_in_progress: '--color-ticket-in-progress',
    ticket_resolved: '--color-ticket-resolved',
    ticket_urgent: '--color-ticket-urgent',
};

function getMeta(name) {
    const el = document.querySelector(`meta[name="${name}"]`);
    return el ? el.getAttribute('content') : null;
}

function setMeta(name, value) {
    const el = document.querySelector(`meta[name="${name}"]`);
    if (el) {
        el.setAttribute('content', value);
    }
}

function metaMode() {
    return getMeta('theme-mode') || 'light';
}

function isAdmin() {
    return getMeta('user-role') === 'admin';
}

/**
 * Modo inicial: o servidor manda (meta theme-mode). Para admins, uma
 * preferência antiga no localStorage que contradiga o servidor é limpa.
 * @returns {boolean}
 */
export function isDarkModeDefault() {
    const serverMode = metaMode();
    const saved = localStorage.getItem('theme');

    if (isAdmin() && saved && saved !== serverMode) {
        localStorage.removeItem('theme');
        return serverMode === 'dark';
    }

    return saved ? saved === 'dark' : serverMode === 'dark';
}

/**
 * Initialize theme based on the server theme mode (or localStorage p/ não-admin)
 */
export function initTheme() {
    const isDark = isDarkModeDefault();

    if (isDark) {
        document.documentElement.classList.add('dark');
        document.documentElement.setAttribute('data-theme', 'dark');
    } else {
        document.documentElement.classList.remove('dark');
        document.documentElement.removeAttribute('data-theme');
    }
}

/**
 * Lista de presets (28: 14 claros + 14 escuros) partilhada com a página
 * de definições. Usa o JSON embebido no layout, cacheado em window.
 */
export function getThemePresets() {
    if (Array.isArray(window.uiThemePresets)) {
        return window.uiThemePresets;
    }

    const dataEl = document.getElementById('themePresetsData');
    if (dataEl) {
        try {
            const object = JSON.parse(dataEl.textContent);
            const list = Object.entries(object).map(([id, preset]) => ({ ...preset, id }));
            window.uiThemePresets = list;
            return list;
        } catch (e) {
            // presets inválidos — segue sem dados
        }
    }

    return [];
}

function normalizeColor(value) {
    if (!value) {
        return '#000000';
    }

    if (value.startsWith('#')) {
        return value;
    }

    return `#${value.replace(/[^0-9a-f]/gi, '').slice(0, 6)}`;
}

function hexToRgb(hex) {
    const intVal = parseInt(normalizeColor(hex).replace('#', ''), 16);
    return {
        r: (intVal >> 16) & 255,
        g: (intVal >> 8) & 255,
        b: intVal & 255,
    };
}

function sRGBtoLinear(value) {
    const channel = value / 255;
    return channel <= 0.03928 ? channel / 12.92 : Math.pow((channel + 0.055) / 1.055, 2.4);
}

function luminance(hex) {
    const rgb = /^#?([a-f0-9]{6})$/i.exec(normalizeColor(hex));
    if (!rgb) {
        return 0;
    }

    const intVal = parseInt(rgb[1], 16);
    const r = sRGBtoLinear((intVal >> 16) & 255);
    const g = sRGBtoLinear((intVal >> 8) & 255);
    const b = sRGBtoLinear(intVal & 255);

    return 0.2126 * r + 0.7152 * g + 0.0722 * b;
}

function readableOnColor(hex) {
    const lum = luminance(hex);
    const black = (lum + 0.05) / 0.05;
    const white = 1.05 / (lum + 0.05);
    return white >= black ? '#ffffff' : '#000000';
}

function darkenHex(hex, amount = 0.12) {
    const { r, g, b } = hexToRgb(hex);
    const to2 = (v) => Math.max(0, Math.min(255, Math.round(v * (1 - amount)))).toString(16).padStart(2, '0');
    return `#${to2(r)}${to2(g)}${to2(b)}`;
}

/**
 * Aplica um preset às variáveis CSS (mesmo resultado que o /theme/custom.css).
 */
export function applyThemePreset(preset) {
    const root = document.documentElement;

    Object.entries(THEME_COLOR_KEYS).forEach(([key, token]) => {
        if (preset[key]) {
            root.style.setProperty(token, preset[key]);
        }
    });

    if (preset.primary) {
        const { r, g, b } = hexToRgb(preset.primary);
        root.style.setProperty('--color-primary-light', `rgba(${r}, ${g}, ${b}, 0.12)`);
        root.style.setProperty('--color-primary-hover', darkenHex(preset.primary));
        root.style.setProperty('--color-on-primary', readableOnColor(preset.primary));
    }
}

/**
 * Identifica o preset ativo. Para admins, o servidor (meta active-theme) manda
 * e reconcilia uma preferência local divergente; para não-admins manda o
 * localStorage. Em último caso reconhece pelos valores CSS aplicados.
 */
function findActivePreset(presets) {
    const metaActive = getMeta('active-theme');
    const localName = localStorage.getItem('theme_name');

    if (isAdmin()) {
        if (metaActive && localName && localName !== metaActive) {
            localStorage.setItem('theme_name', metaActive);
            const serverPreset = presets.find((p) => p.id === metaActive);
            if (serverPreset) {
                return serverPreset;
            }
        }

        const candidates = metaActive ? [metaActive, localName] : [localName];
        for (const id of candidates) {
            const found = presets.find((p) => p.id === id);
            if (found) {
                return found;
            }
        }
    } else {
        const candidates = [localName, metaActive];
        for (const id of candidates) {
            const found = presets.find((p) => p.id === id);
            if (found) {
                return found;
            }
        }
    }

    const computed = getComputedStyle(document.documentElement);
    const current = {};
    Object.values(THEME_COLOR_KEYS).forEach((token) => {
        current[token] = computed.getPropertyValue(token).trim().toLowerCase();
    });

    const matched = presets.find((preset) =>
        Object.values(THEME_COLOR_KEYS).every((token, index) => {
            const key = Object.keys(THEME_COLOR_KEYS)[index];
            const expected = preset[key];
            return !expected || current[token] === expected.toLowerCase();
        })
    );

    return matched || null;
}

function setThemeMode(isDark) {
    const root = document.documentElement;

    if (isDark) {
        root.classList.add('dark');
        root.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    } else {
        root.classList.remove('dark');
        root.removeAttribute('data-theme');
        localStorage.setItem('theme', 'light');
    }
}

function persistThemeSwitch(themeId) {
    if (!isAdmin()) {
        return;
    }

    const csrf = getMeta('csrf-token');

    fetch('/theme/switch', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
            'X-CSRF-TOKEN': csrf || '',
        },
        body: JSON.stringify({ theme: themeId }),
    }).catch(() => {
        // falha silenciosa: a alteração local mantém-se até ao próximo carregamento
    });
}

/**
 * Alterna para o equivalente claro/escuro da mesma família e guarda (admin).
 * @returns {boolean} Estado dark após a alternância (síncrono)
 */
export function toggleTheme() {
    const presets = getThemePresets();
    const active = findActivePreset(presets);
    const currentMode = active ? active.mode : (isDarkModeDefault() ? 'dark' : 'light');
    const targetMode = currentMode === 'dark' ? 'light' : 'dark';

    let target = null;

    if (active) {
        target = presets.find((p) => p.family === active.family && p.mode === targetMode) || null;
    }

    if (!target) {
        target = presets.find((p) => p.mode === targetMode) || null;
    }

    if (target) {
        applyThemePreset(target);
        localStorage.setItem('theme_name', target.id);
        setMeta('active-theme', target.id);
    }

    const isDark = targetMode === 'dark';
    setThemeMode(isDark);
    setMeta('theme-mode', targetMode);

    if (target) {
        persistThemeSwitch(target.id);
    }

    return isDark;
}

/**
 * Set theme explicitly
 * @param {'light'|'dark'} theme - Theme to set
 */
export function setTheme(theme) {
    setThemeMode(theme === 'dark');
}
