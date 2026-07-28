@extends('ui.layout')

@section('page_key', 'calendar')

@push('styles')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
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
                    <a href="{{ route('ui.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4.5 py-2.5 bg-[var(--surface)] text-sm font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all min-h-[44px]">
                        <svg class="w-4 h-4 mr-2 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                        </svg>
                        ' .
            __('Dashboard') .
            '
                    </a>
                    <button data-action="calendar-today" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-primary text-sm font-bold text-white border border-transparent rounded-xl shadow-sm hover:opacity-90 transition-all min-h-[44px] cursor-pointer">
                        ' .
            __('Hoje') .
            '
                    </button>
                </div>',
    ])
        <div class="space-y-12 lg:space-y-16 animate-[fadeIn_0.2s_ease-out]">
            {{-- Grelha de Conteúdo Principal --}}
            <div class="grid xl:grid-cols-4 gap-8 lg:gap-10">
                @include('ui.partials.calendar-summary', ['eventsTotal' => '--', 'monthTotal' => '--'])

                {{-- Contentor da Instância do Calendário --}}
                <div class="xl:col-span-3 bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 lg:p-10 shadow-sm">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    @endcomponent

    @include('ui.partials.calendar-modal')
@endsection
