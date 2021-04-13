# OpenCart Store

1. Install [docker](https://docs.docker.com/engine/install/ubuntu/).
2. Install [docker-compose](https://docs.docker.com/compose/install/).
3. Add **docker** in [sudo group](https://stackoverflow.com/a/48957722/11419254), perform ALL steps except the fourth.
4. Copy **.env.dist** to **.env** and customize if need
5. Copy **./app/.env.dist** to **./app/.env** and customize if need
6. Add `${DOMAIN}` to `/etc/hosts`

---
LOCAL PROJECT
---
INIT
---
```
make init
```

UPDATE
---
```
make update
```

USAGES
---
```
make up   - Up docker container
make down - Down docker container
```

CONSOLE COMMAND
---
```
make app cmd="{command}"                        - Run container command
make app-composer-install                       - Run composer install
make app-migrate-create                         - Create new migration
make app-migrate-update                         - Update project migrations
make app-migrate-rollback v={version migration} - Rollback to migrate by version
```
---
## Admins
```
| email                    |   login   |  password  |
|--------------------------|-----------|------------|
|  admin@admin.admin       |   admin   |   secret   |
|                          |           |            |
