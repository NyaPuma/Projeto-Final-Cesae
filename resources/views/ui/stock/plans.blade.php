@extends('ui.layout')

@section('page_key', 'stock-plans')

@section('content')
<x-ui.partials.page-header
    :title="__('maintenance_plan.Planos de Manutenção Preventiva')"
    :subtitle="__('equipment.Defina periodicidades de manutenção e as peças previstas por equipamento.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.stock.dashboard')" :label="__('stock.Voltar ao Stock')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    {{-- Create / edit form --}}
    <div class="mb-6 rounded-2xl border border-(--border) bg-(--surface) p-5 shadow-sm">
        <h2 id="planFormTitle" class="mb-4 text-xs font-black uppercase tracking-wider text-(--text)">{{ __('maintenance_plan.Novo plano de manutenção') }}</h2>
        <form id="planForm" class="grid gap-4 md:grid-cols-2 lg:grid-cols-5" novalidate data-plan-form-mode="create" data-plan-id="">
            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-(--text-soft)" for="plName">
                    {{ __('common.Nome') }} <span class="text-danger">*</span>
                </label>
                <input id="plName" name="name" type="text" required placeholder="{{ __('maintenance_plan.Ex: Manutenção trimestral') }}"
                    class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-(--text-soft)" for="plEquipmentSearch">
                    {{ __('equipment.Equipamento') }} <span class="text-danger">*</span>
                </label>
                <div class="relative">
                    <input type="text" id="plEquipmentSearch" name="equipment_search" autocomplete="off" required
                        placeholder="{{ __('equipment.Escreva para pesquisar equipamento, série ou sala...') }}"
                        class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    <input type="hidden" id="plEquipment" name="equipment_id">
                    <div id="plEquipmentList" class="hidden absolute z-50 mt-1 w-full max-h-56 overflow-y-auto rounded-2xl border border-(--border) bg-(--surface) shadow-2xl space-y-1 p-1.5"></div>
                </div>
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-(--text-soft)" for="plIntervalType">
                    {{ __('common.Periodicidade') }} <span class="text-danger">*</span>
                </label>
                <select id="plIntervalType" name="interval_type" required
                    class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    <option value="days">{{ __('common.Dias') }}</option>
                    <option value="usage_hours">{{ __('common.Horas de uso') }}</option>
                    <option value="cycles">{{ __('common.Ciclos') }}</option>
                </select>
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-(--text-soft)" for="plIntervalValue">
                    {{ __('common.Valor') }} <span class="text-danger">*</span>
                </label>
                <input id="plIntervalValue" name="interval_value" type="number" min="1" step="1" required placeholder="{{ __('common.Ex: 90') }}"
                    class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-(--text-soft)" for="plDescription">
                    {{ __('common.Descrição') }}
                </label>
                <input id="plDescription" name="description" type="text"
                    placeholder="{{ __('messages.Ex: Inspeção completa do sistema') }}"
                    class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
            </div>
            <div class="md:col-span-2 lg:col-span-5">
                <p class="mb-1.5 text-xs font-bold uppercase tracking-wider text-(--text-soft)">
                    {{ __('stock.Peças previstas (deixe em branco se não aplicável)') }}
                </p>
                <div id="plPartsContainer" class="space-y-2">
                    <div class="flex gap-2 items-start" data-part-row>
                        <div class="relative flex-1">
                            <input type="text" data-part-search autocomplete="off" aria-label="{{ __('stock.Peça') }}" placeholder="{{ __('stock.Pesquise a peça por nome ou referência...') }}"
                                class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                            <input type="hidden" data-part-id aria-label="{{ __('stock.Peça selecionada') }}">
                            <div data-part-list class="hidden absolute z-50 mt-1 w-full max-h-56 overflow-y-auto rounded-2xl border border-(--border) bg-(--surface) shadow-2xl space-y-1 p-1.5"></div>
                        </div>
                        <input type="number" min="1" step="1" placeholder="{{ __('common.Qtd') }}" data-expected-qty aria-label="{{ __('common.Quantidade') }}"
                            class="w-28 rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) placeholder-(--text-soft) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                        <button type="button" data-part-row-remove class="rounded-xl border border-danger/25 bg-danger/10 px-3 py-2.5 text-xs font-bold text-danger transition hover:bg-danger/20">✕</button>
                    </div>
                </div>
                <button type="button" id="plAddPart" class="mt-2 inline-flex items-center gap-1 rounded-xl border border-(--border) bg-(--surface-2) px-3 py-1.5 text-xs font-bold text-(--text) transition hover:bg-(--border)">
                    {{ __('stock.Adicionar peça') }}
                </button>
            </div>
            <div class="flex items-end gap-3 lg:col-span-5">
                <label class="inline-flex cursor-pointer items-center gap-2.5">
                    <input id="plActive" name="active" type="checkbox" checked
                        class="h-4 w-4 rounded border-(--border) text-primary focus:ring-primary">
                    <span class="text-xs font-semibold text-(--text)">{{ __('equipment.Plano ativo') }}</span>
                </label>
            </div>
            <div class="flex items-end gap-3 lg:col-span-5">
                <button type="submit" id="plSubmit" class="inline-flex items-center justify-center rounded-xl bg-primary px-5 py-2.5 text-xs font-semibold text-white transition hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed">
                    {{ __('ui.Guardar Plano') }}
                </button>
                <button type="button" id="plReset" class="inline-flex items-center justify-center rounded-xl border border-(--border) bg-(--surface-2) px-4 py-2.5 text-xs font-semibold text-(--text) transition hover:bg-(--border)">
                    {{ __('ui.Cancelar edição') }}
                </button>
                <p id="plMessage" class="text-xs font-medium text-(--text-soft)"></p>
            </div>
        </form>
    </div>

    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_equipment" :label="__('equipment.Equipamento')">
            <select id="filter_equipment" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                <option value="">{{ __('common.Todos') }}</option>
                @foreach($equipments as $equipment)
                    <option value="{{ $equipment->id }}">{{ $equipment->name }}</option>
                @endforeach
            </select>
        </x-ui.listing.filter-field>
    </x-ui.listing.filter-panel>

    <x-ui.listing.table-card
        table_id="plansTable"
        body_id="plansTableBody"
        :aria_label="__('maintenance_plan.Lista de planos de manutenção')"
        :loading_message="__('ui.A carregar planos...')"
        :columns="5"
    >
        <x-slot:head>
            <tr>
                <th class="px-5 py-4 font-bold">{{ __('maintenance_plan.Plano') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('equipment.Equipamento') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Periodicidade') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('stock.Peças') }}</th>
                <th class="px-5 py-4 font-bold text-right">{{ __('common.Ações') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
</x-ui.partials.page-header>
@endsection
