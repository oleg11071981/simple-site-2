# Simple Site CMS

CMS на CodeIgniter 4 для информационного сайта с документами и админ-панелью.

## Локальная разработка

```bash
docker compose up -d --build
```

Сайт: http://localhost:8080  
phpMyAdmin: http://localhost:8081  

Первый запуск:

```bash
docker compose exec php composer install
docker compose exec php php spark migrate --all
docker compose exec php php spark db:seed SuperAdministratorSeeder
```

Настройте `app/.env` (см. `app/.env.example`). Для dev используйте `CI_ENVIRONMENT = development`.

## Production

### 1. Подготовка на сервере

```bash
cp .env.prod.example .env.prod
cp app/.env.example app/.env
```

Отредактируйте:

- `.env.prod` — пароли MySQL для Docker
- `app/.env` — `app.baseURL`, пароль БД (`database.default.password` = `MYSQL_PASSWORD`), `CI_ENVIRONMENT = production`

### 2. SSL-сертификаты

Положите в `certs/`:

- `fullchain.pem`
- `privkey.pem`

### 3. Запуск

```bash
chmod +x scripts/deploy-prod.sh scripts/backup-db.sh
./scripts/deploy-prod.sh
```

Или вручную:

```bash
docker compose --env-file .env.prod -f docker-compose.prod.yml up -d --build
docker compose --env-file .env.prod -f docker-compose.prod.yml exec php composer install --no-dev --optimize-autoloader
docker compose --env-file .env.prod -f docker-compose.prod.yml exec php php spark migrate --all
docker compose --env-file .env.prod -f docker-compose.prod.yml exec php php spark key:generate --force
docker compose --env-file .env.prod -f docker-compose.prod.yml exec php php spark db:seed SuperAdministratorSeeder
```

### 4. Бэкап БД

```bash
./scripts/backup-db.sh
```

## Production checklist

| Пункт | Где |
|-------|-----|
| PHP 8.2, без xdebug | `php/Dockerfile`, `docker-compose.prod.yml` |
| Debug Toolbar только в dev | `app/Config/Filters.php` |
| SecureHeaders в prod | `app/Config/Filters.php` |
| Rate limit на логин | `LoginThrottleFilter` + nginx |
| HTTPS | `configs/nginx/production.conf` |
| Сильные пароли | `.env.prod`, `app/.env` |
| `composer.lock` в git | `app/composer.lock` |

## Структура

- `app/` — CodeIgniter 4
- `configs/nginx/` — конфиги nginx (dev / prod)
- `docker-compose.yml` — разработка
- `docker-compose.prod.yml` — production
