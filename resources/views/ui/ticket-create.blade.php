@extends('ui.layout')

@section('page_key', 'ticket-create')

@section('content')
@component('ui.partials.page-card', [
    'title' => __('Criar Ticket'),
    'subtitle' => __('Registe uma nova ocorrência de manutenção com contexto técnico e prioridade.'),
    'actions' => '<a href="' . route('ui.tickets') . '" class="inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">← ' . __('Voltar aos tickets') . '</a>'
])
    <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
        <div class="mb-6">
            <h2 class="text-sm font-bold text-[var(--text)]">{{ __('Novo pedido de intervenção') }}</h2>
            <p class="mt-0.5 text-xs text-[var(--text-soft)]">{{ __('Descreva a situação de forma objetiva para que a equipa técnica possa agir rapidamente.') }}</p>
        </div>

        <form id="createTicketForm" class="space-y-6" data-redirect-url="{{ route('ui.tickets') }}">
            <x-ui.ticket-create.field-group :label="__('Título')" :required="true">
                <input type="text" id="ticketTitle" name="title" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="{{ __('Ex.: Ruído anómalo no motor principal do torno') }}">
            </x-ui.ticket-create.field-group>

            <x-ui.ticket-create.field-group :label="__('Descrição')" :required="true">
                <textarea id="ticketDescription" name="description" rows="4" required class="w-full resize-none rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="{{ __('Detalhe o problema ocorrido, ruídos, fugas ou comportamentos fora do normal...') }}"></textarea>
            </x-ui.ticket-create.field-group>

            <x-ui.ticket-create.priority-selector />

            <div class="grid gap-6 lg:grid-cols-2">
                <x-ui.ticket-create.field-group :label="__('ID do Equipamento')" :required="true">
                    <input type="text" id="equipmentId" name="equipment_id" required class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15" placeholder="Ex.: EQ-073">
                </x-ui.ticket-create.field-group>

                <x-ui.ticket-create.file-upload />
            </div>

            <div id="formMessage" class="min-h-6 text-sm font-medium text-[var(--text-soft)]"></div>

            <div class="mt-6 flex flex-wrap gap-3">
                <button type="submit" id="submitBtn" class="inline-flex items-center justify-center rounded-2xl bg-orange-500 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-orange-500/20 transition hover:bg-orange-600 disabled:cursor-not-allowed disabled:opacity-50">
                    {{ __('GUARDAR TICKET') }}
                </button>
            </div>
        </form>
    </div>
@endcomponent
@endsection
