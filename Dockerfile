FROM php:8.1-cli

COPY --from=mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions @composer gd soap \
 && docker-php-source delete \
 && rm /usr/local/bin/install-php-extensions

COPY . /usr/src/myapp

WORKDIR /usr/src/myapp

RUN composer install --no-dev --no-progress
