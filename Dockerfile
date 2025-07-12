# === STAGE 1: Build Frontend Assets ===
FROM node:18 as builder
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

# === STAGE 2: Build the Final PHP Application ===
FROM php:8.2-apache
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    zip unzip git curl libzip-dev libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
RUN composer install --no-dev --optimize-autoloader
COPY --from=builder /app/public/build ./public/build
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY start.sh /usr/local/bin/start.sh
RUN a2enmod rewrite
RUN chmod +x /usr/local/bin/start.sh
ENTRYPOINT ["/usr/local/bin/start.sh"]