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

# === THE NEW, CRUCIAL FIX IS HERE ===
# Create the .htaccess file directly inside the container
RUN echo '<IfModule mod_rewrite.c>\n\
    <IfModule mod_negotiation.c>\n\
        Options -MultiViews -Indexes\n\
    </IfModule>\n\
    RewriteEngine On\n\
    RewriteCond %{HTTP:Authorization} .\n\
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]\n\
    RewriteCond %{REQUEST_FILENAME} !-d\n\
    RewriteCond %{REQUEST_URI} (.+)/$\n\
    RewriteRule ^ %1 [L,R=301]\n\
    RewriteCond %{REQUEST_FILENAME} !-d\n\
    RewriteCond %{REQUEST_FILENAME} !-f\n\
    RewriteRule ^ index.php [L]\n\
</IfModule>' > public/.htaccess
# === END OF THE FIX ===

# Copy the Apache config and the startup script
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY start.sh /usr/local/bin/start.sh

# Make the startup script executable
RUN chmod +x /usr/local/bin/start.sh

# Set the entrypoint to our startup script
ENTRYPOINT ["/usr/local/bin/start.sh"]