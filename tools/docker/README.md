# Docker

This Docker setup is for local development only. It is **not** recommended for production.
For production installs, see [Installations](https://github.com/rathena/rathena/wiki/installations).

## Quick start

Run commands from `tools/docker`:

```bash
docker compose up -d db builder
docker compose up -d login char map
```

Then stop everything with:

```bash
docker compose down
```

## FluxCP

FluxCP now follows the `fluxcp-docker` style: it is built into its own image from `tools/docker/fluxcp-image/Dockerfile`, so you do not need a pre-cloned `tools/docker/fluxcp` directory.

Start FluxCP:

```bash
docker compose up -d --build fluxcp
```

## Common commands

```bash
docker compose run --rm builder sh
docker compose ps
docker compose logs -f builder
docker compose down --volumes
```

## Path configuration (important for Dockhand/Portainer)

Compose supports explicit host-path variables to avoid relative path resolution issues:

- `HOST_RATHENA_PATH` (default: `../..`)
- `HOST_DOCKER_PATH` (default: `.`)
- `HOST_SQL_FILES_PATH` (default: `../../sql-files`)

Use absolute host paths in your `.env` when deploying from Portainer/Dockhand.

Example:

```dotenv
HOST_RATHENA_PATH=/path/to/rathenadocker
HOST_DOCKER_PATH=/path/to/rathenadocker/tools/docker
HOST_SQL_FILES_PATH=/path/to/rathenadocker/sql-files
```

FluxCP app settings are also configurable from `.env`:

- `FLUXCP_BASE_PATH`
- `FLUXCP_SITE_TITLE`
- `FLUXCP_DOMAIN`
- `FLUXCP_RO_SERVER_NAME`
- `FLUXCP_INSTALLER_PASSWORD`

## Notes

- Builder runs `sh /rathena/tools/docker/builder.sh` and uses absolute in-container paths.
- If build fails with configure/mount errors, verify `HOST_RATHENA_PATH` points to the repository root.
- DB credentials and ports are configurable via `.env` values used by `docker-compose.yml`.
