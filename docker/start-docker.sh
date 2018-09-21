#!/usr/bin/env bash
DOCKER_MACHINE="flex"

if docker-machine status $DOCKER_MACHINE | grep "Running" &> /dev/null;
  then
    echo "Machine $DOCKER_MACHINE is already running."
  else
    if ! [[ $(docker-machine status $DOCKER_MACHINE | grep "Running") ]] && ! [[ $(docker-machine status $DOCKER_MACHINE | grep "Stopped") ]];
    then
        echo "Create $DOCKER_MACHINE ..."
        ./create-machine.sh
    else
        docker-machine start $DOCKER_MACHINE && eval "$(docker-machine env $DOCKER_MACHINE)"

        if [ "$(docker-machine active)" != $DOCKER_MACHINE ]; then
          echo "Activation failed";
          exit 1;
        fi
        echo "Machine $DOCKER_MACHINE has been started."
        ./update-hosts.sh
    fi

    eval $(docker-machine env $DOCKER_MACHINE || echo "exit $?")
    docker-compose up -d --build
fi

