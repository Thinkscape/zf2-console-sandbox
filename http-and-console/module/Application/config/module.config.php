<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    /* // old console routes from module-manager example:
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
    ),*/
);
