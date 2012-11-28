<?php
//voy a editar a los usuarios 


	  $query= "SELECT id_usuario, id_perfil 
	           FROM  usuario
	           WHERE id_usuario='$id_usuario'";
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	   if (!list ($id_usuario,$id_perfil) = mysql_fetch_row($result)){
	   	
	   	
	   

	  	$qry_insert="INSERT INTO usuario (id_usuario, id_perfil, nombre, apellido, login, password, email, session, fecha) 
	   	 values ('','$id_usuario','$id_empresa','$id_perfil','$nombre','$apellido','$login','$password',
	   '$email', '$session', '$fecha' )";
	   	                 
	   	        $result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
	   	      
			 }
	
	
	




?>