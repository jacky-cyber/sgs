<?php
//voy hacer la consulta e ingresar los datos

header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); 

include("lib/connect_db.inc");    
include("lib/ft.inc");
include("lib/lib.inc");

$accion = $_GET['accion'];
$login = $_POST['login'];
$password = $_POST['password'];
$username = $_POST['username'];
$user_id = $_GET['user_id'];




$session_start();{ 

	
// reviso si coincide
if ( $login == "mmontoya" && $password == "amex05") {
         
$_SESSION['estado'] = "logeado"; // Coloco la variable de sesión 'estado'
           $msg = "<a href=\"adentro.php\">Bienvenido " . $login . ">></a>";
     
        } else {
     
         $msg = "Datos erroneos!!. <a href=\"acceso.html\">Inténtelo de nuevo.</a>";
     
        }
    
?> 
<html>
<head><title>:: Valida ::</title></head>
<body>
<p style="text-align:center;"><?php= $msg ?></p>
</form>
</body>
</html>









