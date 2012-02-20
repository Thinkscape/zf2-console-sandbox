<?php
use Zend\Stdlib\Request as BaseRequest,
    Zend\Mvc\Router\Console\RouteMatch,
    Zend\Console\Getopt,
    Zend\Mvc\Router\Console\Simple,
    Zend\Console\Request
//    Zend\Mvc\Router\Console\Simple
;

ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '_init.php';


$route = Simple::factory(array(
//    'route' => 'install ( module | package | application | app) NAME',
    'route' => '--foo --bar=n IMPORTANT',
));
$request = new Request();
$match = $route->match($request);

print_r($match);



//$g = new Getopt(
//    array(
//        'lines=s' => 'Lines-option'
//    ),
//    null,
//    array(
////        Getopt::CO
////        Getopt::CONFIG_FREEFORM_FLAGS   => true,
//        Getopt::CONFIG_PARSEALL         => false ,
//    )
//);
//$g->parse();
//print_r($g->getArguments());
//
