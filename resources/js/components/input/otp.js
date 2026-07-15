/*
|--------------------------------------------------------------------------
| OTP Component (Otimizado)
|--------------------------------------------------------------------------
| - Input de 1 digito por campo
| - Auto-focus inteligente
| - Paste inteligente
| - Acessibilidade (A11y) preparada
*/

export default function otpComponent(config = {}) {
    return {
        length: config.length ?? 6,
        numeric: config.numeric ?? true,
        digits: Array(config.length ?? 6).fill(''),
        value: '',

        init() {
            this.sync();
        },

        // Processa input manual
        handleInput(index, event) {
            let val = event.target.value;

            if (this.numeric) {
                val = val.replace(/\D/g, '');
            }

            // Pega apenas o último caractere digitado (caso o utilizador digite algo rápido)
            val = val.slice(-1);
            this.digits[index] = val;
            this.sync();

            // Avança o foco se preenchido
            if (val && index < this.length - 1) {
                this.focusInput(index + 1);
            }
        },

        // Lida com teclas especiais
        handleKeydown(index, event) {
            switch (event.key) {
                case 'Backspace':
                    if (!this.digits[index] && index > 0) {
                        this.focusInput(index - 1);
                    }
                    break;
                case 'ArrowLeft':
                    if (index > 0) this.focusInput(index - 1);
                    break;
                case 'ArrowRight':
                    if (index < this.length - 1) this.focusInput(index + 1);
                    break;
            }
        },

        // Melhoria no Paste
        handlePaste(event) {
            event.preventDefault();
            let data = event.clipboardData.getData('text').trim();

            if (this.numeric) {
                data = data.replace(/\D/g, '');
            }

            const chars = data.split('').slice(0, this.length);

            chars.forEach((char, i) => {
                this.digits[i] = char;
            });

            this.sync();
            this.focusInput(Math.min(chars.length, this.length - 1));
        },

        // Helper para focagem via DOM
        focusInput(index) {
            this.$nextTick(() => {
                const inputs = this.$root.querySelectorAll('input[type="text"]');
                inputs[index]?.focus();
            });
        },

        sync() {
            this.value = this.digits.join('');
        }
    };
}
