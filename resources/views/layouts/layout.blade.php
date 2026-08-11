<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Gestão de Avarias') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <script>
        window.currentLocale = "{{ app()->getLocale() }}";

        // Dicionário global de tradução para elementos dinâmicos em JavaScript
        window.appTranslations = {
            "A carregar listagem de tickets...": "Loading ticket list...",
            "Nenhum ticket encontrado com os filtros aplicados.": "No ticket found with applied filters.",
            "A carregar inventário de equipamentos...": "Loading equipment inventory...",
            "Nenhum equipamento encontrado com os filtros aplicados.": "No equipment found with the applied filters.",
            "A carregar salas...": "Loading rooms...",
            "Nenhuma sala encontrada com os filtros aplicados.": "No rooms found with the applied filters.",
            "Ativo": "Active",
            "Inativo": "Inactive",
            "Pendente": "Pending",
            "Em Curso": "In Progress",
            "Fechado": "Closed",
            "Baixa": "Low",
            "Média": "Medium",
            "Alta": "High",
            "Crítica": "Critical"
        };

        function __(text) {
            const locale = window.currentLocale || "{{ app()->getLocale() }}";
            if (locale === 'en' && window.appTranslations[text]) {
                return window.appTranslations[text];
            }
            return text;
        }
    </script>
</head>

<body class="min-h-screen bg-[var(--bg)] text-[var(--text)] overflow-x-hidden antialiased">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-xl focus:bg-primary focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-[var(--on-primary)]">
        {{ __('Ir para o conteúdo') }}
    </a>

    <main id="main-content" role="main" tabindex="-1" class="min-h-screen">
        @yield('content')
    </main>

    <script>
        (() => {
            const saved = localStorage.getItem('theme');
            if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                document.documentElement.setAttribute('data-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                document.documentElement.removeAttribute('data-theme');
            }
        })();
    </script>

    @stack('scripts')
</body>

</html>