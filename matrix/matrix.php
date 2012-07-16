<?php
chdir(__DIR__);

// Setup autoloading
include '../vendor/ZendFramework/library/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true
    )
));

// Run the application!
Zend\Mvc\Application::init(include 'config/application.config.php')->run();
