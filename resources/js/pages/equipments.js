/**
 * Equipment Management Module
 * Gestão de equipamentos (listagem, filtros, CRUD)
 */

import { formToObject } from '../api-client';

let equipmentData = [];
const ROWS_PER_PAGE = 10;

/**
 * Initialize equipment management page
 */
export function initEquipmentManagement() {
    const btnAddEquipment = document.getElementById('btnAddEquipment');
    const equipmentModal = document.getElementById('equipmentModal');
    const equipmentForm = document.getElementById('equipmentForm');

    // Setup event listeners
    if (btnAddEquipment) {
        btnAddEquipment.addEventListener('click', openNewEquipmentModal);
    }

    if (equipmentModal) {
        equipmentModal.addEventListener('click', function(e) {
            if (e.target === equipmentModal) {
                closeModal('equipmentModal');
            }
        });
    }

    if (equipmentForm) {
        equipmentForm.addEventListener('submit', saveEquipment);
    }

    // Initialize filters
    initEquipmentFilters();
    
    // Load initial data
    loadEquipments();
}

/**
 * Open modal for new equipment
 */
export function openNewEquipmentModal() {
    openEquipmentModal(null);
}

/**
 * Open modal for editing equipment
 * @param {Object} equipment - Equipment data to edit
 */
export function openEquipmentModal(equipment) {
    const modal = document.getElementById('equipmentModal');
    const modalTitle = document.getElementById('equipmentModalTitle');
    const equipmentForm = document.getElementById('equipmentForm');

    if (!modal || !equipmentForm) return;

    // Clear form
    equipmentForm.reset();
    document.getElementById('equipmentId').value = '';

    if (equipment) {
        // Edit mode
        modalTitle.textContent = 'Editar Equipamento';
        document.getElementById('eqName').value = equipment.name || '';
        document.getElementById('eqSerial').value = equipment.serial_number || '';
        document.getElementById('eqCategory').value = equipment.category_id || '';
        document.getElementById('eqLocation').value = equipment.room_id || '';
        document.getElementById('equipmentId').value = equipment.id;
        document.getElementById('eqStatus').value = equipment.status || 'active';
    } else {
        // Create mode
        modalTitle.textContent = 'Adicionar Equipamento';
        document.getElementById('eqStatus').value = 'active';
    }

    // Show modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

/**
 * Close equipment modal
 * @param {string} modalId - Modal element ID
 */
export function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

/**
 * Save equipment (create or update)
 * @param {Event} event - Form submit event
 */
async function saveEquipment(event) {
    event.preventDefault();
    
    const form = event.currentTarget;
    const id = document.getElementById('equipmentId').value;
    const formData = new FormData(form);

    const url = id ? `/ui/equipments/${id}` : '/ui/equipments';

    try {
        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify(Object.fromEntries(formData)) // <-- Aqui
        });
        // ...

        const data = await res.json().catch(() => ({}));

        if (res.ok) {
            closeModal('equipmentModal');
            loadEquipments();
            showToast({
                type: 'success',
                title: id ? 'Equipamento atualizado' : 'Equipamento adicionado',
                message: data.message || 'Operação realizada com sucesso.'
            });
        } else {
            throw new Error(data.message || 'Erro ao guardar equipamento.');
        }
    } catch (error) {
        console.error('[Equipment Save Error]:', error);
        showToast({
            type: 'error',
            title: 'Erro',
            message: error.message
        });
    }
}

/**
 * Delete equipment
 * @param {number} id - Equipment ID
 */
