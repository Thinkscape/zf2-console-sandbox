Module Manager experiment
===========================

Introduction
-------------
A hybrid, console + web application.

The web part is a standard skeleton application, displaying a "Welcome to zf2" page.

The console part (inside module/ModuleManager) defines additional console routes and handles introspecting, installing,
deleting and configuring modules. Don't get your hopes up - it doesn't actually install anything, but it's a demo
of how HTTP and Console modules can live together and provide functionality.


How to run?
------------

 * You can test standard web part by configuring your web server, pointing root dir to "/path/to/module-manager/public/"
 * To test Console part:
     * On Windows:
        * Open Command Prompt
        * CD to this folder
        * type `zf`

     * On Linux, Unix and Mac:
        * Open terminal
        * cd to this directory
        * type `./zf`

Run-time options
-----------------

Type `--help` or `--usage` to display available options.


Compatibility
--------------
This application works on all systems.

