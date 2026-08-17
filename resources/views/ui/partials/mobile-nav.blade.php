@props(['navItems' => []])

{{-- Overlay Escuro para Mobile --}}
<div id="mobileNavOverlay" class="ui-mobile-nav__overlay"></div>

{{-- Drawer / Menu Lateral Móvel --}}
<aside id="mobileNav" class="ui-mobile-nav" aria-hidden="true">
    {{-- Branding Mobile --}}
    <div class="ui-mobile-nav__header">
        <x-ui.buttons.icon-button type="button" data-action="toggle-mobile-nav" variant="primary" size="md" class="font-black shadow-md shadow-primary/20 shrink-0" aria-label="{{ __('ui.Fechar menu') }}" aria-expanded="false">
            ☰
        </x-ui.buttons.icon-button>
    </div>

    {{-- Links Mobile --}}
    <nav class="ui-mobile-nav__menu" aria-label="{{ __('common.Navegação principal mobile') }}">
        @foreach ($navItems as $item)
            @php
                $isActive = request()->is($item['active']);
            @endphp

            <a href="{{ url($item['href'] === '/' ? '/' : $item['href']) }}" data-action="close-mobile-nav" class="ui-mobile-nav__link {{ $isActive ? 'ui-sidebar__link--active' : '' }}">
                <span class="ui-sidebar__icon">{{ $item['icon'] }}</span>
                <span>{{ __($item['label']) }}</span>
            </a>
        @endforeach
    </nav>

    {{-- Auth Box Mobile --}}
    <div class="ui-mobile-nav__auth">
        <div id="authBoxMobile"></div>
    </div>
</aside>
