Instalación de Sistema de Gestión de Solicitudes (1.2)

Importante: Al momento de instalar el software, se enviará un correo electrónico de manera automática a la Comisión de Probidad y Transparencia, notificando sobre una nueva instalación.

1. Antes de ejecutar la aplicación es necesario verificar, si su servidor cuenta con:

- Soporte Php 5.0
- Mysql 3.4 o superior
- SimpleXML
- Librería GD 2.0 o superior

2.Crear directorio en su servidor y copiar los archivos en ese directorio

3.Configurar lib/connect_db.inc.php indicando nombre de usuario , contraseña y nombre de base de datos.

4.Instalación de base de datos y sistema : 
	- Para Actualización de Sistema sgs: Crear Base de Datos con estructura entregada en archivo sgs_12_utf8.sql (debe tener el mismo usuario y contraseña que el actual sgs 1.022), ingresar a administración de sistemas con perfil "Administrador de Sistema", ingresar a modulo "Admin SGS->Actualización de Sistemas", seleccionar base de datos antigua con solicitudes de sgs 1.022 inportar datos.
	- Para instalacion desde cero: Crear Base de Datos con estructura entregada en archivo sgs_12_utf8.sql, ingresar a administración de sistemas con perfil "Administrador de Sistema", ingresar a modulo "Admin SGS->Configuración"

5.Ingresar a la url de su instalación y acceda a la cuenta de administrador.

6.Usuarios de Test


Ciudano solicitante Test:
usuario: solicitante@gmail.com
contraseña: 123456

Asignador de responsabilidades, se encarga de asignar solicitudes a los distintos Responsables del sistema
Usuario: asignador@servicio.gov.cl
contraseña: 123456

Digitador: Tiene funciones de ingreso de datos o solicitudes en papel u otro medio al sistema
usuario: digitador@servidor.gov.cl
contraseña : 123456

Responsable encargado de gestionar los estados de las solicitudes
usuario: responsable@servicio.gov.cl
Contraseña : 123456

Administrador de Sistema, puede crear usuarios del sistema 
Usuario: admin@servicio.gov.cl
contraseña: 123456

Jefatura, realiza gestión de solicitudes y visualiza reportes.
usuario: jefatura@servicio.gov.cl
Contraseña : 123456




7- UNA VEZ UTILIZADOS LOS USUARIOS DE PRUEBA, ELIMINARLOS DE LA BASE DE REGISTROS.

8- Respaldos automáticos por medio de un cron en url http://servidor_de_instalacion/admin/respaldar/respaldo_servidor.php
Los respaldos se generaran dentro de la carpeta "http://servidor_de_instalacion/admin/respaldar/" comprimiendo el archivo y agrgando la fecha de respaldo en su nombre


Correo de consultas: gestiondesolicitudes@minsegpres.gov.cl


Si al subir la base de datos via consola mysql tienen problemas con acentos o caracteres UTF8, deben subir de la siguiente forma la base :

mysql -u USUARIO_BASE_DATOS -p --default_character_set utf8 NOMBRE_DE_BASE_DE_DATOS < ARCHIVO.sql

Las palabras en mayœscula deben reemplazarlas por los daos de su instalaci—n.
