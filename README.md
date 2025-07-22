# Laravel Project Setup

## Требования

- PHP >= 8.1
- Composer
- MySQL/PostgreSQL
- Node.js и NPM

## Установка

1. Клонировать репозиторий:

```bash
git clone https://github.com/your/repo.git
cd repo

    Установить зависимости:

composer install
npm install && npm run dev

    Скопировать .env и сгенерировать ключ приложения:

cp .env.example .env
php artisan key:generate

    Настроить .env (БД, почта и пр.)

    Запустить миграции и (по необходимости) сиды:

php artisan migrate --seed

    Запустить сервер:

php artisan serve

Полезные команды

    Очистка кэша:

php artisan optimize:clear

    Обновление автозагрузки:

composer dump-autoload