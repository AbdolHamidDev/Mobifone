FROM php:8.2-fpm

# Cài đặt system dependencies + Node.js 20.x
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    nginx \
    libpq-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Cài Node.js 20.x từ NodeSource
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

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

# Cấu hình Nginx
COPY <<'EOF' /etc/nginx/sites-available/default
server {
    listen ${PORT};
    server_name _;
    root /app/public;
    index index.php;

    client_max_body_size 50M;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot|webp)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        try_files $uri =404;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

# Start script: khởi động PHP-FPM + Nginx + migrate + storage link
CMD sh -c "\
    service php8.2-fpm start && \
    service nginx start && \
    php artisan migrate --force --graceful 2>/dev/null; \
    php artisan storage:link 2>/dev/null || true && \
    tail -f /var/log/nginx/access.log /var/log/nginx/error.log \
"