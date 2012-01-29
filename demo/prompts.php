<?php
use Zend\Cli\Prompt;

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
$console->showCursor();

///**
// * Simple line prompt
// */
//$prompt = new Prompt\Line('What is your name? ');
//$name = $prompt->show();
//echo "Hello there $name!\n\n";
//
///**
// * Number float (with restrictions)
// */
//$prompt = new Prompt\Number('What is your age? (I won\'t tell anyone) ',false, false, 3, 150);
//$age = $prompt->show();
//echo "You're $age. Nice!\n\n";
//


echo "Really?";
passthru('choice /c:YN > result.txt');
passthru('echo %ERRORLEVEL%');

http://www.dostips.com/DtCodeSnippets.php

exit;

/**
 * Char prompt
 */
$prompt = new Prompt\Char('Are you a man or a woman? [m|w] ', 'mw');
$gender = $prompt->show();
echo "Ah, so you're a ". ($gender == 'm' ? "man" : "lady" ) . "...\n";









