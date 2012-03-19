<?php

namespace ModuleManager\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel;

class HelpController extends ActionController
{
    public function usageAction()
    {
        $script = $this->getScriptName();
        return <<<USAGE
------------------------------------------------------------------
 Module Installer - Console module (inside standard skeleton app)
------------------------------------------------------------------
Usage:
    $script module list
    $script module info  <module>
    $script module ( install | remove | upgrade ) <module>
    $script module config get <module> <item>
    $script module config set <module> <item> <value>
    $script module help

For more information on each of the commands, use:
    $script module help [ install | remove | upgrade | config ]


USAGE;
    }

    public function installAction()
    {
        $script = $this->getScriptName();
        return <<<USAGE
Install a module

    $script module install <name> [<source>]

Parameters:
    <name>   - name of the module to install
    <source> - (optional) installation source, can be one of:
        1. Compressed archive: http://host.tld/module.zip  (zip, tar, tgz supported)
        2. Phar archive: http://host.tld/module.phar
        3. Composer definition: /path/to/composer.json


USAGE;

    }

    public function removeAction()
    {
        $script = $this->getScriptName();
        return <<<USAGE
Remove an installed module

    $script module remove <name> [--force | -f] [--keep-files | -k ] [--keep-config | -c]

Parameters:
    <name>           - name of the module to remove
    --force/-f       - don't ask any questions, just remove the module
    --keep-files/-k  - don't delete any files
    --keep-config/-c - remove all files except config


USAGE;

    }

    public function upgradeAction()
    {
        $script = $this->getScriptName();
        return <<<USAGE
Upgrade an installed module:

    $script module upgrade <name> [<source>] [--backup | -b]

Parameters:
    <name>      - name of the module to remove
    <source>    - (optional) source of new module
    --backup/-b - backup old files


USAGE;

    }

    public function configAction()
    {
        $script = $this->getScriptName();
        return <<<USAGE
Configure a module:

    $script module config get <module> <item>
    $script module config set <module> <item> <value>

Parameters:
    <module>  - name of the module to remove
    <item>    - config item
    <value>   - value to set


USAGE;

    }


    public function getScriptName()
    {
        $console = $this->locator->get('Zend\Console\Console');
        $script = basename($this->request->getScriptName());
        if($console instanceof \Zend\Console\Adapter\Windows){
            $script .= '.bat';
        }else{
            $script = './'.$script;
        }
        return $script;
    }
}
