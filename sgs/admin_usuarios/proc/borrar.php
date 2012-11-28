<?php

$sql_update = "update sgs_solicitud_acceso set id_responsable = 0 where id_responsable = '$id_user'";

 if($id_perfil==999){
 
 
 
 	$Sql ="DELETE FROM usuario
         where id_usuario='$id_user'";

 cms_query($Sql);

 cms_query($sql_update);
  
         header("Location:?accion=$accion");  


 }else{
 	if($id_perfil!=999){
 		
 		$Sql ="DELETE FROM usuario
         where id_usuario='$id_user'";

 cms_query($Sql);

 cms_query($sql_update);
         
         header("Location:?accion=$accion");  
         
  
  
 		
 	}
 }


 



 
?>