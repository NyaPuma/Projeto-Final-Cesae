###############################################
# Stage 1 - Frontend (Vite)
###############################################

FROM node:22.19-alpine3.22 AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm ci

COPY . .

RUN npm run build


###############################################
# Stage 2 - Composer
###############################################

FROM dunglas/frankenphp:1.9.0-php8.2 AS vendor

RUN install-php-extensions \
        bcmath \
        gd \
        intl \
        mbstring \
        opcache \
        pdo_mysql \
        pdo_sqlite \
        zip

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts

COPY . .

RUN composer dump-autoload \
    --optimize \
    --classmap-authoritative \
    --no-interaction \
    --no-scripts


###############################################
# Stage 3 - Production (FrankenPHP)
###############################################

FROM dunglas/frankenphp:1.9.0-php8.2

RUN install-php-extensions \
        bcmath \
        gd \
        intl \
        mbstring \
        opcache \
        pdo_mysql \
        pdo_sqlite \
        zip

LABEL org.opencontainers.image.title="Sistema Integrado de Gestão de Manutenção"
LABEL org.opencontainers.image.description="Projeto Final CESAE desenvolvido em Laravel 11"
LABEL org.opencontainers.image.authors="André Moreira"
LABEL org.opencontainers.image.vendor="CESAE Digital"
LABEL org.opencontainers.image.licenses="MIT"

WORKDIR /app

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV PHP_OPCACHE_ENABLE=1

COPY --from=vendor /app ./

COPY --from=frontend /app/public/build ./public/build

COPY Caddyfile /etc/caddy/Caddyfile

RUN mkdir -p \
    storage/framework/cache \
    storage/framework/views \
    storage/framework/sessions \
    storage/app/public \
    storage/logs \
    bootstrap/cache \
    && php artisan storage:link

RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

USER www-data

EXPOSE 80

HEALTHCHECK \
    --interval=30s \
    --timeout=5s \
    --start-period=20s \
    --retries=3 \
CMD wget --spider http://127.0.0.1/ || exit 1

# Run Laravel Octane in FrankenPHP worker mode (public/frankenphp-worker.php is shipped
# with the image so the www-data user never needs write access to the root-owned public/).
# --admin-port=2019 is required: with --port=80 Octane's default would compute a negative admin port.
CMD ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=80", "--admin-port=2019"]
