@extends('ui.layout')

@section('page_key', 'stock-part-detail')

@php
    $statusBadges = [
        'in' => 'border border-success/25 bg-success/10 text-success',
        'out' => 'border border-danger/25 bg-danger/10 text-danger',
        'adjust' => 'border border-warning/25 bg-warning/10 text-warning',
        'return' => 'border border-info/25 bg-info/10 text-info',
    ];
    $statusIcons = [
        'in' => '<svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m0 0l6.75-6.75M12 19.5l-6.75-6.75"/></svg>',
        'out' => '<svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75"/></svg>',
        'adjust' => '<svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z"/></svg>',
        'return' => '<svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/></svg>',
    ];
    $movements = $part->movements()->with(['user'])->latest()->limit(15)->get();
    $lowStock = $part->isLowStock();
    $movementReasonLabels = [
        'Ajuste de inventário' => __('stock_movement.inventory_adjustment'),
        'Devolução de sobrante' => __('stock_movement.surplus_return'),
        'Consumo em intervenção' => __('stock_movement.intervention_consumption'),
    ];
@endphp

@section('content')
<x-ui.partials.page-header
    :title="$part->name"
    :subtitle="($part->brand ? $part->brand . ' · ' : '') . $part->sku"
    :badge="$part->category?->name"
