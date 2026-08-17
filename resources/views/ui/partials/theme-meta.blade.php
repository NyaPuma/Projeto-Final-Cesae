{{--
|--------------------------------------------------------------------------
| Theme meta (modo, tema ativo, presets)
|--------------------------------------------------------------------------
| Fornece ao JS (early-theme.js / core/theme.js) o modo claro/escuro
| autoritativo (vem do tema guardado) e a lista de presets para o botão
| de alternância trocar para o equivalente da mesma família.
| --}}
@php
    $themePresets = app(\App\Services\ThemePresetService::class);
    $themeUser = $user ?? auth()->user();
    $themeRole = $themeUser?->profile?->name ?? null;
    $themeActiveId = 'claro-laranja';
    $themeMode = 'light';

    try {
        $themeActive = $themePresets->active();
        $themeMode = $themeActive['mode'] === 'dark' ? 'dark' : 'light';
        $themeActiveId = $themeActive['id'] ?? $themeActiveId;
    } catch (\Throwable $e) {
        // theme_settings ainda não disponível (ex.: migrações por correr)
    }
@endphp
<meta name="theme-mode" content="{{ $themeMode }}">
<meta name="active-theme" content="{{ $themeActiveId }}">
@if($themeRole)
    <meta name="user-role" content="{{ $themeRole }}">
@endif
<script id="themePresetsData" type="application/json">{!! json_encode($themePresets->all()) !!}</script>
