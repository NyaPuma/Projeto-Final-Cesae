<div class="ui-topbar__dropdown" id="numberFormatDropdown">
    <x-ui.buttons.button type="button" 
        onclick="openPreferenceDropdown('numberFormatDropdown', 'numberFormatDropdownPanel')"
        variant="secondary" 
        size="sm" 
        weight="semibold" 
        class="ui-topbar__button" 
        aria-label="{{ __('common.Alterar formato de números') }}" 
        aria-haspopup="true" 
        aria-expanded="false">
        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.621.504-1.125 1.125-1.125"/></svg>
        <span class="ui-topbar__locale">{{ \App\Services\PreferencesService::getNumberFormat(request()) !== null ? json_decode(\App\Services\PreferencesService::getNumberFormat(request()), true)['example'] ?? '1,234.56' : '1,234.56' }}</span>
    </x-ui.buttons.button>
    
    <div id="numberFormatDropdownPanel" class="ui-topbar__dropdown-panel" role="dialog" aria-label="{{ __('common.Selecionar formato de números') }}" hidden>
        <div class="ui-topbar__dropdown-header">
            <h4>{{ __('preferences.Formato de Números') }}</h4>
        </div>
        <div class="ui-topbar__dropdown-list">
            @foreach(\App\Services\PreferencesService::supportedNumberFormats() as $key => $format)
                <button type="button" 
                    class="ui-topbar__dropdown-item{{ \App\Services\PreferencesService::getNumberFormat(request()) === json_encode($format) ? ' ui-topbar__dropdown-item--active' : '' }}"
                    onclick="setPreference('{{ route(\"preferences.update_number_format\") }}', {number_format: {{ json_encode(json_encode($format)) }}}, 'numberFormatDropdown')"
                    data-number-format="{{ $key }}">
                    {{ $format['example'] ?? $key }}
                </button>
            @endforeach
        </div>
    </div>
</div>
