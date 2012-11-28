<?php

       
$query_check = "SELECT id_perfil
          		FROM usuario_perfil";		  
	
$result_user_check = cms_query($query_check) or die (error($query_check,mysql_error(),$php));


 while(list($id_perfil_check) = mysql_fetch_row($result_user_check)){
 $var = "id_perfil_check_$id_perfil_check";
 //echo $var." <br>";
    if($_POST[$var]){
// echo "ok";

  $query= "SELECT id_usuario 
           FROM  usuario_perfiles
           WHERE id_usuario='$id_user' and id_perfil=$id_perfil_check";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if (!list($id_usuario,$nombre) = mysql_fetch_row($result)){
			 $qry_insert="INSERT INTO usuario_perfiles values ($id_user,$id_perfil_check)";
             $result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
 			   
		 }
     
 
      }
 	
 }

 
 if($establecimiento_seg!=""){
 
 
   $query= "SELECT id_usuario 
            FROM  usuario_establecimientos
            WHERE id_usuario='$id_user' and id_establecimiento=$establecimiento_seg";
      $result= cms_query($query)or die (error($query,mysql_error(),$php));
       if (!list($id_usuario,$nombre) = mysql_fetch_row($result)){
 			$qry_insert="INSERT INTO usuario_establecimientos values ('$id_user','$establecimiento_seg')";
	        $result_insert=cms_query($qry_insert)or die (error($qry_insert,mysql_error(),$php));
 		 }
     
 }
	
	

?>