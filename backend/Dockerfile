FROM php:8.2-cli

WORKDIR /app

RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng-dev curl zip

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-install opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction

EXPOSE 8000

CMD ["php","-S","0.0.0.0:8000","-t","public/"]