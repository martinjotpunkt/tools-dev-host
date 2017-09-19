#!/usr/bin/env bash

# creating folders and set ownership
sudo mkdir -p /var/www/projects;
sudo mkdir -p /var/www/bridges;
sudo mkdir -p /var/www/vhosts/dev.local
sudo mkdir -p /sessiontmp

sudo chown -R vagrant:vagrant /var/www/vhosts/dev.local

# installing packages
sudo yum makecache
sudo rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
sudo rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
sudo yum install -y php70w-fpm php70w-opcache php70w-json php70w-xml php70w-pdo php70w-cli php70w-posix php70w-intl php70w-pecl-apcu.x86_64 php70w-pecl-xdebug.x86_64 nano yum-utils device-mapper-persistent-data lvm2 incron

# docker
sudo yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo
sudo yum install docker-ce
sudo systemctl enable docker
sudo systemctl start docker

# symfony
sudo mkdir -p /usr/local/bin
sudo curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony
sudo chmod a+x /usr/local/bin/symfony

# composer
sudo systemctl restart php-fpm
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar composer
sudo mv composer /usr/local/bin/
