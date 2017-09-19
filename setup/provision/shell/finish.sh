#!/usr/bin/env bash

# installing dependencies for project
/usr/local/bin/composer install -d /var/www/vhosts/dev.local
sudo php /var/www/vhosts/dev.local/bin/console assets:install --env=prod

# set permissions
sudo chown -R vagrant:www /var/www;
sudo chown -R www:www /sessiontmp
sudo chown -R www:www /var/www/vhosts/dev.local
sudo chmod -R 775 /var/www/vhosts/dev.local
sudo usermod -aG docker vagrant;
sudo usermod -aG docker www;

# additional steps
sudo sed -i s/apache/www/g /etc/php-fpm.d/www.conf
sudo bash -c 'echo "include /var/www/bridges/*.conf;" > /etc/nginx/conf.d/bridges.conf';
export EDITOR=vi
sudo bash -c 'printf "root\nvagrant\n" > /etc/incron.allow';
sudo bash -c 'printf "/var/www/bridges IN_CREATE,IN_MODIFY,IN_DELETE sudo service nginx reload\n" > /etc/incron.d/bridges.conf';

# restarting services
sudo systemctl restart php-fpm
sudo systemctl restart incrond
sudo systemctl restart docker
