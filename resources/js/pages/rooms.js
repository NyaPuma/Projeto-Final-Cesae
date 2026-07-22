/**
 * Room Management Module
 * Gestão de salas (listagem, filtros, CRUD)
 */

import { post, del } from '../services/api-client';

let roomData = [];
const ROWS_PER_PAGE = 10;

/**
 * Initialize room management page
 */
export function initRoomManagement() {
    const btnAddRoom = document.getElementById('btnAddRoom');
    const roomModal = document.getElementById('roomModal');
    const roomForm = document.getElementById('roomForm');

    // Setup event listeners
    if (btnAddRoom) {
        btnAddRoom.addEventListener('click', openNewRoomModal);
    }

    if (roomModal) {
        roomModal.addEventListener('click', function(e) {
            if (e.target === roomModal) {
                closeModal('roomModal');
            }
        });
    }

    if (roomForm) {
        roomForm.addEventListener('submit', saveRoom);
    }

    // Initialize filters
    initRoomFilters();
    
    // Load initial data
    loadRooms();
}

/**
 * Open modal for new room
 */
export function openNewRoomModal() {
    openRoomModal(null);
}

/**
 * Open modal for editing room
 * @param {Object} room - Room data to edit
 */
export function openRoomModal(room) {
    const modal = document.getElementById('roomModal');
    const modalTitle = document.getElementById('roomModalTitle');
    const roomForm = document.getElementById('roomForm');

    if (!modal || !roomForm) return;

    // Clear form
    roomForm.reset();
    document.getElementById('roomId').value = '';

    if (room) {
        // Edit mode
        modalTitle.textContent = '{{ __("Editar Sala") }}';
        document.getElementById('roomName').value = room.name || '';
        document.getElementById('roomBuilding').value = room.building || '';
        document.getElementById('roomId').value = room.id;
    } else {
        // Create mode
        modalTitle.textContent = '{{ __("Adicionar Sala") }}';
    }

    // Show modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

/**
 * Close room modal
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
 * Save room (create or update)
 * @param {Event} event - Form submit event
 */
async function saveRoom(event) {
    event.preventDefault();
    
    const form = event.currentTarget;
    const id = document.getElementById('roomId').value;
    const formData = new FormData(form);

    const url = id 
        ? `/ui/rooms/${id}`
        : '/ui/rooms';

    try {
        const res = await post(url, Object.fromEntries(formData));

        if (res.ok) {
            closeModal('roomModal');
            loadRooms();
            showToast({
                type: 'success',
                title: id ? '{{ __("Sala atualizada") }}' : '{{ __("Sala adicionada") }}',
                message: res.data.message
            });
        }
    } catch (error) {
        console.error('[Room Save Error]:', error);
        showToast({
            type: 'error',
            title: '{{ __("Erro") }}',
            message: error.message
        });
    }
}

/**
 * Delete room
 * @param {number} id - Room ID
 */
export async function deleteRoom(id) {
    if (!confirm('{{ __("Tem certeza que pretende remover esta sala?") }}')) {
        return;
    }

    try {
        const res = await del(`/ui/rooms/${id}`);

        if (res.ok) {
            loadRooms();
            showToast({
                type: 'success',
                title: '{{ __("Sala removida") }}',
                message: res.data.message
            });
        }
    } catch (error) {
        console.error('[Room Delete Error]:', error);
        showToast({
            type: 'error',
            title: '{{ __("Erro") }}',
            message: error.message
        });
    }
}

/**
 * Initialize filter handlers
 */
function initRoomFilters() {
    const btnSearch = document.getElementById('btnSearch');
    const btnClear = document.getElementById('btnClear');

    if (btnSearch) {
        btnSearch.addEventListener('click', loadRooms);
    }

    if (btnClear) {
        btnClear.addEventListener('click', function() {
            document.getElementById('filter_q').value = '';
            document.getElementById('filter_building').value = '';
            loadRooms();
        });
    }
}

/**
 * Load room list from API
 */
async function loadRooms() {
    const tableBody = document.getElementById('roomsTableBody');
    const resultsCount = document.getElementById('resultsCount');

    if (!tableBody) return;

    tableBody.innerHTML = `
        <tr>
            <td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                <div class="flex items-center justify-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    {{ __('A carregar listagem de salas...') }}
                </div>
            </td>
        </tr>
    `;

    try {
        const query = document.getElementById('filter_q')?.value || '';
        const building = document.getElementById('filter_building')?.value || '';
        
        const url = `/api/rooms?page=1&query=${query}&building=${building}`;
        
        const res = await fetch(url, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        });

        if (!res.ok) throw new Error('Failed to load rooms');

        const data = await res.json();
        roomData = data.data || [];

        // Render table
        if (roomData.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                        {{ __('Nenhuma sala encontrada.') }}
                    </td>
                </tr>
            `;
            resultsCount.textContent = '0 {{ __("registos") }}';
            return;
        }

        tableBody.innerHTML = roomData.map(room => `
            <tr class="hover:bg-[var(--surface-2)] transition-colors">
                <td class="px-5 py-4 text-xs font-medium">${room.name}</td>
                <td class="px-5 py-4 text-xs text-[var(--text-soft)]">${room.building || '-'}</td>
                <td class="px-5 py-4 text-xs">
                    ${room.equipments?.length || 0} {{ __("equipamentos") }}
                </td>
                <td class="px-5 py-4 text-right text-xs">
                    <button onclick="openRoomModal(${JSON.stringify(room)})"
                        class="text-primary hover:text-primary/80 font-medium">
                        {{ __("Editar") }}
                    </button>
                    <button onclick="deleteRoom(${room.id})"
                        class="ml-3 text-red-500 hover:text-red-700 font-medium">
                        {{ __("Remover") }}
                    </button>
                </td>
            </tr>
        `).join('');

        resultsCount.textContent = `${roomData.length} {{ __("registos") }}`;

        // Pagination
        renderPagination(data);
    } catch (error) {
        console.error('[Load Room Error]:', error);
        tableBody.innerHTML = `
            <tr>
                <td colspan="4" class="px-5 py-12 text-center text-xs text-red-500">
                    {{ __('Erro ao carregar salas.') }}
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
                {{ __("Página") }} ${paginationData.current_page} {{ __("de") }} ${paginationData.last_page}
            </span>
            <span class="text-xs text-[var(--text-soft)]">
                {{ __("Total") }} ${paginationData.total} {{ __("registos") }}
            </span>
        </div>
    `;
}

/**
 * Show toast notification
 * @param {Object} options - Toast options
 */
function showToast({ type = 'success', title, message }) {
    // Implement toast notification
    console.log(`[${type.toUpperCase()}] ${title}: ${message}`);
}
