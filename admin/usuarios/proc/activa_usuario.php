<?php

$id_user = $_GET['id_user'];
$estado = $_GET['estado'];

if($id_usuario!=$id_user){

$Sql ="UPDATE usuario
	   SET estado ='$estado'
	   WHERE id_usuario ='$id_user'";

 mysql_query($Sql)or die (mysql_error());
	   
	   header("HTTP/1.0 307 Temporary redirect");
       header("Location:index.php?accion=$accion");
}else{

echo "<script>alert('No puedes generar cambios en tu propio usuario'); document.location.href='index.php?accion=$accion';</script>\n";

}




?>