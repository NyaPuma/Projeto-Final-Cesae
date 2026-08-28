@extends('ui.layout')

@section('page_key', 'equipments-edit')

@section('content')
<nav aria-label="{{ __('common.Breadcrumb') }}" class="mb-4">
    <ol class="flex flex-wrap items-center gap-1.5 text-sm">
        <li>
            <a href="{{ route('ui.index') }}" class="font-medium text-[var(--text-soft)] transition-colors hover:text-[var(--text)]">
                {{ __('dashboard.Painel') }}
            </a>
        </li>
        <li aria-hidden="true" class="select-none text-[var(--text-soft)]">/</li>
        <li>
            <a href="{{ route('ui.equipments') }}" class="font-medium text-[var(--text-soft)] transition-colors hover:text-[var(--text)]">
                {{ __('equipment.Equipamentos') }}
            </a>
        </li>
        <li aria-hidden="true" class="select-none text-[var(--text-soft)]">/</li>
        <li aria-current="page" class="font-semibold text-[var(--text)]">
            {{ $equipment->name }}
        </li>
    </ol>
</nav>

@php
    $statusLabels = [
        'operacional' => __('common.Operacional'),
        'manutenção' => __('maintenance_plan.Em manutenção'),
        'avariado' => __('common.Avariado'),
        'abatido' => __('common.Abatido'),
    ];
    $statusClass = [
        'operacional' => 'bg-success/10 text-success',
        'manutenção' => 'bg-warning/10 text-warning',
        'avariado' => 'bg-danger/10 text-danger',
        'abatido' => 'bg-[var(--text-soft)]/10 text-[var(--text-soft)]',
    ];
@endphp

