FROM php:8.1-apache

RUN apt-get update && \
    docker-php-ext-install mysqli pdo pdo_mysql && a2enmod rewrite

RUN apt-get update -y
RUN apt-get install libyaml-dev -y
RUN pecl install yaml && echo "extension=yaml.so" > /usr/local/etc/php/conf.d/ext-yaml.ini && docker-php-ext-enable yaml
RUN apt-get install -y libpng-dev libjpeg-dev && docker-php-ext-configure gd --with-jpeg && docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install opcache