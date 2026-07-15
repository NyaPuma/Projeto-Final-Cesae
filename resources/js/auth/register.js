/*
|--------------------------------------------------------------------------
| Register Module
|--------------------------------------------------------------------------
| Gestão do registo de novos utilizadores com feedback visual e tratamento
| de erros robusto.
*/

import { qs, formToObject, post } from './utils';
import { validateRegister } from './validation';
import { showToast } from './toast';
import { startLoading, stopLoading } from './loading';
import { activateLogin } from './tabs';

/**
 * Inicialização do módulo de Registo
 */
export function initRegister() {
    const form = qs('#registerForm');

    if (!form) return;

    form.addEventListener('submit', submitRegister);
}

/**
 * Processamento do formulário de submissão
 */
async function submitRegister(event) {
    event.preventDefault();

    const form = event.currentTarget;
    const button = qs('#registerButton');
    const data = formToObject(form);

    // 1. Validação de Frontend
    const validation = validateRegister(data);
    if (!validation.valid) {
        showToast({
            type: 'warning',
            title: 'Validação',
            message: validation.message
        });
        return;
    }

    // 2. Estado de Loading
    if (button) startLoading(button);

    try {
        const response = await post('/register', {
            name: data.name,
            email: data.email,
            password: data.password,
            password_confirmation: data.password_confirmation
        });

        // 3. Tratamento de Erros de Servidor
        if (!response.ok) {
            // Extração eficiente da primeira mensagem de erro do Laravel
            const message = response.data?.errors
                ? Object.values(response.data.errors)[0][0]
                : (response.data.message ?? 'Não foi possível criar a conta.');

            showToast({
                type: 'error',
                title: 'Registo',
                message
            });
            return;
        }

        // 4. Sucesso
        showToast({
            type: 'success',
            title: 'Conta criada',
            message: response.data.message ?? 'A sua conta foi criada com sucesso.'
        });

        form.reset();

        // 5. Transição de UX: Mudar para login após um breve delay
        setTimeout(() => {
            activateLogin();
            // Focar o campo email para facilitar o login imediato
            qs('#loginForm input[type="email"]')?.focus();
        }, 800);

    } catch (error) {
        console.error('Registration module error:', error);
        showToast({
            type: 'error',
            title: 'Erro',
            message: 'Erro de ligação ao servidor. Tente novamente.'
        });
    } finally {
        if (button) stopLoading(button);
    }
}
