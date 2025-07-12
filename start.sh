#!/bin/bash

# Run cache commands
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set correct permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Start Apache in the foreground
apache2-foreground