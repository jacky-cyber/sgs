<?php
$tipo = $HTTP_GET_VARS['tipo'];

$Sql ="UPDATE mailing_usuario
	   SET nomas =''
	   WHERE id_usuario ='$id_usuario'";
				  
	   cms_query($Sql)or die ("ERROR 1 <br>$Sql");
	 
	   header("Location:$PHP_SELF?accion=$accion&act=3010&act_all=1&tipo=$tipo");   

?>