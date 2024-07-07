# backend/Dockerfile
FROM php:7.4-apache

# Copier les fichiers du backend dans le répertoire de l'image Docker
COPY . /var/www/html/

# Activer le module mod_rewrite pour Apache
RUN a2enmod rewrite
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf

EXPOSE 80


