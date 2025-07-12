#!/bin/bash

# Set correct permissions for storage and cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Create the storage symlink (CRITICAL FOR PROFILE PICTURES)
php artisan storage:link

# Cache configuration for performance
php artisan config:cache
php artisan route:cache

# Start Apache in the foreground
apache2-foreground