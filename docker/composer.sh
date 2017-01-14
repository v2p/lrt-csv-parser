#!/usr/bin/env bash

docker-compose run --rm composer-service php /bin/composer.phar -d=/app "$@"