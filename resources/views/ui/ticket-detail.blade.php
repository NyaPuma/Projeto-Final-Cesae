@extends('ui.layout')
@section('page_key', 'ticket-detail')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>


<x-ui.partials.page-card
    :title="__('Detalhes do Ticket')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="'/ui/tickets'" :label="__('Voltar à Listagem')" />
        </x-ui.page-actions.group>
    </x-slot:actions>
    
    <h1 id="pageMainTitle" class="hidden">{{ __('Detalhes do Ticket') }}</h1>

    {{-- Grelha Principal de Detalhes (1.2fr / 0.8fr) --}}
    <div class="grid gap-4 xl:grid-cols-[1.2fr_0.8fr] items-start">

        {{-- COLUNA ESQUERDA (Informa├º├úo Principal + Coment├írios + Evid├¬ncias) --}}
        <div class="space-y-4">

            {{-- 1. Cart├úo Principal do Ticket (Compacto) --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm space-y-3">
                
                {{-- Topo com Data de Cria├º├úo e Badge de Estado --}}
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2.5">
                    <span id="ticketCreatedAt" class="text-[9px] font-mono font-bold uppercase tracking-wider text-[var(--text-soft)]">
                        {{ __('CRIADO A: ÔÇö') }}
                    </span>
                    <div id="ticketStatusBadgeContainer"></div>
                </div>

                {{-- T├¡tulo e Descri├º├úo --}}
                <div>
                    <h2 id="ticketTitleText" class="text-base font-black text-[var(--text)]">ÔÇö</h2>
                    <div class="mt-2">
                        <span class="text-[9px] font-bold uppercase tracking-[0.15em] text-[var(--text-soft)] block mb-1">{{ __('Descri├º├úo do Problema') }}</span>
                        <div id="ticketDescriptionText" class="text-xs bg-[var(--surface-2)] p-3 rounded-xl text-[var(--text)] leading-relaxed whitespace-pre-wrap border border-[var(--border)]">
                            {{ __('A carregar descri├º├úo...') }}
                        </div>
                    </div>
                </div>

                {{-- Grelha de Atributos --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2 border-t border-[var(--border)]">
                    <div>
                        <span class="text-[8px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Prioridade') }}</span>
                        <div id="ticketPriorityBadge" class="mt-0.5"></div>
                    </div>
                    <div>
                        <span class="text-[8px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Equipamento') }}</span>
                        <p id="ticketEquipmentText" class="text-xs font-semibold mt-0.5 text-[var(--text)] truncate">ÔÇö</p>
                    </div>
                    <div>
                        <span class="text-[8px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Sala') }}</span>
                        <p id="ticketRoomText" class="text-xs font-semibold mt-0.5 text-[var(--text)] truncate">ÔÇö</p>
                    </div>
                    <div>
                        <span class="text-[8px] font-bold uppercase tracking-wider text-[var(--text-soft)] block">{{ __('Especialidade') }}</span>
                        <p id="ticketSpecialtyText" class="text-xs font-semibold mt-0.5 text-[var(--text)] truncate">ÔÇö</p>
                    </div>
                </div>
            </div>

            {{-- 2. Hist├│rico & Coment├írios --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)] border-b border-[var(--border)] pb-2">{{ __('Hist├│rico & Coment├írios') }}</h3>
                
                <div id="commentsSection" class="text-xs text-[var(--text-soft)] max-h-28 overflow-y-auto pr-1 space-y-2">
                    <p class="italic py-1 text-center text-[11px]">{{ __('A carregar hist├│rico...') }}</p>
                </div>

                <form id="commentForm" class="flex gap-2 items-center pt-2 border-t border-[var(--border)]">
                    <input id="commentText" type="text" required class="flex-1 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none focus:border-primary transition-all" placeholder="{{ __('Escreva uma mensagem...') }}">
                    <button type="submit" class="inline-flex items-center justify-center rounded-xl px-4 py-2 text-xs font-extrabold uppercase tracking-wider bg-primary text-white hover:opacity-90 transition shadow-sm cursor-pointer whitespace-nowrap">
                        {{ __('Enviar') }}
                    </button>
                </form>
            </div>

            {{-- 3. Evid├¬ncias Fotogr├íficas --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)]">{{ __('Evid├¬ncias Fotogr├íficas') }}</h3>
                    <span class="text-[9px] font-bold text-[var(--text-soft)] uppercase tracking-wider">Anexos</span>
                </div>
                
                <form id="photoForm" class="flex items-center gap-2 border-b border-[var(--border)] pb-3">
                    <label for="photoInput" class="cursor-pointer rounded-xl bg-[var(--surface-2)] border border-[var(--border)] px-3 py-1.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--border)] transition whitespace-nowrap">
                        ­ƒôÀ {{ __('Escolher') }}
                    </label>
                    <input id="photoInput" type="file" accept="image/*" class="hidden" onchange="updatePhotoName(this)">
                    <span id="photoFileName" class="text-xs text-[var(--text-soft)] truncate flex-1 block">{{ __('Nenhum ficheiro') }}</span>
                    
                    <button type="submit" class="py-1.5 px-3 bg-[var(--surface-2)] hover:bg-[var(--border)] text-xs font-bold text-[var(--text)] border border-[var(--border)] rounded-xl transition cursor-pointer whitespace-nowrap">
                        {{ __('Enviar') }}
                    </button>
                </form>

                <div id="photosSection" class="text-xs text-[var(--text-soft)]">
                    <p class="italic text-[11px]">{{ __('Nenhuma evid├¬ncia carregada.') }}</p>
                </div>
            </div>

        </div>

        {{-- COLUNA DIREITA (Pain├®is de A├º├úo / Controlo) --}}
        <div class="space-y-4">

            {{-- ­ƒææ PAINEL DE ADMINISTRA├ç├âO 1: Atribui├º├úo de T├®cnico --}}
            @if(isset($user) && $user && $user->isAdmin())
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-orange-500 bg-orange-500/10 border border-orange-500/20 rounded-lg">
                        {{ __('Painel do Admin') }}
                    </span>
                    <span id="adminTicketId" class="text-xs font-mono font-bold text-[var(--text-soft)]">#{{ $ticketId ?? $ticket->id ?? '' }}</span>
                </div>

                <div>
                    <h3 class="text-xs font-bold text-[var(--text)]">{{ __('Atribui├º├úo de T├®cnico') }}</h3>
                    <p class="text-[11px] text-[var(--text-soft)] mt-0.5 leading-tight">
                        {{ __('Defina manualmente o respons├ível ou solicite ├á IA para triagem autom├ítica.') }}
                    </p>
                </div>

                <div class="space-y-2 pt-1">
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)] mb-1">{{ __('ID do T├®cnico (Manual)') }}</label>
                        <select id="assignTechnicianSelect" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none cursor-pointer">
                            <option value="">{{ __('Ex: 12 (A carregar...)') }}</option>
                        </select>
                    </div>

                    <div class="space-y-2 pt-1">
                        <button id="btnAssignManual" type="button" class="w-full py-2 bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold rounded-xl border border-slate-700 shadow-sm transition cursor-pointer">
                            {{ __('Atribuir T├®cnico') }}
                        </button>

                        <button id="btnAssignAuto" type="button" class="w-full py-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-extrabold rounded-xl shadow-md transition cursor-pointer flex items-center justify-center gap-1.5">
                            Ô£¿ {{ __('Atribui├º├úo Autom├ítica (IA)') }}
                        </button>
                    </div>
                </div>
            </div>

            {{-- ­ƒææ PAINEL DE ADMINISTRA├ç├âO 2: Valida├º├úo Or├ºamental --}}
            <div id="adminBudgetApprovalCard" class="hidden rounded-2xl border border-amber-500/40 bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-amber-500 bg-amber-500/10 border border-amber-500/20 rounded-lg">
                        {{ __('Aprova├º├úo Or├ºamental') }}
                    </span>
                    <span id="pendingBudgetAmount" class="text-xs font-black text-amber-400">0.00 Ôé¼</span>
                </div>

                <div>
                    <h3 class="text-xs font-bold text-[var(--text)]">{{ __('Validar Or├ºamento Estimado') }}</h3>
                    <p class="text-[11px] text-[var(--text-soft)] mt-0.5 leading-tight">
                        {{ __('O t├®cnico submeteu um pedido de or├ºamento acima da autonomia. Decida a aprova├º├úo para autorizar o in├¡cio da repara├º├úo.') }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-2 pt-1">
                    <button type="button" onclick="decideBudget('approved')" class="py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl shadow-sm transition cursor-pointer flex items-center justify-center gap-1">
                        Ô£à {{ __('Validar Or├ºamento') }}
                    </button>
                    <button type="button" onclick="decideBudget('rejected')" class="py-2 bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold rounded-xl shadow-sm transition cursor-pointer flex items-center justify-center gap-1">
                        ÔØî {{ __('N├úo Validar') }}
                    </button>
                </div>
            </div>
            @endif

            {{-- ­ƒøá´©Å PAIN├ëIS DO T├ëCNICO --}}
            @if(isset($user) && $user && $user->isTechnician())
            
            {{-- 1. Assumir Ticket Livre (COM GATILHO ONCLICK DIRETO) --}}
            <div id="techClaimCard" class="hidden rounded-2xl border border-primary/30 bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <span class="text-[9px] font-bold uppercase tracking-widest text-primary bg-primary/10 px-2 py-0.5 rounded-lg">{{ __('Operacional') }}</span>
                    <span class="text-xs font-bold text-amber-500">{{ __('Livre') }}</span>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-[var(--text)]">{{ __('Assumir Ocorr├¬ncia') }}</h3>
                    <p class="text-[11px] text-[var(--text-soft)] mt-0.5 leading-tight">
                        {{ __('Este ticket encontra-se livre. Caso tenha disponibilidade na sua agenda, assuma a repara├º├úo.') }}
                    </p>
                </div>
                <button type="button" id="btnClaimTicket" onclick="claimTicket()" class="w-full inline-flex items-center justify-center rounded-xl py-2.5 text-xs font-black uppercase tracking-wider bg-primary text-white hover:opacity-90 shadow-md shadow-orange-500/20 transition cursor-pointer">
                    ­ƒöº {{ __('Assumir este Ticket') }}
                </button>
            </div>

            {{-- 2. Avalia├º├úo Or├ºamental Detalhada --}}
            <div id="techBudgetCard" class="hidden rounded-2xl border border-orange-500/30 bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)]">1. Avalia├º├úo Or├ºamental Detalhada</h3>
                </div>
                <p class="text-[11px] text-[var(--text-soft)] leading-tight">
                    {{ __('Introduza o or├ºamento estimado. Se o total exceder 100Ôé¼, o ticket aguardar├í autoriza├º├úo da Administra├º├úo.') }}
                </p>

                <form id="budgetForm" onsubmit="submitBudget(event)" class="space-y-3 pt-1">
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)] mb-1.5">{{ __('Itens do Or├ºamento') }}</label>
                        <div id="budgetItemsContainer" class="space-y-1.5 mb-2"></div>
                        <button type="button" onclick="addBudgetItemRow()" class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-bold text-orange-500 bg-orange-500/10 border border-orange-500/30 rounded-lg hover:bg-orange-500/20 transition cursor-pointer">
                            + {{ __('ADICIONAR ITEM') }}
                        </button>
                    </div>

                    <div class="p-2.5 bg-[var(--surface-2)] border border-[var(--border)] rounded-xl flex items-center justify-between">
                        <span class="text-[10px] font-bold uppercase text-[var(--text-soft)]">{{ __('Total Estimado') }}</span>
                        <span id="calculatedBudgetTotal" class="text-sm font-extrabold text-[var(--text)]">0.00 Ôé¼</span>
                    </div>

                    <input type="hidden" id="estimatedBudgetInput" name="estimatedBudget">

                    <button type="submit" class="w-full py-2.5 px-3 bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold rounded-xl shadow-sm transition cursor-pointer">
                        {{ __('Submeter Or├ºamento Detalhado') }}
                    </button>
                </form>

                <div class="pt-2 border-t border-[var(--border)]">
                    <button type="button" onclick="releaseTicket()" class="w-full py-2 px-3 bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/30 text-xs font-bold rounded-xl shadow-sm transition cursor-pointer flex items-center justify-center gap-1.5">
                        Ôå®´©Å {{ __('Devolver / Libertar Ocorr├¬ncia') }}
                    </button>
                </div>
            </div>

            {{-- 3. Aguardar Aprova├º├úo (>100Ôé¼) --}}
            <div id="techPendingApprovalCard" class="hidden rounded-2xl border border-amber-500/30 bg-amber-500/5 p-4 shadow-sm space-y-2 text-center">
                <div class="w-8 h-8 rounded-full bg-amber-500/10 text-amber-500 flex items-center justify-center mx-auto text-sm font-bold">ÔÅ│</div>
                <h3 class="text-xs font-bold text-[var(--text)]">{{ __('Aguardar Valida├º├úo Or├ºamental') }}</h3>
                <p class="text-[11px] text-[var(--text-soft)] leading-tight">
                    {{ __('O or├ºamento excede 100.00Ôé¼. O ticket aguarda aprova├º├úo da Administra├º├úo.') }}
                </p>
            </div>

            {{-- 4. Finaliza├º├úo da Interven├º├úo --}}
            <div id="techWorkCard" class="hidden rounded-2xl border border-emerald-500/30 bg-[var(--surface)] p-4 shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <span class="text-[9px] font-bold uppercase tracking-widest text-emerald-500 bg-emerald-500/10 px-2 py-0.5 rounded-lg">{{ __('A minha interven├º├úo') }}</span>
                    <span class="text-xs font-bold text-emerald-400">{{ __('Autorizado') }}</span>
                </div>
                <p class="text-[11px] text-[var(--text-soft)] leading-tight">
                    {{ __('Interven├º├úo autorizada. Conclua os trabalhos e registe os dados finais.') }}
                </p>
                
                <div class="space-y-2.5 pt-1">
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)] mb-1">{{ __('Custo Final (Ôé¼)') }}</label>
                        <input type="number" id="techTotalCost" step="0.01" placeholder="0.00" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-1.5 text-xs text-[var(--text)] font-mono">
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)] mb-1">{{ __('Relat├│rio T├®cnico') }}</label>
                        <textarea id="techFinalReport" rows="2" placeholder="{{ __('Descri├º├úo da repara├º├úo efetuada...') }}" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-1.5 text-xs text-[var(--text)] resize-none"></textarea>
                    </div>
                    <button type="button" id="btnFinishTicket" onclick="finishTicket()" class="w-full py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition cursor-pointer">
                        {{ __('Finalizar e Fechar Ticket') }}
                    </button>
                </div>
            </div>

            {{-- Modo Leitura --}}
            <div id="techReadOnlyCard" class="hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm space-y-2">
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2">
                    <span class="text-[9px] font-bold uppercase tracking-widest text-slate-400 bg-slate-500/10 px-2 py-0.5 rounded-lg">{{ __('Estado') }}</span>
                    <span class="text-xs font-bold text-amber-500">{{ __('Em Curso') }}</span>
                </div>
                <p class="text-xs text-[var(--text-soft)] text-center py-1">
                    {{ __('Atribu├¡do ao t├®cnico') }} <strong id="assignedTechName" class="text-[var(--text)]">ÔÇö</strong>.
                </p>
            </div>
            @endif

        </div>
    </div>

    <div id="ticketMessage" class="min-h-5 text-xs font-medium px-1"></div>
