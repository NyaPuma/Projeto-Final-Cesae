@extends('ui.layout')

@push('styles')
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

<style>
    /* ==========================================================\
       FULLCALENDAR - ENTERPRISE CUSTOM STYLING
    ========================================================== */
    .fc {
        --fc-border-color: var(--border);
        --fc-page-bg-color: transparent;
        --fc-neutral-bg-color: transparent;
        --fc-list-event-hover-bg-color: var(--surface-2);
        --fc-today-bg-color: rgba(245, 158, 11, 0.06);

        /* Mapeamento de Cores dos Botões para o Design System */
        --fc-button-bg-color: var(--surface);
        --fc-button-border-color: var(--border);
        --fc-button-hover-bg-color: var(--surface-2);
        --fc-button-hover-border-color: var(--border);
        --fc-button-active-bg-color: var(--text);
        --fc-button-active-border-color: var(--text);
        --fc-button-text-color: var(--text);

        color: var(--text);
        font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif !important;
    }

    .dark .fc {
        --fc-today-bg-color: rgba(251, 191, 36, 0.08);
        --fc-button-active-bg-color: var(--surface-2);
        --fc-button-active-border-color: var(--border);
    }

    /* Estrutura do Topbar do Calendário */
    .fc-toolbar {
        margin-bottom: 2rem !important;
        gap: 12px;
    }

    .fc-toolbar-title {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        letter-spacing: -0.02em;
        color: var(--text);
    }

    @media (min-width: 768px) {
        .fc-toolbar-title { font-size: 1.85rem !important; }
    }

    /* Botões de Navegação e Modos de Vista */
    .fc-button {
        border-radius: 12px !important;
        padding: 0.55rem 1rem !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        text-transform: capitalize !important;
        transition: all 0.2s ease !important;
        box-shadow: var(--shadow-sm) !important;
        color: var(--text) !important;
    }

    .fc-button-primary:not(:disabled).fc-button-active,
    .fc-button-primary:not(:disabled):active {
        color: var(--bg) !important;
        background-color: var(--text) !important;
    }

    .dark .fc-button-primary:not(:disabled).fc-button-active,
    .dark .fc-button-primary:not(:disabled):active {
        color: var(--text) !important;
        background-color: var(--surface-2) !important;
    }

    /* Grelha Principal do Calendário */
    .fc-scrollgrid {
        border: 1px solid var(--border) !important;
        border-radius: 16px;
        overflow: hidden;
        background: var(--surface);
    }

    .fc-theme-standard td,
    .fc-theme-standard th {
        border-color: var(--border) !important;
    }

    /* Cabeçalhos de Dias da Semana */
    .fc-col-header-cell {
        background: var(--surface-2);
    }

    .fc-col-header-cell-cushion {
        padding: 12px !important;
        color: var(--text-soft) !important;
        font-weight: 600;
        font-size: 13px;
        text-decoration: none !important;
    }

    /* Células de Dias Individuais */
    .fc-daygrid-day-number {
        padding: 12px !important;
        color: var(--text) !important;
        text-decoration: none !important;
        font-weight: 600;
        font-size: 14px;
    }

    .fc-daygrid-day:hover {
        background: var(--surface-2);
        cursor: pointer;
    }

    /* Estilização Bento dos Eventos Técnicos */
    .fc-event {
        border: none !important;
        background: linear-gradient(135deg, #f59e0b, #ea580c) !important;
        color: #ffffff !important;
        border-radius: 8px !important;
        padding: 4px 8px !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        box-shadow: 0 2px 4px rgba(234, 88, 12, 0.15);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .dark .fc-event {
        background: linear-gradient(135deg, #fbbf24, #d97706) !important;
        color: #111827 !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .fc-event:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(234, 88, 12, 0.25);
    }

    .fc-timegrid-slot {
        height: 3.5rem !important;
    }

    .fc-timegrid-now-indicator-line {
        border-color: #ef4444 !important;
    }
</style>
@endpush

@push('scripts-top')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/pt.min.js"></script>
@endpush

@section('content')
<div class="space-y-10 animate-[fadeIn_0.2s_ease-out]">

    {{-- Cabeçalho da Página --}}
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
        <div>
            <span class="badge badge-warning">
                Agenda Inteligente
            </span>
            <h1 class="text-4xl lg:text-5xl font-black tracking-tight text-[var(--text)] mt-4">
                Calendário Operacional
            </h1>
            <p class="mt-3 text-[var(--text-soft)] max-w-3xl text-base lg:text-lg leading-relaxed">
                Visualize intervenções técnicas, manutenção preventiva, tickets programados e tarefas operacionais numa única interface integrada.
            </p>
        </div>

        <div class="flex items-center gap-3 w-full sm:w-auto">
            <a href="/ui" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2.5 bg-[var(--surface)] text-sm font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all">
                <svg class="w-4 h-4 mr-2 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                </svg>
                Dashboard
            </a>
            <button onclick="calendar.today()" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2.5 bg-[var(--text)] dark:bg-[var(--surface-2)] text-sm font-semibold text-[var(--surface)] dark:text-[var(--text)] border border-transparent dark:border-[var(--border)] rounded-xl shadow-sm hover:opacity-90 transition-all">
                Hoje
            </button>
        </div>
    </div>

    {{-- Grelha de Conteúdo Principal --}}
    <div class="grid xl:grid-cols-4 gap-8">

        {{-- Painel de Resumo Lateral --}}
        <div class="bg-[var(--surface)] border border-[var(--border)] rounded-2xl p-6 shadow-sm h-fit space-y-6">
            <div>
                <h3 class="font-bold text-lg text-[var(--text)]">
                    Resumo Operacional
                </h3>
                <p class="text-xs text-[var(--text-soft)] mt-1">Métricas da agenda atual</p>
            </div>

            <hr class="border-[var(--border)]">

            <div class="grid grid-cols-2 xl:grid-cols-1 gap-6">
                <div class="p-4 bg-[var(--surface-2)] border border-[var(--border)] rounded-xl">
                    <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                        Total de Eventos
                    </p>
                    <p class="text-3xl font-black text-[var(--text)] mt-1" id="eventsTotal">
                        --
                    </p>
                </div>

                <div class="p-4 bg-[var(--surface-2)] border border-[var(--border)] rounded-xl">
                    <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                        Este Mês
                    </p>
                    <p class="text-3xl font-black text-[var(--text)] mt-1" id="monthTotal">
                        --
                    </p>
                </div>
            </div>

            <div class="p-4 border border-[var(--border)] rounded-xl bg-opacity-40 bg-[var(--surface-2)]">
                <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                    Próxima Intervenção
                </p>
                <div class="flex items-center gap-2 mt-2">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[var(--color-primary)] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[var(--color-primary)]"></span>
                    </span>
                    <p class="text-sm font-medium text-[var(--text)]">
                        Sincronização Automática
                    </p>
                </div>
            </div>
        </div>

        {{-- Contentor da Instância do Calendário --}}
        <div class="xl:col-span-3 bg-[var(--surface)] border border-[var(--border)] rounded-2xl p-6 lg:p-8 shadow-sm">
            <div id="calendar"></div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
let calendar;

document.addEventListener('DOMContentLoaded', () => {
    if (!isAuthenticated()) {
        window.location.href = "/ui/login";
        return;
    }

    const calendarEl = document.getElementById("calendar");

    calendar = new FullCalendar.Calendar(calendarEl, {
        locale: "pt",
        initialView: "dayGridMonth",
        height: "auto",
        firstDay: 1, // Começa na Segunda-feira
        nowIndicator: true,
        navLinks: true,
        editable: false,
        selectable: true,
        expandRows: true,
        dayMaxEvents: true,
        weekends: true,

        buttonText: {
            today: "Hoje",
            month: "Mês",
            week: "Semana",
            day: "Dia"
        },

        headerToolbar: {
            left: "prev,next",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay"
        },

        events(fetchInfo, successCallback, failureCallback) {
            fetch("/calendar/events", {
                headers: authHeader()
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 401) {
                        window.location.href = "/ui/login";
                        return;
                    }
                    throw new Error("Erro ao carregar eventos da infraestrutura.");
                }
                return response.json();
            })
            .then(events => {
                if (!events) return;

                // Total absoluto de eventos planeados
                document.getElementById("eventsTotal").innerText = events.length;

                // Determinar dinamicamente o mês em visualização ativa
                const currentPeriod = calendar ? calendar.getDate() : fetchInfo.start;
                const activeMonth = currentPeriod.getMonth();
                const activeYear = currentPeriod.getFullYear();

                // Filtrar eventos do mês ativo na vista do utilizador
                const totalMonth = events.filter(e => {
                    const eventDate = new Date(e.start);
                    return eventDate.getMonth() === activeMonth && eventDate.getFullYear() === activeYear;
                }).length;

                document.getElementById("monthTotal").innerText = totalMonth;

                successCallback(events);
            })
            .catch(error => {
                console.error(error);
                failureCallback(error);
            });
        },

        eventDidMount(info) {
            info.el.style.cursor = "pointer";
            info.el.title = info.event.title;
        },

        eventClick(info) {
            const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
            const start = info.event.start ? info.event.start.toLocaleString("pt-PT", options) : "-";
            const end = info.event.end ? info.event.end.toLocaleString("pt-PT", options) : "-";

            // Detalhes estruturados no alerta operacional
            alert(
                `🔧 DETALHES DA INTERVENÇÃO\n\n` +
                `Assunto: ${info.event.title}\n` +
                `Início: ${start}\n` +
                `Fim: ${end}`
            );
        },

        loading(isLoading) {
            document.body.style.cursor = isLoading ? "progress" : "default";
        }
    });

    calendar.render();

    // Re-executar filtro de contagem de eventos quando o utilizador muda o mês/semana
    calendar.on('datesSet', () => {
        calendar.refetchEvents();
    });
});
</script>
@endpush
