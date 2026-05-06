@echo off
title Dev Launcher

echo ==========================
echo Iniciando ambiente DEV...
echo ==========================

start "Backend API" cmd /k "cd sellingsystem-api && npm run dev"

start "Frontend App" cmd /k "cd sellingsystem-app && npx expo start"

echo.
echo Ambiente iniciado com sucesso!
pause