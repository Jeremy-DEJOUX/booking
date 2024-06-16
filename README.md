# Laravel API avec Docker

Ce projet est une API Laravel configurée pour fonctionner avec Docker, MySQL et RabbitMQ. Ce guide vous expliquera comment configurer et démarrer le projet.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les outils suivants sur votre machine :

-   [Docker](https://www.docker.com/get-started)
-   [Docker Compose](https://docs.docker.com/compose/install/)

## Configuration

1. **Clonez le dépôt** :

    ```sh
    git clone https://github.com/votre-utilisateur/votre-projet.git
    cd votre-projet
    ```

2. **Créez un fichier `.env`** à la racine du projet en copiant le fichier `.env.example` :

    ```sh
    cp .env.example .env
    ```

3. **Modifiez le fichier `.env`** pour configurer la base de données :

    ```env
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_password
    ```

## Démarrage du projet

Pour démarrer le projet avec Docker, suivez les étapes ci-dessous :

1. **Construisez et démarrez les conteneurs** :

    ```sh
    docker-compose up -d --build
    ```

    Cette commande construira les images Docker et démarrera les conteneurs en arrière-plan.

2. **Vérifiez les logs** pour vous assurer que tout fonctionne correctement :

    - Logs de Nginx :

        ```sh
        docker-compose logs webserver
        ```

    - Logs de l'application Laravel :

        ```sh
        docker-compose logs app
        ```

3. **Accédez à l'application** :

    Ouvrez votre navigateur et allez à l'adresse [http://localhost](http://localhost) pour accéder à l'application Laravel.

## Commandes utiles

-   **Arrêter les conteneurs** :

    ```sh
    docker-compose down
    ```

-   **Accéder au conteneur de l'application** :

    ```sh
    docker-compose exec app sh
    ```

-   **Installer les dépendances Composer** (si vous ajoutez de nouvelles dépendances) :

    ```sh
    docker-compose exec app composer install
    ```

-   **Exécuter les migrations** :

    ```sh
    docker-compose exec app php artisan migrate
    ```

-   **Exécuter les seeders** :

    ```sh
    docker-compose exec app php artisan db:seed
    ```

## Structure du projet

-   **docker-compose.yml** : Fichier de configuration Docker Compose définissant les services (app, webserver, db, rabbitmq).
-   **Dockerfile** : Fichier Docker pour construire l'image PHP avec les extensions et les outils nécessaires.
-   **docker-entrypoint.sh** : Script d'initialisation pour exécuter les migrations et les seeders au démarrage du conteneur.
-   **nginx/default.conf** : Fichier de configuration Nginx.

## Dépannage

### Erreur 502 Bad Gateway

-   Assurez-vous que le service PHP-FPM est en cours d'exécution.
-   Vérifiez les logs de Nginx et de l'application pour plus de détails sur les erreurs.

### Problèmes de connexion à la base de données

-   Assurez-vous que les informations de connexion dans le fichier `.env` sont correctes.
-   Vérifiez que le conteneur MySQL est en cours d'exécution et accessible.

## Contribuer

Les contributions sont les bienvenues ! Veuillez soumettre des pull requests ou ouvrir des issues pour discuter des améliorations potentielles.

## Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.
