
FROM php:8.2-apache

# Copy project
COPY . /var/www/html/

# Enable Apache modules that are commonly useful
RUN a2enmod rewrite

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
