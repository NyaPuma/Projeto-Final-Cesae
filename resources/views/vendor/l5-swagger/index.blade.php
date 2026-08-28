@php
    // ui.layout expects $user to conditionally render the sidebar menu (e.g., only admin sees the Swagger item).
    // The docs route is public, so the user can be null outside of a session.
    $user = auth()->user() ?? (object) ['profile' => null];

    $swaggerTranslations = [
        'Authorize' => __('common.Autorizar'),
        'Explore' => __('common.Explorar'),
        'Filter by tag' => __('ui.Filtrar por etiqueta'),
        'Show/Hide' => __('common.Mostrar/Ocultar'),
        'List Operations' => __('common.Listar operações'),
        'Expand Operations' => __('common.Expandir operações'),
        'Collapse Operations' => __('common.Recolher operações'),
        'Try it out' => __('common.Experimentar'),
        'Execute' => __('common.Executar'),
        'Clear' => __('common.Limpar'),
        'Cancel' => __('ui.Cancelar'),
        'Servers' => __('common.Servidores'),
        'Server' => __('common.Servidor'),
        'Responses' => __('common.Respostas'),
        'Response' => __('common.Resposta'),
        'Request body' => __('common.Corpo do pedido'),
        'Request URL' => __('common.URL do pedido'),
        'Response headers' => __('common.Cabeçalhos da resposta'),
        'Response body' => __('common.Corpo da resposta'),
        'Curl' => __('common.cURL'),
        'Copy' => __('common.Copiar'),
        'Download' => __('ui.Descarregar'),
        'Loading...' => __('ui.A carregar...'),
        'No operations defined in spec!' => __('common.Não existem operações definidas na especificação.'),
        'Schemas' => __('common.Schemas'),
        'Models' => __('common.Modelos'),
        'Parameters' => __('common.Parâmetros'),
        'Parameter' => __('common.Parâmetro'),
        'Example Value' => __('common.Valor de exemplo'),
        'Copy to clipboard' => __('common.Copiar para a área de transferência'),
    ];
@endphp

@extends('ui.layout')

@section('title', $documentationTitle)

@section('page_key', 'docs')

@push('styles')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    {{-- 1) CSS base oficial do Swagger UI --}}
    <link rel="stylesheet" type="text/css" href="{{ l5_swagger_asset($documentation, 'swagger-ui.css') }}">

    <link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-16x16.png') }}" sizes="16x16" />

    {{-- Bundle de estilos customizados do Swagger - carregado no FINAL para sobrepor estilos nativos --}}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/swagger/swagger-theme.css'])
    @endif
@endpush

