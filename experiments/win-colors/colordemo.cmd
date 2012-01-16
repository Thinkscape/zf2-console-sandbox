:: COLORDEMO.CMD ::::::::::::::::
@Echo OFF
SetLocal
If NOT DEFINED %0 (
  Set "%0=1"
  Start CMD /k%0
  Goto :EOF
)
MODE CON: COLS=80 LINES=59
::CLS
Set "Color.A="
Set "Color.B=                            Coloring The Console"
Set "Color.C="
Call :ColorPrint 0F

Echo.                               A Demonstration

Set "Color.B=                          Frank P. Westlake, 2007"
Call :ColorPrint 06
Echo.
Echo.

Set "Color.B=GENERAL"
Call :ColorPrint 0B

Set "Wrap=FINDSTR and SET/P can be used to print text in a selected"
Set "Wrap=%Wrap% color and in the default color both on the same"
Set "Wrap=%Wrap% line. For example:"
Call :Wrap
Set "Wrap="
Echo.

Set "Color.A=  Optional text, "
Set "Color.B=color text"
Set "Color.C=, optional text."
Call :ColorPrint 0D
Echo.

Set "Wrap=But because of the nasty colon this technique is probably"
Set "Wrap=%Wrap% only useful when a colon is useful, such as the"
Set "Wrap=%Wrap% following:"
Call :Wrap
Set "Wrap="

Echo.
Set "Color.A="
Set "Color.B=  Enabled"
Set "Color.C= Wireless network interface."
Call :ColorPrint 0A

Set "Color.B=  Disabled"
Set "Color.C= LAN interface."
Call :ColorPrint 0C
Echo.

Set "Color.A="
Set "Color.B=PROCEDURE"
Set "Color.C="
Call :ColorPrint 0B

Set "Wrap=The programmer sets text into one, two, or three variables"
Set "Wrap=%Wrap% as follows:"
Call :Wrap
Echo.
Set "Color.B=  VARIABLE  CONTENTS"
Call :ColorPrint 0B
Set "Wrap.Hang=            "
Set "Wrap=  Color.A   Optional text to be printed in the default"
Set "Wrap=%Wrap% color preceding the color text."
Call :Wrap
Set "Wrap=  Color.B   Text to be printed in a selected color."
Call :Wrap
Set "Wrap=  Color.C   Optional text to be printed in the default"
Set "Wrap=%Wrap% color following the color text."
Call :Wrap
Set "Wrap.Hang="
Echo.
Set "Wrap=The programmer then calls the :ColorPrint routine with a"
Set "Wrap=%Wrap% color value. For example:"
Call :Wrap
Set "Wrap="
Echo.
Set Wrap=  Set "Color.A=  Optional text, "
Call :Wrap
Set Wrap=  Set "Color.B=color text"
Call :Wrap
Set Wrap=  Set "Color.C=, optional text."
Call :Wrap
Set "Wrap=  Call :ColorPrint 0D"
Call :Wrap
Echo.
Echo.The output:
Echo.
Set "Color.A=  Optional text, "
Set "Color.B=color text"
Set "Color.C=, optional text."
Call :ColorPrint 0D
Echo.

Set "Wrap=The :ColorPrint routine creates a subdirectory in %%TEMP%%"
Set "Wrap=%Wrap% with the name of this script. This is so that there"
Set "Wrap=%Wrap% will be only one file in the directory.  Then a file"
Set "Wrap=%Wrap% is created in that directory with it's name being"
Set "Wrap=%Wrap% the string in the variable Color.B. The file is"
Set "Wrap=%Wrap% written with the contents of the variable Color.C,"
Set "Wrap=%Wrap% or only a newline if that variable is undefined."
Set "Wrap=%Wrap% SET/P is used to print Color.A without a newline,"
Set "Wrap=%Wrap% then FINDSTR is called to search the file for a"
Set "Wrap=%Wrap% line. FINDSTR prints the filename in the color"
Set "Wrap=%Wrap% specified in the CALL statement, then the contents"
Set "Wrap=%Wrap% of the file in the default color. The file and"
Set "Wrap=%Wrap% subdirectory are then both deleted."
Call :Wrap
Set "Wrap="
Echo.

