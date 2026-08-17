@extends('ui.layout')

@section('page_key', 'definicoes-sistema')

@php
    $groupIcons = [
        'app' => '🖥️',
        'auth' => '🔐',
        'budget' => '💰',
        'ai' => '🤖',
        'analytics' => '📈',
        'pagination' => '📄',
        'tokens' => '🔑',
        'notification' => '📧',
        'backup' => '🗄️',
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
        <span class="system-settings__intro-icon" aria-hidden="true">💡</span>
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
                        <span class="system-settings__group-icon" aria-hidden="true">{{ $groupIcons[$groupId] ?? '⚙️' }}</span>
                        <div class="system-settings__group-titles">
                            <h3>{{ $group['label'] }}</h3>
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
                            <span class="system-settings__field-count" title="{{ __('common.Opções') }}">{{ $fieldCount }}</span>
                        </span>
                    </div>

                    <div class="system-settings__fields">
                        @foreach ($group['fields'] as $key => $field)
                            @php
                                $fieldId = 'field-' . str_replace(['.', '_'], '-', $key);
                            @endphp

                            <div class="system-settings__field">
                                <label class="form-label" for="{{ $fieldId }}">{{ $field['label'] }}</label>

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
                            <button type="button" class="ui-button ui-button--outline" data-reset title="{{ __('common.Repor os valores predefinidos deste grupo.') }}">
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
