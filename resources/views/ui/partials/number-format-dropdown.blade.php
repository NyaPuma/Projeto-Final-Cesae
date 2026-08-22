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
        🔢
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
