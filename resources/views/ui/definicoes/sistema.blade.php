@extends('ui.layout')

@section('page_key', 'definicoes-sistema')

@php
    // Heroicons outline — same inline-SVG convention used across ui/*
    $sysIcon = [
        'computer' => '<svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/></svg>',
        'lock' => '<svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>',
        'money' => '<svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>',
        'ai' => '<svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6.75v10.5a2.25 2.25 0 002.25 2.25zm.75-12h9v9h-9v-9z"/></svg>',
        'chart' => '<svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>',
        'doc' => '<svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>',
        'key' => '<svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/></svg>',
        'mail' => '<svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>',
        'stack' => '<svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 01.9 2.7m0 0a3 3 0 01-3 3m0 3h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008zm-3 6h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008z"/></svg>',
        'gear' => '<svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124a6.52 6.52 0 01.22-.128c.332-.183.582-.495.644-.869l.214-1.28zM15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
    ];
    $groupIcons = [
        'app' => $sysIcon['computer'],
        'auth' => $sysIcon['lock'],
        'budget' => $sysIcon['money'],
        'ai' => $sysIcon['ai'],
        'analytics' => $sysIcon['chart'],
        'pagination' => $sysIcon['doc'],
        'tokens' => $sysIcon['key'],
        'notification' => $sysIcon['mail'],
        'backup' => $sysIcon['stack'],
    ];
    $autoSaveCount = collect($groups)->filter(fn ($group) => ! collect($group['fields'])->contains(fn ($field) => $field['type'] === 'text'))->count();
@endphp

@section('content')
<div class="system-settings">
    <x-ui.partials.page-header
        :title="__('messages.Configurações do Sistema')"
        :subtitle="__('messages.Altere o comportamento do sistema sem tocar nos ficheiros de configuração. As alterações são gravadas na base de dados e aplicadas a partir do próximo pedido.')"
        badge="Administração"
    />

    <dl class="system-settings__stats" aria-label="{{ __('common.Resumo') }}">
        <div class="system-settings__stat">
            <dt>{{ __('common.Grupos') }}</dt>
            <dd>{{ count($groups) }}</dd>
        </div>
        <div class="system-settings__stat">
            <dt>{{ __('ui.Guardar automático') }}</dt>
            <dd>{{ $autoSaveCount }}</dd>
        </div>
        <div class="system-settings__stat">
            <dt>{{ __('common.Campos de texto') }}</dt>
            <dd>{{ count($groups) - $autoSaveCount }}</dd>
        </div>
    </dl>

    <aside class="system-settings__intro" role="note">
        <span class="system-settings__intro-icon" aria-hidden="true">{!! $sysIcon['computer'] !!}</span>
        <p>{{ __('ui.Listas, números e interruptores guardam de imediato. Grupos com campos de texto têm um botão Guardar; cada grupo pode ser reposto aos valores originais.') }}</p>
    </aside>

    <div class="system-settings__groups">
        @foreach ($groups as $groupId => $group)
            @php
                $hasText = collect($group['fields'])->contains(fn ($field) => $field['type'] === 'text');
                $fieldCount = count($group['fields']);
            @endphp

            <section class="system-settings__group" id="group-{{ $groupId }}">
                <form data-group-form="{{ $groupId }}" action="{{ route('ui.definicoes.sistema.update') }}" method="POST" class="system-settings__group-inner">
                    @csrf

                    <div class="system-settings__group-heading">
                        <span class="system-settings__group-icon" aria-hidden="true">{!! $groupIcons[$groupId] ?? $sysIcon['gear'] !!}</span>
                        <div class="system-settings__group-titles">
                            <h2>{{ $group['label'] }}</h2>
                            <p>{{ $group['description'] }}</p>
                        </div>
                        <span class="system-settings__group-meta">
                            <span class="theme-settings__badge @if($hasText) system-settings__mode--button @else system-settings__mode--autosave @endif">
                                @if ($hasText)
                                    {{ __('ui.Botão de guardar') }}
                                @else
                                    {{ __('ui.Guardar automático') }}
                                @endif
                            </span>
                            <span class="system-settings__field-count" aria-label="{{ __('common.Opções') }}">{{ $fieldCount }}</span>
                        </span>
                    </div>

                    <div class="system-settings__fields">
                        @foreach ($group['fields'] as $key => $field)
                            @php
                                $fieldId = 'field-' . str_replace(['.', '_'], '-', $key);
                            @endphp

                            <div class="system-settings__field">
                                @if ($field['type'] !== 'bool')
                                    <label class="form-label" for="{{ $fieldId }}">{{ $field['label'] }}</label>
                                @endif

                                @if ($field['type'] === 'select')
                                    <select
                                        id="{{ $fieldId }}"
                                        name="{{ $key }}"
                                        class="form-select"
                                        data-auto-save
                                    >
                                        @foreach ($field['options'] as $optionValue => $optionLabel)
                                            <option value="{{ $optionValue }}" @selected((string) $values[$key] === (string) $optionValue)>
                                                {{ $optionLabel }}
                                            </option>
                                        @endforeach
                                    </select>
                                @elseif ($field['type'] === 'bool')
                                    <label class="system-settings__switch">
                                        <input
                                            type="checkbox"
                                            name="{{ $key }}"
                                            data-auto-save
                                            @checked((bool) $values[$key])
                                        >
                                        <span class="system-settings__switch-track" aria-hidden="true"></span>
                                        <span class="system-settings__switch-label" data-switch-label>{{ $values[$key] ? __('equipment.Ativo') : __('equipment.Inativo') }}</span>
                                    </label>
                                @else
                                    <div class="system-settings__input-wrap">
                                        <input
                                            id="{{ $fieldId }}"
                                            type="{{ in_array($field['type'], ['number', 'float'], true) ? 'number' : 'text' }}"
                                            name="{{ $key }}"
                                            class="form-control"
                                            value="{{ $values[$key] }}"
                                            @if(in_array($field['type'], ['number', 'float'], true)) data-auto-save @endif
                                            @isset($field['min']) min="{{ $field['min'] }}" @endisset
                                            @isset($field['max']) max="{{ $field['max'] }}" @endisset
                                            @isset($field['step']) step="{{ $field['step'] }}" @endisset
                                            @if($field['type'] === 'number') inputmode="numeric" @endif
                                            @if($field['type'] === 'float') inputmode="decimal" @endif
                                        >
                                        @if(in_array($field['type'], ['number', 'float'], true) && isset($field['unit']))
                                            <span class="system-settings__input-unit">{{ $field['unit'] }}</span>
                                        @endif
                                    </div>
                                @endif

                                @if (! empty($field['help']))
                                    <p class="form-help">{{ $field['help'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="system-settings__group-actions">
                        <p class="theme-settings__save-status" data-save-status role="status" aria-live="polite"></p>
                        <div class="system-settings__group-buttons">
                            @if ($hasText)
                                <button type="submit" class="ui-button ui-button--primary">
                                    {{ __('ui.Guardar') }}
                                </button>
                            @endif
                            <button type="button" class="ui-button ui-button--outline" data-reset aria-label="{{ __('common.Repor os valores predefinidos deste grupo.') }}">
                                {{ __('common.Repor') }}
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        @endforeach
    </div>
</div>
@endsection
