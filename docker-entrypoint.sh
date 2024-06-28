#!/bin/sh

# Attendre que la base de données soit disponible
echo "Waiting for MySQL to be ready..."
while ! nc -z db 3306; do
    sleep 1
done

# Exécuter les migrations
echo "Running migrations..."
if php artisan migrate --force; then
    echo "Migrations ran successfully."
else
    echo "Migrations failed." >&2
    exit 1
fi

# Lancer PHP-FPM
echo "Starting PHP-FPM..."
exec php-fpm
