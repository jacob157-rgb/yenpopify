# ============================================================
# Stage 1: Composer dependencies
# ============================================================
FROM composer:2 AS composer

WORKDIR /app

# GD build dependencies
RUN apk add --no-cache \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts


# ============================================================
# Stage 2: Frontend build
# ============================================================
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm ci

COPY . .

RUN npm run build


# ============================================================
# Stage 3: Production PHP-FPM
# ============================================================
FROM php:8.4-fpm-alpine

WORKDIR /var/www/html

# ------------------------------------------------------------
# Runtime + build dependencies
# ------------------------------------------------------------
RUN apk add --no-cache \
    bash \
    curl \
    freetype \
    libjpeg-turbo \
    libpng \
    icu-libs \
    libzip \
    oniguruma \
    mysql-client \
    unzip \
    && apk add --no-cache --virtual .build-deps \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        gd \
        intl \
        mbstring \
        opcache \
        pdo_mysql \
        zip \
    && apk del .build-deps

# ------------------------------------------------------------
# PHP production configuration
# ------------------------------------------------------------
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# ------------------------------------------------------------
# OPcache
# ------------------------------------------------------------
RUN { \
        echo 'opcache.enable=1'; \
        echo 'opcache.enable_cli=1'; \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=16'; \
        echo 'opcache.max_accelerated_files=20000'; \
        echo 'opcache.validate_timestamps=0'; \
        echo 'opcache.revalidate_freq=0'; \
    } > /usr/local/etc/php/conf.d/opcache.ini

# ------------------------------------------------------------
# PHP settings
# ------------------------------------------------------------
RUN { \
        echo 'upload_max_filesize=50M'; \
        echo 'post_max_size=50M'; \
        echo 'memory_limit=256M'; \
        echo 'max_execution_time=120'; \
    } > /usr/local/etc/php/conf.d/laravel.ini

# ------------------------------------------------------------
# Copy Laravel application
# ------------------------------------------------------------
COPY --chown=www-data:www-data . .

# ------------------------------------------------------------
# Copy Composer dependencies
# ------------------------------------------------------------
COPY --from=composer \
    --chown=www-data:www-data \
    /app/vendor \
    ./vendor

# ------------------------------------------------------------
# Copy Vite production build
# ------------------------------------------------------------
COPY --from=frontend \
    --chown=www-data:www-data \
    /app/public/build \
    ./public/build

# ------------------------------------------------------------
# Laravel writable directories
# ------------------------------------------------------------
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

# ------------------------------------------------------------
# Clear Laravel caches
# ------------------------------------------------------------
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

EXPOSE 9000

USER www-data

CMD ["php-fpm", "-F"]
