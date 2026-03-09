#!/bin/sh
set -eu

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache

php artisan config:clear
php artisan route:clear
php artisan view:clear

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    php artisan migrate --force
fi

if [ "${RUN_SEED:-false}" = "true" ]; then
    php artisan db:seed --force
fi

php artisan storage:link || true

exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
