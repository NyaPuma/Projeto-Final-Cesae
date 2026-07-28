import { getFileInput, getFileNameLabel } from './dom.js';

export function updateFileName() {
    const input = getFileInput();
    const label = getFileNameLabel();
    if (!label) return;

    const defaultLabel = label.dataset.defaultLabel || 'Nenhum ficheiro selecionado';
    label.textContent = input?.files?.[0]?.name || defaultLabel;
}

export function bindFileUploadLabel() {
    getFileInput()?.addEventListener('change', updateFileName);
}
