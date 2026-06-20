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

# Tạo storage link
RUN php artisan storage:link || true

# Expose port
EXPOSE 10000

# Start Laravel server (scripts sẽ chạy khi runtime, không phải build time)
CMD php artisan serve --host=0.0.0.0 --port=$PORT