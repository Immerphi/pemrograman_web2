@echo off
setlocal
title Setup Database Pemrograman Web 2 (Pertemuan 12)

echo ========================================================
echo  SETUP DATABASE PERTEMUAN 12 (BAB VIII MANIPULASI DB)
echo ========================================================
echo Menyiapkan database 'lat_dbase' dan 'artikel_db'...
echo.

if exist "D:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe" (
    "D:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe" setup_db.php
) else if exist "D:\php-8.5.10-nts-Win32-vs17-x64\php.exe" (
    "D:\php-8.5.10-nts-Win32-vs17-x64\php.exe" setup_db.php
) else (
    php setup_db.php
)

pause
