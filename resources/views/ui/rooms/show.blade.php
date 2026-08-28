@extends('ui.layout')

@section('page_key', 'room-detail')

@php
    // --- Presentation helpers (styling only, no business rules) ---
    $equipmentStatusLabels = [
        'operacional' => __('common.Operacional'),
        'manutenção' => __('room.maintenance'),
        'avariado' => __('room.faulty'),
        'abatido' => __('room.retired'),
    ];

    // Normalised floor label — the stored value may already begin with "Piso",
    // so only prefix it again when it starts with a number.
    $floorRaw = $room->floor;
    $floorLabel = $floorRaw
        ? (preg_match('/^\d/', trim($floorRaw)) ? __('common.Piso :floor', ['floor' => $floorRaw]) : trim($floorRaw))
        : null;

    $locationParts = array_values(array_unique(array_filter([
        $room->building,
        $floorLabel,
        $room->location,
    ])));

    $capacityPercent = ($room->capacity && $room->capacity > 0)
        ? min(100, (int) round((min($equipments->count(), $room->capacity) / $room->capacity) * 100))
        : 0;

    // --- Inline icons (Heroicons outline — consistent with the existing convention) ---
    $icon = [
        'users' => '<svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>',
        'users5' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>',
        'monitor' => '<svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/></svg>',
        'monitor5' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/></svg>',
        'monitor6' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/></svg>',
        'inbox' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z"/></svg>',
        'wrench' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 01-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 11-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 016.336-4.486l-3.276 3.276a3.004 3.004 0 002.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852z"/></svg>',
        'ticket' => '<svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9.75-3v.75m3-3v.75m0 3v.75M4.5 21h15a2.25 2.25 0 002.25-2.25V5.25A2.25 2.25 0 0019.5 3h-15A2.25 2.25 0 002.25 5.25v13.5A2.25 2.25 0 004.5 21z"/></svg>',
        'ticket5' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9.75-3v.75m3-3v.75m0 3v.75M4.5 21h15a2.25 2.25 0 002.25-2.25V5.25A2.25 2.25 0 0019.5 3h-15A2.25 2.25 0 002.25 5.25v13.5A2.25 2.25 0 004.5 21z"/></svg>',
        'ticketLg' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9.75-3v.75m3-3v.75m0 3v.75M4.5 21h15a2.25 2.25 0 002.25-2.25V5.25A2.25 2.25 0 0019.5 3h-15A2.25 2.25 0 002.25 5.25v13.5A2.25 2.25 0 004.5 21z"/></svg>',
        'doc' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>',
        'shieldWarn' => '<svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>',
        'check5' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        'pencil' => '<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487zm0 0L19.5 7.125"/></svg>',
    ];
@endphp