export async function deleteEquipment(id) {
    if (!confirm('Tem certeza que pretende remover este equipamento?')) {
        return;
    }

    try {
        const res = await fetch(`/ui/equipments/${id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        });

        const data = await res.json().catch(() => ({}));

        if (res.ok) {
            loadEquipments();
            showToast({
                type: 'success',
                title: 'Equipamento removido',
                message: data.message || 'Removido com sucesso.'
            });
        } else {
            throw new Error(data.message || 'Erro ao remover equipamento.');
        }
    } catch (error) {
        console.error('[Equipment Delete Error]:', error);
        showToast({
            type: 'error',
            title: 'Erro',
            message: error.message
        });
    }
}

/**
 * Initialize filter handlers
 */
function initEquipmentFilters() {
    const btnSearch = document.getElementById('btnSearch');
    const btnClear = document.getElementById('btnClear');

    if (btnSearch) {
        btnSearch.addEventListener('click', loadEquipments);
    }

    if (btnClear) {
        btnClear.addEventListener('click', function() {
            document.getElementById('filter_q').value = '';
            document.getElementById('filter_status').value = '';
            loadEquipments();
        });
    }
}

/**
 * Load equipment list from API
 */
async function loadEquipments() {
    const tableBody = document.getElementById('equipmentTableBody');
    const resultsCount = document.getElementById('resultsCount');

    if (!tableBody) return;

    tableBody.innerHTML = `
        <tr>
            <td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                <div class="flex items-center justify-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    A carregar inventário de equipamentos...
                </div>
            </td>
        </tr>
    `;

    try {
        const query = document.getElementById('filter_q')?.value || '';
        const status = document.getElementById('filter_status')?.value || '';
        
        const url = `/api/equipments?page=1&query=${query}&status=${status}`;
        
        const res = await fetch(url, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        });

        if (!res.ok) throw new Error('Failed to load equipment');

        const data = await res.json();
        equipmentData = data.data || [];

        // Render table
        if (equipmentData.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                        Nenhum equipamento encontrado.
                    </td>
                </tr>
            `;
            if (resultsCount) resultsCount.textContent = '0 registos';
            return;
        }

        tableBody.innerHTML = equipmentData.map(eq => `
            <tr class="hover:bg-[var(--surface-2)] transition-colors">
                <td class="px-5 py-4 text-xs font-mono">
                    <div class="font-semibold">${eq.serial_number || '-'}</div>
                    <div class="text-[var(--text-soft)]">${eq.code || '-'}</div>
                </td>
                <td class="px-5 py-4 text-xs font-medium">
                    ${eq.name}
                </td>
                <td class="px-5 py-4 text-xs">
                    ${eq.room?.name || '-'}
                </td>
                <td class="px-5 py-4 text-xs">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        ${eq.status === 'active' 
                            ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' 
                            : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400'}">
                        ${eq.status === 'active' ? 'Operacional' : 'Fora de Serviço'}
                    </span>
                </td>
                <td class="px-5 py-4 text-right text-xs">
                    <button onclick="window.openEquipmentModal(${JSON.stringify(eq).replace(/"/g, '&quot;')})"
                        class="text-primary hover:text-primary/80 font-medium cursor-pointer">
                        Editar
                    </button>
                    <button onclick="window.deleteEquipment(${eq.id})"
                        class="ml-3 text-red-500 hover:text-red-700 font-medium cursor-pointer">
                        Remover
                    </button>
                </td>
            </tr>
        `).join('');

        if (resultsCount) {
            resultsCount.textContent = `${equipmentData.length} registos`;
        }

        renderPagination(data);
    } catch (error) {
        console.error('[Load Equipment Error]:', error);
        tableBody.innerHTML = `
            <tr>
                <td colspan="5" class="px-5 py-12 text-center text-xs text-red-500">
                    Erro ao carregar equipamentos.
                </td>
            </tr>
        `;
    }
}

/**
 * Render pagination controls
 * @param {Object} paginationData - API pagination data
 */
function renderPagination(paginationData) {
    const paginationContainer = document.getElementById('pagination');
    
    if (!paginationContainer || !paginationData) return;

    paginationContainer.innerHTML = `
        <div class="flex items-center gap-2">
            <span class="text-xs text-[var(--text-soft)]">
                Página ${paginationData.current_page} de ${paginationData.last_page}
            </span>
            <span class="text-xs text-[var(--text-soft)]">
                Total ${paginationData.total} registos
            </span>
        </div>
    `;
}

/**
 * Show toast notification
 * @param {Object} options - Toast options
 */
function showToast({ type = 'success', title, message }) {
    console.log(`[${type.toUpperCase()}] ${title}: ${message}`);
}

// Expor funções globalmente para chamadas diretas no HTML (onclick)
window.openEquipmentModal = openEquipmentModal;
window.deleteEquipment = deleteEquipment;