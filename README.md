# Laravel Setup

## Требования

- PHP >= 8.1
- Composer
- SQLite

## Установка

git clone https://github.com/Shtorkaa/testTask.git

cd repo


Установить зависимости:

composer install

php artisan key:generate

php artisan migrate --seed

Запуск сервера

php artisan serve

php artisan optimize:clear

composer dump-autoload