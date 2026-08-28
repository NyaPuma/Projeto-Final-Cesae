@extends('ui.layout')

@section('page_key', 'equipment-detail')

@php
    // --- Presentation helpers (styling only, no business rules) ---
    $warrantyExpired = $equipment->warranty_until && $equipment->warranty_until->isPast();

    // Normalised floor label — the stored value already begins with "Piso",
    // so only prefix it again when it starts with an actual number.
    $roomFloor = $equipment->room?->floor;
    $roomFloorLabel = $roomFloor
        ? (preg_match('/^\d/', trim($roomFloor)) ? __('common.Piso :floor', ['floor' => $roomFloor]) : trim($roomFloor))
        : null;

    // --- Inline icons (Heroicons outline — consistent with the existing convention) ---
    $icon = [
        'tag' => '<svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/></svg>',
        'pin' => '<svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>',
        'pinLg' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>',
        'shield' => '<svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>',
        'shieldWarn' => '<svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>',
        'shield5' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>',
        'inbox' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z"/></svg>',
        'wrench' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 01-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 11-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 016.336-4.486l-3.276 3.276a3.004 3.004 0 002.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852z"/></svg>',
        'ticket5' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9.75-3v.75m3-3v.75m0 3v.75M4.5 21h15a2.25 2.25 0 002.25-2.25V5.25A2.25 2.25 0 0019.5 3h-15A2.25 2.25 0 002.25 5.25v13.5A2.25 2.25 0 004.5 21z"/></svg>',
        'ticketLg' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9.75-3v.75m3-3v.75m0 3v.75M4.5 21h15a2.25 2.25 0 002.25-2.25V5.25A2.25 2.25 0 0019.5 3h-15A2.25 2.25 0 002.25 5.25v13.5A2.25 2.25 0 004.5 21z"/></svg>',
        'gear' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.28z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
        'doc' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>',
        'pencil' => '<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487zm0 0L19.5 7.125"/></svg>',
        'qr' => '<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75c0-.621.504-1.125 1.125-1.125h.75c.621 0 1.125.504 1.125 1.125v.75c0 .621-.504 1.125-1.125 1.125h-.75a1.125 1.125 0 01-1.125-1.125v-.75z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 16.5c0-.621.504-1.125 1.125-1.125h.75c.621 0 1.125.504 1.125 1.125v.75c0 .621-.504 1.125-1.125 1.125h-.75a1.125 1.125 0 01-1.125-1.125v-.75z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 12.75c0-.621.504-1.125 1.125-1.125h.75c.621 0 1.125.504 1.125 1.125v.75c0 .621-.504 1.125-1.125 1.125h-.75a1.125 1.125 0 01-1.125-1.125v-.75z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 16.5c0-.621.504-1.125 1.125-1.125h.75c.621 0 1.125.504 1.125 1.125v.75c0 .621-.504 1.125-1.125 1.125h-.75a1.125 1.125 0 01-1.125-1.125v-.75z"/></svg>',
    ];
@endphp

