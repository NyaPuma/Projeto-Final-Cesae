@extends('ui.layout')

@section('page_key', 'stock-parts-edit')

@php($taxLabel = \App\Services\LocaleService::indirectTaxLabel())

@section('content')
<x-ui.partials.page-header
    :title="__('stock.Editar Peça')"
    :subtitle="__('stock.Atualize os dados da peça :sku.', ['sku' => $part->sku])"
>
    <div class="rounded-3xl border border-(--border) bg-(--surface) p-6 shadow-sm">
        <form id="partForm" class="space-y-6" novalidate data-part-form-mode="edit" data-part-id="{{ $part->id }}">
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partSku">
                        {{ __('common.Código (SKU)') }} <span class="ml-0.5 text-danger">*</span>
                    </label>
                    <input id="partSku" name="sku" type="text" required value="{{ old('sku', $part->sku) }}"
                        placeholder="{{ __('common.Ex: ROL-6204-2RS') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partName">
                        {{ __('common.Nome') }} <span class="ml-0.5 text-danger">*</span>
                    </label>
                    <input id="partName" name="name" type="text" required value="{{ old('name', $part->name) }}"
                        placeholder="{{ __('common.Ex: Rolamento 6204 2RS') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partBrand">
                        {{ __('common.Marca') }}
                    </label>
                    <input id="partBrand" name="brand" type="text" value="{{ old('brand', $part->brand) }}"
                        placeholder="{{ __('common.Ex: SKF') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partManufacturerRef">
                        {{ __('common.Referência do fabricante') }}
                    </label>
                    <input id="partManufacturerRef" name="manufacturer_ref" type="text" value="{{ old('manufacturer_ref', $part->manufacturer_ref) }}"
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
                            <option value="{{ $category->id }}" @selected($part->part_category_id === $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partUnit">
                        {{ __('common.Unidade de medida') }} <span class="ml-0.5 text-danger">*</span>
                    </label>
                    <select id="partUnit" name="unit_of_measure" required
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                        <option value="unit" @selected($part->unit_of_measure === 'unit')>{{ __('common.Unidade') }}</option>
                        <option value="meter" @selected($part->unit_of_measure === 'meter')>{{ __('common.Metro') }}</option>
                        <option value="liter" @selected($part->unit_of_measure === 'liter')>{{ __('common.Litro') }}</option>
                        <option value="kg" @selected($part->unit_of_measure === 'kg')>{{ __('common.Quilograma (kg)') }}</option>
                        <option value="pair" @selected($part->unit_of_measure === 'pair')>{{ __('common.Par') }}</option>
                        <option value="set" @selected($part->unit_of_measure === 'set')>{{ __('common.Kit / Conjunto') }}</option>
                        <option value="roll" @selected($part->unit_of_measure === 'roll')>{{ __('common.Rolo') }}</option>
                        <option value="other" @selected($part->unit_of_measure === 'other')>{{ __('common.Outro') }}</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partCostPrice">
                        {{ str_replace('IVA', $taxLabel, __('common.Preço de custo (sem IVA)')) }} <span class="ml-0.5 text-danger">*</span>
                    </label>
                    <input id="partCostPrice" name="cost_price" type="number" step="0.01" min="0" required value="{{ old('cost_price', $part->cost_price) }}"
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
                            <option value="{{ $taxRate->id }}" @selected($part->tax_rate_id === $taxRate->id)>{{ str_replace('IVA', $taxLabel, $taxRate->name) }} ({{ app(\App\Services\LocalizationService::class)->formatPercent((float) $taxRate->percent) }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partSalePrice">
                        {{ __('common.Preço de venda') }}
                    </label>
                    <input id="partSalePrice" name="sale_price" type="number" step="0.01" min="0" value="{{ old('sale_price', $part->sale_price) }}"
                        placeholder="{{ __('common.Opcional, para faturação interna') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partLocation">
                        {{ __('common.Localização') }}
                    </label>
                    <input id="partLocation" name="location" type="text" value="{{ old('location', $part->location) }}"
                        placeholder="{{ __('common.Ex: Armazém A · Prateleira 3 · Gaveta 2') }}"
                        class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div class="grid gap-6 lg:grid-cols-3">
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partCurrentStock">
                            {{ __('stock.Stock atual') }}
                        </label>
                        <input id="partCurrentStock" type="number" disabled value="{{ old('current_stock', $part->current_stock) }}"
                            class="w-full cursor-not-allowed rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text-soft) outline-none opacity-70">
                        <p class="mt-1 text-xs text-(--text-soft)">{{ __('stock.Edite o stock através de movimentos.') }}</p>
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partMinStock">
                            {{ __('stock.Stock mínimo') }} <span class="ml-0.5 text-danger">*</span>
                        </label>
                        <input id="partMinStock" name="min_stock" type="number" min="0" step="1" required value="{{ old('min_stock', $part->min_stock) }}"
                            class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partMaxStock">
                            {{ __('stock.Stock máximo') }}
                        </label>
                        <input id="partMaxStock" name="max_stock" type="number" min="0" step="1" value="{{ old('max_stock', $part->max_stock) }}"
                            class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partDescription">
                        {{ __('common.Descrição') }}
                    </label>
                    <textarea id="partDescription" name="description" rows="3" class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('description', $part->description) }}</textarea>
                </div>

                <div class="lg:col-span-2">
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-(--text-soft)" for="partTechnicalNotes">
                        {{ __('common.Notas técnicas') }}
                    </label>
                    <textarea id="partTechnicalNotes" name="technical_notes" rows="3" class="w-full rounded-2xl border border-(--border) bg-(--surface-2) px-4 py-3 text-sm text-(--text) outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('technical_notes', $part->technical_notes) }}</textarea>
                </div>

                <div class="lg:col-span-2">
                    <label class="inline-flex cursor-pointer items-center gap-2.5">
                        <input id="partActive" name="active" type="checkbox" @checked($part->active)
                            class="h-4 w-4 rounded border-(--border) text-primary focus:ring-primary">
                        <span class="text-xs font-semibold text-(--text)">{{ __('stock.Peça ativa no catálogo') }}</span>
                    </label>
                </div>
            </div>

            <div id="formMessage" class="min-h-6 text-sm font-medium text-(--text-soft)"></div>

            <div class="mt-6 flex flex-wrap gap-3 border-t border-(--border) pt-5">
                <button type="submit" id="submitBtn" class="ui-button ui-button--primary inline-flex items-center justify-center rounded-2xl px-5 py-3 text-sm font-semibold transition hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed">
                    {{ __('ui.Guardar Alterações') }}
                </button>
                <a href="{{ route('ui.stock.parts.show', $part) }}" class="ui-button ui-button--outline inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">
                    {{ __('ui.Cancelar') }}
                </a>
            </div>
        </form>
    </div>
</x-ui.partials.page-header>
@endsection
