/*
|--------------------------------------------------------------------------
| Password Toggle
|--------------------------------------------------------------------------
| Gestão de visibilidade de inputs de palavra-passe com foco em
| acessibilidade (A11y) e robustez.
*/

import { qsa } from './utils';

/*
|--------------------------------------------------------------------------
| Inicialização
|--------------------------------------------------------------------------
*/

export function initPasswordToggle() {
    const buttons = qsa('.password-toggle');

    if (!buttons.length) return;

    buttons.forEach(button => {
        // Assegura que o botão não submete o formulário acidentalmente
        if (button.tagName === 'BUTTON' && !button.getAttribute('type')) {
            button.setAttribute('type', 'button');
        }

        button.addEventListener('click', () => handleToggle(button));
    });
}

/*
|--------------------------------------------------------------------------
| Lógica de Toggle
|--------------------------------------------------------------------------
*/

function handleToggle(button) {
    const targetId = button.dataset.target;
    const input = document.getElementById(targetId);

    if (!input) {
        console.warn(`[PasswordToggle] Input com ID "${targetId}" não encontrado.`);
        return;
    }

    const isHidden = input.type === 'password';

    // Alterna o tipo do input
    input.type = isHidden ? 'text' : 'password';

    // Atualiza a acessibilidade e o conteúdo visual
    button.setAttribute('aria-label', isHidden ? 'Ocultar palavra-passe' : 'Mostrar palavra-passe');

    // Se quiseres manter os emojis, ótimo, mas agora o leitor de ecrã lê o aria-label
    button.textContent = isHidden ? '🙈' : '👁';

    // Opcional: Colocar o foco de volta no input após o clique (mantém a fluidez)
    input.focus();
}