</x-ui.partials.page-card>
@endsection

@push('scripts')
<script>
const ticketId = {{ json_encode($ticketId ?? $ticket->id ?? null) }};
const currentUserId = {{ json_encode($user->id ?? null) }};

const priorityBadges = {
    baixa:   '<span class="inline-block px-2 py-0.5 rounded-lg text-[10px] font-black bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 uppercase">Baixa</span>',
    m├®dia:   '<span class="inline-block px-2 py-0.5 rounded-lg text-[10px] font-black bg-amber-500/10 text-amber-400 border border-amber-500/20 uppercase">M├®dia</span>',
    alta:    '<span class="inline-block px-2 py-0.5 rounded-lg text-[10px] font-black bg-red-500/15 text-red-500 border border-red-500/30 uppercase">Alta</span>',
    cr├¡tica: '<span class="inline-block px-2 py-0.5 rounded-lg text-[10px] font-black bg-purple-500/20 text-purple-400 border border-purple-500/30 uppercase">Cr├¡tica</span>'
};

function showMessage(msg, isError = false) {
    const el = document.getElementById('ticketMessage');
    if (!el) return;
    el.innerText = msg;
    el.className = `min-h-5 text-xs font-medium px-1 ${isError ? 'text-rose-400' : 'text-emerald-400'}`;
    setTimeout(() => { el.innerText = ''; }, 5000);
}

