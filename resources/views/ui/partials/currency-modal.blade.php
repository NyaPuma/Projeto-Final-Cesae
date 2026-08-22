{{--
|--------------------------------------------------------------------------
| Modal de Seleção de Moeda
|--------------------------------------------------------------------------
| Modal para seleccionar apenas a moeda, independente de língua e formato de data
--}}

@php
    $supportedCurrencies = \App\Services\PreferencesService::supportedCurrencies();
    $currentCurrency = \App\Services\PreferencesService::getCurrency(request());
    $preferences = \App\Services\PreferencesService::current(request);
    
    // Nomes das moedas para display
    $currencyNames = [
        'EUR' => 'Euro (€)',
        'USD' => 'Dólar Americano ($)',
        'GBP' => 'Libra Esterlina (£)',
        'BRL' => 'Real Brasileiro (R$)',
        'JPY' => 'Iene Japonês (¥)',
        'CNY' => 'Yuan Chinês (¥)',
        'PLN' => 'Złoty Polaco (zł)',
        'ARS' => 'Peso Argentino ($)',
        'CAD' => 'Dólar Canadiano (CA$)',
        'MXN' => 'Peso Mexicano (MX$)',
        'INR' => 'Rúpia Indiana (₹)',
        'AED' => 'Dirham dos Emirados (AED)',
        'KRW' => 'Won Sul-Coreano (₩)',
        'ALL' => 'Lek Albanês (L)',
        'AZN' => 'Manat Azeri (₼)',
        'BAM' => 'Marco Convertível (KM)',
        'BGN' => 'Lev Búlgaro (лв)',
        'BYN' => 'Rublos Bielorrusso (Br)',
        'CHF' => 'Franco Suíço (Fr)',
        'CZK' => 'Coroa Checa (Kč)',
        'DKK' => 'Coroa Dinamarquesa (kr)',
        'GEL' => 'Lari Georgiano (₾)',
        'HUF' => 'Forint Húngaro (Ft)',
        'ISK' => 'Coroa Islandesa (kr)',
        'MDL' => 'Leu Moldavo (L)',
        'MKD' => 'Denar Macedónio (ден)',
        'RON' => 'Leu Romeno (lei)',
        'RSD' => 'Dinar Sérvio (дин)',
        'RUB' => 'Rublo Russo (₽)',
        'SEK' => 'Coroa Sueca (kr)',
        'TRY' => 'Lira Turca (₺)',
        'UAH' => 'Hryvnia Ucraniana (₴)',
        'AMD' => 'Dram Arménio (֏)',
    ];
@endphp

<div id="currencyModal"
     class="preferences-modal"
     role="dialog"
     aria-modal="true"
     aria-labelledby="currencyModalTitle"
     tabindex="-1"
     hidden>

    {{-- Overlay --}}
    <div class="preferences-modal__overlay" data-currency-modal-close></div>

    {{-- Container --}}
    <div class="preferences-modal__container">

        {{-- Header --}}
        <div class="preferences-modal__header">
            <div class="preferences-modal__header-row">
                <h2 id="currencyModalTitle" class="preferences-modal__title">
                    <span class="preferences-modal__title-icon">💰</span>
                    {{ __('preferences.Selecionar Moeda') }}
                </h2>
                <button type="button"
                        class="preferences-modal__close-btn"
                        data-currency-modal-close
                        aria-label="{{ __('ui.Fechar') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Current selection info --}}
            <div class="preferences-modal__info">
                <p>{{ __('preferences.Moeda atual') }}: <strong>{{ $currentCurrency }}</strong></p>
                <p>{{ __('preferences.Língua atual') }}: <strong>{{ $preferences['language'] }}</strong> | {{ __('ui.Formato de data') }}: <strong>{{ $preferences['date_format'] }}</strong></p>
            </div>
        </div>

        {{-- Body (scrollable) --}}
        <div class="preferences-modal__body" id="currencyModalBody">
            <div class="preferences-modal__section">
                <div class="preferences-modal__grid">
                    @foreach ($supportedCurrencies as $currency)
                        <button type="button"
                                class="preferences-modal__card currency-card{{ $currency === $currentCurrency ? ' preferences-modal__card--active' : '' }}"
                                data-currency="{{ $currency }}"
                                data-search="{{ strtolower($currencyNames[$currency] ?? $currency) }}"
                                aria-label="{{ $currencyNames[$currency] ?? $currency }}"
                                title="{{ $currencyNames[$currency] ?? $currency }}">
                            <span class="preferences-modal__currency-symbol">
                                @php
                                    $symbols = [
                                        'EUR' => '€', 'USD' => '$', 'GBP' => '£', 'BRL' => 'R$', 'JPY' => '¥', 
                                        'CNY' => '¥', 'PLN' => 'zł', 'ARS' => '$', 'CAD' => 'CA$', 'MXN' => 'MX$',
                                        'INR' => '₹', 'AED' => 'AED', 'KRW' => '₩', 'ALL' => 'L', 'AZN' => '₼',
                                        'BAM' => 'KM', 'BGN' => 'лв', 'BYN' => 'Br', 'CHF' => 'Fr', 'CZK' => 'Kč',
                                        'DKK' => 'kr', 'GEL' => '₾', 'HUF' => 'Ft', 'ISK' => 'kr', 'MDL' => 'L',
                                        'MKD' => 'ден', 'RON' => 'lei', 'RSD' => 'дин', 'RUB' => '₽', 'SEK' => 'kr',
                                        'TRY' => '₺', 'UAH' => '₴', 'AMD' => '֏'
                                    ];
                                    echo $symbols[$currency] ?? $currency;
                                @endphp
                            </span>
                            <div class="preferences-modal__info">
                                <span class="preferences-modal__name">{{ $currency }}</span>
                                <span class="preferences-modal__country">{{ $currencyNames[$currency] ?? $currency }}</span>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Preview --}}
        <div class="preferences-modal__preview" id="currencyPreview">
            <span class="preferences-modal__preview-default" id="currencyPreviewDefault">
                {{ __('preferences.Seleccione uma moeda para pré-visualizar') }}
            </span>
        </div>

    </div>{{-- /.preferences-modal__container --}}

    {{-- Hidden form for currency switching --}}
    <form id="currencyForm" class="preferences-modal__form" method="POST" action="{{ route('preferences.currency') }}">
        @csrf
        <input type="hidden" name="currency" id="currencyFormInput" value="">
    </form>

</div>{{-- /.currency-modal --}}
