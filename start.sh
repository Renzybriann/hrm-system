#!/bin/bash

# Set correct permissions for storage and cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Create the storage symlink (CRITICAL FOR IMAGES)
php artisan storage:link

# Run cache commands for performance and to prevent errors
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache in the foreground
apache2-foreground