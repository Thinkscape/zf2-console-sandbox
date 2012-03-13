@echo off
rem ---------------------------------------------------------------------------------------------------------------
rem  Source: http://www.microsoft.com/resources/documentation/windows/xp/all/proddocs/en-us/percent.mspx?mfr=true
rem ---------------------------------------------------------------------------------------------------------------
php %~dp0\matrix.php %*


rem for /f %%i in ("%0") do set curpath=%%~dpi
rem php %curpath%\matrix.php;
