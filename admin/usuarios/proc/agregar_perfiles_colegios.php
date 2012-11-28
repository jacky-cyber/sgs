<?php

       
$query_check = "SELECT id_perfil
          		FROM usuario_perfil";		  
	
$result_user_check = mysql_query($query_check) or die ("problemas en la consulta 1.<br>$query_check");


 while(list($id_perfil_check) = mysql_fetch_row($result_user_check)){
 $var = "id_perfil_check_$id_perfil_check";
 //echo $var." <br>";
    if($_POST[$var]){
// echo "ok";

  $query= "SELECT id_usuario 
           FROM  usuario_perfiles
           WHERE id_usuario='$id_user' and id_perfil=$id_perfil_check";
     $result= mysql_query($query)or die (mysql_error());
      if (!list($id_usuario,$nombre) = mysql_fetch_row($result)){
			 $qry_insert="INSERT INTO usuario_perfiles values ($id_user,$id_perfil_check)";
             $result_insert=mysql_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
 			   
		 }
     
 
      }
 	
 }

 
 if($establecimiento_seg!=""){
 
 
   $query= "SELECT id_usuario 
            FROM  usuario_establecimientos
            WHERE id_usuario='$id_user' and id_establecimiento=$establecimiento_seg";
      $result= mysql_query($query)or die (mysql_error());
       if (!list($id_usuario,$nombre) = mysql_fetch_row($result)){
 			$qry_insert="INSERT INTO usuario_establecimientos values ('$id_user','$establecimiento_seg')";
	        $result_insert=mysql_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");				   
 		 }
     
 }
	
	

?>