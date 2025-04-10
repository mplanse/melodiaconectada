# Use PHP 8.2 FPM base image
FROM php:8.2-fpm

# installar dependencias del sistema
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar composer goblalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Directorio de trabajo
WORKDIR /var/www/html

# Copia de composer.json y composer.lock para las dependencias
COPY composer.json composer.lock /var/www/html/

# Instalar dependencias de composer
RUN composer install --no-interaction --no-scripts --optimize-autoloader

# Copia de archivos de la aplicación
COPY . /var/www/html

# Generar la clave de la aplicación
RUN php artisan key:generate --force

# Permisos para el almacenamiento y caché
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 9000 para php-fpm
EXPOSE 9000
CMD ["php-fpm"]
