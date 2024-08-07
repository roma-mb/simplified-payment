
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
composer unit
composer unitf
```

PHP CS Fixer

```
composer cs-fixer-dry 
composer cs-fixer
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
