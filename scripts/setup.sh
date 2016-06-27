#!/bin/bash

set -e
sudo apt-get update

# Install necessary dependencies
sudo apt-get -y -q install curl wget nano
#gem install berkshelf --no-ri --no-rdoc
