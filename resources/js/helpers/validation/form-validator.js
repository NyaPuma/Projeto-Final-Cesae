/**
 * Form Validator & Data Utilities Module
 */

export function validateDate(date) {
    if (!date) return { isValid: true, message: '' };
    const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
    if (!dateRegex.test(date)) return { isValid: false, message: 'Data inválida. Use o formato YYYY-MM-DD.' };
    const parsedDate = new Date(date);
    if (isNaN(parsedDate.getTime())) return { isValid: false, message: 'Data inválida.' };
    return { isValid: true, message: '' };
}

export function validateDateRange(startDate, endDate) {
    if (!startDate || !endDate) return { isValid: true, message: '' };
    const start = new Date(startDate);
    const end = new Date(endDate);
    if (start >= end) return { isValid: false, message: 'A data de início deve ser anterior à data de fim.' };
    return { isValid: true, message: '' };
}

export function validateFileSize(file, maxSizeMB = 5) {
    if (!file) return { isValid: true, message: '' };
    const maxSizeBytes = maxSizeMB * 1024 * 1024;
    if (file.size > maxSizeBytes) return { isValid: false, message: `O ficheiro não pode ter mais de ${maxSizeMB}MB.` };
    return { isValid: true, message: '' };
}

export function validateFileType(file, allowedTypes = []) {
    if (!file) return { isValid: true, message: '' };
    if (!allowedTypes.includes(file.type)) return { isValid: false, message: `Tipo de ficheiro não permitido. Tipos permitidos: ${allowedTypes.join(', ')}.` };
    return { isValid: true, message: '' };
}

export function validateNIF(nif) {
    if (!nif) return { isValid: true, message: '' };
    const nifRegex = /^\d{9}$/;
    if (!nifRegex.test(nif)) return { isValid: false, message: 'NIF inválido. Deve ter 9 dígitos.' };
    let sum = 0;
    for (let i = 0; i < 8; i++) sum += parseInt(nif[i]) * (9 - i);
    const remainder = sum % 11;
    const checkDigit = remainder < 2 ? 0 : 11 - remainder;
    if (parseInt(nif[8]) !== checkDigit) return { isValid: false, message: 'NIF inválido.' };
    return { isValid: true, message: '' };
}

export function validateForm(fields) {
    const errors = {};
    let isValid = true;
    Object.entries(fields).forEach(([fieldName, config]) => {
        const { value, rules } = config;
        for (const rule of rules) {
            const result = rule(value, fieldName);
            if (!result.isValid) {
                errors[fieldName] = result.message;
                isValid = false;
                break;
            }
        }
    });
    return { isValid, errors };
}

export function sanitizeHTML(html) {
    const temp = document.createElement('div');
    temp.textContent = html;
    return temp.innerHTML;
}

export function escapeRegex(string) {
    return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}

export function validateString(value, options = {}) {
    const { required = false, minLength = null, maxLength = null, fieldName = 'Campo' } = options;
    const trimmed = String(value || '').trim();
    if (required && !trimmed) return { isValid: false, message: `O campo ${fieldName} é obrigatório.` };
    if (minLength && trimmed.length < minLength) return { isValid: false, message: `O campo ${fieldName} deve ter pelo menos ${minLength} caracteres.` };
    if (maxLength && trimmed.length > maxLength) return { isValid: false, message: `O campo ${fieldName} não pode ter mais de ${maxLength} caracteres.` };
    return { isValid: true, message: '' };
}
