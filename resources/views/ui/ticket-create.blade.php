@extends('ui.layout')
@section('page_key', 'ticket-create')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>


<x-ui.partials.page-card
    :title="__('Criar Ticket')"
    :subtitle="__('Registe uma nova ocorrência de manutenção com contexto técnico e prioridade.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="'/ui/tickets'" :label="__('Voltar aos tickets')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    {{-- Contentor Principal do Formul├írio --}}
    <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-8 shadow-sm">

        <div class="mb-6 border-b border-[var(--border)] pb-4">
            <h2 class="text-sm font-bold text-[var(--text)]">{{ __('Novo pedido de interven├º├úo') }}</h2>
            <p class="text-xs text-[var(--text-soft)] mt-0.5">{{ __('Descreva a situa├º├úo de forma objetiva para que a equipa t├®cnica possa agir rapidamente.') }}</p>
        </div>

        <form id="createTicketForm" class="space-y-6">

            {{-- T├¡tulo do Pedido --}}
            <div>
                <label class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('T├¡tulo do Pedido *') }}</label>
                <input type="text" id="ticketTitle" name="title" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 transition-all" placeholder="{{ __('Ex.: Ru├¡do an├│malo no motor principal do torno') }}">
            </div>

            {{-- Descri├º├úo Detalhada --}}
            <div>
                <label class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Descri├º├úo Detalhada *') }}</label>
                <textarea id="ticketDescription" name="description" rows="4" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 resize-none transition-all" placeholder="{{ __('Detalhe o problema ocorrido, ru├¡dos, fugas ou comportamentos fora do normal...') }}"></textarea>
            </div>

            {{-- N├¡vel de Urg├¬ncia / Prioridade (Cards Interativos) --}}
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('N├¡vel de Urg├¬ncia / Prioridade *') }}</label>
                    <span class="text-[10px] text-[var(--text-soft)]">{{ __('Selecione o impacto real na produ├º├úo') }}</span>
                </div>

                <input type="hidden" id="ticketPriority" name="priority" value="m├®dia" required>

                <div class="grid gap-4 md:grid-cols-4">
                    {{-- Card Baixa --}}
                    <div type="button" data-priority="baixa" onclick="selectPriority('baixa')"
                        class="priority-card cursor-pointer rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 transition-all hover:border-emerald-500/50">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-emerald-400">{{ __('Baixa') }}</span>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        </div>
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Manuten├º├úo Ligeira. Anomalia menor sem risco imediato.') }}</p>
                    </div>

                    {{-- Card M├®dia (Selecionado por defeito) --}}
                    <div type="button" data-priority="m├®dia" onclick="selectPriority('m├®dia')"
                        class="priority-card cursor-pointer rounded-2xl border-2 border-amber-500 bg-[var(--surface-2)] p-4 transition-all shadow-sm">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-amber-400">{{ __('M├®dia') }}</span>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                        </div>
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Degrada├º├úo Parcial. Funcionamento condicionado.') }}</p>
                    </div>

                    {{-- Card Alta --}}
                    <div type="button" data-priority="alta" onclick="selectPriority('alta')"
                        class="priority-card cursor-pointer rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 transition-all hover:border-red-500/50">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-orange-400">{{ __('Alta') }}</span>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                        </div>
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Paragem Cr├¡tica. Linha ou m├íquina inoperacional.') }}</p>
                    </div>

                    {{-- Card Cr├¡tica --}}
                    <div type="button" data-priority="cr├¡tica" onclick="selectPriority('cr├¡tica')"
                        class="priority-card cursor-pointer rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 transition-all hover:border-purple-600/50">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-rose-500">{{ __('Cr├¡tica') }}</span>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                        </div>
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Emerg├¬ncia Imediata. Risco de acidente.') }}</p>
                    </div>
                </div>
            </div>

            {{-- Equipamento (Autocomplete) & Imagem --}}
            <div class="grid gap-6 lg:grid-cols-2">
                {{-- AUTOCOMPLETAR EQUIPAMENTO --}}
                <div class="relative">
                    <label class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">
                        {{ __('Equipamento / Ativo Afetado *') }}
                    </label>

                    <div class="relative">
                        <input type="text" id="equipmentSearchInput" autocomplete="off" placeholder="{{ __('Escreva para pesquisar equipamento, s├®rie ou sala...') }}"
                            class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary transition-all">
                    </div>

                    {{-- ID escondido para submiss├úo --}}
                    <input type="hidden" id="selectedEquipmentId" name="equipment_id" required>

                    {{-- Caixa de Sugest├Áes / Dropdown de Autocomplete --}}
                    <div id="equipmentSuggestions" class="hidden absolute z-50 mt-1 w-full max-h-52 overflow-y-auto rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-2xl divide-y divide-[var(--border)]/50">
                    </div>
                </div>

                {{-- Inserir Imagem --}}
                <div>
                    <label class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Inserir Imagem (Opcional)') }}</label>
                    <div class="flex items-center gap-3 w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2">
                        <label for="ticketImage" class="cursor-pointer rounded-xl bg-[var(--surface)] border border-[var(--border)] px-3 py-1.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--surface-2)] transition">
                            {{ __('Escolher ficheiro') }}
                        </label>
                        <input type="file" id="ticketImage" accept="image/*" class="hidden" onchange="updateFileName(this)">
                        <span id="fileName" class="text-xs text-[var(--text-soft)] truncate">{{ __('Nenhum ficheiro selecionado') }}</span>
                    </div>
                </div>
            </div>

            {{-- Mensagem de Feedback --}}
            <div id="formMessage" class="min-h-6 text-xs font-medium text-[var(--text-soft)]"></div>

            {{-- Bot├úo de Submiss├úo --}}
            <div class="mt-6">
                <button type="submit" id="submitBtn" class="inline-flex items-center justify-center rounded-xl px-6 py-3 text-xs font-black uppercase tracking-wider transition hover:opacity-90 disabled:opacity-50 shadow-lg shadow-orange-500/20 bg-primary text-white cursor-pointer">
                    {{ __('Guardar Ticket') }}
                </button>
            </div>
        </form>
    </div>
