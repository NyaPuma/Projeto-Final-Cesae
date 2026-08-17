@extends('ui.layout')

@section('page_key', 'equipment-detail')

@php
    // --- Helpers de apresentação (apenas estilo, não regras de negócio) ---
    $equipmentStatusBadges = [
        'operacional' => 'border border-emerald-500/25 bg-emerald-500/10 text-emerald-800 dark:text-emerald-400',
        'manutenção' => 'border border-amber-500/25 bg-amber-500/10 text-amber-800 dark:text-amber-400',
        'avariado' => 'border border-rose-500/25 bg-rose-500/10 text-rose-800 dark:text-rose-400',
        'abatido' => 'border border-slate-500/25 bg-slate-500/10 text-slate-700 dark:text-slate-400',
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
        'created' => 'Criação',
        'updated' => 'Alteração',
        'deleted' => 'Eliminação',
    ];

    $warrantyExpired = $equipment->warranty_until && $equipment->warranty_until->isPast();
    $locationParts = array_filter([
        $equipment->room?->name,
        $equipment->room?->building,
        $equipment->room?->location,
    ]);
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
                />

                <x-ui.page-actions.create-link
                    :href="route('ui.equipments.edit', $equipment)"
                    :label="__('equipment.Editar Equipamento')"
                />
            @endif
        </x-ui.page-actions.group>
    </x-slot:actions>

    {{-- =================================================================== --}}
    {{-- Faixa de estado do equipamento --}}
    {{-- =================================================================== --}}
    <div class="mb-6 flex flex-wrap items-center gap-3">
        <span class="inline-flex items-center gap-2 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-bold text-[var(--text)]">
            <span class="relative flex h-2.5 w-2.5">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full opacity-50 {{ $equipment->active ? 'bg-emerald-500' : 'bg-slate-500' }}"></span>
                <span class="relative inline-flex h-2.5 w-2.5 rounded-full {{ $equipment->active ? 'bg-emerald-500' : 'bg-slate-500' }}"></span>
            </span>
            {{ $equipment->active ? __('equipment.Ativo') : __('equipment.Inativo') }}
        </span>

        <span class="inline-flex items-center rounded-xl border px-3.5 py-2 text-xs font-bold uppercase tracking-tight {{ $equipmentStatusBadges[$equipment->status] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]' }}">
            {{ $equipment->status }}
        </span>

        <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
            🏷️ {{ __('common.Categoria') }}: <b class="text-[var(--text)]">{{ $equipment->category?->name ?? __('common.Sem categoria') }}</b>
        </span>

        <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
            📍 {{ __('room.Sala') }}: <b class="text-[var(--text)]">{{ $equipment->room?->name ?? __('common.Não associada') }}</b>
        </span>

        @if($equipment->warranty_until)
            <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold {{ $warrantyExpired ? 'text-rose-600 dark:text-rose-400' : 'text-emerald-700 dark:text-emerald-400' }}">
                {{ $warrantyExpired ? '⚠️ ' : '🛡️ ' }}{{ __('common.Garantia') }}: <b>($equipment->warranty_until)</b>
            </span>
        @endif
    </div>

    {{-- =================================================================== --}}
    {{-- Indicadores (KPI) --}}
    {{-- =================================================================== --}}
    <div class="mb-8 grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-5">
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

        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Garantia') }}</span>
                <span class="text-base">🛡️</span>
            </div>
            <p class="mt-2 text-2xl font-black {{ $warrantyExpired ? 'text-rose-600 dark:text-rose-400' : 'text-[var(--text)]' }}">
                {{ app(\App\Services\LocalizationService::class)->formatDate($equipment->warranty_until) ?: '—' }}
            </p>
            <p class="mt-0.5 text-[10px] font-medium text-[var(--text-soft)]">{{ $warrantyExpired ? __('common.expirada') : __('common.fim da cobertura') }}</p>
        </div>

        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Estado') }}</span>
                <span class="text-base">⚙️</span>
            </div>
            <p class="mt-2 text-2xl font-black text-[var(--text)]">{{ ucfirst($equipment->status) }}</p>
            <p class="mt-0.5 text-[10px] font-medium text-[var(--text-soft)]">{{ $equipment->active ? __('equipment.ativo') : __('equipment.inativo') }}</p>
        </div>
    </div>

    {{-- =================================================================== --}}
    {{-- Corpo: Informação + Sala (esquerda) | Tickets + Auditoria (direita) --}}
    {{-- =================================================================== --}}
    <div class="grid items-start gap-6 xl:grid-cols-[1.5fr_1fr]">

        <div class="space-y-6">

            {{-- Informação do Equipamento --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <h3 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('equipment.Informação do Equipamento') }}</h3>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ $equipment->asset_tag ?? __('common.sem etiqueta') }}</span>
                </div>

                <dl class="grid gap-x-6 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Número de Série') }}</dt>
                        <dd class="mt-1 font-mono text-xs font-semibold text-[var(--text)]">{{ $equipment->serial ?? __('common.Não definido') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('equipment.Etiqueta de Ativo') }}</dt>
                        <dd class="mt-1 font-mono text-xs font-semibold text-[var(--text)]">{{ $equipment->asset_tag ?? __('common.Não definida') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Marca') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $equipment->brand ?? __('common.Não definida') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Modelo') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $equipment->model ?? __('common.Não definido') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Fabricante') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $equipment->manufacturer ?? __('common.Não definido') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Categoria') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $equipment->category?->name ?? __('common.Sem categoria') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Data de Compra') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDate($equipment->purchase_date) ?: __('common.Não definida') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Fim de Garantia') }}</dt>
                        <dd class="mt-1 text-xs font-semibold {{ $warrantyExpired ? 'text-rose-600 dark:text-rose-400' : 'text-[var(--text)]' }}">
                            {{ app(\App\Services\LocalizationService::class)->formatDate($equipment->warranty_until) ?: __('common.Não definido') }}
                            @if($equipment->warranty_until)
                                {{ $warrantyExpired ? '· ⚠️ ' . __('common.expirada') : '· 🛡️' }}
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Registado em') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($equipment->created_at) ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Última atualização') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($equipment->updated_at) ?: '—' }}</dd>
                    </div>
                </dl>

                @if($equipment->notes)
                    <div class="mt-6 border-t border-[var(--border)] pt-4">
                        <h4 class="mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Notas') }}</h4>
                        <p class="rounded-xl border border-amber-500/20 bg-amber-500/5 p-3 text-xs leading-6 text-[var(--text)]">{{ $equipment->notes }}</p>
                    </div>
                @endif
            </div>

            {{-- Sala associada --}}
            <div class="overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
                    <h3 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('room.Sala Associada') }}</h3>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-[10px] font-bold text-[var(--text-soft)]">{{ $equipment->room?->code ?? '—' }}</span>
                </div>

                @if($equipment->room)
                    <a href="{{ route('ui.rooms.show', $equipment->room) }}" class="group block px-6 py-5 transition-colors hover:bg-[var(--surface-2)]">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-bold text-[var(--text)] group-hover:text-primary">{{ $equipment->room->name }}</p>
                                <p class="mt-1 text-[11px] text-[var(--text-soft)]">
                                    {{ implode(' · ', array_filter([$equipment->room->building, $equipment->room->floor ? __('common.Piso :floor', ['floor' => $equipment->room->floor]) : null, $equipment->room->location])) ?: __('common.Sem localização registada.') }}
                                </p>
                            </div>
                            <span class="shrink-0 rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2.5 py-1 text-[10px] font-bold text-[var(--text-soft)] transition group-hover:border-primary/30 group-hover:text-primary">
                                {{ __('room.Ver sala') }} →
                            </span>
                        </div>
                    </a>
                @else
                    <div class="px-6 py-10 text-center">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--surface-2)] text-xl">📍</div>
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('equipment.Sem sala associada a este equipamento.') }}</p>
                        <p class="mt-1 text-[11px] text-[var(--text-soft)]">{{ __('equipment.Associe o equipamento a uma sala através da edição.') }}</p>
                    </div>
                @endif
            </div>

        </div>

        <div class="space-y-6">

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
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('tickets.Sem tickets associados a este equipamento.') }}</p>
                        <p class="mt-1 text-[11px] text-[var(--text-soft)]">{{ __('tickets.Os tickets criados para este equipamento aparecerão aqui.') }}</p>
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
                        <p class="mt-1 text-[11px] text-[var(--text-soft)]">{{ __('equipment.As ações efetuadas neste equipamento serão registadas automaticamente.') }}</p>
                    </div>
                @else
                    <ul class="divide-y divide-[var(--border)]">
                        @foreach($audits as $audit)
                            <li class="px-6 py-3.5">
                                <div class="flex items-center justify-between gap-3">
                                    <span class="inline-block rounded-lg px-2 py-0.5 text-[9px] font-bold uppercase tracking-tight {{ $auditBadges[$audit->event] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]' }}">
                                        {{ $auditLabels[$audit->event] ?? $audit->event }}
                                    </span>
                                    <span class="text-[10px] text-[var(--text-soft)]">($audit->created_at)</span>
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
