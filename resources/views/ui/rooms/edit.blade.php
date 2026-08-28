@extends('ui.layout')

@section('page_key', 'rooms-edit')

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
            <a href="{{ route('ui.rooms') }}" class="font-medium text-[var(--text-soft)] transition-colors hover:text-[var(--text)]">
                {{ __('room.Salas') }}
            </a>
        </li>
        <li aria-hidden="true" class="select-none text-[var(--text-soft)]">/</li>
        <li aria-current="page" class="font-semibold text-[var(--text)]">
            {{ $room->name }}
        </li>
    </ol>
</nav>

<x-ui.partials.page-header
    :title="__('ui.Editar Sala')"
    :subtitle="$room->name"
    :badge="$room->code"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button href="{{ route('ui.rooms.show', $room) }}" :label="__('room.Sala')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    <div class="grid gap-6 xl:grid-cols-2 items-start">
        <div class="space-y-6">
            <form id="roomForm" class="space-y-6" novalidate data-room-form-mode="edit" data-room-id="{{ $room->id }}">

                {{-- Informação da Sala --}}
                <x-ui.form.card
                    :title="__('room.Informação da Sala')"
                    icon='<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>'
                >
                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-ui.form.field :id="'roomName'" :label="__('room.Nome da Sala')" :required="true">
                            <x-ui.form.input
                                id="roomName"
                                name="name"
                                type="text"
                                :value="old('name', $room->name)"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'roomCode'" :label="__('room.Código da Sala')">
                            <x-ui.form.input
                                id="roomCode"
                                name="code"
                                type="text"
                                :value="old('code', $room->code)"
                                class="py-3"
                            />
                            <p class="mt-1.5 text-xs text-[var(--text-soft)]">{{ __('common.Se deixar vazio, será gerado automaticamente.') }}</p>
                        </x-ui.form.field>

                        <div class="sm:col-span-2">
                            <x-ui.form.field :id="'roomDescription'" :label="__('common.Descrição')">
                                <textarea id="roomDescription" name="description" rows="3" class="w-full resize-none rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('description', $room->description) }}</textarea>
                            </x-ui.form.field>
                        </div>
                    </div>
                </x-ui.form.card>

                {{-- Localização & Capacidade --}}
                <x-ui.form.card
                    :title="__('common.Localização & Capacidade')"
                    icon='<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0zM19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>'
                >
                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-ui.form.field :id="'roomBuilding'" :label="__('room.Edifício')">
                            <x-ui.form.input
                                id="roomBuilding"
                                name="building"
                                type="text"
                                :value="old('building', $room->building)"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'roomFloor'" :label="__('common.Piso')">
                            <x-ui.form.input
                                id="roomFloor"
                                name="floor"
                                type="text"
                                :value="old('floor', $room->floor)"
                                :placeholder="__('common.Ex: 2')"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'roomLocation'" :label="__('common.Localização')">
                            <x-ui.form.input
                                id="roomLocation"
                                name="location"
                                type="text"
                                :value="old('location', $room->location)"
                                :placeholder="__('common.Ex: Ala Norte')"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'roomCapacity'" :label="__('common.Capacidade (lugares)')">
                            <x-ui.form.input
                                id="roomCapacity"
                                name="capacity"
                                type="number"
                                min="0"
                                step="1"
                                :value="old('capacity', $room->capacity)"
                                :placeholder="__('common.Ex: 25')"
                                class="py-3"
                            />
                        </x-ui.form.field>
                    </div>
                </x-ui.form.card>

                {{-- Disponibilidade & Notas --}}
                <x-ui.form.card
                    :title="__('common.Disponibilidade & Notas')"
                    icon='<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                >
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" id="roomActive" name="active" value="1" @checked((bool) $room->active) class="h-4 w-4 rounded border-[var(--border)] text-primary focus:ring-primary">
                            <div>
                                <label for="roomActive" class="text-sm font-semibold text-[var(--text)]">{{ __('common.Disponibilidade') }}</label>
                                <p class="text-xs text-[var(--text-soft)]">{{ __('room.Sala disponível para utilização') }}</p>
                            </div>
                        </div>

                        <x-ui.form.field :id="'roomNotes'" :label="__('common.Notas Internas')">
                            <textarea id="roomNotes" name="notes" rows="3" placeholder="{{ __('maintenance_plan.Apenas visível para a equipa de manutenção...') }}" class="w-full resize-none rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('notes', $room->notes) }}</textarea>
                        </x-ui.form.field>
                    </div>

                    <x-ui.form.message id="formMessage" />

                    <div class="pt-2 flex flex-wrap gap-3">
                        <x-ui.buttons.submit id="submitBtn" variant="primary" size="md" weight="semibold" class="rounded-2xl disabled:cursor-not-allowed disabled:opacity-50">
                            {{ __('ui.Guardar Alterações') }}
                        </x-ui.buttons.submit>
                        <a href="{{ route('ui.rooms.show', $room) }}" class="ui-button ui-button--outline inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">
                            {{ __('ui.Cancelar') }}
                        </a>
                    </div>
                </x-ui.form.card>
            </form>
        </div>

        <div class="space-y-6">
            {{-- Resumo da Sala --}}
            <x-ui.form.card
                :title="__('common.Resumo da Sala')"
                icon='<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/></svg>'
            >
                <div class="mb-4 flex items-center gap-2">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full opacity-50 {{ $room->active ? 'bg-success' : 'bg-[var(--border)]' }}"></span>
                        <span class="relative inline-flex h-2.5 w-2.5 rounded-full {{ $room->active ? 'bg-success' : 'bg-[var(--border)]' }}"></span>
                    </span>
                    <span class="text-sm font-semibold text-[var(--text)]">{{ $room->active ? __('room.Sala Ativa') : __('room.Sala Inativa') }}</span>
                </div>

                <div class="space-y-4 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4 text-sm text-[var(--text-soft)]">
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <span>{{ __('room.Edifício') }}</span>
                        <span class="font-semibold text-[var(--text)]">{{ $room->building ?? __('common.Não definido') }}</span>
                    </div>
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <span>{{ __('common.Piso') }}</span>
                        <span class="font-semibold text-[var(--text)]">{{ $room->floor ?? __('common.Não definido') }}</span>
                    </div>
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <span>{{ __('common.Localização') }}</span>
                        <span class="font-semibold text-[var(--text)]">{{ $room->location ?? __('common.Não definido') }}</span>
                    </div>
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <span>{{ __('common.Capacidade') }}</span>
                        <span class="font-semibold text-[var(--text)]">{{ $room->capacity ? $room->capacity . ' ' . __('common.lugares') : __('common.Não definida') }}</span>
                    </div>
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <span>{{ __('common.Registada em') }}</span>
                        <span class="font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($room->created_at) ?: '—' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>{{ __('common.Última atualização') }}</span>
                        <span class="font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($room->updated_at) ?: '—' }}</span>
                    </div>
                </div>
            </x-ui.form.card>
        </div>
    </div>
</x-ui.partials.page-header>
@endsection