</x-ui.partials.page-card>
@endsection

@push('scripts')
<script>
function authHeader() {
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };
    if (token) headers['X-Auth-Token'] = token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;
    return headers;
}

function selectPriority(priority) {
    document.getElementById('ticketPriority').value = priority;

    const cards = document.querySelectorAll('.priority-card');
    cards.forEach(card => {
        const cardPriority = card.getAttribute('data-priority');

        card.classList.remove('border-2', 'border-emerald-500', 'border-amber-500', 'border-orange-500', 'border-rose-500', 'shadow-sm');
        card.classList.add('border', 'border-[var(--border)]');

        if (cardPriority === priority) {
            card.classList.remove('border', 'border-[var(--border)]');
            card.classList.add('border-2', 'shadow-sm');
            if (priority === 'baixa') card.classList.add('border-emerald-500');
            if (priority === 'm├®dia' || priority === 'media') card.classList.add('border-amber-500');
            if (priority === 'alta') card.classList.add('border-orange-500');
            if (priority === 'cr├¡tica' || priority === 'critica') card.classList.add('border-rose-500');
        }
    });
}

function updateFileName(input) {
    const label = document.getElementById('fileName');
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
    } else {
        label.textContent = "{{ __('Nenhum ficheiro selecionado') }}";
    }
}

// L├│gica de Autocomplete de Equipamentos
let allEquipments = [];
const fallbackEquipments = [
    { id: 1, name: "Torno CNC KUKA KR210", serial: "SN-KUKA-096", room: { name: "Sala 096" } },
    { id: 2, name: "Empilhador El├®trico Toyota", serial: "SN-TOY-881", room: { name: "Armaz├®m Sul" } },
    { id: 3, name: "Sistema de Climatiza├º├úo / AC", serial: "AC-IND-045", room: { name: "Sala 045" } },
    { id: 4, name: "Compressor de Ar Industrial", serial: "CMP-9002", room: { name: "Oficina B" } },
    { id: 5, name: "Impressora Industrial HP", serial: "HP-3D-90", room: { name: "Escrit├│rio Central" } },
];

