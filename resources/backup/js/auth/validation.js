/*
|--------------------------------------------------------------------------
| Validation Module
|--------------------------------------------------------------------------
*/

const EMAIL_REGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

// Helpers de resposta
const success = () => ({ valid: true, message: '', field: null });
const failure = (message, field = null) => ({ valid: false, message, field });

/*
|--------------------------------------------------------------------------
| Regras Base
|--------------------------------------------------------------------------
*/

export function validateRequired(value, label, fieldName) {
    if (value === undefined || value === null || String(value).trim() === '') {
        return failure(`${label} é obrigatório.`, fieldName);
    }
    return success();
}

export function validateEmail(email, fieldName = 'email') {
    const required = validateRequired(email, 'Email', fieldName);
    if (!required.valid) return required;

    if (!EMAIL_REGEX.test(email)) {
        return failure('Introduza um endereço de email válido.', fieldName);
    }
    return success();
}

export function validatePassword(password, fieldName = 'password') {
    const required = validateRequired(password, 'Palavra-passe', fieldName);
    if (!required.valid) return required;

    if (password.length < 8) {
        return failure('A palavra-passe deve ter pelo menos 8 caracteres.', fieldName);
    }
    return success();
}

export function validateName(name, fieldName = 'name') {
    const required = validateRequired(name, 'Nome', fieldName);
    if (!required.valid) return required;

    if (name.trim().length < 3) {
        return failure('O nome deve ter pelo menos 3 caracteres.', fieldName);
    }
    return success();
}

export function validatePasswordConfirmation(password, confirmation, fieldName = 'password_confirmation') {
    if (password !== confirmation) {
        return failure('As palavras-passe não coincidem.', fieldName);
    }
    return success();
}

/*
|--------------------------------------------------------------------------
| Validação de Formulários (Composição)
|--------------------------------------------------------------------------
*/

export function validateLogin(data) {
    // 1. Email
    const emailRes = validateEmail(data?.email);
    if (!emailRes.valid) return emailRes;

    // 2. Password
    const passRes = validatePassword(data?.password);
    if (!passRes.valid) return passRes;

    return success();
}

export function validateRegister(data) {
    // 1. Nome
    const nameRes = validateName(data?.name);
    if (!nameRes.valid) return nameRes;

    // 2. Email
    const emailRes = validateEmail(data?.email);
    if (!emailRes.valid) return emailRes;

    // 3. Password
    const passRes = validatePassword(data?.password);
    if (!passRes.valid) return passRes;

    // 4. Confirmação
    const confirmRes = validatePasswordConfirmation(data?.password, data?.password_confirmation);
    if (!confirmRes.valid) return confirmRes;

    return success();
}
