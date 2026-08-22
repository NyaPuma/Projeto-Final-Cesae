<div class="ui-topbar__dropdown" id="currencyDropdown">
    <x-ui.buttons.button type="button" 
        onclick="openPreferenceDropdown('currencyDropdown', 'currencyDropdownPanel')"
        variant="secondary" 
        size="sm" 
        weight="semibold" 
        class="ui-topbar__button" 
        aria-label="{{ __('common.Alterar moeda') }}" 
        aria-haspopup="true" 
        aria-expanded="false">
        💰
        <span class="ui-topbar__locale">{{ \App\Services\PreferencesService::getCurrency(request()) }} - {{ \App\Services\LocaleService::currencyName(\App\Services\PreferencesService::getCurrency(request())) }}</span>
    </x-ui.buttons.button>
    
    <div id="currencyDropdownPanel" class="ui-topbar__dropdown-panel" role="dialog" aria-label="{{ __('common.Selecionar moeda') }}" hidden>
        <div class="ui-topbar__dropdown-header">
            <h4>{{ __('preferences.Moeda') }}</h4>
        </div>
        <div class="ui-topbar__dropdown-list">
            @foreach(\App\Services\LocaleService::currenciesByContinent() as $continent => $currencies)
                @if (is_array($currencies) && count($currencies))
                    <div class="locale-modal__section" style="margin-top: 0.5rem;">
                        <h3 class="locale-modal__section-title" style="font-size: 0.75rem; padding: 0 1rem;">
                            {{ ucfirst(str_replace('_', ' ', $continent)) }}
                        </h3>
                        <div class="locale-modal__grid" style="display: flex; flex-direction: column; gap: 0.25rem; padding: 0 0.5rem;">
                            @foreach($currencies as $currency)
                                <button type="button" 
                                    class="ui-topbar__dropdown-item{{ \App\Services\PreferencesService::getCurrency(request()) === $currency ? ' ui-topbar__dropdown-item--active' : '' }}"
                                    onclick="setPreference('{{ route("preferences.update_currency") }}', {currency: '{{ $currency }}'}, 'currencyDropdown')"
                                    data-currency="{{ $currency }}">
                                    {{ $currency }} - {{ \App\Services\LocaleService::currencyName($currency) }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
