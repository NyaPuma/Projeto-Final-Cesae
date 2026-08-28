function normalizeColor(value) {
    if (!value) {
        return '#000000';
    }

    if (value.startsWith('#')) {
        return value;
    }

    return `#${value.replace(/[^0-9a-f]/gi, '').slice(0, 6)}`;
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

function contrastRatio(hexA, hexB) {
    const lumA = luminance(hexA);
    const lumB = luminance(hexB);
    const lighter = Math.max(lumA, lumB);
    const darker = Math.min(lumA, lumB);
    return (lighter + 0.05) / (darker + 0.05);
}

function hexToRgb(hex) {
    const intVal = parseInt(normalizeColor(hex).replace('#', ''), 16);
    return {
        r: (intVal >> 16) & 255,
        g: (intVal >> 8) & 255,
        b: intVal & 255,
    };
}

function rgbToHex({ r, g, b }) {
    const to2 = (v) => Math.max(0, Math.min(255, Math.round(v))).toString(16).padStart(2, '0');
    return `#${to2(r)}${to2(g)}${to2(b)}`;
}

function mixToward(hex, target, amount) {
    const a = hexToRgb(hex);
    const b = hexToRgb(target);
    return rgbToHex({
        r: a.r + (b.r - a.r) * amount,
        g: a.g + (b.g - a.g) * amount,
        b: a.b + (b.b - a.b) * amount,
    });
}

/**
 * Pure black or white — at least one always guarantees contrast >= 4.5:1
 * against any background color (checks which produces the highest ratio).
 */
function readableOnColor(hex) {
    const lum = luminance(hex);
    const black = (lum + 0.05) / 0.05;
    const white = 1.05 / (lum + 0.05);
    return white >= black ? '#ffffff' : '#000000';
}

/**
 * Automatically adjusts the color (darkening or lightening to the black/white
 * that best guarantees contrast) until it meets the minimum ratio against the background.
 */
function ensureContrast(hex, background, minRatio) {
    let current = normalizeColor(hex);
    const endpoint = readableOnColor(background);
    let guard = 0;

    while (contrastRatio(current, background) < minRatio && guard < 40) {
        current = mixToward(current, endpoint, 0.12);
        guard++;
    }

    return current;
}

function rgbaFromHex(hex, alpha) {
    const { r, g, b } = hexToRgb(hex);
    return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}

function applyVariable(input, value) {
    const variable = input.dataset.themeVar;
    input.value = value;
    document.documentElement.style.setProperty(variable, value);
}

/**
 * Automatically ensures minimum contrast:
 *  - text and soft text >= 4.5:1 against surface;
 *  - primary color >= 3:1 against surface (non-text highlights);
 *  - button text (black/white) >= 4.5:1 against primary.
 * Never blocks save — adjusts the missing colors.
 */
function enforceContrastCompliance() {
    const inputs = {
        primary: document.querySelector('[data-theme-var="--color-primary"]'),
        surface: document.querySelector('[data-theme-var="--color-surface"]'),
        text: document.querySelector('[data-theme-var="--color-text"]'),
        textSoft: document.querySelector('[data-theme-var="--color-text-soft"]'),
    };

    if (!inputs.primary || !inputs.surface || !inputs.text) {
        return;
    }

    const surface = normalizeColor(inputs.surface.value);

    const correctedPrimary = ensureContrast(inputs.primary.value, surface, 3);
    const correctedText = ensureContrast(inputs.text.value, surface, 4.5);
    const correctedTextSoft = inputs.textSoft
        ? ensureContrast(inputs.textSoft.value, surface, 4.5)
        : null;

    const primaryChanged = correctedPrimary.toLowerCase() !== normalizeColor(inputs.primary.value).toLowerCase();
    const textChanged = correctedText.toLowerCase() !== normalizeColor(inputs.text.value).toLowerCase();
    const softChanged = correctedTextSoft !== null
        && correctedTextSoft.toLowerCase() !== normalizeColor(inputs.textSoft.value).toLowerCase();

    applyVariable(inputs.primary, correctedPrimary);
    applyVariable(inputs.text, correctedText);
    if (correctedTextSoft !== null) {
        applyVariable(inputs.textSoft, correctedTextSoft);
    }

    document.documentElement.style.setProperty('--color-primary-light', rgbaFromHex(correctedPrimary, 0.12));
    document.documentElement.style.setProperty('--color-on-primary', readableOnColor(correctedPrimary));

    const message = document.getElementById('themeMessage');
    if (message && (primaryChanged || textChanged || softChanged)) {
        message.textContent = 'Algumas cores foram ajustadas automaticamente para garantir o contraste mínimo.';
        message.className = 'theme-settings__notice';
    }
}

function loadPresets() {
    const dataEl = document.getElementById('themePresetsData');
    if (!dataEl) {
        return null;
    }

    try {
        const presetsObj = JSON.parse(dataEl.textContent);
        return Object.entries(presetsObj).map(([id, preset]) => ({ ...preset, id }));
    } catch (e) {
        return null;
    }
}

function applyPreset(preset) {
    document.querySelectorAll('[data-theme-var]').forEach((input) => {
        const value = preset[input.name];
        if (!value) {
            return;
        }
        applyVariable(input, value);
    });

    enforceContrastCompliance();
    applyThemeMode(preset.mode === 'dark');
    markActivePreset();
}

function applyThemeMode(isDark) {
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

function markActivePreset() {
    const presets = window.uiThemePresets;
    if (!Array.isArray(presets)) {
        return;
    }

    const current = {};
    document.querySelectorAll('[data-theme-var]').forEach((input) => {
        current[input.name] = normalizeColor(input.value).toLowerCase();
    });

    document.querySelectorAll('[data-preset]').forEach((card) => {
        const preset = presets.find((p) => p.id === card.dataset.preset);
        const matches = preset && Object.entries(current).every(([name, value]) => {
            const expected = preset[name];
            return !expected || value === expected.toLowerCase();
        });

        card.classList.toggle('is-active', Boolean(matches));
        card.setAttribute('aria-pressed', matches ? 'true' : 'false');
    });
}

/* ---------------------------------------------------------------------
   Auto-save — each choice is persisted immediately (presets)
   or after a pause (color editing), so the saved theme never
   diverges from what is on screen (no "hybrid themes").
--------------------------------------------------------------------- */
function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.getAttribute('content') : '';
}

function setSaveStatus(state) {
    const status = document.getElementById('themeSaveStatus');
    if (!status) {
        return;
    }

    const messages = {
        idle: '',
        saving: 'A guardar…',
        saved: 'Guardado',
        error: 'Erro ao guardar — tente novamente.',
    };

    status.textContent = messages[state] || '';
    status.setAttribute('data-state', state);
}

function persistThemeValues() {
    saveTimer = null;

    const form = document.getElementById('themeAppearanceForm');
    if (!form) {
        return;
    }

    // Ensure what is sent matches what is on screen
    enforceContrastCompliance();

    const payload = {};
    document.querySelectorAll('[data-theme-var]').forEach((input) => {
        payload[input.name] = input.value;
    });

    setSaveStatus('saving');

    fetch(form.getAttribute('action'), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
        },
        body: JSON.stringify(payload),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('save-failed');
            }
            return response.json();
        })
        .then((data) => {
            if (data && data.theme_name) {
                localStorage.setItem('theme_name', data.theme_name);
                const activeTheme = document.querySelector('meta[name="active-theme"]');
                if (activeTheme) {
                    activeTheme.setAttribute('content', data.theme_name);
                }
                if (data.mode) {
                    const themeMode = document.querySelector('meta[name="theme-mode"]');
                    if (themeMode) {
                        themeMode.setAttribute('content', data.mode);
                    }
                }
            }
            setSaveStatus('saved');
        })
        .catch(() => {
            setSaveStatus('error');
        });
}

let saveTimer = null;

function saveTheme(immediate = false) {
    if (saveTimer) {
        clearTimeout(saveTimer);
        saveTimer = null;
    }

    if (immediate) {
        persistThemeValues();
        return;
    }

    setSaveStatus('saving');
    saveTimer = setTimeout(persistThemeValues, 700);
}

function initPresetPicker() {
    window.uiThemePresets = loadPresets();

    document.addEventListener('click', (e) => {
        const card = e.target.closest('[data-preset]');
        if (!card) {
            return;
        }

        const preset = Array.isArray(window.uiThemePresets)
            ? window.uiThemePresets.find((p) => p.id === card.dataset.preset)
            : null;

        if (preset) {
            applyPreset(preset);
            saveTheme(true);
        }
    });
}

function initThemeSettingsPreview() {
    initPresetPicker();

    document.querySelectorAll('[data-theme-var]').forEach((input) => {
        input.addEventListener('input', () => {
            applyVariable(input, normalizeColor(input.value));
            enforceContrastCompliance();
            markActivePreset();
            saveTheme();
        });
    });

    enforceContrastCompliance();
    markActivePreset();
}

export function init() {
    initThemeSettingsPreview();
}
