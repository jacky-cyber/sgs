<?php
$last_php = $_SESSION['php_last'];

  $query= "SELECT id_opcion_menu    
           FROM  accion_opciones_menu 
           WHERE   php  = '$last_php'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
    if(!list($opcion) = mysql_fetch_row($result)){
	
	   $query= "SELECT id_opcion_menu    
           FROM  accion_opciones_menu 
           WHERE   php=''";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($opcion) = mysql_fetch_row($result);
	  
	  
	
	
	}
	
	
	
	$Sql ="UPDATE acciones 
	   SET opcion ='$opcion',php='$last_php'
	   WHERE id_acc='$id'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));

?>