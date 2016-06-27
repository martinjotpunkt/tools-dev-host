VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  # Parameters
  cfg_name        = 'dev.local'
  cfg_uid         = 'dev'
  cfg_passwd      = 'secret'
  cfg_ip          = '192.168.56.100'
  cfg_url         = 'dev.local'
  cfg_box         = 'ubuntu-14.04-64'
  cfg_share_host  = 'projects'
  cfg_share_guest = '/var/www'

  # Configuration
  config.vm.box = cfg_box
  config.vm.host_name = cfg_name

  # Network
  config.vm.network :private_network, ip: cfg_ip

  # VirtualBox Provider Configuration
  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", 2048]
    vb.customize ["modifyvm", :id, "--name", cfg_url]
  end

  # Synced Folder
  #config.vm.synced_folder cfg_share_host, cfg_share_guest

    config.vm.provision "fix-no-tty", type: "shell" do |s|
        s.privileged = false
        s.inline = "sudo sed -i '/tty/!s/mesg n/tty -s \\&\\& mesg n/' /root/.profile"
    end
end
