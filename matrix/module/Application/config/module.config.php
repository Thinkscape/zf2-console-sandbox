<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'default' => array(
                    'type' => 'catchall',
                    'options' => array(
                        'route'=> '',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'usage',
                        ),
                    ),
                ),
                'index' => array(
                    'options' => array(
                        'route'    => ' [--speed=] [--intensity=] ',
                        'constraints' => array(
                            'speed'      => '/^[1-9]$/',
                            'intensity'  => '/^[0-9]+(?:\.[0-9]+)?$/',
                        ),
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'index',
                        ),
                    ),
                ),
                'usage' => array(
                    'options' => array(
                        'route' => '( --usage | --help | -h | --version | -v)',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action'     => 'usage',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
