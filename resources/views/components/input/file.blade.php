{{--
|--------------------------------------------------------------------------
| File Input Component
|--------------------------------------------------------------------------
|
| Campo de envio de ficheiros por arrastamento (Drag & Drop) e seleção tradicional.
| • Integração nativa com Request Validation e mensagens de erro do Laravel.
| • Sanitização robusta de IDs para campos complexos (pontos e arrays).
| • Acessibilidade WCAG avançada (drag-and-drop interativo, aria-describedby, aria-invalid).
| • Gestão de pré-visualização dinâmica (preview) com Alpine.js.
| • 100% livre de CSS ou JS inline (suporta [x-cloak]).
|
--}}

@props([
    'id' => null,
    'name' => null,
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
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'file_' . uniqid());

    // Resolução automática de erros do Laravel caso a prop error não venha preenchida
    $laravelError = $safeName ? $errors->first($safeName) : null;
    $resolvedError = $error ?? $laravelError;
    $hasError = !empty($resolvedError);

    // Definição dos IDs para conexões ARIA
    $hintId = $hint ? "{$defaultId}-hint" : null;
    $errorId = $hasError ? "{$defaultId}-error" : null;
    $describedBy = array_filter([$hintId, $errorId]);
@endphp

<div
    {{ $attributes->except(['id', 'name', 'type', 'accept', 'multiple', 'required', 'disabled'])->class([
        'ui-file',
        'ui-file--error' => $hasError,
        'ui-file--disabled' => $disabled,
    ]) }}
    x-data="{
        files: [],
        dragging: false,
        select(e) {
            if (e.target.files.length > 0) {
                this.files = Array.from(e.target.files);
            }
        },
        dropFiles(e) {
            this.dragging = false;
            if (e.dataTransfer.files.length > 0) {
                this.files = Array.from(e.dataTransfer.files);
                // Atribui de forma programática os ficheiros ao input nativo para submissão do formulário
                const dataTransfer = new DataTransfer();
                Array.from(e.dataTransfer.files).forEach(file => dataTransfer.items.add(file));
                this.$refs.input.files = dataTransfer.files;
            }
        },
        remove(index) {
            this.files.splice(index, 1);
            const dataTransfer = new DataTransfer();
            this.files.forEach(file => dataTransfer.items.add(file));
            this.$refs.input.files = dataTransfer.files;
        }
    }"
>
    @if($label)
        <label class="ui-file__label" for="{{ $defaultId }}">
            {{ $label }}
            @if($required)
                <span class="ui-file__required-marker" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div
        class="ui-file__dropzone"
        :class="{
            'ui-file__dropzone--active': dragging,
            'ui-file__dropzone--error': @js($hasError)
        }"
        @if(!$disabled)
            @dragover.prevent="dragging = true"
            @dragleave.prevent="dragging = false"
            @drop.prevent="dropFiles($event)"
            @click="$refs.input.click()"
            @keydown.enter.prevent="$refs.input.click()"
            tabindex="0"
            role="region"
            aria-label="Zona de arrastamento e seleção de ficheiros"
        @endif
    >
        <input
            x-ref="input"
            id="{{ $defaultId }}"
            @if($safeName) name="{{ $safeName }}" @endif
            type="file"
            class="ui-file__input"
            @if($accept) accept="{{ $accept }}" @endif
            @if($multiple) multiple @endif
            @if($required) required @endif
            @if($disabled) disabled @endif
            @change="select($event)"
            @if($hasError) aria-invalid="true" @endif
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
            {{ $attributes->only(['id', 'name', 'type', 'accept', 'multiple', 'required', 'disabled']) }}
        >

        <div class="ui-file__content" aria-hidden="true">
            <svg class="ui-file__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6H17a4 4 0 010 8h-1m-4-4v8m0 0l-3-3m3 3l3-3"/>
            </svg>
            <p>Arraste ficheiros ou <strong>clique para selecionar</strong></p>
            @if($accept || $maxSize)
                <small class="ui-file__meta">
                    @if($accept) Formatos: {{ $accept }} @endif
                    @if($accept && $maxSize) | @endif
                    @if($maxSize) Máx: {{ $maxSize }} @endif
                </small>
            @endif
        </div>
    </div>

    {{-- Preview List --}}
    @if($preview)
        <ul class="ui-file__preview" x-show="files.length > 0" x-cloak role="list">
            <template x-for="(file, index) in files" :key="index">
                <li class="ui-file__item">
                    <span class="ui-file__name" x-text="file.name"></span>
                    <button
                        type="button"
                        class="ui-file__remove"
                        @click.stop="remove(index)"
                        :aria-label="'Remover ficheiro ' + file.name"
                    >&times;</button>
                </li>
            </template>
        </ul>
    @endif

    {{-- Dica de Ajuda (Hint) --}}
    @if($hint && !$hasError)
        <p id="{{ $hintId }}" class="ui-file__hint">{{ $hint }}</p>
    @endif

    {{-- Mensagem de Erro do Laravel --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-file__error-message" role="alert">{{ $resolvedError }}</p>
    @endif
</div>
