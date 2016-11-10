# -*- mode: ruby -*-
require 'yaml'
dir = File.dirname(File.expand_path(__FILE__))
configValues = YAML.load_file("ansible/vars/all.yml")
data = configValues['vagrant_local']

vagrant_home = (ENV['VAGRANT_HOME'].to_s.split.join.length > 0) ? ENV['VAGRANT_HOME'] : "#{ENV['HOME']}/.vagrant.d"
vagrant_dot  = (ENV['VAGRANT_DOTFILE_PATH'].to_s.split.join.length > 0) ? ENV['VAGRANT_DOTFILE_PATH'] : "#{dir}/.vagrant"

#If your Vagrant version is lower than 1.5, you can still use this provisioning
#by commenting or removing the line below and providing the config.vm.box_url parameter,
#if it's not already defined in this Vagrantfile. Keep in mind that you won't be able
#to use the Vagrant Cloud and other newer Vagrant features.
Vagrant.require_version ">= 1.5"

# Check to determine whether we're on a windows or linux/os-x host,
# later on we use this to launch ansible in the supported way
# source: https://stackoverflow.com/questions/2108727/which-in-ruby-checking-if-program-exists-in-path-from-ruby
def which(cmd)
    exts = ENV['PATHEXT'] ? ENV['PATHEXT'].split(';') : ['']
    ENV['PATH'].split(File::PATH_SEPARATOR).each do |path|
        exts.each { |ext|
            exe = File.join(path, "#{cmd}#{ext}")
            return exe if File.executable? exe
        }
    end
    return nil
end

Vagrant.configure("2") do |config|

    config.ssh.forward_agent = true

    config.vm.box = "#{data['vm']['base_os']}/#{data['vm']['base_box']}"
    config.vm.hostname = "#{data['vm']['hostname']}"
    config.vm.synced_folder ".", "/vagrant"

    # set network options
    config.vm.network :private_network, ip: "#{data['vm']['private_ip']}"
    config.vm.network "forwarded_port", guest: 1113, host: 1113
    config.vm.network "forwarded_port", guest: 2113, host: 2113
    config.vm.network "forwarded_port", guest: 3000, host: 3000
    config.vm.network "forwarded_port", guest: 3001, host: 3001
    config.vm.network "forwarded_port", guest: 3002, host: 3002

    # hostmanager manages the hostfile on client and host
    config.hostmanager.enabled           = true
    config.hostmanager.manage_host       = true
    config.hostmanager.ignore_private_ip = false
    config.hostmanager.include_offline   = true
    config.hostmanager.aliases = "es.#{data['vm']['hostname']} db.#{data['vm']['hostname']}" #sub-domains

    if data['vm']['public_ip'].to_s != ''
        config.vm.network 'public_network'
        if data['vm']['public_ip'].to_s != '1'
          config.vm.network 'public_network', ip: "#{data['vm']['public_ip']}"
        end
    end

    # virtualbox specifics
    config.vm.provider :virtualbox do |v|
        v.name = "#{data['vm']['hostname']}"
        v.customize [
            "modifyvm", :id,
            "--name", v.name,
            "--memory", 1024,
            "--natdnshostresolver1", "on",
            "--cpus", 1,
        ]
        v.customize ['setextradata', :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate//vagrant", '1']
    end

    # If Ansible is in your path it will provision from your HOST machine
    # If Ansible is not found in the path it will be installed in the VM and provisioned from there
    if which('ansible-playbook')
        config.vm.provision "ansible" do |ansible|
            ansible.verbose = "v"
            ansible.playbook = "ansible/playbook.yml"
            ansible.inventory_path = "ansible/inventories/dev"
            ansible.limit = 'all'
        end
        #config.vm.provision "shell", path: "https://packagecloud.io/install/repositories/EventStore/EventStore-OSS/script.deb.sh"

        config.vm.provision "docker" do |docker|
            # docker provision
            docker.run "humblelistener/eventstore",
                args: "-p 2113:2113 -p 1113:1113"
        end
    else
        config.vm.provision :shell, path: "ansible/windows.sh", args: ["#{data['vm']['hostname']}"]
    end
end