>
    <x-slot:actions>
        <x-ui.page-actions.group>
            <x-ui.page-actions.back-button :href="route('ui.stock.parts')" :label="__('stock.Voltar às Peças')" />
            @if($user && $user->isAdmin())
                <x-ui.page-actions.create-link :href="route('ui.stock.parts.edit', $part)" :label="__('stock.Editar Peça')" />
            @endif
        </x-ui.page-actions.group>
    </x-slot:actions>

    {{-- Status bar --}}
    <div class="mb-6 flex flex-wrap items-center gap-3">
        <span class="inline-flex items-center gap-2 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-bold text-[var(--text)]">
            <span class="relative flex h-2.5 w-2.5">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full opacity-50 {{ $lowStock ? 'bg-danger' : 'bg-success' }}"></span>
                <span class="relative inline-flex h-2.5 w-2.5 rounded-full {{ $lowStock ? 'bg-danger' : 'bg-success' }}"></span>
            </span>
            {{ $lowStock ? __('stock.Stock baixo') : __('stock.Stock OK') }}
        </span>

        <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
            {{ __('stock.Stock atual') }}: <b class="{{ $lowStock ? 'text-danger' : 'text-[var(--text)]' }}">@localizedNumber($part->current_stock)</b>
        </span>

        <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
            {{ __('stock.Mínimo') }}: <b class="text-[var(--text)]">@localizedNumber($part->min_stock)</b>
        </span>

        @if($part->max_stock)
            <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
                <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 11.25l-3-3m0 0l-3 3m3-3v7.5m4.5 5.25a9.75 9.75 0 11-18 0 9.75 9.75 0 0118 0z"/></svg>
                {{ __('common.Máximo') }}: <b class="text-[var(--text)]">@localizedNumber($part->max_stock)</b>
            </span>
        @endif

        @if($part->location)
            <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
                <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm4.5 0a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"/></svg>
                {{ __('common.Localização') }}: <b class="text-[var(--text)]">{{ $part->location }}</b>
            </span>
        @endif
    </div>

    <div class="grid items-start gap-6 xl:grid-cols-[1.5fr_1fr]">

        <div class="space-y-6">

            {{-- Part Information --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <h2 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('stock.Informação da Peça') }}</h2>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ $part->active ? __('common.Ativa') : __('common.Inativa') }}</span>
                </div>

                <dl class="grid gap-x-6 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Código (SKU)') }}</dt>
                        <dd class="mt-1 font-mono text-xs font-semibold text-[var(--text)]">{{ $part->sku }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Marca') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $part->brand ?? __('common.Não definida') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Referência do fabricante') }}</dt>
                        <dd class="mt-1 font-mono text-xs font-semibold text-[var(--text)]">{{ $part->manufacturer_ref ?? __('common.Não definida') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Categoria') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $part->category?->name ?? __('common.Sem categoria') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Unidade de medida') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ \App\Enums\PartUnitOfMeasureEnum::normalize($part->unit_of_measure)?->label() ?? $part->unit_of_measure }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Taxa de IVA') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">
                            @if($part->taxRate?->percent)
                                {{ $part->taxRate->name }} ({{ app(\App\Services\LocalizationService::class)->formatPercent((float) $part->taxRate->percent) }})
                            @else
                                {{ __('common.Isento') }}
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Preço de custo') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatCurrency((float) $part->cost_price) }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Preço c/ IVA') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatCurrency((float) $part->priceWithVat()) }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('stock.Valor em stock') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatCurrency((float) $part->stockValue()) }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Registado em') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($part->created_at) ?: '—' }}</dd>
                    </div>
                </dl>

                @if($part->description)
                    <div class="mt-6 border-t border-[var(--border)] pt-4">
                        <h3 class="mb-2 text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Descrição') }}</h3>
                        <p class="rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-3 text-xs leading-6 text-[var(--text)]">{{ $part->description }}</p>
                    </div>
                @endif

                @if($part->technical_notes)
                    <div class="mt-4">
                        <h3 class="mb-2 text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Notas técnicas') }}</h3>
                        <p class="rounded-xl border border-warning/20 bg-warning/5 p-3 text-xs leading-6 text-[var(--text)]">{{ $part->technical_notes }}</p>
                    </div>
                @endif
            </div>

            {{-- Suppliers --}}
            <div class="overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
                    <h2 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('stock.Fornecedores') }}</h2>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-xs font-bold text-[var(--text-soft)]">{{ $part->suppliers->count() }}</span>
                </div>

                @if($part->suppliers->isEmpty())
                    <div class="px-6 py-10 text-center">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--surface-2)]"><svg class="h-6 w-6 shrink-0 text-[var(--text-soft)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg></div>
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('common.Sem fornecedores associados.') }}</p>
                        <p class="mt-1 text-xs text-[var(--text-soft)]">{{ __('stock.Associe fornecedores através da edição da peça.') }}</p>
                    </div>
                @else
                    <ul class="divide-y divide-[var(--border)]">
                        @foreach($part->suppliers as $supplier)
                            <li class="px-6 py-4">
                                <div class="flex items-center justify-between gap-3">
                                    <div>
                                        <p class="text-xs font-bold text-[var(--text)]">{{ $supplier->name }}</p>
                                        <p class="mt-0.5 text-xs text-[var(--text-soft)]">
                                            {{ $supplier->email ?? $supplier->contact ?? __('common.Sem contacto registado') }}
                                        </p>
                                    </div>
                                    <div class="shrink-0 text-right">
                                        @if($supplier->pivot->price)
                                            <p class="text-xs font-bold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatCurrency((float) $supplier->pivot->price) }}</p>
                                        @endif
                                        @if($supplier->pivot->supplier_ref)
                                            <p class="font-mono text-xs text-[var(--text-soft)]">{{ $supplier->pivot->supplier_ref }}</p>
                                        @endif
                                        @if($supplier->pivot->lead_time_days)
                                            <p class="mt-0.5 text-xs text-[var(--text-soft)]">{{ __('common.Prazo: :days dias', ['days' => $supplier->pivot->lead_time_days]) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            {{-- Recent Movements --}}
            <div class="overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
                    <h2 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('common.Movimentos Recentes') }}</h2>
                    <a href="{{ route('ui.stock.movements') }}?part_id={{ $part->id }}" class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-xs font-bold text-primary transition hover:bg-[var(--border)]">
                        {{ __('common.Ver todos') }}
                    </a>
                </div>

                @if($movements->isEmpty())
                    <div class="px-6 py-10 text-center">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--surface-2)]"><svg class="h-6 w-6 shrink-0 text-[var(--text-soft)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg></div>
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('common.Sem movimentos registados.') }}</p>
                        <p class="mt-1 text-xs text-[var(--text-soft)]">{{ __('stock.Entradas e saídas de stock aparecerão aqui.') }}</p>
                    </div>
                @else
                    <ul class="divide-y divide-[var(--border)]">
                        @foreach($movements as $movement)
                            <li class="px-6 py-3.5">
                                <div class="flex items-center justify-between gap-3">
                                    <span class="inline-flex items-center gap-1.5 rounded-lg px-2 py-0.5 text-xs font-bold uppercase tracking-tight {{ $statusBadges[$movement->movement_type] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]' }}">
                                        {!! $statusIcons[$movement->movement_type] ?? '•' !!} {{ \App\Enums\StockMovementTypeEnum::tryFrom((string) $movement->movement_type)?->label() ?? $movement->movement_type }}
                                    </span>
                                    <span class="text-xs font-black {{ $movement->delta() > 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $movement->delta() > 0 ? '+' : '' }}{{ $movement->delta() }}
                                    </span>
                                </div>
                                <div class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-[var(--text-soft)]">
                                    <span>{{ $movementReasonLabels[$movement->reason] ?? $movement->reason ?: __('common.Sem motivo') }}</span>
                                    <span class="ml-auto">{{ app(\App\Services\LocalizationService::class)->formatDateTime($movement->created_at) ?: '—' }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-ui.partials.page-header>
@endsection
