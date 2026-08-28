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
        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
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
