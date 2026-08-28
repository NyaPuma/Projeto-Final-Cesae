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
        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
        <span class="ui-topbar__locale">{{ \App\Services\PreferencesService::getDateFormat(request()) }}</span>
    </x-ui.buttons.button>
    
    <div id="dateFormatDropdownPanel" class="ui-topbar__dropdown-panel" role="dialog" aria-label="{{ __('common.Selecionar formato de data') }}" hidden>
        <div class="ui-topbar__dropdown-header">
            <h4>{{ __('preferences.Formato de Data') }}</h4>
        </div>
        <div class="ui-topbar__dropdown-list">
            @foreach(\App\Services\PreferencesService::supportedDateFormats() as $format)
                <button type="button" 
                    class="ui-topbar__dropdown-item{{ \App\Services\PreferencesService::getDateFormat(request()) === $format ? ' ui-topbar__dropdown-item--active' : '' }}"
                    onclick="setPreference('{{ route("preferences.update_date_format") }}', {date_format: '{{ $format }}'}, 'dateFormatDropdown')"
                    data-date-format="{{ $format }}">
                    {{ $format }} ({{ now()->format($format) }})
                </button>
            @endforeach
        </div>
    </div>
</div>

