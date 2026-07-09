<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $documentationTitle }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ l5_swagger_asset($documentation, 'swagger-ui.css') }}">
    <link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-32x32.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-16x16.png') }}" sizes="16x16"/>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif

    <style>
        /* ==========================================================\
           SWAGGER UI - ENTERPRISE DESIGN SYSTEM OVERRIDES
        ========================================================== */

        body, .swagger-ui {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif !important;
        }

        /* Ocultar a topbar legada do Swagger */
        .swagger-ui .topbar { display: none; }

        /* Ajustes de Tipografia e Cabeçalhos */
        .swagger-ui .info { margin: 30px 0 !important; }
        .swagger-ui .info .title { font-size: 32px; font-weight: 700; tracking: -0.02em; color: var(--text) !important; }
        .swagger-ui .info p, .swagger-ui .info li, .swagger-ui p, .swagger-ui table, .swagger-ui label { color: var(--text-soft) !important; }
        .swagger-ui h1, .swagger-ui h2, .swagger-ui h3, .swagger-ui h4, .swagger-ui h5 { color: var(--text) !important; font-weight: 600 !important; }

        /* Contentores e Blocos Globais */
        .swagger-ui .scheme-container {
            background: var(--surface) !important;
            border: 1px solid var(--border) !important;
            border-radius: 16px !important;
            box-shadow: var(--shadow-sm) !important;
            padding: 20px !important;
            margin-bottom: 24px !important;
        }

        .swagger-ui .opblock-tag {
            color: var(--text) !important;
            border-bottom: 1px solid var(--border) !important;
            font-size: 18px !important;
            font-weight: 600 !important;
        }
        .swagger-ui .opblock-tag small { color: var(--text-soft) !important; }

        /* Modificadores de Botões e Autenticação */
        .swagger-ui .btn.authorize {
            background-color: var(--text) !important;
            border-color: var(--text) !important;
            color: var(--surface) !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            transition: all 0.15s ease;
        }
        .swagger-ui .btn.authorize svg { fill: var(--surface) !important; }
        .swagger-ui .btn { border-radius: 12px !important; font-size: 13px; font-weight: 600; color: var(--text); border-color: var(--border); background: var(--surface-2); }

        /* Inputs, Selects e Textareas */
        .swagger-ui input[type=email],
        .swagger-ui input[type=file],
        .swagger-ui input[type=password],
        .swagger-ui input[type=search],
        .swagger-ui input[type=text],
        .swagger-ui textarea,
        .swagger-ui select,
        .swagger-ui .operation-filter-input,
        .swagger-ui .dialog-ux .modal-ux {
            background: var(--surface-2) !important;
            border: 1px solid var(--border) !important;
            color: var(--text) !important;
            border-radius: 12px !important;
            outline: none !important;
            padding: 8px 12px !important;
        }

        /* Estrutura de Tabelas e Parâmetros */
        .swagger-ui table thead tr th,
        .swagger-ui table thead tr td {
            color: var(--text) !important;
            border-bottom: 1px solid var(--border) !important;
        }
        .swagger-ui .response-col_status { color: var(--text) !important; font-weight: 600 !important; }
        .swagger-ui .model { color: var(--text) !important; }
        .swagger-ui .model-title { color: var(--text) !important; font-weight: 600 !important; }
        .swagger-ui .opblock .opblock-section-header { background: var(--surface-2) !important; border-bottom: 1px solid var(--border) !important; }
        .swagger-ui .opblock-summary-path, .swagger-ui .opblock-summary-description { color: var(--text) !important; font-weight: 500 !important; }
        svg:not(:root) { fill: var(--text-soft); }

        /* Blocos de Operações REST (Bento-Style Minimalista) */
        .swagger-ui .opblock {
            border-radius: 16px !important;
            box-shadow: none !important;
            border-width: 1px !important;
            margin: 0 0 12px 0 !important;
            overflow: hidden;
        }
        .swagger-ui .opblock .opblock-summary { padding: 10px 20px !important; }
        .swagger-ui .opblock .opblock-summary-method {
            font-size: 11px !important;
            font-weight: 700 !important;
            border-radius: 8px !important;
            padding: 6px 12px !important;
            min-width: 80px !important;
            text-align: center;
            text-transform: uppercase;
            tracking: 0.05em;
        }

        /* Variantes de Métodos baseadas nos Tokens de Cor da Aplicação */
        .swagger-ui .opblock.opblock-post { background: rgba(34, 197, 94, 0.04) !important; border-color: rgba(34, 197, 94, 0.15) !important; }
        .swagger-ui .opblock.opblock-post .opblock-summary-method { background: rgba(34, 197, 94, 0.12) !important; color: #22c55e !important; }

        .swagger-ui .opblock.opblock-get { background: rgba(59, 130, 246, 0.04) !important; border-color: rgba(59, 130, 246, 0.15) !important; }
        .swagger-ui .opblock.opblock-get .opblock-summary-method { background: rgba(59, 130, 246, 0.12) !important; color: #3b82f6 !important; }

        .swagger-ui .opblock.opblock-put { background: rgba(245, 158, 11, 0.04) !important; border-color: rgba(245, 158, 11, 0.15) !important; }
        .swagger-ui .opblock.opblock-put .opblock-summary-method { background: rgba(245, 158, 11, 0.12) !important; color: #f59e0b !important; }

        .swagger-ui .opblock.opblock-delete { background: rgba(239, 68, 68, 0.04) !important; border-color: rgba(239, 68, 68, 0.15) !important; }
        .swagger-ui .opblock.opblock-delete .opblock-summary-method { background: rgba(239, 68, 68, 0.12) !important; color: #ef4444 !important; }

        /* Ajuste de inversão adaptativa para o botão de Authorize no escuro */
        .dark .swagger-ui .btn.authorize { background-color: var(--surface-2) !important; border-color: var(--border) !important; color: var(--text) !important; }
        .dark .swagger-ui .btn.authorize svg { fill: var(--text) !important; }
    </style>
</head>

<body class="bg-[var(--bg)] text-[var(--text)] min-h-screen flex flex-col antialiased">

    {{-- Header de Alta Fidelidade Alinhado com o Painel Principal --}}
    <header class="w-full border-b border-[var(--border)] bg-[var(--surface)] px-6 py-4 sticky top-0 z-50 backdrop-blur-md bg-opacity-90">
        <div class="mx-auto max-w-5xl w-full flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#f53003] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[#f53003]"></span>
                </span>
                <span class="text-xs uppercase tracking-widest font-bold text-[var(--text-soft)]">
                    Documentação da API
                </span>
            </div>
            <div>
                <a href="/ui" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all">
                    <svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                    </svg>
                    Voltar ao painel
                </a>
            </div>
        </div>
    </header>

    {{-- Enquadramento da Documentação --}}
    <main class="mx-auto w-full max-w-5xl px-4 py-6 flex-grow animate-[fadeIn_0.2s_ease-out]">
        <div id="swagger-ui"></div>
    </main>

    <script src="{{ l5_swagger_asset($documentation, 'swagger-ui-bundle.js') }}"></script>
    <script src="{{ l5_swagger_asset($documentation, 'swagger-ui-standalone-preset.js') }}"></script>
    <script>
        window.onload = function() {
            const urls = [];

            @foreach($urlsToDocs as $title => $url)
                urls.push({name: "{{ $title }}", url: "{{ $url }}"});
            @endforeach

            // Inicialização do Ecossistema Swagger UI
            const ui = SwaggerUIBundle({
                dom_id: '#swagger-ui',
                urls: urls,
                "urls.primaryName": "{{ $documentationTitle }}",
                operationsSorter: {!! isset($operationsSorter) ? '"' . $operationsSorter . '"' : 'null' !!},
                configUrl: {!! isset($configUrl) ? '"' . $configUrl . '"' : 'null' !!},
                validatorUrl: {!! isset($validatorUrl) ? '"' . $validatorUrl . '"' : 'null' !!},
                oauth2RedirectUrl: "{{ route('l5-swagger.'.$documentation.'.oauth2_callback', [], $useAbsolutePath) }}",

                requestInterceptor: function(request) {
                    request.headers['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
                    return request;
                },

                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],

                plugins: [
                    SwaggerUIBundle.plugins.DownloadUrl
                ],

                layout: "StandaloneLayout",
                docExpansion : "{!! config('l5-swagger.defaults.ui.display.doc_expansion', 'none') !!}",
                deepLinking: true,
                filter: {!! config('l5-swagger.defaults.ui.display.filter') ? 'true' : 'false' !!},
                persistAuthorization: "{!! config('l5-swagger.defaults.ui.authorization.persist_authorization') ? 'true' : 'false' !!}",
            })

            window.ui = ui

            @if(in_array('oauth2', array_column(config('l5-swagger.defaults.securityDefinitions.securitySchemes'), 'type')))
            ui.initOAuth({
                usePkceWithAuthorizationCodeGrant: "{!! (bool)config('l5-swagger.defaults.ui.authorization.oauth2.use_pkce_with_authorization_code_grant') !!}"
            })
            @endif
        }
    </script>
</body>
</html>
