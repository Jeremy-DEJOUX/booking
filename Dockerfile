# Utiliser l'image PHP officielle
FROM php:8.2.20-fpm

# Installer les extensions nécessaires et netcat-openbsd
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libssl-dev \
    unzip \
    netcat-openbsd \
    && docker-php-ext-install zip pdo pdo_mysql sockets

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www

# Copier le code source dans le conteneur
COPY . .

# Installer les dépendances Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copier le script d'initialisation
COPY docker-entrypoint.sh /usr/local/bin/

# Donner les droits d'exécution au script d'initialisation
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]

# Exposer le port utilisé par PHP-FPM
EXPOSE 9000

# Lancer PHP-FPM par défaut
CMD ["php-fpm"]
