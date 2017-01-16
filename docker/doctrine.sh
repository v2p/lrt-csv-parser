#!/usr/bin/env bash

docker-compose run --rm php-service /app/vendor/bin/doctrine "$@"