function authHeader() {
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };
    if (token) {
        headers['Authorization'] = 'Bearer ' + token;
        headers['X-Auth-Token'] = token;
    }
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;
    return headers;
}

function updatePhotoName(input) {
    const label = document.getElementById('photoFileName');
    label.textContent = input.files && input.files[0] ? input.files[0].name : "{{ __('Nenhum ficheiro') }}";
}

function addBudgetItemRow(desc = '', qty = 1, price = 0, type = 'labor') {
    const container = document.getElementById('budgetItemsContainer');
    if (!container) return;

    const rowId = 'budget_row_' + Date.now() + '_' + Math.floor(Math.random() * 1000);
    const div = document.createElement('div');
    div.id = rowId;
    div.className = "flex flex-wrap items-center gap-1.5 bg-[var(--surface-2)] p-1.5 rounded-xl border border-[var(--border)]";

    div.innerHTML = `
        <select name="type" class="rounded-lg border border-[var(--border)] bg-[var(--surface)] px-1.5 py-1 text-[11px] text-[var(--text)] outline-none">
            <option value="labor" ${type === 'labor' ? 'selected' : ''}>­ƒøá´©Å M. Obra</option>
            <option value="material" ${type === 'material' ? 'selected' : ''}>­ƒôª Material</option>
        </select>
        <input type="text" name="description" placeholder="Item" value="${desc}" required
            class="flex-1 min-w-[90px] rounded-lg border border-[var(--border)] bg-[var(--surface)] px-2 py-1 text-[11px] text-[var(--text)] outline-none">
        <input type="number" name="quantity" min="1" step="1" value="${qty}" required oninput="calculateBudgetTotal()"
            class="w-12 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-1 py-1 text-[11px] text-[var(--text)] text-center outline-none">
        <input type="number" name="unit_price" min="0" step="0.01" value="${price}" required oninput="calculateBudgetTotal()"
            class="w-16 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-1.5 py-1 text-[11px] text-[var(--text)] text-right outline-none">
        <button type="button" onclick="removeBudgetItemRow('${rowId}')" class="text-rose-400 hover:text-rose-500 font-bold px-1 text-xs cursor-pointer">&times;</button>
    `;

    container.appendChild(div);
    calculateBudgetTotal();
}

