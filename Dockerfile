FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libicu-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
    pdo_pgsql \
    pgsql \
    pdo_sqlite \
    zip \
    bcmath \
    gd \
    intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first (for better Docker layer caching)
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev --no-scripts

# Copy the rest of the application
COPY . .

# Run post-install scripts
RUN composer dump-autoload --optimize

# Create .env from example if not present, generate key
RUN cp .env.example .env || true

# Set permissions for storage and cache
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expose port (Render sets PORT env var)
EXPOSE 8000

# Start script: clear caches, run migrations, seed, then serve
CMD sh -c "\
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan migrate --force && \
    php artisan db:seed --force && \
    php artisan serve --host=0.0.0.0 --port=\${PORT:-8000}"
