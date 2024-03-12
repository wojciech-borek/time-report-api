FROM php:8.2-apache-buster
ENV WWW_ROOT=/var/www/
ENV APP_ENV=dev
ENV DEBIAN_FRONTEND noninteractive
ENV http_proxy 'http://proxy.tvp.pl:8080'

RUN apt-get update
RUN apt-get install -y curl cron nano git zlib1g-dev libyaml-dev libssl-dev openssl libmcrypt-dev libxml2-dev libcurl4-openssl-dev libbz2-dev libzip-dev unzip librabbitmq-dev libssh-dev supervisor
RUN pecl install yaml-2.2.2
RUN pecl install amqp

RUN docker-php-ext-install curl \
    && docker-php-ext-install soap \
    && docker-php-ext-install bz2 \
    && docker-php-ext-install opcache \
    && docker-php-ext-install zip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-enable amqp

RUN echo "date.timezone=Europe/Warsaw" > /usr/local/etc/php/conf.d/10-timezone.ini \
    && echo "memory_limit=1G" > /usr/local/etc/php/conf.d/20-memory.ini

RUN mkdir -p ${WWW_ROOT}html
RUN chown www-data:www-data -R ${WWW_ROOT}
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY docker/apache/ /etc/apache2/sites-available
RUN a2enmod rewrite

COPY docker/supervisord/supervisord.conf /etc/supervisor/conf.d/supervisord.conf


RUN mkdir -p ${WWW_ROOT}/html/var/cache
RUN mkdir -p ${WWW_ROOT}/html/var/log
RUN chmod -R 777 ${WWW_ROOT}/html/var/cache
RUN chmod -R 777 ${WWW_ROOT}/html/var/log

COPY docker/entry.sh /
RUN chmod 744 /entry.sh

VOLUME /run
EXPOSE 80
ENTRYPOINT /entry.sh
