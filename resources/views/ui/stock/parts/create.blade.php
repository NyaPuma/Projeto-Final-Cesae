@extends('ui.layout')

@section('page_key', 'stock-parts-create')

@php($taxLabel = \App\Services\LocaleService::indirectTaxLabel())

@section('content')
<x-ui.partials.page-header
    :title="__('stock.Nova Peça')"
    :subtitle="__('stock.Registe uma peça no catálogo de stock. O stock inicial é registado como movimento de entrada.')"
>
    <div class="rounded-3xl border border-(--border) bg-(--surface) p-6 shadow-sm">
        <form id="partForm" class="space-y-6" novalidate data-part-form-mode="create">
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partSku">
                        {{ __('common.Código (SKU)') }} <span class="ml-0.5 text-danger">*</span>
                    </label>
                    <input id="partSku" name="sku" type="text" required value="{{ old('sku') }}"
                        placeholder="{{ __('common.Ex: ROL-6204-2RS') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partName">
                        {{ __('common.Nome') }} <span class="ml-0.5 text-danger">*</span>
                    </label>
                    <input id="partName" name="name" type="text" required value="{{ old('name') }}"
                        placeholder="{{ __('common.Ex: Rolamento 6204 2RS') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partBrand">
                        {{ __('common.Marca') }}
                    </label>
                    <input id="partBrand" name="brand" type="text" value="{{ old('brand') }}"
                        placeholder="{{ __('common.Ex: SKF') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partManufacturerRef">
                        {{ __('common.Referência do fabricante') }}
                    </label>
                    <input id="partManufacturerRef" name="manufacturer_ref" type="text" value="{{ old('manufacturer_ref') }}"
                        placeholder="{{ __('common.Ex: 6204-2RS1') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partCategory">
                        {{ __('common.Categoria') }}
                    </label>
                    <select id="partCategory" name="part_category_id"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                        <option value="">{{ __('common.Sem categoria') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partUnit">
                        {{ __('common.Unidade de medida') }} <span class="ml-0.5 text-danger">*</span>
                    </label>
                    <select id="partUnit" name="unit_of_measure" required
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                        <option value="unit">{{ __('common.Unidade') }}</option>
                        <option value="meter">{{ __('common.Metro') }}</option>
                        <option value="liter">{{ __('common.Litro') }}</option>
                        <option value="kg">{{ __('common.Quilograma (kg)') }}</option>
                        <option value="pair">{{ __('common.Par') }}</option>
                        <option value="set">{{ __('common.Kit / Conjunto') }}</option>
                        <option value="roll">{{ __('common.Rolo') }}</option>
                        <option value="other">{{ __('common.Outro') }}</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partCostPrice">
                        {{ str_replace('IVA', $taxLabel, __('common.Preço de custo (sem IVA)')) }} <span class="ml-0.5 text-danger">*</span>
                    </label>
                    <input id="partCostPrice" name="cost_price" type="number" step="0.01" min="0" required value="{{ old('cost_price') }}"
                        placeholder="{{ __('common.Ex: 12.50') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partTaxRate">
                        {{ str_replace('IVA', $taxLabel, __('common.Taxa de IVA')) }}
                    </label>
                    <select id="partTaxRate" name="tax_rate_id"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                        <option value="">{{ __('common.Isento / Sem taxa') }}</option>
                        @foreach($taxRates as $taxRate)
                            <option value="{{ $taxRate->id }}">{{ str_replace('IVA', $taxLabel, $taxRate->name) }} ({{ app(\App\Services\LocalizationService::class)->formatPercent((float) $taxRate->percent) }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partSalePrice">
                        {{ __('common.Preço de venda') }}
                    </label>
                    <input id="partSalePrice" name="sale_price" type="number" step="0.01" min="0" value="{{ old('sale_price') }}"
                        placeholder="{{ __('common.Opcional, para faturação interna') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partLocation">
                        {{ __('common.Localização') }}
                    </label>
                    <input id="partLocation" name="location" type="text" value="{{ old('location') }}"
                        placeholder="{{ __('common.Ex: Armazém A · Prateleira 3 · Gaveta 2') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div class="grid gap-6 lg:grid-cols-3">
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partCurrentStock">
                            {{ __('stock.Stock inicial') }} <span class="ml-0.5 text-danger">*</span>
                        </label>
                        <input id="partCurrentStock" name="current_stock" type="number" min="0" step="1" required value="{{ old('current_stock', 0) }}"
                            class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partMinStock">
                            {{ __('stock.Stock mínimo') }} <span class="ml-0.5 text-danger">*</span>
                        </label>
                        <input id="partMinStock" name="min_stock" type="number" min="0" step="1" required value="{{ old('min_stock', 0) }}"
                            class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partMaxStock">
                            {{ __('stock.Stock máximo') }}
                        </label>
                        <input id="partMaxStock" name="max_stock" type="number" min="0" step="1" value="{{ old('max_stock') }}"
                            class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partDescription">
                        {{ __('common.Descrição') }}
                    </label>
                    <textarea id="partDescription" name="description" rows="3" class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('description') }}</textarea>
                </div>

                <div class="lg:col-span-2">
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partTechnicalNotes">
                        {{ __('common.Notas técnicas') }}
                    </label>
                    <textarea id="partTechnicalNotes" name="technical_notes" rows="3" class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('technical_notes') }}</textarea>
                </div>
            </div>

            <div id="formMessage" class="min-h-6 text-sm font-medium text-(--text-soft)"></div>

            <div class="mt-6 flex flex-wrap gap-3 border-t border-(--border) pt-5">
                <button type="submit" id="submitBtn" class="ui-button ui-button--primary inline-flex items-center justify-center rounded-2xl px-5 py-3 text-sm font-semibold transition hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed">
                    {{ __('stock.Guardar Peça') }}
                </button>
                <a href="{{ route('ui.stock.parts') }}" class="ui-button ui-button--outline inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">
                    {{ __('ui.Cancelar') }}
                </a>
            </div>
        </form>
    </div>
</x-ui.partials.page-header>
@endsection
