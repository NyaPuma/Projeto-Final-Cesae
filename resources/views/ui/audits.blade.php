@extends('ui.layout')

@section('content')

<script>
// Garante que o utilizador está autenticado antes de carregar o conteúdo da página
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => 'Auditoria',
    'subtitle' => 'Monitorização completa das operações efetuadas pelos utilizadores e pelos processos automáticos do sistema.',
    'actions' => '
        <a href="/ui" class="btn btn-secondary">
            📊 Dashboard
        </a>
    '
])

<div class="space-y-10">

    {{-- SECÇÃO DE FILTROS E PESQUISA --}}
    <section>
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-bold tracking-tight">Pesquisa</h2>
                <p class="text-sm text-soft mt-1">Filtre rapidamente qualquer registo de auditoria em tempo real.</p>
            </div>
            <span class="badge badge-warning">Últimos 200 registos</span>
        </div>

        <div class="card p-6">
            <div class="grid gap-6 lg:grid-cols-4">
                <div class="lg:col-span-3">
                    <label for="auditsSearch" class="block text-sm font-semibold mb-2">Pesquisa Geral</label>
                    <input
                        id="auditsSearch"
                        type="text"
                        placeholder="Pesquise por utilizador, entidade, operação ou ID do log..."
                        class="input">
                </div>
                <div>
                    <label for="auditsEvent" class="block text-sm font-semibold mb-2">Filtrar por Evento</label>
                    <select id="auditsEvent" class="input">
                        <option value="">Todos os eventos</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    {{-- SECÇÃO DA TABELA DE REGISTOS --}}
    <section>
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-bold tracking-tight">Registos de Atividade</h2>
                <p class="text-sm text-soft mt-1">Histórico cronológico detalhado das alterações efetuadas no ecossistema.</p>
            </div>
            <span class="badge badge-success">Live</span>
        </div>

        <div class="card overflow-hidden p-0">
            <div class="overflow-x-auto">
                <table id="auditsTable" class="w-full min-w-[1350px]">
                    <thead>
                        <tr class="border-b border-[var(--border)] bg-[var(--surface-2)]">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.12em]">Log</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.12em]">Utilizador / Operador</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.12em]">Entidade</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.12em]">Referência</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.12em]">Evento</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.12em]">Estado Anterior</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.12em]">Novo Estado</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-[0.12em]">Data</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border)]">
                        {{-- Estado Inicial de Carregamento (Spinner Animado) --}}
                        <tr>
                            <td colspan="8" class="py-24 text-center">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <svg class="h-6 w-6 animate-spin text-[var(--color-primary)]" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                                        <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.37 0 0 5.37 0 12h4z"></path>
                                    </svg>
                                    <div class="space-y-1">
                                        <p class="text-sm font-medium">A carregar registos de auditoria...</p>
                                        <p class="text-xs text-soft">A sincronizar com os eventos mais recentes do sistema.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</div>

@endcomponent

@endsection

@push('scripts')
<script>
// Memória local para os registos vindos do servidor
let allAudits = [];

document.addEventListener('DOMContentLoaded', () => {
    fetchAudits();
    setupFilters();
});

/**
 * Procura os dados na API interna do Laravel utilizando as credenciais guardadas
 */
async function fetchAudits() {
    try {
        // Faz uso do helper HTTP global configurado no seu bootstrap.js
        const response = await window.api.get('/api/audits', {
            headers: typeof authHeader === 'function' ? authHeader() : {}
        });

        // Assume o array de dados retornado pelo Axios
        allAudits = response.data || [];

        populateEventFilter(allAudits);
        renderAudits(allAudits);
    } catch (error) {
        console.error('Erro ao ir buscar a auditoria:', error);
        if (typeof window.showToast === 'function') {
            window.showToast('Não foi possível carregar os registos de auditoria.', 'error');
        }
        renderErrorState();
    }
}

/**
 * Retorna o Badge HTML correto formatado de acordo com o tipo de evento detetado
 */
function getEventBadge(event) {
    const value = String(event || "").toLowerCase().trim();

    if (value.includes('create') || value.includes('criar') || value.includes('insert')) {
        return `<span class="badge badge-success">Criar</span>`;
    }
    if (value.includes('update') || value.includes('editar') || value.includes('atualizar')) {
        return `<span class="badge badge-warning">Editar</span>`;
    }
    if (value.includes('delete') || value.includes('eliminar') || value.includes('remover')) {
        return `<span class="badge badge-danger">Eliminar</span>`;
    }

    // Caso seja um evento costumizado
    return `<span class="badge border-soft surface-2 text-soft">${event}</span>`;
}

/**
 * Formata os blocos de estado JSON estruturados ou dados textuais simples
 */
