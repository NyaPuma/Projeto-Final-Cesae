import { bindModalDismiss, closeModal, openModal } from '../../components/modal/base.js';
import { getRoomForm, getRoomModal } from './dom.js';
import { showFeedback } from './render.js';

export function openRoomModal() {
    openModal({
        modal: getRoomModal(),
        form: getRoomForm(),
        hiddenField: document.getElementById('roomId'),
        titleElement: document.getElementById('roomModalTitle'),
        title: 'Dados da Sala',
    });
}

export function closeRoomModal() {
    closeModal(getRoomModal());
}

export function bindRoomModalDismiss() {
    bindModalDismiss({
        modal: getRoomModal,
        closeActionSelector: '[data-action="close-room-modal"]',
        isOpen: () => !getRoomModal()?.classList.contains('hidden'),
    });
}

export function reportRoomSaveError(message) {
    showFeedback(message, true);
}
