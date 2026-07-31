<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        (function () {
            try {
                var theme = localStorage.getItem('theme');
                var isDark = theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches);
                var root = document.documentElement;
                root.classList.toggle('dark', isDark);
                if (isDark) { root.setAttribute('data-theme', 'dark'); } else { root.removeAttribute('data-theme'); }
            } catch (e) {}
        })();
    </script>

    <title>{{ __('Gestão de Avarias') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
    @stack('styles')
</head>

<body data-page="@yield('page_key')"
      data-login-url="{{ route('ui.login') }}"
      data-logout-url="{{ route('auth.logout') }}"
      data-profile-url="{{ route('ui.profile') }}"
      class="min-h-screen overflow-x-hidden bg-[var(--bg)] text-[var(--text)] antialiased">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-xl focus:bg-primary focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-[var(--on-primary)]">
        {{ __('Ir para o conteúdo') }}
    </a>

    <main id="main-content" role="main" tabindex="-1" class="min-h-screen">
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>
