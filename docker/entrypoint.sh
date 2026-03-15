#!/bin/bash
set -e

WORKDIR=/var/www/html/my_fuel_project

echo "==> DBの接続を確認しています..."
until mysql -h"${DB_HOST:-db}" -u"${DB_USER}" -p"${DB_PASSWORD}" "${DB_NAME}" -e "SELECT 1" &>/dev/null; do
    echo "    DB待機中..."
    sleep 2
done
echo "==> DB接続OK"

echo "==> マイグレーションを実行しています..."
cd "$WORKDIR"
php oil r migrate --env=production 2>&1 || echo "マイグレーションはスキップされました（既に適用済み）"

echo "==> Apacheを起動しています..."
exec apache2-foreground
