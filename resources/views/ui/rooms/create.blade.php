@extends('ui.layout')

@section('page_key', 'rooms-create')

@section('content')
<x-ui.partials.page-header
    :title="__('ui.Criar Sala')"
    :subtitle="__('room.Registe uma nova sala e a sua localização no edifício.')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.rooms')" :label="__('ui.Voltar')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
        <form id="roomForm" class="space-y-6" novalidate data-room-form-mode="create">
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="roomName">
                        {{ __('room.Nome da Sala') }} <span class="text-danger ml-0.5">*</span>
                    </label>
                    <input id="roomName" name="name" type="text" required value="{{ old('name') }}" placeholder="{{ __('room.Ex: Sala de Formação A') }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="roomCode">
                        {{ __('room.Código da Sala') }}
                    </label>
                    <input id="roomCode" name="code" type="text" value="{{ old('code') }}" placeholder="{{ __('common.Ex: SAL-A01') }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                    <p class="mt-1.5 text-[10px] text-[var(--text-soft)]">{{ __('common.Se deixar vazio, será gerado automaticamente.') }}</p>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="roomBuilding">
                        {{ __('room.Edifício') }}
                    </label>
                    <input id="roomBuilding" name="building" type="text" value="{{ old('building') }}" placeholder="{{ __('room.Ex: Edifício Principal') }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="roomFloor">
                        {{ __('common.Piso') }}
                    </label>
                    <input id="roomFloor" name="floor" type="text" value="{{ old('floor') }}" placeholder="{{ __('common.Ex: 2') }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="roomLocation">
                        {{ __('common.Localização') }}
                    </label>
                    <input id="roomLocation" name="location" type="text" value="{{ old('location') }}" placeholder="{{ __('common.Ex: Ala Norte') }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="roomCapacity">
                        {{ __('common.Capacidade (lugares)') }}
                    </label>
                    <input id="roomCapacity" name="capacity" type="number" min="0" step="1" value="{{ old('capacity') }}" placeholder="{{ __('common.Ex: 25') }}" class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                </div>

                <div class="lg:col-span-2">
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="roomDescription">
                        {{ __('common.Descrição') }}
                    </label>
                    <textarea id="roomDescription" name="description" rows="3" placeholder="{{ __('ui.Recursos disponíveis, utilização prevista...') }}" class="w-full resize-none rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('description') }}</textarea>
                </div>

                <div class="lg:col-span-2">
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="roomNotes">
                        {{ __('common.Notas Internas') }}
                    </label>
                    <textarea id="roomNotes" name="notes" rows="3" placeholder="{{ __('maintenance_plan.Apenas visível para a equipa de manutenção...') }}" class="w-full resize-none rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('notes') }}</textarea>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]" for="roomActive">
                        {{ __('common.Disponibilidade') }}
                    </label>
                    <div class="flex h-[46px] items-center gap-3">
                        <input id="roomActive" name="active" type="checkbox" value="1" checked class="h-4 w-4 rounded border-[var(--border)] text-primary focus:ring-primary">
                        <span class="text-sm font-semibold text-[var(--text)]">{{ __('room.Sala disponível para utilização') }}</span>
                    </div>
                </div>
            </div>

            <div id="formMessage" class="min-h-6 text-sm font-medium text-[var(--text-soft)]"></div>

            <div class="mt-6 flex flex-wrap gap-3 border-t border-[var(--border)] pt-5">
                <button type="submit" id="submitBtn" class="ui-button ui-button--primary inline-flex items-center justify-center rounded-2xl px-5 py-3 text-sm font-semibold transition hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed">
                    {{ __('ui.Guardar Sala') }}
                </button>
                <a href="{{ route('ui.rooms') }}" class="ui-button ui-button--outline inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">
                    {{ __('ui.Cancelar') }}
                </a>
            </div>
        </form>
    </div>
</x-ui.partials.page-header>
@endsection
