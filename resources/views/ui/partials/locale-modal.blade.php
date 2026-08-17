{{--
|--------------------------------------------------------------------------
| Modal de Seleção de Idioma/Região
|--------------------------------------------------------------------------
| Pop-up grande com bandeiras, pesquisa, agrupamento por continente e
| pré-visualização de formatação (data, número, moeda).
--}}

@php
    $grouped = \App\Services\LocaleService::groupedByContinent();
    $currentLocale = app()->getLocale();
@endphp

<div id="localeModal"
     class="locale-modal"
     role="dialog"
     aria-modal="true"
     aria-labelledby="localeModalTitle"
     tabindex="-1"
     hidden>

    {{-- Overlay --}}
    <div class="locale-modal__overlay" data-locale-modal-close></div>

    {{-- Container --}}
    <div class="locale-modal__container">

        {{-- Header --}}
        <div class="locale-modal__header">
            <div class="locale-modal__header-row">
                <h2 id="localeModalTitle" class="locale-modal__title">
                    <span class="locale-modal__title-icon">🌐</span>
                    {{ __('common.Idioma e Região') }}
                </h2>
                <button type="button"
                        class="locale-modal__close-btn"
                        data-locale-modal-close
                        aria-label="{{ __('ui.Fechar') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Search --}}
            <div class="locale-modal__search">
                <svg class="locale-modal__search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                </svg>
                <input type="search"
                       id="localeSearchInput"
                       class="locale-modal__search-input"
                       placeholder="{{ __('ui.Pesquisar idioma, país ou código…') }}"
                       aria-label="{{ __('ui.Pesquisar idioma') }}"
                       autocomplete="off">
            </div>
        </div>

        {{-- Body (scrollable) --}}
        <div class="locale-modal__body" id="localeModalBody">
            @foreach ($grouped as $continent => $locales)
                @if (is_array($locales) && count($locales))
                    <div class="locale-modal__section" data-locale-section="{{ $continent }}">
                        <h3 class="locale-modal__section-title">
                            {{ ucfirst(str_replace('_', ' ', $continent)) }}
                        </h3>
                        <div class="locale-modal__grid">
                            @foreach ($locales as $item)
                                @php $code = $item['code'] ?? ''; @endphp
                                @if (!$code) @continue @endif
                                <button type="button"
                                        class="locale-modal__card{{ $code === $currentLocale ? ' locale-modal__card--active' : '' }}"
                                        data-locale="{{ $code }}"
                                        data-currency="{{ \App\Services\LocaleService::currency($code) }}"
                                        data-search="{{ strtolower(implode(' ', [$item['native'] ?? '', $item['name'] ?? '', $item['country'] ?? '', $code])) }}"
                                        aria-label="{{ $item['name'] ?? $code }}"
                                        title="{{ $item['name'] ?? $code }}">
                                    <span class="locale-modal__flag"
                                          role="img"
                                          aria-label="{{ __('common.Bandeira de :country', ['country' => $item['country'] ?? '']) }}">{{ \App\Services\LocaleService::flagEmoji($item['flag'] ?? null) }}</span>
                                    <div class="locale-modal__info">
                                        <span class="locale-modal__name">{{ $item['native'] ?? $code }}</span>
                                        <span class="locale-modal__country">{{ $item['name'] ?? '' }}</span>
                                    </div>
                                    <span class="locale-modal__currency-badge">{{ \App\Services\LocaleService::currency($code) }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Preview Bar --}}
        <div class="locale-modal__preview" id="localePreview">
            <span class="locale-modal__preview-default" id="localePreviewDefault">
                {{ __('common.Passe o rato sobre um idioma para pré-visualizar a formatação') }}
            </span>
        </div>

    </div>{{-- /.locale-modal__container --}}

    {{-- Hidden form for locale switching --}}
    <form id="localeForm" class="locale-modal__form" method="POST" action="{{ route('locale.switch') }}">
        @csrf
        <input type="hidden" name="locale" id="localeFormInput" value="">
    </form>

</div>{{-- /.locale-modal --}}
