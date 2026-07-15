{{--
|--------------------------------------------------------------------------
| Card Alert Component (Otimizado)
|--------------------------------------------------------------------------
|
| Mensagens de feedback e estado visual contextualizadas.
| • Injeta automaticamente ícones geométricos perfeitos com base na variante.
| • Integração com Alpine.js para permitir fecho dinâmico com transição.
| • Acessibilidade garantida para leitores de ecrã (A11y).
|
--}}

@props([
    'variant' => 'info', // 'info', 'success', 'warning', 'danger'/'error'
    'title' => null,
    'icon' => null,
    'dismissible' => false,
])

@php
    // Normaliza variações comuns de nomenclatura (ex: 'error' vira 'danger' para consistência CSS)
    $normalizedVariant = match($variant) {
        'error' => 'danger',
        default => $variant,
    };

    // Biblioteca interna de SVGs oficiais para feedback rápido
    $defaultIcons = [
        'info' => '<svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>',
        'success' => '<svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>',
        'warning' => '<svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>',
        'danger' => '<svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>',
    ];

    $selectedIcon = $icon ?? ($defaultIcons[$normalizedVariant] ?? null);
@endphp

<div
    {{ $attributes->class([
        'ui-card-alert',
        "ui-card-alert--{$normalizedVariant}",
        'ui-card-alert--dismissible' => $dismissible,
    ]) }}
    role="alert"
    @if($dismissible)
        x-data="{ show: true }"
        x-show="show"
        x-transition:leave="ui-card-alert-transition-leave"
        x-transition:leave-start="ui-card-alert-transition-start"
        x-transition:leave-end="ui-card-alert-transition-end"
    @endif
>
    {{-- Renderização do ícone de estado --}}
    @if($selectedIcon)
        <div class="ui-card-alert__icon" aria-hidden="true">
            {!! $selectedIcon !!}
        </div>
    @endif

    {{-- Área de texto --}}
    <div class="ui-card-alert__content">
        @if($title)
            <strong class="ui-card-alert__title">
                {{ $title }}
            </strong>
        @endif

        <div class="ui-card-alert__message">
            {{ $slot }}
        </div>
    </div>

    {{-- Botão de Fecho Acessível e Reativo --}}
    @if($dismissible)
        <button
            type="button"
            class="ui-card-alert__close"
            aria-label="Fechar alerta"
            @click="show = false"
        >
            <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    @endif
</div>