async function initAutocomplete() {
    const searchInput = document.getElementById('equipmentSearchInput');
    const suggestionsBox = document.getElementById('equipmentSuggestions');
    const hiddenIdInput = document.getElementById('selectedEquipmentId');

    if (!searchInput || !suggestionsBox) return;

    try {
        const endpoints = ['/admin/equipment', '/equipments', '/api/equipments'];
        for (const url of endpoints) {
            try {
                const res = await fetch(url, { headers: authHeader() });
                if (res.ok) {
                    const data = await res.json();
                    const list = data.equipments?.data || data.equipments || data || [];
                    if (list.length > 0) {
                        allEquipments = list;
                        break;
                    }
                }
            } catch (e) {}
        }
    } catch (e) {}

    if (allEquipments.length === 0) {
        allEquipments = fallbackEquipments;
    }

    searchInput.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        hiddenIdInput.value = '';

        if (query.length === 0) {
            suggestionsBox.classList.add('hidden');
            return;
        }

        const matches = allEquipments.filter(eq => {
            const nameMatch = (eq.name || '').toLowerCase().includes(query);
            const serialMatch = (eq.serial || '').toLowerCase().includes(query);
            const roomMatch = (eq.room?.name || '').toLowerCase().includes(query);
            return nameMatch || serialMatch || roomMatch;
        });

        if (matches.length === 0) {
            suggestionsBox.innerHTML = `<div class="p-3 text-xs text-[var(--text-soft)] italic">${"{{ __('Nenhum equipamento encontrado.') }}"}</div>`;
            suggestionsBox.classList.remove('hidden');
            return;
        }

        suggestionsBox.innerHTML = matches.map(eq => {
            const roomText = eq.room?.name ? ` ÔÇó ­ƒôì ${eq.room.name}` : '';
            const serialText = eq.serial ? ` ÔÇó ­ƒÅÀ´©Å ${eq.serial}` : '';
            return `
                <div class="equipment-option p-3 hover:bg-[var(--surface-2)] transition cursor-pointer text-xs flex justify-between items-center"
                     data-id="${eq.id}" data-name="${eq.name}">
                    <div>
                        <span class="font-bold text-[var(--text)] block">${eq.name}</span>
                        <span class="text-[10px] text-[var(--text-soft)]">${serialText}${roomText}</span>
                    </div>
                    <span class="text-[10px] font-mono font-bold text-primary">#${eq.id}</span>
                </div>
            `;
        }).join('');

        suggestionsBox.classList.remove('hidden');
    });

    suggestionsBox.addEventListener('click', function(e) {
        const option = e.target.closest('.equipment-option');
        if (!option) return;

        hiddenIdInput.value = option.getAttribute('data-id');
        searchInput.value = option.getAttribute('data-name');
        suggestionsBox.classList.add('hidden');
    });

    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.classList.add('hidden');
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initAutocomplete();

    document.getElementById('createTicketForm')?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = document.getElementById('formMessage');
        const submitBtn = document.getElementById('submitBtn');

        const title = document.getElementById('ticketTitle').value.trim();
        const description = document.getElementById('ticketDescription').value.trim();
        const priority = document.getElementById('ticketPriority').value;
        const equipment_id = document.getElementById('selectedEquipmentId').value;

        if (!equipment_id) {
            message.textContent = "{{ __('Por favor, selecione um equipamento v├ílido a partir da lista de sugest├Áes.') }}";
            message.className = 'min-h-6 text-xs font-medium text-red-400';
            document.getElementById('equipmentSearchInput').focus();
            return;
        }

        message.textContent = "{{ __('A guardar ticket...') }}";
        message.className = 'min-h-6 text-xs font-medium text-[var(--text-soft)]';
        submitBtn.disabled = true;

        try {
            const imageInput = document.getElementById('ticketImage');
            let res;

            if (imageInput.files && imageInput.files[0]) {
                const formData = new FormData();
                formData.append('title', title);
                formData.append('description', description);
                formData.append('priority', priority);
                formData.append('equipment_id', equipment_id);
                formData.append('image', imageInput.files[0]);

                const headers = authHeader();
                delete headers['Content-Type'];

                res = await fetch('/tickets', {
                    method: 'POST',
                    headers: headers,
                    body: formData
                });
            } else {
                res = await fetch('/tickets', {
                    method: 'POST',
                    headers: { ...authHeader(), 'Content-Type': 'application/json' },
                    body: JSON.stringify({ title, description, priority, equipment_id })
                });
            }

            const data = await res.json().catch(() => ({}));

            if (!res.ok) {
                let errorText = data.message || "{{ __('Erro ao criar ticket.') }}";
                if (data.errors) {
                    errorText = Object.values(data.errors).flat().join(' ');
                }
                throw new Error(errorText);
            }

            message.textContent = "{{ __('Ticket criado com sucesso!') }}";
            message.className = 'min-h-6 text-xs font-medium text-emerald-400';
            setTimeout(() => { window.location.href = '/ui/tickets'; }, 1500);
        } catch (err) {
            message.textContent = err.message;
            message.className = 'min-h-6 text-xs font-medium text-red-400';
            submitBtn.disabled = false;
        }
    });
});
</script>
@endpush




