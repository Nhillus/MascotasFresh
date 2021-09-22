@echo off

echo   - = = =   Schedule Run Jobs == = = = -


CD d: &&  CD C:\Users\kire\Desktop\Mesa de trabajo Laravel\MascotasFreshDogctor\MascotasFresh-Backend && php artisan command:CheckLowStock

timeout 60

CD d: &&  CD C:\Users\kire\Desktop\Mesa de trabajo Laravel\MascotasFreshDogctor\MascotasFresh-Backend && "cronjob.cmd"

pause

@cls
