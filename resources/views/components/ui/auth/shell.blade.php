{{--
|--------------------------------------------------------------------------
| Auth / Secure Area Layout Component
|--------------------------------------------------------------------------
|
| Layout estruturado em grelha para páginas de autenticação ou áreas restritas.
| • 100% livre de CSS ou JS inline.
| • Sintaxe de variáveis CSS corrigida e segura para o Tailwind.
| • Suporte a destaques condicionais e personalização global do body via $attributes.
|
--}}

@props([
    'title',
    'description',
    'eyebrow' => __('Área segura'),
    'highlights' => [],
])

<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} — {{ __('Gestão de Avarias') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body {{ $attributes->merge(['class' => 'min-h-screen overflow-x-hidden bg-[var(--bg)] text-[var(--text)] antialiased']) }}>
    {{-- Efeitos Visuais de Fundo (Glow) --}}
    <div class="pointer-events-none fixed inset-0 -z-10" aria-hidden="true">
        <div class="absolute inset-0 bg-[var(--bg)]"></div>
        <div class="absolute left-1/2 top-0 h-[900px] w-[900px] -translate-x-1/2 rounded-full bg-primary/10 blur-[180px]"></div>
        <div class="absolute bottom-0 right-0 h-[600px] w-[600px] rounded-full bg-blue-500/10 blur-[180px]"></div>
    </div>

    <div class="min-h-screen bg-[var(--bg)] px-4 py-6 text-[var(--text)] antialiased sm:px-6 lg:px-8">
        <div class="mx-auto flex min-h-[calc(100vh-3rem)] max-w-5xl items-center justify-center">
            <div class="ui-card w-full overflow-hidden rounded-[32px] border border-[var(--border)] bg-[var(--surface)] shadow-2xl shadow-black/10 backdrop-blur-xl">
                <div class="grid min-h-[720px] lg:grid-cols-[0.95fr_1.05fr]">
                    {{-- Painel Lateral Informativo --}}
                    <div class="flex flex-col justify-between bg-[var(--surface-2)]/70 p-8 lg:p-10">
                        <div>
                            @if($eyebrow)
                                <x-ui.text.pill tone="primary" size="sm" class="gap-3 tracking-[0.24em]">
                                    <span class="h-2 w-2 rounded-full bg-primary" aria-hidden="true"></span>
                                    {{ $eyebrow }}
                                </x-ui.text.pill>
                            @endif

                            @if($title)
                                <h1 class="mt-8 text-3xl font-black tracking-tight text-[var(--text)] sm:text-4xl">
                                    {{ $title }}
                                </h1>
                            @endif

                            @if($description)
                                <p class="mt-4 max-w-md text-sm leading-7 text-[var(--text-soft)] sm:text-[15px]">
                                    {{ $description }}
                                </p>
                            @endif
                        </div>

                        @if(!empty($highlights))
                            <div class="mt-10 space-y-4">
                                @foreach($highlights as $highlight)
                                    <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">
                                        @if(isset($highlight['title']))
                                            <p class="text-sm font-semibold text-[var(--text)]">{{ $highlight['title'] }}</p>
                                        @endif

                                        @if(isset($highlight['description']))
                                            <p class="mt-2 text-sm leading-7 text-[var(--text-soft)]">{{ $highlight['description'] }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Painel Principal de Conteúdo (Slot do Formulário/Ação) --}}
                    <div class="flex items-center justify-center p-6 sm:p-8 lg:p-10">
                        <div class="w-full max-w-md">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
