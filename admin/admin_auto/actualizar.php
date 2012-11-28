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
     
     
$id_tipo_campo = $_POST['id_tipo_campo'];
$relacion = $_POST['relacion'];
$jshtml = $_POST['jshtml'];
$carpeta = $_POST['carpeta'];
$campo_relacion= $_POST['campo_relacion'];
$help = $_POST['help'];


$txt_xml= $_POST['txt_xml'];
$txt_form= acentos($_POST['txt_form']);

if($txt_xml!=""){
$xml = 1;

}
   

 
 if($var2==8){

	if(!is_dir("images/sitio/sistema/$tbl")){
		mkdir("images/sitio/sistema/$tbl");
	}
	
	if(!is_dir("images/sitio/sistema/$tbl/$nom_campo")){
		mkdir("images/sitio/sistema/$tbl/$nom_campo");
	}
	
}
 
    
$Sql ="UPDATE auto_admin_campo 
		set id_tipo_campo=$id_tipo_campo,
		relacion='$relacion' ,
		js='$jshtml',
		carpeta ='$carpeta' , 
		help='$help',
		xml='$xml',
		txt_xml='$txt_xml',
		txt_form='$txt_form',
		campo_relacion='$campo_relacion'
        WHERE campo ='$nom_campo' and id_auto_admin=$id_auto_admin";
	

 cms_query($Sql)or die (error($query,mysql_error(),$php));	
		   
		   echo "<script>alert('Datos Guardados $txt_xml'); document.location.href='?accion=$accion&act=3&tbl=$nom_tabla&nom_campo=$nom_campo';</script>\n";
		   
		 
	
}




?>