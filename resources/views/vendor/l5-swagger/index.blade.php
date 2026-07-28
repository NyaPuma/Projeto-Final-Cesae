<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $documentationTitle }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    {{-- 1) CSS base oficial do Swagger UI --}}
    <link rel="stylesheet" type="text/css" href="{{ l5_swagger_asset($documentation, 'swagger-ui.css') }}">

    {{-- 2) Design system principal da app --}}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif

    {{-- 3) Bundle de estilos customizados do Swagger --}}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite('resources/css/swagger/swagger.css')
    @endif

    <link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-16x16.png') }}" sizes="16x16" />

    {{-- Swagger UI custom theme (js) --}}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite([
            'resources/js/swagger/utils.js',
            'resources/js/swagger/search.js',
            'resources/js/swagger/badges.js',
            'resources/js/swagger/counters.js',
            'resources/js/swagger/expand.js',
            'resources/js/swagger/scrollspy.js',
            'resources/js/swagger/toolbar.js',
            'resources/js/swagger/sidebar.js',
            'resources/js/swagger/init.js',
        ])
    @endif

    <script>
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

    <style>
        /* Otimizações de layout amplo e tipografia para Swagger UI */
        .swagger-ui .wrapper {
            max-width: 100% !important;
            padding: 0 !important;
        }
        .swagger-ui .opblock-tag {
            font-weight: 600 !important;
            letter-spacing: normal !important;
            font-size: 1.1rem !important;
        }
    </style>
</head>

<body class="bg-[var(--bg)] text-[var(--text)] min-h-screen flex flex-col antialiased overflow-x-hidden">

    {{-- Efeitos de Gradiente e Brilho de Fundo --}}
    <div class="fixed inset-0 -z-50 pointer-events-none" aria-hidden="true">
        <div class="absolute inset-0 bg-[var(--bg)]"></div>
        <div class="absolute -top-60 left-1/2 -translate-x-1/2 h-[900px] w-[900px] rounded-full bg-orange-500/10 blur-[180px]"></div>
        <div class="absolute bottom-0 right-0 h-[600px] w-[600px] rounded-full bg-blue-500/10 blur-[180px]"></div>
        <div class="absolute top-40 left-0 h-[450px] w-[450px] rounded-full bg-orange-500/10 blur-[140px]"></div>
    </div>

    {{-- Header de Alta Fidelidade Ampliado (max-w-[1500px]) --}}
    <header class="w-full border-b border-[var(--border)] bg-[var(--topbar)] px-4 sm:px-8 h-20 sticky top-0 z-50 backdrop-blur-xl">
        <div class="mx-auto max-w-[1500px] h-full w-full flex items-center justify-between">
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

            {{-- Botão Voltar ao Painel --}}
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

    {{-- Enquadramento de Conteúdo Amplo --}}
    <main class="mx-auto w-full max-w-[1500px] px-4 sm:px-8 py-8 flex-grow space-y-4">
        
        {{-- Toolbar de Controlo Totalmente Visível e Estilizada --}}
        <div id="swagger-toolbar" class="flex flex-col sm:flex-row items-center justify-between gap-4 p-4 rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm">
            <div class="relative w-full sm:w-96">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-[var(--text-soft)] pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="7" />
                    <path d="M20 20L17 17" />
                </svg>
                <input id="swaggerSearch" type="text" placeholder="Pesquisar endpoint..." class="w-full pl-10 pr-4 py-2 text-xs rounded-xl border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text)] outline-none focus:border-primary transition-all">
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                <button id="expandAll" type="button" class="px-3 py-2 text-xs font-semibold rounded-xl border border-[var(--border)] bg-[var(--surface-2)] hover:bg-[var(--border)] text-[var(--text)] transition cursor-pointer">
                    Expandir tudo
                </button>
                <button id="collapseAll" type="button" class="px-3 py-2 text-xs font-semibold rounded-xl border border-[var(--border)] bg-[var(--surface-2)] hover:bg-[var(--border)] text-[var(--text)] transition cursor-pointer">
                    Recolher tudo
                </button>
            </div>
        </div>

        {{-- Contentor Principal do Swagger UI --}}
        <div id="swagger-ui" class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm"></div>
    </main>

    <button id="scrollTop" class="fixed bottom-6 right-6 h-10 w-10 rounded-xl bg-orange-500 text-white font-bold shadow-lg flex items-center justify-center hover:bg-orange-600 transition cursor-pointer">
        ↑
    </button>

    <script src="{{ l5_swagger_asset($documentation, 'swagger-ui-bundle.js') }}"></script>
    <script src="{{ l5_swagger_asset($documentation, 'swagger-ui-standalone-preset.js') }}"></script>
    <script>
        window.SWAGGER_L5_URLS = [
            @foreach ($urlsToDocs as $title => $url)
                { name: "{{ $title }}", url: "{{ $url }}" },
            @endforeach
        ];

        window.SWAGGER_L5_PRIMARY_NAME = "{{ $documentationTitle }}";
        window.SWAGGER_L5_OPERATIONS_SORTER = {!! isset($operationsSorter) ? ('"' . $operationsSorter . '"') : 'null' !!};
        window.SWAGGER_L5_CONFIG_URL = {!! isset($configUrl) ? ('"' . $configUrl . '"') : 'null' !!};
        window.SWAGGER_L5_VALIDATOR_URL = {!! isset($validatorUrl) ? ('"' . $validatorUrl . '"') : 'null' !!};

        window.SWAGGER_L5_OAUTH2_REDIRECT_URL = "{{ route('l5-swagger.' . $documentation . '.oauth2_callback', [], $useAbsolutePath) }}";
        window.SWAGGER_L5_CSRF_TOKEN = "{{ csrf_token() }}";

        window.SWAGGER_L5_DOC_EXPANSION = "{!! config('l5-swagger.defaults.ui.display.doc_expansion', 'none') !!}";
        window.SWAGGER_L5_FILTER = {!! config('l5-swagger.defaults.ui.display.filter') ? 'true' : 'false' !!};
        window.SWAGGER_L5_PERSIST_AUTH = "{!! config('l5-swagger.defaults.ui.authorization.persist_authorization') ? 'true' : 'false' !!}";

        window.SWAGGER_L5_HAS_OAUTH2_INIT = {!! in_array('oauth2', array_column(config('l5-swagger.defaults.securityDefinitions.securitySchemes'), 'type')) ? 'true' : 'false' !!};

        window.SWAGGER_L5_USE_PKCE = "{!! (bool) config('l5-swagger.defaults.ui.authorization.oauth2.use_pkce_with_authorization_code_grant') !!}";
    </script>

</body>

</html>