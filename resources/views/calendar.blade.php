@extends('ui.layout')

@push('styles')
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">
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
        --fc-today-bg-color: rgba(79, 70, 229, 0.05);

        /* Mapeamento de Cores dos Botões para o Design System */
        --fc-button-bg-color: var(--surface);
        --fc-button-border-color: var(--border);
        --fc-button-hover-bg-color: var(--surface-2);
        --fc-button-hover-border-color: var(--border);
        --fc-button-active-bg-color: var(--primary);
        --fc-button-active-border-color: var(--primary);
        --fc-button-text-color: var(--text);

        color: var(--text);
        font-family: 'Inter', ui-sans-serif, system-ui, sans-serif !important;
    }

    .dark .fc {
        --fc-today-bg-color: rgba(129, 140, 248, 0.08);
        --fc-button-active-bg-color: var(--surface-2);
        --fc-button-active-border-color: var(--border);
    }

    /* Estrutura do Topbar do Calendário */
    .fc-toolbar {
        margin-bottom: 2.5rem !important;
        gap: 16px;
    }

    .fc-toolbar-title {
        font-size: 1.5rem !important;
        font-weight: 800 !important;
        letter-spacing: -0.02em;
        color: var(--text);
    }

    @media (min-width: 768px) {
        .fc-toolbar-title { font-size: 1.85rem !important; }
    }

    /* Botões de Navegação e Modos de Vista */
    .fc-button {
        border-radius: 12px !important;
        padding: 0.65rem 1.2rem !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        text-transform: capitalize !important;
        transition: all 0.2s ease !important;
        box-shadow: var(--shadow-sm) !important;
        color: var(--text) !important;
    }

    .fc-button-primary:not(:disabled).fc-button-active,
    .fc-button-primary:not(:disabled):active {
        color: var(--on-primary) !important;
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
    }

    .dark .fc-button-primary:not(:disabled).fc-button-active,
    .dark .fc-button-primary:not(:disabled):active {
        color: var(--on-primary) !important;
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
    }

    /* Grelha Principal do Calendário */
    .fc-scrollgrid {
        border: 1px solid var(--border) !important;
        border-radius: 24px !important;
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
        padding: 16px 12px !important;
        color: var(--text) !important;
        font-weight: 700;
        font-size: 13px;
        text-decoration: none !important;
    }

    /* Células de Dias Individuais */
    .fc-daygrid-day-number {
        padding: 16px !important;
        color: var(--text) !important;
        text-decoration: none !important;
        font-weight: 700;
        font-size: 14px;
    }

    .fc-daygrid-day:hover {
        background: var(--surface-2);
        cursor: pointer;
    }

    /* Estilização Bento dos Eventos Técnicos adaptada ao Design System */
    .fc-event {
        border: none !important;
        background: linear-gradient(135deg, var(--primary), var(--primary-hover)) !important;
        color: var(--on-primary) !important;
        border-radius: 8px !important;
        padding: 6px 10px !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 6px rgba(79, 70, 229, 0.12);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .dark .fc-event {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }

    .fc-event:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 12px rgba(79, 70, 229, 0.22);
    }

    .fc-timegrid-slot {
        height: 4rem !important;
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
@component('ui.partials.page-card', [
    'title' => __('Calendário Operacional'),
    'subtitle' => __('Visualize intervenções técnicas, manutenção preventiva, tickets programados e tarefas operacionais numa única interface integrada.'),
    'actions' => '<div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
            <a href="/ui" class="w-full sm:w-auto inline-flex items-center justify-center px-4.5 py-2.5 bg-[var(--surface)] text-sm font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all min-h-[44px]">
                <svg class="w-4 h-4 mr-2 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                </svg>
                ' . __('Dashboard') . '
            </a>
            <button onclick="calendar.today()" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-primary text-sm font-bold text-[var(--on-primary)] border border-transparent rounded-xl shadow-sm hover:opacity-90 transition-all min-h-[44px] cursor-pointer">
                ' . __('Hoje') . '
            </button>
        </div>',
])

<div class="space-y-12 lg:space-y-16 animate-[fadeIn_0.2s_ease-out]">

    {{-- Grelha de Conteúdo Principal --}}
    <div class="grid xl:grid-cols-4 gap-8 lg:gap-10">

        {{-- Painel de Resumo Lateral --}}
        <div class="bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 shadow-sm h-fit space-y-8">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.14em] text-primary">
                    <span class="h-2 w-2 rounded-full bg-primary animate-pulse"></span>
                    {{ __('Agenda Inteligente') }}
                </span>
                <h3 class="font-bold text-xl text-[var(--text)] mt-4">
                    {{ __('Resumo Operacional') }}
                </h3>
                <p class="text-xs text-[var(--text-soft)] mt-1.5">{{ __('Métricas da agenda atual') }}</p>
            </div>

            <hr class="border-[var(--border)]">

            <div class="grid grid-cols-2 xl:grid-cols-1 gap-6 lg:gap-8">
                <div class="p-6 bg-[var(--surface-2)] border border-[var(--border)] rounded-2xl">
                    <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                        {{ __('Total de Eventos') }}
                    </p>
                    <p class="text-4xl font-black text-[var(--text)] mt-2" id="eventsTotal">
                        --
                    </p>
                </div>

                <div class="p-6 bg-[var(--surface-2)] border border-[var(--border)] rounded-2xl">
                    <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                        {{ __('Este Mês') }}
                    </p>
                    <p class="text-4xl font-black text-[var(--text)] mt-2" id="monthTotal">
                        --
                    </p>
                </div>
            </div>

            <div class="p-6 border border-[var(--border)] rounded-2xl bg-opacity-40 bg-[var(--surface-2)]">
                <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                    {{ __('Próxima Intervenção') }}
                </p>
                <div class="flex items-center gap-3 mt-3">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-primary"></span>
                    </span>
                    <p class="text-sm font-semibold text-[var(--text)]">
                        {{ __('Sincronização Ativa') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Contentor da Instância do Calendário --}}
        <div class="xl:col-span-3 bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 lg:p-10 shadow-sm">
            <div id="calendar"></div>
        </div>

    </div>
