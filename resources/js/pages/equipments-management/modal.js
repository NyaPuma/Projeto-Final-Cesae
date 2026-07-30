import { bindModalDismiss, closeModal, openModal } from '../../components/modal/base.js';
import { getEquipmentForm, getEquipmentModal } from './dom.js';
import { showFeedback } from './render.js';

export function openEquipmentModal() {
    openModal({
        modal: getEquipmentModal(),
        form: getEquipmentForm(),
        hiddenField: document.getElementById('equipmentId'),
        titleElement: document.getElementById('equipmentModalTitle'),
        title: 'Adicionar Equipamento',
    });
}

export function closeEquipmentModal() {
    closeModal(getEquipmentModal());
}

export function bindEquipmentModalDismiss() {
    bindModalDismiss({
        modal: getEquipmentModal,
        closeActionSelector: '[data-action="close-equipment-modal"]',
        isOpen: () => !getEquipmentModal()?.classList.contains('hidden'),
    });
}

export function reportEquipmentSaveError(message) {
    showFeedback(message, true);
}
