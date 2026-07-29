@extends('ui.layout')

@section('page_key', 'ticket-detail')

@section('content')
<div data-ticket-id="{{ $ticketId ?? $ticket->id ?? null }}">
<x-ui.partials.page-card
    :title="__('Detalhes do Ticket')"
    :subtitle="__('Fluxo Orçamental ACCEPT: Consulta de estado, aprovações administrativas e gestão técnica.')"
>
    <x-slot:actions>
        <x-ui.page-actions.back-button :href="route('ui.tickets')" :label="__('Voltar à listagem')" compact />
    </x-slot:actions>

    <div class="grid gap-6 xl:grid-cols-[1.2fr_0.8fr] animate-[fadeIn_0.3s_ease-out]">
        <div class="space-y-6">
            <x-ui.ticket-detail.details-panel />

            @if(isset($user) && $user && $user->isTechnician())
                <x-ui.ticket-detail.technician.panel />
            @endif

            @if(isset($user) && $user && $user->isAdmin())
                <x-ui.ticket-detail.admin.budget-approval-card />
            @endif

            <x-ui.ticket-detail.comments-card />
        </div>

        <div class="space-y-6">
            <x-ui.ticket-detail.sidebar.assignment-card />
            <x-ui.ticket-detail.sidebar.photos-card />
            <x-ui.ticket-detail.sidebar.comments-history-card />
        </div>
    </div>
</x-ui.partials.page-card>
</div>

<x-ui.ticket-detail.priority-warning-modal />
@endsection
