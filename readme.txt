Instalaci�n de Sistema de Gesti�n de Solicitudes (1.2)

Importante: Al momento de instalar el software, se enviar� un correo electr�nico de manera autom�tica a la Comisi�n de Probidad y Transparencia, notificando sobre una nueva instalaci�n.

1. Antes de ejecutar la aplicaci�n es necesario verificar, si su servidor cuenta con:

- Soporte Php 5.0
- Mysql 3.4 o superior
- SimpleXML
- Librer�a GD 2.0 o superior

2.Crear directorio en su servidor y copiar los archivos en ese directorio

3.Configurar lib/connect_db.inc.php indicando nombre de usuario , contrase�a y nombre de base de datos.

4.Instalaci�n de base de datos y sistema : 
	- Para Actualizaci�n de Sistema sgs: Crear Base de Datos con estructura entregada en archivo sgs_12_utf8.sql (debe tener el mismo usuario y contrase�a que el actual sgs 1.022), ingresar a administraci�n de sistemas con perfil "Administrador de Sistema", ingresar a modulo "Admin SGS->Actualizaci�n de Sistemas", seleccionar base de datos antigua con solicitudes de sgs 1.022 inportar datos.
	- Para instalacion desde cero: Crear Base de Datos con estructura entregada en archivo sgs_12_utf8.sql, ingresar a administraci�n de sistemas con perfil "Administrador de Sistema", ingresar a modulo "Admin SGS->Configuraci�n"

5.Ingresar a la url de su instalaci�n y acceda a la cuenta de administrador.

6.Usuarios de Test


Ciudano solicitante Test:
usuario: solicitante@gmail.com
contrase�a: 123456

Asignador de responsabilidades, se encarga de asignar solicitudes a los distintos Responsables del sistema
Usuario: asignador@servicio.gov.cl
contrase�a: 123456

Digitador: Tiene funciones de ingreso de datos o solicitudes en papel u otro medio al sistema
usuario: digitador@servidor.gov.cl
contrase�a : 123456

Responsable encargado de gestionar los estados de las solicitudes
usuario: responsable@servicio.gov.cl
Contrase�a : 123456

Administrador de Sistema, puede crear usuarios del sistema 
Usuario: admin@servicio.gov.cl
contrase�a: 123456

Jefatura, realiza gesti�n de solicitudes y visualiza reportes.
usuario: jefatura@servicio.gov.cl
Contrase�a : 123456




7- UNA VEZ UTILIZADOS LOS USUARIOS DE PRUEBA, ELIMINARLOS DE LA BASE DE REGISTROS.

8- Respaldos autom�ticos por medio de un cron en url http://servidor_de_instalacion/admin/respaldar/respaldo_servidor.php
Los respaldos se generaran dentro de la carpeta "http://servidor_de_instalacion/admin/respaldar/" comprimiendo el archivo y agrgando la fecha de respaldo en su nombre


Correo de consultas: gestiondesolicitudes@minsegpres.gov.cl


Si al subir la base de datos via consola mysql tienen problemas con acentos o caracteres UTF8, deben subir de la siguiente forma la base :

mysql -u USUARIO_BASE_DATOS -p --default_character_set utf8 NOMBRE_DE_BASE_DE_DATOS < ARCHIVO.sql

Las palabras en may�scula deben reemplazarlas por los daos de su instalaci�n.
