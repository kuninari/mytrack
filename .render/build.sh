#!/usr/bin/env bash

# 権限を整えてから Composer 実行
chmod -R 775 storage bootstrap/cache
composer install --no-dev --optimize-autoloader
php artisan config:cache
