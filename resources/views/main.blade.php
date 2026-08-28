@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-[var(--bg)] text-[var(--text)] antialiased flex flex-col justify-center">
    <div class="mx-auto max-w-3xl px-6 py-12 lg:px-8 text-center animate-[fadeIn_0.3s_ease-out]">

        <x-ui.text.pill tone="primary" size="sm" class="mb-6 gap-1.5 font-bold">
            {{ __('messages.Bem-vindo ao Sistema') }}
        </x-ui.text.pill>

        <h1 class="text-4xl font-black tracking-tight text-[var(--text)] sm:text-5xl">
            {{ __('common.Gestão de Avarias') }}
        </h1>

        <p class="mt-6 text-base leading-8 text-[var(--text-soft)] max-w-xl mx-auto">
            {{ __('tickets.Plataforma centralizada de controlo operacional para gestão de ocorrências, manutenção de equipamentos e monitorização de salas.') }}
        </p>

        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/ui/login" class="ui-button ui-button--primary inline-flex items-center justify-center rounded-2xl px-8 py-4 text-base font-bold shadow-lg shadow-primary/20 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30 w-full sm:w-auto min-h-[52px]">
                {{ __('auth.Iniciar Sessão') }}
                <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="mt-16 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 max-w-lg mx-auto text-left flex items-start gap-4 shadow-sm">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-success/10 text-success font-bold text-sm">
                ✓
            </div>
            <div>
                <p class="font-bold text-sm text-[var(--text)]">{{ __('common.Ligação Segura SSL') }}</p>
                <p class="mt-1 text-xs text-[var(--text-soft)] leading-5">{{ __('auth.Toda a comunicação com a nossa API é encriptada e os acessos são geridos através de tokens de autenticação individuais.') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
