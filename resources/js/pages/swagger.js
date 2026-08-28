/**
 * Localization of Swagger UI native texts.
 * The library does not expose its own i18n catalog; we only observe
 * interface labels, keeping API paths, schemas and descriptions intact.
 */
export function init() {
    const root = document.querySelector('#swagger-ui');
    const translations = window.SGM_SWAGGER_I18N || {};

    if (!root) return;

    const t = (key) => translations[key] || key;

    const labelSwaggerControls = () => {
        root.querySelectorAll('input[type="text"], input[type="number"], input[type="password"], textarea').forEach(el => {
            if (!el.getAttribute('aria-label') && !el.getAttribute('aria-labelledby')) {
                const placeholder = el.placeholder || '';
                const param = el.closest('td')?.previousElementSibling?.textContent?.trim();
                if (param) {
                    el.setAttribute('aria-label', param);
                } else if (placeholder) {
                    el.setAttribute('aria-label', placeholder);
                }
            }
        });

        root.querySelectorAll('select').forEach(el => {
            if (!el.getAttribute('aria-label') && !el.getAttribute('aria-labelledby')) {
                const parent = el.closest('label') || el.closest('.scheme-container');
                if (parent) {
                    const label = parent.querySelector('.sr-only, label');
                    if (label) {
                        if (!label.id) {
                            label.id = 'lbl-' + Math.random().toString(36).slice(2, 8);
                        }
                        el.setAttribute('aria-labelledby', label.id);
                    }
                }
                if (!el.getAttribute('aria-label')) {
                    el.setAttribute('aria-label', t('Selecionar'));
                }
            }
        });

        root.querySelectorAll('input[type="checkbox"]').forEach(el => {
            if (!el.getAttribute('aria-label') && !el.getAttribute('aria-labelledby')) {
                const label = el.closest('label');
                if (label) {
                    if (!label.id) {
                        label.id = 'lbl-' + Math.random().toString(36).slice(2, 8);
                    }
                    el.setAttribute('aria-labelledby', label.id);
                }
            }
        });

        root.querySelectorAll('button').forEach(btn => {
            if (!btn.textContent.trim() && !btn.getAttribute('aria-label')) {
                const svg = btn.querySelector('svg');
                if (svg) {
                    btn.setAttribute('aria-label', t('Expandir'));
                }
            }
        });

        root.querySelectorAll('table.responses-table, table.model').forEach(table => {
            if (!table.getAttribute('role')) {
                table.setAttribute('role', 'presentation');
            }
        });
    };

    if (Object.keys(translations).length) {
        const translate = (node) => {
            if (node.nodeType === Node.TEXT_NODE) {
                const source = node.nodeValue.trim();
                if (source && translations[source]) {
                    node.nodeValue = node.nodeValue.replace(source, translations[source]);
                }
                return;
            }

            if (node.nodeType !== Node.ELEMENT_NODE) return;

            ['aria-label', 'placeholder', 'title'].forEach((attribute) => {
                const value = node.getAttribute(attribute);
                if (value && translations[value]) {
                    node.setAttribute(attribute, translations[value]);
                }
            });

            node.childNodes.forEach(translate);
        };

        const apply = () => {
            translate(root);
            labelSwaggerControls();
        };
        const observer = new MutationObserver(apply);
        observer.observe(root, { childList: true, subtree: true, characterData: true });
        apply();
    } else {
        const observer = new MutationObserver(labelSwaggerControls);
        observer.observe(root, { childList: true, subtree: true });
        labelSwaggerControls();
    }

    setTimeout(labelSwaggerControls, 2000);
    setTimeout(labelSwaggerControls, 5000);

    const expandAll = document.getElementById('expandAll');
    const collapseAll = document.getElementById('collapseAll');

    if (expandAll) {
        expandAll.addEventListener('click', () => {
            root.querySelectorAll('.opblock-tag[data-is-open="false"]').forEach(tag => tag.click());
        });
    }

    if (collapseAll) {
        collapseAll.addEventListener('click', () => {
            root.querySelectorAll('.opblock-tag[data-is-open="true"]').forEach(tag => tag.click());
        });
    }
}
