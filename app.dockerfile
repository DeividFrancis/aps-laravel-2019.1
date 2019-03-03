
FROM php:7.2-fpm
WORKDIR /var/www
RUN apt-get update && apt-get install -y libmcrypt-dev \
    libmagickwand-dev --no-install-recommends
RUN pecl install imagick
RUN docker-php-ext-enable imagick
# RUN docker-php-ext-install mcrypt pdo_mysql
# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# RUN apt-get install php7.2-pgsql \
#     php7.2-cli \
#     php7.2-zip \
#     php7.2-mbstring \
#     php7.2-curl \
#     php7.2-json \
#     php7.2-common \
#     php7.2-xml
RUN docker-php-ext-install pdo pdo_pgsql
RUN chmod 777 -R /var/www/