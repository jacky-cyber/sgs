<?php
$opcion = $_GET['opcion'];

//rescato la direccion del php por si el usuario se mando un condoro pueda rescatar la dire
  $query= "SELECT php
           FROM  acciones
            WHERE id_acc='$id'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($php_last) = mysql_fetch_row($result);
	
	
	session_register_cms('php_ant');
	session_register_cms('id_php_ant');
	$_SESSION['php_last']=$php_last;
	$_SESSION['id_php_ant']=$id;
	




  $query= "SELECT php    
           FROM  accion_opciones_menu 
           WHERE  id_opcion_menu ='$opcion'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
    list($php) = mysql_fetch_row($result);
	
	if($php!=""){
	$string_php =",php='$php'";
	}
	
	
	$Sql ="UPDATE acciones 
	   SET opcion ='$opcion' $string_php
	   WHERE id_acc='$id'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
	


?>