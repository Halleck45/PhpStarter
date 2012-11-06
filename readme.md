PhpStarter
================

[![Build Status](https://secure.travis-ci.org/Halleck45/PhpStarter.png)](http://travis-ci.org/Halleck45/PhpStarter)

Easy way to create your projects with phing.

## Description

This tool will
 - download the framework (Symfony 2, Zend-Framework...)
 - create your VirtualHost
 - remove old projects
 - ...

Installation
-----------

1. Install phing
2. Run it !

### Install phing

    pear channel-discover pear.phing.info
    pear install phing/phing

### Run it !

This command :

```
phing  
    -Dframework=symfony21 
    -Ddestination=/var/www/demo
    -Dvhost=demo 
    install
```

Will install `Symfony 2.1` on your local computer, in `/var/www/demo`, and will add VirtualHost named `demo`.


If you want to uninstall a project, just run

```
phing  
    -Dframework=symfony21 
    -Ddestination=/var/www/demo
    -Dvhost=demo 
    remove
```

It will remove VirtualHost and source files.

Available frameworks
-----------

Today, you can install Symfony 2.1 and Zend Framework 2. You can contribute and add support for other framework. Just add a new file in library/framework, and import it :-)

Configuration
-----------

You can edit the file `properties/install.properties` and change the following values :

```
apacheSitesDir=/etc/apache2/sites-available
templateDir=./templates
owner.group=www-data
```

If you want to configure a local configuration, you can create a file named `properties/local.properties`. It will never be commited and will be ignored by git.
```
owner.user=myLocalUser
```