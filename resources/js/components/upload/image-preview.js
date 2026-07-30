function getPreviewTemplate(src, name) {
    return `
        <div class="ui-upload-preview__item">
            <img src="${src}" alt="${name}" class="ui-upload-preview__image">
            <div class="ui-upload-preview__meta">
                <span class="ui-upload-preview__name">${name}</span>
            </div>
        </div>
    `;
}

function renderInputPreview(input) {
    const previewId = input.dataset.previewTarget;
    const preview = previewId ? document.getElementById(previewId) : null;

    if (!preview) return;

    preview.innerHTML = '';

    if (!input.files?.length) {
        return;
    }

    Array.from(input.files).forEach((file) => {
        if (!file.type.startsWith('image/')) {
            return;
        }

        const reader = new FileReader();
        reader.addEventListener('load', (event) => {
            preview.insertAdjacentHTML('beforeend', getPreviewTemplate(event.target?.result ?? '', file.name));
        });
        reader.readAsDataURL(file);
    });
}

export function initImagePreview(root = document) {
    root.addEventListener('change', (event) => {
        const input = event.target.closest('[data-behavior="image-preview"]');

        if (!input) return;

        renderInputPreview(input);
    });
}
