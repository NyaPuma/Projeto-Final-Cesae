<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ \App\Services\LocaleService::isRtl(app()->getLocale()) ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('common.Gestão de Avarias') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">

    @vite('resources/js/early-theme.js')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
    <link rel="stylesheet" href="{{ route('theme.custom') }}?v={{ \App\Http\Controllers\ThemeController::cacheBuster() }}">

    @include('ui.partials.theme-meta')

    @include('ui.partials.locale-config')

    @stack('styles')
</head>

<body data-page="@yield('page_key')"
      data-login-url="{{ route('ui.login') }}"
      data-logout-url="{{ route('auth.logout') }}"
      data-profile-url="{{ route('ui.profile') }}"
      data-auth-profile="{{ __('auth_box.profile') }}"
      data-auth-logout="{{ __('auth_box.logout') }}"
      data-auth-signin="{{ __('auth_box.signin') }}"
      data-auth-login-register="{{ __('auth_box.login_register') }}"
      class="min-h-screen overflow-x-hidden bg-[var(--bg)] text-[var(--text)] antialiased{{ \App\Services\LocaleService::isRtl(app()->getLocale()) ? ' rtl' : '' }}">
    <div class="locale-trigger-wrapper fixed right-4 top-4 z-40">
        @include('ui.partials.locale-trigger')
    </div>
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-xl focus:bg-primary focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-[var(--on-primary)]">
        {{ __('common.Ir para o conteúdo') }}
    </a>

    <main id="main-content" role="main" tabindex="-1" class="min-h-screen">
        @yield('content')
    </main>

    @stack('scripts')

    @include('ui.partials.locale-modal')
</body>

</html>
