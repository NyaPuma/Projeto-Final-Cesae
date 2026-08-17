@extends('ui.layout')

@section('page_key', 'calendar')

@section('content')
    <x-ui.partials.page-header
        :title="__('common.Calendário Operacional')"
        :subtitle="__('tickets.Visualize intervenções técnicas, manutenção preventiva, tickets programados e tarefas operacionais numa única interface integrada.')"
    >
        <x-slot:actions>
            <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                <a href="/ui" class="w-full sm:w-auto inline-flex items-center justify-center px-4.5 py-2.5 bg-[var(--surface)] text-sm font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all min-h-[44px]">
                    <svg class="w-4 h-4 mr-2 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                    </svg>
                    {{ __('dashboard.Dashboard') }}
                </a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <button data-action="schedule" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-primary hover:bg-primary-hover text-sm font-bold text-white rounded-xl shadow-md transition-all min-h-[44px] cursor-pointer">
                            + {{ __('maintenance_plan.Agendar Preventiva') }}
                        </button>
                    @endif
                @endauth
            </div>
        </x-slot:actions>
        <div class="space-y-12 lg:space-y-16 animate-[fadeIn_0.2s_ease-out]">

            {{-- Painel de Resumo Operacional (por cima do calendário) --}}
            <div class="space-y-8">

                <div class="bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 shadow-sm"
                    aria-labelledby="summary-title">
                    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                        <div>
                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.14em] text-primary">
                                <span class="h-2 w-2 rounded-full bg-primary" aria-hidden="true"></span>
                                {{ __('common.Agenda Inteligente') }}
                            </span>
                            <h3 id="summary-title" class="mt-4 text-lg font-bold text-[var(--text)]">
                                {{ __('common.Resumo Operacional') }}
                            </h3>
                            <p class="text-xs text-[var(--text-soft)] mt-1.5">{{ __('dashboard.Métricas da agenda atual') }}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="relative flex h-2.5 w-2.5" aria-hidden="true">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-primary"></span>
                            </span>
                            <p class="text-sm font-semibold text-[var(--text)]">
                                {{ __('common.Sincronização Ativa') }}
                            </p>
                        </div>
                    </div>

                    <hr class="border-[var(--border)] my-6" aria-hidden="true">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                        <div class="p-6 bg-[var(--surface-2)] border border-[var(--border)] rounded-2xl">
                            <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                                {{ __('common.Total de Eventos') }}
                            </p>
                            <p class="text-4xl font-black text-[var(--text)] mt-2" id="eventsTotal" aria-live="polite">
                                --
                            </p>
                        </div>

                        <div class="p-6 bg-[var(--surface-2)] border border-[var(--border)] rounded-2xl">
                            <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                                {{ __('common.Este Mês') }}
                            </p>
                            <p class="text-4xl font-black text-[var(--text)] mt-2" id="monthTotal" aria-live="polite">
                                --
                            </p>
                        </div>

                        <div class="p-6 border border-[var(--border)] rounded-2xl bg-[var(--surface-2)]">
                            <p class="text-[var(--text-soft)] text-xs font-semibold uppercase tracking-wider">
                                {{ __('common.Próxima Intervenção') }}
                            </p>
                            <div class="flex items-center gap-3 mt-3">
                                <span class="relative flex h-2.5 w-2.5" aria-hidden="true">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-primary"></span>
                                </span>
                                <p class="text-sm font-semibold text-[var(--text)]">
                                    {{ __('common.Sincronização Ativa') }}
                                </p>
                            </div>
                            @if(auth()->user()->isAdmin() || auth()->user()->isTechnician())
                                <p class="text-xs text-[var(--text-soft)] mt-3">
                                    {{ __('common.Arraste um evento para reagendar.') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Contentor da Instância do Calendário --}}
                <div class="bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 lg:p-10 shadow-sm">
                    <div id="calendar"
                         data-locale="{{ app()->getLocale() }}"
                         data-reschedule-prefix="{{ url('/calendar/events') }}"
                         data-btn-today="{{ __('common.Hoje') }}"
                         data-btn-month="{{ __('common.Mês') }}"
                         data-btn-week="{{ __('common.Semana') }}"
                         data-btn-day="{{ __('common.Dia') }}"></div>

                    <div class="flex flex-wrap items-center gap-3 mt-6 pt-6 border-t border-[var(--border)]">
                        <span class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/10 px-4 py-1.5 text-xs font-semibold text-primary">
                            <span class="text-sm leading-none">🛡️</span>
                            {{ __('maintenance_plan.Manutenção Preventiva') }}
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-full border border-info/20 bg-info/10 px-4 py-1.5 text-xs font-semibold text-info">
                            <span class="text-sm leading-none">🔧</span>
                            {{ __('common.Intervenção') }}
                        </span>
                        @if(auth()->user()->isAdmin() || auth()->user()->isTechnician())
                            <span class="inline-flex items-center gap-2 rounded-full border border-[var(--border)] bg-[var(--surface-2)] px-4 py-1.5 text-xs font-semibold text-[var(--text-soft)]">
                                🖱️ {{ __('common.Arraste para reagendar') }}
                            </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </x-ui.partials.page-header>

    {{-- MODAL DE DETALHES DE EVENTO --}}
    <div id="eventModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
        role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="relative w-full max-w-md bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 shadow-2xl animate-[fadeIn_0.15s_ease-out]"
            id="modalContent">
            <h3 id="modalTitle" class="text-lg font-bold text-[var(--text)] mb-2"></h3>

            <div class="space-y-4 my-6">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Início') }}</p>
                    <p id="modalStart" class="text-sm font-medium text-[var(--text)]"></p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Fim') }}</p>
                    <p id="modalEnd" class="text-sm font-medium text-[var(--text)]"></p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[var(--text-soft)]">{{ __('equipment.Equipamento / Técnico') }}</p>
                    <p id="modalTechnician" class="text-sm font-medium text-[var(--text)]"></p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Descrição') }}</p>
                    <p id="modalDescription" class="text-sm font-medium text-[var(--text)] whitespace-pre-line"></p>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a id="modalTicketLink" href="#"
                    class="hidden px-5 py-2.5 bg-primary hover:bg-primary-hover text-sm font-bold text-white rounded-xl transition-all cursor-pointer min-h-[44px]">
                    {{ __('tickets.Abrir Ticket') }}
                </a>
                <button data-action="close-modal" id="closeModalBtn"
                    class="px-5 py-2.5 bg-[var(--surface-2)] hover:bg-[var(--border)] text-sm font-bold text-[var(--text)] border border-[var(--border)] rounded-xl transition-all cursor-pointer min-h-[44px]">
                    {{ __('ui.Fechar') }}
                </button>
            </div>
        </div>
    </div>

    {{-- MODAL DE AGENDAMENTO DE MANUTENÇÃO PREVENTIVA --}}
    <div id="scheduleModal" data-schedule-url="{{ route('calendar.maintenance') }}" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
        role="dialog" aria-modal="true" aria-labelledby="scheduleModalTitle">
        <div class="relative w-full max-w-lg bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 shadow-2xl animate-[fadeIn_0.15s_ease-out]">
            <div class="flex items-center justify-between pb-4 border-b border-[var(--border)]">
                <div>
                    <h3 id="scheduleModalTitle" class="text-lg font-bold text-[var(--text)]">
                        🛡️ {{ __('maintenance_plan.Agendar Manutenção Preventiva') }}
                    </h3>
                    <p class="text-xs text-[var(--text-soft)] mt-0.5">{{ __('equipment.Crie um agendamento proativo de rotina para os técnicos.') }}</p>
                </div>
                <button data-action="close-schedule" class="text-[var(--text-soft)] hover:text-[var(--text)] p-1 rounded-lg">✕</button>
            </div>

            <form id="preventiveForm" class="space-y-4 my-6">
                <div>
                    <label for="sched_title" class="mb-1 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Título da Intervenção') }} *</label>
                    <input id="sched_title" type="text" required placeholder="{{ __('common.Ex: Limpeza trimestral de filtros...') }}"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                </div>

                <div>
                    <label for="sched_equipment_search" class="mb-1 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('equipment.Equipamento') }} *</label>
                    <div class="relative">
                        <input id="sched_equipment_search" type="text" autocomplete="off" role="combobox"
                            aria-expanded="false" aria-controls="equipmentSuggestionsList"
                            aria-label="{{ __('equipment.Procure um equipamento') }}"
                            placeholder="{{ __('common.Escreva para procurar...') }}"
                            class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                        <input type="hidden" id="sched_equipment_id" name="equipment_id">
                        <div id="equipmentSuggestions" class="hidden equipment-search__dropdown" role="listbox" aria-label="{{ __('equipment.Sugestões de equipamentos') }}">
                            <ul id="equipmentSuggestionsList" class="equipment-search__list"></ul>
                        </div>
                    </div>
                    <p id="equipmentSearchEmpty" class="hidden mt-1 text-[10px] font-semibold text-[var(--text-soft)]">
                        {{ __('equipment.Selecione um equipamento da lista de sugestões.') }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="sched_date" class="mb-1 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Data e Hora') }} *</label>
                        <input id="sched_date" type="datetime-local" required
                            class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                    </div>
                    <div>
                        <label for="sched_technician_id" class="mb-1 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Técnico (Opcional)') }}</label>
                        <select id="sched_technician_id"
                            data-placeholder-auto="{{ __('common.Atribuição Automática') }}"
                            class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                            <option value="">{{ __('common.Atribuição Automática') }}</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="sched_description" class="mb-1 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Notas da Tarefa') }}</label>
                    <textarea id="sched_description" rows="3" placeholder="{{ __('common.Instruções específicas para o técnico...') }}"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"></textarea>
                </div>

                <div id="schedFeedback"
                     data-err-message="{{ __('messages.Erro ao agendar manutenção preventiva.') }}"
                     class="hidden text-xs font-bold text-red-500 p-2 rounded-lg bg-red-500/10"></div>

                <div class="flex justify-end gap-3 pt-4 border-t border-[var(--border)]">
                    <button type="button" data-action="close-schedule"
                        class="px-5 py-2.5 bg-[var(--surface-2)] hover:bg-[var(--border)] text-xs font-bold text-[var(--text)] border border-[var(--border)] rounded-xl transition-all cursor-pointer min-h-[40px]">
                        {{ __('ui.Cancelar') }}
                    </button>
                    <button type="submit" id="btnSubmitSched"
                        data-label-scheduling="{{ __('common.A agendar...') }}"
                        data-label-confirm="{{ __('ui.Confirmar Agendamento') }}"
                        class="px-5 py-2.5 bg-primary hover:bg-primary-hover text-xs font-bold text-white rounded-xl shadow-md transition-all cursor-pointer min-h-[40px]">
                        {{ __('ui.Confirmar Agendamento') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

