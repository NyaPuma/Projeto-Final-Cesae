{{--
|--------------------------------------------------------------------------
| Card File Component (Otimizado)
|--------------------------------------------------------------------------
|
| Apresentação visual e interativa de ficheiros e anexos.
| • Deteção automática de ícones e esquemas de cores por extensão/tipo.
| • Botões de ação acessíveis com tooltips de leitura (aria-label).
| • Prevenção de quebra de layout para nomes de ficheiros longos.
|
--}}

@props([
    'name' => null,
    'size' => null,
    'type' => null,
    'icon' => null,
    'download' => null,
    'preview' => null,
])

@php
    // Tenta detetar o tipo de ficheiro pela extensão do nome caso o 'type' não seja passado
    $fileExtension = $type ?? ($name ? pathinfo($name, PATHINFO_EXTENSION) : 'generic');
    $fileExtension = strtolower(trim($fileExtension));

    // Mapeamento de extensões para "famílias" de ficheiros e cores temáticas
    $fileMeta = match($fileExtension) {
        'pdf' => [
            'theme' => 'pdf',
            'label' => 'PDF',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13a2 2 0 0 0-2-2H8v10h2v-3h4a2 2 0 0 0 2-2z"/><path d="M10 11h4a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1h-4z"/></svg>'
        ],
        'xls', 'xlsx', 'csv' => [
            'theme' => 'excel',
            'label' => 'Excel',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="3" y1="15" x2="21" y2="15"/><line x1="15" y1="3" x2="15" y2="21"/></svg>'
        ],
        'doc', 'docx', 'rtf' => [
            'theme' => 'word',
            'label' => 'Word',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>'
        ],
        'png', 'jpg', 'jpeg', 'gif', 'svg', 'webp' => [
            'theme' => 'image',
            'label' => strtoupper($fileExtension),
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>'
        ],
        'zip', 'rar', '7z', 'tar', 'gz' => [
            'theme' => 'archive',
            'label' => 'ZIP',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><circle cx="12" cy="18" r="2"/><line x1="12" y1="8" x2="12" y2="16"/></svg>'
        ],
        default => [
            'theme' => 'generic',
            'label' => strtoupper($fileExtension !== 'generic' ? $fileExtension : 'DOC'),
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>'
        ]
    };

    // Usa o ícone passado manualmente por prop se existir, caso contrário usa o detetado
    $resolvedIcon = $icon ?? $fileMeta['icon'];
    $resolvedTypeLabel = $type ?? $fileMeta['label'];
@endphp

<div
    {{ $attributes->class([
        'ui-card-file',
        "ui-card-file--theme-{$fileMeta['theme']}",
    ]) }}
>
    {{-- Contentor do Ícone --}}
    <div class="ui-card-file__icon-wrapper" aria-hidden="true">
        <div class="ui-card-file__icon">
            {!! $resolvedIcon !!}
        </div>
    </div>

    {{-- Área Central: Metadados do Ficheiro --}}
    <div class="ui-card-file__content">
        @if($name)
            <span class="ui-card-file__name" title="{{ $name }}">
                {{ $name }}
            </span>
        @endif

        <div class="ui-card-file__meta">
            @if($resolvedTypeLabel)
                <span class="ui-card-file__type">
                    {{ $resolvedTypeLabel }}
                </span>
            @endif

            @if($size)
                <span class="ui-card-file__divider" aria-hidden="true">•</span>
                <span class="ui-card-file__size">
                    {{ $size }}
                </span>
            @endif
        </div>
    </div>

    {{-- Botões de Ação do Ficheiro --}}
    @if($preview || $download)
        <div class="ui-card-file__actions">
            @if($preview)
                <a
                    href="{{ $preview }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="ui-card-file__action ui-card-file__action--preview"
                    aria-label="Visualizar ficheiro {{ $name }}"
                    title="Visualizar"
                >
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </a>
            @endif

            @if($download)
                <a
                    href="{{ $download }}"
                    class="ui-card-file__action ui-card-file__action--download"
                    download
                    aria-label="Descarregar ficheiro {{ $name }}"
                    title="Descarregar"
                >
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                </a>
            @endif
        </div>
    @endif
</div>
