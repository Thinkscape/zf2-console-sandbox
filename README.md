ZF2 Console Sandbox
===========================

Introduction
-------------
This repo contains example Console applications built on top of [Zend Framework 2](http://www.zendframework.com)

It currently contains 2 example applications, with a few more coming soon.

### Matrix Screensaver (/matrix)

This is a Console-only ZF2 application that directly directly calls `Zend\Console` methods to display a well-known
screensaver animation. It features multiple command-line parameters to customize the effect and usage information
that is displayed via MVC.

### Module Manager experiment (/module-manager)

This is an example of web + http application. The web part is a standard
[Zend Skeleton App](https://github.com/zendframework/ZendSkeletonApplication) that displays a Welcome Page in the
browser. When run via `zf` from terminal (command line) it will invoke a Console-dedicated module, located in
`modules/ModuleManager` that handles various commands and parameters. It mimics a potential, future tool to
manager zf2 modules from the command line, but this is out of scope of this experiment - all operations are merely
simulated to show integration between MVC and Console.


Installation
-------------

Clone this repo with its dependencies

    git clone --recursive git://github.com/Thinkscape/zf2-console-sandbox.git


Running
-------------

 * To test on Linux, Unix and Mac:
    * Open terminal
    * `cd zf2-console-sandbox/matrix`
    * `matrix`   or `matrix --help` for help
    * `cd ../zf2-console-sandbox/module-manager`
    * `zf`

 * To test on Windows:
    * Open Command Prompt
    * `cd zf2-console-sandbox\matrix`
    * `matrix`   or `matrix --help` for help
    * `cd ..\zf2-console-sandbox\module-manager`
    * `zf`


Compatibility
--------------

 * **Matrix** app currently requires Linux/Unix/Mac or Windows with [Ansicon](https://github.com/adoxa/ansicon) installed
 * **module-manager** app runs on all systems supported by Zend\Console (including Windows)


Feedback
---------
Please send all feedback directly to me or to official ML: 
[zf-contributors](http://framework.zend.com/wiki/display/ZFDEV/Contributing+to+Zend+Framework)
