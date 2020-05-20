#!/usr/bin/env bash

cd /var/www/app/

chown application:application -R storage
chown application:application -R bootstrap

composer i --ignore-platform-reqs
php artisan migrate
