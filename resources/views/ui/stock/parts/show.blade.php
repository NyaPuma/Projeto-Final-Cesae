@extends('ui.layout')

@section('page_key', 'stock-part-detail')

@php
    $statusBadges = [
        'in' => 'border border-emerald-500/25 bg-emerald-500/10 text-emerald-800 dark:text-emerald-400',
        'out' => 'border border-rose-500/25 bg-rose-500/10 text-rose-800 dark:text-rose-400',
        'adjust' => 'border border-amber-500/25 bg-amber-500/10 text-amber-800 dark:text-amber-400',
        'return' => 'border border-blue-500/25 bg-blue-500/10 text-blue-800 dark:text-blue-400',
    ];
    $statusIcons = [
        'in' => '📥',
        'out' => '📤',
        'adjust' => '🔧',
        'return' => '↩️',
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

    {{-- Faixa de estado --}}
    <div class="mb-6 flex flex-wrap items-center gap-3">
        <span class="inline-flex items-center gap-2 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-bold text-[var(--text)]">
            <span class="relative flex h-2.5 w-2.5">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full opacity-50 {{ $lowStock ? 'bg-rose-500' : 'bg-emerald-500' }}"></span>
                <span class="relative inline-flex h-2.5 w-2.5 rounded-full {{ $lowStock ? 'bg-rose-500' : 'bg-emerald-500' }}"></span>
            </span>
            {{ $lowStock ? __('stock.Stock baixo') : __('stock.Stock OK') }}
        </span>

        <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
            📦 {{ __('stock.Stock atual') }}: <b class="{{ $lowStock ? 'text-rose-600 dark:text-rose-400' : 'text-[var(--text)]' }}">@localizedNumber($part->current_stock)</b>
        </span>

        <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
            ⚠️ {{ __('stock.Mínimo') }}: <b class="text-[var(--text)]">@localizedNumber($part->min_stock)</b>
        </span>

        @if($part->max_stock)
            <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
                🎯 {{ __('common.Máximo') }}: <b class="text-[var(--text)]">@localizedNumber($part->max_stock)</b>
            </span>
        @endif

        @if($part->location)
            <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3.5 py-2 text-xs font-semibold text-[var(--text-soft)]">
                📍 {{ __('common.Localização') }}: <b class="text-[var(--text)]">{{ $part->location }}</b>
            </span>
        @endif
    </div>

    <div class="grid items-start gap-6 xl:grid-cols-[1.5fr_1fr]">

        <div class="space-y-6">

            {{-- Informação da peça --}}
            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <h3 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('stock.Informação da Peça') }}</h3>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ $part->active ? __('common.Ativa') : __('common.Inativa') }}</span>
                </div>

                <dl class="grid gap-x-6 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Código (SKU)') }}</dt>
                        <dd class="mt-1 font-mono text-xs font-semibold text-[var(--text)]">{{ $part->sku }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Marca') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $part->brand ?? __('common.Não definida') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Referência do fabricante') }}</dt>
                        <dd class="mt-1 font-mono text-xs font-semibold text-[var(--text)]">{{ $part->manufacturer_ref ?? __('common.Não definida') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Categoria') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ $part->category?->name ?? __('common.Sem categoria') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Unidade de medida') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ \App\Enums\PartUnitOfMeasureEnum::normalize($part->unit_of_measure)?->label() ?? $part->unit_of_measure }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Taxa de IVA') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">
                            @if($part->taxRate?->percent)
                                {{ $part->taxRate->name }} ({{ app(\App\Services\LocalizationService::class)->formatPercent((float) $part->taxRate->percent) }})
                            @else
                                {{ __('common.Isento') }}
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Preço de custo') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatCurrency((float) $part->cost_price) }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Preço c/ IVA') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatCurrency((float) $part->priceWithVat()) }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('stock.Valor em stock') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatCurrency((float) $part->stockValue()) }}</dd>
                    </div>
                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Registado em') }}</dt>
                        <dd class="mt-1 text-xs font-semibold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatDateTime($part->created_at) ?: '—' }}</dd>
                    </div>
                </dl>

                @if($part->description)
                    <div class="mt-6 border-t border-[var(--border)] pt-4">
                        <h4 class="mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Descrição') }}</h4>
                        <p class="rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-3 text-xs leading-6 text-[var(--text)]">{{ $part->description }}</p>
                    </div>
                @endif

                @if($part->technical_notes)
                    <div class="mt-4">
                        <h4 class="mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('common.Notas técnicas') }}</h4>
                        <p class="rounded-xl border border-amber-500/20 bg-amber-500/5 p-3 text-xs leading-6 text-[var(--text)]">{{ $part->technical_notes }}</p>
                    </div>
                @endif
            </div>

            {{-- Fornecedores --}}
            <div class="overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
                    <h3 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('stock.Fornecedores') }}</h3>
                    <span class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-[10px] font-bold text-[var(--text-soft)]">{{ $part->suppliers->count() }}</span>
                </div>

                @if($part->suppliers->isEmpty())
                    <div class="px-6 py-10 text-center">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--surface-2)] text-xl">🏢</div>
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('common.Sem fornecedores associados.') }}</p>
                        <p class="mt-1 text-[11px] text-[var(--text-soft)]">{{ __('stock.Associe fornecedores através da edição da peça.') }}</p>
                    </div>
                @else
                    <ul class="divide-y divide-[var(--border)]">
                        @foreach($part->suppliers as $supplier)
                            <li class="px-6 py-4">
                                <div class="flex items-center justify-between gap-3">
                                    <div>
                                        <p class="text-xs font-bold text-[var(--text)]">{{ $supplier->name }}</p>
                                        <p class="mt-0.5 text-[11px] text-[var(--text-soft)]">
                                            {{ $supplier->email ?? $supplier->contact ?? __('common.Sem contacto registado') }}
                                        </p>
                                    </div>
                                    <div class="shrink-0 text-right">
                                        @if($supplier->pivot->price)
                                            <p class="text-xs font-bold text-[var(--text)]">{{ app(\App\Services\LocalizationService::class)->formatCurrency((float) $supplier->pivot->price) }}</p>
                                        @endif
                                        @if($supplier->pivot->supplier_ref)
                                            <p class="font-mono text-[10px] text-[var(--text-soft)]">{{ $supplier->pivot->supplier_ref }}</p>
                                        @endif
                                        @if($supplier->pivot->lead_time_days)
                                            <p class="mt-0.5 text-[10px] text-[var(--text-soft)]">{{ __('common.Prazo: :days dias', ['days' => $supplier->pivot->lead_time_days]) }}</p>
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
            {{-- Movimentos recentes --}}
            <div class="overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
                <div class="flex items-center justify-between border-b border-[var(--border)] px-6 py-4">
                    <h3 class="text-xs font-black uppercase tracking-wider text-[var(--text)]">{{ __('common.Movimentos Recentes') }}</h3>
                    <a href="{{ route('ui.stock.movements') }}?part_id={{ $part->id }}" class="rounded-lg border border-[var(--border)] bg-[var(--surface-2)] px-2 py-0.5 text-[10px] font-bold text-primary transition hover:bg-[var(--border)]">
                        {{ __('common.Ver todos') }}
                    </a>
                </div>

                @if($movements->isEmpty())
                    <div class="px-6 py-10 text-center">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--surface-2)] text-xl">🔁</div>
                        <p class="text-xs font-semibold text-[var(--text)]">{{ __('common.Sem movimentos registados.') }}</p>
                        <p class="mt-1 text-[11px] text-[var(--text-soft)]">{{ __('stock.Entradas e saídas de stock aparecerão aqui.') }}</p>
                    </div>
                @else
                    <ul class="divide-y divide-[var(--border)]">
                        @foreach($movements as $movement)
                            <li class="px-6 py-3.5">
                                <div class="flex items-center justify-between gap-3">
                                    <span class="inline-flex items-center gap-1.5 rounded-lg px-2 py-0.5 text-[9px] font-bold uppercase tracking-tight {{ $statusBadges[$movement->movement_type] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]' }}">
                                        {{ $statusIcons[$movement->movement_type] ?? '•' }} {{ \App\Enums\StockMovementTypeEnum::tryFrom((string) $movement->movement_type)?->label() ?? $movement->movement_type }}
                                    </span>
                                    <span class="text-xs font-black {{ $movement->delta() > 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                        {{ $movement->delta() > 0 ? '+' : '' }}{{ $movement->delta() }}
                                    </span>
                                </div>
                                <div class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-[10px] text-[var(--text-soft)]">
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