@section('content')
<x-ui.partials.page-header
    :title="$room->name"
    :subtitle="count($locationParts) ? implode(' · ', $locationParts) : __('common.Sem localização registada.')"
    :badge="$room->code"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button href="/ui/rooms" :label="__('ui.Voltar às Salas')" />

            @if(isset($user) && $user && $user->isAdmin())
                <x-ui.page-actions.create-link
                    :href="route('ui.rooms.edit', $room)"
                    :label="__('ui.Editar Sala')"
                    :icon="$icon['pencil']"
                />
            @endif
        </x-ui.page-actions.group>
    </x-slot:actions>

    {{-- =================================================================== --}}
    {{-- Room status bar --}}
    {{-- =================================================================== --}}
    <div class="mb-6 overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
        <div class="grid gap-px bg-[var(--border)] sm:grid-cols-2 xl:grid-cols-4">
            <div class="flex items-center gap-4 bg-[var(--surface)] px-5 py-4">
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl {{ $room->active ? 'bg-success/10 text-success' : 'bg-[var(--surface-2)] text-[var(--text-soft)]' }}" aria-hidden="true">{!! $icon['check5'] !!}</span>
                <div class="min-w-0">
                    <p class="truncate text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Estado') }}</p>
                    <p class="mt-1 flex items-center gap-1.5 text-sm font-bold text-[var(--text)]">
                        <span class="relative flex h-2 w-2" aria-hidden="true">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full opacity-50 {{ $room->active ? 'bg-success' : 'bg-[var(--border)]' }}"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full {{ $room->active ? 'bg-success' : 'bg-[var(--border)]' }}"></span>
                        </span>
                        {{ $room->active ? __('room.Sala Ativa') : __('room.Sala Inativa') }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4 bg-[var(--surface)] px-5 py-4">
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary" aria-hidden="true">{!! $icon['users5'] !!}</span>
                <div class="min-w-0">
                    <p class="truncate text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Capacidade') }}</p>
                    <p class="mt-1 text-sm font-bold text-[var(--text)]">
                        {{ $room->capacity ?? '—' }}
                        @if($room->capacity)<span class="text-xs font-medium text-[var(--text-soft)]">{{ __('common.lugares') }}</span>@endif
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4 bg-[var(--surface)] px-5 py-4">
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary" aria-hidden="true">{!! $icon['monitor5'] !!}</span>
                <div class="min-w-0">
                    <p class="truncate text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('equipment.Equipamentos') }}</p>
                    <p class="mt-1 text-sm font-bold text-[var(--text)]">{{ $equipments->count() }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4 bg-[var(--surface)] px-5 py-4">
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary" aria-hidden="true">{!! $icon['ticket5'] !!}</span>
                <div class="min-w-0">
                    <p class="truncate text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('tickets.Tickets') }}</p>
                    <p class="mt-1 text-sm font-bold text-[var(--text)]">{{ $tickets->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- =================================================================== --}}
    {{-- Indicators (KPI) --}}
    {{-- =================================================================== --}}
    <div class="mb-8 grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-5">
        <x-ui.stats.stat-card
            :label="__('common.Capacidade')"
            :icon="$icon['users5']"
            icon-class="text-[var(--text-soft)]"
            :sublabel="__('common.lugares')"
        >{{ $room->capacity ?? '—' }}</x-ui.stats.stat-card>

        <x-ui.stats.stat-card
            :label="__('equipment.Equipamentos')"
            :icon="$icon['monitor5']"
            icon-class="text-[var(--text-soft)]"
            :sublabel="$equipments->where('status', 'operacional')->count() . ' ' . __('common.operacionais')"
        >{{ $equipments->count() }}</x-ui.stats.stat-card>

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
    </div>

    {{-- =================================================================== --}}
    {{-- Body: Info + Equipment (left) | Status + Tickets + Audit (right) --}}
    {{-- =================================================================== --}}
    <div class="grid items-start gap-6 xl:grid-cols-[minmax(0,1.5fr)_minmax(0,1fr)]">

        <div class="min-w-0 space-y-6">

            {{-- Room Information --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <h2 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('room.Informação da Sala') }}</h2>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ $room->code }}</span>
                </div>

                <dl class="grid gap-x-6 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('room.Edifício') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $room->building ?? __('common.Não definido') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Piso') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $room->floor ?? __('common.Não definido') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Localização') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $room->location ?? __('common.Não definido') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Capacidade') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $room->capacity ? $room->capacity . ' ' . __('common.lugares') : __('common.Não definida') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Registada em') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($room->created_at) ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Última atualização') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($room->updated_at) ?: '—' }}</dd>
                    </div>
                </dl>

                @if($room->description)
                    <div class="mt-6 border-t border-[var(--border)] pt-4">
                        <h3 class="mb-2 text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Descrição') }}</h3>
                        <p class="text-xs leading-6 text-[var(--text)]">{{ $room->description }}</p>
                    </div>
                @endif

                @if($room->notes)
                    <div class="mt-6 border-t border-[var(--border)] pt-4">
                        <h3 class="mb-2 text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Notas Internas') }}</h3>
                        <p class="rounded-xl border border-warning/20 bg-warning/5 p-3 text-xs leading-6 text-[var(--text)]">{{ $room->notes }}</p>
                    </div>
                @endif
            </div>

            {{-- Room Occupancy --}}
            @if($room->capacity)
                <div class="overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                    <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
                        <h2 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('common.Ocupação') }}</h2>
                        <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-xs font-bold text-[var(--text-soft)]">{{ $capacityPercent }}%</span>
                    </div>
                    <div class="px-6 py-5">
                        <div class="h-2.5 w-full overflow-hidden rounded-full bg-[var(--surface-2)]">
                            <div class="room-capacity-fill h-full rounded-full bg-gradient-to-r from-primary to-warning transition-all" style="--capacity: {{ $capacityPercent }}%"></div>
                        </div>
                        <div class="mt-3 flex items-center justify-between text-xs text-[var(--text-soft)]">
                            <span>{{ $equipments->count() }} {{ __('common.itens alocados') }}</span>
                            <span>{{ $room->capacity }} {{ __('common.lugares') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Equipment --}}
            <div class="overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
                    <h2 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('equipment.Equipamentos da Sala') }}</h2>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-xs font-bold text-[var(--text-soft)]">{{ $equipments->count() }}</span>
                </div>

                @if($equipments->isEmpty())
                    <div class="px-6 py-10 text-center">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--surface-2)] text-[var(--text-soft)]" aria-hidden="true">{!! $icon['monitor6'] !!}</div>
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('equipment.Sem equipamentos registados nesta sala.') }}</p>
                        <p class="mt-1 text-xs text-[var(--text-soft)]">{{ __('equipment.Aloque equipamentos através da gestão de equipamentos.') }}</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-[var(--surface-2)] text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">
                                <tr>
                                    <th class="px-6 py-3">{{ __('equipment.Equipamento') }}</th>
                                    <th class="px-4 py-3">{{ __('common.Categoria') }}</th>
                                    <th class="px-4 py-3">{{ __('common.Marca · Modelo') }}</th>
                                    <th class="px-4 py-3">{{ __('common.Nº Série') }}</th>
                                    <th class="px-4 py-3">{{ __('common.Estado') }}</th>
                                    <th class="px-6 py-3 text-right">{{ __('common.Garantia') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[var(--border)]">
                                @foreach($equipments as $equipment)
                                    @php
                                        $warrantyExpired = $equipment->warranty_until && $equipment->warranty_until->isPast();
                                    @endphp
                                    <tr class="transition-colors hover:bg-[var(--surface-2)]">
                                        <td class="px-6 py-3.5">
                                            <p class="font-bold text-[var(--text)]">{{ $equipment->name }}</p>
                                            @if($equipment->asset_tag)
                                                <p class="mt-0.5 font-mono text-xs text-[var(--text-soft)]">{{ $equipment->asset_tag }}</p>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3.5 text-[var(--text-soft)]">{{ $equipment->category?->name ?? __('common.Sem categoria') }}</td>
                                        <td class="px-4 py-3.5 text-[var(--text-soft)]">
                                            {{ trim(($equipment->brand ?? '') . ' ' . ($equipment->model ?? '')) ?: __('common.—') }}
                                        </td>
                                        <td class="px-4 py-3.5 font-mono text-[var(--text-soft)]">{{ $equipment->serial ?? '—' }}</td>
                                        <td class="px-4 py-3.5">
                                            <x-ui.text.badge kind="equipmentStatus" :value="$equipment->status" size="sm">
                                            {{ $equipmentStatusLabels[$equipment->status] ?? $equipment->status }}
                                        </x-ui.text.badge>
                                        </td>
                                        <td class="px-6 py-3.5 text-right">
                                            @if($equipment->warranty_until)
                                                <span class="inline-flex items-center gap-1 text-xs font-semibold {{ $warrantyExpired ? 'text-danger' : 'text-success' }}">
                                                    @if($warrantyExpired)<span aria-hidden="true">{!! $icon['shieldWarn'] !!}</span>@endif
                                                    {{ app(\App\Services\LocalizationService::class)->formatDate($equipment->warranty_until) ?: '—' }}
                                                </span>
                                            @else
                                                <span class="text-[var(--text-soft)]">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>

        <div class="min-w-0 space-y-6">

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
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('tickets.Sem tickets associados a esta sala.') }}</p>
                        <p class="mt-1 text-xs text-[var(--text-soft)]">{{ __('tickets.Os tickets criados para esta sala aparecerão aqui.') }}</p>
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
                        <p class="mt-1 text-xs text-[var(--text-soft)]">{{ __('room.As ações efetuadas nesta sala serão registadas automaticamente.') }}</p>
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
