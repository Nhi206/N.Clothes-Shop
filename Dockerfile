FROM php:8.3-apache

# ==========================
# Install packages
# ==========================
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    ca-certificates \
    openssl \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# ==========================
# PHP Extensions
# ==========================
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    gd \
    zip \
    intl

# ==========================
# Apache
# ==========================
RUN a2enmod rewrite

# ==========================
# Composer
# ==========================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy source
COPY . .

# ==========================
# Verify TiDB SSL Certificate
# ==========================
RUN ls -l storage/certs
RUN cat storage/certs/isrgrootx1.pem | head -5

# ==========================
# Debug PHP
# ==========================
RUN php -v
RUN php -m
RUN php -i | grep -i openssl || true
RUN php -i | grep -i mysql || true
RUN php -r "var_dump(extension_loaded('pdo_mysql'));"
RUN php -r "var_dump(PDO::getAvailableDrivers());"

# ==========================
# Install Composer
# ==========================
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# ==========================
# Build Vite
# ==========================
RUN npm install
RUN npm run build

# ==========================
# Storage Permission
# ==========================
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# ==========================
# Apache Config
# ==========================
COPY apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80

# ==========================
# Start
# ==========================
CMD if [ -f /etc/secrets/.env ]; then cp /etc/secrets/.env /var/www/html/.env; elif [ ! -f /var/www/html/.env ]; then cp /var/www/html/.env.example /var/www/html/.env; fi && \
    mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache && \
    sed -i 's/^CACHE_STORE=.*/CACHE_STORE=file/' /var/www/html/.env && \
    sed -i 's/^QUEUE_CONNECTION=.*/QUEUE_CONNECTION=sync/' /var/www/html/.env && \
    php artisan key:generate --force || true && \
    php artisan storage:link || true && \
    php artisan migrate --force && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache && \
    apache2-foreground