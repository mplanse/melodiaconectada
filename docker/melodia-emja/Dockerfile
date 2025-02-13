# Use PHP 8.2 FPM base image
FROM php:8.2-fpm

# Install system dependencies for Composer and Laravel
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy the composer.json and composer.lock files to install dependencies first
COPY composer.json composer.lock /var/www/html/

# Install Laravel dependencies
RUN composer install --no-autoloader --no-scripts

# Copy the rest of the application files
COPY . /var/www/html

# Run the autoloader
RUN composer dump-autoload --optimize

# Give permissions to storage and bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache

# Expose necessary ports (optional)
EXPOSE 9000
