# Utilise l'image PHP avec Apache
FROM php:8.0-apache

# Active le module Apache Rewrite
RUN a2enmod rewrite

# Installe des extensions PHP supplémentaires si nécessaire
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Définit le répertoire de travail
WORKDIR /var/www/html/csv

# Change le DocumentRoot d'Apache pour pointer vers le bon dossier
RUN sed -i 's!/var/www/html!/var/www/html/csv/public!g' /etc/apache2/sites-available/000-default.conf