@section('content')
    {{-- Toolbar de Controlo --}}
    <div id="swagger-toolbar" class="flex flex-col sm:flex-row items-center justify-between gap-4 p-4 rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
        <div class="relative w-full sm:w-96">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-[var(--text-soft)] pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="7" />
                <path d="M20 20L17 17" />
            </svg>
        <input id="swaggerSearch" type="text" placeholder="{{ __('ui.Pesquisar endpoint...') }}" class="w-full pl-10 pr-4 py-2 text-xs rounded-xl border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text)] outline-none focus:border-primary transition-all" aria-label="{{ __('ui.Pesquisar endpoint...') }}">
        </div>

        <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
            <button id="expandAll" type="button" class="px-3 py-2 text-xs font-semibold rounded-xl border border-[var(--border)] bg-[var(--surface-2)] hover:bg-[var(--border)] text-[var(--text)] transition cursor-pointer">
                {{ __('common.Expandir tudo') }}
            </button>
            <button id="collapseAll" type="button" class="px-3 py-2 text-xs font-semibold rounded-xl border border-[var(--border)] bg-[var(--surface-2)] hover:bg-[var(--border)] text-[var(--text)] transition cursor-pointer">
                {{ __('common.Recolher tudo') }}
            </button>
        </div>
    </div>

    {{-- Contentor Principal do Swagger UI --}}
    <div
        id="swagger-ui"
        class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm"
        data-url="{{ $urlsToDocs[$documentationTitle] ?? (is_array($urlsToDocs) ? reset($urlsToDocs) : '') }}"
        data-csrf="{{ csrf_token() }}"
        data-urls="{{ json_encode(collect($urlsToDocs)->map(fn($url, $title) => ['url' => $url, 'name' => $title])->values()) }}"
        data-primary-name="{{ $documentationTitle }}"
        data-operations-sorter="{{ isset($operationsSorter) ? $operationsSorter : '' }}"
        data-config-url="{{ isset($configUrl) ? $configUrl : '' }}"
        data-validator-url="{{ isset($validatorUrl) ? $validatorUrl : '' }}"
        data-oauth2-redirect-url="{{ route('l5-swagger.' . $documentation . '.oauth2_callback', [], $useAbsolutePath) }}"
        data-doc-expansion="{{ config('l5-swagger.defaults.ui.display.doc_expansion', 'none') }}"
        data-filter="{{ config('l5-swagger.defaults.ui.display.filter') ? 'true' : 'false' }}"
        data-persist-authorization="{{ config('l5-swagger.defaults.ui.authorization.persist_authorization') ? 'true' : 'false' }}"
        data-has-oauth2-init="{{ in_array('oauth2', array_column(config('l5-swagger.defaults.securityDefinitions.securitySchemes'), 'type')) ? 'true' : 'false' }}"
        data-use-pkce="{{ (bool) config('l5-swagger.defaults.ui.authorization.oauth2.use_pkce_with_authorization_code_grant') ? 'true' : 'false' }}"
    ></div>

    <button id="scrollTop" class="fixed bottom-6 right-6 h-10 w-10 rounded-xl bg-primary text-(--on-primary) font-bold shadow-lg flex items-center justify-center hover:bg-primary-hover transition cursor-pointer" aria-label="{{ __('common.Voltar ao topo') }}">
        ↑
    </button>
@endsection

@push('scripts')
    <script>
        window.SGM_SWAGGER_I18N = @json($swaggerTranslations);
    </script>
    <script src="{{ l5_swagger_asset($documentation, 'swagger-ui-bundle.js') }}"></script>
    <script src="{{ l5_swagger_asset($documentation, 'swagger-ui-standalone-preset.js') }}"></script>

    {{-- Inicialização nativa do L5-Swagger --}}
    <script>
        window.onload = function() {
            const url = "{!! $urlsToDocs[$documentationTitle] ?? (is_array($urlsToDocs) ? reset($urlsToDocs) : '') !!}";
            const urls = @json(collect($urlsToDocs)->map(fn($url, $title) => ['url' => $url, 'name' => $title])->values());
            const primaryName = "{!! $documentationTitle !!}";

            const ui = SwaggerUIBundle({
                url: url,
                urls: urls.length > 0 ? urls : undefined,
                "urls.primaryName": primaryName,
                dom_id: '#swagger-ui',
                deepLinking: true,
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],
                plugins: [
                    SwaggerUIBundle.plugins.DownloadUrl
                ],
                layout: "StandaloneLayout",
                docExpansion: "{!! config('l5-swagger.defaults.ui.display.doc_expansion', 'none') !!}",
                filter: {!! config('l5-swagger.defaults.ui.display.filter') ? 'true' : 'false' !!},
                persistAuthorization: {!! config('l5-swagger.defaults.ui.authorization.persist_authorization') ? 'true' : 'false' !!},
                requestInterceptor: function(request) {
                    request.headers['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
                    return request;
                }
            });

            window.ui = ui;

            setTimeout(() => {
                document.querySelectorAll('.operation-filter-input').forEach(el => {
                    if (!el.getAttribute('aria-label')) {
                        el.setAttribute('aria-label', el.placeholder || 'Filtrar por etiqueta');
                    }
                });
                document.querySelectorAll('noscript').forEach(el => el.setAttribute('aria-hidden', 'true'));
                document.querySelectorAll('.responses-inner table').forEach(t => t.setAttribute('role', 'presentation'));
            }, 2500);
        };
    </script>
@endpush
