# Readme and guidelines for the Bestbug Studio Control Panel

## Purpose
The purpose of this software is to allow us (web developers) in creating new websites and web application easily without starting everytime from scratch and without using cms like joomla/WordPress and so on.


---

## Back-end

In the backend you'll be able to manage posts and media for dynamics websites.
You'll also be able to design the front-end by creating divs where you'll link the modules you want.

### Modules

In the future we'll create some presets modules but if needed you'll be able to develop your custom module and use it.

A best practice for the modules is that they have to be developed using MVC

The presets modules will be:
* Article loader
* Slideshow
* Photogallery
* Mapmanager
* Social

A custom module must be developed in Object Orientation. It needs:
* a file named modconfig.xml where you have to specify
	+ Module name
	+ Module shortname
	+ Menu (parent and child menu providing the options they will need to add in $_GET query)
* a getView($options) method in your main class that will show your view customized using the options you provided in modconfig.xml
* an index.php that will ONLY return the main object of your module. The manager will automatically execute $yourObject->getView($options_you_provided)

Best practices:
* a class folder where you'll save the classes you'll use to manage datas
* custom css and js folders
* use of MVC design pattern


## Front-end


### INSTALLATION

index.php will attempt a connection to the database and start the installation routine, it will

* ask for some informations
* Install the database and create the first user
* Redirect to /admin/index.php


---

### A brief note
This software is licenced under CC by-nc 4.0 this means you can take it and do whatever you want with it, unless you want to use it for commercial purposes!
