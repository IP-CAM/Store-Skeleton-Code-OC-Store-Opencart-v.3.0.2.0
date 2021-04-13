include .env

init: app-clear docker-down-clear docker-pull docker-build docker-up set-permission app-init app-ready
update: docker-down docker-pull docker-build docker-up app-update
up: docker-up
down: docker-down
restart: down up
update: docker-down docker-pull docker-build docker-up app-update


#=================================#
#============LOCALHOST============#
#=================================#
docker-pull:
	docker-compose -f docker-compose.yml pull

docker-build:
	docker-compose -f docker-compose.yml build

docker-up:
	docker-compose -f docker-compose.yml up -d

docker-down:
	docker-compose -f docker-compose.yml down --remove-orphans

docker-down-clear:
	docker-compose -f docker-compose.yml down -v --remove-orphans

set-permission:
	docker-compose -f docker-compose.yml exec app-php chmod -R 777 storage

app-clear:
	docker run --rm -v ${PWD}/app:/app --workdir=/app/assets alpine rm -f .ready

app-ready:
	docker run --rm -v ${PWD}/app:/app --workdir=/app/assets alpine touch .ready

app-init: app-composer-install app-assets-install app-db-wait app-mysql-init app-migrate-update

app-update: app-composer-install app-migrate-update app-assets-install

app-db-wait:
	docker run --rm -v ${PWD}/app:/app -w /app alpine sleep 10;

app-mysql-init:
	docker-compose -f docker-compose.yml exec app-mysql mysql -u${MYSQL_USERNAME} -p${MYSQL_PASSWORD} -e  "DROP DATABASE ${MYSQL_DATABASE}";
	docker-compose -f docker-compose.yml exec app-mysql mysql -u${MYSQL_USERNAME} -p${MYSQL_PASSWORD} -e "CREATE DATABASE ${MYSQL_DATABASE} COLLATE 'utf8mb4_unicode_ci';"
	docker-compose -f docker-compose.yml exec app-mysql /bin/bash -c 'mysql -u${MYSQL_USERNAME} -p${MYSQL_PASSWORD} ${MYSQL_DATABASE} < /data/enterpoint/base.sql'

app-migrate-update:
	docker-compose -f docker-compose.yml exec app-php vendor/bin/doctrine-migrations migrations:migrate --no-interaction

app-migrate-create:
	docker-compose -f docker-compose.yml exec app-php vendor/bin/doctrine-migrations migrations:generate --no-interaction

app-migrate-rollback:
	docker-compose -f docker-compose.yml exec app-php vendor/bin/doctrine-migrations migrations:execute --down $(v)

app-composer-install:
	docker-compose -f docker-compose.yml exec app-php composer install

app-composer-dump-autoload:
	docker-compose -f docker-compose.yml exec app-php composer dump-autoload

app-composer-require:
	docker-compose -f docker-compose.yml exec app-php composer require $(pakage)

app:
	docker-compose -f docker-compose.yml run --rm app-php $(cmd)

app-assets-install:
	docker run --rm -v ${PWD}/app:/app --workdir=/app/assets alpine rm -rf node_modules
	docker-compose -f docker-compose.yml run --rm app-node npm install
	docker-compose -f docker-compose.yml run --rm app-node npm run build

app-assets-watch:
	docker-compose -f docker-compose.yml run --rm app-node npm run watch

app-assets-prod:
	docker-compose -f docker-compose.yml run --rm app-node npm run build

app-assets-dev:
	docker-compose -f docker-compose.yml run --rm app-node npm run dev
