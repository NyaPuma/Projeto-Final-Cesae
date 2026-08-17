@extends('ui.layout')

@section('page_key', 'equipments-edit')

@section('content')
<x-ui.partials.page-header
    :title="__('equipment.Editar Equipamento')"
    :subtitle="$equipment->name"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.equipments.show', $equipment)" :label="__('ui.Voltar')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
        <form id="equipmentForm" class="space-y-6" novalidate data-equipment-form-mode="edit" data-equipment-id="{{ $equipment->id }}">
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="eqName">
                        {{ __('equipment.Nome do Equipamento') }} <span class="text-danger ml-0.5">*</span>
                    </label>
                    <input id="eqName" name="name" type="text" required value="{{ old('name', $equipment->name) }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="eqSerial">
                        {{ __('common.Número de Série / Código') }} <span class="text-danger ml-0.5">*</span>
                    </label>
                    <input id="eqSerial" name="serial" type="text" required value="{{ old('serial', $equipment->serial) }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="eqAssetTag">
                        {{ __('equipment.Etiqueta de Ativo') }}
                    </label>
                    <input id="eqAssetTag" name="asset_tag" type="text" value="{{ old('asset_tag', $equipment->asset_tag) }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="eqCategory">
                        {{ __('common.Categoria') }}
                    </label>
                    <select id="eqCategory" name="category_id" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                        <option value="">{{ __('common.Sem categoria') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) ($equipment->category_id ?? '') === (string) $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="eqRoom">
                        {{ __('room.Sala / Localização') }}
                    </label>
                    <select id="eqRoom" name="room_id" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                        <option value="">{{ __('room.Sem sala associada') }}</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" @selected((string) $equipment->room_id === (string) $room->id)>
                                {{ $room->name }}{{ $room->location ? ' · ' . $room->location : '' }}{{ $room->active ? '' : ' (' . __('common.inativa') . ')' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="eqStatus">
                        {{ __('common.Estado Operacional') }}
                    </label>
                    <select id="eqStatus" name="status" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                        <option value="operacional" @selected($equipment->status === 'operacional')>{{ __('common.Operacional') }}</option>
                        <option value="manutenção" @selected($equipment->status === 'manutenção')>{{ __('maintenance_plan.Em manutenção') }}</option>
                        <option value="avariado" @selected($equipment->status === 'avariado')>{{ __('common.Avariado') }}</option>
                        <option value="abatido" @selected($equipment->status === 'abatido')>{{ __('common.Abatido') }}</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="eqBrand">
                        {{ __('common.Marca') }}
                    </label>
                    <input id="eqBrand" name="brand" type="text" value="{{ old('brand', $equipment->brand) }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="eqModel">
                        {{ __('common.Modelo') }}
                    </label>
                    <input id="eqModel" name="model" type="text" value="{{ old('model', $equipment->model) }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="eqManufacturer">
                        {{ __('common.Fabricante') }}
                    </label>
                    <input id="eqManufacturer" name="manufacturer" type="text" value="{{ old('manufacturer', $equipment->manufacturer) }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="eqPurchaseDate">
                        {{ __('common.Data de Compra') }}
                    </label>
                    <input id="eqPurchaseDate" name="purchase_date" type="date" value="{{ old('purchase_date', $equipment->purchase_date?->format('Y-m-d')) }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="eqWarrantyUntil">
                        {{ __('common.Fim de Garantia') }}
                    </label>
                    <input id="eqWarrantyUntil" name="warranty_until" type="date" value="{{ old('warranty_until', $equipment->warranty_until?->format('Y-m-d')) }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="eqActive">
                        {{ __('common.Disponibilidade') }}
                    </label>
                    <div class="flex h-[46px] items-center gap-3">
                        <input id="eqActive" name="active" type="checkbox" value="1" @checked((bool) $equipment->active) class="h-4 w-4 rounded border-[var(--border)] text-primary focus:ring-primary">
                        <span class="text-sm font-semibold text-[var(--text)]">{{ __('equipment.Equipamento operacional no inventário') }}</span>
                    </div>
                </div>
            </div>

            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="eqNotes">
                    {{ __('common.Notas') }}
                </label>
                <textarea id="eqNotes" name="notes" rows="3" class="w-full resize-none rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('notes', $equipment->notes) }}</textarea>
            </div>

            <div id="formMessage" class="min-h-6 text-sm font-medium text-[var(--text-soft)]"></div>

            <div class="mt-6 flex flex-wrap gap-3 border-t border-[var(--border)] pt-5">
                <button type="submit" id="submitBtn" class="ui-button ui-button--primary inline-flex items-center justify-center rounded-2xl px-5 py-3 text-sm font-semibold transition hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed">
                    {{ __('ui.Guardar Alterações') }}
                </button>
                <a href="{{ route('ui.equipments.show', $equipment) }}" class="ui-button ui-button--outline inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">
                    {{ __('ui.Cancelar') }}
                </a>
            </div>
        </form>
    </div>
</x-ui.partials.page-header>
@endsection
