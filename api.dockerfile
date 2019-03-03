
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
<<<<<<< HEAD:app.dockerfile
RUN chmod 777 -R /var/www/
=======
RUN chmod -R 777 /var/www
>>>>>>> 5af1e439b469e187e7c4f0447e5a0d824795e68d:api.dockerfile
