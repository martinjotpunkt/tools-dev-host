
## Setup
- Download the proper Packer version from https://www.packer.io/downloads.html
- Download Virtualbox from https://www.virtualbox.org/wiki/Downloads
- Download vagrant from https://www.vagrantup.com/downloads.html
- Build machine via "packer build ubuntu-14.04-64.json"
- Install vagrant Plugin "vagrant-vbguest via "vagrant plugin install vagrant-vbguest"
- Add box to vagrant via "vagrant box add ubuntu-14.04-64 .\ubuntu-14.04.3-server-amd64_virtualbox.box" 

## ToDo
- Vagrant
- - [ ] Set up proper ssh
- Chef Provisioning
- - [ ] Install nginx
- - [ ] Install Docker
- - [ ] Install Git
- - [ ] Install Adminer

##Docs
http://blog.endpoint.com/2014/03/provisioning-development-environment.html
https://github.com/thasmo/packer.templates
https://github.com/shiguredo/packer-templates
http://kappataumu.com/articles/creating-an-Ubuntu-VM-with-packer.html
http://engineering.cotap.com/post/78783269747/hello-world-using-packer-chef-and-berkshelf-on
http://www.erikaheidi.com/blog/a-begginers-guide-to-vagrant-getting-your-portable-development-e
http://blog.endpoint.com/2014/03/provisioning-development-environment_14.html
http://kvz.io/blog/2013/01/16/vagrant-tip-keep-virtualbox-guest-additions-in-sync/
