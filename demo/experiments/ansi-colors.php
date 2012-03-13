<?php

resetColors();
echo "+==============================================================================================+\n";
echo "|                          ANSI COLOR TEST (basic set)                                         |\n";
echo "+=============+================================================================================+\n";
echo "| Foreground  |                      Background                                                |\n";
echo "+-------------+--------+--------+--------+--------+--------+--------+--------+--------+--------+\n";

$colors = array('NORM','BLCK', 'RED', 'GRN', 'YELW','BLUE','MAGNT','CYAN','WHIT');
$fgVariants = array(
    'norml'   => 22,
    'bold'   => 1,
    'faint'  => 2,
    'blink'  => 5,
    'undrl'  => 4,
    'itali'  => 3,
);

foreach($fgVariants as $variantName => $variant){
    foreach($colors as $x=>$color){
        echo '|'.str_pad($variantName.' '.$x.' '.$color, 13, ' ', STR_PAD_RIGHT).'|';

        foreach($colors as $y=>$bgColor){
            if($x > 0){
                // set fg color
                echo chr(27).'['.$variant.';'.(30+$x-1).'m';
            }

            // set bg color
            if($y > 0){
                echo chr(27).'[22;'.(40+$y-1).'m';
            }
            echo str_pad($bgColor,8,' ',STR_PAD_BOTH);
            resetColors();
            echo "|";
        }
        echo "\n";
        resetColors();
    }

    echo "+-------------+--------+--------+--------+--------+--------+--------+--------+--------+--------+\n";
}
resetColors();



function resetColors(){
    echo chr(27).'[0;49m'; // reset bg color
    echo chr(27).'[22;39m'; // reset fg bold, bright and faint
    echo chr(27).'[25;39m'; // reset fg blink
    echo chr(27).'[24;39m'; // reset fg underline
}