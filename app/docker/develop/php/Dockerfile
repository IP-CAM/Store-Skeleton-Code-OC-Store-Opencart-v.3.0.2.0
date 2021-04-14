FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libicu-dev \
        libpq-dev \
        libzip-dev \
        libwebp-dev \
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install intl pdo_mysql gd zip

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

COPY ./develop/php/config/php.ini /usr/local/etc/php/php.ini
COPY ./develop/php/entrypoint.sh /usr/local/bin/docker-php-entrypoint

RUN chmod +x /usr/local/bin/docker-php-entrypoint

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --version=1.10.19 --quiet \
    && rm -rf /root/.composer/cache

WORKDIR /app
