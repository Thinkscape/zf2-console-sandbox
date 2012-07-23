<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\AdapterInterface as Console;

class Module implements ConsoleBannerProviderInterface, ConsoleUsageProviderInterface
{
    public function onBootstrap($e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConsoleBanner(Console $console){
        return
            "==------------------------------------------------------==\n".
            "    This is a an example HTTP+Console ZF2 application    \n".
            "==------------------------------------------------------==\n".
            "It works as a web app, when run via public/index.php, but\n".
            "also provides several console commands you can try out...\n".
            "\n".
            "Available console commands:"
        ;
    }

     public function getConsoleUsage(Console $console){
        return array(
            'time'                      => 'show current time',
            'exception'                 => 'Throw an example exception from within action controller',
        );
    }
}
