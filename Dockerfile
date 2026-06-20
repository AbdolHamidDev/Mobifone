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

# Cài đặt PHP dependencies (bỏ qua scripts để tránh lỗi database trong quá trình build)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Cài đặt frontend dependencies & build
RUN npm install && npm run build

# Expose port
EXPOSE 10000

# Chạy migration (--graceful bỏ qua các bảng đã tồn tại) + storage link + start server
CMD php artisan migrate --force --graceful 2>/dev/null; php artisan storage:link 2>/dev/null || true && php artisan serve --host=0.0.0.0 --port=$PORT