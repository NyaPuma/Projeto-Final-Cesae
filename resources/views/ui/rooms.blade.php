@extends('ui.layout')

@section('content')
<script>window.requireAuthOnLoad = true;</script>

@component('ui.partials.page-card', [
    'title' => 'Gestão de Salas',
    'subtitle' => 'Organização física do edifício e alocação de ativos por espaços.'
])
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h2 class="text-lg font-bold">Espaços Disponíveis</h2>
            <p class="text-sm text-[var(--text-soft)]">Gerencie as salas e as suas respetivas localizações.</p>
        </div>
        <button onclick="openModal('roomModal')" class="btn btn-primary">+ Nova Sala</button>
    </div>

    {{-- Tabela de Salas --}}
    <div class="card overflow-hidden">
        <table class="w-full text-left" id="roomsTable">
            <thead>
                <tr class="bg-[var(--surface-2)]">
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nome</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Edifício</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Equipamentos</th>
                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[var(--border)]" id="roomsTableBody">
                <!-- Conteúdo carregado via API -->
            </tbody>
        </table>
    </div>

    {{-- Modal de Edição/Criação --}}
    <x-ui.modal id="roomModal" title="Adicionar/Editar Sala">
        <form id="roomForm" onsubmit="saveRoom(event)">
            @csrf
            <input type="hidden" name="id" id="roomId">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Nome da Sala</label>
                    <input type="text" name="name" id="roomName" required class="input w-full">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Edifício</label>
                    <input type="text" name="building" id="roomBuilding" required class="input w-full">
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="submit" class="btn btn-primary">Guardar Alterações</button>
            </div>
        </form>
    </x-ui.modal>
@endcomponent
@endsection

@push('scripts')
<script>
async function loadRooms() {
    const res = await fetch('/api/rooms', { headers: authHeader() });
    const data = await res.json();
    const tbody = document.getElementById('roomsTableBody');
    tbody.innerHTML = data.map(r => `
        <tr>
            <td class="px-6 py-4 text-sm font-medium">${r.name}</td>
            <td class="px-6 py-4 text-sm text-[var(--text-soft)]">${r.building}</td>
            <td class="px-6 py-4 text-sm">${r.equipment_count || 0}</td>
            <td class="px-6 py-4 text-right">
                <button onclick="editRoom(${JSON.stringify(r).replace(/"/g, '&quot;')})" class="text-primary hover:underline">Editar</button>
            </td>
        </tr>
    `).join('');
}

function editRoom(room) {
    document.getElementById('roomId').value = room.id;
    document.getElementById('roomName').value = room.name;
    document.getElementById('roomBuilding').value = room.building;
    openModal('roomModal');
}

async function saveRoom(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const id = formData.get('id');
    const method = id ? 'PUT' : 'POST';
    const url = id ? `/api/rooms/${id}` : '/api/rooms';

    await fetch(url, {
        method,
        headers: Object.assign({'Content-Type': 'application/json'}, authHeader()),
        body: JSON.stringify(Object.fromEntries(formData))
    });
    
    closeModal('roomModal');
    loadRooms();
}

document.addEventListener('DOMContentLoaded', loadRooms);
</script>
@endpush
