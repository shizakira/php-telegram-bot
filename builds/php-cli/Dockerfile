FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    unzip \
    libpq-dev \
    zlib1g-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /usr/src/app
