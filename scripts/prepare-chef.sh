#!/bin/bash

set -e

# install rmv
sudo apt-get -y -q install libgdbm-dev libncurses5-dev automake libtool bison libffi-dev
gpg --keyserver hkp://keys.gnupg.net --recv-keys 409B6B1796C275462A1703113804BB82D39DC0E3
curl -sSL https://get.rvm.io | bash -s stable
source ~/.rvm/scripts/rvm

# Install ruby
rvm install 2.1.0
rvm use 2.1.0 --default

# Install chef
wget -O- https://opscode.com/chef/install.sh | sudo bash

# Install dependencies
gem install bundler berkshelf --no-ri --no-rdoc
gem install foodcritic --no-ri --no-rdoc
