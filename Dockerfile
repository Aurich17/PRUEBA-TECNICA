FROM php:8.1-cli

WORKDIR /var/www

COPY . /var/www

RUN docker-php-ext-install pdo pdo_mysql

RUN chmod +x /var/www/docker/entrypoint.sh

ENTRYPOINT ["/var/www/docker/entrypoint.sh"]
