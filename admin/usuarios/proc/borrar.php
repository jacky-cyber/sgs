<?php





 if($id_perfil==999){
 	$Sql ="DELETE FROM usuario
         where id_usuario='$id_user'";

 mysql_query($Sql);
  
       


         header("Location:?accion=$accion");  


 }else{
 	if($id_perfil!=999){
 		
 		$Sql ="DELETE FROM usuario
         where id_usuario='$id_user'";

 mysql_query($Sql);
         
         header("Location:?accion=$accion");  
         
  
  
 		
 	}
 }


 



 
?>