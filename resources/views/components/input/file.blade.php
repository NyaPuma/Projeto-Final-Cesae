{{--
|--------------------------------------------------------------------------
| File Input Component (Otimizado)
|--------------------------------------------------------------------------
|
| Drag & Drop com suporte a teclado e remoção de itens.
|
--}}

@props([
    'name',
    'label' => null,
    'accept' => null,
    'multiple' => false,
    'preview' => false,
    'maxSize' => null,
    'hint' => null,
    'required' => false,
    'disabled' => false,
    'error' => null,
])

@php
    $hasError = $error || $errors->has($name);
@endphp

<div
    class="ui-file"
    x-data="{
        files: [],
        dragging: false,
        select(e) { this.files = Array.from(e.target.files); },
        remove(index) { this.files.splice(index, 1); }
    }"
>
    @if($label)
        <label class="ui-file__label" for="{{ $name }}">{{ $label }}</label>
    @endif

    <div
        class="ui-file__dropzone"
        :class="{ 'ui-file__dropzone--active': dragging, 'ui-file__dropzone--error': {{ $hasError ? 'true' : 'false' }} }"
        @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="dragging = false; files = Array.from($event.dataTransfer.files)"
        @click="$refs.input.click()"
        @keydown.enter.prevent="$refs.input.click()"
        tabindex="0"
    >
        <input
            x-ref="input"
            id="{{ $name }}"
            name="{{ $name }}"
            type="file"
            class="ui-file__input"
            accept="{{ $accept }}"
            {{ $multiple ? 'multiple' : '' }}
            @required($required)
            @disabled($disabled)
            @change="select($event)"
            {{ $attributes }}
        >

        <div class="ui-file__content">
            <svg class="ui-file__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6H17a4 4 0 010 8h-1m-4-4v8m0 0l-3-3m3 3l3-3"/>
            </svg>
            <p>Arraste ficheiros ou <strong>clique para selecionar</strong></p>
            @if($accept || $maxSize)
                <small>{{ $accept ? 'Formatos: ' . $accept : '' }} {{ $maxSize ? '| Máx: ' . $maxSize : '' }}</small>
            @endif
        </div>
    </div>

    {{-- Preview List --}}
    @if($preview)
        <ul class="ui-file__preview" x-show="files.length > 0" x-cloak>
            <template x-for="(file, index) in files" :key="index">
                <li class="ui-file__item">
                    <span x-text="file.name"></span>
                    <button type="button" @click.stop="remove(index)" aria-label="Remover ficheiro">&times;</button>
                </li>
            </template>
        </ul>
    @endif

    @if($hasError)
        <x-ui.input.error :name="$name" />
    @elseif($hint)
        <p class="ui-file__hint">{{ $hint }}</p>
    @endif
</div>
