#!/bin/bash
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
frankenphp run --config /etc/caddy/Caddyfile
