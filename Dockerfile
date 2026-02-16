FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libsqlite3-dev nodejs npm \
    && docker-php-ext-install pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy composer files first for caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy package.json for npm
COPY package.json package-lock.json* ./
RUN npm install

# Copy all project files
COPY . .

# Run composer scripts after full copy
RUN composer dump-autoload --optimize

# Build frontend assets
RUN npm run build

# Create SQLite database
RUN mkdir -p database && touch database/database.sqlite

# Create .env with correct values
RUN echo "APP_NAME='Primaria Tismana'" > .env && \
    echo "APP_ENV=production" >> .env && \
    echo "APP_KEY=base64:H0it+EIS0bJFcbDheYqM/c1RkEYzc+AaehqEs1qNECc=" >> .env && \
    echo "APP_DEBUG=true" >> .env && \
    echo "APP_URL=https://tismana-production.up.railway.app" >> .env && \
    echo "DB_CONNECTION=sqlite" >> .env && \
    echo "DB_DATABASE=/app/database/database.sqlite" >> .env && \
    echo "LOG_CHANNEL=stderr" >> .env && \
    echo "SESSION_DRIVER=file" >> .env && \
    echo "CACHE_DRIVER=file" >> .env && \
    echo "QUEUE_CONNECTION=sync" >> .env

# Cache config
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Run migrations
RUN php artisan migrate --force

EXPOSE ${PORT:-8080}

CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