function removeBudgetItemRow(rowId) {
    const row = document.getElementById(rowId);
    if (row) {
        row.remove();
        calculateBudgetTotal();
    }
}

function calculateBudgetTotal() {
    const container = document.getElementById('budgetItemsContainer');
    if (!container) return;

    let total = 0;
    const rows = container.querySelectorAll('div[id^="budget_row_"]');
    rows.forEach(row => {
        const qtyVal = row.querySelector('input[name="quantity"]')?.value;
        const priceVal = row.querySelector('input[name="unit_price"]')?.value;
        const qty = parseFloat(qtyVal) || 0;
        const price = parseFloat(priceVal) || 0;
        total += (qty * price);
    });

    const formatted = total.toFixed(2);
    document.getElementById('calculatedBudgetTotal').innerText = formatted + ' Ôé¼';
    document.getElementById('estimatedBudgetInput').value = formatted;
}

async function submitBudget(e) {
    e.preventDefault();
    const container = document.getElementById('budgetItemsContainer');
    const rows = container.querySelectorAll('div[id^="budget_row_"]');
    
    if (rows.length === 0) {
        showMessage("{{ __('Adicione pelo menos um item ao or├ºamento.') }}", true);
        return;
    }

    const budget_details = [];
    rows.forEach(row => {
        const desc = row.querySelector('input[name="description"]')?.value || 'Item de repara├º├úo';
        const qty = parseFloat(row.querySelector('input[name="quantity"]')?.value) || 1;
        const price = parseFloat(row.querySelector('input[name="unit_price"]')?.value) || 0;
        const type = row.querySelector('select[name="type"]')?.value || 'labor';

        budget_details.push({
            type: type,
            description: desc,
            quantity: qty,
            unit_price: price
        });
    });

    calculateBudgetTotal();
    const estimatedBudget = parseFloat(document.getElementById('estimatedBudgetInput').value) || 0;

    if (estimatedBudget <= 0) {
        showMessage("{{ __('O valor total deve ser superior a 0.00Ôé¼.') }}", true);
        return;
    }

    try {
        const res = await fetch(`/tickets/${ticketId}/budget`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ estimatedBudget, budget_details })
        });

        const data = await res.json();

        if (res.ok) {
            showMessage(data.message || "{{ __('Or├ºamento submetido com sucesso!') }}");
            await fetchTicket();
        } else {
            showMessage(data.message || "{{ __('Erro ao submeter or├ºamento.') }}", true);
        }
    } catch (e) {
        showMessage("{{ __('Erro ao comunicar com o servidor.') }}", true);
    }
}