</div>
@endcomponent
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

    // Garantir que o container existe mesmo antes de renderizar
    if (calendarEl) {
        calendar = new FullCalendar.Calendar(calendarEl, {
            locale: "{{ app()->getLocale() === 'en' ? 'en' : 'pt' }}",
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
                today: "{{ __('Hoje') }}",
                month: "{{ __('Mês') }}",
                week: "{{ __('Semana') }}",
                day: "{{ __('Dia') }}"
            },

            headerToolbar: {
                left: "prev,next",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay"
            },

            datesSet: function(dateInfo) {
                if (calendar && typeof calendar.refetchEvents === 'function') {
                    // Atualiza os totais e recarrega os dados da rota /calendar/events
                }
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

                    // Atualiza o total absoluto no painel lateral
                    const totalEl = document.getElementById("eventsTotal");
                    if (totalEl) totalEl.innerText = events.length;

                    // Determinar dinamicamente o mês em visualização ativa
                    const currentPeriod = calendar ? calendar.getDate() : fetchInfo.start;
                    const activeMonth = currentPeriod.getMonth();
                    const activeYear = currentPeriod.getFullYear();

                    // Filtrar eventos do mês ativo na vista do utilizador
                    const totalMonth = events.filter(e => {
                        const eventDate = new Date(e.start);
                        return eventDate.getMonth() === activeMonth && eventDate.getFullYear() === activeYear;
                    }).length;

                    const monthEl = document.getElementById("monthTotal");
                    if (monthEl) monthEl.innerText = totalMonth;

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

                alert(
                    `🔧 ${"{{ __('DETALHES DA INTERVENÇÃO') }}"}\n\n` +
                    `${"{{ __('Assunto') }}"}: ${info.event.title}\n` +
                    `${"{{ __('Início') }}"}: ${start}\n` +
                    `${"{{ __('Fim') }}"}: ${end}`
                );
            },

            loading(isLoading) {
                document.body.style.cursor = isLoading ? "progress" : "default";
            }
        });

        calendar.render();
    }
});
</script>
@endpush
