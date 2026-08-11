# ============================================================
# Stage 1: Composer dependencies
# ============================================================
FROM composer:2 AS composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts


# ============================================================
# Stage 2: Frontend build
# Node hanya digunakan ketika BUILD.
# Tidak ikut running di production.
# ============================================================
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm ci

COPY . .

RUN npm run build


# ============================================================
# Stage 3: Production PHP
# ============================================================
FROM php:8.4-fpm-alpine

WORKDIR /var/www/html

# System dependencies
RUN apk add --no-cache \
    bash \
    curl \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    mysql-client \
    unzip \
    && docker-php-ext-install \
        bcmath \
        intl \
        mbstring \
        opcache \
        pdo_mysql \
        zip

# PHP production configuration
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# OPcache configuration
RUN { \
        echo 'opcache.enable=1'; \
        echo 'opcache.enable_cli=1'; \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=16'; \
        echo 'opcache.max_accelerated_files=20000'; \
        echo 'opcache.validate_timestamps=0'; \
        echo 'opcache.revalidate_freq=0'; \
    } > /usr/local/etc/php/conf.d/opcache.ini

# PHP upload / execution settings
RUN { \
        echo 'upload_max_filesize=50M'; \
        echo 'post_max_size=50M'; \
        echo 'memory_limit=256M'; \
        echo 'max_execution_time=120'; \
    } > /usr/local/etc/php/conf.d/laravel.ini

# Copy Laravel application
COPY --chown=www-data:www-data . .

# Copy Composer dependencies from composer stage
COPY --from=composer \
    --chown=www-data:www-data \
    /app/vendor \
    ./vendor

# Copy Vite production assets
COPY --from=frontend \
    --chown=www-data:www-data \
    /app/public/build \
    ./public/build

# Laravel writable directories
RUN mkdir -p \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chown -R www-data:www-data \
        storage \
        bootstrap/cache \
    && chmod -R 775 \
        storage \
        bootstrap/cache

# Laravel production optimizations
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

EXPOSE 9000

USER www-data

CMD ["php-fpm", "-F"]
