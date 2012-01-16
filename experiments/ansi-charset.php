<?php

for($x=33;$x<127;$x++){
    echo str_pad("$x (hex ".dechex($x).') ',15,' ',STR_PAD_RIGHT);
    echo chr($x);
    echo "   ";
    echo chr(27).'(0';  // activate DEC SG
    echo chr($x);
    echo chr(27).'(B';  // deactivate DEC SG
    if($x%4 === 0)
        echo "\n";
    else
        echo "  |  ";
}
echo "\n";
