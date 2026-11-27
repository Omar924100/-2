#!/bin/sh
set -e
: "${FLAG:?FLAG manquant}"
printf '%s\n' "$FLAG" > /vault/flag.txt
chmod 0444 /vault/flag.txt
exec "$@"
