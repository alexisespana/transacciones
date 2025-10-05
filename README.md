# Transacciones
## Pasos para levantar entorno de desarrollo en servidor local

- Primero descargar el codigo desde github

```
git clone https://github.com/alexisespana/transacciones.git
```
- Una vez dentro ejecutar lo siguiente se debe crear un nuevo archivo /.env y copiar lo que se encuentra en /.env-example

- Luego se debe ejecutar composer
```
composer install
```

- para la migraciones ejecute el siguiente comando
```
php artisan migrate:fresh --seed

esto crea las tablas y los usuarios de prueba
```


- Posterior a esto ejecutamos una limpieza de archivos temporales y configuraciones
```
php artisan config:cache

php artisan config:clear

php artisan cache:clear
```