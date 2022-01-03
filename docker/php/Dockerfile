FROM php:7.4-fpm

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/


RUN apt-get update &&  apt-get install -y \
    gcc \
    musl-dev \
    autoconf \
    zlib1g-dev \
    zip \
    vim \
    unzip \
    wget \
    git \
    libzip-dev \
    libxml2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql bcmath zip pcntl soap


# Installing composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /app


RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist