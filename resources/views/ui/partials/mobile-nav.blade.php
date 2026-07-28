@props(['navItems' => []])

{{-- Overlay Escuro para Mobile --}}
<div id="mobileNavOverlay" class="fixed inset-0 bg-black/60 hidden opacity-0 transition-opacity duration-300 z-40"></div>

{{-- Drawer / Menu Lateral Móvel --}}
<aside id="mobileNav"
    class="fixed inset-y-0 left-0 w-72 -translate-x-full transition-transform duration-300 ease-in-out bg-[var(--sidebar)] border-r border-[var(--border)] backdrop-blur-xl z-50 flex flex-col shadow-2xl lg:hidden">
    {{-- Branding Mobile --}}
    <div class="h-20 px-8 flex items-center border-b border-[var(--border)]">
        <div class="flex items-center gap-4">
            <button type="button" data-action="close-mobile-nav"
                class="h-11 w-11 rounded-xl bg-primary text-[var(--on-primary)] font-black flex items-center justify-center shadow-md shadow-primary/20 cursor-pointer hover:opacity-90 transition-all flex-shrink-0"
                aria-label="{{ __('Fechar menu') }}">
                ☰
            </button>
        </div>
    </div>

    {{-- Links Mobile --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1" aria-label="{{ __('Navegação principal mobile') }}">
        @foreach ($navItems as $item)
            @php
                $isActive = request()->is($item['active']);
            @endphp

            <a href="{{ url($item['href'] === '/' ? '/' : $item['href']) }}" data-action="close-mobile-nav"
                class="group flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200
                {{ $isActive
                    ? 'bg-primary text-[var(--on-primary)] font-semibold shadow-sm shadow-primary/20'
                    : 'text-[var(--text)] hover:bg-[var(--surface-2)]' }}">
                <span class="text-lg filter {{ $isActive ? 'none' : 'grayscale opacity-80' }}">
                    {{ $item['icon'] }}
                </span>
                <span>{{ __($item['label']) }}</span>
            </a>
        @endforeach
    </nav>

    {{-- Auth Box Mobile --}}
    <div class="border-t border-[var(--border)] p-4 bg-[var(--surface-2)]/50">
        <div id="authBoxMobile"></div>
    </div>
</aside>
