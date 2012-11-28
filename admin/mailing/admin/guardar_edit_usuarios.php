<?php

$nombre = $HTTP_POST_VARS['nombre'];
$apellido = $HTTP_POST_VARS['apellido'];
$mail1 = $HTTP_POST_VARS['mail1'];
$mail2 = $HTTP_POST_VARS['mail2'];
$telefono1 = $HTTP_POST_VARS['telefono1'];
$telefono2 = $HTTP_POST_VARS['telefono2'];
$tipo = $HTTP_POST_VARS['tipo'];
$id_usuario = $HTTP_POST_VARS['id_usuario'];
$direccion = $HTTP_POST_VARS['direccion'];

$Sql ="UPDATE mailing_usuario 
	   SET nombre ='$nombre',
	       apellido='$apellido',
		   mail='$mail1',
		   mail2='$mail2',
		   telefono1='$telefono1',
		   telefono2='$telefono2',
		   tipo ='$tipo',
		   direccion='$direccion'
	   WHERE id_usuario ='$id_usuario'";
				  
	   cms_query($Sql)or die ("ERROR 1 <br>$Sql");

 header("Location:$PHP_SELF?accion=$accion&act=3010&act_all=3&id_usuario=$id_usuario&msg=1");
?>