@props([
    'title' => null,
    'subtitle' => null,
    'badge' => 'Dashboard',
    'animate' => true,
])

<div
    {{ $attributes->merge([
        'class' => 'group relative overflow-hidden rounded-[28px] border border-[var(--border)] bg-[var(--surface)] shadow-[var(--shadow-sm)] transition-all duration-300 hover:-translate-y-1 hover:border-[var(--text)]/20 hover:shadow-[0_18px_45px_rgba(15,23,42,0.08)]',
    ]) }}
>
    {{-- Glow decorativo superior --}}
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-amber-400/70 to-transparent"></div>
    <div class="pointer-events-none absolute -top-24 right-0 h-44 w-44 rounded-full bg-amber-500/10 blur-3xl transition duration-500 group-hover:scale-110"></div>
    <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-white/70 via-transparent to-amber-50/40 dark:from-white/[0.02] dark:to-amber-500/[0.03]"></div>

    <div class="relative p-8">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">

            <div class="space-y-3">
                @if($badge)
                    <div class="flex items-center gap-3">
                        @if($animate)
                            <span class="relative flex h-3 w-3">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-amber-500 opacity-50"></span>
                                <span class="relative inline-flex h-3 w-3 rounded-full bg-amber-500"></span>
                            </span>
                        @endif

                        <span class="text-xs font-bold uppercase tracking-[0.30em] text-[var(--text-soft)]">
                            {{ $badge }}
                        </span>
                    </div>
                @endif

                @if($title)
                    <h1 class="text-4xl font-black tracking-tight text-[var(--text)] transition-transform duration-300 group-hover:translate-x-0.5">
                        {{ $title }}
                    </h1>
                @endif

                @if(!empty($subtitle))
                    <p class="max-w-3xl text-base leading-8 text-[var(--text-soft)]">
                        {{ $subtitle }}
                    </p>
                @endif
            </div>

            {{-- Slot de Ações à direita --}}
            @if(isset($actions) && $actions !== '')
                <div class="flex flex-wrap items-center gap-3">
                    {!! $actions !!}
                </div>
            @endif

        </div>

        {{-- Conteúdo Principal --}}
        <div class="mt-10 border-t border-[var(--border)] pt-8">
            {{ $slot }}
        </div>

    </div>
</div>
