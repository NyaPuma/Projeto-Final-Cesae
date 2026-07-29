@extends('ui.layout')

@section('content')
<div class="relative min-h-[calc(100vh-80px)] overflow-hidden">
    <div class="absolute inset-0 -z-10">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(250,204,21,0.08),transparent_45%)] dark:bg-[radial-gradient(circle_at_top,rgba(250,204,21,0.12),transparent_45%)]"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 h-[420px] w-[420px] rounded-full bg-primary/10 blur-3xl"></div>
        <div class="ui-login-grid absolute inset-0 opacity-[0.03] dark:opacity-[0.06]"></div>
    </div>

    <div class="flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-lg">
            <div class="mb-10 text-center">
                <div class="mb-6 inline-flex h-20 w-20 items-center justify-center rounded-3xl bg-primary shadow-lg shadow-primary/20">
                    <svg class="h-10 w-10 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 00-1 1v1a2 2 0 11-4 0v-1a1 1 0 00-1-1H7a1 1 0 01-1-1v-3a1 1 0 011-1h1a2 2 0 100-4H7a1 1 0 01-1-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                    </svg>
                </div>

                <h1 class="text-4xl font-extrabold tracking-tight text-[var(--text)]">
                    {{ __('Gestão de Avarias') }}
                </h1>

                <p class="mx-auto mt-3 max-w-sm leading-relaxed text-[var(--text-soft)]">
                    {{ __('Plataforma central para gestão, manutenção e acompanhamento de equipamentos.') }}
                </p>
            </div>

            <div class="relative overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)] shadow-xl shadow-black/5 dark:shadow-black/30">
                <div class="absolute inset-x-0 top-0 h-1 bg-primary"></div>

                <div class="p-10">
                    <x-ui.auth.form-header
                        :eyebrow="__('Autenticação')"
                        :title="__('Bem-vindo novamente')"
                        :description="__('Introduza as suas credenciais para aceder ao painel administrativo.')"
                    />

                    <form id="loginForm" class="space-y-6">
                        <x-ui.auth.text-field
                            id="email"
                            name="email"
                            :label="__('Email')"
                            type="email"
                            autocomplete="email"
                            :required="true"
                            placeholder="utilizador@empresa.pt"
                            class="px-5"
                        />

                        <div>
                            <div class="mb-2 flex items-center justify-between">
                                <label for="password" class="text-xs font-bold uppercase tracking-wider text-[var(--text-soft)]">
                                    {{ __('Palavra-passe') }}
                                </label>

                                <a href="#" class="text-sm font-medium text-primary hover:underline">
                                    {{ __('Esqueceu-se?') }}
                                </a>
                            </div>

                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                required
                                placeholder="••••••••"
                                class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-5 py-3.5 text-sm text-[var(--text)] outline-none transition-all duration-200 focus:border-primary focus:ring-4 focus:ring-primary/15"
                            >
                        </div>

                        <x-ui.buttons.submit type="submit" variant="primary" size="md" weight="bold" class="group w-full rounded-2xl shadow-lg shadow-primary/20 hover:shadow-primary/30">
                            <span>{{ __('Entrar no Sistema') }}</span>
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </x-ui.buttons.submit>
                    </form>

                    <div id="msg" aria-live="polite" class="mt-5 flex min-h-[42px] items-center justify-center rounded-2xl text-center text-sm font-medium transition-all"></div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <p class="text-xs text-[var(--text-soft)]">
                    © {{ date('Y') }} {{ __('Sistema de Gestão de Avarias') }}
                </p>

                <p class="mt-1 text-xs text-[var(--text-soft)] opacity-70">
                    {{ __('Desenvolvido em Laravel • Interface Responsiva • Light & Dark Mode') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
