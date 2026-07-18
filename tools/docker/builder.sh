#!/bin/sh
set -eu

cd /rathena

if [ ! -x /rathena/configure ]; then
  echo "Error: /rathena/configure was not found. Check HOST_RATHENA_PATH mount in docker-compose.yml." >&2
  exit 1
fi

if [ ! -f /rathena/login-server ] || [ ! -f /rathena/char-server ] || [ ! -f /rathena/map-server ]; then
  run_build=1
else
  run_build=0
fi

if [ "${run_build}" -eq "1" ]; then
  if [ ! -f /rathena/Makefile ]; then
    echo "Info: Running /rathena/configure ${BUILDER_CONFIGURE:-}"
    /rathena/configure ${BUILDER_CONFIGURE:-}
  fi

  make clean server
else
  echo "Info: Existing server binaries detected. Skipping build."
fi
