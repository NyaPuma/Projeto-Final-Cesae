<header class="ui-topbar">
    <div class="ui-topbar__inner">
        <div class="ui-topbar__brand">
            <x-ui.buttons.icon-button type="button" data-action="toggle-mobile-nav" variant="secondary" size="sm" class="ui-topbar__menu-toggle" aria-label="{{ __('ui.Abrir menu') }}" aria-haspopup="true" aria-expanded="false">
                ☰
            </x-ui.buttons.icon-button>
        </div>

        <div class="ui-topbar__actions">
            <x-ui.buttons.button type="button"
                data-action="open-locale-modal"
                data-tab="language"
                variant="secondary"
                size="sm"
                weight="semibold"
                class="ui-topbar__button"
                aria-label="{{ __('common.Alterar idioma') }}"
                aria-haspopup="dialog"
                aria-expanded="false">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                <span class="ui-topbar__locale">{{ strtoupper(substr(\App\Services\PreferencesService::getLanguage(request()), 0, 2)) }}</span>
            </x-ui.buttons.button>

            <x-ui.buttons.button type="button"
                data-action="open-locale-modal"
                data-tab="currency"
                variant="secondary"
                size="sm"
                weight="semibold"
                class="ui-topbar__button"
                aria-label="{{ __('common.Alterar moeda') }}"
                aria-haspopup="dialog"
                aria-expanded="false">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
                <span class="ui-topbar__locale">{{ \App\Services\PreferencesService::getCurrency(request()) }}</span>
            </x-ui.buttons.button>

            <x-ui.buttons.button type="button"
                data-action="open-locale-modal"
                data-tab="date"
                variant="secondary"
                size="sm"
                weight="semibold"
                class="ui-topbar__button"
                aria-label="{{ __('common.Alterar formato de data') }}"
                aria-haspopup="dialog"
                aria-expanded="false">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                <span class="ui-topbar__locale">{{ \App\Services\PreferencesService::getDateFormat(request()) }}</span>
            </x-ui.buttons.button>

            <x-ui.buttons.button type="button"
                data-action="open-locale-modal"
                data-tab="time"
                variant="secondary"
                size="sm"
                weight="semibold"
                class="ui-topbar__button"
                aria-label="{{ __('common.Alterar formato de hora') }}"
                aria-haspopup="dialog"
                aria-expanded="false">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="ui-topbar__locale">{{ \App\Services\PreferencesService::getTimeFormat(request()) }}</span>
            </x-ui.buttons.button>

            <x-ui.buttons.button type="button"
                data-action="open-locale-modal"
                data-tab="number"
                variant="secondary"
                size="sm"
                weight="semibold"
                class="ui-topbar__button"
                aria-label="{{ __('common.Alterar formato de números') }}"
                aria-haspopup="dialog"
                aria-expanded="false">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.621.504-1.125 1.125-1.125"/></svg>
                <span class="ui-topbar__locale">{{ \App\Services\PreferencesService::getNumberFormat(request()) !== null ? json_decode(\App\Services\PreferencesService::getNumberFormat(request()), true)['example'] ?? '1,234.56' : '1,234.56' }}</span>
            </x-ui.buttons.button>

            <x-ui.buttons.icon-button type="button" id="notificationBellBtn" data-action="open-notifications-modal" variant="secondary" size="sm" class="ui-topbar__icon-button" aria-label="{{ __('common.Notificações') }}" aria-haspopup="dialog">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                <span id="notificationBadge" class="ui-topbar__notification-badge hidden">0</span>
            </x-ui.buttons.icon-button>

            <x-ui.buttons.icon-button type="button" id="themeToggleBtn" data-action="toggle-theme" variant="secondary" size="sm" aria-label="{{ __('ui.Alternar Tema') }}" aria-live="polite">
                <span data-theme-icon><svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/></svg></span>
            </x-ui.buttons.icon-button>

            <div class="ui-topbar__divider"></div>

            <div id="topbarUser" class="ui-topbar__user"></div>
        </div>
    </div>
</header>
