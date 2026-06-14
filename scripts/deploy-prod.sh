#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT"

if [[ ! -f .env.prod ]]; then
  echo "Create .env.prod from .env.prod.example"
  exit 1
fi

if [[ ! -f app/.env ]]; then
  cp app/.env.example app/.env
  echo "Created app/.env — edit baseURL, DB password, then re-run."
  exit 1
fi

if [[ ! -f certs/fullchain.pem || ! -f certs/privkey.pem ]]; then
  echo "Place SSL certificates in certs/fullchain.pem and certs/privkey.pem"
  echo "Example (Let's Encrypt): certbot certonly --webroot -w ./certbot-www -d example.com"
  exit 1
fi

docker compose --env-file .env.prod -f docker-compose.prod.yml build
docker compose --env-file .env.prod -f docker-compose.prod.yml up -d

echo "Waiting for MySQL..."
sleep 15

docker compose --env-file .env.prod -f docker-compose.prod.yml exec php composer install --no-dev --optimize-autoloader
docker compose --env-file .env.prod -f docker-compose.prod.yml exec php php spark migrate --all
docker compose --env-file .env.prod -f docker-compose.prod.yml exec php php spark key:generate --force

echo "Done. Create admin: docker compose --env-file .env.prod -f docker-compose.prod.yml exec php php spark db:seed SuperAdministratorSeeder"
