<?php
//crear

$enviar = $_POST['enviar'];





$tbl = $_GET['tbl'];
$nom_campo= $_GET['nom_campo'];
$enviar = $_POST['enviar'];





$accion_form = "index.php?accion=$accion&act=$act&tbl=$nom_tabla&nom_campo=$nom_campo";
if($enviar=="" and $tbl!="" and $nom_campo!=""){
include ("admin/admin_auto/form/formulario.php");	




}else{
	
	
	
  $query= "SELECT id_auto_admin  
           FROM  auto_admin
           WHERE  tabla  ='$tbl'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_auto_admin) = mysql_fetch_row($result);
     
     
$id_tipo = $_POST['id_tipo'];
$relacion = $_POST['relacion'];
$jshtml = $_POST['jshtml'];
$carpeta = $_POST['carpeta'];
     
     
	 
	 
$Sql ="UPDATE auto_admin_campo 
		set id_tipo=$id_tipo,relacion='$relacion' ,js='$jshtml',carpeta ='$carpeta'
           WHERE campo ='$nom_campo' and id_auto_admin=$id_auto_admin";
			//echo $Sql;

 cms_query($Sql)or die (error($query,mysql_error(),$php));	
		   
		   echo "<script>alert('Datos Guardados'); document.location.href='index.php?accion=$accion&act=$act&tbl=$nom_tabla&nom_campo=$nom_campo';</script>\n";
		   
		 
	
}




?>