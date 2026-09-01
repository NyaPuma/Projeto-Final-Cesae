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
            "Crítica": "Critical",
            "baixa": "Low",
            "média": "Medium",
            "alta": "High",
            "crítica": "Critical"

            "Erro de comunicação no controlador do Braço Robótico": "Communication error in Robotic Arm controller",
            "Braço Robótico KUKA KR210": "Robotic Arm KUKA KR210",
            "Lentidão crítica e sobreaquecimento no nó primário": "Critical lag and overheating on primary node",
            "Servidor Central Dell PowerEdge": "Central Server Dell PowerEdge",
            "Laboratório de I&D": "R&D Laboratory",
            "Fuga de óleo visível no pistão hidráulico principal": "Visible oil leak in the main hydraulic piston",
            "Prensa Hidráulica 50T": "50T Hydraulic Press",
            "Linha de Montagem A": "Assembly Line A",
            "Pavilhão Industrial 1": "Industrial Pavilion 1",
        };

        function __(text) {
            const locale = window.currentLocale || "{{ app()->getLocale() }}";
            if (locale === 'en' && window.appTranslations[text]) {
                return window.appTranslations[text];
            }
            return text;
        }

        function togglePublicLangDropdown() {
            const dropdown = document.getElementById('publicLangDropdown');
            if (dropdown) dropdown.classList.toggle('hidden');
        }

        document.addEventListener('click', (e) => {
            const dropdown = document.getElementById('publicLangDropdown');
            const container = document.getElementById('publicLangContainer');
            if (dropdown && container && !container.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</head>

<body
    class="min-h-screen bg-[var(--bg)] text-[var(--text)] overflow-x-hidden antialiased flex flex-col justify-between">

    {{-- Barra Superior Pública com Seletor de Idioma --}}
    <header class="w-full flex justify-end p-6 relative z-50">
        <div class="relative inline-block text-left" id="publicLangContainer">
            <button type="button" onclick="togglePublicLangDropdown()"
                class="inline-flex h-10 px-3.5 items-center justify-center gap-2 rounded-xl border border-[var(--border)] bg-[var(--surface)] text-sm text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer">
                @if (app()->getLocale() === 'pt')
                    <svg class="w-4 h-3 rounded-xs overflow-hidden flex-shrink-0 shadow-xs" viewBox="0 0 600 400">
                        <rect width="600" height="400" fill="#ff0000" />
                        <rect width="240" height="400" fill="#006600" />
                        <circle cx="240" cy="200" r="80" fill="#ffff00" stroke="#000" stroke-width="3" />
                    </svg>
                @else
                    <svg class="w-4 h-3 rounded-xs overflow-hidden flex-shrink-0 shadow-xs" viewBox="0 0 600 400">
                        <rect width="600" height="400" fill="#00247d" />
                        <path d="M0,0 L600,400 M600,0 L0,400" stroke="#fff" stroke-width="60" />
                        <path d="M0,0 L600,400 M600,0 L0,400" stroke="#cf142b" stroke-width="40" />
                        <path d="M300,0 V400 M0,200 H600" stroke="#fff" stroke-width="100" />
                        <path d="M300,0 V400 M0,200 H600" stroke="#cf142b" stroke-width="60" />
                    </svg>
                @endif
                <span class="font-semibold text-xs uppercase text-[var(--text)]">{{ app()->getLocale() }}</span>
                <svg class="h-3.5 w-3.5 text-[var(--text-soft)]" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div id="publicLangDropdown"
                class="hidden absolute right-0 mt-2 w-36 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-lg py-1.5 z-50">
                <a href="/lang/pt"
                    class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--surface-2)] {{ app()->getLocale() === 'pt' ? 'bg-primary/10 text-primary' : '' }}">
                    <svg class="w-4 h-3 rounded-xs flex-shrink-0 shadow-xs" viewBox="0 0 600 400">
                        <rect width="600" height="400" fill="#ff0000" />
                        <rect width="240" height="400" fill="#006600" />
                        <circle cx="240" cy="200" r="80" fill="#ffff00" stroke="#000" stroke-width="3" />
                    </svg>
                    Português
                </a>
                <a href="/lang/en"
                    class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--surface-2)] {{ app()->getLocale() === 'en' ? 'bg-primary/10 text-primary' : '' }}">
                    <svg class="w-4 h-3 rounded-xs flex-shrink-0 shadow-xs" viewBox="0 0 600 400">
                        <rect width="600" height="400" fill="#00247d" />
                        <path d="M0,0 L600,400 M600,0 L0,400" stroke="#fff" stroke-width="60" />
                        <path d="M0,0 L600,400 M600,0 L0,400" stroke="#cf142b" stroke-width="40" />
                        <path d="M300,0 V400 M0,200 H600" stroke="#fff" stroke-width="100" />
                        <path d="M300,0 V400 M0,200 H600" stroke="#cf142b" stroke-width="60" />
                    </svg>
                    English
                </a>
            </div>
        </div>
    </header>

    <main id="main-content" role="main" tabindex="-1" class="flex-1">
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
