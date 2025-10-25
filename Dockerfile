FROM php:8.2-apache

RUN apt-get update && apt-get install -y vim

RUN echo '<Directory /var/www/html>\n    AllowOverride All\n    Require all granted\n</Directory>' >> /etc/apache2/sites-enabled/000-default.conf

RUN docker-php-ext-install mysqli

COPY . /var/www/html/

EXPOSE 80