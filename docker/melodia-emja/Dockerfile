# Use PHP 8.2 FPM base image
FROM php:8.2-fpm

# Install system dependencies for Composer and Laravel
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

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy the composer.json and composer.lock files to install dependencies first
COPY composer.json composer.lock /var/www/html/

# Install Laravel dependencies
RUN composer install --no-interaction --no-scripts --optimize-autoloader

# Copy the rest of the application files
COPY . /var/www/html

# Generate the application key
RUN php artisan key:generate --force

# Set permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000
CMD ["php-fpm"]
