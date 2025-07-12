# Use the official PHP 8.2 image with Apache web server
FROM php:8.2-apache

# Install system dependencies needed for Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql zip

# Install Composer (PHP package manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . .

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configure Apache
RUN a2enmod rewrite
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Expose port 80 and start apache
EXPOSE 80
CMD ["apache2-foreground"]