@section('content')
<x-ui.partials.page-header
    :title="$equipment->name"
    :subtitle="trim(($equipment->brand ?? '') . ' ' . ($equipment->model ?? '')) ?: $equipment->serial"
    :badge="$equipment->serial"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button href="/ui/equipments" :label="__('equipment.Voltar aos Equipamentos')" />

            <x-ui.page-actions.create-link
                :href="route('ui.tickets.create') . '?equipment_id=' . $equipment->id"
                :label="__('tickets.Abrir Ticket')"
            />

            @if(isset($user) && $user && $user->isAdmin())
                <x-ui.page-actions.create-link
                    :href="route('ui.equipments.qr', $equipment)"
                    :label="__('common.Código QR')"
                    :icon="$icon['qr']"
                />

                <x-ui.page-actions.create-link
                    :href="route('ui.equipments.edit', $equipment)"
                    :label="__('equipment.Editar Equipamento')"
                    :icon="$icon['pencil']"
                />
            @endif
        </x-ui.page-actions.group>
    </x-slot:actions>

    {{-- =================================================================== --}}
    {{-- Equipment status bar --}}
    {{-- =================================================================== --}}
    <div class="mb-6 flex flex-wrap items-center gap-3">
        <span class="inline-flex items-center gap-2 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-bold text-[var(--text)]">
            <span class="relative flex h-2.5 w-2.5">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full opacity-50 {{ $equipment->active ? 'bg-success' : 'bg-[var(--border)]' }}"></span>
                <span class="relative inline-flex h-2.5 w-2.5 rounded-full {{ $equipment->active ? 'bg-success' : 'bg-[var(--border)]' }}"></span>
            </span>
            {{ $equipment->active ? __('equipment.Ativo') : __('equipment.Inativo') }}
        </span>

        <x-ui.text.badge kind="equipmentStatus" :value="$equipment->status" size="md" />

        <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
            <span aria-hidden="true" class="text-[var(--text-soft)]">{!! $icon['tag'] !!}</span>
            {{ __('common.Categoria') }}: <b class="text-[var(--text)]">{{ $equipment->category?->name ?? __('common.Sem categoria') }}</b>
        </span>

        <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
            <span aria-hidden="true" class="text-[var(--text-soft)]">{!! $icon['pin'] !!}</span>
            {{ __('room.Sala') }}: <b class="text-[var(--text)]">{{ $equipment->room?->name ?? __('common.Não associada') }}</b>
        </span>

        @if($equipment->warranty_until)
            <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold {{ $warrantyExpired ? 'text-danger' : 'text-success' }}">
                <span aria-hidden="true">{!! $warrantyExpired ? $icon['shieldWarn'] : $icon['shield'] !!}</span>
                {{ __('common.Garantia') }}: <b>{{ app(\App\Services\LocalizationService::class)->formatDate($equipment->warranty_until) }}</b>
            </span>
        @endif
    </div>

    {{-- =================================================================== --}}
    {{-- Indicators (KPI) --}}
    {{-- =================================================================== --}}
    <div class="mb-8 grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-5">
        <x-ui.stats.stat-card
            :label="__('dashboard.Tickets Abertos')"
            :icon="$icon['inbox']"
            icon-class="text-[var(--text-soft)]"
            :sublabel="__('common.por resolver')"
            :tone="$openTicketsCount > 0 ? 'warning' : null"
        >{{ $openTicketsCount }}</x-ui.stats.stat-card>

        <x-ui.stats.stat-card
            :label="__('common.Em Curso')"
            :icon="$icon['wrench']"
            icon-class="text-[var(--text-soft)]"
            :sublabel="__('common.intervenções')"
            :tone="$inProgressTicketsCount > 0 ? 'info' : null"
        >{{ $inProgressTicketsCount }}</x-ui.stats.stat-card>

        <x-ui.stats.stat-card
            :label="__('tickets.Total Tickets')"
            :icon="$icon['ticket5']"
            icon-class="text-[var(--text-soft)]"
            :sublabel="__('common.histórico')"
        >{{ $tickets->count() }}</x-ui.stats.stat-card>

        <x-ui.stats.stat-card
            :label="__('common.Garantia')"
            :icon="$icon['shield5']"
            icon-class="{{ $warrantyExpired ? 'text-danger' : 'text-[var(--text-soft)]' }}"
            :sublabel="$warrantyExpired ? __('common.expirada') : __('common.fim da cobertura')"
            :tone="$warrantyExpired ? 'danger' : null"
        >{{ app(\App\Services\LocalizationService::class)->formatDate($equipment->warranty_until) ?: '—' }}</x-ui.stats.stat-card>

        <x-ui.stats.stat-card
            :label="__('common.Estado')"
            :icon="$icon['gear']"
            icon-class="text-[var(--text-soft)]"
            :sublabel="$equipment->active ? __('equipment.ativo') : __('equipment.inativo')"
        >{{ ucfirst($equipment->status) }}</x-ui.stats.stat-card>
    </div>

    {{-- =================================================================== --}}
    {{-- Body: Info + Room (left) | Tickets + Audit (right) --}}
    {{-- =================================================================== --}}
    <div class="grid items-start gap-6 xl:grid-cols-[1.5fr_1fr]">

        <div class="space-y-6">

            {{-- Equipment Information --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <h2 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('equipment.Informação do Equipamento') }}</h2>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ $equipment->asset_tag ?? __('common.sem etiqueta') }}</span>
                </div>

                <dl class="grid gap-x-6 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Número de Série') }}</dt>
                        <dd class="mt-1 font-mono text-xs font-semibold text-[var(--text)]">{{ $equipment->serial ?? __('common.Não definido') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('equipment.Etiqueta de Ativo') }}</dt>
                        <dd class="mt-1 font-mono text-xs font-semibold text-[var(--text)]">{{ $equipment->asset_tag ?? __('common.Não definida') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Marca') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $equipment->brand ?? __('common.Não definida') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Modelo') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $equipment->model ?? __('common.Não definido') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Fabricante') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $equipment->manufacturer ?? __('common.Não definido') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Categoria') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $equipment->category?->name ?? __('common.Sem categoria') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Data de Compra') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDate($equipment->purchase_date) ?: __('common.Não definida') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Fim de Garantia') }}</dt>
                        <dd class="mt-1 text-xs font-semibold {{ $warrantyExpired ? 'text-danger' : 'text-[var(--text)]' }}">
                            {{ app(\App\Services\LocalizationService::class)->formatDate($equipment->warranty_until) ?: __('common.Não definido') }}
                            @if($equipment->warranty_until)
                                <span class="ml-1 inline-flex items-center gap-1">
                                    <span aria-hidden="true">{!! $warrantyExpired ? $icon['shieldWarn'] : $icon['shield'] !!}</span>
                                    @if($warrantyExpired)<span>· {{ __('common.expirada') }}</span>@endif
                                </span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Registado em') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($equipment->created_at) ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Última atualização') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($equipment->updated_at) ?: '—' }}</dd>
                    </div>
                </dl>

                @if($equipment->notes)
                    <div class="mt-6 border-t border-[var(--border)] pt-4">
                        <h3 class="mb-2 text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Notas') }}</h3>
                        <p class="rounded-xl border border-warning/20 bg-warning/5 p-3 text-xs leading-6 text-[var(--text)]">{{ $equipment->notes }}</p>
                    </div>
                @endif
            </div>

            {{-- Associated Room --}}
            <div class="overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
                    <h2 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('room.Sala Associada') }}</h2>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-xs font-bold text-[var(--text-soft)]">{{ $equipment->room?->code ?? '—' }}</span>
                </div>

                @if($equipment->room)
                    <a href="{{ route('ui.rooms.show', $equipment->room) }}" class="group block px-6 py-5 transition-colors hover:bg-[var(--surface-2)]">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-bold text-[var(--text)] group-hover:text-primary">{{ $equipment->room->name }}</p>
                                <p class="mt-1 text-xs text-[var(--text-soft)]">
                                    {{ implode(' · ', array_filter([$equipment->room->building, $roomFloorLabel, $equipment->room->location])) ?: __('common.Sem localização registada.') }}
                                </p>
                            </div>
                            <span class="shrink-0 rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2.5 py-1 text-xs font-bold text-[var(--text-soft)] transition group-hover:border-primary/30 group-hover:text-primary">
                                {{ __('room.Ver sala') }} →
                            </span>
                        </div>
                    </a>
                @else
                    <div class="px-6 py-10 text-center">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--surface-2)] text-[var(--text-soft)]" aria-hidden="true">{!! $icon['pinLg'] !!}</div>
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('equipment.Sem sala associada a este equipamento.') }}</p>
                        <p class="mt-1 text-xs text-[var(--text-soft)]">{{ __('equipment.Associe o equipamento a uma sala através da edição.') }}</p>
                    </div>
                @endif
            </div>

        </div>

        <div class="space-y-6">

            {{-- Recent Tickets --}}
            <div class="overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
                    <h2 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('tickets.Tickets Recentes') }}</h2>
                    <a href="/ui/tickets" class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-xs font-bold text-primary transition hover:bg-[var(--border)]">
                        {{ __('common.Ver todos') }}
                    </a>
                </div>

                @if($tickets->isEmpty())
                    <div class="px-6 py-10 text-center">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--surface-2)] text-[var(--text-soft)]" aria-hidden="true">{!! $icon['ticketLg'] !!}</div>
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('tickets.Sem tickets associados a este equipamento.') }}</p>
                        <p class="mt-1 text-xs text-[var(--text-soft)]">{{ __('tickets.Os tickets criados para este equipamento aparecerão aqui.') }}</p>
                    </div>
                @else
                    <ul class="divide-y divide-[var(--border)]">
                        @foreach($tickets->take(5) as $ticket)
                            <li>
                                <a href="/ui/tickets/{{ $ticket->id }}" class="block px-6 py-3.5 transition-colors hover:bg-[var(--surface-2)]">
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="truncate text-xs font-bold text-[var(--text)]">{{ $ticket->title }}</p>
                                        <x-ui.text.badge kind="priority" :value="$ticket->priority" size="badge">
                                            {{ \App\Enums\TicketPriorityEnum::normalize((string) $ticket->priority)?->label() ?? $ticket->priority }}
                                        </x-ui.text.badge>
                                    </div>
                                    <div class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-[var(--text-soft)]">
                                        <span class="font-mono font-semibold">{{ $ticket->reference }}</span>
                                        <x-ui.text.badge kind="ticketStatus" :value="$ticket->status?->name" size="badge">
                                            {{ \App\Enums\TicketStatusEnum::normalize((string) ($ticket->status?->name ?? ''))?->label() ?? __('common.Sem estado') }}
                                        </x-ui.text.badge>
                                        <span>
                                            {{ $ticket->technician ? __('common.Técnico: :name', ['name' => $ticket->technician->name]) : __('common.Por atribuir') }}
                                        </span>
                                        <span class="ml-auto">{{ app(\App\Services\LocalizationService::class)->formatDate($ticket->opened_at) ?: app(\App\Services\LocalizationService::class)->formatDate($ticket->created_at) }}</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Audit --}}
            <div class="overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
                    <h2 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('auth.Registo de Auditoria') }}</h2>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-xs font-bold text-[var(--text-soft)]">{{ $audits->count() }}</span>
                </div>

                @if($audits->isEmpty())
                    <div class="px-6 py-10 text-center">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--surface-2)] text-[var(--text-soft)]" aria-hidden="true">{!! $icon['doc'] !!}</div>
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('common.Sem alterações registadas.') }}</p>
                        <p class="mt-1 text-xs text-[var(--text-soft)]">{{ __('equipment.As ações efetuadas neste equipamento serão registadas automaticamente.') }}</p>
                    </div>
                @else
                    <ul class="divide-y divide-[var(--border)]">
                        @foreach($audits as $audit)
                            <li class="px-6 py-3.5">
                                <div class="flex items-center justify-between gap-3">
                                    <x-ui.text.badge kind="audit" :value="$audit->event" size="badge" />
                                    <span class="text-xs text-[var(--text-soft)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($audit->created_at) ?: '—' }}</span>
                                </div>
                                <p class="mt-1.5 text-xs text-[var(--text-soft)]">
                                    {{ $audit->user?->name ?? __('messages.Sistema') }}
                                    @if($audit->event === 'updated' && ! empty($audit->new_values))
                                        · <span class="text-[var(--text)]">{{ __('common.:count campo(s) alterado(s)', ['count' => count($audit->new_values)]) }}</span>
                                    @endif
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>
</x-ui.partials.page-header>
@endsection
