#!/usr/bin/env bash
echo "Running composer"
composer install

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

echo "Clearing cache..."
php artisan cache:clear

echo "chmod 777 laravel.log.."
chmod -R 777 storage/logs/laravel.log