/**
 * Validation Utilities Module
 * Shared validation functions for forms and data
 */

/**
 * Validate email format
 * @param {string} email - Email to validate
 * @returns {boolean} True if valid email
 */
export function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Validate password strength
 * @param {string} password - Password to validate
 * @returns {Object} Validation result with isValid and message
 */
export function validatePassword(password) {
    if (!password) {
        return { isValid: false, message: 'A password é obrigatória.' };
    }
    
    if (password.length < 8) {
        return { isValid: false, message: 'A password deve ter pelo menos 8 caracteres.' };
    }
    
    if (!/[a-z]/.test(password)) {
        return { isValid: false, message: 'A password deve conter pelo menos uma letra minúscula.' };
    }
    
    if (!/[A-Z]/.test(password)) {
        return { isValid: false, message: 'A password deve conter pelo menos uma letra maiúscula.' };
    }
    
    if (!/[0-9]/.test(password)) {
        return { isValid: false, message: 'A password deve conter pelo menos um número.' };
    }
    
    return { isValid: true, message: '' };
}

/**
 * Validate password match
 * @param {string} password - Password
 * @param {string} confirmation - Password confirmation
 * @returns {Object} Validation result
 */
export function validatePasswordMatch(password, confirmation) {
    if (password !== confirmation) {
        return { isValid: false, message: 'As passwords não coincidem.' };
    }
    return { isValid: true, message: '' };
}

/**
 * Validate required field
 * @param {string} value - Field value
 * @param {string} fieldName - Field name for error message
 * @returns {Object} Validation result
 */
export function validateRequired(value, fieldName = 'Campo') {
    if (!value || String(value).trim() === '') {
        return { isValid: false, message: `O campo ${fieldName} é obrigatório.` };
    }
    return { isValid: true, message: '' };
}

/**
 * Validate minimum length
 * @param {string} value - Field value
 * @param {number} minLength - Minimum length
 * @param {string} fieldName - Field name for error message
 * @returns {Object} Validation result
 */
export function validateMinLength(value, minLength, fieldName = 'Campo') {
    if (value && String(value).length < minLength) {
        return { isValid: false, message: `O campo ${fieldName} deve ter pelo menos ${minLength} caracteres.` };
    }
    return { isValid: true, message: '' };
}

/**
 * Validate maximum length
 * @param {string} value - Field value
 * @param {number} maxLength - Maximum length
 * @param {string} fieldName - Field name for error message
 * @returns {Object} Validation result
 */
export function validateMaxLength(value, maxLength, fieldName = 'Campo') {
    if (value && String(value).length > maxLength) {
        return { isValid: false, message: `O campo ${fieldName} não pode ter mais de ${maxLength} caracteres.` };
    }
    return { isValid: true, message: '' };
}

/**
 * Validate numeric value
 * @param {string} value - Field value
 * @param {string} fieldName - Field name for error message
 * @returns {Object} Validation result
 */
export function validateNumeric(value, fieldName = 'Campo') {
    if (value && isNaN(Number(value))) {
        return { isValid: false, message: `O campo ${fieldName} deve ser um número.` };
    }
    return { isValid: true, message: '' };
}

/**
 * Validate positive number
 * @param {string} value - Field value
 * @param {string} fieldName - Field name for error message
 * @returns {Object} Validation result
 */
export function validatePositive(value, fieldName = 'Campo') {
    const numResult = validateNumeric(value, fieldName);
    if (!numResult.isValid) return numResult;
    
    if (value && Number(value) <= 0) {
        return { isValid: false, message: `O campo ${fieldName} deve ser um número positivo.` };
    }
    return { isValid: true, message: '' };
}

/**
 * Validate phone number (Portugal format)
 * @param {string} phone - Phone number to validate
 * @returns {Object} Validation result
 */
export function validatePhone(phone) {
    if (!phone) return { isValid: true, message: '' };
    
    const phoneRegex = /^(\+351)?[9][1236]\d{7}$/;
    if (!phoneRegex.test(phone.replace(/\s/g, ''))) {
        return { isValid: false, message: 'Número de telefone inválido.' };
    }
    return { isValid: true, message: '' };
}

/**
 * Validate URL format
 * @param {string} url - URL to validate
 * @returns {Object} Validation result
 */
export function validateURL(url) {
    if (!url) return { isValid: true, message: '' };
    
    try {
        new URL(url);
        return { isValid: true, message: '' };
    } catch {
        return { isValid: false, message: 'URL inválida.' };
    }
}

