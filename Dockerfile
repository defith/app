# Utiliser l'image PHP 7.4 avec Apache comme base
FROM php:7.4-apache

# Installer l'extension PDO MySQL pour PHP
RUN docker-php-ext-install pdo pdo_mysql

# Activer le module de réécriture Apache pour prendre en charge la réécriture d'URL
RUN a2enmod rewrite

# Copier le code source de l'application dans le répertoire /var/www/html du conteneur
#COPY ./app/ /var/www/html/
#COPY ./dist/ /var/www/html/dist/

# Changer la propriété du répertoire pour permettre à Apache d'y écrire
RUN chown -R www-data:www-data /var/www/html
