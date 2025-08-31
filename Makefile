up:
	docker compose up -d --build

install:
	docker compose exec app bash -lc "composer create-project laravel/laravel:^12.0 ."
	docker compose exec app bash -lc "composer require laravel/breeze --dev && php artisan breeze:install blade"
	docker compose exec node sh -lc "npm install && npm run build"
	docker compose exec app bash -lc "php artisan key:generate"
	docker compose exec app bash -lc "php artisan migrate --seed"

# Composer
composer-install:
	docker compose exec app bash -lc "composer install"

composer-update:
	docker compose exec app bash -lc "composer update"

# NPM / Node
npm-install:
	docker compose exec node sh -lc "npm install"

npm-dev:
	docker compose exec node sh -lc "npm run dev"

npm-watch:
	docker compose exec node sh -lc "npm run watch"

npm-prod:
	docker compose exec node sh -lc "npm run build"

migrate:
	docker compose exec app bash -lc "php artisan migrate"

migrate-fresh:
	docker compose exec app bash -lc "php artisan migrate:fresh --seed"

artisan:
	docker compose exec app bash -lc "php artisan $(cmd)"

test:
	docker compose exec app bash -lc "php artisan test"

ssh-php:
	docker compose exec app bash

ssh-node:
	docker compose exec node sh

# Logi
logs:
	docker compose logs -f --tail=100

down:
	docker compose down

restart: down up
