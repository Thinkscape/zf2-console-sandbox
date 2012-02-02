<?php
use Zend\Http\Request as Request,
    Zend\Stdlib\Request as BaseRequest,
    Zend\Mvc\Router\Cli\RouteMatch,
    Zend\Console\Getopt,
    Zend\Mvc\Router\Cli\Simple
//    Zend\Mvc\Router\Cli\Simple
;
require_once '_init.php';

$route = Simple::factory(array(
    'route' => 'install ( module | package | application | app) NAME',
    'route' => 'delete NAME [MODE]',
));


//$g = new Getopt(
//    array(
//        'lines=s' => 'Lines-option'
//    ),
//    null,
//    array(
//        Getopt::CONFIG_FREEFORM_FLAGS   => true,
//        Getopt::CONFIG_PARSEALL         => true ,
//    )
//);
//$g->parse();
//print_r($g->getArguments());

