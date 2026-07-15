{{--
|--------------------------------------------------------------------------
| OTP Input Component (Otimizado)
|--------------------------------------------------------------------------
|
| Input de código OTP com suporte a teclado, paste e a11y.
|
--}}

@props([
    'name',
    'length' => 6,
    'numeric' => true,
    'disabled' => false,
    'readonly' => false,
])

@php
    $hasError = $errors->has($name);
@endphp

<div
    class="ui-otp {{ $hasError ? 'ui-otp--error' : '' }}"
    x-data="otpComponent({ length: {{ $length }}, numeric: @js($numeric) })"
    x-init="init()"
>
    <input type="hidden" name="{{ $name }}" x-model="value">

    <div class="ui-otp__group" role="group" aria-label="Código de verificação">
        <template x-for="(digit, index) in digits" :key="index">
            <input
                type="text"
                class="ui-otp__input"
                maxlength="1"
                :inputmode="numeric ? 'numeric' : 'text'"
                autocomplete="one-time-code"
                aria-label="Dígito ${index + 1} de {{ $length }}"
                x-model="digits[index]"
                @input="handleInput(index, $event)"
                @keydown="handleKeyDown(index, $event)"
                @paste="handlePaste($event)"
                @focus="$event.target.select()"
                x-bind:disabled="{{ $disabled ? 'true' : 'false' }}"
                x-bind:readonly="{{ $readonly ? 'true' : 'false' }}"
            >
        </template>
    </div>
</div>

<script>
function otpComponent(config) {
    return {
        length: config.length,
        numeric: config.numeric,
        digits: Array(config.length).fill(''),
        value: '',

        init() {
            // Inicializa se já houver um valor (ex: após erro de validação do Laravel)
            let old = '{{ old($name) }}';
            if (old) {
                this.digits = old.split('').slice(0, this.length);
                this.sync();
            }
        },

        handleInput(index, event) {
            let val = event.target.value;
            if (this.numeric) val = val.replace(/\D/g, '');

            this.digits[index] = val.slice(-1);
            this.sync();

            // Move foco para frente se preencheu
            if (val && event.target.nextElementSibling) {
                event.target.nextElementSibling.focus();
            }
        },

        handleKeyDown(index, event) {
            if (event.key === "Backspace" && !this.digits[index] && event.target.previousElementSibling) {
                event.target.previousElementSibling.focus();
            }
            if (event.key === "ArrowLeft" && event.target.previousElementSibling) {
                event.target.previousElementSibling.focus();
            }
            if (event.key === "ArrowRight" && event.target.nextElementSibling) {
                event.target.nextElementSibling.focus();
            }
        },

        handlePaste(event) {
            event.preventDefault();
            let pasteData = event.clipboardData.getData('text').trim();
            if (this.numeric) pasteData = pasteData.replace(/\D/g, '');

            const chars = pasteData.split('').slice(0, this.length);
            chars.forEach((char, index) => {
                this.digits[index] = char;
            });
            this.sync();
        },

        sync() {
            this.value = this.digits.join('');
        }
    }
}
</script>
