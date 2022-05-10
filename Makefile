APP=symfony_probe_bundle

-include .make/Makefile.local

# all our targets are phony (no files to check).
.PHONY: help up exec ci cu clear check d re ps ver

help:
	@echo ''
	@echo 'Usage: make [TARGET]'
	@echo 'Targets:'
	@echo '  up       docker-compose up -d --build && docker-compose ps'
	@echo '  exec     run shell in container'
	@echo '  ci       composer install'
	@echo '  cu       composer update'
	@echo '  clear    clear cache'
	@echo '  check    run dev-checks and phpunit'
	@echo '  d        docker-compose down'
	@echo '  re       docker-compose down && docker-compose up -d --build'
	@echo '  ps       docker-compose ps'
	@echo '  ver      print package versions'
	@echo ''

init:
	./.make/init.sh

up:
	CUSTOM_UID=$(shell id -u) CUSTOM_GID=$(shell id -g) docker-compose \
-f docker-compose.yml \
up \
-d \
--build \
&& docker-compose ps

pull:
	docker pull ${DOCKER_REGISTRY}/${IMAGE_NAME}:${IMAGE_TAG}

exec:
	docker exec -it $(ARGS) $(APP) bash

ci:
	docker exec $(APP) composer install

ci-prod:
	docker exec $(APP) composer install \
--classmap-authoritative \
--no-dev

cu:
	docker exec -it $(APP) composer update

clear:
	docker exec -it $(APP) ./bin/clear-cache

check:
	docker exec -it $(APP) bash -c './bin/dev-checks && ./vendor/bin/phpunit'

d:
	docker-compose down

re:
	docker-compose down && docker-compose up -d --build && docker-compose ps

ps:
	docker-compose ps

ver:
	docker exec -it $(APP) composer info

vero:
	docker exec -it $(APP) composer info -o $(A)
