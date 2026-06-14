#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
BACKUP_DIR="${ROOT}/backups"
STAMP="$(date +%Y%m%d_%H%M%S)"

mkdir -p "$BACKUP_DIR"

if [[ -f "${ROOT}/.env.prod" ]]; then
  ENV_FILE="${ROOT}/.env.prod"
else
  ENV_FILE="${ROOT}/.env.prod.example"
fi

set -a
# shellcheck disable=SC1090
source "$ENV_FILE"
set +a

docker compose --env-file "$ENV_FILE" -f "${ROOT}/docker-compose.prod.yml" exec -T mysql \
  mysqldump -u"${MYSQL_USER}" -p"${MYSQL_PASSWORD}" "${MYSQL_DATABASE}" \
  > "${BACKUP_DIR}/db_${STAMP}.sql"

echo "Backup saved: ${BACKUP_DIR}/db_${STAMP}.sql"
