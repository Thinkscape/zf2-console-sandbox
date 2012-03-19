<?php
/**
 * -------------------------------------------------------------------
 * This demo shows basic box-drawing across all adapters and charsets
 * -------------------------------------------------------------------
 *
 * usage:
 *      php boxes.php  [provider]  [charset]
 *
 *  [provider] - force provider (class name in Zend\Console\Adapter namespace)
 *  [charset]  - force charset (class name in Zend\Console\Charset namespace)
 *
 *  By default Zend\Console will auto-detect the best adapter and charset to use.
 */
$forceAdapter = isset($argv[1]) ? ucfirst(trim($argv[1])) : null;
$forceCharset = isset($argv[2]) ? ucfirst(trim($argv[2])) : null;
require_once __DIR__ . '/_init.php';

$width = $console->getWidth();
$height = $console->getHeight();

/**
 * Green box
 */
$console->writeBox(
    round($width*0.01),
    3,
    round($width*0.4),
    round($height*0.9),
    \Zend\Console\Adapter::LINE_BLOCK,
    \Zend\Console\Adapter::FILL_BLOCK,
    \Zend\Console\Color::GREEN,
    null,
    \Zend\Console\Color::LIGHT_GREEN
);

/**
 * Blue box
 */
$console->writeBox(
    round($width*0.4)+2,
    round($height*0.5),
    round($width*0.4)+2+round($width*0.2),
    round($height*0.9),
    \Zend\Console\Adapter::LINE_BLOCK,
    \Zend\Console\Adapter::FILL_BLOCK,
    \Zend\Console\Color::BLUE,
    null,
    \Zend\Console\Color::LIGHT_BLUE
);

/**
 * Red box
 */
$console->writeBox(
    round($width*0.4)+2+round($width*0.2)+2,
    round($height*0.8),
    round($width*0.99),
    round($height*0.9),
    \Zend\Console\Adapter::LINE_BLOCK,
    \Zend\Console\Adapter::FILL_BLOCK,
    \Zend\Console\Color::RED,
    null,
    \Zend\Console\Color::LIGHT_RED
);

/**
 * Small boxes
 */
$x = round($width*0.4)+2+round($width*0.2)+10;
$count = ceil((round($width*0.99) - (round($width*0.4)+2+round($width*0.2)+2)) / 6);
//var_dump($count);exit;
//$count = 3;
for($y = round($height*0.8)-1; $y > 5; $y -= 4){
    $x += mt_rand(-3,3);
    for(
        $no = 0;
        $no<$count && (($x+($no*5)+4) < $width);
        $no++
    ){
        $console->writeBox(
            $x+($no*5),
            $y-3,
            $x+($no*5)+4,
            $y,
            \Zend\Console\Adapter::LINE_SINGLE,
            mt_rand(0,1) ? \Zend\Console\Adapter::FILL_SHADE_MEDIUM : \Zend\Console\Adapter::FILL_SHADE_LIGHT,
            \Zend\Console\Color::WHITE,
            \Zend\Console\Color::BLACK,
            \Zend\Console\Color::GRAY,
            mt_rand(0,1) ? \Zend\Console\Color::GREEN : \Zend\Console\Color::LIGHT_YELLOW
        );
    }
    if($count > 0)
        $count -= mt_rand(0,3) ;
}

$console->setPos(1,$height-1);

