/*
|--------------------------------------------------------------------------
| Login Module
|--------------------------------------------------------------------------
| Gestão da autenticação do utilizador com suporte a sanitização e
| prevenção de dupla submissão.
*/

import { qs, formToObject, post, saveToken } from './utils';
import { validateLogin } from './validation';
import { showToast } from './toast';
import { startLoading, stopLoading } from './loading';

/*
|--------------------------------------------------------------------------
| Inicialização
|--------------------------------------------------------------------------
*/

export function initLogin() {
    const form = qs('#loginForm');

    if (!form) {
        if (process.env.NODE_ENV === 'development') {
            console.warn('[Login] #loginForm não encontrado.');
        }
        return;
    }

    form.addEventListener('submit', submitLogin);
}

/*
|--------------------------------------------------------------------------
| Submit Handler
|--------------------------------------------------------------------------
*/

async function submitLogin(event) {
    event.preventDefault();

    const form = event.currentTarget;
    const button = qs('#loginButton', form); // Scoped query para maior performance
    const data = formToObject(form);

    // Sanitização básica
    if (data.email) data.email = data.email.trim();

    /*
    |--------------------------------------------------------------------------
    | Validação
    |--------------------------------------------------------------------------
    */
    const validation = validateLogin(data);
    if (!validation.valid) {
        showToast({
            type: 'warning',
            title: 'Validação',
            message: validation.message
        });
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Request Lifecycle
    |--------------------------------------------------------------------------
    */
    startLoading(button);
    form.disabled = true; // Desativa inputs durante o carregamento

    try {
        const response = await post('/login', {
            email: data.email,
            password: data.password,
            remember: data.remember === 'on'
        });

        if (!response.ok) {
            throw new Error(response.data.message || 'Credenciais inválidas.');
        }

        // Sucesso
        if (response.data.token) {
            saveToken(response.data.token);
        }

        showToast({
            type: 'success',
            title: 'Bem-vindo',
            message: response.data.message ?? 'Sessão iniciada com sucesso.'
        });

        // Redirecionamento seguro
        const redirect = response.data.redirect ?? '/ui';
        setTimeout(() => {
            window.location.href = redirect;
        }, 800);

    } catch (error) {
        console.error('[Login Error]:', error.message);
        showToast({
            type: 'error',
            title: 'Autenticação',
            message: error.message || 'Não foi possível contactar o servidor.'
        });

        // Reativa o formulário caso ocorra um erro
        form.disabled = false;
    } finally {
        stopLoading(button);
    }
}