Set "Wrap=One undesirable attribute of this technique is that it"
Set "Wrap=%Wrap% writes a file each time the print routine is called."
Call :Wrap
Set "Wrap="
Echo.
Call :Wrap The following characters may not be used in color strings:
Set Invalid="\|*/?:"
Set Invalid
Echo.
Set "Wrap=Experienced CMD script programmers might prefer to call"
Set "Wrap=%Wrap% SET/P and FINDSTR directly as needed."
Call :Wrap
Set "Wrap="
Set "Color.A="
Set "Color.B=Press any key to continue"
Set "Color.C="
Call :ColorPrint CF
PAUSE>NUL:
Exit
Goto :EOF


::::::::::::::::::::::::::::::::::::::::::::::::::ColorPrint
::ColorPrint ColorValue
Prints lines in the color specified on the command line with a nasty
colon.

INPUT VARIABLES:
  Color.A      First portion of line printed without color.
               May be undefined.
  Color.A      Middle portion of line printed with the color specified
               on the command line. Must be defined.
  Color.C      Final portion of line printed without color.
               May be undefined.
CHARACTERS:
Valid: 0-9 A-Z a-z `~!@#^$%&()-_+=[]{};',
Invalid: \|*/?:

EXAMPLE:
  Set "Color.A="
  Set "Color.B=Enabled"
  Set "Color.C= Wireless network interface."
  Call :ColorPrint 0A

:ColorPrint
MD    %Temp%\%~n0
Pushd %Temp%\%~n0
Echo.%Color.C%>"%Color.B%"
Set /P =%Color.A%<NUL:
FindStr /A:%1 /R "^" "%Color.B%*"
Popd
RD /S /Q %Temp%\%~n0
Goto :EOF

::::::::::::::::::::::::::::::::::::::::::::::::::Wrap
::Wrap
Reads text on the command line and performs word wrap printing to
STDOUT.

Do NOT use tab characters. A tab is a single character when
determining
line length but it could be up to eight columns when printing; which
might destroy the wordwrap feature for that line.

INPUT VARIABLES:
Wrap         Read if there is no text on the command line. Use this
             variable instead of the command line when leading spaces
             or special characters need to be preserved. Escape
             special characters with '^'. For example:

               Call :Wrap Pipe COMMAND1 to COMMAND2 using the
               syntax:
                 SET "Wrap=  COMMAND1 ^| COMMAND2"
                 Call :Wrap

Wrap.Indent  Set this variable with the amount of spaces necessary
             to indent each paragraph. Indent is first line only. For
             example:

               Set "Wrap.Indent=  "
               Call :Wrap Two leading spaces.

Wrap.Hang    Set this variable with amount of spaces necessary to
             indent the paragraph after the first line. For Example:

               Set "Wrap.Hang=  "
               Call :Wrap Paragraph hang indented two spaces.

:Wrap
SetLocal
For /F "tokens=2" %%a in ('MODE^|Find "Columns"') Do (
  Set /A Cols=%%a -2)
If "%*" NEQ "" Set "Wrap=%*"
If NOT DEFINED Wrap (
  For /F "delims=" %%W in ('MORE') Do Call :Wrap %%W
  Goto :EOF
)
Set "Wrap=%Wrap.Indent%%Wrap%"
:Wrap.Loop
CALL Set "prt=%%Wrap:~0,%cols%%%"
CALL Set "Test=%%Wrap:~%cols%%%"
Set /A i=cols
:Adjust
Set /A i=i-1
If NOT DEFINED TEST Goto :Print
If "%prt:~-1,1%" NEQ " " (
  Set "prt=%prt:~0,-1%"
  Goto :Adjust
)
Set /A i=i+1
:Print
CALL Set "Wrap=%%Wrap:~%i%%%"
Echo.%prt%
If DEFINED Wrap (
  Set "Wrap=%Wrap.Hang%%Wrap%"
  Goto :Wrap.Loop
)
EndLocal
Goto :EOF
:: END OF COLORDEMO.CMD :::::::::::::::::::::
