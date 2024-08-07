build:
	docker compose build

stop:
	docker compose stop

up:
	docker compose up -d

down:
	docker compose down

composer-install:
	#docker run --rm -v .:/app composer install
	docker exec -it laravel-app composer install

composer-autoload:
	#docker run --rm -v .:/app composer dump-autoload
	docker exec -it laravel-app composer dump-autoload

storage-change:
	docker exec -it laravel-app chown -R root:www-data storage

storage-permission:
	docker exec -it laravel-app chmod -R 777 ./storage

key-generate:
	docker exec -it laravel-app php artisan key:generate

db-migrate:
	docker exec -it laravel-app php artisan migrate

db-seed:
	docker exec -it laravel-app php artisan db:seed

phpmd:
	docker run -it --rm -v ./:/simplified-payment -w /simplified-payment jakzal/phpqa phpmd app text cleancode,codesize,controversial,design,naming,unusedcode

phpstan:
	docker exec -it laravel-app composer phpstan

dev: composer-install storage-change storage-permission key-generate db-migrate db-seed
		@echo "Running on http://localhost:8000"
