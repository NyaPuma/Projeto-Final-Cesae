@extends('ui.layout')

@section('page_key', 'rooms-create')

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
            {{ __('ui.Criar Sala') }}
        </li>
    </ol>
</nav>

<x-ui.partials.page-header
    :title="__('ui.Criar Sala')"
    :subtitle="__('room.Registe uma nova sala e a sua localização no edifício.')"
    :badge="__('room.Sala')"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button href="{{ route('ui.rooms') }}" :label="__('room.Salas')" />
        </x-ui.page-actions.group>
    </x-slot:actions>

    <div class="grid gap-6 xl:grid-cols-2 items-start">
        <div class="space-y-6">
            <form id="roomForm" class="space-y-6" novalidate data-room-form-mode="create">

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
                                :value="old('name')"
                                :placeholder="__('room.Ex: Sala de Formação A')"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'roomCode'" :label="__('room.Código da Sala')">
                            <x-ui.form.input
                                id="roomCode"
                                name="code"
                                type="text"
                                :value="old('code')"
                                :placeholder="__('common.Ex: SAL-A01')"
                                class="py-3"
                            />
                            <p class="mt-1.5 text-xs text-[var(--text-soft)]">{{ __('common.Se deixar vazio, será gerado automaticamente.') }}</p>
                        </x-ui.form.field>

                        <div class="sm:col-span-2">
                            <x-ui.form.field :id="'roomDescription'" :label="__('common.Descrição')">
                                <textarea id="roomDescription" name="description" rows="3" placeholder="{{ __('ui.Recursos disponíveis, utilização prevista...') }}" class="w-full resize-none rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('description') }}</textarea>
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
                                :value="old('building')"
                                :placeholder="__('room.Ex: Edifício Principal')"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'roomFloor'" :label="__('common.Piso')">
                            <x-ui.form.input
                                id="roomFloor"
                                name="floor"
                                type="text"
                                :value="old('floor')"
                                :placeholder="__('common.Ex: 2')"
                                class="py-3"
                            />
                        </x-ui.form.field>

                        <x-ui.form.field :id="'roomLocation'" :label="__('common.Localização')">
                            <x-ui.form.input
                                id="roomLocation"
                                name="location"
                                type="text"
                                :value="old('location')"
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
                                :value="old('capacity')"
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
                            <input type="checkbox" id="roomActive" name="active" value="1" checked class="h-4 w-4 rounded border-[var(--border)] text-primary focus:ring-primary">
                            <div>
                                <label for="roomActive" class="text-sm font-semibold text-[var(--text)]">{{ __('common.Disponibilidade') }}</label>
                                <p class="text-xs text-[var(--text-soft)]">{{ __('room.Sala disponível para utilização') }}</p>
                            </div>
                        </div>

                        <x-ui.form.field :id="'roomNotes'" :label="__('common.Notas Internas')">
                            <textarea id="roomNotes" name="notes" rows="3" placeholder="{{ __('maintenance_plan.Apenas visível para a equipa de manutenção...') }}" class="w-full resize-none rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('notes') }}</textarea>
                        </x-ui.form.field>
                    </div>

                    <x-ui.form.message id="formMessage" />

                    <div class="pt-2 flex flex-wrap gap-3">
                        <x-ui.buttons.submit id="submitBtn" variant="primary" size="md" weight="semibold" class="rounded-2xl disabled:cursor-not-allowed disabled:opacity-50">
                            {{ __('ui.Guardar Sala') }}
                        </x-ui.buttons.submit>
                        <a href="{{ route('ui.rooms') }}" class="ui-button ui-button--outline inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">
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
                        <p class="text-xs leading-5 text-[var(--text-soft)]">{{ __('common.Se deixar vazio, será gerado automaticamente.') }}</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        <p class="text-xs leading-5 text-[var(--text-soft)]">{{ __('common.A capacidade é usada para calcular a ocupação e o limite de utilizadores.') }}</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        <p class="text-xs leading-5 text-[var(--text-soft)]">{{ __('maintenance_plan.Apenas visível para a equipa de manutenção...') }}</p>
                    </li>
                </ul>
            </x-ui.form.card>
        </div>
    </div>
</x-ui.partials.page-header>
@endsection