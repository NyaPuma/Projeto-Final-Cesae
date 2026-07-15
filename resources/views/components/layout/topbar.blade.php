
<!-- resources/views/components/layout/topbar.blade.php -->
<header class="sticky top-0 z-40 h-20 border-b border-[var(--border)] bg-[var(--topbar)] backdrop-blur-xl">
    <div class="h-full px-8 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold tracking-tight text-[var(--text)]">Painel de Gestão</h2>
            <p class="text-[var(--text-soft)] text-xs">Monitorização em tempo real</p>
        </div>

        <div class="flex items-center gap-4">
            <button
                type="button"
                onclick="toggleTheme()"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] text-sm shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer"
                aria-label="Alternar Tema"
            >
                🌙
            </button>

            <div class="h-8 w-px bg-[var(--border)]"></div>

            <div id="topbarUser" class="flex items-center gap-3"></div>
        </div>
    </div>
</header>
