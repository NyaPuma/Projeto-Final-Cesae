@extends('ui.layout')

@push('styles')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <style>
        .fc-theme-standard td, .fc-theme-standard th {
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

        /* Estilização dos Eventos Técnicos adaptada ao Design System */
        .fc-event {
            border: none !important;
            background: var(--primary) !important;
            color: #ffffff !important;
            border-radius: 8px !important;
            padding: 6px 10px !important;
            font-size: 11px !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.12);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .dark .fc-event {
            background: var(--primary-hover) !important;
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

        /* Espaçamento entre os grupos de botões */
        .fc-toolbar-chunk {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Espaçamento entre cada botão individual */
        .fc .fc-button-group {
            display: flex;
            gap: 8px;
        }

        /* Remove a margem negativa que o FullCalendar aplica por defeito */
        .fc .fc-button-group>.fc-button {
            margin: 0 !important;
            border-radius: 12px !important;
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
        'subtitle' => __(
            'Visualize intervenções técnicas, manutenção preventiva, tickets programados e tarefas operacionais numa única interface integrada.'),
        'actions' =>
            '<div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                    <a href="/ui" class="w-full sm:w-auto inline-flex items-center justify-center px-4.5 py-2.5 bg-[var(--surface)] text-sm font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all min-h-[44px]">
                        <svg class="w-4 h-4 mr-2 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                        </svg>
                        ' .
            __('Dashboard') .
            '
                    </a>
                    <button onclick="calendar.today()" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-primary text-sm font-bold text-white border border-transparent rounded-xl shadow-sm hover:opacity-90 transition-all min-h-[44px] cursor-pointer">
                        ' .
            __('Hoje') .
            '
                    </button>
                </div>',
    ])
        <div class="space-y-12 lg:space-y-16 animate-[fadeIn_0.2s_ease-out]">

            {{-- Grelha de Conteúdo Principal --}}
            <div class="grid xl:grid-cols-4 gap-8 lg:gap-10">

                {{-- Painel de Resumo Lateral --}}
                <div class="bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 shadow-sm h-fit space-y-8"
                    aria-labelledby="summary-title">
                    <div>
                        <span
                            class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.14em] text-primary">
                            <span class="h-2 w-2 rounded-full bg-primary" aria-hidden="true"></span>
                            {{ __('Agenda Inteligente') }}
                        </span>
                        <h3 id="summary-title" class="mt-4 text-lg font-bold text-[var(--text)]">
                            {{ __('Resumo Operacional') }}
                        </h3>
                        <p class="text-xs text-[var(--text-soft)] mt-1.5">{{ __('Métricas da agenda atual') }}</p>
                    </div>

                    <hr class="border-[var(--border)]" aria-hidden="true">

                    <div class="grid grid-cols-2 xl:grid-cols-1 gap-6 lg:gap-8">
                        <div class="p-6 bg-[var(--surface-2)] border border-[var(--border)] rounded-2xl">
                            <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                                {{ __('Total de Eventos') }}
                            </p>
                            <p class="text-4xl font-black text-[var(--text)] mt-2" id="eventsTotal" aria-live="polite">
                                --
                            </p>
                        </div>

                        <div class="p-6 bg-[var(--surface-2)] border border-[var(--border)] rounded-2xl">
                            <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                                {{ __('Este Mês') }}
                            </p>
                            <p class="text-4xl font-black text-[var(--text)] mt-2" id="monthTotal" aria-live="polite">
                                --
                            </p>
                        </div>
                    </div>

                    <div class="p-6 border border-[var(--border)] rounded-2xl bg-opacity-40 bg-[var(--surface-2)]">
                        <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                            {{ __('Próxima Intervenção') }}
                        </p>
                        <div class="flex items-center gap-3 mt-3">
                            <span class="relative flex h-2.5 w-2.5" aria-hidden="true">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
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

    {{-- WCAG COMPLIANT DIALOG/MODAL --}}
    <div id="eventModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
        role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="relative w-full max-w-md bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 shadow-2xl animate-[fadeIn_0.15s_ease-out]"
            id="modalContent">
            <h3 id="modalTitle" class="text-lg font-bold text-[var(--text)] mb-2"></h3>

            <div class="space-y-4 my-6">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Início') }}
                    </p>
                    <p id="modalStart" class="text-sm font-medium text-[var(--text)]"></p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Fim') }}
                    </p>
                    <p id="modalEnd" class="text-sm font-medium text-[var(--text)]"></p>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <button onclick="closeModal()" id="closeModalBtn"
                    class="px-5 py-2.5 bg-[var(--surface-2)] hover:bg-[var(--border)] text-sm font-bold text-[var(--text)] border border-[var(--border)] rounded-xl transition-all cursor-pointer min-h-[44px]">
                    {{ __('Fechar') }}
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let calendar;
        let lastFocusedElement = null;

        function openModal(title, start, end) {
            lastFocusedElement = document.activeElement;

            document.getElementById('modalTitle').innerText = `🔧 ${title}`;
            document.getElementById('modalStart').innerText = start;
            document.getElementById('modalEnd').innerText = end;

            const modal = document.getElementById('eventModal');
            modal.classList.remove('hidden');

            setTimeout(() => {
                document.getElementById('closeModalBtn').focus();
            }, 50);

            document.addEventListener('keydown', handleEscapeKey);
        }

        function closeModal() {
            const modal = document.getElementById('eventModal');
            modal.classList.add('hidden');
            document.removeEventListener('keydown', handleEscapeKey);

            if (lastFocusedElement) {
                lastFocusedElement.focus();
            }
        }

        function handleEscapeKey(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (!isAuthenticated()) {
                window.location.href = "/ui/login";
                return;
            }

            const calendarEl = document.getElementById("calendar");

            if (calendarEl) {
                calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: "{{ app()->getLocale() === 'en' ? 'en' : 'pt' }}",
                    initialView: "dayGridMonth",
                    height: "auto",
                    firstDay: 1,
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
                            // Eventos atualizados dinamicamente
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

                                const totalEl = document.getElementById("eventsTotal");
                                if (totalEl) totalEl.innerText = events.length;

                                const currentPeriod = calendar ? calendar.getDate() : fetchInfo.start;
                                const activeMonth = currentPeriod.getMonth();
                                const activeYear = currentPeriod.getFullYear();

                                const totalMonth = events.filter(e => {
                                    const eventDate = new Date(e.start);
                                    return eventDate.getMonth() === activeMonth && eventDate
                                        .getFullYear() === activeYear;
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
                        info.el.setAttribute('tabindex', '0');
                        info.el.setAttribute('role', 'button');
                        info.el.setAttribute('aria-label', `${info.event.title}, clique para ver detalhes`);

                        info.el.addEventListener('keydown', (e) => {
                            if (e.key === 'Enter' || e.key === ' ') {
                                e.preventDefault();
                                info.el.click();
                            }
                        });
                    },

                    eventClick(info) {
                        const options = {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit'
                        };
                        const start = info.event.start ? info.event.start.toLocaleString("pt-PT", options) :
                            "-";
                        const end = info.event.end ? info.event.end.toLocaleString("pt-PT", options) : "-";

                        openModal(info.event.title, start, end);
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