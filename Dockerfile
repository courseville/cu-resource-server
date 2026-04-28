# Stage 1: Build Frontend Assets
FROM node:20-alpine AS frontend-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Install PHP Dependencies
FROM composer:2 AS composer-builder
WORKDIR /app
COPY composer*.json ./
RUN composer install --no-dev --no-scripts --no-autoloader --ignore-platform-reqs
COPY . .
RUN composer dump-autoload --optimize

# Stage 3: Final Application Image
FROM php:8.2-fpm-alpine
WORKDIR /var/www

# Install System Dependencies
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    libzip-dev \
    icu-dev \
    openldap-dev \
    postgresql-dev \
    oniguruma-dev \
    linux-headers

# Install PHP Extensions
RUN docker-php-ext-install \
    pdo_pgsql \
    pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    intl \
    ldap \
    opcache \
    zip

# Copy Application Code
COPY --from=composer-builder /app /var/www
COPY --from=frontend-builder /app/public/build /var/www/public/build

# Set Permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# PHP Configuration
COPY docker/php/local.ini /usr/local/etc/php/conf.d/local.ini

EXPOSE 9000
CMD ["php-fpm"]
