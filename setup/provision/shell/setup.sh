#!/usr/bin/env bash
sudo rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm;
sudo rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm;
sudo yum install -y php70w-fpm php70w-opcache php70w-json php70w-xml php70w-pdo php70w-cli php70w-posix php70w-intl php70w-pecl-apcu.x86_64 php70w-pecl-xdebug.x86_64;
mkdir /var/www/projects;
