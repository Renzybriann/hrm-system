#!/bin/bash

# Set correct permissions for storage and cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Start Apache in the foreground
apache2-foreground