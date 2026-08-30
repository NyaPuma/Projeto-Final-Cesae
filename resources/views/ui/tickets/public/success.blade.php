<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ \App\Services\LocaleService::isRtl(app()->getLocale()) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('common.Pedido Registado') }} — {{ __('common.Gestão de Avarias') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">

    @vite('resources/js/early-theme.js')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ route('theme.custom') }}?v={{ \App\Http\Controllers\ThemeController::cacheBuster(request()->user()?->theme) }}">

    @include('ui.partials.theme-meta')
    @include('ui.partials.locale-config')
</head>
<body class="min-h-screen overflow-x-hidden bg-[var(--bg)] text-[var(--text)] antialiased{{ \App\Services\LocaleService::isRtl(app()->getLocale()) ? ' rtl' : '' }}">
    <div class="locale-trigger-wrapper fixed right-4 top-4 z-40">
        @include('ui.partials.locale-trigger')
    </div>
    {{-- Background Visual Effects (Glow) --}}
    <div class="pointer-events-none fixed inset-0 -z-10" aria-hidden="true">
        <div class="absolute inset-0 bg-[var(--bg)]"></div>
        <div class="absolute left-1/2 top-0 h-[600px] w-[600px] -translate-x-1/2 rounded-full bg-success/10 blur-[160px]"></div>
        <div class="absolute bottom-0 right-0 h-[500px] w-[500px] rounded-full bg-info/10 blur-[160px]"></div>
    </div>

    <div class="min-h-screen px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto w-full max-w-xl">
            <div class="ui-card overflow-hidden rounded-[32px] border border-[var(--border)] bg-[var(--surface)] shadow-2xl shadow-black/10 backdrop-blur-xl">

                <div class="flex flex-col items-center p-8 text-center sm:p-10">
                    <span class="flex h-16 w-16 items-center justify-center rounded-3xl border border-success/25 bg-success/10">
                    <svg class="h-8 w-8 shrink-0 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>

                    <h1 class="mt-6 text-2xl font-black tracking-tight text-[var(--text)]">{{ __('messages.Pedido Registado com Sucesso') }}</h1>
                    <p class="mt-3 text-sm leading-7 text-[var(--text-soft)]">
                        {{ __('stock.O seu pedido de intervenção foi recebido pela equipa de manutenção. Guarde o número de referência abaixo para acompanhar o estado.') }}
                    </p>

                    <div class="mt-6 w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] p-4">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('common.Número de Referência') }}</p>
                        <p class="mt-1 font-mono text-xl font-black tracking-tight text-[var(--text)]">{{ $ticket->reference }}</p>
                    </div>

                    <div class="mt-4 w-full space-y-2 text-left">
                        <div class="flex items-center justify-between rounded-xl border border-[var(--border)] bg-[var(--surface-2)]/50 px-4 py-3">
                            <span class="text-xs font-semibold text-[var(--text-soft)]">{{ __('equipment.Equipamento') }}</span>
                            <span class="text-xs font-bold text-[var(--text)]">{{ $ticket->equipment?->name ?? __('common.—') }}</span>
                        </div>
                        <div class="flex items-center justify-between rounded-xl border border-[var(--border)] bg-[var(--surface-2)]/50 px-4 py-3">
                            <span class="text-xs font-semibold text-[var(--text-soft)]">{{ __('common.Tipo de Problema') }}</span>
                            <span class="text-xs font-bold text-[var(--text)]">{{ \App\Enums\TicketPriorityEnum::normalize((string) $ticket->priority)?->label() ?? ucfirst((string) $ticket->priority) }}</span>
                        </div>
                    </div>

                    <div class="mt-8 flex w-full flex-col gap-3 sm:flex-row">
                        <a href="{{ route('ticket.public.create', ['machine_id' => $ticket->equipment_id]) }}"
                            class="inline-flex flex-1 items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 text-sm font-bold text-[var(--text)] transition hover:bg-[var(--border)]">
                            {{ __('common.Comunicar Outra Avaria') }}
                        </a>
                        <a href="{{ route('home') }}"
                            class="inline-flex flex-1 items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 text-sm font-bold text-[var(--text)] transition hover:bg-[var(--border)]">
                            {{ __('ui.Voltar ao Início') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('ui.partials.localization-modal')
</body>
</html>