<x-ui.partials.page-header
    :title="__('equipment.Editar Equipamento')"
    :subtitle="$equipment->name"
    :badge="$equipment->serial"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button href="{{ route('ui.equipments.show', $equipment) }}" :label="__('equipment.Equipamento')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    <div class="grid gap-6 xl:grid-cols-2 items-start">
        <div class="space-y-6">
            <form id="equipmentForm" class="space-y-6" novalidate data-equipment-form-mode="edit" data-equipment-id="{{ $equipment->id }}">

                {{-- Informação do Equipamento --}}
                <x-ui.form.card
                    :title="__('equipment.Informação do Equipamento')"
                    icon='<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3zM6 6h.008v.008H6V6z"/></svg>'
                >
                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-ui.form.field :id="'eqName'" :label="__('equipment.Nome do Equipamento')" :required="true">
                            <x-ui.form.input
                                id="eqName"
                                name="name"
                                type="text"
                                :value="old('name', $equipment->name)"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqSerial'" :label="__('equipment.Número de Série')" :required="true">
                            <x-ui.form.input
                                id="eqSerial"
                                name="serial"
                                type="text"
                                :value="old('serial', $equipment->serial)"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqAssetTag'" :label="__('equipment.Código de Inventário')">
                            <x-ui.form.input
                                id="eqAssetTag"
                                name="asset_tag"
                                type="text"
                                :value="old('asset_tag', $equipment->asset_tag)"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqBrand'" :label="__('common.Marca')">
                            <x-ui.form.input
                                id="eqBrand"
                                name="brand"
                                type="text"
                                :value="old('brand', $equipment->brand)"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqModel'" :label="__('common.Modelo')">
                            <x-ui.form.input
                                id="eqModel"
                                name="model"
                                type="text"
                                :value="old('model', $equipment->model)"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqManufacturer'" :label="__('equipment.Fabricante')">
                            <x-ui.form.input
                                id="eqManufacturer"
                                name="manufacturer"
                                type="text"
                                :value="old('manufacturer', $equipment->manufacturer)"
                                class="py-3"
                            />
                        </x-ui.form.field>
                    </div>
                </x-ui.form.card>

                {{-- Classificação & Localização --}}
                <x-ui.form.card
                    :title="__('equipment.Classificação & Localização')"
                    icon='<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0zM19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>'
                >
                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-ui.form.field :id="'eqCategory'" :label="__('common.Categoria')">
                            <x-ui.form.select id="eqCategory" name="category_id">
                                <option value="">{{ __('common.Sem categoria') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected((string) old('category_id', $equipment->category_id) === (string) $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-ui.form.select>
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqRoom'" :label="__('room.Sala')">
                            <x-ui.form.select id="eqRoom" name="room_id">
                                <option value="">{{ __('room.Sem sala associada') }}</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" @selected((string) old('room_id', $equipment->room_id) === (string) $room->id)>
                                        {{ $room->name }}@if(!$room->active) ({{ __('common.Inativa') }})@endif
                                    </option>
                                @endforeach
                            </x-ui.form.select>
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqStatus'" :label="__('equipment.Estado Operacional')">
                            <x-ui.form.select id="eqStatus" name="status">
                                <option value="operacional" @selected(old('status', $equipment->status) === 'operacional')>{{ __('common.Operacional') }}</option>
                                <option value="manutenção" @selected(old('status', $equipment->status) === 'manutenção')>{{ __('maintenance_plan.Em manutenção') }}</option>
                                <option value="avariado" @selected(old('status', $equipment->status) === 'avariado')>{{ __('common.Avariado') }}</option>
                                <option value="abatido" @selected(old('status', $equipment->status) === 'abatido')>{{ __('common.Abatido') }}</option>
                            </x-ui.form.select>
                        </x-ui.form.field>
                    </div>
                </x-ui.form.card>

                {{-- Ciclo de Vida & Garantia --}}
                <x-ui.form.card
                    :title="__('equipment.Ciclo de Vida & Garantia')"
                    icon='<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>'
                >
                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-ui.form.field :id="'eqPurchaseDate'" :label="__('common.Data de Compra')">
                            <x-ui.form.input
                                id="eqPurchaseDate"
                                name="purchase_date"
                                type="date"
                                :value="old('purchase_date', $equipment->purchase_date?->format('Y-m-d'))"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqWarrantyUntil'" :label="__('common.Fim de Garantia')">
                            <x-ui.form.input
                                id="eqWarrantyUntil"
                                name="warranty_until"
                                type="date"
                                :value="old('warranty_until', $equipment->warranty_until?->format('Y-m-d'))"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <div class="sm:col-span-2 flex items-center gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3">
                            <input type="checkbox" id="eqActive" name="active" value="1" @checked((bool) $equipment->active) class="h-4 w-4 rounded border-[var(--border)] text-primary focus:ring-primary">
                            <div>
                                <label for="eqActive" class="text-sm font-semibold text-[var(--text)]">{{ __('common.Disponibilidade') }}</label>
                                <p class="text-xs text-[var(--text-soft)]">{{ __('equipment.Disponível para utilização') }}</p>
                            </div>
                        </div>
                    </div>
                </x-ui.form.card>

                {{-- Notas & Registo --}}
                <x-ui.form.card
                    :title="__('common.Notas & Registo')"
                    icon='<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>'
                >
                    <div class="space-y-4">
                        <x-ui.form.field :id="'eqNotes'" :label="__('common.Notas Internas')">
                            <textarea id="eqNotes" name="notes" rows="3" placeholder="{{ __('maintenance_plan.Apenas visível para a equipa de manutenção...') }}" class="w-full resize-none rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('notes', $equipment->notes) }}</textarea>
                        </x-ui.form.field>
                    </div>

                    <x-ui.form.message id="formMessage" />

                    <div class="pt-2 flex flex-wrap gap-3">
                        <x-ui.buttons.submit id="submitBtn" variant="primary" size="md" weight="semibold" class="rounded-2xl disabled:cursor-not-allowed disabled:opacity-50">
                            {{ __('ui.Guardar Alterações') }}
                        </x-ui.buttons.submit>
                        <a href="{{ route('ui.equipments.show', $equipment) }}" class="ui-button ui-button--outline inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">
                            {{ __('ui.Cancelar') }}
                        </a>
                    </div>
                </x-ui.form.card>
            </form>
        </div>

        <div class="space-y-6">
            {{-- Resumo do Equipamento --}}
            <x-ui.form.card
                :title="__('common.Resumo do Equipamento')"
                icon='<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/></svg>'
            >
                <div class="mb-4 flex items-center gap-2">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full opacity-50 {{ $equipment->active ? 'bg-success' : 'bg-[var(--border)]' }}"></span>
                        <span class="relative inline-flex h-2.5 w-2.5 rounded-full {{ $equipment->active ? 'bg-success' : 'bg-[var(--border)]' }}"></span>
                    </span>
                    <span class="text-sm font-semibold text-[var(--text)]">{{ $equipment->active ? __('equipment.Ativo') : __('equipment.Inativo') }}</span>
                    <span class="ml-auto rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass[$equipment->status] ?? 'bg-[var(--surface-2)] text-[var(--text-soft)]' }}">
                        {{ $statusLabels[$equipment->status] ?? ucfirst($equipment->status) }}
                    </span>
                </div>

                <div class="space-y-4 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 text-sm text-[var(--text-soft)]">
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <span>{{ __('common.Categoria') }}</span>
                        <span class="font-semibold text-[var(--text)]">{{ $equipment->category?->name ?: __('common.Sem categoria') }}</span>
                    </div>
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <span>{{ __('room.Sala') }}</span>
                        <span class="font-semibold text-[var(--text)]">{{ $equipment->room?->name ?: __('room.Sem sala associada') }}</span>
                    </div>
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <span>{{ __('common.Marca · Modelo') }}</span>
                        <span class="font-semibold text-[var(--text)]">{{ trim(($equipment->brand ?? '') . ' ' . ($equipment->model ?? '')) ?: __('common.Não definido') }}</span>
                    </div>
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <span>{{ __('common.Data de Compra') }}</span>
                        <span class="font-semibold text-[var(--text)]">{{ $equipment->purchase_date ? app(\App\Services\LocalizationService::class)->formatDate($equipment->purchase_date) : __('common.Não definida') }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3">
                        <span>{{ __('common.Fim de Garantia') }}</span>
                        @if($equipment->warranty_until)
                            <span class="font-semibold {{ $equipment->warranty_until->lt(today()) ? 'text-danger' : 'text-[var(--text)]' }}">
                                {{ app(\App\Services\LocalizationService::class)->formatDate($equipment->warranty_until) }}
                            </span>
                        @else
                            <span class="font-semibold text-[var(--text)]">{{ __('common.Não definida') }}</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between border-t border-[var(--border)] pt-3">
                        <span>{{ __('common.Registado em') }}</span>
                        <span class="font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($equipment->created_at) ?: '—' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>{{ __('common.Última atualização') }}</span>
                        <span class="font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($equipment->updated_at) ?: '—' }}</span>
                    </div>
                </div>
            </x-ui.form.card>
        </div>
    </div>
</x-ui.partials.page-header>
@endsection