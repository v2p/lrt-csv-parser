#!/usr/bin/env bash

cd app &&
php composer.phar install &&
php vendor/bin/phpunit