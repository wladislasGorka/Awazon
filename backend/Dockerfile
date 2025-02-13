FROM php:8.3-fpm-alpine

# RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-install opcache

COPY php.ini /usr/local/etc/php/php.ini