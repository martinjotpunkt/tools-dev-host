
## Setup
- Download the proper Packer version from https://www.packer.io/downloads.html
- Download vagrant from https://www.vagrantup.com/downloads.html
- Build machine via "packer build ubuntu-14.04-64/template.json
- Add box to vagrant via "vagrant box add ubuntu_14.04 packer_ubuntu-14.04.3-server-amd64_virtualbox.box" 
- Run "vagrant up" to start the machine

## ToDo
- Chef Provisioning
- - Install Docker to host Docker-Containers
- - Install Git to check out snoopdocker dashboard
- - Install nginx to provide bridges onto container

##Docs
http://blog.endpoint.com/2014/03/provisioning-development-environment.html
https://github.com/thasmo/packer.templates
https://github.com/shiguredo/packer-templates
http://kappataumu.com/articles/creating-an-Ubuntu-VM-with-packer.html
http://engineering.cotap.com/post/78783269747/hello-world-using-packer-chef-and-berkshelf-on
http://www.erikaheidi.com/blog/a-begginers-guide-to-vagrant-getting-your-portable-development-e
