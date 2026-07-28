export function openModal({ modal, form = null, hiddenField = null, titleElement = null, title = '' }) {
    form?.reset();

    if (hiddenField) hiddenField.value = '';
    if (titleElement) titleElement.textContent = title;

    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    document.body.classList.add('overflow-hidden');
}

export function closeModal(modal) {
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.body.classList.remove('overflow-hidden');
}

export function bindModalDismiss({ modal, closeActionSelector, isOpen }) {
    document.addEventListener('click', (event) => {
        if (event.target.closest(closeActionSelector)) {
            closeModal(modal());
            return;
        }

        if (event.target === modal()) {
            closeModal(modal());
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && isOpen()) {
            closeModal(modal());
        }
    });
}
