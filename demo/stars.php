<?php
/**
 * -------------------------------------------------------------------
 * Demo of cursor control and color changes
 * -------------------------------------------------------------------
 *
 * usage:
 *      php stars.php  [provider]  [charset]
 *
 *  [provider] - force provider (class name in Zend\Console\Adapter namespace)
 *  [charset]  - force charset (class name in Zend\Console\Charset namespace)
 *
 *  By default Zend\Console will auto-detect the best adapter and charset to use.
 */
require_once __DIR__ . '/_init.php';

/**
 * Hide cursor and get console size
 */
$width = $console->getWidth();
$height = $console->getHeight();
$console->hideCursor();

/**
 * Show cursor after program is terminated
 */
if(function_exists('pcntl_signal')){
    declare(ticks = 1);
    pcntl_signal(SIGINT,function()use(&$console, &$height){
        $console->showCursor();
        $console->setPos(1,$height);
        $console->clear();
        exit;
    });
}

/**
 * Show help message
 */
$console->writeAt('Press CTRL+C to exit.',1,$height,Zend\Console\Color::YELLOW);

/**
 * Display stars
 */
do{
    $rand = mt_rand(1,100);
    if($rand < 90){
        $console->writeAt(
            ' ',
            mt_rand(1,$width),
            mt_rand(3,$height-1)
        );
    }elseif($rand < 95){
        $console->writeAt(
            '*',
            mt_rand(1,$width),
            mt_rand(3,$height-1),
            mt_rand(0,1) ? \Zend\Console\Color::WHITE : \Zend\Console\Color::GRAY
        );
    }elseif($rand <= 100){
        $console->writeAt(
            '.',
            mt_rand(1,$width),
            mt_rand(3,$height-1),
            mt_rand(0,1) ? \Zend\Console\Color::WHITE : \Zend\Console\Color::GRAY
        );
    }
    usleep(10000);
}while(true);