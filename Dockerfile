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

FROM composer:2.8 AS vendor

RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

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
    --classmap-authoritative


###############################################
# Stage 3 - Production (FrankenPHP)
###############################################

FROM dunglas/frankenphp:1.9.0-php8.2

LABEL org.opencontainers.image.title="Sistema Integrado de Gestão de Manutenção"
LABEL org.opencontainers.image.description="Projeto Final CESAE desenvolvido em Laravel 11"
LABEL org.opencontainers.image.authors="André Moreira"
LABEL org.opencontainers.image.vendor="CESAE Digital"
LABEL org.opencontainers.image.licenses="MIT"

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && rm -rf /var/lib/apt/lists/*

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
    storage/logs \
    bootstrap/cache

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

CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
