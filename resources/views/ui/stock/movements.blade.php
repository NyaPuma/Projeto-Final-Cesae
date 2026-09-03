@extends('ui.layout')

@section('page_key', 'stock-movements')

@section('content')
<x-ui.partials.page-header
    :title="__('stock.Movimentos de Stock')"
    :subtitle="__('stock.Registe entradas, saídas, ajustes e devoluções de peças.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.stock.dashboard')" :label="__('stock.Voltar ao Stock')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    {{-- Quick registration form --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
        <h2 class="mb-4 text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('common.Registar movimento') }}</h2>
        <form id="movementForm" class="space-y-4" novalidate>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                {{-- Part Selection (with Modal) --}}
                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">
                        {{ __('stock.Peça') }} <span class="text-danger">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="mvPartSearch" name="part_search" autocomplete="off" required
                            placeholder="{{ __('stock.Clique para selecionar peça...') }}"
                            class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 transition-all cursor-pointer">
                        <input type="hidden" id="mvPart" name="part_id">
                    </div>
                </div>

                {{-- Movement Type --}}
                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">
                        {{ __('common.Tipo') }} <span class="text-danger">*</span>
                    </label>
                    <select id="mvType" name="movement_type" required
                        class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 transition-all">
                        <option value="in">{{ __('common.Entrada') }}</option>
                        <option value="out">{{ __('common.Saída') }}</option>
                        <option value="adjust">{{ __('common.Ajuste') }}</option>
                        <option value="return">{{ __('common.Devolução') }}</option>
                    </select>
                </div>

                {{-- Quantity --}}
                <div>
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">
                        {{ __('common.Quantidade') }} <span class="text-danger">*</span>
                    </label>
                    <input id="mvQty" name="quantity" type="number" step="1" required
                        placeholder="{{ __('common.Ex: 5') }}"
                        class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 transition-all">
                </div>
            </div>

            {{-- Reason --}}
            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]" for="mvReason">
                    {{ __('common.Motivo') }}
                </label>
                <input id="mvReason" name="reason" type="text"
                    placeholder="{{ __('stock.Ex: Reposição de stock / Intervenção #1234') }}"
                    class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-4 focus:ring-primary/15 transition-all">
            </div>

            {{-- Submit Button --}}
            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit" id="mvSubmit" class="inline-flex items-center justify-center rounded-xl bg-primary px-5 py-3 text-xs font-black uppercase tracking-wider transition hover:opacity-90 disabled:opacity-50 shadow-lg shadow-primary/20">
                    {{ __('common.Registar') }}
                </button>
                <p id="mvMessage" class="text-xs font-medium text-[var(--text-soft)]"></p>
            </div>
        </form>
    </div>

    <x-ui.listing.filter-panel>
        <x-ui.listing.filter-field for="filter_part" :label="__('stock.Peça')">
            <select id="filter_part" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                <option value="">{{ __('common.Todas') }}</option>
                @foreach($parts as $part)
                    <option value="{{ $part->id }}" @selected(request('part_id') == $part->id)>{{ $part->name }}</option>
                @endforeach
            </select>
        </x-ui.listing.filter-field>

        <x-ui.listing.filter-field for="filter_type" :label="__('common.Tipo de Movimento')">
            <select id="filter_type" class="w-full rounded-xl border border-(--border) bg-(--surface-2) px-3 py-2.5 text-xs text-(--text) outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                <option value="">{{ __('common.Todos') }}</option>
                <option value="in">{{ __('common.Entrada') }}</option>
                <option value="out">{{ __('common.Saída') }}</option>
                <option value="adjust">{{ __('common.Ajuste') }}</option>
                <option value="return">{{ __('common.Devolução') }}</option>
            </select>
        </x-ui.listing.filter-field>
    </x-ui.listing.filter-panel>

    <x-ui.listing.table-card
        table_id="movementsTable"
        body_id="movementsTableBody"
        :aria_label="__('stock.Lista de movimentos de stock')"
        :loading_message="__('ui.A carregar movimentos...')"
        :columns="5"
    >
        <x-slot:head>
            <tr>
                <th class="px-5 py-4 font-bold">{{ __('common.Data') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('stock.Peça') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Tipo') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Variação') }}</th>
                <th class="px-5 py-4 font-bold">{{ __('common.Motivo') }}</th>
            </tr>
        </x-slot:head>
    </x-ui.listing.table-card>

    <x-ui.listing.pagination />
</x-ui.partials.page-header>
@endsection
