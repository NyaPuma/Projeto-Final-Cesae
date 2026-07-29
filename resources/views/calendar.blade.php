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
            padding: 12px 16px !important;
            color: var(--text) !important;
            text-decoration: none !important;
            font-weight: 700;
            font-size: 14px;
        }

        .fc-daygrid-day:hover {
            background: var(--surface-2);
            cursor: pointer;
        }

        /* ✨ DIA ATUAL (Hoje): DESTAQUE CINZA NEUTRO ✨ */
        .fc-day-today {
            background: var(--surface-2) !important;
        }

        .fc-day-today .fc-daygrid-day-number {
            color: var(--text) !important;
            font-weight: 800 !important;
        }

        /* ✨ HIGHLIGHT DO DIA DE AGENDAMENTO (COM MANUTENÇÃO) ✨ */
        .fc-day-has-scheduled {
            background: rgba(249, 115, 22, 0.12) !important;
            border: 2px solid #f97316 !important;
            box-shadow: inset 0 0 10px rgba(249, 115, 22, 0.15) !important;
        }

        .dark .fc-day-has-scheduled {
            background: rgba(249, 115, 22, 0.22) !important;
            border: 2px solid #f97316 !important;
        }

        .fc-day-has-scheduled .fc-daygrid-day-number {
            color: #f97316 !important;
            font-size: 16px !important;
            font-weight: 900 !important;
        }

        /* ✨ EVENTOS DE MANUTENÇÃO DENTRO DO DIA ✨ */
        .fc-event {
            border: 1px solid rgba(249, 115, 22, 0.4) !important;
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%) !important;
            color: #ffffff !important;
            border-radius: 12px !important;
            padding: 6px 10px !important;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.28);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dark .fc-event {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        }

        .fc-event:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 22px rgba(249, 115, 22, 0.45);
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

        .fc .fc-button-group {
            display: flex;
            gap: 8px;
        }

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
                        ' . __('Dashboard') . '
                    </a>
                    ' . (auth()->check() && auth()->user()->isAdmin()
                        ? '<button onclick="openScheduleModal()" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-orange-500 hover:bg-orange-600 text-sm font-bold text-white rounded-xl shadow-md transition-all min-h-[44px] cursor-pointer">+ ' . __('Agendar Preventiva') . '</button>'
                        : '<button id="btnAdminSchedule" onclick="openScheduleModal()" class="hidden w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-orange-500 hover:bg-orange-600 text-sm font-bold text-white rounded-xl shadow-md transition-all min-h-[44px] cursor-pointer">+ ' . __('Agendar Preventiva') . '</button>') . '
                    <button onclick="calendar.today()" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-primary text-sm font-bold text-white border border-transparent rounded-xl shadow-sm hover:opacity-90 transition-all min-h-[44px] cursor-pointer">
                        ' . __('Hoje') . '
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

    {{-- MODAL DE DETALHES DE EVENTO --}}
    <div id="eventModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
        role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="relative w-full max-w-md bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 shadow-2xl animate-[fadeIn_0.15s_ease-out]"
            id="modalContent">
            <h3 id="modalTitle" class="text-lg font-bold text-[var(--text)] mb-2"></h3>

            <div class="space-y-4 my-6">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Início') }}</p>
                    <p id="modalStart" class="text-sm font-medium text-[var(--text)]"></p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Fim') }}</p>
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

    {{-- MODAL DE AGENDAMENTO DE MANUTENÇÃO PREVENTIVA --}}
    <div id="scheduleModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
        role="dialog" aria-modal="true" aria-labelledby="scheduleModalTitle">
        <div class="relative w-full max-w-lg bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 shadow-2xl animate-[fadeIn_0.15s_ease-out]">
            <div class="flex items-center justify-between pb-4 border-b border-[var(--border)]">
                <div>
                    <h3 id="scheduleModalTitle" class="text-lg font-bold text-[var(--text)]">
                        🛡️ {{ __('Agendar Manutenção Preventiva') }}
                    </h3>
                    <p class="text-xs text-[var(--text-soft)] mt-0.5">{{ __('Crie um agendamento proativo de rotina para os técnicos.') }}</p>
                </div>
                <button onclick="closeScheduleModal()" class="text-[var(--text-soft)] hover:text-[var(--text)] p-1 rounded-lg">✕</button>
            </div>

            <form id="preventiveForm" onsubmit="submitPreventiveMaintenance(event)" class="space-y-4 my-6">
                <div>
                    <label for="sched_title" class="mb-1 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Título da Intervenção') }} *</label>
                    <input id="sched_title" type="text" required placeholder="{{ __('Ex: Limpeza trimestral de filtros...') }}"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                </div>

                <div>
                    <label for="sched_equipment_id" class="mb-1 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Equipamento') }} *</label>
                    <select id="sched_equipment_id" required
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                        <option value="">{{ __('A carregar equipamentos...') }}</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="sched_date" class="mb-1 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Data e Hora') }} *</label>
                        <input id="sched_date" type="datetime-local" required
                            class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                    </div>
                    <div>
                        <label for="sched_technician_id" class="mb-1 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Técnico (Opcional)') }}</label>
                        <select id="sched_technician_id"
                            class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                            <option value="">{{ __('Atribuição Automática') }}</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="sched_description" class="mb-1 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Notas da Tarefa') }}</label>
                    <textarea id="sched_description" rows="3" placeholder="{{ __('Instruções específicas para o técnico...') }}"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"></textarea>
                </div>

                <div id="schedFeedback" class="hidden text-xs font-bold text-red-500 p-2 rounded-lg bg-red-500/10"></div>

                <div class="flex justify-end gap-3 pt-4 border-t border-[var(--border)]">
                    <button type="button" onclick="closeScheduleModal()"
                        class="px-5 py-2.5 bg-[var(--surface-2)] hover:bg-[var(--border)] text-xs font-bold text-[var(--text)] border border-[var(--border)] rounded-xl transition-all cursor-pointer min-h-[40px]">
                        {{ __('Cancelar') }}
                    </button>
                    <button type="submit" id="btnSubmitSched"
                        class="px-5 py-2.5 bg-orange-500 hover:bg-orange-600 text-xs font-bold text-white rounded-xl shadow-md transition-all cursor-pointer min-h-[40px]">
                        {{ __('Confirmar Agendamento') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let calendar;
        let lastFocusedElement = null;

        function openModal(title, start, end) {
            lastFocusedElement = document.activeElement;

            document.getElementById('modalTitle').innerText = title.includes('🛡️') || title.includes('🔧') ? title : `🛡️ ${title}`;
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

        async function openScheduleModal() {
            const modal = document.getElementById('scheduleModal');
            modal.classList.remove('hidden');
            document.getElementById('schedFeedback').classList.add('hidden');

            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            tomorrow.setHours(9, 0, 0, 0);
            document.getElementById('sched_date').value = tomorrow.toISOString().slice(0, 16);

            await loadScheduleFormData();
        }

        function closeScheduleModal() {
            document.getElementById('scheduleModal').classList.add('hidden');
        }

        async function loadScheduleFormData() {
            const eqSelect = document.getElementById('sched_equipment_id');
            const techSelect = document.getElementById('sched_technician_id');

            try {
                const eqRes = await fetch('/equipments', { headers: authHeader() });
                if (eqRes.ok) {
                    const eqData = await eqRes.json();
                    const list = eqData.equipments?.data ?? eqData.equipments ?? eqData ?? [];
                    eqSelect.innerHTML = `<option value="">${"{{ __('Selecione um equipamento...') }}"}</option>` +
                        list.map(e => `<option value="${e.id}">${e.name} (${e.room?.name || 'Sem Sala'})</option>`).join('');
                }

                const techRes = await fetch('/admin/users?role=technician', { headers: authHeader() });
                if (techRes.ok) {
                    const techData = await techRes.json();
                    const techList = techData.users?.data ?? techData.users ?? techData ?? [];
                    techSelect.innerHTML = `<option value="">${"{{ __('Atribuição Automática') }}"}</option>` +
                        techList.map(t => `<option value="${t.id}">${t.name}</option>`).join('');
                }
            } catch (err) {
                console.error("Erro ao carregar dados do formulário:", err);
            }
        }

        async function submitPreventiveMaintenance(e) {
            e.preventDefault();
            const btn = document.getElementById('btnSubmitSched');
            const feedback = document.getElementById('schedFeedback');
            feedback.classList.add('hidden');

            const payload = {
                title: document.getElementById('sched_title').value.trim(),
                equipment_id: document.getElementById('sched_equipment_id').value,
                scheduled_at: document.getElementById('sched_date').value,
                assigned_to: document.getElementById('sched_technician_id').value || null,
                description: document.getElementById('sched_description').value.trim()
            };

            btn.disabled = true;
            btn.innerText = "{{ __('A agendar...') }}";

            try {
                const res = await fetch('/admin/maintenance/schedule', {
                    method: 'POST',
                    headers: Object.assign({ 'Content-Type': 'application/json' }, authHeader()),
                    body: JSON.stringify(payload)
                });

                if (!res.ok) {
                    const errData = await res.json().catch(() => ({}));
                    throw new Error(errData.message || "{{ __('Erro ao agendar manutenção preventiva.') }}");
                }

                closeScheduleModal();
                if (calendar) calendar.refetchEvents();
                document.getElementById('preventiveForm').reset();
            } catch (err) {
                feedback.innerText = err.message;
                feedback.classList.remove('hidden');
            } finally {
                btn.disabled = false;
                btn.innerText = "{{ __('Confirmar Agendamento') }}";
            }
        }

        function handleEscapeKey(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeScheduleModal();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (!isAuthenticated()) {
                window.location.href = "/ui/login";
                return;
            }

            const userRole = (localStorage.getItem('user_role') || '').toLowerCase();
            if (userRole === 'admin' || userRole === 'administrador') {
                document.getElementById('btnAdminSchedule')?.classList.remove('hidden');
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

                    /* RENDERIZADOR PERSONALIZADO PARA OS EVENTOS */
                    eventContent: function(arg) {
                        const isPreventive = arg.event.extendedProps?.scheduled || arg.event.title.toLowerCase().includes('preventiv') || arg.event.title.toLowerCase().includes('troca');
                        const icon = isPreventive ? '🛡️' : '🔧';
                        const title = arg.event.title;
                        const time = arg.timeText;

                        const customEl = document.createElement('div');
                        customEl.className = 'flex items-center gap-2 overflow-hidden py-0.5 px-0.5';
                        customEl.innerHTML = `
                            <span class="text-lg filter drop-shadow flex-shrink-0 leading-none">${icon}</span>
                            <div class="truncate min-w-0">
                                <div class="font-extrabold text-xs truncate leading-tight text-white">${title}</div>
                                ${time ? `<div class="text-[10px] opacity-90 font-mono text-white/90 leading-none mt-0.5">${time}</div>` : ''}
                            </div>
                        `;
                        return { domNodes: [customEl] };
                    },

                    events(fetchInfo, successCallback, failureCallback) {
                        // Limpar destaques de agendamentos anteriores
                        document.querySelectorAll('.fc-day-has-scheduled').forEach(el => {
                            el.classList.remove('fc-day-has-scheduled');
                        });

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

                    /* ✨ ADICIONAR HIGHLIGHT NO DIA DO AGENDAMENTO QUANDO O EVENTO MONTA ✨ */
                    eventDidMount(info) {
                        info.el.style.cursor = "pointer";
                        info.el.title = info.event.title;
                        info.el.setAttribute('tabindex', '0');
                        info.el.setAttribute('role', 'button');
                        info.el.setAttribute('aria-label', `${info.event.title}, clique para ver detalhes`);

                        // Destacar a célula do dia onde o evento está agendado
                        if (info.event.start) {
                            const dateStr = info.event.start.toISOString().split('T')[0];
                            const dayCell = document.querySelector(`.fc-daygrid-day[data-date="${dateStr}"]`);
                            if (dayCell) {
                                dayCell.classList.add('fc-day-has-scheduled');
                            }
                        }

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