#!/bin/sh
set -e

# Read Docker secrets (mounted at /run/secrets/*) and export as env vars.
# Allows Laravel to read them via the standard env() mechanism without
# committing them to .env.
read_secret() {
    local var="$1"
    local file="/run/secrets/$2"
    if [ -f "$file" ] && [ -z "$(eval echo \$$var)" ]; then
        export "$var"="$(cat "$file")"
    fi
}

read_secret APP_KEY app_key
read_secret DB_PASSWORD db_password
read_secret REDIS_PASSWORD redis_password
read_secret PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET passport_personal_access_client_secret

# Passport's RSA keys live as files. Mount them via secrets and place them
# where Passport expects them (storage/).
if [ -f /run/secrets/oauth_private_key ]; then
    cp /run/secrets/oauth_private_key /var/www/storage/oauth-private.key
    chmod 600 /var/www/storage/oauth-private.key
    chown www-data:www-data /var/www/storage/oauth-private.key
fi
if [ -f /run/secrets/oauth_public_key ]; then
    cp /run/secrets/oauth_public_key /var/www/storage/oauth-public.key
    chmod 644 /var/www/storage/oauth-public.key
    chown www-data:www-data /var/www/storage/oauth-public.key
fi

# Storage may be a fresh named volume on first deploy.
mkdir -p \
    /var/www/storage/app/public \
    /var/www/storage/framework/cache/data \
    /var/www/storage/framework/sessions \
    /var/www/storage/framework/views \
    /var/www/storage/logs
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Cache config/routes/events for production performance. Skipped if already
# cached on the image (idempotent).
if [ "$APP_ENV" = "production" ]; then
    php artisan config:cache --no-interaction || true
    php artisan route:cache --no-interaction || true
    php artisan event:cache --no-interaction || true
fi

exec "$@"
