FROM php:8.0.1-fpm

RUN apt-get update && apt-get install -y --no-install-recommends apt-utils \
    git \
    curl \
    unzip \
    libpq-dev

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && docker-php-ext-install pdo_pgsql pgsql

COPY ./Install-composer.sh /

RUN sh /Install-composer.sh \
    && rm /Install-composer.sh

EXPOSE 9000
