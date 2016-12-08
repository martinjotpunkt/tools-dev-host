
## Setup
- Download the proper Packer version from https://www.packer.io/downloads.html
- Download Virtualbox from https://www.virtualbox.org/wiki/Downloads
- Download vagrant from https://www.vagrantup.com/downloads.html
- Checkout packer  templates with "git clone git@github.com:boxcutter/centos.git centos"
- Move to centos
- Build machine via "packer build -var-file=centos71.json centos.json"
- Install vagrant Plugin "vagrant-vbguest via "vagrant plugin install vagrant-vbguest"
- Address generated box file in /setup/Vagrantfile
- Move to /setup
- Run "vagrant up"

## ToDo


##Docs
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
