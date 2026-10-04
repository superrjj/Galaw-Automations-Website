@echo off
set PHP_DIR=C:\php85
set PATH=%PHP_DIR%;%PATH%
set PHPRC=%PHP_DIR%
cd /d "%~dp0"
"%PHP_DIR%\php.exe" -c "%PHP_DIR%\php.ini" artisan serve --host=127.0.0.1 --port=8000
