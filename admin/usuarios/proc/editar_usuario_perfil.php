<?php
//voy a editar a los usuarios 


	  $query= "SELECT id_usuario, id_perfil 
	           FROM  usuario
	           WHERE id_usuario='$id_usuario'";
	     $result= mysql_query($query)or die (mysql_error());
	   if (!list ($id_usuario,$id_perfil) = mysql_fetch_row($result)){
	   	
	   	
	   

	  	$qry_insert="INSERT INTO usuario (id_usuario, id_perfil, nombre, apellido, login, password, email, session, fecha) 
	   	 values ('','$id_usuario','$id_empresa','$id_perfil','$nombre','$apellido','$login','$password',
	   '$email', '$session', '$fecha' )";
	   	                 
	   	        $result_insert=mysql_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");
	   	      
			 }
	
	
	




?>