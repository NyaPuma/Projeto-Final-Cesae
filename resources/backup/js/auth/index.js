/*
|--------------------------------------------------------------------------
| Authentication Module Entry Point
|--------------------------------------------------------------------------
|
| Ponto de entrada centralizado do módulo de autenticação.
| Gestão de inicialização de componentes com tratamento de erros.
|
*/

import { initTabs } from './tabs';
import { initPasswordToggle } from './password';
import { initLogin } from './login';
import { initRegister } from './register';
import { initToast } from './toast';
import { initLoading } from './loading';

const initializeAuth = () => {
    // Verificar se estamos na página Auth antes de carregar dependências
    const authContainer = document.querySelector('.auth-page');
    if (!authContainer) return;

    // Lista de módulos a inicializar (fácil de expandir)
    const modules = [
        { name: 'Toast', init: initToast },
        { name: 'Loading', init: initLoading },
        { name: 'Tabs', init: initTabs },
        { name: 'PasswordToggle', init: initPasswordToggle },
        { name: 'Login', init: initLogin },
        { name: 'Register', init: initRegister }
    ];

    // Iterar e inicializar com proteção (try-catch)
    modules.forEach(({ name, init }) => {
        try {
            if (typeof init === 'function') {
                init();
            }
        } catch (error) {
            console.error(`Erro ao inicializar o módulo: ${name}`, error);
        }
    });
};

// Executar após o carregamento do DOM
document.addEventListener('DOMContentLoaded', initializeAuth);
