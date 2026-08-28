{{--
|--------------------------------------------------------------------------
| Currency Selection Modal
|--------------------------------------------------------------------------
| Modal to select only the currency, independent of language and date format
--}}

@php
    $supportedCurrencies = \App\Services\PreferencesService::supportedCurrencies();
    $currentCurrency = \App\Services\PreferencesService::getCurrency(request());
    $preferences = \App\Services\PreferencesService::current(request);
    
    // Currency names for display
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
                    <span class="preferences-modal__title-icon"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg></span>
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
                                aria-label="{{ $currencyNames[$currency] ?? $currency }}">
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
