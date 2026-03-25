FROM richarvey/php-apache-heroku:latest

# プロジェクトファイルをコピー
COPY . /var/www/html

# Composerの実行（本番環境用）
RUN composer install --no-dev --optimize-autoloader

# 権限の設定
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# ポートの設定
ENV PORT 80
EXPOSE 80