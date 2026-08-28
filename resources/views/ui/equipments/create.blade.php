@extends('ui.layout')

@section('page_key', 'equipments-create')

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
            {{ __('equipment.Criar Equipamento') }}
        </li>
    </ol>
</nav>

<x-ui.partials.page-header
    :title="__('equipment.Criar Equipamento')"
    :subtitle="__('equipment.Registe um novo equipamento no inventário e associe-o a uma sala e categoria.')"
    :badge="__('equipment.Equipamento')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button href="{{ route('ui.equipments') }}" :label="__('equipment.Equipamentos')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    <div class="grid gap-6 xl:grid-cols-2 items-start">
        <div class="space-y-6">
            <form id="equipmentForm" class="space-y-6" novalidate data-equipment-form-mode="create">

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
                                :value="old('name')"
                                :placeholder="__('equipment.Ex: Portátil Lenovo ThinkPad')"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqSerial'" :label="__('equipment.Número de Série')" :required="true">
                            <x-ui.form.input
                                id="eqSerial"
                                name="serial"
                                type="text"
                                :value="old('serial')"
                                :placeholder="__('equipment.Ex: PX2-9F7Q')"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqAssetTag'" :label="__('equipment.Código de Inventário')">
                            <x-ui.form.input
                                id="eqAssetTag"
                                name="asset_tag"
                                type="text"
                                :value="old('asset_tag')"
                                :placeholder="__('equipment.Ex: EQ-0001')"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqBrand'" :label="__('common.Marca')">
                            <x-ui.form.input
                                id="eqBrand"
                                name="brand"
                                type="text"
                                :value="old('brand')"
                                :placeholder="__('equipment.Ex: Lenovo')"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqModel'" :label="__('common.Modelo')">
                            <x-ui.form.input
                                id="eqModel"
                                name="model"
                                type="text"
                                :value="old('model')"
                                :placeholder="__('equipment.Ex: ThinkPad X1 Carbon')"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqManufacturer'" :label="__('equipment.Fabricante')">
                            <x-ui.form.input
                                id="eqManufacturer"
                                name="manufacturer"
                                type="text"
                                :value="old('manufacturer')"
                                :placeholder="__('equipment.Ex: Lenovo Group')"
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
                                    <option value="{{ $category->id }}" @selected((string) old('category_id') === (string) $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-ui.form.select>
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqRoom'" :label="__('room.Sala')">
                            <x-ui.form.select id="eqRoom" name="room_id">
                                <option value="">{{ __('room.Sem sala associada') }}</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" @selected((string) old('room_id') === (string) $room->id)>
                                        {{ $room->name }}@if(!$room->active) ({{ __('common.Inativa') }})@endif
                                    </option>
                                @endforeach
                            </x-ui.form.select>
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqStatus'" :label="__('equipment.Estado Operacional')">
                            <x-ui.form.select id="eqStatus" name="status">
                                <option value="operacional" @selected(old('status', 'operacional') === 'operacional')>{{ __('common.Operacional') }}</option>
                                <option value="manutenção" @selected(old('status') === 'manutenção')>{{ __('maintenance_plan.Em manutenção') }}</option>
                                <option value="avariado" @selected(old('status') === 'avariado')>{{ __('common.Avariado') }}</option>
                                <option value="abatido" @selected(old('status') === 'abatido')>{{ __('common.Abatido') }}</option>
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
                                :value="old('purchase_date')"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'eqWarrantyUntil'" :label="__('common.Fim de Garantia')">
                            <x-ui.form.input
                                id="eqWarrantyUntil"
                                name="warranty_until"
                                type="date"
                                :value="old('warranty_until')"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <div class="sm:col-span-2 flex items-center gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3">
                            <input type="checkbox" id="eqActive" name="active" value="1" checked class="h-4 w-4 rounded border-[var(--border)] text-primary focus:ring-primary">
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
                            <textarea id="eqNotes" name="notes" rows="3" placeholder="{{ __('maintenance_plan.Apenas visível para a equipa de manutenção...') }}" class="w-full resize-none rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('notes') }}</textarea>
                        </x-ui.form.field>
                    </div>

                    <x-ui.form.message id="formMessage" />

                    <div class="pt-2 flex flex-wrap gap-3">
                        <x-ui.buttons.submit id="submitBtn" variant="primary" size="md" weight="semibold" class="rounded-2xl disabled:cursor-not-allowed disabled:opacity-50">
                            {{ __('equipment.Guardar Equipamento') }}
                        </x-ui.buttons.submit>
                        <a href="{{ route('ui.equipments') }}" class="ui-button ui-button--outline inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">
                            {{ __('ui.Cancelar') }}
                        </a>
                    </div>
                </x-ui.form.card>
            </form>
        </div>

        <div class="space-y-6">
            {{-- Informações Úteis --}}
            <x-ui.form.card
                :title="__('common.Informações Úteis')"
                icon='<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>'
            >
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        <p class="text-xs leading-5 text-[var(--text-soft)]">{{ __('common.O número de série é obrigatório e deve ser único no inventário.') }}</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        <p class="text-xs leading-5 text-[var(--text-soft)]">{{ __('common.As garantias vencidas são destacadas nas listagens e no detalhe.') }}</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        <p class="text-xs leading-5 text-[var(--text-soft)]">{{ __('common.O estado operacional controla o que aparece nas listagens e nos resumos.') }}</p>
                    </li>
                </ul>
            </x-ui.form.card>
        </div>
    </div>
</x-ui.partials.page-header>
@endsection