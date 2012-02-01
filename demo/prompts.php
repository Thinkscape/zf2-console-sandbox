<?php
/**
 * -------------------------------------------------------------------
 *   Demo of interactive CLI prompts
 * -------------------------------------------------------------------
 *
 */
use Zend\Cli\Prompt,
    Zend\Console\Color
;
$forceAdapter = isset($argv[1]) ? ucfirst(trim($argv[1])) : null;
$forceCharset = isset($argv[2]) ? ucfirst(trim($argv[2])) : null;
require_once __DIR__ . '/_init.php';

/**
 * Simple line prompt
 */
$prompt = new Prompt\Line('What is your name? ');
$name = $prompt->show();
$console->writeLine("Hello there $name!",Color::GREEN);
$console->writeLine();

/**
 * Number float (with restrictions)
 */
$prompt = new Prompt\Number('What is your age? (I won\'t tell anyone) ',false, false, 3, 150);
$age = $prompt->show();
$console->writeLine("You're $age. Nice!",Color::GREEN);

/**
 * Single char selection
 */
$prompt = new Prompt\Char('How many children do you have?','012345');
$children = $prompt->show();
$console->writeLine("You told me that you have $children children",Color::GREEN);
$console->writeLine();

/**
 * Confirmation
 */
$prompt = new Prompt\Confirm('Do you want to continue? (y/n)');
$continue = $prompt->show();
if(!$continue){
    $console->writeLine("You've chosen not to continue...",Color::YELLOW);
    $console->writeLine("Good bye!");
    exit();
}

/**
 * A list of options (selection)
 */
$console->writeLine("Quiz time!");
$prompt = new Prompt\Select(
    'How many children did president Richard Nixon have?',
    array(
        'a' => '1 child',
        'b' => '2 children',
        'c' => '3 children',
        'd' => 'He never had children'
    )
);
$nixon = $prompt->show();
if($nixon != 'b'){
    $console->writeLine("Incorrect! Nixon had 2 daughters, Tricia and Julie.",Color::YELLOW);
}else{
    $console->writeLine("Correct! Nixon had 2 daughters, Tricia and Julie.",Color::GREEN);
}


/**
 * A selection which allows for empty response
 */
$prompt = new Prompt\Select(
    'In what year Rasmus Lerdorf created the first version of PHP? (press enter to skip)',
    array(
        '1' => 'In 1991',
        '3' => 'In 1993',
        '5' => 'In 1995',
        '7' => 'In 1997'
    ),
    true
);
$year = $prompt->show();
if(!$year){
    $console->writeLine("You didn't answer, but that's ok.");
}if($year != '5'){
    $console->writeLine("Incorrect! PHP was created in 1995.",Color::YELLOW);
}else{
    $console->writeLine("Correct! PHP was announced by Rasmus Lerdorf on Usenet group in 1995.",Color::GREEN);
}

$console->writeLine("");
$console->writeLine("That wraps it up! Thanks and see you around :)");








//echo "Press something ";
//system('choice /n /cs /c 0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz > NUL',$return);
//var_dump($return);
//exit;
//passthru('choice /c:YN > result.txt');
//passthru('echo %ERRORLEVEL%');
//http://www.dostips.com/DtCodeSnippets.php



