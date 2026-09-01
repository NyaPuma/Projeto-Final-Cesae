@props(['navItems' => []])

<aside id="desktopSidebar" class="ui-sidebar ui-sidebar--desktop">
    {{-- Desktop Branding --}}
    <div id="desktopBranding" class="ui-sidebar__branding">
        <div class="flex items-center gap-4">
            <x-ui.buttons.icon-button type="button" data-action="toggle-sidebar" variant="primary" size="md" class="font-black shadow-md shadow-primary/20 shrink-0" aria-label="{{ __('common.Recolher menu') }}">
                ☰
            </x-ui.buttons.icon-button>
        </div>
    </div>

    {{-- Desktop Navigation Links --}}
    <nav class="ui-sidebar__nav" aria-label="{{ __('common.Navegação principal') }}">
        @foreach ($navItems as $item)
            @php
                $isActive = request()->is($item['active']);
            @endphp

            <a href="{{ url($item['href'] === '/' ? '/' : $item['href']) }}"
                class="ui-sidebar__link {{ $isActive ? 'ui-sidebar__link--active' : '' }}">
                <span class="ui-sidebar__icon">
                    {!! $item['icon'] !!}
                </span>
                <span class="sidebar-text">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    {{-- Desktop Auth Box --}}
    <div id="authBoxContainer" class="ui-sidebar__auth">
        <div id="authBox"></div>
    </div>
</aside>
