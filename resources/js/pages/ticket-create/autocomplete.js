import { openItemSelectorModal } from '../../components/item-selector-modal.js';

export async function initAutocomplete() {
    const searchInput = document.getElementById('equipmentSearchInput');
    const hiddenIdInput = document.getElementById('selectedEquipmentId');

    if (!searchInput || !hiddenIdInput) return;

    // Make input readonly and add click handler to open modal
    searchInput.readOnly = true;
    searchInput.placeholder = 'Click to select equipment...';
    searchInput.style.cursor = 'pointer';

    searchInput.addEventListener('click', () => {
        openItemSelectorModal({
            itemType: 'equipment',
            multiSelect: false,
            triggerInput: searchInput,
            onConfirm: (selected) => {
                if (selected && selected.length > 0) {
                    const equipment = selected[0];
                    hiddenIdInput.value = equipment.id;
                    searchInput.value = equipment.name || '';
                }
            },
        });
    });
}
