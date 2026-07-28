<header class="sticky top-0 z-20 h-20 border-b border-[var(--border)] bg-[var(--topbar)] backdrop-blur-xl">
    <div class="h-full px-8 flex items-center justify-between">
        {{-- Espaçador para manter o botão mobile livre sem sobrepor conteúdo --}}
        <div class="pl-14 lg:pl-0"></div>

        {{-- Ações de Perfil, Idioma e Tema --}}
        <div class="flex items-center gap-3">
            {{-- Language Selector Dropdown --}}
            <div class="relative inline-block text-left" id="langSelectorDropdown">
                <button type="button" id="langDropdownBtn"
                    class="inline-flex h-10 px-3 items-center justify-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface)] text-sm text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer"
                    aria-label="{{ __('Alterar Idioma') }}" aria-haspopup="true" aria-expanded="false">
                    🌐
                    <span class="font-semibold text-xs uppercase text-[var(--text)]">{{ app()->getLocale() }}</span>
                    <svg class="h-3.5 w-3.5 text-[var(--text-soft)]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="langDropdown"
                    class="hidden absolute right-0 mt-2 w-36 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-lg py-1.5 z-50 animate-[fadeIn_0.15s_ease-out]">
                    <a href="{{ route('lang.switch', 'pt') }}"
                        class="flex items-center px-4 py-2.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--surface-2)] {{ app()->getLocale() === 'pt' ? 'bg-primary/10 text-primary' : '' }}">
                        🇵🇹 Português
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}"
                        class="flex items-center px-4 py-2.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--surface-2)] {{ app()->getLocale() === 'en' ? 'bg-primary/10 text-primary' : '' }}">
                        🇬🇧 English
                    </a>
                </div>
            </div>

            {{-- 🔔 Notificações - Sino com contador --}}
            <div class="relative" id="notificationBellContainer">
                <button type="button" id="notificationBellBtn"
                    class="relative inline-flex h-10 w-10 items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] text-sm shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer"
                    aria-label="{{ __('Notificações') }}">
                    🔔
                    <span id="notificationBadge"
                        class="hidden absolute -top-1 -right-1 inline-flex items-center justify-center h-4.5 min-w-[18px] px-1 rounded-full bg-rose-500 text-[9px] font-extrabold text-white shadow-sm shadow-rose-500/30 leading-none"
                        style="font-size:9px;line-height:1">
                        0
                    </span>
                </button>
                {{-- Dropdown de Notificações --}}
                <div id="notificationDropdown"
                    class="hidden absolute right-0 mt-2 w-96 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xl py-2 z-50 animate-[fadeIn_0.15s_ease-out] max-h-[420px] flex flex-col">
                    <div class="px-4 pb-2 border-b border-[var(--border)] flex items-center justify-between">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-[var(--text)]">{{ __('Notificações') }}</h4>
                        <span id="notifCountLabel" class="text-[10px] text-[var(--text-soft)]">0 {{ __('por ler') }}</span>
                    </div>
                    <div id="notificationList" class="overflow-y-auto flex-1 py-1 space-y-0.5 px-1">
                        <p class="text-xs text-[var(--text-soft)] text-center py-6 italic">{{ __('A carregar...') }}</p>
                    </div>
                    <div class="border-t border-[var(--border)] pt-2 px-4">
                        <a href="{{ route('ui.tickets') }}" class="text-[10px] font-bold uppercase tracking-wider text-primary hover:underline block text-center py-1">
                            {{ __('Ver todos os tickets') }} →
                        </a>
                    </div>
                </div>
            </div>

            <button type="button" data-action="toggle-theme"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] text-sm shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer"
                aria-label="{{ __('Alternar Tema') }}">
                🌙
            </button>

            <div class="h-8 w-px bg-[var(--border)]"></div>

            <div id="topbarUser" class="flex items-center gap-3"></div>
        </div>
    </div>
</header>
