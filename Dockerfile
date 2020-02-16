FROM php:7.3-fpm

COPY . /var/www/html

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y --fix-missing \
    apt-utils \
    gnupg

RUN echo "deb http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list
RUN echo "deb-src http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list
RUN curl -sS --insecure https://www.dotdeb.org/dotdeb.gpg | apt-key add -

RUN apt-get update -y && apt-get install -y \
    git \
    zlib1g-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    libcurl3-dev

RUN docker-php-ext-install iconv \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install \
        zip \
        json \
        curl \
        fileinfo \
    && apt-get clean all \
    && rm -rvf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN composer install
