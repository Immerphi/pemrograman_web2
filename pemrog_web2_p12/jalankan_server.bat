@echo off
setlocal
title Web Server Pemrograman Web 2 (Pertemuan 12)

echo ========================================================
echo  MEMPERSIAPKAN WEB SERVER PEMROGRAMAN WEB 2 (PERTEMUAN 12)
echo ========================================================

:: Coba nyalakan service MySQL jika terpasang
net start MySQL93 >nul 2>&1

echo [OK] MySQL Service diperiksa.
echo [OK] Menjalankan PHP Web Server di http://localhost:8000 ...
echo.
echo --------------------------------------------------------
echo  Browser akan terbuka otomatis dalam 2 detik.
echo  Tekan Ctrl + C di jendela ini untuk mematikan server.
echo --------------------------------------------------------
echo.

:: Otomatis buka browser setelah server siap
start "" "http://localhost:8000"

if exist "D:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe" (
    "D:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe" -S localhost:8000
) else if exist "D:\php-8.5.10-nts-Win32-vs17-x64\php.exe" (
    "D:\php-8.5.10-nts-Win32-vs17-x64\php.exe" -S localhost:8000
) else (
    php -S localhost:8000
)
pause
