/*
|--------------------------------------------------------------------------
| Password Strength Component
|--------------------------------------------------------------------------
| - Requisitos validados em tempo real (comprimento, maiúsculas/minúsculas, símbolo/número)
| - Indicador visual de força com 3 segmentos (Fraca / Média / Forte)
| - Acessibilidade: aria-valuenow progressivo na barra
*/

export default function passwordStrengthComponent() {
    return {
        password: '',

        get lengthOk() {
            return this.password.length >= 8;
        },

        get caseOk() {
            return /[a-z]/.test(this.password) && /[A-Z]/.test(this.password);
        },

        get symbolNumberOk() {
            return /\d/.test(this.password) || /[^a-zA-Z0-9]/.test(this.password);
        },

        get score() {
            return [this.lengthOk, this.caseOk, this.symbolNumberOk].filter(Boolean).length;
        },

        get level() {
            if (this.score <= 1) {
                return 'weak';
            }

            if (this.score === 2) {
                return 'medium';
            }

            return 'strong';
        },

        get barColor() {
            if (this.score <= 1) {
                return 'bg-rose-500';
            }

            if (this.score === 2) {
                return 'bg-amber-500';
            }

            return 'bg-emerald-500';
        },

        get levelLabel() {
            const labels = {
                weak: 'Fraca',
                medium: 'Média',
                strong: 'Forte',
            };

            return labels[this.level];
        },

        get levelClass() {
            if (this.level === 'weak') {
                return 'text-rose-500';
            }

            if (this.level === 'medium') {
                return 'text-amber-500';
            }

            return 'text-emerald-600 dark:text-emerald-400';
        },
    };
}
