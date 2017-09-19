## Setup
1. Download Virtualbox from https://www.virtualbox.org/wiki/Downloads
2. Download Vagrant from https://www.vagrantup.com/downloads.html
3. Move this folder to your desired destination
4. Navigate with CLI to this folder
5. Execute "vagrant up"
6. This might take a few minutes
7. Now you can log into the VM with "vagrant ssh"
8. The web interface is accessible with the IP of the VM (ifconfig)
9. If you want to shut it down, "exit" out of the VM-terminal and then execute "vagrant halt"

## Known issues
- If you get a 502 - Bad Gateway after reboot, just execute "sudo systemctl restart php-fpm"

## ToDo
- Dockpit
- Write container setup instructions

## Docs
http://blog.endpoint.com/2014/03/provisioning-development-environment.html
https://github.com/thasmo/packer.templates
https://github.com/shiguredo/packer-templates
http://kappataumu.com/articles/creating-an-Ubuntu-VM-with-packer.html
http://engineering.cotap.com/post/78783269747/hello-world-using-packer-chef-and-berkshelf-on
http://www.erikaheidi.com/blog/a-begginers-guide-to-vagrant-getting-your-portable-development-e
http://blog.endpoint.com/2014/03/provisioning-development-environment_14.html
http://kvz.io/blog/2013/01/16/vagrant-tip-keep-virtualbox-guest-additions-in-sync/
https://www.digitalocean.com/community/tutorials/how-to-install-chef-and-ruby-with-rvm-on-a-ubuntu-vps
http://gettingstartedwithchef.com/first-steps-with-chef.html
https://github.com/boxcutter/ubuntu/blob/master/ubuntu.json
https://www.digitalocean.com/community/tutorials/how-to-run-nginx-in-a-docker-container-on-ubuntu-14-04
https://docs.docker.com/engine/reference/api/docker_remote_api_v1.24/
