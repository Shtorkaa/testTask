FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    zip unzip curl git \
    && docker-php-ext-install pdo pdo_sqlite

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-interaction --prefer-dist \
    && chmod -R 755 storage bootstrap/cache

CMD ["php-fpm"]