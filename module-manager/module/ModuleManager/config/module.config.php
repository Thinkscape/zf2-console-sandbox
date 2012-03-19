<?php
return array(
    'di' => array(
        'instance' => array(

            // Setup for controllers.

            // Injecting the plugin broker for controller plugins into
            // the action controller for use by all controllers that
            // extend it
            'Zend\Mvc\Controller\ActionController' => array(
                'parameters' => array(
                    'broker'       => 'Zend\Mvc\Controller\PluginBroker',
                ),
            ),

            // Setup for router and routes
            'Zend\Mvc\Router\RouteStack' => array(
                'parameters' => array(
                    'routes' => array(
                        'module-usage' => array(
                            'type' => 'Zend\Mvc\Router\Console\Catchall',
                            'options' => array(
                                'route'=> '',
                                'defaults' => array(
                                    'controller' => 'ModuleManager\Controller\HelpController',
                                    'action'     => 'usage',
                                ),
                            ),
                        ),
                        'module-install' => array(
                            'type'    => 'Zend\Mvc\Router\Console\Simple',
                            'options' => array(
                                'route'    => ' module install <name> [<source>]',
                                'defaults' => array(
                                    'controller' => 'ModuleManager\Controller\IndexController',
                                    'action'     => 'install',
                                ),
                            ),
                        ),
                        'module-remove' => array(
                            'type'    => 'Zend\Mvc\Router\Console\Simple',
                            'options' => array(
                                'route'    => ' module remove <name> [--force] [--keep-files] [--keep-config]',
                                'defaults' => array(
                                    'controller' => 'ModuleManager\Controller\IndexController',
                                    'action'     => 'remove',
                                ),
                            ),
                        ),
                        'module-upgrade' => array(
                            'type'    => 'Zend\Mvc\Router\Console\Simple',
                            'options' => array(
                                'route'    => ' module upgrade <name> ',
                                'defaults' => array(
                                    'controller' => 'ModuleManager\Controller\IndexController',
                                    'action'     => 'upgrade',
                                ),
                            ),
                        ),
                        'module-list' => array(
                            'type'    => 'Zend\Mvc\Router\Console\Simple',
                            'options' => array(
                                'route'    => ' module list',
                                'defaults' => array(
                                    'controller' => 'ModuleManager\Controller\IndexController',
                                    'action'     => 'list',
                                ),
                            ),
                        ),
                        'module-info' => array(
                            'type'    => 'Zend\Mvc\Router\Console\Simple',
                            'options' => array(
                                'route'    => ' module info <name>',
                                'defaults' => array(
                                    'controller' => 'ModuleManager\Controller\IndexController',
                                    'action'     => 'info',
                                ),
                            ),
                        ),
                        'module-config-set' => array(
                            'type'    => 'Zend\Mvc\Router\Console\Simple',
                            'options' => array(
                                'route'    => ' module config set <name> <value>',
                                'defaults' => array(
                                    'controller' => 'ModuleManager\Controller\IndexController',
                                    'action'     => 'config',
                                ),
                            ),
                        ),
                        'module-config-get' => array(
                            'type'    => 'Zend\Mvc\Router\Console\Simple',
                            'options' => array(
                                'route'    => ' module config get <name>',
                                'defaults' => array(
                                    'controller' => 'ModuleManager\Controller\IndexController',
                                    'action'     => 'config',
                                ),
                            ),
                        ),
                        'module-help' => array(
                            'type' => 'Zend\Mvc\Router\Console\Simple',
                            'options' => array(
                                'route' => 'module help [ install | upgrade | remove ]:action',
                                'defaults' => array(
                                    'controller' => 'ModuleManager\Controller\HelpController',
                                    'action'     => 'usage',
                                ),
                            ),
                        ),
                    ),
                ),
            ),

            // Setup for the view layer.

            // Use Console renderer
            'Zend\View\Renderer\ConsoleRenderer' => array(
                'parameters' => array(
                    'resolver' => 'Zend\View\Resolver\AggregateResolver',
                ),
            ),

            // View script rendered in case of 404 exception
            'Zend\Mvc\View\RouteNotFoundStrategy' => array(
                'parameters' => array(
                    'displayNotFoundReason' => true,
                    'displayExceptions'     => true,
                    'notFoundTemplate'      => 'error/404',
                ),
            ),
            // View script rendered in case of other exceptions
            'Zend\Mvc\View\ExceptionStrategy' => array(
                'parameters' => array(
                    'displayExceptions' => true,
                    'exceptionTemplate' => 'error/index',
                ),
            ),
        ),
    ),
);
