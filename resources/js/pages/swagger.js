/**
 * Localização dos textos nativos do Swagger UI.
 * A biblioteca não expõe um catálogo i18n próprio; observamos apenas os
 * labels de interface, mantendo intactos paths, schemas e descrições da API.
 */
export function init() {
    const root = document.querySelector('#swagger-ui');
    const translations = window.SGM_SWAGGER_I18N || {};

    if (!root || !Object.keys(translations).length) {
        return;
    }

    const translate = (node) => {
        if (node.nodeType === Node.TEXT_NODE) {
            const source = node.nodeValue.trim();
            if (source && translations[source]) {
                node.nodeValue = node.nodeValue.replace(source, translations[source]);
            }
            return;
        }

        if (node.nodeType !== Node.ELEMENT_NODE) {
            return;
        }

        ['aria-label', 'placeholder', 'title'].forEach((attribute) => {
            const value = node.getAttribute(attribute);
            if (value && translations[value]) {
                node.setAttribute(attribute, translations[value]);
            }
        });

        node.childNodes.forEach(translate);
    };

    const apply = () => translate(root);
    const observer = new MutationObserver(apply);
    observer.observe(root, { childList: true, subtree: true, characterData: true });
    apply();
}
