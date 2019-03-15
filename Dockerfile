FROM php:7.2-apache
RUN a2enmod rewrite
COPY --chown=www-data:www-data 000-default.conf /etc/apache2/sites-available/
COPY --chown=www-data:www-data src/ /var/www/html/