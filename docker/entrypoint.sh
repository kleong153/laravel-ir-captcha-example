#!/bin/sh

set -e

# Check if .env file exists; if not, copy from .env.example
if [ ! -f /var/www/.env ]; then
    echo ".env file not found. Copying from .env.example..."
    cp /var/www/.env.example /var/www/.env
    php artisan key:generate
fi

# Ensure the SQLite file exists
if [ ! -f /var/www/database/database.sqlite ]; then
    echo "Creating SQLite database file..."
    touch /var/www/database/database.sqlite
fi

# Ensure storage link exists
if [ ! -L /var/www/public/storage ]; then
    echo "Creating storage symlink..."
    php artisan storage:link
fi

# Ensure proper permissions for Laravel
echo "Setting permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/database
chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/database

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Run Laravel queue worker, scheduler, or serve PHP-FPM
# For now, just run PHP-FPM
echo "Starting PHP-FPM..."
exec php-fpm
