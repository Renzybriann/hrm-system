# === STAGE 1: Build Frontend Assets ===
# Use a Node.js image as a temporary builder
FROM node:18 as builder

# Set the working directory
WORKDIR /app

# Copy package files and install dependencies
COPY package.json package-lock.json ./
RUN npm install

# Copy the rest of the frontend source code
COPY . .

# Build the frontend assets
RUN npm run build


# === STAGE 2: Build the Final PHP Application ===
# Use the official PHP 8.2 image with Apache
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

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy application source code (excluding node_modules)
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy the compiled assets from the "builder" stage
COPY --from=builder /app/public/build ./public/build

# Copy the Apache config and the startup script
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY start.sh /usr/local/bin/start.sh

# Enable the Apache rewrite module
RUN a2enmod rewrite

# Make the startup script executable
RUN chmod +x /usr/local/bin/start.sh

# Set the entrypoint to our startup script
ENTRYPOINT ["/usr/local/bin/start.sh"]