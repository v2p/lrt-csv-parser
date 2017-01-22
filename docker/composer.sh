#!/usr/bin/env bash

runtime-env.sh docker-compose run --rm composer-service php /bin/composer.phar -d=/app "$@"