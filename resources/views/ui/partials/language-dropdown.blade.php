<div class="ui-topbar__dropdown" id="languageDropdown">
    <x-ui.buttons.button type="button" 
        onclick="openPreferenceDropdown('languageDropdown', 'languageDropdownPanel')"
        variant="secondary" 
        size="sm" 
        weight="semibold" 
        class="ui-topbar__button" 
        aria-label="{{ __('common.Alterar idioma') }}" 
        aria-haspopup="true" 
        aria-expanded="false">
        🌐
        <span class="ui-topbar__locale">{{ strtoupper(substr(app()->getLocale(), 0, 2)) }}</span>
    </x-ui.buttons.button>
    
    <div id="languageDropdownPanel" class="ui-topbar__dropdown-panel" role="dialog" aria-label="{{ __('common.Selecionar idioma') }}" hidden>
        <div class="ui-topbar__dropdown-header">
            <h4>{{ __('common.Idioma') }}</h4>
        </div>
        <div class="ui-topbar__dropdown-list">
            @foreach(\App\Services\LocaleService::all() as $code => $meta)
                <button type="button" 
                    class="ui-topbar__dropdown-item{{ app()->getLocale() === $code ? ' ui-topbar__dropdown-item--active' : '' }}"
                    onclick="setPreference('{{ route("preferences.update_language") }}', {language: '{{ $code }}'}, 'languageDropdown')"
                    data-locale="{{ $code }}">
                    <span class="locale-modal__flag" role="img">{{ \App\Services\LocaleService::flagEmoji($meta['flag'] ?? null) }}</span>
                    <span>{{ $meta['name'] ?? $code }}</span>
                </button>
            @endforeach
        </div>
    </div>
</div>

