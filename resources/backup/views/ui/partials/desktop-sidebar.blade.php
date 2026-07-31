@props(['navItems' => []])

<aside id="desktopSidebar"
    class="hidden lg:flex fixed left-0 top-0 h-screen w-72 flex-col border-r border-[var(--border)] bg-[var(--sidebar)] backdrop-blur-xl transition-all duration-300 ease-in-out z-30">
    {{-- Branding Desktop --}}
    <div id="desktopBranding"
        class="h-20 px-8 flex items-center border-b border-[var(--border)] transition-all duration-300">
        <div class="flex items-center gap-4">
            <x-ui.buttons.icon-button type="button" data-action="toggle-sidebar" variant="primary" size="md" class="font-black shadow-md shadow-primary/20 shrink-0" aria-label="{{ __('Recolher menu') }}">
                ☰
            </x-ui.buttons.icon-button>
        </div>
    </div>

    {{-- Links de Navegação Desktop --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1 transition-all duration-300"
        aria-label="{{ __('Navegação principal') }}">
        @foreach ($navItems as $item)
            @php
                $isActive = request()->is($item['active']);
            @endphp

            <a href="{{ url($item['href'] === '/' ? '/' : $item['href']) }}"
                class="group flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200
                {{ $isActive
                    ? 'bg-primary text-[var(--on-primary)] font-semibold shadow-sm shadow-primary/20'
                    : 'text-[var(--text)] hover:bg-[var(--surface-2)]' }}">
                <span class="text-lg filter {{ $isActive ? 'none' : 'grayscale opacity-80' }} flex-shrink-0">
                    {{ $item['icon'] }}
                </span>
                <span class="sidebar-text transition-all duration-300">{{ __($item['label']) }}</span>
            </a>
        @endforeach
    </nav>

    {{-- Caixa de Autenticação Desktop --}}
    <div id="authBoxContainer"
        class="border-t border-[var(--border)] p-4 bg-[var(--surface-2)]/50 transition-all duration-300">
        <div id="authBox"></div>
    </div>
</aside>