async function decideBudget(decision) {
    if (!confirm(decision === 'approved' ? "{{ __('Deseja APROVAR este or├ºamento?') }}" : "{{ __('Deseja RECUSAR este or├ºamento?') }}")) return;

    try {
        const res = await fetch(`/admin/tickets/${ticketId}/budget-decision`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ decision })
        });

        if (res.ok) {
            showMessage(decision === 'approved' ? "{{ __('Or├ºamento APROVADO com sucesso!') }}" : "{{ __('Or├ºamento RECUSADO.') }}");
            await fetchTicket();
        } else {
            showMessage("{{ __('Erro ao processar decis├úo or├ºamental.') }}", true);
        }
    } catch (e) {
        showMessage("{{ __('Erro de liga├º├úo com o servidor.') }}", true);
    }
}

async function finishTicket() {
    const cost = parseFloat(document.getElementById('techTotalCost').value || 0);
    const report = document.getElementById('techFinalReport').value.trim();

    try {
        const res = await fetch(`/tickets/${ticketId}/close`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ actual_cost: cost, report: report })
        });

        if (res.ok) {
            showMessage("{{ __('Ticket conclu├¡do e fechado com sucesso!') }}");
            await fetchTicket();
        } else {
            const err = await res.json();
            showMessage(err.message || "{{ __('Erro ao fechar o ticket.') }}", true);
        }
    } catch (e) {
        showMessage("{{ __('Erro de liga├º├úo.') }}", true);
    }
}

