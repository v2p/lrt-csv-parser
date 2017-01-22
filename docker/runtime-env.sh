#!/usr/bin/env bash

# specific variable which I use in own docker images to solve issue with mounted folders in docker
# (see https://github.com/docker/docker/issues/2259)
export LOCAL_USER_ID=$(id -u)

"$@"
