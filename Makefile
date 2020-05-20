project_name=hexareport
env=dev
compose=docker-compose -p $(project_name) -f docker/docker-compose.yaml -f docker/docker-compose.$(env).yaml

export compose env

.PHONY: start
start: erase build up db ## clean current environment, recreate dependencies and spin up again

.PHONY: stop
stop: ## stop environment
		$(compose) stop

.PHONY: rebuild
rebuild: start ## same as start

.PHONY: erase
erase: ## stop and delete containers, clean volumes.
		$(compose) stop
		$(compose) rm -v -f

.PHONY: build
build: ## build environment and initialize composer and project dependencies
		$(compose) build
		$(compose) run --rm php sh -lc 'xoff;COMPOSER_MEMORY_LIMIT=-1 composer install'
.PHONY: build-ci

.PHONY: composer-update
composer-update: ## Update project dependencies
		$(compose) run --rm php sh -lc 'xoff;COMPOSER_MEMORY_LIMIT=-1 composer update'

.PHONY: up
up: ## spin up environment
		$(compose) up -d

.PHONY: cs
cs-fix: ## executes coding standards
		prettier --write .
		$(compose) run --rm php sh -lc 'php vendor/bin/ecs check src --fix'

.PHONY: cs-check
cs-check: ## executes coding standards
		$(compose) run --rm php sh -lc 'php vendor/bin/ecs check src'

.PHONY: db
db: ## recreate database
		$(compose) exec -T php sh -lc 'php bin/console d:d:d --force'
		$(compose) exec -T php sh -lc 'php bin/console d:d:c'
		$(compose) exec -T php sh -lc 'php bin/console d:m:m -n'
.PHONY: schema-validate
schema-validate: ## validate database schema
		$(compose) exec -T php sh -lc 'php bin/console d:s:v'

.PHONY: xon
xon: ## activate xdebug simlink
		$(compose) exec -T php sh -lc 'xon'

.PHONY: xoff
xoff: ## deactivate xdebug
		$(compose) exec -T php sh -lc 'xoff'

.PHONY: sh
sh: ## gets inside a container, use 's' variable to select a service. make s=php sh
		$(compose) exec $(s) sh -l

.PHONY: logs
logs: ## look for 's' service logs, make s=php logs
		$(compose) logs -f $(s)

.PHONY: jwt
jwt: ## Generate JWT keys pair
		openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
		openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout

.PHONY: help
help: ## Display this help message
	@cat $(MAKEFILE_LIST) | grep -e "^[a-zA-Z_\-]*: *.*## *" | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
