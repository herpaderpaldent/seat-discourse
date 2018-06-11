# -*- mode: ruby -*-
# vi: set ft=ruby :


# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  config.vm.hostname = "herpmkdocs"
  config.vm.box = "bento/ubuntu-16.04"
  config.vm.network "private_network", ip: "192.168.33.101"

  config.vm.provider "virtualbox" do |v|
    v.name = "mkdocs"
    v.memory = 4096
    v.cpus = 2
  end

  config.vm.provision :docker

end

# cd /vagrant/docker
# Build with: `docker build -t herpaderpaldent/seat-discourse .`.
# cd ..
# Run with: `docker run -d --rm -p 8000:8000 --name docs -v ${PWD}:/docs herpaderpaldent/seat-discourse`
