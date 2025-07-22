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

php artisan migrate

Запуск сервера

php artisan serve

composer dump-autoload

Сборка docker

docker-compose up -d --build