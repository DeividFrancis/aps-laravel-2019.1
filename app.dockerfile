
FROM php:7.2-fpm
WORKDIR /var/www
RUN apt-get update && apt-get install -y libmcrypt-dev \
    mysql-client libmagickwand-dev --no-install-recommends
RUN pecl install imagick
RUN docker-php-ext-enable imagick
# RUN docker-php-ext-install mcrypt pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql
RUN chmod 777 -R /var/www