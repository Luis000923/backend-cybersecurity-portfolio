#!/usr/bin/env bash
# Ejecutar en SSH de Hostinger (bash), desde la raíz del clon del repo.
# Uso: bash scripts/hostinger-deploy.sh
# Opcional: PUBLIC_HTML=/home/u871147009/domains/tudominio.com/public_html bash scripts/hostinger-deploy.sh
set -euo pipefail

REPO_ROOT="$(cd "$(dirname "$0")/.." && pwd)"
cd "$REPO_ROOT"

export NODE_OPTIONS='--max-old-space-size=1024'
cd frontend
npm install
npm run build
cd ..

DEST="${PUBLIC_HTML:-${HOME}/public_html}"
mkdir -p "$DEST"

# Sincroniza y elimina en destino lo que ya no está en dist (evita HTML antiguos mezclados)
if command -v rsync >/dev/null 2>&1; then
  rsync -a --delete "${REPO_ROOT}/dist/" "${DEST}/"
else
  echo "rsync no encontrado; usando cp (no borra archivos huérfanos en destino)."
  rm -rf "${DEST:?}/"*
  cp -a "${REPO_ROOT}/dist/." "${DEST}/"
fi

echo "Desplegado en: ${DEST}"
