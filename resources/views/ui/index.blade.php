@extends('ui.layout')

@section('page_key', 'dashboard')

@php
    $profileName = $user->profile->name ?? 'user';
    $isAdmin = $profileName === 'admin';

    $profileLabel = match ($profileName) {
        'admin' => __('Administrador'),
        'technician' => __('Técnico'),
        default => __('Funcionário'),
    };
@endphp

@section('content')
<x-ui.partials.page-card
    :title="__('Painel Operacional')"
    :subtitle="__('Selecione uma dimensão do sistema para monitorização e gestão de ativos.')"
>
    <x-ui.dashboard.welcome-panel
        :userName="$user->name ?? __('utilizador')"
        :profileLabel="$profileLabel"
    />

    @if($isAdmin)
        <div id="metricsPanel" class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4"></div>
    @else
        <div class="mb-8 rounded-2xl border border-dashed border-(--border) bg-(--surface-2) p-5 text-center">
            <p class="text-xs text-(--text-soft)">{{ __('Métricas disponíveis apenas para Administrador.') }}</p>
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-3 mb-6">
        <div class="lg:col-span-2 rounded-2xl border border-(--border) bg-(--surface) p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex flex-col justify-between">
            <div>
                <div class="mb-4 flex items-center justify-between border-b border-(--border) pb-3">
                    <div>
                        <x-ui.text.eyebrow as="p" size="xs" tracking="widest" class="font-bold">{{ __('Atividade Recente') }}</x-ui.text.eyebrow>
                        <h3 class="text-base font-bold text-(--text)">{{ __('Últimas Ocorrências Registadas') }}</h3>
                    </div>
                    <a href="/ui/tickets" class="text-xs font-bold text-primary hover:underline flex items-center gap-1">
                        {{ __('Ver todos') }} &rarr;
                    </a>
                </div>

                <div id="recentTicketsTable" class="overflow-x-auto">
                    <div class="text-xs text-(--text-soft) animate-pulse py-4">
                        {{ __('A carregar fluxo de ocorrências...') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-(--border) bg-(--surface) p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex flex-col justify-between">
            <div>
                <div class="mb-4 border-b border-(--border) pb-3">
                    <x-ui.text.eyebrow as="p" size="xs" tracking="widest" class="font-bold">{{ __('Operações') }}</x-ui.text.eyebrow>
                    <h3 class="text-base font-bold text-(--text)">{{ __('Piquete Técnico Ativo') }}</h3>
                </div>

                <div id="picketList" class="space-y-3 mt-2">
                    <div class="flex items-center justify-between text-xs py-1.5 border-b border-(--border)/50">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="font-semibold text-(--text)">Emanuel Silva</span>
                        </div>
                        <span class="text-[10px] font-bold text-amber-500 bg-amber-500/10 px-2 py-0.5 rounded-full">2 {{ __('em curso') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs py-1.5 border-b border-(--border)/50">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="font-semibold text-(--text)">João Pires</span>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-500 bg-emerald-500/10 px-2 py-0.5 rounded-full">1 {{ __('em curso') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs py-1.5">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-slate-500"></span>
                            <span class="font-semibold text-(--text-soft)">Carlos Costa</span>
                        </div>
                        <span class="text-[10px] font-semibold text-(--text-soft)">Off-line</span>
                    </div>
                </div>
            </div>

            @if($isAdmin)
                <div class="mt-6 pt-4 border-t border-(--border)">
                    <a href="/ui/users" class="w-full inline-flex items-center justify-center bg-(--surface-2) hover:bg-(--border) text-(--text) border border-(--border) text-xs font-bold py-2.5 px-4 rounded-xl transition">
                        {{ __('Gerir Equipas & Piquetes') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-ui.partials.page-card>
@endsection
