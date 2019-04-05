FROM php:7.2-cli

WORKDIR /var/www/app

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev
    
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 8000
