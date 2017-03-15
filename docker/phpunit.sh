#!/usr/bin/env bash

./runtime-env.sh docker-compose run --rm php-service /app/vendor/bin/phpunit -c /app/phpunit.xml