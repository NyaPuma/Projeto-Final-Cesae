<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ \App\Services\LocaleService::isRtl(app()->getLocale()) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('common.Comunicar Avaria') }} — {{ __('common.Gestão de Avarias') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">

    @vite('resources/js/early-theme.js')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ route('theme.custom') }}?v={{ \App\Http\Controllers\ThemeController::cacheBuster() }}">

    @include('ui.partials.theme-meta')
    @include('ui.partials.locale-config')
</head>
<body class="min-h-screen overflow-x-hidden bg-[var(--bg)] text-[var(--text)] antialiased{{ \App\Services\LocaleService::isRtl(app()->getLocale()) ? ' rtl' : '' }}">
    <div class="locale-trigger-wrapper fixed right-4 top-4 z-40">
        @include('ui.partials.locale-trigger')
    </div>
    {{-- Efeitos Visuais de Fundo (Glow) --}}
    <div class="pointer-events-none fixed inset-0 -z-10" aria-hidden="true">
        <div class="absolute inset-0 bg-[var(--bg)]"></div>
        <div class="absolute left-1/2 top-0 h-[600px] w-[600px] -translate-x-1/2 rounded-full bg-primary/10 blur-[160px]"></div>
        <div class="absolute bottom-0 right-0 h-[500px] w-[500px] rounded-full bg-blue-500/10 blur-[160px]"></div>
    </div>

    <div class="min-h-screen px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto w-full max-w-2xl">

            {{-- Cabeçalho --}}
            <div class="mb-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] text-lg">🔧</span>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.24em] text-[var(--text-soft)]">{{ __('common.Gestão de Avarias') }}</p>
                        <h1 class="text-xl font-black tracking-tight text-[var(--text)]">{{ __('common.Comunicar Avaria') }}</h1>
                    </div>
                </div>
            </div>

            <div class="ui-card overflow-hidden rounded-[32px] border border-[var(--border)] bg-[var(--surface)] shadow-2xl shadow-black/10 backdrop-blur-xl">

                {{-- Informação do Equipamento --}}
                <div class="border-b border-[var(--border)] bg-[var(--surface-2)]/60 p-6">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 text-xs font-bold text-[var(--text)]">
                            {{ $equipment->category?->name ?? __('equipment.Equipamento') }}
                        </span>
                        @if($equipment->room)
                            <span class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 text-xs font-semibold text-[var(--text-soft)]">
                                📍 {{ $equipment->room->name }}
                            </span>
                        @endif
                        @if($equipment->asset_tag)
                            <span class="ml-auto inline-flex items-center rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 font-mono text-xs font-bold text-[var(--text-soft)]">
                                {{ $equipment->asset_tag }}
                            </span>
                        @endif
                    </div>
                    <h2 class="mt-4 text-lg font-black tracking-tight text-[var(--text)]">{{ $equipment->name }}</h2>
                    <p class="mt-1 text-xs text-[var(--text-soft)]">
                        {{ trim(($equipment->brand ?? '') . ' ' . ($equipment->model ?? '')) ?: __('equipment.Equipamento registado') }}
                    </p>
                </div>

                {{-- Formulário --}}
                <form method="POST" action="{{ route('ticket.public.store') }}" enctype="multipart/form-data" class="space-y-6 p-6">
                    @csrf
                    <input type="hidden" name="equipment_id" value="{{ $equipment->id }}">

                    @if($errors->any())
                        <div class="rounded-2xl border border-rose-500/25 bg-rose-500/10 p-4">
                            <p class="text-xs font-bold uppercase tracking-wider text-rose-700 dark:text-rose-400">{{ __('common.Verifique os campos assinalados.') }}</p>
                        </div>
                    @endif

                    {{-- Tipo de Problema --}}
                    <div>
                        <label for="problem_type" class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('common.Tipo de Problema *') }}</label>
                        <select name="problem_type" id="problem_type" required
                            class="w-full appearance-none rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                            <option value="" disabled {{ old('problem_type') === null ? 'selected' : '' }}>{{ __('common.Selecione o tipo de problema...') }}</option>
                            @foreach($problemTypes as $type)
                                <option value="{{ $type->value }}" {{ old('problem_type') === $type->value ? 'selected' : '' }}>
                                    {{ $type->icon() }} {{ $type->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('problem_type')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Descrição --}}
                    <div>
                        <label for="description" class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('common.Descrição do Problema *') }}</label>
                        <textarea name="description" id="description" rows="4" required maxlength="5000" placeholder="{{ __('equipment.Descreva de forma objetiva o que se passa com o equipamento...') }}"
                            class="w-full resize-none rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Fotografia (Opcional) --}}
                    <div>
                        <label for="photo" class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('ticket_media.Fotografia (Opcional)') }}</label>
                        <div class="flex items-center gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2.5">
                            <label for="photo" class="cursor-pointer rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 text-xs font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">
                                {{ __('ticket_media.Escolher ficheiro') }}
                            </label>
                            <input type="file" name="photo" id="photo" accept="image/*" class="hidden">
                            <span id="photoName" class="truncate text-xs text-[var(--text-soft)]">{{ __('ticket_media.Nenhum ficheiro selecionado') }}</span>
                        </div>
                        @error('photo')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Reportante (Opcional) --}}
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="reporter_name" class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('common.O Seu Nome (Opcional)') }}</label>
                            <input type="text" name="reporter_name" id="reporter_name" maxlength="150" value="{{ old('reporter_name') }}" placeholder="{{ __('common.Ex.: Ana Silva') }}"
                                class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                        </div>
                        <div>
                            <label for="reporter_contact" class="mb-2 block text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--text-soft)]">{{ __('common.Contacto (Opcional)') }}</label>
                            <input type="text" name="reporter_contact" id="reporter_contact" maxlength="150" value="{{ old('reporter_contact') }}" placeholder="{{ __('common.Ex.: 912 345 678') }}"
                                class="w-full rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3.5 text-sm text-[var(--text)] outline-none transition focus:border-primary focus:ring-4 focus:ring-primary/15">
                        </div>
                    </div>

                    {{-- Submeter --}}
                    <button type="submit"
                        class="ui-button ui-button--primary inline-flex w-full items-center justify-center gap-2 rounded-2xl px-4 py-4 text-sm font-black shadow-lg shadow-primary/20 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30">
                        {{ __('common.Enviar Pedido de Intervenção') }}
                    </button>

                    <p class="text-center text-[11px] leading-5 text-[var(--text-soft)]">
                        {{ __('common.Ao enviar, receberá um número de referência para acompanhar o estado da intervenção.') }}
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('photo')?.addEventListener('change', (e) => {
            const name = e.target.files?.[0]?.name;
            document.getElementById('photoName').textContent = name || '{{ __('ticket_media.Nenhum ficheiro selecionado') }}';
        });
    </script>
    @include('ui.partials.locale-modal')
</body>
</html>
