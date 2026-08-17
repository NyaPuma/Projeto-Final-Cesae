<div class="ui-topbar__dropdown" id="dateFormatDropdown">
    <x-ui.buttons.button type="button" 
        onclick="openPreferenceDropdown('dateFormatDropdown', 'dateFormatDropdownPanel')"
        variant="secondary" 
        size="sm" 
        weight="semibold" 
        class="ui-topbar__button" 
        aria-label="{{ __('common.Alterar formato de data') }}" 
        aria-haspopup="true" 
        aria-expanded="false">
        📅
        <span class="ui-topbar__locale">{{ \App\Services\PreferenciasService::getDateFormat(request()) }}</span>
    </x-ui.buttons.button>
    
    <div id="dateFormatDropdownPanel" class="ui-topbar__dropdown-panel" role="dialog" aria-label="{{ __('common.Selecionar formato de data') }}" hidden>
        <div class="ui-topbar__dropdown-header">
            <h4>{{ __('preferences.Formato de Data') }}</h4>
        </div>
        <div class="ui-topbar__dropdown-list">
            @foreach(\App\Services\PreferenciasService::supportedDateFormats() as $format)
                <button type="button" 
                    class="ui-topbar__dropdown-item{{ \App\Services\PreferenciasService::getDateFormat(request()) === $format ? ' ui-topbar__dropdown-item--active' : '' }}"
                    onclick="setPreference('{{ route("preferences.update_date_format") }}', {date_format: '{{ $format }}'}, 'dateFormatDropdown')"
                    data-date-format="{{ $format }}">
                    {{ $format }} ({{ now()->format($format) }})
                </button>
            @endforeach
        </div>
    </div>
</div>

