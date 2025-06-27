# Use PHP 8.1 with Apache
FROM php:8.1-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Copy source code
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Enable mod_rewrite for .htaccess
RUN a2enmod rewrite

# Allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

EXPOSE 80
