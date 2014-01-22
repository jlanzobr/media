#!/bin/sh
php artisan worker:run
php composer.phar self-update
php composer.phar update
