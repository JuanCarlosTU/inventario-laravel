# Usa una imagen base de PHP con las extensiones necesarias
FROM php:8.1-apache

# Instala las extensiones necesarias
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia los archivos de tu aplicación al contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala las dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Configura los permisos
RUN chown -R www-data:www-data storage bootstrap/cache
RUN a2enmod rewrite

# Expone el puerto 80
EXPOSE 80

# Configura el DocumentRoot de Apache
RUN sed -i -e 's/html/html\/public/g' /etc/apache2/sites-available/000-default.conf
