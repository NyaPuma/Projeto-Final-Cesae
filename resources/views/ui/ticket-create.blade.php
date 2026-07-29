@extends('ui.layout')

@section('page_key', 'ticket-create')

@section('content')
<x-ui.partials.page-card
    :title="__('Criar Ticket')"
    :subtitle="__('Registe uma nova ocorrência de manutenção com contexto técnico e prioridade.')"
>
    <x-slot:actions>
        <x-ui.page-actions.back-button :href="route('ui.tickets')" :label="__('Voltar aos tickets')" compact class="rounded-2xl text-sm shadow-none" />
    </x-slot:actions>

    <x-ui.form.card>
        <x-ui.form.section-header
            :title="__('Novo pedido de intervenção')"
            :description="__('Descreva a situação de forma objetiva para que a equipa técnica possa agir rapidamente.')"
        />

        <form id="createTicketForm" class="space-y-6" data-redirect-url="{{ route('ui.tickets') }}">
            <x-ui.ticket-create.field-group :label="__('Título')" :required="true">
                <x-ui.form.input id="ticketTitle" name="title" type="text" :required="true" :placeholder="__('Ex.: Ruído anómalo no motor principal do torno')" />
            </x-ui.ticket-create.field-group>

            <x-ui.ticket-create.field-group :label="__('Descrição')" :required="true">
                <x-ui.form.textarea id="ticketDescription" name="description" :rows="4" :required="true" :placeholder="__('Detalhe o problema ocorrido, ruídos, fugas ou comportamentos fora do normal...')" />
            </x-ui.ticket-create.field-group>

            <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
                <x-ui.ticket-create.priority-selector />
                <x-ui.ticket-create.file-upload />
            </div>

            <x-ui.ticket-create.field-group :label="__('Equipamento')" :required="true">
                <x-ui.form.select id="equipmentSelect" name="equipment_id" :required="true">
                    <option value="">{{ __('Selecione o equipamento') }}</option>
                </x-ui.form.select>
            </x-ui.ticket-create.field-group>

            <x-ui.form.message id="formMessage" />

            <div class="mt-6 flex flex-wrap gap-3">
                <x-ui.buttons.submit id="submitBtn" variant="accent" size="md" weight="bold" class="rounded-2xl shadow-lg shadow-orange-500/20 disabled:cursor-not-allowed disabled:opacity-50">
                    {{ __('GUARDAR TICKET') }}
                </x-ui.buttons.submit>
            </div>
        </form>
    </x-ui.form.card>
</x-ui.partials.page-card>
@endsection
