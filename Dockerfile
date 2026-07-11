FROM php:8.3-apache

ENV HOME=/root

RUN apt-get update && apt-get install -y \
git curl unzip zip vim nano nodejs exiftool libpq-dev \
libzip-dev libxml2-dev libpng-dev libonig-dev \
libmemcached-dev \
libz-dev \
&& rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y openssh-server

RUN docker-php-ext-install \
exif zip xml gd mbstring pdo_mysql mysqli

RUN docker-php-ext-enable pdo_mysql mysqli

RUN pecl install memcached \
&& docker-php-ext-enable memcached


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY docker_config/web.conf /etc/apache2/sites-available/web.conf

RUN a2dissite 000-default.conf && a2ensite web.conf && a2enmod rewrite

RUN useradd -m loki247 && echo "loki247:felipe" | chpasswd

WORKDIR /var/www/html

EXPOSE 32
EXPOSE 80