async function loadTechnicians() {
    const select = document.getElementById('assignTechnicianSelect');
    if (!select) return;
    try {
        const res = await fetch('/admin/users', { headers: authHeader() }).catch(() => fetch('/users', { headers: authHeader() }));
        if (res.ok) {
            const data = await res.json();
            const users = data.users?.data || data.users || data || [];
            const techs = users.filter(u => u.profile?.name === 'technician' || u.role === 'technician' || true);
            select.innerHTML = `<option value="">${"{{ __('Ex: 12 (Selecione...)') }}"}</option>` +
                techs.map(t => `<option value="${t.id}">${t.name} (ID #${t.id})</option>`).join('');
        }
    } catch (e) {
        select.innerHTML = `<option value="">Emanuel Silva (#12)</option>`;
    }
}

async function fetchTicket() {
    if (!ticketId) return;

    const res = await fetch('/tickets/' + ticketId, { headers: authHeader() });
    if (!res.ok) return;

    const data = await res.json();
    const ticket = data.ticket || data;

    // Dados gerais
    document.getElementById('pageMainTitle').innerText = `Detalhes do Ticket #${ticket.id}`;
    document.getElementById('ticketCreatedAt').innerText = `CRIADO A: ${ticket.created_at || 'ÔÇö'}`;
    document.getElementById('ticketTitleText').innerText = ticket.title || 'ÔÇö';
    document.getElementById('ticketDescriptionText').innerText = ticket.description || 'ÔÇö';

    document.getElementById('ticketPriorityBadge').innerHTML = priorityBadges[ticket.priority] || priorityBadges['m├®dia'];
    document.getElementById('ticketEquipmentText').innerText = ticket.equipment ? ticket.equipment.name : 'ÔÇö';
    document.getElementById('ticketRoomText').innerText = ticket.room ? ticket.room.name : 'ÔÇö';
    document.getElementById('ticketSpecialtyText').innerText = ticket.specialty || ticket.equipment?.specialty || 'Mec├ónica';

    const statusName = typeof ticket.status === 'object' ? ticket.status?.name : (ticket.status || 'Aberto');
    document.getElementById('ticketStatusBadgeContainer').innerHTML = `
        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-black bg-amber-500/10 text-amber-500 border border-amber-500/20 uppercase tracking-wider">
            ${statusName}
        </span>
    `;

    // CONTROLADOR DO FLUXO T├ëCNICO
    const assignedTechId = ticket.assigned_to || (ticket.technician ? ticket.technician.id : null);
    
    const techClaimCard = document.getElementById('techClaimCard');
    const techReadOnlyCard = document.getElementById('techReadOnlyCard');
    const techBudgetCard = document.getElementById('techBudgetCard');
    const techPendingApprovalCard = document.getElementById('techPendingApprovalCard');
    const techWorkCard = document.getElementById('techWorkCard');

    if (techClaimCard && techReadOnlyCard && techBudgetCard && techWorkCard && techPendingApprovalCard) {
        techClaimCard.classList.add('hidden');
        techReadOnlyCard.classList.add('hidden');
        techBudgetCard.classList.add('hidden');
        techPendingApprovalCard.classList.add('hidden');
        techWorkCard.classList.add('hidden');

        if (!assignedTechId) {
            techClaimCard.classList.remove('hidden');
        } else if (currentUserId && parseInt(assignedTechId) !== parseInt(currentUserId)) {
            document.getElementById('assignedTechName').innerText = ticket.technician ? `${ticket.technician.name} (#${ticket.technician.id})` : 'ÔÇö';
            techReadOnlyCard.classList.remove('hidden');
        } else {
            const statusSlug = (statusName || '').toLowerCase();
            const budgetStatus = ticket.budget_status;
            const hasRequestedBudget = ticket.budget_requested === true || ticket.budget_requested === 1;

            if (!hasRequestedBudget && (statusSlug.includes('abert') || statusSlug.includes('curso'))) {
                techBudgetCard.classList.remove('hidden');
                const container = document.getElementById('budgetItemsContainer');
                if (container && container.children.length === 0) {
                    addBudgetItemRow('Resolu├º├úo bug sistema', 1, 25, 'labor');
                }
            } else if (statusSlug.includes('pendente') || budgetStatus === 'pending') {
                techPendingApprovalCard.classList.remove('hidden');
            } else {
                techWorkCard.classList.remove('hidden');
            }
        }
    }

    // CONTROLADOR DO PAINEL DO ADMIN (Valida├º├úo de Or├ºamento)
    const adminBudgetCard = document.getElementById('adminBudgetApprovalCard');
    if (adminBudgetCard) {
        const statusSlug = (statusName || '').toLowerCase();
        if (statusSlug.includes('pendente') || ticket.budget_status === 'pending') {
            adminBudgetCard.classList.remove('hidden');
            document.getElementById('pendingBudgetAmount').innerText = (parseFloat(ticket.budget_amount) || 0).toFixed(2) + ' Ôé¼';
        } else {
            adminBudgetCard.classList.add('hidden');
        }
    }
}

