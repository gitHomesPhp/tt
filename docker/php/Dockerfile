FROM php:8.0.1-fpm

RUN apt-get update && apt-get install -y --no-install-recommends apt-utils \
    git \
    curl \
    unzip \
    libpq-dev \
    build-essential \
    libssl-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN curl -Ls https://deb.nodesource.com/setup_15.x | bash -
RUN apt-get install -y nodejs && mkdir /.npm && chmod -R 777 /.npm


RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && docker-php-ext-install pdo_pgsql pgsql

COPY ./Install-composer.sh /

RUN sh /Install-composer.sh \
    && rm /Install-composer.sh

WORKDIR /app

EXPOSE 9000
