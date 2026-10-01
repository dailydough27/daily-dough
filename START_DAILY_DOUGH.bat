@echo off
setlocal
cd /d "%~dp0"
start "Daily Dough Vite" cmd /k "npm run dev"
timeout /t 2 /nobreak >nul
start "Daily Dough Laravel" cmd /k "php artisan serve"
timeout /t 3 /nobreak >nul
start "" "http://127.0.0.1:8000"
