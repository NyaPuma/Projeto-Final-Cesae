{{--
|--------------------------------------------------------------------------
| OTP Input Component
|--------------------------------------------------------------------------
|
| Input de código OTP com suporte completo a teclado, navegação por setas, paste e A11y.
| • 100% livre de CSS ou JS inline (lógica Alpine encapsulada via x-data).
| • Sanitização robusta de IDs para campos complexos (pontos e arrays).
| • Gestão dinâmica de estados de erro e recuperação com old input do Laravel.
| • Acessibilidade WCAG avançada (aria-invalid, aria-describedby, aria-label descritivo).
|
--}}

@props([
    'id' => null,
    'name' => null,
    'length' => 6,
    'numeric' => true,
    'disabled' => false,
    'readonly' => false,
    'hint' => null,
    'error' => null,
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'otp_' . uniqid());

    // Resolução automática de erros do Laravel caso a prop error não venha preenchida
    $laravelError = $safeName ? $errors->first($safeName) : null;
    $resolvedError = $error ?? $laravelError;
    $hasError = !empty($resolvedError);

    // Definição dos IDs para conexões ARIA
    $hintId = $hint ? "{$defaultId}-hint" : null;
    $errorId = $hasError ? "{$defaultId}-error" : null;
    $describedBy = array_filter([$hintId, $errorId]);

    // Recuperação de valor prévio via old input do Laravel
    $initialValue = $safeName ? old($safeName, '') : '';
@endphp

<div
    {{ $attributes->except(['id', 'name', 'type', 'length', 'numeric', 'disabled', 'readonly'])->class([
        'ui-otp',
        'ui-otp--error' => $hasError,
        'ui-otp--disabled' => $disabled,
        'ui-otp--readonly' => $readonly,
    ]) }}
    x-data="{
        length: @js((int)$length),
        numeric: @js((bool)$numeric),
        disabled: @js((bool)$disabled),
        readonly: @js((bool)$readonly),
        digits: [],
        value: @js($initialValue),
        init() {
            // Inicializa matriz de dígitos com base no old input ou vazio
            let initial = @js($initialValue);
            if (initial) {
                this.digits = initial.toString().split('').slice(0, this.length);
            }
            while (this.digits.length < this.length) {
                this.digits.push('');
            }
            this.sync();
        },
        handleInput(index, event) {
            if (this.disabled || this.readonly) return;
            let val = event.target.value;
            if (this.numeric) {
                val = val.replace(/\D/g, '');
            }
            this.digits[index] = val.slice(-1);
            this.sync();

            // Avança o foco automaticamente se o campo foi preenchido
            if (val && event.target.nextElementSibling && event.target.nextElementSibling.tagName === 'INPUT') {
                event.target.nextElementSibling.focus();
            }
        },
        handleKeyDown(index, event) {
            if (this.disabled) return;

            if (event.key === 'Backspace') {
                if (!this.digits[index] && event.target.previousElementSibling && event.target.previousElementSibling.tagName === 'INPUT') {
                    event.target.previousElementSibling.focus();
                } else {
                    this.digits[index] = '';
                    this.sync();
                }
            } else if (event.key === 'ArrowLeft' && event.target.previousElementSibling && event.target.previousElementSibling.tagName === 'INPUT') {
                event.target.previousElementSibling.focus();
            } else if (event.key === 'ArrowRight' && event.target.nextElementSibling && event.target.nextElementSibling.tagName === 'INPUT') {
                event.target.nextElementSibling.focus();
            }
        },
        handlePaste(event) {
            if (this.disabled || this.readonly) return;
            event.preventDefault();
            let pasteData = (event.clipboardData || window.clipboardData).getData('text').trim();
            if (this.numeric) {
                pasteData = pasteData.replace(/\D/g, '');
            }
            const chars = pasteData.split('').slice(0, this.length);
            chars.forEach((char, idx) => {
                if (idx < this.length) {
                    this.digits[idx] = char;
                }
            });
            this.sync();

            // Foco no último input preenchido ou no seguinte
            const nextIndex = Math.min(chars.length, this.length - 1);
            this.$nextTick(() => {
                const inputs = this.$el.querySelectorAll('input.ui-otp__input');
                if (inputs[nextIndex]) {
                    inputs[nextIndex].focus();
                }
            });
        },
        sync() {
            this.value = this.digits.join('');
        }
    }"
    x-init="init()"
>
    @if($safeName)
        <input type="hidden" name="{{ $safeName }}" x-model="value">
    @endif

    <div
        class="ui-otp__group"
        role="group"
        aria-label="Código de verificação de {{ $length }} dígitos"
        @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
    >
        <template x-for="(digit, index) in digits" :key="index">
            <input
                type="text"
                class="ui-otp__input"
                maxlength="1"
                :inputmode="numeric ? 'numeric' : 'text'"
                autocomplete="one-time-code"
                :aria-label="'Dígito ' + (index + 1) + ' de ' + length"
                x-model="digits[index]"
                @input="handleInput(index, $event)"
                @keydown="handleKeyDown(index, $event)"
                @paste="handlePaste($event)"
                @focus="$event.target.select()"
                :disabled="disabled"
                :readonly="readonly"
                @if($hasError) aria-invalid="true" @else aria-invalid="false" @endif
            >
        </template>
    </div>

    {{-- Dica de Ajuda (Hint) --}}
    @if($hint && !$hasError)
        <p id="{{ $hintId }}" class="ui-otp__hint">{{ $hint }}</p>
    @endif

    {{-- Mensagem de Erro do Laravel --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-otp__error-message" role="alert">{{ $resolvedError }}</p>
    @endif
</div>
