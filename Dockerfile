FROM php:8.3-apache

# Cài các package cần thiết
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    nodejs \
    npm

# Cấu hình GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Cài PHP Extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    gd \
    zip \
    intl

# Enable Apache Rewrite
RUN a2enmod rewrite

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Cài Composer
RUN composer install --no-dev --optimize-autoloader

# Cài Node modules
RUN npm install

# Build Vite
RUN npm run build

# Quyền ghi
RUN chown -R www-data:www-data storage bootstrap/cache

# Apache config
COPY apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD php artisan storage:link || true && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force || true && \
    apache2-foreground