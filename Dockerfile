FROM php:8.2-apache

RUN a2enmod rewrite

RUN docker-php-ext-install pdo pdo_mysql mysqli

ENV APACHE_DOCUMENT_ROOT /var/www/html/backend/web

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
/etc/apache2/sites-available/*.conf

RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
/etc/apache2/apache2.conf

RUN echo "<Directory /var/www/html/backend/web>\n\
AllowOverride All\n\
Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf
