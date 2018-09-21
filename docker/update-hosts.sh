#!/usr/bin/env bash
# clear existing docker.local entry from /etc/hosts
echo "clear existing entries from /etc/hosts \n"
ETC_HOSTS=/etc/hosts
HOST_NAME="flex.dc"

if [ -n "$(grep $HOST_NAME /etc/hosts)" ]
then
    echo "$HOST_NAME Found in your $ETC_HOSTS, Removing now...";
    sudo sed -i".bak" "/$HOST_NAME/d" $ETC_HOSTS
else
    echo "$HOST_NAME was not found in your $ETC_HOSTS";
fi

# get ip of running machine
echo "get ip of running machine\n"
export DOCKER_IP="$(echo ${DOCKER_HOST} | grep -oE '[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}')"

# update /etc/hosts with docker machine ip
echo "update /etc/hosts with docker machine ip"
[[ -n $DOCKER_IP ]] && sudo /bin/bash -c "echo \"${DOCKER_IP}	flex.dc\" >> /etc/hosts"