FROM php:7.1-fpm

RUN docker-php-ext-install pdo_mysql \
    && useradd -ms /bin/bash symfony

USER symfony

WORKDIR /var/www/openclassrooms_course

COPY php-fpm.conf /etc/php-fpm.conf