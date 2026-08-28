{{--
|--------------------------------------------------------------------------
| Notifications Modal
|--------------------------------------------------------------------------
| Centered modal with backdrop blur for displaying notifications.
--}}

<div id="notificationsModal"
     class="locale-modal notifications-modal"
     role="dialog"
     aria-modal="true"
     aria-labelledby="notificationsModalTitle"
     tabindex="-1"
     hidden>

    <div class="locale-modal__overlay" data-close-notifications-modal></div>

    <div class="locale-modal__container notifications-modal__container">

        <div class="locale-modal__header">
            <div class="locale-modal__header-row">
                <h2 id="notificationsModalTitle" class="locale-modal__title">
                    <span class="locale-modal__title-icon"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg></span>
                    {{ __('common.Notificações') }}
                </h2>
                <button type="button"
                        class="locale-modal__close-btn"
                        data-close-notifications-modal
                        aria-label="{{ __('ui.Fechar') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                    </svg>
                </button>
            </div>
            <div class="notifications-modal__subheader">
                <span id="notifCountLabel" class="notifications-modal__count">0 {{ __('common.por ler') }}</span>
            </div>
        </div>

        <div class="locale-modal__body notifications-modal__body">
            <div id="notificationList" class="notifications-modal__list">
                <p class="notifications-modal__loading">{{ __('ui.A carregar...') }}</p>
            </div>
        </div>

        <div class="notifications-modal__footer">
            <a href="{{ route('ui.tickets') }}" class="notifications-modal__footer-link">{{ __('tickets.Ver todos os tickets') }} →</a>
        </div>

    </div>
</div>
