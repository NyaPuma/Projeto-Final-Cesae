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
           SISTEMA DE CORES INTEGRADO COM O PAINEL DE CONTROLO
        ========================================================== */
        :root {
            --bg: #ffffff;
            --text: #0f172a;
            --text-soft: #475569;
            --border: #e2e8f0;
            --surface: #ffffff;
            --surface-2: #f8fafc;
            --topbar: rgba(255, 255, 255, 0.8);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --primary: #f97316; /* Laranja do seu painel */
            --primary-hover: #ea580c;
        }

        /* Classe dark aplicada no elemento html */
        .dark {
            --bg: #090d16;
            --text: #f8fafc;
            --text-soft: #94a3b8;
            --border: #1e293b;
            --surface: #0f172a;
            --surface-2: #1e293b;
            --topbar: rgba(15, 23, 42, 0.8);
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.5);
        }

        @media (prefers-color-scheme: dark) {
            :root:not(.light) {
                --bg: #090d16;
                --text: #f8fafc;
                --text-soft: #94a3b8;
                --border: #1e293b;
                --surface: #0f172a;
                --surface-2: #1e293b;
                --topbar: rgba(15, 23, 42, 0.8);
                --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.5);
            }
        }

        /* ==========================================================\
           COLAPSO TOTAL DE ALTURAS (ELIMINA O ABISMO VERTICAL)
        ========================================================== */
        #swagger-ui,
        .swagger-ui,
        .swagger-ui > div,
        .swagger-ui > div > div {
            display: block !important;
            height: auto !important;
            min-height: auto !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        body, .swagger-ui {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif !important;
            background-color: transparent !important;
            color: var(--text) !important;
        }

        /* Ocultar a topbar legada do Swagger */
        .swagger-ui .topbar {
            display: none !important;
        }

        /* ==========================================================\
           BLOCO 1: INFORMAÇÃO DA API (BENTO CARD SUPERIOR)
        ========================================================== */
        .swagger-ui .information-container {
            background: var(--surface) !important;
            border: 1px solid var(--border) !important;
            border-radius: 16px !important;
            padding: 24px !important;
            margin: 0 0 16px 0 !important; /* Margem apenas para o bloco de baixo */
            box-shadow: var(--shadow-sm) !important;
            display: block !important;
            height: auto !important;
        }

        .swagger-ui .info {
            margin: 0 !important;
            padding: 0 !important;
        }

        .swagger-ui .info .title {
            font-size: 24px !important;
            font-weight: 700 !important;
            letter-spacing: -0.02em !important;
            color: var(--text) !important;
            margin: 0 0 8px 0 !important;
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }

        /* Badge de Versão integrado e minimalista */
        .swagger-ui .info .version {
            font-size: 11px !important;
            font-weight: 700 !important;
            background: rgba(249, 115, 22, 0.1) !important;
            color: var(--primary) !important;
            padding: 4px 10px !important;
            border-radius: 8px !important;
            margin: 0 !important;
            display: inline-block !important;
        }

        .swagger-ui .info .description {
            font-size: 14px !important;
            color: var(--text-soft) !important;
            line-height: 1.6 !important;
            margin: 12px 0 0 0 !important;
        }

        .swagger-ui .info a {
            color: var(--primary) !important;
            text-decoration: none !important;
            font-weight: 500 !important;
        }
        .swagger-ui .info a:hover {
            text-decoration: underline !important;
        }

        /* ==========================================================\
           BLOCO 2: SERVERS + AUTHORIZE (IGUAL AO BLOCO DE CIMA)
        ========================================================== */
        .swagger-ui .scheme-container {
            background: var(--surface) !important;
            border: 1px solid var(--border) !important;
            border-radius: 16px !important;
            padding: 20px 24px !important;
            margin: 0 0 24px 0 !important; /* Espaço para separar dos endpoints */
            box-shadow: var(--shadow-sm) !important;
            height: auto !important;
        }

        /* Alinhamento estrito em linha horizontal */
        .swagger-ui .scheme-container .schemes-wrapper {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 16px !important;
            flex-wrap: nowrap !important; /* Impede a quebra de linha em ecrãs normais */
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Configuração do Seletor de Servidores */
        .swagger-ui .servers {
            margin: 0 !important;
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }

        .swagger-ui .servers > label {
            margin: 0 !important;
            font-weight: 700 !important;
            color: var(--text) !important;
            font-size: 13px !important;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .swagger-ui .servers select {
            background: var(--surface-2) !important;
            border: 1px solid var(--border) !important;
            color: var(--text) !important;
            border-radius: 12px !important;
            padding: 8px 36px 8px 12px !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            cursor: pointer;
            outline: none !important;
            transition: all 0.15s ease;
        }

        .swagger-ui .servers select:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.2) !important;
        }

        /* Configuração do Contentor do Authorize */
        .swagger-ui .auth-wrapper {
            display: flex !important;
            align-items: center !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Botão de Autorização (Authorize) - Premium */
        .swagger-ui .btn.authorize {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            color: #ffffff !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            padding: 10px 24px !important;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.2) !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            margin: 0 !important;
            text-transform: none !important;
            font-size: 14px !important;
        }

        .swagger-ui .btn.authorize:hover {
            background-color: var(--primary-hover) !important;
            transform: translateY(-1px);
        }

        .swagger-ui .btn.authorize svg {
            fill: #ffffff !important;
            width: 16px !important;
            height: 16px !important;
        }

        /* ==========================================================\
           BLOCO 3: ENDPOINTS E CONFIGURAÇÕES DO SWAGGER UI
        ========================================================== */
        .swagger-ui .wrapper {
            padding: 0 !important;
            max-width: none !important;
            margin: 0 !important;
        }

        .swagger-ui p,
        .swagger-ui table,
        .swagger-ui label {
            color: var(--text-soft) !important;
            font-size: 14px !important;
        }

        /* Cabeçalhos de Secção (Tags) */
        .swagger-ui .opblock-tag {
            color: var(--text) !important;
            border-bottom: 1px solid var(--border) !important;
            font-size: 20px !important;
            font-weight: 700 !important;
            letter-spacing: -0.02em !important;
            padding: 16px 0 !important;
            display: flex !important;
            align-items: center;
            gap: 10px;
        }

        /* Indicador circular laranja à frente de cada Tag */
        .swagger-ui .opblock-tag::before {
            content: "";
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: var(--primary);
            border-radius: 50%;
        }

        .swagger-ui .opblock-tag small {
            color: var(--text-soft) !important;
            font-weight: 400 !important;
            font-size: 13px !important;
        }

        /* Outros botões (Cancelar, Try it out, etc.) */
        .swagger-ui .btn {
            border-radius: 12px !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            color: var(--text) !important;
            border-color: var(--border) !important;
            background: var(--surface-2) !important;
            transition: all 0.2s ease;
        }
        .swagger-ui .btn:hover {
            background: var(--border) !important;
        }

        /* Botões de Execução dos Requests (Execute) */
        .swagger-ui .btn.execute {
            background-color: var(--primary) !important;
            color: #ffffff !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.2) !important;
        }
        .swagger-ui .btn.execute:hover {
            background-color: var(--primary-hover) !important;
        }

        /* Inputs, Seletores e Caixas de Texto */
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
            padding: 10px 14px !important;
            font-size: 13px !important;
            transition: all 0.15s ease-in-out;
        }

        .swagger-ui input:focus,
        .swagger-ui select:focus,
        .swagger-ui textarea:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.2) !important;
        }

        /* Tabelas de Parâmetros */
        .swagger-ui table thead tr th {
            font-size: 11px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            color: var(--text-soft) !important;
            font-weight: 700 !important;
            border-bottom: 2px solid var(--border) !important;
            padding: 12px !important;
        }

        .swagger-ui table tbody tr td {
            padding: 12px !important;
            border-bottom: 1px solid var(--border) !important;
        }

        .swagger-ui .parameters-col_name {
            color: var(--text) !important;
            font-weight: 600 !important;
        }

        .swagger-ui .parameter__name.required::after {
            color: var(--primary) !important;
        }

        /* Blocos de Operação (GET, POST, PUT, DELETE) - Bento Style */
        .swagger-ui .opblock {
            border-radius: 16px !important;
            box-shadow: none !important;
            border-width: 1px !important;
            margin: 0 0 14px 0 !important;
            overflow: hidden;
            background: var(--surface) !important;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .swagger-ui .opblock:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm) !important;
        }

        .swagger-ui .opblock .opblock-summary {
            padding: 12px 20px !important;
        }

        .swagger-ui .opblock .opblock-summary-method {
            font-size: 11px !important;
            font-weight: 800 !important;
            border-radius: 8px !important;
            padding: 6px 14px !important;
            min-width: 85px !important;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .swagger-ui .opblock-summary-path,
        .swagger-ui .opblock-summary-description {
            color: var(--text) !important;
            font-weight: 600 !important;
            font-size: 14px !important;
        }

        /* Cores Customizadas de Métodos */
        .swagger-ui .opblock.opblock-post { background: rgba(34, 197, 94, 0.03) !important; border-color: rgba(34, 197, 94, 0.15) !important; }
        .swagger-ui .opblock.opblock-post .opblock-summary-method { background: rgba(34, 197, 94, 0.12) !important; color: #22c55e !important; }

        .swagger-ui .opblock.opblock-get { background: rgba(59, 130, 246, 0.03) !important; border-color: rgba(59, 130, 246, 0.15) !important; }
        .swagger-ui .opblock.opblock-get .opblock-summary-method { background: rgba(59, 130, 246, 0.12) !important; color: #3b82f6 !important; }

        .swagger-ui .opblock.opblock-put { background: rgba(249, 115, 22, 0.03) !important; border-color: rgba(249, 115, 22, 0.15) !important; }
        .swagger-ui .opblock.opblock-put .opblock-summary-method { background: rgba(249, 115, 22, 0.12) !important; color: #f97316 !important; }

        .swagger-ui .opblock.opblock-delete { background: rgba(239, 68, 68, 0.03) !important; border-color: rgba(239, 68, 68, 0.15) !important; }
        .swagger-ui .opblock.opblock-delete .opblock-summary-method { background: rgba(239, 68, 68, 0.12) !important; color: #ef4444 !important; }

        /* Blocos de Código (Responses e Schemas) */
        .swagger-ui pre {
            background-color: #0b0f19 !important;
            border: 1px solid var(--border) !important;
            border-radius: 12px !important;
            color: #e2e8f0 !important;
            padding: 16px !important;
        }

        .swagger-ui .model-box {
            background: var(--surface-2) !important;
            border-radius: 8px !important;
            padding: 8px !important;
        }

        /* Secção de Modelos / Schemas no Fim da Página */
        .swagger-ui section.models {
            border: 1px solid var(--border) !important;
            border-radius: 16px !important;
            background: var(--surface) !important;
            margin-top: 32px !important;
            overflow: hidden;
        }

        .swagger-ui section.models h4 {
            border-bottom: 1px solid var(--border) !important;
            padding: 20px !important;
            margin: 0 !important;
            font-size: 16px !important;
            font-weight: 700 !important;
        }

        /* Inversão Adaptativa de Cores Adicional para o Dark Mode */
        .dark .swagger-ui .btn.authorize { background-color: var(--primary) !important; border-color: var(--primary) !important; color: #ffffff !important; }
        .dark .swagger-ui .btn.authorize svg { fill: #ffffff !important; }
        .dark .swagger-ui .opblock-section-header { background: var(--surface-2) !important; border-bottom: 1px solid var(--border) !important; }
    </style>

    <script>
        // Inicialização imediata do tema para evitar quebras visuais
        (() => {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                document.documentElement.setAttribute('data-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                document.documentElement.removeAttribute('data-theme');
            }
        })();
    </script>
</head>

<body class="bg-[var(--bg)] text-[var(--text)] min-h-screen flex flex-col antialiased overflow-x-hidden">

    {{-- Efeitos de Gradiente e Brilho de Fundo (Glow Blobs idênticos ao painel) --}}
    <div class="fixed inset-0 -z-50 pointer-events-none" aria-hidden="true">
        <div class="absolute inset-0 bg-[var(--bg)]"></div>
        <div class="absolute -top-60 left-1/2 -translate-x-1/2 h-[900px] w-[900px] rounded-full bg-orange-500/10 blur-[180px]"></div>
        <div class="absolute bottom-0 right-0 h-[600px] w-[600px] rounded-full bg-blue-500/10 blur-[180px]"></div>
        <div class="absolute top-40 left-0 h-[450px] w-[450px] rounded-full bg-orange-500/10 blur-[140px]"></div>
    </div>

    {{-- Header de Alta Fidelidade Alinhado com o Painel Principal --}}
    <header class="w-full border-b border-[var(--border)] bg-[var(--topbar)] px-8 h-20 sticky top-0 z-50 backdrop-blur-xl">
        <div class="mx-auto max-w-5xl h-full w-full flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center justify-center h-10 w-10 rounded-xl bg-orange-500/10 text-lg shadow-sm">
                    📚
                </span>
                <div class="flex flex-col">
                    <span class="text-[9px] font-bold uppercase tracking-widest text-[var(--primary)] leading-none mb-1">
                        Documentação da API
                    </span>
                    <span class="text-sm font-bold text-[var(--text)] leading-none">
                        Swagger OpenAPI v3
                    </span>
                </div>
            </div>

            {{-- Botão Voltar ao Painel Alinhado com o Design --}}
            <div>
                <a href="/ui" class="inline-flex h-10 px-4 items-center justify-center gap-2 rounded-xl border border-[var(--border)] bg-[var(--surface)] text-xs font-semibold text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer">
                    <svg class="w-4 h-4 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                    </svg>
                    Voltar ao painel
                </a>
            </div>
        </div>
    </header>

    {{-- Enquadramento da Documentação --}}
    <main class="mx-auto w-full max-w-5xl px-8 py-8 flex-grow">
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
