FROM nginx:1.10
WORKDIR /var/www
ADD app.conf /etc/nginx/conf.d/default.conf