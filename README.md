Creo el Proyecto

Quito los comentarios de .env a la base de datos.

Creo la base de datos en migrate.

Creo el modelo

Creo el controller AlumnoController

Creo las rutas ('/') que me dirigira al index y ('/alumno') que me dirigira al controller

Luego empiezo a crear las vistas, primero creo el layout, luego el index, show, form, create y edit.


Voy a hacerlo con mysql, asi que primro descargo php-mysql:
sudo apt update
sudo apt install -y php-mysql
sudo systemctl restart apache2 || sudo systemctl restart nginx


Tambien te puede saltar otro error si no pones contraseña, en mi caso pondre root la misma que el usuario


Hay que crear un modelo donde estaran lo que nos pide


Para subir una foto es sencillo, en la misma carpeta que estamos trabajando, pones php artisan storage:link. En .env cambiamos FILESYSTEM_DISK=public, 