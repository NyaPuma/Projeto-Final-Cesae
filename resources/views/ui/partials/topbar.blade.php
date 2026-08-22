<header class="ui-topbar">
    <div class="ui-topbar__inner">
        <div class="ui-topbar__brand">
            <x-ui.buttons.icon-button type="button" data-action="toggle-mobile-nav" variant="secondary" size="sm" class="ui-topbar__menu-toggle" aria-label="{{ __('ui.Abrir menu') }}" aria-haspopup="true" aria-expanded="false">
                ☰
            </x-ui.buttons.icon-button>
        </div>

        <div class="ui-topbar__actions">
            <x-ui.buttons.button type="button"
                onclick="openLocalizationModal('language')"
                variant="secondary"
                size="sm"
                weight="semibold"
                class="ui-topbar__button"
                aria-label="{{ __('common.Alterar idioma') }}"
                aria-haspopup="dialog"
                aria-expanded="false">
                🌐
                <span class="ui-topbar__locale">{{ strtoupper(substr(\App\Services\PreferencesService::getLanguage(request()), 0, 2)) }}</span>
            </x-ui.buttons.button>

            <x-ui.buttons.button type="button"
                onclick="openLocalizationModal('currency')"
                variant="secondary"
                size="sm"
                weight="semibold"
                class="ui-topbar__button"
                aria-label="{{ __('common.Alterar moeda') }}"
                aria-haspopup="dialog"
                aria-expanded="false">
                💰
                <span class="ui-topbar__locale">{{ \App\Services\PreferencesService::getCurrency(request()) }}</span>
            </x-ui.buttons.button>

            <x-ui.buttons.button type="button"
                onclick="openLocalizationModal('date')"
                variant="secondary"
                size="sm"
                weight="semibold"
                class="ui-topbar__button"
                aria-label="{{ __('common.Alterar formato de data') }}"
                aria-haspopup="dialog"
                aria-expanded="false">
                📅
                <span class="ui-topbar__locale">{{ \App\Services\PreferencesService::getDateFormat(request()) }}</span>
            </x-ui.buttons.button>

            <x-ui.buttons.button type="button"
                onclick="openLocalizationModal('time')"
                variant="secondary"
                size="sm"
                weight="semibold"
                class="ui-topbar__button"
                aria-label="{{ __('common.Alterar formato de hora') }}"
                aria-haspopup="dialog"
                aria-expanded="false">
                🕐
                <span class="ui-topbar__locale">{{ \App\Services\PreferencesService::getTimeFormat(request()) }}</span>
            </x-ui.buttons.button>

            <x-ui.buttons.button type="button"
                onclick="openLocalizationModal('number')"
                variant="secondary"
                size="sm"
                weight="semibold"
                class="ui-topbar__button"
                aria-label="{{ __('common.Alterar formato de números') }}"
                aria-haspopup="dialog"
                aria-expanded="false">
                🔢
                <span class="ui-topbar__locale">{{ \App\Services\PreferencesService::getNumberFormat(request()) !== null ? json_decode(\App\Services\PreferencesService::getNumberFormat(request()), true)['example'] ?? '1,234.56' : '1,234.56' }}</span>
            </x-ui.buttons.button>

            <div class="ui-topbar__dropdown" id="notificationBellContainer">
                <x-ui.buttons.icon-button type="button" id="notificationBellBtn" data-action="toggle-notifications" variant="secondary" size="sm" class="ui-topbar__icon-button" aria-label="{{ __('common.Notificações') }}" aria-haspopup="true" aria-expanded="false">
                    🔔
                    <span id="notificationBadge" class="ui-topbar__notification-badge hidden">0</span>
                </x-ui.buttons.icon-button>
                <div id="notificationDropdown" class="ui-topbar__dropdown-panel ui-topbar__notifications" role="dialog" aria-label="{{ __('common.Notificações') }}">
                    <div class="ui-topbar__notifications-header">
                        <h4>{{ __('common.Notificações') }}</h4>
                        <span id="notifCountLabel" class="ui-topbar__notifications-count">0 {{ __('common.por ler') }}</span>
                    </div>
                    <div id="notificationList" class="ui-topbar__notifications-list">
                        <p>{{ __('ui.A carregar...') }}</p>
                    </div>
                    <div class="ui-topbar__notifications-footer">
                        <a href="{{ route('ui.tickets') }}">{{ __('tickets.Ver todos os tickets') }} →</a>
                    </div>
                </div>
            </div>

            <x-ui.buttons.icon-button type="button" id="themeToggleBtn" data-action="toggle-theme" variant="secondary" size="sm" aria-label="{{ __('ui.Alternar Tema') }}" aria-live="polite">
                <span data-theme-icon>🌙</span>
            </x-ui.buttons.icon-button>

            <div class="ui-topbar__divider"></div>

            <div id="topbarUser" class="ui-topbar__user"></div>
        </div>
    </div>
</header>
