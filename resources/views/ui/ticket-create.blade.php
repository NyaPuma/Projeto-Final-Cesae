@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => 'Criar Ticket',
    'subtitle' => 'Registe uma nova ocorrência de manutenção com contexto técnico e prioridade.',
    'actions' => '<a href="/ui/tickets" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all">← Voltar aos tickets</a>'
])
    <div class="mx-auto max-w-3xl rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-8 shadow-sm">
        <h2 class="text-xl font-semibold text-[var(--text)]">Novo pedido de intervenção</h2>
        <p class="mt-2 text-sm text-[var(--text-soft)]">Descreva a situação de forma objetiva para que a equipa técnica possa agir rapidamente.</p>

        <form id="createTicketForm" class="mt-8 space-y-6" novalidate>
            <div>
                <label for="ticketTitle" class="mb-2 block text-[10px] font-bold uppercase tracking-[0.18em] text-[var(--text-soft)]">Título</label>
                <input id="ticketTitle" name="title" type="text" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] focus:border-primary focus:outline-none">
            </div>

            <div>
                <label for="ticketDescription" class="mb-2 block text-[10px] font-bold uppercase tracking-[0.18em] text-[var(--text-soft)]">Descrição</label>
                <textarea id="ticketDescription" name="description" rows="6" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] focus:border-primary focus:outline-none"></textarea>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="ticketPriority" class="mb-2 block text-[10px] font-bold uppercase tracking-[0.18em] text-[var(--text-soft)]">Prioridade</label>
                    <select id="ticketPriority" name="priority" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] focus:border-primary focus:outline-none">
                        <option value="baixa">Baixa</option>
                        <option value="média" selected>Média</option>
                        <option value="alta">Alta</option>
                        <option value="crítica">Crítica</option>
                    </select>
                </div>

                <div>
                    <label for="ticketEquipmentId" class="mb-2 block text-[10px] font-bold uppercase tracking-[0.18em] text-[var(--text-soft)]">ID do Equipamento (opcional)</label>
                    <input id="ticketEquipmentId" name="equipment_id" type="number" min="1" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] focus:border-primary focus:outline-none">
                </div>
            </div>

            <div id="ticketMessage" class="min-h-6 text-sm font-medium text-[var(--text-soft)]"></div>

            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-primary px-5 py-3 text-sm font-semibold text-black shadow-sm shadow-primary/20 transition hover:opacity-90">
                Guardar ticket
            </button>
        </form>
    </div>
@endcomponent
@endsection

@push('scripts')
<script>
function authHeader() {
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json', 'Content-Type': 'application/json' };
    if (token) headers['X-Auth-Token'] = token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;
    return headers;
}

async function handleCreateTicket(event) {
    event.preventDefault();
    const form = document.getElementById('createTicketForm');
    const message = document.getElementById('ticketMessage');
    const payload = {
        title: document.getElementById('ticketTitle').value.trim(),
        description: document.getElementById('ticketDescription').value.trim(),
        priority: document.getElementById('ticketPriority').value,
    };
    const equipmentId = document.getElementById('ticketEquipmentId').value;
    if (equipmentId) payload.equipment_id = Number(equipmentId);

    if (!payload.title || !payload.description) {
        message.textContent = 'Preencha título e descrição para criar o ticket.';
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
        return;
    }

    message.textContent = 'A criar ticket...';
    message.className = 'min-h-6 text-sm font-medium text-[var(--text-soft)]';
    form.querySelector('button[type="submit"]').disabled = true;

    try {
        const res = await fetch('/tickets', {
            method: 'POST',
            headers: authHeader(),
            body: JSON.stringify(payload)
        });
        const data = await res.json().catch(() => ({}));
        if (!res.ok) {
            throw new Error(data.message || 'Não foi possível criar o ticket.');
        }
        window.location.href = '/ui/tickets';
    } catch (error) {
        message.textContent = error.message || 'Não foi possível criar o ticket.';
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
        form.querySelector('button[type="submit"]').disabled = false;
    }
}

document.getElementById('createTicketForm').addEventListener('submit', handleCreateTicket);
</script>
@endpush
