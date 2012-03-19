<?php

namespace ModuleManager\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    Zend\Console\Color,
    Zend\Console\Prompt\Confirm
;

class IndexController extends ActionController
{

    public function installAction()
    {
        /** @var $console \Zend\Console\Adapter */
        $console = $this->locator->get('Zend\Console\Console');
        $params = $this->request->params();
        $name = $params->name;
        $source = $params->offsetExists('source') ? $params->source : 'http://modules.zendframework.com';

        $console->write('Installing module ');
        $console->write($params->name,Color::GREEN);
        $console->write(' from ');
        $console->writeLine($source,Color::GREEN);

        $console->write('Downloading ');
        for($x=0;$x<20;$x++){$console->write('.');usleep(100000);}
        $console->writeLine();

        $console->write('Extracting ');
        for($x=0;$x<10;$x++){$console->write('.');usleep(100000);}
        $console->writeLine();

        $console->write('Installing ');
        for($x=0;$x<5;$x++){$console->write('.');usleep(100000);}
        $console->writeLine();

        $console->writeLine();
        $console->write('Module installed to directory ');
        $console->writeLine(getcwd().'/vendor/'.$params->name,Color::YELLOW);
    }

    public function upgradeAction()
    {
        /** @var $console \Zend\Console\Adapter */
        $console = $this->locator->get('Zend\Console\Console');
        $params = $this->request->params();
        $name = $params->name;
        $source = $params->offsetExists('source') ? $params->source : 'http://modules.zendframework.com';
        $version = '1.0.9';

        $console->write('Upgrading module ');
        $console->write($params->name,Color::GREEN);
        $console->write(' to version ');
        $console->writeLine($version,Color::GREEN);

        $console->write('Downloading from '.$source.' ');
        for($x=0;$x<20;$x++){$console->write('.');usleep(100000);}
        $console->writeLine();

        $console->write('Extracting ');
        for($x=0;$x<10;$x++){$console->write('.');usleep(100000);}
        $console->writeLine();

        $console->write('Installing ');
        for($x=0;$x<5;$x++){$console->write('.');usleep(100000);}
        $console->writeLine();

        $console->writeLine();
        $console->write('Module upgraded to version ');
        $console->writeLine($version,Color::YELLOW);
    }


    public function removeAction()
    {
        /** @var $console \Zend\Console\Adapter */
        $console    = $this->locator->get('Zend\Console\Console');
        $params     = $this->request->params();
        $name       = $params->name;
        $force      = (bool)$params->force;
        $keepFiles  = (bool)$params->{'keep-files'};
        $keepConfig = (bool)$params->{'keep-config'};

        if($keepConfig){
            $console->writeLine('Will keep config files.');
        }

        if($keepFiles){
            $console->writeLine('Will keep module files.');
        }

        $console->write('Are you sure you want to remove module '.$name.'? [Y/N]',Color::LIGHT_YELLOW);
        $confirm = new Confirm('');
        if($force || !$confirm->show()){
            return "Aborting\n";
        }

        $console->write('Removing module ');
        $console->write($params->name,Color::YELLOW);
        for($x=0;$x<20;$x++){$console->write('.');usleep(100000);}
        $console->writeLine();
        $console->writeLine('Module has been removed.');
    }


    public function listAction()
    {
        /** @var $console \Zend\Console\Adapter */
        $console = $this->locator->get('Zend\Console\Console');
        /** @var $mm \Zend\Module\Manager */
        $mm = $this->locator->get('Zend\Module\Manager');

        /**
         * Get loaded modules and module paths
         */
        $loaded = $mm->getLoadedModules();
        $dirs = array('./vendor','./module');

        $console->writeLine('Currently installed modules:');

        /**
         * Loop through module dirs
         */
        foreach(glob('{'. join(',',$dirs) .'}/*',GLOB_BRACE|GLOB_ONLYDIR) as $modulePath){
            $moduleName = basename($modulePath);
            if(array_key_exists($moduleName, $loaded)){
                $console->write(' - '.$moduleName.' [active]',Color::GREEN);
                $console->write('  ('.realpath($modulePath).')');
                $console->writeLine();
            }else{
                $console->writeLine('  '.$modulePath, Color::GRAY);
            }
        }
        $console->writeLine();
    }

    public function infoAction()
    {
        $moduleToFind = $this->request->params()->name;

        /** @var $console \Zend\Console\Adapter */
        $console = $this->locator->get('Zend\Console\Console');
        /** @var $mm \Zend\Module\Manager */
        $mm = $this->locator->get('Zend\Module\Manager');

        /**
         * Get loaded modules and module paths
         */
        $loaded = $mm->getLoadedModules();
        $dirs = array('./vendor','./module');

        /**
         * Loop through module dirs and try to find module
         */
        foreach(glob('{'. join(',',$dirs) .'}/*',GLOB_BRACE|GLOB_ONLYDIR) as $modulePath){
            $moduleName = basename($modulePath);
            if($moduleName == $moduleToFind){
                /**
                 * Found a module!
                 */
                $isLoaded = array_key_exists($moduleName, $loaded);
                $class    = $isLoaded ? get_class($loaded[$moduleName]) : 'unknown';
                $path     = realpath($modulePath);
                $author   = 'Acme Labs c.o.';
                $version  = '1.0.23';

                $console->write('Module ');
                $console->writeLine($moduleName,Color::GREEN);
                $console->write('  Version: ');
                $console->writeLine($version, Color::GREEN);
                $console->write('  Author: ');
                $console->writeLine($author, Color::GREEN);
                $console->write('  Module class: ');
                $console->writeLine($class, Color::GREEN);
                $console->write('  Installation path: ');
                $console->writeLine($path, Color::GREEN);
                $console->write('  Is currently loaded: ');
                if($isLoaded){
                    $console->writeLine('YES', Color::GREEN);
                }else{
                    $console->writeLine('NO', Color::YELLOW);
                }

                return;
            }
        }
        $console->writeLine('Could not find module '.$moduleToFind,Color::YELLOW);

    }

    public function configAction()
    {
        /** @var $console \Zend\Console\Adapter */
        $console = $this->locator->get('Zend\Console\Console');
        $params = $this->request->params();
        $name = $params->name;
        return "T.B.A\n\n";
    }

}
