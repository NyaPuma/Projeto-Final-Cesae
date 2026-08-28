let initialized = false;

export function initPublicTicketForm(root = document) {
    if (initialized) return;
    initialized = true;

    const photoInput = root.getElementById('photo');
    const photoName = root.getElementById('photoName');

    if (!photoInput || !photoName) return;

    photoInput.addEventListener('change', (event) => {
        const name = event.target.files?.[0]?.name;
        photoName.textContent = name || photoName.dataset.placeholder || '';
    });
}