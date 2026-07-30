{{--
|--------------------------------------------------------------------------
| Card File Component
|--------------------------------------------------------------------------
|
| Apresentação visual e interativa de ficheiros e anexos.
| • Deteção automática expandida de temas/ícones por extensão (PDF, Excel, Word, Mídia, Código, etc.).
| • Possibilidade de forçar manualmente o tema visual via prop 'theme'.
| • Suporte a slots nomeados ($actionsSlot, $iconSlot) ou slot padrão para metadados adicionais.
| • Acessibilidade ARIA otimizada e sanitização de nomes de ficheiros.
|
--}}

@props([
    'name' => null,
    'size' => null,
    'type' => null,
    'icon' => null,
    'download' => null,
    'preview' => null,
    'theme' => null,        // Permite forçar um tema específico ('pdf', 'excel', 'word', 'image', 'archive', 'code', 'media', 'powerpoint', 'generic')
])

@php
    // Extração e normalização da extensão do ficheiro
    $fileExtension = $type ?? ($name ? pathinfo($name, PATHINFO_EXTENSION) : 'generic');
    $fileExtension = strtolower(trim((string) $fileExtension));

    // Mapeamento expandido de extensões para temas visuais e ícones SVG padrão
    $detectedMeta = match($fileExtension) {
        'pdf' => [
            'theme' => 'pdf',
            'label' => 'PDF',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13a2 2 0 0 0-2-2H8v10h2v-3h4a2 2 0 0 0 2-2z"/><path d="M10 11h4a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1h-4z"/></svg>'
        ],
        'xls', 'xlsx', 'csv', 'ods' => [
            'theme' => 'excel',
            'label' => 'Excel',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="3" y1="15" x2="21" y2="15"/><line x1="15" y1="3" x2="15" y2="21"/></svg>'
        ],
        'doc', 'docx', 'rtf', 'odt' => [
            'theme' => 'word',
            'label' => 'Word',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>'
        ],
        'ppt', 'pptx', 'key' => [
            'theme' => 'powerpoint',
            'label' => 'Apresentação',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M12 18v-6"/><path d="M9 15h6"/></svg>'
        ],
        'png', 'jpg', 'jpeg', 'gif', 'svg', 'webp', 'bmp', 'ico' => [
            'theme' => 'image',
            'label' => strtoupper($fileExtension),
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>'
        ],
        'mp3', 'wav', 'ogg', 'flac', 'aac' => [
            'theme' => 'media',
            'label' => 'Áudio',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>'
        ],
        'mp4', 'mkv', 'avi', 'mov', 'webm' => [
            'theme' => 'media',
            'label' => 'Vídeo',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>'
        ],
        'zip', 'rar', '7z', 'tar', 'gz' => [
            'theme' => 'archive',
            'label' => 'ZIP',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><circle cx="12" cy="18" r="2"/><line x1="12" y1="8" x2="12" y2="16"/></svg>'
        ],
        'js', 'ts', 'php', 'html', 'css', 'json', 'sql', 'xml', 'py' => [
            'theme' => 'code',
            'label' => strtoupper($fileExtension),
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>'
        ],
        default => [
            'theme' => 'generic',
            'label' => strtoupper($fileExtension !== 'generic' ? $fileExtension : 'DOC'),
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>'
        ]
    };

    // Resolução de tema, ícone e conteúdos de slots
    $resolvedTheme = $theme ?? $detectedMeta['theme'];
    $iconContent = $icon ?? $iconSlot ?? $detectedMeta['icon'];
    $resolvedTypeLabel = $type ?? $detectedMeta['label'];

    $actionsContent = $actionsSlot ?? null;
    $hasCustomContent = $slot->isNotEmpty();

    $safeFileName = $name ?? 'Ficheiro sem nome';
@endphp

<div
    {{ $attributes->class([
        'ui-card-file',
        "ui-card-file--theme-{$resolvedTheme}",
    ]) }}
>
    {{-- Contentor do Ícone --}}
    @if($iconContent)
        <div class="ui-card-file__icon-wrapper" aria-hidden="true">
            <div class="ui-card-file__icon">
                @if(is_string($iconContent) && str_starts_with(trim($iconContent), '<svg'))
                    {!! $iconContent !!}
                @else
                    {{ $iconContent }}
                @endif
            </div>
        </div>
    @endif

    {{-- Área Central: Metadados do Ficheiro --}}
    <div class="ui-card-file__content">
        @if($name)
            <span class="ui-card-file__name" title="{{ $safeFileName }}">
                {{ $safeFileName }}
            </span>
        @endif

        <div class="ui-card-file__meta">
            @if($resolvedTypeLabel)
                <span class="ui-card-file__type">
                    {{ $resolvedTypeLabel }}
                </span>
            @endif

            @if($size)
                @if($resolvedTypeLabel)
                    <span class="ui-card-file__divider" aria-hidden="true">•</span>
                @endif
                <span class="ui-card-file__size">
                    {{ $size }}
                </span>
            @endif

            {{-- Slot livre para etiquetas adicionais de metadados --}}
            @if($hasCustomContent)
                <span class="ui-card-file__extra">
                    {{ $slot }}
                </span>
            @endif
        </div>
    </div>

    {{-- Botões de Ação do Ficheiro --}}
    @if($actionsContent || $preview || $download)
        <div class="ui-card-file__actions">
            @if($actionsContent)
                {{ $actionsContent }}
            @else
                @if($preview)
                    <a
                        href="{{ $preview }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="ui-card-file__action ui-card-file__action--preview"
                        aria-label="Visualizar ficheiro {{ $safeFileName }}"
                        title="Visualizar"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
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
                        aria-label="Descarregar ficheiro {{ $safeFileName }}"
                        title="Descarregar"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                    </a>
                @endif
            @endif
        </div>
    @endif
</div>
