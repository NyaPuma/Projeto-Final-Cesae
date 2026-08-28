{{--
|--------------------------------------------------------------------------
| Unified Localization Modal
|--------------------------------------------------------------------------
| Popup with tabs for Language, Currency, Date, Time and Decimal Format.
| Each tab shows all available options and saves the preference
| automatically on selection.
--}}

@php
    $currentLanguage = \App\Services\PreferencesService::getLanguage(request());
    $currentCurrency = \App\Services\PreferencesService::getCurrency(request());
    $currentDateFormat = \App\Services\PreferencesService::getDateFormat(request());
    $currentTimeFormat = \App\Services\PreferencesService::getTimeFormat(request());
    $currentNumberFormat = \App\Services\PreferencesService::getNumberFormat(request());

    $grouped = \App\Services\LocaleService::groupedByContinent();
    $supportedDateFormats = \App\Services\PreferencesService::groupedDateFormats();
    $supportedTimeFormats = \App\Services\PreferencesService::supportedTimeFormats();
    $supportedNumberFormats = \App\Services\PreferencesService::groupedNumberFormats();

    $tabLabels = [
        'language' => __('common.Idioma'),
        'currency' => __('preferences.Moeda'),
        'date' => __('common.Data'),
        'time' => __('common.Hora'),
        'number' => __('common.Decimal'),
    ];
    $firstTab = array_key_first($tabLabels);
@endphp

