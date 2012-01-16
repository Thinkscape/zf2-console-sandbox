<?php
/**
 * Setup autoloading
 */
chdir(__DIR__.'/../');
set_include_path(get_include_path().PATH_SEPARATOR.realpath(__DIR__.'/../vendor/ZendFramework/library'));
spl_autoload_register(function ($className){
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
});
ini_set('display_errors',1);
error_reporting(E_ALL);

/**
 * Load console
 */
$forceAdapter = isset($argv[1]) ? ucfirst(trim($argv[1])) : null;
$forceCharset = isset($argv[2]) ? ucfirst(trim($argv[2])) : null;
$console = Zend\Console\Console::getInstance($forceAdapter, $forceCharset);

/**
 * Output debug info
 */
$console->clear();
echo "Console adapter: ".str_replace('Zend\Console\Adapter\\','',get_class($console));
echo " | Charset: ".str_replace('Zend\Console\Charset\\','',get_class($console->getCharset()));
echo " | Width: ".$console->getWidth();
echo " | Height: ".$console->getHeight();
echo " | UTF8: ".($console->isUtf8() ? 'yes' : 'no');
echo "\n";
echo str_repeat('-',$console->getWidth());