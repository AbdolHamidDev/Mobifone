# Stage 1: Build frontend assets with Node.js
FROM node:20-slim AS node-builder

WORKDIR /app

# Copy package files first for better caching
COPY package*.json ./
RUN npm install

# Copy source and build
COPY . .
RUN npm run build

# Stage 2: PHP-FPM + Nginx for production
FROM php:8.2-fpm

# Cài đặt system dependencies + supervisor
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
    supervisor \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy toàn bộ source code
COPY . .

# Copy built assets từ Node builder
COPY --from=node-builder /app/public/build ./public/build

# Cài đặt PHP dependencies (bỏ qua scripts để tránh lỗi database trong quá trình build)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Set proper permissions for storage directory
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache && \
    chmod -R 775 /app/storage /app/bootstrap/cache

# Cấu hình Supervisor để quản lý PHP-FPM + Nginx
COPY <<'EOF' /etc/supervisor/conf.d/supervisord.conf
[supervisord]
nodaemon=true
logfile=/var/log/supervisord.log
pidfile=/var/run/supervisord.pid

[program:php-fpm]
command=php-fpm -F
autostart=true
autorestart=true
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0

[program:nginx]
command=nginx -g "daemon off;"
autostart=true
autorestart=true
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
EOF

# Tạo nginx config với placeholder PORT
RUN echo 'server {' > /etc/nginx/sites-available/default && \
    echo '    listen 8080;' >> /etc/nginx/sites-available/default && \
    echo '    server_name _;' >> /etc/nginx/sites-available/default && \
    echo '    root /app/public;' >> /etc/nginx/sites-available/default && \
    echo '    index index.php;' >> /etc/nginx/sites-available/default && \
    echo '' >> /etc/nginx/sites-available/default && \
    echo '    client_max_body_size 50M;' >> /etc/nginx/sites-available/default && \
    echo '' >> /etc/nginx/sites-available/default && \
    echo '    location / {' >> /etc/nginx/sites-available/default && \
    echo '        try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/sites-available/default && \
    echo '    }' >> /etc/nginx/sites-available/default && \
    echo '' >> /etc/nginx/sites-available/default && \
    echo '    location = /favicon.ico { access_log off; log_not_found off; }' >> /etc/nginx/sites-available/default && \
    echo '    location = /robots.txt  { access_log off; log_not_found off; }' >> /etc/nginx/sites-available/default && \
    echo '' >> /etc/nginx/sites-available/default && \
    echo '    location ~ \.php$ {' >> /etc/nginx/sites-available/default && \
    echo '        fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/sites-available/default && \
    echo '        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;' >> /etc/nginx/sites-available/default && \
    echo '        include fastcgi_params;' >> /etc/nginx/sites-available/default && \
    echo '        fastcgi_hide_header X-Powered-By;' >> /etc/nginx/sites-available/default && \
    echo '    }' >> /etc/nginx/sites-available/default && \
    echo '' >> /etc/nginx/sites-available/default && \
    echo '    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot|webp)$ {' >> /etc/nginx/sites-available/default && \
    echo '        expires 1y;' >> /etc/nginx/sites-available/default && \
    echo '        add_header Cache-Control "public, immutable";' >> /etc/nginx/sites-available/default && \
    echo '        try_files $uri =404;' >> /etc/nginx/sites-available/default && \
    echo '    }' >> /etc/nginx/sites-available/default && \
    echo '' >> /etc/nginx/sites-available/default && \
    echo '    location ~ /\.(?!well-known).* {' >> /etc/nginx/sites-available/default && \
    echo '        deny all;' >> /etc/nginx/sites-available/default && \
    echo '    }' >> /etc/nginx/sites-available/default && \
    echo '}' >> /etc/nginx/sites-available/default

# Start script: thay PORT + khởi động Supervisor + migrate + storage link
CMD sh -c "\
    sed -i \"s/listen 8080/listen $PORT/\" /etc/nginx/sites-available/default && \
    /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf & \
    php artisan migrate --force --graceful 2>/dev/null; \
    php artisan storage:link 2>/dev/null || true && \
    wait \
"