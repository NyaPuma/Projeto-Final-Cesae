/**
 * Panel appearance settings page.
 *
 * Theme preference is per-user and preset-only: clicking a preset card applies
 * the theme immediately and persists the preset id on the authenticated user's
 * record (users.theme). Guests/users without a saved preference always see the
 * default (Laranja Industrial).
 */

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

function markActivePreset() {
    const presets = window.uiThemePresets;
    if (!Array.isArray(presets)) {
        return;
    }

    const activeId = getMeta('active-theme');

    document.querySelectorAll('[data-preset]').forEach((card) => {
        const matches = activeId && card.dataset.preset === activeId;
        card.classList.toggle('is-active', Boolean(matches));
        card.setAttribute('aria-pressed', matches ? 'true' : 'false');
    });
}

/* ---------------------------------------------------------------------
   Auto-save — each preset choice is persisted immediately.
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
        saving: (window.SGM_UI_I18N?.saving || 'Saving...'),
        saved: (window.SGM_UI_I18N?.savedSuccess || 'Saved'),
        error: (window.SGM_UI_I18N?.saveError || 'Error saving — please try again.'),
    };

    status.textContent = messages[state] || '';
    status.setAttribute('data-state', state);
}

function persistTheme(themeId) {
    const form = document.getElementById('themeAppearanceForm');
    if (!form) {
        return;
    }

    const hiddenTheme = document.querySelector('input[name="theme"]');
    if (hiddenTheme) {
        hiddenTheme.value = themeId;
    }

    setSaveStatus('saving');

    fetch(form.getAttribute('action'), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
        },
        body: JSON.stringify({ theme: themeId }),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('save-failed');
            }
            return response.json();
        })
        .then((data) => {
            if (data && data.theme) {
                localStorage.setItem('theme_name', data.theme);
                setMeta('active-theme', data.theme);
                if (data.mode) {
                    setMeta('theme-mode', data.mode);
                }
                applyThemeMode(data.mode === 'dark');
            }

            // The theme colours come from /theme/custom.css, which is served
            // per-user with a cache-buster. Reload so the browser fetches the
            // freshly generated stylesheet and applies the new theme in full.
            setSaveStatus('saved');
            window.location.reload();
        })
        .catch(() => {
            setSaveStatus('error');
        });
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
            applyThemeMode(preset.mode === 'dark');
            localStorage.setItem('theme_name', preset.id);
            persistTheme(preset.id);
        }
    });
}

export function init() {
    initPresetPicker();
    markActivePreset();
}