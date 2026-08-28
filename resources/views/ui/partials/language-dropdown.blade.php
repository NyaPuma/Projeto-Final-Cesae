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
        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
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

