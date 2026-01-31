
FROM php:8.2-fpm

# パッケージの更新と依存関係のインストール
# git, zip, unzipはComposer使用時に必須
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    vim \
    && docker-php-ext-install pdo_mysql bcmath

# Composerを公式イメージからコピー（これが最もスマートな方法です）
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# php.iniのコピー
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/html