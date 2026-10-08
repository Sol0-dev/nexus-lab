# Nexus Office Portal - Training Lab

A lightweight self-hosted training environment for authorized security learners. It is a mock corporate portal with an internal API and database, provided as-is for practice. The lab has no solutions, walkthroughs, or flag inventory published in this repository.

## Requirements

- Docker Engine 24+ with Docker Compose v2 (`docker compose`)

## Quick start

```bash
docker compose up -d --build
```

Open http://localhost:8080

## Teardown and full reset

```bash
docker compose down -v
```

## Ports

| Service | Port |
| --- | --- |
| Web portal | 8080 |
| Internal API | internal only (web container) |
| Database | internal only (web container) |

## Notes

- This environment is for authorized training only. All activity is the operator's responsibility.
- Services that expose the application externally should not be reachable from the public internet.