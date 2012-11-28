<?php



$nom_tabla = $_GET['tabla'];
$nom_campo = $_GET['nom_campo'];
$id = $_GET['id'];
$valor_nom_campo = $_GET['campo'];

$campo_pk= campo_pk_tabla($id_auto_admin);

$Sql ="UPDATE $nom_tabla 
	   SET $nom_campo =''
	   WHERE $campo_pk ='$id'";

//echo "$Sql";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	   
	  // echo "images/sitio/sistema/$nom_tabla/$nom_campo/$id/$valor_nom_campo";
	  
	   if(is_file("images/sitio/sistema/$nom_tabla/$nom_campo/$id/$valor_nom_campo")){
	   	
	   
	   unlink("images/sitio/sistema/$nom_tabla/$nom_campo/$id/$valor_nom_campo");		//borra la imagen del disco duro 	
	   
	   }
	   $contenido ="Archivo Borrado";




?>