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

# Copy .env.example if .env doesn't exist
RUN cp .env.example .env 2>/dev/null || true

EXPOSE ${PORT:-8080}

ENV APP_KEY=base64:H0it+EIS0bJFcbDheYqM/c1RkEYzc+AaehqEs1qNECc=
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=/app/database/database.sqlite

CMD php artisan migrate --force 2>/dev/null; \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
