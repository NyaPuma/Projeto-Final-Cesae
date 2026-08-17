@extends('ui.layout')

@section('page_key', 'room-detail')

@php
    // --- Helpers de apresentação (apenas estilo, não regras de negócio) ---
    $equipmentStatusBadges = [
        'operacional' => 'border border-emerald-500/25 bg-emerald-500/10 text-emerald-800 dark:text-emerald-400',
        'manutenção' => 'border border-amber-500/25 bg-amber-500/10 text-amber-800 dark:text-amber-400',
        'avariado' => 'border border-rose-500/25 bg-rose-500/10 text-rose-800 dark:text-rose-400',
        'abatido' => 'border border-slate-500/25 bg-slate-500/10 text-slate-700 dark:text-slate-400',
    ];

    $equipmentStatusLabels = [
        'operacional' => __('common.Operacional'),
        'manutenção' => __('room.maintenance'),
        'avariado' => __('room.faulty'),
        'abatido' => __('room.retired'),
    ];

    $ticketStatusBadges = [
        'aberta' => 'border border-blue-500/25 bg-blue-500/10 text-blue-800 dark:text-blue-400',
        'em curso' => 'border border-amber-500/25 bg-amber-500/10 text-amber-800 dark:text-amber-400',
        'pendente orçamento' => 'border border-orange-500/25 bg-orange-500/10 text-orange-800 dark:text-orange-400',
        'fechada' => 'border border-emerald-500/25 bg-emerald-500/10 text-emerald-800 dark:text-emerald-400',
        'cancelada' => 'border border-rose-500/25 bg-rose-500/10 text-rose-800 dark:text-rose-400',
        'recusada' => 'border border-rose-500/25 bg-rose-500/10 text-rose-800 dark:text-rose-400',
    ];

    $priorityBadges = [
        'baixa' => 'border border-emerald-500/25 bg-emerald-500/10 text-emerald-800 dark:text-emerald-400',
        'média' => 'border border-amber-500/25 bg-amber-500/10 text-amber-800 dark:text-amber-400',
        'alta' => 'border border-orange-500/25 bg-orange-500/10 text-orange-800 dark:text-orange-400',
        'crítica' => 'border border-purple-500/30 bg-purple-500/10 text-purple-800 dark:text-purple-400',
    ];

    $auditBadges = [
        'created' => 'border border-emerald-500/25 bg-emerald-500/10 text-emerald-800 dark:text-emerald-400',
        'updated' => 'border border-amber-500/25 bg-amber-500/10 text-amber-800 dark:text-amber-400',
        'deleted' => 'border border-rose-500/25 bg-rose-500/10 text-rose-800 dark:text-rose-400',
    ];

    $auditLabels = [
        'created' => __('room.audit_created'),
        'updated' => __('room.audit_updated'),
        'deleted' => __('room.audit_deleted'),
    ];

    $locationParts = array_filter([
        $room->building,
        $room->floor ? __('common.Piso :floor', ['floor' => $room->floor]) : null,
        $room->location,
    ]);

    $capacityPercent = ($room->capacity && $room->capacity > 0)
        ? min(100, (int) round((min($equipments->count(), $room->capacity) / $room->capacity) * 100))
        : 0;
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
                />
            @endif
        </x-ui.page-actions.group>
    </x-slot:actions>

    {{-- =================================================================== --}}
    {{-- Faixa de estado da sala --}}
    {{-- =================================================================== --}}
    <div class="mb-6 flex flex-wrap items-center gap-3">
        <span class="inline-flex items-center gap-2 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-bold text-[var(--text)]">
            <span class="relative flex h-2.5 w-2.5">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full opacity-50 {{ $room->active ? 'bg-emerald-500' : 'bg-slate-500' }}"></span>
                <span class="relative inline-flex h-2.5 w-2.5 rounded-full {{ $room->active ? 'bg-emerald-500' : 'bg-slate-500' }}"></span>
            </span>
            {{ $room->active ? __('room.Sala Ativa') : __('room.Sala Inativa') }}
        </span>

        @if($room->capacity)
            <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
                🪑 {{ __('common.Capacidade') }}: <b class="text-[var(--text)]">{{ $room->capacity }}</b>
            </span>
        @endif

        <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
            🖥️ {{ __('equipment.Equipamentos') }}: <b class="text-[var(--text)]">{{ $equipments->count() }}</b>
        </span>

        <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
            🎫 {{ __('tickets.Tickets') }}: <b class="text-[var(--text)]">{{ $tickets->count() }}</b>
        </span>
    </div>

    {{-- =================================================================== --}}
    {{-- Indicadores (KPI) --}}
    {{-- =================================================================== --}}
    <div class="mb-8 grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-5">
        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Capacidade') }}</span>
                <span class="text-base">🪑</span>
            </div>
            <p class="mt-2 text-2xl font-black text-[var(--text)]">{{ $room->capacity ?? '—' }}</p>
            <p class="mt-0.5 text-[10px] font-medium text-[var(--text-soft)]">{{ __('common.lugares') }}</p>
        </div>

        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('equipment.Equipamentos') }}</span>
                <span class="text-base">🖥️</span>
            </div>
            <p class="mt-2 text-2xl font-black text-[var(--text)]">{{ $equipments->count() }}</p>
            <p class="mt-0.5 text-[10px] font-medium text-[var(--text-soft)]">
                {{ $equipments->where('status', 'operacional')->count() }} {{ __('common.operacionais') }}
            </p>
        </div>

        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('dashboard.Tickets Abertos') }}</span>
                <span class="text-base">📥</span>
            </div>
            <p class="mt-2 text-2xl font-black {{ $openTicketsCount > 0 ? 'text-amber-600 dark:text-amber-400' : 'text-[var(--text)]' }}">{{ $openTicketsCount }}</p>
            <p class="mt-0.5 text-[10px] font-medium text-[var(--text-soft)]">{{ __('common.por resolver') }}</p>
        </div>

        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Em Curso') }}</span>
                <span class="text-base">🔧</span>
            </div>
            <p class="mt-2 text-2xl font-black {{ $inProgressTicketsCount > 0 ? 'text-blue-600 dark:text-blue-400' : 'text-[var(--text)]' }}">{{ $inProgressTicketsCount }}</p>
            <p class="mt-0.5 text-[10px] font-medium text-[var(--text-soft)]">{{ __('common.intervenções') }}</p>
        </div>

        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('tickets.Total Tickets') }}</span>
                <span class="text-base">🎫</span>
            </div>
            <p class="mt-2 text-2xl font-black text-[var(--text)]">{{ $tickets->count() }}</p>
            <p class="mt-0.5 text-[10px] font-medium text-[var(--text-soft)]">{{ __('common.histórico') }}</p>
        </div>
    </div>

    {{-- =================================================================== --}}
    {{-- Corpo: Informação + Equipamentos (esquerda) | Estado + Tickets + Auditoria (direita) --}}
    {{-- =================================================================== --}}
    <div class="grid items-start gap-6 xl:grid-cols-[1.5fr_1fr]">

        <div class="space-y-6">

            {{-- Informação da Sala --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <h3 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('room.Informação da Sala') }}</h3>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ $room->code }}</span>
                </div>

                <dl class="grid gap-x-6 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('room.Edifício') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $room->building ?? __('common.Não definido') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Piso') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $room->floor ?? __('common.Não definido') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Localização') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $room->location ?? __('common.Não definido') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Capacidade') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $room->capacity ? $room->capacity . ' ' . __('common.lugares') : __('common.Não definida') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Registada em') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($room->created_at) ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Última atualização') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($room->updated_at) ?: '—' }}</dd>
                    </div>
                </dl>

                @if($room->description)
                    <div class="mt-6 border-t border-[var(--border)] pt-4">
                        <h4 class="mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Descrição') }}</h4>
                        <p class="text-xs leading-6 text-[var(--text)]">{{ $room->description }}</p>
                    </div>
                @endif

                @if($room->notes)
                    <div class="mt-6 border-t border-[var(--border)] pt-4">
                        <h4 class="mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Notas Internas') }}</h4>
                        <p class="rounded-xl border border-amber-500/20 bg-amber-500/5 p-3 text-xs leading-6 text-[var(--text)]">{{ $room->notes }}</p>
                    </div>
                @endif
            </div>

            {{-- Equipamentos --}}
            <div class="overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
                    <h3 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('equipment.Equipamentos da Sala') }}</h3>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-[10px] font-bold text-[var(--text-soft)]">{{ $equipments->count() }}</span>
                </div>

                @if($equipments->isEmpty())
                    <div class="px-6 py-10 text-center">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--surface-2)] text-xl">🖥️</div>
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('equipment.Sem equipamentos registados nesta sala.') }}</p>
                        <p class="mt-1 text-[11px] text-[var(--text-soft)]">{{ __('equipment.Aloque equipamentos através da gestão de equipamentos.') }}</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-[var(--surface-2)] text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
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
                                                <p class="mt-0.5 font-mono text-[10px] text-[var(--text-soft)]">{{ $equipment->asset_tag }}</p>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3.5 text-[var(--text-soft)]">{{ $equipment->category?->name ?? __('common.Sem categoria') }}</td>
                                        <td class="px-4 py-3.5 text-[var(--text-soft)]">
                                            {{ trim(($equipment->brand ?? '') . ' ' . ($equipment->model ?? '')) ?: __('common.—') }}
                                        </td>
                                        <td class="px-4 py-3.5 font-mono text-[var(--text-soft)]">{{ $equipment->serial ?? '—' }}</td>
                                        <td class="px-4 py-3.5">
                                            <span class="inline-block rounded-lg px-2.5 py-1 text-[10px] font-bold uppercase tracking-tight {{ $equipmentStatusBadges[$equipment->status] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]' }}">
                                                {{ $equipmentStatusLabels[$equipment->status] ?? $equipment->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-3.5 text-right">
                                            @if($equipment->warranty_until)
                                                <span class="inline-flex items-center gap-1 text-[11px] font-semibold {{ $warrantyExpired ? 'text-rose-600 dark:text-rose-400' : 'text-emerald-700 dark:text-emerald-400' }}">
                                                    {{ $warrantyExpired ? '⚠️ ' : '' }}{{ app(\App\Services\LocalizationService::class)->formatDate($equipment->warranty_until) ?: '—' }}
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

        <div class="space-y-6">

            {{-- Ocupação da Sala --}}
            @if($room->capacity)
                <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                    <div class="mb-3 flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <h3 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('common.Ocupação') }}</h3>
                        <span class="text-xs font-black text-[var(--text)]">{{ $capacityPercent }}%</span>
                    </div>
                    <div class="h-2.5 w-full overflow-hidden rounded-full bg-[var(--surface-2)]">
                        <div class="h-full rounded-full bg-gradient-to-r from-primary to-amber-400 transition-all" style="width: {{ $capacityPercent }}%"></div>
                    </div>
                    <div class="mt-3 flex items-center justify-between text-[11px] text-[var(--text-soft)]">
                        <span>{{ $equipments->count() }} {{ __('common.itens alocados') }}</span>
                        <span>{{ $room->capacity }} {{ __('common.lugares') }}</span>
                    </div>
                </div>
            @endif

            {{-- Tickets Recentes --}}
            <div class="overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
                    <h3 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('tickets.Tickets Recentes') }}</h3>
                    <a href="/ui/tickets" class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-[10px] font-bold text-primary transition hover:bg-[var(--border)]">
                        {{ __('common.Ver todos') }}
                    </a>
                </div>

                @if($tickets->isEmpty())
                    <div class="px-6 py-10 text-center">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--surface-2)] text-xl">🎫</div>
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('tickets.Sem tickets associados a esta sala.') }}</p>
                        <p class="mt-1 text-[11px] text-[var(--text-soft)]">{{ __('tickets.Os tickets criados para esta sala aparecerão aqui.') }}</p>
                    </div>
                @else
                    <ul class="divide-y divide-[var(--border)]">
                        @foreach($tickets->take(5) as $ticket)
                            <li>
                                <a href="/ui/tickets/{{ $ticket->id }}" class="block px-6 py-3.5 transition-colors hover:bg-[var(--surface-2)]">
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="truncate text-xs font-bold text-[var(--text)]">{{ $ticket->title }}</p>
                                        <span class="shrink-0 rounded-lg px-2 py-0.5 text-[9px] font-bold uppercase tracking-tight {{ $priorityBadges[$ticket->priority] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]' }}">
                                            {{ \App\Enums\TicketPriorityEnum::normalize((string) $ticket->priority)?->label() ?? $ticket->priority }}
                                        </span>
                                    </div>
                                    <div class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-[10px] text-[var(--text-soft)]">
                                        <span class="font-mono font-semibold">{{ $ticket->reference }}</span>
                                        <span class="inline-block rounded-md px-1.5 py-0.5 text-[9px] font-bold uppercase tracking-tight {{ $ticketStatusBadges[$ticket->status?->name] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]' }}">
                                            {{ \App\Enums\TicketStatusEnum::normalize((string) ($ticket->status?->name ?? ''))?->label() ?? __('common.Sem estado') }}
                                        </span>
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

            {{-- Auditoria --}}
            <div class="overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
                    <h3 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('auth.Registo de Auditoria') }}</h3>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-[10px] font-bold text-[var(--text-soft)]">{{ $audits->count() }}</span>
                </div>

                @if($audits->isEmpty())
                    <div class="px-6 py-10 text-center">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--surface-2)] text-xl">📝</div>
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('common.Sem alterações registadas.') }}</p>
                        <p class="mt-1 text-[11px] text-[var(--text-soft)]">{{ __('room.As ações efetuadas nesta sala serão registadas automaticamente.') }}</p>
                    </div>
                @else
                    <ul class="divide-y divide-[var(--border)]">
                        @foreach($audits as $audit)
                            <li class="px-6 py-3.5">
                                <div class="flex items-center justify-between gap-3">
                                    <span class="inline-block rounded-lg px-2 py-0.5 text-[9px] font-bold uppercase tracking-tight {{ $auditBadges[$audit->event] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]' }}">
                                        {{ $auditLabels[$audit->event] ?? $audit->event }}
                                    </span>
                                    <span class="text-[10px] text-[var(--text-soft)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($audit->created_at) ?: '—' }}</span>
                                </div>
                                <p class="mt-1.5 text-[11px] text-[var(--text-soft)]">
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
