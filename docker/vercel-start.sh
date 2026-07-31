#!/bin/sh
set -eu

STORAGE_PATH="${LARAVEL_STORAGE_PATH:-/tmp/hirehub-storage}"

mkdir -p \
    "$STORAGE_PATH/framework/cache/data" \
    "$STORAGE_PATH/framework/sessions" \
    "$STORAGE_PATH/framework/views" \
    "$STORAGE_PATH/logs"

# Vercel injects PORT. The Caddyfile defaults to port 80 when PORT is absent.
exec frankenphp run --config /etc/caddy/Caddyfile
