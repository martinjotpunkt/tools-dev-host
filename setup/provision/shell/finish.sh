#!/usr/bin/env bash

sudo chown -R vagrant:www /var/www;
sudo bash -c 'echo "include /var/www/bridges/*.conf;" > /etc/nginx/conf.d/bridges.conf';
sudo service php-fpm restart;
sudo usermod -aG docker vagrant;
sudo usermod -aG docker www;
#User and group must be set to www in /etc/php-fpm.d/www.conf in order to connect to docker socket
sudo yum install -y incron
export EDITOR=vi
sudo bash -c 'printf "root\nvagrant\n" >> /etc/incron.allow';
sudo bash -c 'printf "/var/www/bridges IN_CREATE,IN_MODIFY,IN_DELETE sudo service nginx reload\n" >> /etc/incron.conf/bridges.conf';
sudo service incrond restart
