
## Environment:

#### Docker

required:
```
Docker:27.1.1
Docker Compose:v2.29.1
```

Env:

```
Copy, env.example and rename to .env
```

Run local folder:
```
make build
make up
make dev
```

#### Scripts

[phpunit]

```
docker exec -it laravel-app composer unit
docker exec -it laravel-app composer unitf
```

PHP CS Fixer

```
docker exec -it laravel-app composer cs-fixer-dry --{folder}
docker exec -it laravel-app composer cs-fixer --{folder}
```

---

#### Manual

required:
```JSON
"php": "^8.3",
"composer": "2.7.7"
"node": "20.12.2"
"npm": "10.8.1"
"mysql": "8.0.37"
```

Composer:

```
php composer.phar install | composer install
```

Env:

```
Copy, env.example and rename to .env
```

Database:
```
CREATE USER admin@localhost IDENTIFIED BY 'admin';
GRANT ALL ON *.* TO admin@localhost;
FLUSH PRIVILEGES;

CREATE DATABASE invoice_generator;
```

Laravel artisan:

```
> php artisan key:generate
> php artisan migrate
> php artisan seed
> php artisan serve

http://127.0.0.1:8000/
```

---

#### Postman
[Collection](https://www.postman.com/rom-mb/workspace/simplified-payment-api/collection/6885147-43284f20-7656-4b82-b210-7bc7b6d994b5?action=share&creator=6885147)
