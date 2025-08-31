# Zadanie rekrutacyjen

---

## Wymagania

- Docker & Docker Compose
- Git

---

## Instalacja lokalna

1. Sklonuj repozytorium:

```bash
git clone <repo-url> projekt-laravel

cd projekt-laravel
```

## Uruchom kontenery:

```docker compose up -d --build```

## Wejdź do kontenera PHP:

```docker compose exec app bash```

## Zainstaluj Laravel i zależności:

```composer create-project laravel/laravel:^12.0 .
composer require laravel/breeze --dev
php artisan breeze:install blade
```
## Wejdź do kontenera Node:

```docker compose exec node sh```

## Zainstaluj NPM i zbuduj front:

```npm install
npm run build
```
## Wróć do kontenera PHP i ustaw klucz aplikacji:

```php artisan key:generate```

## Uruchom migracje i seedy:

```php artisan migrate --seed```
