#!/usr/bin/env bash
# Corrige propietario y permisos tras builds como root o subidas con propietario incorrecto.
# Ejecutar en SSH (bash) en Hostinger como el usuario del hosting (p. ej. u871147009).
#
# Uso:
#   bash scripts/hostinger-fix-permissions.sh
#   bash scripts/hostinger-fix-permissions.sh /home/u871147009/public_html
#
# Si los archivos son de root y no tienes sudo, usa File Manager de hPanel o ticket a soporte.
set -euo pipefail

OWNER="${HOSTINGER_USER:-u871147009}"
TARGET="${1:-${HOME}/public_html}"

if [[ ! -d "$TARGET" ]]; then
  echo "No existe el directorio: $TARGET" >&2
  exit 1
fi

if [[ "$(id -un)" != "$OWNER" ]] && ! sudo -n true 2>/dev/null; then
  echo "Aviso: estás como $(id -un). Si los ficheros son de root, puede hacer falta:" >&2
  echo "  sudo chown -R ${OWNER}:${OWNER} \"$TARGET\"" >&2
fi

if command -v sudo >/dev/null 2>&1 && sudo -n true 2>/dev/null; then
  sudo find "$TARGET" -type d -exec chmod 755 {} \;
  sudo find "$TARGET" -type f -exec chmod 644 {} \;
  sudo chown -R "${OWNER}:${OWNER}" "$TARGET"
else
  find "$TARGET" -type d -exec chmod 755 {} \;
  find "$TARGET" -type f -exec chmod 644 {} \;
  chown -R "${OWNER}:${OWNER}" "$TARGET" 2>/dev/null || {
    echo "chown falló (normal si no eres el dueño). Prueba con sudo o desde File Manager." >&2
    exit 1
  }
fi

echo "Permisos aplicados en $TARGET (dirs 755, archivos 644, dueño ${OWNER})."
