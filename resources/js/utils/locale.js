/**
 * Formatação localizada (Intl) partilhada pelo frontend.
 *
 * O objeto `window.SGM_LOCALE` é injetado pelo partial
 * `ui.partials.locale-config` (locale, moeda e sistema de unidades
 * resolvidos no servidor). Sem o partial, assume pt-PT/EUR.
 */

const cfg = window.SGM_LOCALE || {
    locale: 'pt-PT',
    currency: 'EUR',
    unit_system: 'metric',
    rtl: false,
};

export function currentLocale() {
    return cfg.locale;
}

export function currentCurrency() {
    return cfg.currency;
}

export function currentUnitSystem() {
    return cfg.unit_system;
}

export function isRtl() {
    return Boolean(cfg.rtl);
}

/**
 * Formata um número segundo o locale atual.
 */
export function formatNumber(value, options = {}) {
    const { maximumFractionDigits = 0, minimumFractionDigits = 0 } = options;
    const formatter = new Intl.NumberFormat(cfg.locale, {
        minimumFractionDigits,
        maximumFractionDigits,
    });
    return formatter.format(Number(value) || 0);
}

/**
 * Formata um montante na moeda do locale atual.
 */
export function formatCurrency(value, options = {}) {
    const { maximumFractionDigits = 2, minimumFractionDigits = 2 } = options;
    const formatter = new Intl.NumberFormat(cfg.locale, {
        style: 'currency',
        currency: cfg.currency,
        minimumFractionDigits,
        maximumFractionDigits,
    });
    return formatter.format(Number(value) || 0);
}

/**
 * Formata uma percentagem — o valor é a percentagem real (55 = "55%").
 */
export function formatPercent(value, options = {}) {
    const { maximumFractionDigits = 1 } = options;
    const formatter = new Intl.NumberFormat(cfg.locale, {
        style: 'percent',
        maximumFractionDigits,
    });
    return formatter.format((Number(value) || 0) / 100);
}

/**
 * Formata uma data (curta) segundo o locale atual. Devolve '' se inválida.
 */
export function formatDate(value) {
    const date = toDate(value);
    if (!date) return '';
    return new Intl.DateTimeFormat(cfg.locale, {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
    }).format(date);
}

/**
 * Formata data e hora segundo o locale atual. Devolve '' se inválida.
 */
export function formatDateTime(value) {
    const date = toDate(value);
    if (!date) return '';
    return new Intl.DateTimeFormat(cfg.locale, {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false,
    }).format(date);
}

function toDate(value) {
    if (!value) return null;
    const date = new Date(value);
    return Number.isNaN(date.getTime()) ? null : date;
}

/**
 * Converte unidades de medida segundo o sistema de unidades do locale atual.
 */
export function convertUnit(value, type, fromUnit = '') {
    const numValue = Number(value) || 0;
    const sys = cfg.unit_system || 'metric';
    let converted = numValue;
    let unit = fromUnit;

    switch ((type || '').toLowerCase()) {
        case 'temperature':
            if (sys === 'imperial_us' && ['c', 'celsius', '°c', ''].includes(fromUnit.toLowerCase())) {
                converted = (numValue * 9 / 5) + 32;
                unit = '°F';
            } else if (sys !== 'imperial_us' && ['f', 'fahrenheit', '°f'].includes(fromUnit.toLowerCase())) {
                converted = (numValue - 32) * 5 / 9;
                unit = '°C';
            }
            break;
        case 'distance':
        case 'length':
            const isImp = ['imperial_uk', 'imperial_us'].includes(sys);
            if (isImp && ['km', 'kilometres'].includes(fromUnit.toLowerCase())) {
                converted = numValue * 0.621371;
                unit = 'mi';
            } else if (isImp && ['m', 'meters', ''].includes(fromUnit.toLowerCase())) {
                converted = numValue * 3.28084;
                unit = 'ft';
            } else if (!isImp && ['mi', 'miles'].includes(fromUnit.toLowerCase())) {
                converted = numValue / 0.621371;
                unit = 'km';
            } else if (!isImp && ['ft', 'feet'].includes(fromUnit.toLowerCase())) {
                converted = numValue / 3.28084;
                unit = 'm';
            }
            break;
        case 'weight':
            const isImpW = ['imperial_uk', 'imperial_us'].includes(sys);
            if (isImpW && ['kg', 'kilos', ''].includes(fromUnit.toLowerCase())) {
                converted = numValue * 2.20462;
                unit = 'lbs';
            } else if (!isImpW && ['lbs', 'lb'].includes(fromUnit.toLowerCase())) {
                converted = numValue / 2.20462;
                unit = 'kg';
            }
            break;
        case 'volume':
            const isUs = sys === 'imperial_us';
            if (isUs && ['l', 'liter', ''].includes(fromUnit.toLowerCase())) {
                converted = numValue * 0.264172;
                unit = 'gal';
            } else if (!isUs && ['gal', 'gallon'].includes(fromUnit.toLowerCase())) {
                converted = numValue / 0.264172;
                unit = 'L';
            }
            break;
    }

    const formattedNum = formatNumber(converted, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    return {
        value: Number(converted.toFixed(2)),
        unit,
        formatted: `${formattedNum} ${unit}`,
    };
}
