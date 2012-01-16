<?php
echo chr(27).'[1J'; // cls

$buffer = array_fill(0,30,str_repeat(' ',120));
do{
//    echo chr(27).'[1J';
    echo chr(27).'[u';
    foreach($buffer as &$line){
        if(mt_rand(0,1)){
            $line[mt_rand(0,strlen($line)-1)] = ' ';
        }elseif(mt_rand(0,100) == 0){
            $line[mt_rand(0,strlen($line)-1)] = '*';
        }elseif(mt_rand(0,100) == 0){
            $line[mt_rand(0,strlen($line)-1)] = '.';
        }
        echo $line."\n";
    }
    usleep(10000);
}while(true);