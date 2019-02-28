
FROM php:7.2-fpm
WORKDIR /var/www/
RUN apt-get update && apt-get install -y libmcrypt-dev \
    libmagickwand-dev --no-install-recommends
RUN pecl install imagick
RUN docker-php-ext-enable imagick
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN docker-php-ext-install pdo pdo_pgsql
RUN chmod -x /var/www/
# CMD [ "chmod", "777", "-R", "/var/www/" ]