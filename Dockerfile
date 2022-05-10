ARG PHP_VERSION=8.1

FROM php:${PHP_VERSION}-cli-alpine

MAINTAINER dtoch.56@gmail.com

ARG CUSTOM_UID=1001
ARG CUSTOM_GID=1001

RUN apk add --update bash curl git shadow openssh $PHPIZE_DEPS \
    && pear channel-update pear.php.net && pecl channel-update pecl.php.net \
    && pecl install pcov ast \
    && docker-php-ext-enable pcov ast \
    && apk del $PHPIZE_DEPS \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && usermod -u $CUSTOM_UID www-data -s /bin/bash && groupmod -g $CUSTOM_GID www-data \
    && rm -rf /tmp/* /var/tmp/* /usr/share/doc/* /var/cache/apk/* \
    && chmod 0777 /var/log -R

WORKDIR /app
USER www-data
