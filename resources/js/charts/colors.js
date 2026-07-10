/*
|--------------------------------------------------------------------------
| Dashboard Color Palette
|--------------------------------------------------------------------------
|
| Paleta oficial da aplicação.
| Todas as páginas deverão utilizar estas cores.
|
*/

export const COLORS = {

    primary: "#3B82F6",

    success: "#22C55E",

    warning: "#F59E0B",

    danger: "#EF4444",

    info: "#06B6D4",

    purple: "#8B5CF6",

    pink: "#EC4899",

    gray: "#94A3B8",

    slate: "#64748B",

    surface: "#F8FAFC"

};

/*
|--------------------------------------------------------------------------
| Estado dos Tickets
|--------------------------------------------------------------------------
*/

export const STATUS = {

    OPEN: COLORS.primary,

    IN_PROGRESS: COLORS.warning,

    WAITING: COLORS.purple,

    CLOSED: COLORS.success,

    CANCELLED: COLORS.danger

};

/*
|--------------------------------------------------------------------------
| Equipamentos
|--------------------------------------------------------------------------
*/

export const EQUIPMENT = {

    OPERATIONAL: COLORS.success,

    MAINTENANCE: COLORS.info,

    BROKEN: COLORS.warning,

    INACTIVE: COLORS.danger

};