async function claimTicket() {
    if (!confirm("{{ __('Deseja assumir este ticket?') }}")) return;
    try {
        const res = await fetch(`/tickets/${ticketId}/claim`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' }
        });

        if (res.ok) {
            showMessage("{{ __('Ticket assumido com sucesso!') }}");
            await fetchTicket();
        } else {
            const data = await res.json().catch(() => ({}));
            showMessage(data.message || "{{ __('Erro ao assumir o ticket.') }}", true);
        }
    } catch (e) {
        showMessage("{{ __('Erro de liga├º├úo.') }}", true);
    }
}

async function releaseTicket() {
    if (!confirm("{{ __('Tem a certeza que deseja libertar esta ocorr├¬ncia?') }}")) return;
    try {
        const res = await fetch(`/tickets/${ticketId}/release`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' }
        });

        if (res.ok) {
            showMessage("{{ __('Ocorr├¬ncia libertada com sucesso!') }}");
            await fetchTicket();
        } else {
            showMessage("{{ __('Erro ao libertar a ocorr├¬ncia.') }}", true);
        }
    } catch (e) {
        showMessage("{{ __('Erro de liga├º├úo.') }}", true);
    }
}

async function fetchComments() {
    const sec = document.getElementById('commentsSection');
    if (!sec) return;
    try {
        const res = await fetch(`/tickets/${ticketId}/comments`, { headers: authHeader() });
        if (!res.ok) return;
        const data = await res.json();
        const comments = data.comments || data;
        if (!comments || comments.length === 0) {
            sec.innerHTML = `<p class="italic py-2 text-center text-[var(--text-soft)]">{{ __('Nenhum coment├írio registado.') }}</p>`;
            return;
        }
        sec.innerHTML = comments.map(c => `
            <div class="border-b border-[var(--border)]/50 py-1.5 space-y-0.5">
                <div class="flex justify-between font-bold text-[var(--text)]">
                    <span>${c.user ? c.user.name : "{{ __('Sistema') }}"}</span>
                    <span class="font-mono text-[9px] text-[var(--text-soft)]">${c.created_at || ''}</span>
                </div>
                <p class="text-[var(--text-soft)] text-xs">${c.comment || c.message || ''}</p>
            </div>
        `).join('');
    } catch (e) {
        sec.innerHTML = `<p class="italic py-2 text-center text-[var(--text-soft)]">{{ __('Nenhum coment├írio registado.') }}</p>`;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    fetchTicket();
    fetchComments();
    loadTechnicians();

    // Event listener do formul├írio de coment├írios
    document.getElementById('commentForm')?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const text = document.getElementById('commentText').value.trim();
        if (!text) return;
        const res = await fetch(`/tickets/${ticketId}/comments`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ comment: text })
        });
        if (res.ok) {
            document.getElementById('commentText').value = '';
            fetchComments();
            showMessage("{{ __('Coment├írio enviado!') }}");
        }
    });

    // Event listeners para o painel de atribui├º├úo de Administrador
    document.getElementById('btnAssignManual')?.addEventListener('click', async () => {
        const techId = document.getElementById('assignTechnicianSelect')?.value;
        if (!techId) { showMessage("{{ __('Selecione um t├®cnico.') }}", true); return; }
        const res = await fetch(`/admin/tickets/${ticketId}/assign`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({ technician_id: techId })
        });
        if (res.ok) {
            showMessage("{{ __('T├®cnico atribu├¡do com sucesso!') }}");
            await fetchTicket();
        } else {
            showMessage("{{ __('Erro ao atribuir.') }}", true);
        }
    });

    document.getElementById('btnAssignAuto')?.addEventListener('click', async () => {
        const res = await fetch(`/admin/tickets/${ticketId}/assign`, {
            method: 'POST',
            headers: { ...authHeader(), 'Content-Type': 'application/json' },
            body: JSON.stringify({})
        });
        if (res.ok) {
            showMessage("{{ __('T├®cnico atribu├¡do automaticamente via IA!') }}");
            await fetchTicket();
        } else {
            showMessage("{{ __('Erro ao atribuir via IA.') }}", true);
        }
    });
});
</script>
@endpush
