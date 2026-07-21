@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Criar Ticket'),
    'subtitle' => __('Registe uma nova ocorrência de manutenção com contexto técnico e prioridade.'),
    'actions' => '<a href="/ui/tickets" class="inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">← ' . __('Voltar aos tickets') . '</a>'
])
    <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">

        <div class="mb-6">
            <h2 class="text-sm font-bold text-[var(--text)]">{{ __('Novo pedido de intervenção') }}</h2>
            <p class="text-xs text-[var(--text-soft)] mt-0.5">{{ __('Descreva a situação de forma objetiva para que a equipa técnica possa agir rapidamente.') }}</p>
        </div>

        <form id="createTicketForm" class="space-y-6">

            {{-- Título --}}
            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Título *') }}</label>
                <input type="text" id="ticketTitle" name="title" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="{{ __('Ex.: Ruído anómalo no motor principal do torno') }}">
            </div>

            {{-- Descrição --}}
            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Descrição *') }}</label>
                <textarea id="ticketDescription" name="description" rows="4" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 resize-none" placeholder="{{ __('Detalhe o problema ocorrido, ruídos, fugas ou comportamentos fora do normal...') }}"></textarea>
            </div>

            {{-- Nível de Urgência / Prioridade (Cards Interativos) --}}
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Nível de urgência / prioridade *') }}</label>
                    <span class="text-[11px] text-[var(--text-soft)]">{{ __('Selecione o impacto real na produção') }}</span>
                </div>

                <input type="hidden" id="ticketPriority" name="priority" value="media" required>

                <div class="grid gap-4 md:grid-cols-3">
                    {{-- Card Baixa --}}
                    <div type="button" data-priority="baixa" onclick="selectPriority('baixa')"
                        class="priority-card cursor-pointer rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 transition-all hover:border-emerald-500/50">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                                <span class="text-xs font-bold text-[var(--text)]">{{ __('Baixa') }}</span>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-emerald-500/40"></span>
                        </div>
                        <h4 class="text-xs font-semibold text-[var(--text)] mb-1">{{ __('Manutenção Ligeira') }}</h4>
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Anomalia menor. Máquina operacional sem risco imediato.') }}</p>
                    </div>

                    {{-- Card Média (Selecionado por defeito) --}}
                    <div type="button" data-priority="media" onclick="selectPriority('media')"
                        class="priority-card cursor-pointer rounded-2xl border-2 border-amber-500 bg-[var(--surface-2)] p-4 transition-all shadow-sm">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>
                                <span class="text-xs font-bold text-[var(--text)]">{{ __('Média') }}</span>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                        </div>
                        <h4 class="text-xs font-semibold text-[var(--text)] mb-1">{{ __('Degradação Parcial') }}</h4>
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Funcionamento condicionado. Existe alternativa na sala.') }}</p>
                    </div>

                    {{-- Card Alta --}}
                    <div type="button" data-priority="alta" onclick="selectPriority('alta')"
                        class="priority-card cursor-pointer rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 transition-all hover:border-red-500/50">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>
                                <span class="text-xs font-bold text-[var(--text)]">{{ __('Alta') }}</span>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-red-500/40"></span>
                        </div>
                        <h4 class="text-xs font-semibold text-[var(--text)] mb-1">{{ __('Paragem Crítica / Risco') }}</h4>
                        <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ __('Linha/Máquina inoperacional ou risco de segurança.') }}</p>
                    </div>
                </div>
            </div>

            {{-- Equipamento & Imagem --}}
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('ID do Equipamento (Opcional)') }}</label>
                    <input type="text" id="equipmentId" name="equipment_id" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="Ex.: EQ-073">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('Inserir Imagem (Opcional)') }}</label>
                    <div class="flex items-center gap-3 w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2.5">
                        <label for="ticketImage" class="cursor-pointer rounded-xl bg-[var(--surface)] border border-[var(--border)] px-3 py-1.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--surface-2)] transition">
                            {{ __('Escolher ficheiro') }}
                        </label>
                        <input type="file" id="ticketImage" accept="image/*" class="hidden" onchange="updateFileName(this)">
                        <span id="fileName" class="text-sm text-[var(--text-soft)] truncate">{{ __('Nenhum ficheiro selecionado') }}</span>
                    </div>
                </div>
            </div>

            {{-- Mensagem de Feedback --}}
            <div id="formMessage" class="min-h-6 text-sm font-medium text-[var(--text-soft)]"></div>

            {{-- Botão de Submissão --}}
            <div class="mt-6 flex flex-wrap gap-3">
                <button type="submit" id="submitBtn" class="ui-button ui-button--primary inline-flex items-center justify-center rounded-2xl px-6 py-3 text-sm font-bold transition hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg shadow-orange-500/20" style="background-color: #f97316; color: #ffffff;">{{ __('GUARDAR TICKET') }}</button>
            </div>
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

function selectPriority(priority) {
    document.getElementById('ticketPriority').value = priority;

    const cards = document.querySelectorAll('.priority-card');
    cards.forEach(card => {
        const cardPriority = card.getAttribute('data-priority');

        card.classList.remove('border-2', 'border-emerald-500', 'border-amber-500', 'border-red-500', 'shadow-sm');
        card.classList.add('border', 'border-[var(--border)]');

        if (cardPriority === priority) {
            card.classList.remove('border', 'border-[var(--border)]');
            card.classList.add('border-2', 'shadow-sm');
            if (priority === 'baixa') card.classList.add('border-emerald-500');
            if (priority === 'media') card.classList.add('border-amber-500');
            if (priority === 'alta') card.classList.add('border-red-500');
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

document.getElementById('createTicketForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const message = document.getElementById('formMessage');
    const submitBtn = document.getElementById('submitBtn');

    const title = document.getElementById('ticketTitle').value.trim();
    const description = document.getElementById('ticketDescription').value.trim();
    const priority = document.getElementById('ticketPriority').value;
    const equipment_id = document.getElementById('equipmentId').value.trim();

    message.textContent = "{{ __('A guardar ticket...') }}";
    message.className = 'min-h-6 text-sm font-medium text-[var(--text-soft)]';
    submitBtn.disabled = true;

    try {
        const res = await fetch('/api/tickets', {
            method: 'POST',
            headers: authHeader(),
            body: JSON.stringify({ title, description, priority, equipment_id })
        });

        const data = await res.json().catch(() => ({}));

        if (!res.ok) {
            let errorText = data.message || "{{ __('Erro ao criar ticket.') }}";
            if (data.errors) {
                errorText = Object.values(data.errors).flat().join(' ');
            }
            throw new Error(errorText);
        }

        message.textContent = "{{ __('Ticket criado com sucesso!') }}";
        message.className = 'min-h-6 text-sm font-medium text-emerald-600 dark:text-emerald-400';
        setTimeout(() => { window.location.href = '/ui/tickets'; }, 1500);
    } catch (err) {
        message.textContent = err.message;
        message.className = 'min-h-6 text-sm font-medium text-red-600 dark:text-red-400';
        submitBtn.disabled = false;
    }
});
</script>
@endpush
