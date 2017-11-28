#!/usr/bin/env bash

sudo mkdir -p /var/projects;

# installing packages
sudo rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
sudo rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
sudo yum makecache
sudo yum install -y nano yum-utils device-mapper-persistent-data lvm2

# docker
sudo yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo
sudo yum install -y docker-ce
sudo systemctl enable docker
sudo systemctl start docker

# docker compose
sudo curl -L https://github.com/docker/compose/releases/download/1.16.1/docker-compose-`uname -s`-`uname -m` -o /usr/bin/docker-compose
sudo chmod +x /usr/bin/docker-compose

sudo chown -R vagrant:vagrant /var/projects

sudo mv ~/devstart /usr/bin/devstart
sudo chmod +x /usr/bin/devstart

sudo echo "devstart" >> /etc/rc.d/rc.local

# restarting services
sudo systemctl restart docker

sudo docker run --detach --publish 80:80 --volume /var/run/docker.sock:/tmp/docker.sock:ro --name nginx_proxy jwilder/nginx-proxy
sudo docker run --detach --publish 9000:9000 --volume /var/run/docker.sock:/var/run/docker.sock --volume /opt/portainer:/data --env VIRTUAL_HOST=portainer.local --name portainer portainer/portainer

ifconfig

echo "Everything done. Pick the IP from above and edit your hosts file. The domain portainer.local should point to the IP above."
