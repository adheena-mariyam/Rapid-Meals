FROM php:8.2-apache

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Install MySQLi extension
RUN docker-php-ext-install mysqli

# Set working directory
WORKDIR /var/www/html

# Copy all project files
COPY . .

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
