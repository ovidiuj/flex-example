#!/usr/bin/env bash
DOCKER_MACHINE="flex"

docker-machine create --driver=virtualbox --virtualbox-hostonly-cidr "192.168.99.1/24" $DOCKER_MACHINE
docker-machine env $DOCKER_MACHINE

eval $(docker-machine env $DOCKER_MACHINE)

./update-hosts.sh