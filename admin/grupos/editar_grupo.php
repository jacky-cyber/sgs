<?php
$id_grupo = $_GET['id_grupo'];

$edit = $_GET['edit'];

if($edit!=""){

$id_grupo = $_POST['id_grupo'];
$grupo = $_POST['grupo'];


$Sql ="UPDATE accion_grupo 
	   SET grupo ='$grupo'
	   WHERE id_grupo ='$id_grupo'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
}else{

$query= "SELECT grupo   
           FROM  accion_grupo
           WHERE id_grupo='$id_usuario'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($grupo) = mysql_fetch_row($result);
	  
	  $accion_form = "index.php?accion=$accion&act=$act&edit=ok";
	  include("admin/grupos/formulario_grupo.php");
	
}

    

?>