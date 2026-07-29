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
    <x-ui.partials.page-card
        :title="__('Calendário Operacional')"
        :subtitle="__('Visualize intervenções técnicas, manutenção preventiva, tickets programados e tarefas operacionais numa única interface integrada.')"
    >
        <x-slot:actions>
            <x-ui.page-actions.group>
                <x-ui.page-actions.back-button :href="route('ui.index')" :label="__('Dashboard')" />
                <x-ui.buttons.button type="button" data-action="calendar-today" variant="primary" size="sm" weight="bold">
                    {{ __('Hoje') }}
                </x-ui.buttons.button>
            </x-ui.page-actions.group>
        </x-slot:actions>
        <div class="space-y-12 lg:space-y-16 animate-[fadeIn_0.2s_ease-out]">
            <div class="grid xl:grid-cols-4 gap-8 lg:gap-10">
                @include('ui.partials.calendar-summary', ['eventsTotal' => '--', 'monthTotal' => '--'])

                <div class="xl:col-span-3 bg-(--surface) border border-(--border) rounded-3xl p-8 lg:p-10 shadow-sm">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </x-ui.partials.page-card>

    @include('ui.partials.calendar-modal')
@endsection
