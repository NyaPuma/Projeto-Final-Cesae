{{--
|--------------------------------------------------------------------------
| Topbar Component
|--------------------------------------------------------------------------
|
| Cabeçalho superior reativo com suporte a temas, perfil de utilizador e A11y.
| • 100% livre de CSS ou JS inline.
| • Integração total com Alpine.js Stores ($store.auth e $store.theme).
| • Suporte a propriedades customizáveis para títulos e subtítulos.
|
--}}

@props([
    'title' => 'Painel de Gestão',
    'subtitle' => 'Monitorização em tempo real',
])

<header {{ $attributes->merge(['class' => 'sticky top-0 z-40 h-20 border-b border-[var(--border)] bg-[var(--topbar)] backdrop-blur-xl']) }}>
    <div class="h-full px-8 flex items-center justify-between">
        {{-- Título e Descrição Dinâmicos --}}
        <div>
            <h2 class="text-lg font-bold tracking-tight text-[var(--text)]">{{ $title }}</h2>
            @if($subtitle)
                <p class="text-[var(--text-soft)] text-xs">{{ $subtitle }}</p>
            @endif
        </div>

        {{-- Ações da Topbar --}}
        <div class="flex items-center gap-4" x-data>
            {{-- Botão de Alternar Tema (Controlado via Alpine Store) --}}
            <button
                type="button"
                @click="$store.theme.toggle()"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] text-sm shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer"
                :aria-label="$store.theme.dark ? 'Mudar para tema claro' : 'Mudar para tema escuro'"
            >
                <span x-text="$store.theme.dark ? '☀️' : '🌙'" aria-hidden="true"></span>
            </button>

            <div class="h-8 w-px bg-[var(--border)]" aria-hidden="true"></div>

            {{-- Bloco do Utilizador Integrado de forma Reativa --}}
            <div id="topbarUser" class="flex items-center gap-3">
                <template x-if="$store.auth.isAuthenticated">
                    <a href="/ui/profile" class="flex items-center gap-3 rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 transition hover:bg-[var(--surface-2)]">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary font-bold text-xs text-black shadow-sm" x-text="$store.auth.userInitial"></div>
                        <div class="hidden md:block">
                            <div class="text-sm font-semibold text-[var(--text)] leading-none" x-text="$store.auth.userName"></div>
                            <div class="mt-1 text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)]" x-text="$store.auth.userRole"></div>
                        </div>
                    </a>
                </template>

                <template x-if="!$store.auth.isAuthenticated">
                    <a href="/ui/login" class="inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-black shadow-sm hover:opacity-90">
                        Login / Registo
                    </a>
                </template>
            </div>
        </div>
    </div>
</header>
