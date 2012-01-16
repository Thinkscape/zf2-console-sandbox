<?php
error_reporting(E_ALL);
ini_set('display_errors',1);


/**
 * Ansicon method
 */
if(getenv('ANSICON')){
	echo chr(27) . ']0;ZUPK adsad adsadA'.chr(7);
	//echo chr(27) . '[4;31m' . 'lorem ' . chr(27) .'[0m' . "ipsum dolot amer\n";
	//echo chr(27) . 'g' . "\n";
}else{
	echo "ANSICON not installed.\n";
}
sleep(3);

exit;
/**
 * Powershell method
 */
echo "---------------\n";
echo "Lorem ";
passthru(
	'Powershell.exe -version 1.0 -NoLogo -NoProfile -Sta -NonInteractive -Command '.
	'write-host -nonewline -foregroundcolor Red "ipsum dolot amer"'
);






/**
 * Broken .NET method
 */
//$console = new DOTNET("mscorlib", "System.Console");
//Type t = t.GetType("Reflection.Singelton");
//object o = t.InvokeMember("getInstance", BindingFlags.InvokeMethod, null, t, new object[0]);
//$mi = new DOTNET("mscorlib", "System.Reflection.MethodInfo");
//exit;
//$type->InvokeMember("WriteLine");
//$console = new DOTNET("mscorlib", "System.Console");
//$console::WriteLine();
//$console->WriteLine( "Varible: " . $varible );
//$console->WriteLine();
