## Setup VM
1. Download Virtualbox from https://www.virtualbox.org/wiki/Downloads
2. Download Vagrant from https://www.vagrantup.com/downloads.html
3. Move this project to your desired destination
4. Download `centos7-0.0.99.box` from the fileserver `BLG-FileServer2/98 - Entwicklungsumgebung/web/Dockersetup Nov 2017` and place it into the `provision` folder.
4. Navigate via CLI into `setup`
5. Execute `vagrant up`
6. This might take a few minutes
7. Now you can log into the VM with `vagrant ssh`
8. If you want to shut it down, `exit` out of the VM-terminal and then execute `vagrant halt`
9. Modify your hosts file and let `portainer.local` point to the VM-IP
10. Now you can access portainer via `http://portainer.local` in your browser
11. Create account on landing page and select local docker setup in the next step
12. VM is ready for development

### Access container shell
Use following command via cli
```bash
sudo docker exec -ti [container_name or id] bash
```
or go on the container in portainer and click on `Console` in the `Container status` area.

### Setup project on VM
1. Upload project root directory to /var/projects
2. cd into /var/projects/[projectname]/setup
3. Execute ```sudo docker-compose up -d```
4. Follow setup instruction of specific project

### Important notes
- In development process just start, stop or pause the container. Kill and remove can cause data loss in specific cases.
- To prevent data loss download and backup volumes. You can list all volumes from a container in the "container detail" page (Volume page in portainer only shows auto generated volumes)
- In general the first init of an project container stack should be executed via CLI witch `docker-compose up`. Every task following can be done in portainer.
