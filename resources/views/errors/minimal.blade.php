@extends('ui.layout')

@section('content')
<div class="min-h-screen bg-[var(--bg)] text-[var(--text)] antialiased flex flex-col justify-center">
    <div class="mx-auto max-w-3xl px-6 py-12 lg:px-8 text-center animate-[fadeIn_0.3s_ease-out]">

        {{-- Badge Semântico do Erro --}}
        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full border border-red-500/20 bg-red-500/10 text-xs font-bold uppercase tracking-[0.2em] text-red-500 mb-6" role="alert">
            {{ __('Erro') }} @yield('code')
        </span>

        {{-- Título Principal --}}
        <h1 class="text-4xl font-black tracking-tight text-[var(--text)] sm:text-5xl">
            @yield('title')
        </h1>

        {{-- Descrição Contextualizada --}}
        <p class="mt-6 text-base leading-8 text-[var(--text-soft)] max-w-xl mx-auto">
            @yield('message')
        </p>

        {{-- Ações de Recuperação Dinâmicas (Tratadas por JS abaixo) --}}
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a id="error-recovery-btn" href="{{ url('/') }}"
               class="ui-button ui-button--primary inline-flex items-center justify-center rounded-2xl px-8 py-4 text-base font-bold shadow-lg shadow-primary/20 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30 w-full sm:w-auto min-h-[52px]">
                <svg class="h-4 w-4 mr-2 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                <span id="error-recovery-text">{{ __('Voltar à Página Inicial') }}</span>
            </a>
        </div>

        {{-- Caixa de Informação Técnico Secundária --}}
        @if($exception && $exception->getMessage())
            <div class="mt-16 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 max-w-lg mx-auto text-left flex items-start gap-4 shadow-sm">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-500/10 text-amber-500 font-bold text-sm" aria-hidden="true">
                    i
                </div>
                <div>
                    <h3 class="font-bold text-sm text-[var(--text)]">{{ __('Detalhes do Incidente') }}</h3>
                    <p class="mt-1 text-xs text-[var(--text-soft)] leading-5">
                        {{ $exception->getMessage() }}
                    </p>
                </div>
            </div>
        @endif

    </div>
</div>

{{-- Script de Alinhamento com o Motor de Autenticação --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Deteta o token utilizando exatamente a mesma estratégia do teu app.js
        const hasToken = localStorage.getItem('auth_token') || document.cookie.split('; ').reduce((acc, cookie) => {
            const [key, value] = cookie.split('=');
            return key === 'auth_token' ? value : acc;
        }, null);

        // Se o utilizador possuir o token guardado, reconfigura o botão para o Dashboard
        if (hasToken) {
            const recoveryBtn = document.getElementById('error-recovery-btn');
            const recoveryText = document.getElementById('error-recovery-text');

            if (recoveryBtn && recoveryText) {
                recoveryBtn.href = "{{ url('/ui') }}";
                recoveryText.innerText = "{{ __('Voltar ao Dashboard') }}";
            }
        }
    });
</script>
@endsection
