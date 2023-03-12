<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Збірка проекту

1) Налаштувати корневий каталог на сервері, щоб він був <code>/public</code>
2) Створити файл з налаштуваннями <code>cp .env.example .env</code> (налаштувати конфігурацію)
3) <code>composer install</code>
4) <code>php artisan key:generate</code>
5) <code>npm install</code>

## Керування

Команда ``` php artisan parse:lotok ``` згенерує файл зі всима знижками, по посиланню https://lotok.ua/discount/cat1 (Файл буде під назвою``` discount-dd.mm.yyyy.json ``` у каталозі ``` public ```)

## Конфигурація

Версія php: <code>8.1.6</code><br>
Версія NodeJS: <code>v19.3.0</code><br>
Версія npm: <code>9.2.0</code><br>
Версія Laravel: <code>10.3.3</code><br>

P.S. Вибачте, я вже аж коли зробив тестове, тоді помітив, що там вимоги були до версії PHP 7.4 =(
