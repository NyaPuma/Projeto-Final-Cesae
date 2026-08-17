@extends('ui.layout')

@section('page_key', 'stock-suppliers-edit')

@section('content')
<x-ui.partials.page-header
    :title="__('ui.Editar Fornecedor')"
    :subtitle="__('common.Atualize os dados do fornecedor :name.', ['name' => $supplier->name])"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.stock.suppliers')" :label="__('ui.Voltar')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    <div class="rounded-3xl border border-(--border) bg-(--surface) p-6 shadow-sm">
        <form id="supplierForm" class="space-y-6" novalidate data-supplier-form-mode="edit" data-supplier-id="{{ $supplier->id }}">
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="supplierName">
                        {{ __('common.Nome') }} <span class="ml-0.5 text-danger">*</span>
                    </label>
                    <input id="supplierName" name="name" type="text" required value="{{ old('name', $supplier->name) }}"
                        placeholder="{{ __('stock.Ex: Fornecedor Peças Lda') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="supplierNif">
                        {{ \App\Services\LocaleService::taxIdentifierLabel() }}
                    </label>
                    <input id="supplierNif" name="nif" type="text" value="{{ old('nif', $supplier->nif) }}"
                        placeholder="{{ __('common.Ex: 512345678') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="supplierContact">
                        {{ __('common.Contacto') }}
                    </label>
                    <input id="supplierContact" name="contact" type="text" value="{{ old('contact', $supplier->contact) }}"
                        placeholder="{{ __('common.Ex: 912 345 678') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="supplierEmail">
                        {{ __('common.Email') }}
                    </label>
                    <input id="supplierEmail" name="email" type="email" value="{{ old('email', $supplier->email) }}"
                        placeholder="{{ __('common.Ex: vendas@fornecedor.pt') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="supplierLeadTime">
                        {{ __('common.Prazo de entrega médio (dias)') }}
                    </label>
                    <input id="supplierLeadTime" name="avg_lead_time_days" type="number" min="0" step="1" value="{{ old('avg_lead_time_days', $supplier->avg_lead_time_days) }}"
                        placeholder="{{ __('common.Ex: 5') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div class="lg:col-span-2">
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="supplierAddress">
                        {{ __('common.Morada') }}
                    </label>
                    <textarea id="supplierAddress" name="address" rows="3" class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('address', $supplier->address) }}</textarea>
                </div>
            </div>

            <div id="formMessage" class="min-h-6 text-sm font-medium text-(--text-soft)"></div>

            <div class="mt-6 flex flex-wrap gap-3 border-t border-(--border) pt-5">
                <button type="submit" id="submitBtn" class="ui-button ui-button--primary inline-flex items-center justify-center rounded-2xl px-5 py-3 text-sm font-semibold transition hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed">
                    {{ __('ui.Guardar Alterações') }}
                </button>
                <a href="{{ route('ui.stock.suppliers') }}" class="ui-button ui-button--outline inline-flex items-center justify-center rounded-2xl border border-(--border) bg-(--surface) px-5 py-3 text-sm font-semibold text-(--text) transition hover:bg-(--surface-2)">
                    {{ __('ui.Cancelar') }}
                </a>
            </div>
        </form>
    </div>
</x-ui.partials.page-header>
@endsection
