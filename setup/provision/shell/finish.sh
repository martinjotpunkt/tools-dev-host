#!/usr/bin/env bash

sudo chown -R vagrant:www /var/www;
sudo service php-fpm restart;
