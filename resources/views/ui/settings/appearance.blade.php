@extends('ui.layout')

@section('page_key', 'definicoes-aparencia')

@section('content')
<x-ui.partials.page-header
    :title="__('dashboard.Aparência do Painel')"
    :subtitle="__('messages.Escolha um tema pré-definido — a sua preferência é guardada por utilizador e aplicada nos próximos acessos.')"
    badge="{{ __('common.Aparência') }}"
/>

<form id="themeAppearanceForm" action="{{ route('ui.settings.appearance.update') }}" method="POST" class="space-y-6" novalidate>
    @csrf
    <input type="hidden" name="theme" value="{{ $activeTheme['id'] }}">

    <section class="theme-settings__panel" aria-labelledby="presets-title">
        <div class="theme-settings__presets-heading">
            <h2 id="presets-title">{{ __('ui.Temas pré-definidos') }}</h2>
            <p>{{ __('dashboard.Cada família tem um par claro/escuro com o mesmo matiz — o botão do painel alterna entre os dois.') }}</p>
        </div>

        <div class="theme-settings__presets">
            @foreach (['light' => __('common.Modo Claro'), 'dark' => __('common.Modo Escuro')] as $mode => $modeLabel)
                <div class="theme-settings__presets-group" data-mode="{{ $mode }}">
                    <h3 class="theme-settings__presets-group-title">{{ $modeLabel }}</h3>
                    <div class="theme-settings__presets-grid">
                        @foreach ($presets as $id => $preset)
                            @if (($preset['mode'] ?? 'light') !== $mode)
                                @continue
                            @endif
                            <button
                                type="button"
                                class="theme-preset-card{{ $activeTheme['id'] === $id ? ' is-active' : '' }}"
                                data-preset="{{ $id }}"
                                aria-pressed="{{ $activeTheme['id'] === $id ? 'true' : 'false' }}"
                                aria-label="{{ $preset['label'] }}"
                            >
                                <span class="theme-preset-card__swatches">
                                    <span style="--swatch: {{ $preset['primary'] }}"></span>
                                    <span style="--swatch: {{ $preset['surface'] }}"></span>
                                    <span style="--swatch: {{ $preset['text'] }}"></span>
                                    <span style="--swatch: {{ $preset['text_soft'] }}"></span>
                                </span>
                                <span class="theme-preset-card__name">{{ $preset['label'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="theme-settings__actions theme-settings__actions--divider">
            <div>
                @if (session('status'))
                    <p class="text-sm font-semibold text-[var(--color-success)]">{{ session('status') }}</p>
                @endif
                <p id="themeMessage" aria-live="polite" class="theme-settings__notice">{{ __('common.As escolhas são guardadas automaticamente — o tema é aplicado em toda a aplicação.') }}</p>
            </div>
            <p id="themeSaveStatus" class="theme-settings__save-status" aria-live="polite" role="status"></p>
        </div>
    </section>
</form>

<section class="theme-settings__preview" aria-label="{{ __('ui.Pré-visualização de temas') }}">
    <div class="theme-settings__preview-heading">
        <h2>{{ __('common.Pré-visualização em tempo real') }}</h2>
        <p>{{ __('dashboard.Veja como as cores do tema aparecem em componentes reais do painel.') }}</p>
    </div>

    <div class="theme-settings__preview-list">
        <section class="theme-settings__preview-card">
            <div class="theme-settings__preview-card-header">
                <div>
                    <p class="theme-settings__preview-label">{{ __('common.Componente') }}</p>
                    <span class="theme-settings__preview-title">{{ __('common.Botões e ações') }}</span>
                </div>
                <span class="theme-badge theme-badge--active">{{ __('common.Primária') }}</span>
            </div>
            <div class="theme-settings__preview-actions">
                <button class="ui-button ui-button--primary" type="button">{{ __('ui.Guardar') }}</button>
                <button class="ui-button ui-button--outline" type="button">{{ __('ui.Cancelar') }}</button>
                <button class="ui-button ui-button--danger" type="button">{{ __('ui.Eliminar') }}</button>
            </div>
        </section>

        <section class="theme-settings__preview-card theme-settings__preview-card--status">
            <div class="theme-settings__preview-card-header">
                <div>
                    <p class="theme-settings__preview-label">{{ __('common.Estados') }}</p>
                    <span class="theme-settings__preview-title">{{ __('tickets.Estado de ticket') }}</span>
                </div>
                <span class="theme-badge theme-badge--urgent">{{ __('common.Prioridade') }}</span>
            </div>
            <div class="theme-settings__status-badges">
                <span class="badge badge--open">{{ __('tickets.Aberto') }}</span>
                <span class="badge badge--in-progress">{{ __('tickets.Em Progresso') }}</span>
                <span class="badge badge--resolved">{{ __('tickets.Resolvido') }}</span>
                <span class="badge badge--urgent">{{ __('tickets.Urgente') }}</span>
            </div>
        </section>

        <section class="theme-settings__preview-card theme-settings__preview-card--status">
            <div class="theme-settings__preview-card-header">
                <div>
                    <p class="theme-settings__preview-label">{{ __('common.Tipografia') }}</p>
                    <span class="theme-settings__preview-title">{{ __('common.Hierarquia de texto') }}</span>
                </div>
                <span class="theme-badge theme-badge--active">{{ __('common.Legível') }}</span>
            </div>
            <div class="theme-settings__preview-typography">
                <span class="theme-settings__typography-title">{{ __('common.Título da secção') }}</span>
                <p class="theme-settings__typography-body">{{ __('dashboard.Este é o texto principal do painel, desenhado para leitura confortável no dia a dia.') }}</p>
                <p class="theme-settings__typography-muted">{{ __('common.Texto secundário ou notas auxiliares com contraste acessível.') }}</p>
            </div>
        </section>

        <section class="theme-settings__preview-card theme-settings__preview-card--status">
            <div class="theme-settings__preview-card-header">
                <div>
                    <p class="theme-settings__preview-label">{{ __('common.Superfícies') }}</p>
                    <span class="theme-settings__preview-title">{{ __('common.Cartão e bordas') }}</span>
                </div>
                <span class="theme-badge theme-badge--active">{{ __('common.Contraste') }}</span>
            </div>
            <div class="theme-settings__preview-surface">
                <span class="theme-settings__preview-surface-accent" aria-hidden="true"></span>
                <p class="theme-settings__status-title">{{ __('common.Cartão com superfície alternativa') }}</p>
                <p class="theme-settings__status-copy">{{ __('common.As superfícies e as bordas estruturam a hierarquia visual sem depender de cor.') }}</p>
            </div>
        </section>
    </div>
</section>
@endsection
