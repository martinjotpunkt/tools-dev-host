#!/bin/bash

# Read the Default User Settings section on https://docs.vagrantup.com/v2/boxes/base.html

# Create 'vagrant' user with password 'vagrant'
sudo useradd vagrant
sudo chpasswd <<<"vagrant:vagrant"
sudo groupadd wheel
sudo usermod -a -G wheel vagrant

# Allows wheel group to run all commands without password and tty
sudo 'ALL=(ALL)  NOPASSWD:ALL' >> /etc/sudoers
sudo sed -e "/^#/ {/%wheel/s/^# *//}" -i /etc/sudoers
sudo sed -e "/^#/! {/requiretty/s/^/# /}" -i /etc/sudoers

# Set up vagrant user with insecure keypair (https://github.com/mitchellh/vagrant/tree/master/keys)
sudo mkdir -p /home/vagrant/.ssh
sudo wget --no-check-certificate -O /home/vagrant/.ssh/authorized_keys 'https://github.com/mitchellh/vagrant/raw/master/keys/vagrant.pub'

#
sudo chown -R vagrant:vagrant /home/vagrant
sudo chmod -R go-rwsx /home/vagrant/.ssh

# Undo - Allows wheel group to run all commands without password and tty
#sudo sed -e "/^#/! {/%wheel/s/^/# /}" -i /etc/sudoers
#sudo sed -e "/^#/ {/requiretty/s/^# *//}" -i /etc/sudoers
