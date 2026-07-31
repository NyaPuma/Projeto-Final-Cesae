// Inicialização do ecossistema Swagger UI + disparo de utilitários
window.onload = function () {
    const urls = [];

    // URLs vindas do Blade (serão injetadas em runtime)
    window.SWAGGER_L5_URLS = window.SWAGGER_L5_URLS || urls;

    const ui = SwaggerUIBundle({
        dom_id: '#swagger-ui',
        urls: window.SWAGGER_L5_URLS,
        "urls.primaryName": window.SWAGGER_L5_PRIMARY_NAME || "",

        operationsSorter: window.SWAGGER_L5_OPERATIONS_SORTER ?? null,
        configUrl: window.SWAGGER_L5_CONFIG_URL ?? null,
        validatorUrl: window.SWAGGER_L5_VALIDATOR_URL ?? null,

        oauth2RedirectUrl: window.SWAGGER_L5_OAUTH2_REDIRECT_URL ?? null,

        requestInterceptor: function (request) {
            request.headers['X-CSRF-TOKEN'] = window.SWAGGER_L5_CSRF_TOKEN;
            return request;
        },

        presets: [
            SwaggerUIBundle.presets.apis,
            SwaggerUIStandalonePreset
        ],

        plugins: [
            SwaggerUIBundle.plugins.DownloadUrl
        ],

        layout: "StandaloneLayout",
        docExpansion: window.SWAGGER_L5_DOC_EXPANSION || "none",

        deepLinking: true,
        filter: window.SWAGGER_L5_FILTER || false,
        persistAuthorization: window.SWAGGER_L5_PERSIST_AUTH || "false",
    });

    window.ui = ui;

    setTimeout(() => {
        if (typeof window.createSearch === 'function') window.createSearch();
        if (typeof window.addEndpointBadges === 'function') window.addEndpointBadges();
        if (typeof window.addCounters === 'function') window.addCounters();
        if (typeof window.createExpandButtons === 'function') window.createExpandButtons();
        if (typeof window.createScrollButton === 'function') window.createScrollButton();
    }, 600);

    if (window.SWAGGER_L5_HAS_OAUTH2_INIT === true && typeof ui.initOAuth === 'function') {
        ui.initOAuth({
            usePkceWithAuthorizationCodeGrant: window.SWAGGER_L5_USE_PKCE ?? false
        });
    }
};
