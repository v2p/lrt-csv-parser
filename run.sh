#!/usr/bin/env bash

# modify these variables according to your environment:
export MYSQL_HOST=localhost:3306
export MYSQL_DATABASE=database
export MYSQL_USER=user
export MYSQL_PASSWORD=password
WEB_HOST_TO_SERVE=localhost:8081

read -p "This script will clean \"${MYSQL_DATABASE}\" database on your DB server \"${MYSQL_HOST}\". Are you sure? (y/N) "
if [ "${REPLY}" != "y" ]; then
   exit;
fi

cd app &&
php composer.phar install --no-dev &&
php vendor/bin/doctrine dbal:import data/db.sql &&
php cli/main.php data/main.csv &&
php -S ${WEB_HOST_TO_SERVE} -t web