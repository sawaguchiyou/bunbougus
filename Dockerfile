# 1. PHP 8.2 + Apache の公式イメージを使用
FROM php:8.2-apache

# 2. 必要なライブラリとPostgreSQL用ドライバをインストール
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# 3. ApacheのドキュメントルートをLaravelのpublicに変更
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. mod_rewriteを有効化（LaravelのURLルーティングに必須）
RUN a2enmod rewrite

# 5. プロジェクトファイルをコピー
COPY . /var/www/html

# 6. Composerをインストールして依存関係を解決
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 7. 権限の設定
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. 起動時にマイグレーションを実行
CMD php artisan migrate --force && apache2-foreground