/**
 * Validation Rules Module
 */

export function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

export function validatePassword(password) {
    if (!password) return { isValid: false, message: 'A password é obrigatória.' };
    if (password.length < 8) return { isValid: false, message: 'A password deve ter pelo menos 8 caracteres.' };
    if (!/[a-z]/.test(password)) return { isValid: false, message: 'A password deve conter pelo menos uma letra minúscula.' };
    if (!/[A-Z]/.test(password)) return { isValid: false, message: 'A password deve conter pelo menos uma letra maiúscula.' };
    if (!/[0-9]/.test(password)) return { isValid: false, message: 'A password deve conter pelo menos um número.' };
    return { isValid: true, message: '' };
}

export function validatePasswordMatch(password, confirmation) {
    if (password !== confirmation) return { isValid: false, message: 'As passwords não coincidem.' };
    return { isValid: true, message: '' };
}

export function validateRequired(value, fieldName = 'Campo') {
    if (!value || String(value).trim() === '') return { isValid: false, message: `O campo ${fieldName} é obrigatório.` };
    return { isValid: true, message: '' };
}

export function validateMinLength(value, minLength, fieldName = 'Campo') {
    if (value && String(value).length < minLength) return { isValid: false, message: `O campo ${fieldName} deve ter pelo menos ${minLength} caracteres.` };
    return { isValid: true, message: '' };
}

export function validateMaxLength(value, maxLength, fieldName = 'Campo') {
    if (value && String(value).length > maxLength) return { isValid: false, message: `O campo ${fieldName} não pode ter mais de ${maxLength} caracteres.` };
    return { isValid: true, message: '' };
}

export function validateNumeric(value, fieldName = 'Campo') {
    if (value && isNaN(Number(value))) return { isValid: false, message: `O campo ${fieldName} deve ser um número.` };
    return { isValid: true, message: '' };
}

export function validatePositive(value, fieldName = 'Campo') {
    const numResult = validateNumeric(value, fieldName);
    if (!numResult.isValid) return numResult;
    if (value && Number(value) <= 0) return { isValid: false, message: `O campo ${fieldName} deve ser um número positivo.` };
    return { isValid: true, message: '' };
}

export function validatePhone(phone) {
    if (!phone) return { isValid: true, message: '' };
    const phoneRegex = /^(\+351)?[9][1236]\d{7}$/;
    if (!phoneRegex.test(phone.replace(/\s/g, ''))) return { isValid: false, message: 'Número de telefone inválido.' };
    return { isValid: true, message: '' };
}

export function validateURL(url) {
    if (!url) return { isValid: true, message: '' };
    try {
        new URL(url);
        return { isValid: true, message: '' };
    } catch {
        return { isValid: false, message: 'URL inválida.' };
    }
}
