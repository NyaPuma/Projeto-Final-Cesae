{{--
|--------------------------------------------------------------------------
| Language Selection Modal
|--------------------------------------------------------------------------
| Modal to select only the language, independent of currency and date format
--}}

@php
    $grouped = \App\Services\LocaleService::groupedByContinent();
    $currentLanguage = \App\Services\PreferencesService::getLanguage(request());
    $preferences = \App\Services\PreferencesService::current(request());
    $currentLangBase = explode('-', $currentLanguage)[0];
@endphp

<div id="languageModal"
     class="preferences-modal"
     role="dialog"
     aria-modal="true"
     aria-labelledby="languageModalTitle"
     tabindex="-1"
     hidden>

    {{-- Overlay --}}
    <div class="preferences-modal__overlay" data-language-modal-close></div>

    {{-- Container --}}
    <div class="preferences-modal__container">

        {{-- Header --}}
        <div class="preferences-modal__header">
            <div class="preferences-modal__header-row">
                <h2 id="languageModalTitle" class="preferences-modal__title">
                    <span class="preferences-modal__title-icon"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg></span>
                    {{ __('preferences.Selecionar Língua') }}
                </h2>
                <button type="button"
                        class="preferences-modal__close-btn"
                        data-language-modal-close
                        aria-label="{{ __('ui.Fechar') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Current selection info --}}
            <div class="preferences-modal__info">
                <p>{{ __('preferences.Língua atual') }}: <strong>{{ $currentLanguage }}</strong></p>
                <p>{{ __('preferences.Moeda atual') }}: <strong>{{ $preferences['currency'] }}</strong> | {{ __('ui.Formato de data') }}: <strong>{{ $preferences['date_format'] }}</strong></p>
            </div>
        </div>

        {{-- Body (scrollable) --}}
        <div class="preferences-modal__body" id="languageModalBody">
            @foreach ($grouped as $continent => $locales)
                @if (is_array($locales) && count($locales))
                    <div class="preferences-modal__section" data-language-section="{{ $continent }}">
                        <h3 class="preferences-modal__section-title">
                            {{ ucfirst(str_replace('_', ' ', $continent)) }}
                        </h3>
                        <div class="preferences-modal__grid">
                            @foreach ($locales as $item)
                                @php $code = $item['code'] ?? ''; @endphp
                                @if (!$code) @continue @endif
                                @php $langCode = explode('-', $code)[0]; @endphp
                                <button type="button"
                                        class="preferences-modal__card language-card{{ $langCode === $currentLangBase ? ' preferences-modal__card--active' : '' }}"
                                        data-language="{{ $langCode }}"
                                        data-search="{{ strtolower($item['native'] ?? $langCode) }}"
                                        aria-label="{{ $item['native'] ?? $langCode }}">
                                    <span class="preferences-modal__flag"
                                          role="img"
                                          aria-label="{{ $item['native'] ?? $langCode }}">{{ \App\Services\LocaleService::flagEmoji($item['flag'] ?? null) }}</span>
                                    <div class="preferences-modal__info">
                                        <span class="preferences-modal__name">{{ $item['native'] ?? $langCode }}</span>
                                        <span class="preferences-modal__code">{{ $langCode }}</span>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Preview --}}
        <div class="preferences-modal__preview" id="languagePreview">
            <span class="preferences-modal__preview-default" id="languagePreviewDefault">
                {{ __('preferences.Seleccione uma língua para pré-visualizar') }}
            </span>
        </div>

    </div>{{-- /.preferences-modal__container --}}

    {{-- Hidden form for language switching --}}
    <form id="languageForm" class="preferences-modal__form" method="POST" action="{{ route('preferences.language') }}">
        @csrf
        <input type="hidden" name="language" id="languageFormInput" value="">
    </form>

</div>{{-- /.language-modal --}}
