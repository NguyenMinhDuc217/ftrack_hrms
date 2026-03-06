# ================================
# Stage 1: Build Node assets (Vite)
# ================================
FROM node:20-alpine AS node-builder

WORKDIR /app

COPY package*.json ./
# Nếu dùng bun.lock thì dùng npm install vẫn được
RUN npm install

COPY . .
RUN npm run build

# ================================
# Stage 2: PHP + Apache
# ================================
FROM php:8.3-apache

# Cài các thư viện hệ thống cần thiết
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev \
    libzip-dev libfreetype6-dev libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo pdo_mysql mysqli \
        mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy toàn bộ project
COPY . .

# Copy assets đã build từ stage 1
COPY --from=node-builder /app/public/build ./public/build

# Cài PHP dependencies (không có dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Tạo storage link và cache
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Phân quyền thư mục storage và cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Cấu hình Apache: trỏ DocumentRoot vào /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' \
        /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/html|/var/www/html/public|g' \
        /etc/apache2/apache2.conf \
    && a2enmod rewrite

# Tạo file .htaccess nếu chưa có (Laravel cần để mod_rewrite hoạt động)
RUN if [ ! -f /var/www/html/public/.htaccess ]; then \
    echo '<IfModule mod_rewrite.c>\n\
    <IfModule mod_negotiation.c>\n\
        Options -MultiViews -Indexes\n\
    </IfModule>\n\
    RewriteEngine On\n\
    RewriteCond %{HTTP:Authorization} .\n\
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]\n\
    RewriteCond %{REQUEST_FILENAME} !-d\n\
    RewriteCond %{REQUEST_FILENAME} !-f\n\
    RewriteRule ^ index.php [L]\n\
</IfModule>' > /var/www/html/public/.htaccess; \
fi

EXPOSE 80

CMD ["apache2-foreground"]
