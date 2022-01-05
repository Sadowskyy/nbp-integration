FROM ubuntu:20.04
ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get -y install software-properties-common
RUN add-apt-repository ppa:ondrej/php

# install nginx, php8.1 and other needed modules
RUN apt-get update && apt-get -y install curl \
    git \
    make \
    nginx \
    supervisor \
    unzip \
    wget \
    gnupg \
    gnupg1 \
    gnupg2

RUN apt-get update && apt-get -y install \
    php-common \
    php8.1-fpm \
    php8.1-cli \
    php8.1-bz2 \
    php8.1-curl \
    php8.1-intl \
    php8.1-gd \
    php8.1-mbstring \
    php8.1-mysql \
    php8.1-pgsql \
    php8.1-opcache \
    php8.1-soap \
    php8.1-xml \
    php8.1-zip \
    php8.1-apcu \
    php8.1-memcached \
    php8.1-redis \
    php8.1-xdebug \
    php8.1-yaml \
    php8.1-uuid

RUN apt-get clean && apt-get autoclean

RUN ln -s /usr/sbin/php-fpm8.1 /usr/sbin/php-fpm

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename composer
ENV COMPOSER_PROCESS_TIMEOUT=1800

RUN mkdir -p /var/log/php8
RUN mkdir -p /run/php

# add files
COPY nginx.conf        /etc/nginx/nginx.conf
COPY www.conf          /etc/php/8.1/fpm/pool.d/www.conf
COPY php.ini           /etc/php/8.1/fpm/php.ini
COPY php.ini           /etc/php/8.1/cli/php.ini
COPY nginx-phpfpm.conf /etc/supervisor/conf.d/nginx-phpfpm.conf

WORKDIR /app

EXPOSE 80

COPY . /app/

RUN composer install --no-interaction --no-dev --apcu-autoloader
RUN composer dump-autoload --no-dev --classmap-authoritative
RUN php bin/console cache:warmup --env prod --no-debug
RUN chmod -R 777 /app/var

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]