function formatStateData(state) {
    if (!state) return `<span class="text-soft font-mono">-</span>`;

    // Se já for um objeto estruturado
    if (typeof state === 'object') {
        return `<pre class="text-xs font-mono max-w-xs overflow-x-auto bg-[var(--surface-2)] p-2 rounded-lg text-soft border border-[var(--border)]">${JSON.stringify(state, null, 2)}</pre>`;
    }

    // Tenta interpretar se vier formatado como String de JSON do servidor
    try {
        const parsed = JSON.parse(state);
        return `<pre class="text-xs font-mono max-w-xs overflow-x-auto bg-[var(--surface-2)] p-2 rounded-lg text-soft border border-[var(--border)]">${JSON.stringify(parsed, null, 2)}</pre>`;
    } catch (e) {
        return `<span class="text-xs font-mono break-all line-clamp-2" title="${state}">${state}</span>`;
    }
}

/**
 * Preenche o elemento select de forma dinâmica baseado nos tipos existentes nos resultados
 */
function populateEventFilter(audits) {
    const eventSelect = document.getElementById('auditsEvent');
    if (!eventSelect) return;

    // Guarda e isola termos únicos de eventos
    const uniqueEvents = [...new Set(audits.map(item => String(item.event || '').trim()))].filter(Boolean);

    eventSelect.innerHTML = '<option value="">Todos os eventos</option>';

    uniqueEvents.forEach(ev => {
        const option = document.createElement('option');
        option.value = ev.toLowerCase();
        option.textContent = ev.charAt(0).toUpperCase() + ev.slice(1);
        eventSelect.appendChild(option);
    });
}

/**
 * Configura os listeners de input para aplicar os filtros instantaneamente (Client-Side filtering)
 */
function setupFilters() {
    const searchInput = document.getElementById('auditsSearch');
    const eventSelect = document.getElementById('auditsEvent');

    const triggerFilter = () => {
        const query = (searchInput?.value || '').toLowerCase().trim();
        const selectedEvent = (eventSelect?.value || '').toLowerCase();

        const filteredResults = allAudits.filter(audit => {
            const matchesSearch =
                String(audit.id || '').toLowerCase().includes(query) ||
                String(audit.user || audit.username || audit.operator || '').toLowerCase().includes(query) ||
                String(audit.auditable_type || audit.entity || '').toLowerCase().includes(query) ||
                String(audit.auditable_id || audit.reference || '').toLowerCase().includes(query);

            const matchesEvent = !selectedEvent || String(audit.event || '').toLowerCase() === selectedEvent;

            return matchesSearch && matchesEvent;
        });

        renderAudits(filteredResults);
    };

    searchInput?.addEventListener('input', triggerFilter);
    eventSelect?.addEventListener('change', triggerFilter);
}

/**
 * Injeta dinamicamente as linhas renderizadas dentro do corpo da tabela
 */
function renderAudits(audits) {
    const tbody = document.querySelector('#auditsTable tbody');
    if (!tbody) return;

    if (audits.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="py-16 text-center text-soft">
                    Nenhum registo de auditoria encontrado correspondente aos filtros atuais.
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = audits.map(audit => {
        const logId = audit.id ? `#${audit.id}` : '-';
        const user = audit.user || audit.username || audit.operator || 'Sistema / Automático';
        const entity = audit.auditable_type || audit.entity || 'Geral';
        const reference = audit.auditable_id || audit.reference ? `ID: ${audit.auditable_id || audit.reference}` : '-';
        const badge = getEventBadge(audit.event);
        const oldState = formatStateData(audit.old_values || audit.old_state);
        const newState = formatStateData(audit.new_values || audit.new_state);

        // Formatação nativa da data para o local de Portugal
        const dateFormatted = audit.created_at
            ? new Date(audit.created_at).toLocaleString('pt-PT', { hour12: false })
            : '-';

        return `
            <tr class="transition duration-150">
                <td class="px-6 py-4 font-mono text-xs text-soft">${logId}</td>
                <td class="px-6 py-4 font-semibold text-sm">${user}</td>
                <td class="px-6 py-4 text-sm text-soft">${entity}</td>
                <td class="px-6 py-4 font-mono text-xs">${reference}</td>
                <td class="px-6 py-4">${badge}</td>
                <td class="px-6 py-4">${oldState}</td>
                <td class="px-6 py-4">${newState}</td>
                <td class="px-6 py-4 text-right text-xs text-soft font-medium font-mono">${dateFormatted}</td>
            </tr>
        `;
    }).join('');
}

/**
 * Altera a tabela para um estado visual de falha de ligação
 */
function renderErrorState() {
    const tbody = document.querySelector('#auditsTable tbody');
    if (!tbody) return;

    tbody.innerHTML = `
        <tr>
            <td colspan="8" class="py-16 text-center text-[var(--color-danger)] font-medium">
                ⚠️ Erro ao sincronizar dados. Por favor, recarregue a página ou verifique a sua ligação.
            </td>
        </tr>
    `;
}
</script>
@endpush
