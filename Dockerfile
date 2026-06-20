FROM php:8.2-cli

# Cài đặt system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy toàn bộ source code
COPY . .

# Tạo file SQLite tạm (tránh lỗi package:discover khi chưa có env)
RUN touch database/database.sqlite

# Copy .env.example sang .env để tránh lỗi trong quá trình build
RUN cp .env.example .env

# Cài đặt PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Cài đặt frontend dependencies & build
RUN npm install && npm run build

# Tạo storage link
RUN php artisan storage:link || true

# Expose port
EXPOSE 10000

# Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=$PORT