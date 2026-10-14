@echo off
setlocal
echo [Menjalankan Setup Database dari Terminal...]
if exist "D:\php-8.5.10-nts-Win32-vs17-x64\php.exe" (
    "D:\php-8.5.10-nts-Win32-vs17-x64\php.exe" setup_db.php
) else (
    php setup_db.php
)
pause
