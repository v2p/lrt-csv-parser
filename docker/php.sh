#!/usr/bin/env bash

if [[ $# -eq 0 ]] ; then
    PASSED_ARGUMENTS="-v"
else
    PASSED_ARGUMENTS="$@"
fi

runtime-env.sh docker-compose run --rm php-service php ${PASSED_ARGUMENTS}