FROM tobi312/rpi-nginx
WORKDIR /var/www
ADD app.conf /etc/nginx/conf.d/default.conf