<div id="localizationModal"
     class="locale-modal localization-modal"
     role="dialog"
     aria-modal="true"
     aria-labelledby="localizationModalTitle"
     tabindex="-1"
     data-update-language-url="{{ route('preferences.update_language') }}"
     data-update-currency-url="{{ route('preferences.update_currency') }}"
     data-update-date-format-url="{{ route('preferences.update_date_format') }}"
     data-update-time-format-url="{{ route('preferences.update_time_format') }}"
     data-update-number-format-url="{{ route('preferences.update_number_format') }}"
     hidden>

    {{-- Overlay --}}
    <div class="locale-modal__overlay" data-close-modal></div>

    {{-- Container --}}
    <div class="locale-modal__container localization-modal__container">

        {{-- Header --}}
        <div class="locale-modal__header">
            <div class="locale-modal__header-row">
                <h2 id="localizationModalTitle" class="locale-modal__title">
                    <span class="locale-modal__title-icon"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg></span>
                    {{ __('common.Localização') }}
                </h2>
                <button type="button"
                        class="locale-modal__close-btn"
                        data-close-modal
                        aria-label="{{ __('ui.Fechar') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="localization-modal__tabs" role="tablist">
            @foreach ($tabLabels as $key => $label)
                <button type="button"
                        class="localization-modal__tab{{ $key === $firstTab ? ' localization-modal__tab--active' : '' }}"
                        role="tab"
                        data-tab="{{ $key }}"
                        aria-selected="{{ $key === $firstTab ? 'true' : 'false' }}"
                        aria-controls="localizationTab-{{ $key }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- Body --}}
        <div class="locale-modal__body localization-modal__body">

            {{-- Language Tab --}}
            <div id="localizationTab-language"
                 class="localization-modal__tab-panel{{ 'language' === $firstTab ? ' localization-modal__tab-panel--active' : '' }}"
                 role="tabpanel"
                 data-tab-panel="language"
                 @if ('language' !== $firstTab) hidden @endif>
                <div class="locale-modal__grid">
                    @foreach ($grouped as $continent => $locales)
                        @if (is_array($locales) && count($locales))
                            <div class="locale-modal__section" data-locale-section="{{ $continent }}">
                                <h3 class="locale-modal__section-title">{{ ucfirst(str_replace('_', ' ', $continent)) }}</h3>
                                <div class="locale-modal__grid">
                                    @foreach ($locales as $item)
                                        @php $code = $item['code'] ?? ''; @endphp
                                        @if (!$code) @continue @endif
                                        <button type="button"
                                                class="locale-modal__card localization-modal__card{{ $currentLanguage === $code ? ' locale-modal__card--active' : '' }}"
                                                data-locale="{{ $code }}"
                                                data-search="{{ strtolower(implode(' ', [$item['native'] ?? '', $item['name'] ?? '', $item['country'] ?? '', $code])) }}"
                                                aria-label="{{ $item['name'] ?? $code }}">
                                            <span class="locale-modal__flag"
                                                  role="img"
                                                  aria-label="{{ __('common.Bandeira de :country', ['country' => $item['country'] ?? '']) }}">{{ \App\Services\LocaleService::flagEmoji($item['flag'] ?? null) }}</span>
                                            <div class="locale-modal__info">
                                                <span class="locale-modal__name">{{ $item['native'] ?? $code }}</span>
                                                <span class="locale-modal__country">{{ $item['name'] ?? '' }}</span>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Currency Tab --}}
            <div id="localizationTab-currency"
                 class="localization-modal__tab-panel"
                 role="tabpanel"
                 data-tab-panel="currency"
                 hidden>
                <div class="locale-modal__grid">
                    @foreach (\App\Services\LocaleService::currenciesByContinent() as $continent => $currencies)
                        @if (is_array($currencies) && count($currencies))
                            <div class="locale-modal__section" data-locale-section="{{ $continent }}">
                                <h3 class="locale-modal__section-title">{{ ucfirst(str_replace('_', ' ', $continent)) }}</h3>
                                <div class="locale-modal__grid">
                                    @foreach ($currencies as $currency)
                                        <button type="button"
                                                class="locale-modal__card localization-modal__card{{ $currentCurrency === $currency ? ' locale-modal__card--active' : '' }}"
                                                data-currency="{{ $currency }}"
                                                data-search="{{ strtolower($currency . ' ' . \App\Services\LocaleService::currencyName($currency)) }}">
                                            <div class="locale-modal__info">
                                                <span class="locale-modal__name">{{ $currency }} - {{ \App\Services\LocaleService::currencyName($currency) }}</span>
                                                <span class="locale-modal__country">{{ \App\Services\LocaleService::formatCurrency(1, $currency) }}</span>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Date Format Tab --}}
            <div id="localizationTab-date"
                 class="localization-modal__tab-panel"
                 role="tabpanel"
                 data-tab-panel="date"
                 hidden>
                <div class="locale-modal__grid">
                    @foreach ($supportedDateFormats as $separator => $formats)
                        @if (is_array($formats) && count($formats))
                            <div class="locale-modal__section" data-locale-section="{{ $separator }}">
                                <h3 class="locale-modal__section-title">{{ __('ui.Separador') }} »{{ $separator }}«</h3>
                                <div class="locale-modal__grid">
                                    @foreach ($formats as $format)
                                        <button type="button"
                                                class="locale-modal__card localization-modal__card{{ $currentDateFormat === $format ? ' locale-modal__card--active' : '' }}"
                                                data-date-format="{{ $format }}"
                                                data-search="{{ strtolower($format) }}">
                                            <div class="locale-modal__info">
                                                <span class="locale-modal__name">{{ $format }}</span>
                                                <span class="locale-modal__country">{{ now()->format($format) }}</span>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Time Format Tab --}}
            <div id="localizationTab-time"
                 class="localization-modal__tab-panel"
                 role="tabpanel"
                 data-tab-panel="time"
                 hidden>
                <div class="locale-modal__grid">
                    @foreach ($supportedTimeFormats as $format => $meta)
                        <button type="button"
                                class="locale-modal__card localization-modal__card{{ $currentTimeFormat === $format ? ' locale-modal__card--active' : '' }}"
                                data-time-format="{{ $format }}"
                                data-search="{{ strtolower($meta['label'] . ' ' . $meta['example'] . ' ' . $format) }}">
                            <div class="locale-modal__info">
                                <span class="locale-modal__name">{{ $meta['label'] }}</span>
                                <span class="locale-modal__country">{{ $meta['example'] }}</span>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Number Format Tab --}}
            <div id="localizationTab-number"
                 class="localization-modal__tab-panel"
                 role="tabpanel"
                 data-tab-panel="number"
                 hidden>
                <div class="locale-modal__grid">
                    @foreach ($supportedNumberFormats as $separator => $formats)
                        @if (is_array($formats) && count($formats))
                            <div class="locale-modal__section" data-locale-section="{{ $separator }}">
                                <h3 class="locale-modal__section-title">{{ __('ui.Separador decimal') }} »{{ $separator }}«</h3>
                                <div class="locale-modal__grid">
                                    @foreach ($formats as $key => $format)
                                        <button type="button"
                                                class="locale-modal__card localization-modal__card{{ $currentNumberFormat === json_encode($format) ? ' locale-modal__card--active' : '' }}"
                                                data-number-format="{{ $key }}"
                                                data-number-format-encoded="{{ json_encode($format) }}"
                                                data-search="{{ strtolower(($format['example'] ?? '') . ' ' . $key) }}">
                                            <div class="locale-modal__info">
                                                <span class="locale-modal__name">{{ $format['example'] ?? $key }}</span>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>

    </div>{{-- /.localization-modal__container --}}

</div>{{-- /.localization-modal --}}
