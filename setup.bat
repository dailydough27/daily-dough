@echo off
setlocal
cd /d "%~dp0"

echo ========================================
echo   Daily Dough - First Time Setup
 echo ========================================

echo.
where php >nul 2>nul || (echo PHP is not installed or not in PATH.& echo Install PHP 8.2+ then run this again.& pause& exit /b 1)
where composer >nul 2>nul || (echo Composer is not installed or not in PATH.& echo Install Composer from https://getcomposer.org/download/ then run this again.& pause& exit /b 1)
where npm >nul 2>nul || (echo Node.js/npm is not installed or not in PATH.& echo Install Node.js 20+ then run this again.& pause& exit /b 1)

if not exist bootstrap\cache mkdir bootstrap\cache
if not exist storage\framework mkdir storage\framework
if not exist storage\framework\views mkdir storage\framework\views
if not exist storage\framework\cache mkdir storage\framework\cache
if not exist storage\framework\sessions mkdir storage\framework\sessions
if not exist .env copy .env.example .env
if not exist database\database.sqlite type nul > database\database.sqlite

powershell -NoProfile -Command "(Get-Content .env) -replace '^DB_CONNECTION=.*','DB_CONNECTION=sqlite' | Set-Content .env"
powershell -NoProfile -Command "(Get-Content .env) -replace '^DB_DATABASE=.*','DB_DATABASE=database/database.sqlite' | Set-Content .env"

call composer install
if errorlevel 1 goto fail

php artisan key:generate
if errorlevel 1 goto fail

call npm install
if errorlevel 1 goto fail

php artisan migrate:fresh --seed
if errorlevel 1 goto fail

echo.
echo ========================================
echo Setup complete!
echo Run START_DAILY_DOUGH.bat to launch.
echo Admin: http://127.0.0.1:8000/admin/login
 echo Password: change-me
 echo ========================================
pause
exit /b 0

:fail
echo.
echo Setup failed. Read the error above, fix the missing dependency, then run setup.bat again.
pause
exit /b 1
