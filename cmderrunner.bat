@echo off
start C:\laragon\bin\cmder\vendor\conemu-maximus5\ConEmu.exe /icon "C:\laragon\bin\cmder.exe" /title Cmder /loadcfgfile "C:\laragon\bin\cmder\config\user-ConEmu.xml" /cmd cmd /k "C:\laragon\bin\cmder\vendor\init.bat cd %CD% && %~1"
