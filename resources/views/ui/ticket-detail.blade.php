@extends('ui.layout')

@section('page_key', 'ticket-detail')

@section('content')
<div data-ticket-id="{{ $ticketId ?? $ticket->id ?? null }}">
@component('ui.partials.page-card', [
    'title' => __('Detalhes do Ticket'),
    'subtitle' => __('Fluxo Orçamental ACCEPT: Consulta de estado, aprovações administrativas e gestão técnica.'),
    'actions' => '<a href="' . route('ui.tickets') . '" class="inline-flex items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 text-xs font-semibold text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)]"><svg class="mr-1.5 h-3.5 w-3.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> ' . __('Voltar à listagem') . '</a>'
])
    <div class="grid gap-6 xl:grid-cols-[1.2fr_0.8fr] animate-[fadeIn_0.3s_ease-out]">
        <div class="space-y-6">
            <x-ui.ticket-detail.details-panel />

            @if(isset($user) && $user && $user->isTechnician())
                <x-ui.ticket-detail.technician.panel />
            @endif

            @if(isset($user) && $user && $user->isAdmin())
                <x-ui.ticket-detail.admin.budget-approval-card />
            @endif
        </div>

        <div class="space-y-6">
            <div id="aiAssistantContainer"></div>

            <x-ui.ticket-detail.sidebar.comments-history-card />
            <x-ui.ticket-detail.comments-card />
            <x-ui.ticket-detail.sidebar.photos-card />

            @if(isset($user) && $user && $user->isAdmin())
                <x-ui.ticket-detail.sidebar.assignment-card />
            @endif
        </div>
    </div>

    <div id="ticketMessage" class="mt-4 min-h-6 px-1 text-xs font-medium transition-all duration-300"></div>

    <x-ui.ticket-detail.priority-warning-modal />
@endcomponent
</div>
@endsection
