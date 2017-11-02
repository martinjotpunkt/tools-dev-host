#!/usr/bin/env bash

sudo mkdir -p /var/projects;

# installing packages
sudo rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
sudo rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
sudo yum makecache
sudo yum install -y nano yum-utils device-mapper-persistent-data lvm2 php56w php56w-pdo php56w-xml

# docker
sudo yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo
sudo yum install -y docker-ce
sudo systemctl enable docker
sudo systemctl start docker

# docker compose
sudo curl -L https://github.com/docker/compose/releases/download/1.16.1/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

sudo chown -R vagrant:vagrant /var/projects

# composer
sudo php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
sudo php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
sudo php -r "unlink('composer-setup.php');"

# restarting services
sudo systemctl restart docker

sudo sed -i "s/^;date.timezone =$/date.timezone = \"Europe\/London\"/" /etc/php.ini |grep "^timezone" /etc/php.ini

sudo docker run --detach --publish 80:80 --volume /var/run/docker.sock:/tmp/docker.sock:ro --name nginx_proxy jwilder/nginx-proxy
sudo docker run --detach --publish 9000:9000 --volume /var/run/docker.sock:/var/run/docker.sock --volume /opt/portainer:/data --env VIRTUAL_HOST=portainer.local --name portainer portainer/portainer

ifconfig

echo "Everything done. Pick the IP from above and edit your hosts file. The domain portainer.local should point to the IP above."