/**
 * Validate date format (YYYY-MM-DD)
 * @param {string} date - Date string to validate
 * @returns {Object} Validation result
 */
export function validateDate(date) {
    if (!date) return { isValid: true, message: '' };
    
    const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
    if (!dateRegex.test(date)) {
        return { isValid: false, message: 'Data inválida. Use o formato YYYY-MM-DD.' };
    }
    
    const parsedDate = new Date(date);
    if (isNaN(parsedDate.getTime())) {
        return { isValid: false, message: 'Data inválida.' };
    }
    
    return { isValid: true, message: '' };
}

/**
 * Validate date range (start before end)
 * @param {string} startDate - Start date
 * @param {string} endDate - End date
 * @returns {Object} Validation result
 */
export function validateDateRange(startDate, endDate) {
    if (!startDate || !endDate) return { isValid: true, message: '' };
    
    const start = new Date(startDate);
    const end = new Date(endDate);
    
    if (start >= end) {
        return { isValid: false, message: 'A data de início deve ser anterior à data de fim.' };
    }
    
    return { isValid: true, message: '' };
}

/**
 * Validate file size
 * @param {File} file - File to validate
 * @param {number} maxSizeMB - Maximum size in MB
 * @returns {Object} Validation result
 */
export function validateFileSize(file, maxSizeMB = 5) {
    if (!file) return { isValid: true, message: '' };
    
    const maxSizeBytes = maxSizeMB * 1024 * 1024;
    if (file.size > maxSizeBytes) {
        return { isValid: false, message: `O ficheiro não pode ter mais de ${maxSizeMB}MB.` };
    }
    
    return { isValid: true, message: '' };
}

/**
 * Validate file type
 * @param {File} file - File to validate
 * @param {string[]} allowedTypes - Array of allowed MIME types
 * @returns {Object} Validation result
 */
export function validateFileType(file, allowedTypes = []) {
    if (!file) return { isValid: true, message: '' };
    
    if (!allowedTypes.includes(file.type)) {
        return { isValid: false, message: `Tipo de ficheiro não permitido. Tipos permitidos: ${allowedTypes.join(', ')}.` };
    }
    
    return { isValid: true, message: '' };
}

/**
 * Validate NIF (Portuguese tax ID)
 * @param {string} nif - NIF to validate
 * @returns {Object} Validation result
 */
export function validateNIF(nif) {
    if (!nif) return { isValid: true, message: '' };
    
    const nifRegex = /^\d{9}$/;
    if (!nifRegex.test(nif)) {
        return { isValid: false, message: 'NIF inválido. Deve ter 9 dígitos.' };
    }
    
    // Validate NIF checksum
    let sum = 0;
    for (let i = 0; i < 8; i++) {
        sum += parseInt(nif[i]) * (9 - i);
    }
    const remainder = sum % 11;
    const checkDigit = remainder < 2 ? 0 : 11 - remainder;
    
    if (parseInt(nif[8]) !== checkDigit) {
        return { isValid: false, message: 'NIF inválido.' };
    }
    
    return { isValid: true, message: '' };
}

/**
 * Validate form fields
 * @param {Object} fields - Object with field values and validation rules
 * @returns {Object} Validation result with isValid and errors object
 */
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

/**
 * Sanitize HTML to prevent XSS
 * @param {string} html - HTML to sanitize
 * @returns {string} Sanitized HTML
 */
export function sanitizeHTML(html) {
    const temp = document.createElement('div');
    temp.textContent = html;
    return temp.innerHTML;
}

/**
 * Escape special characters for regex
 * @param {string} string - String to escape
 * @returns {string} Escaped string
 */
export function escapeRegex(string) {
    return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}

/**
 * Trim and validate string
 * @param {string} value - String to validate
 * @param {Object} options - Validation options
 * @returns {Object} Validation result
 */
export function validateString(value, options = {}) {
    const {
        required = false,
        minLength = null,
        maxLength = null,
        fieldName = 'Campo'
    } = options;
    
    const trimmed = String(value || '').trim();
    
    if (required && !trimmed) {
        return { isValid: false, message: `O campo ${fieldName} é obrigatório.` };
    }
    
    if (minLength && trimmed.length < minLength) {
        return { isValid: false, message: `O campo ${fieldName} deve ter pelo menos ${minLength} caracteres.` };
    }
    
    if (maxLength && trimmed.length > maxLength) {
        return { isValid: false, message: `O campo ${fieldName} não pode ter mais de ${maxLength} caracteres.` };
    }
    
    return { isValid: true, message: '' };
}
