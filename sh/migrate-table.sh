#! /bin/bash
php artisan migrate:fresh

php artisan passport:install

php artisan telescope:install

php artisan db:seed