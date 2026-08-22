{{--
|--------------------------------------------------------------------------
| Modal de Seleção de Língua
|--------------------------------------------------------------------------
| Modal para seleccionar apenas a língua, independente de moeda e formato de data
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
                    <span class="preferences-modal__title-icon">🌐</span>
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
                                        aria-label="{{ $item['native'] ?? $langCode }}"
                                        title="{{ $item['native'] ?? $langCode }}">
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
