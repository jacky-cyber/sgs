<?php

$email = $_GET['email'];


  $query= "SELECT id_usuario 
           FROM  usuario
           WHERE email='$email'";
		   
		   
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     if(list($id_u) = mysql_fetch_row($result)){
			echo "<font color=\"#FF0000\">Este Correo Electr&oacute;nico ya existe <img src=\"images/atencion_pequenia.gif\" alt=\"\" border=\"0\"></font> ";			   
		 }else{
		 
		    if(comprobar_ecms_mail($email)){
				echo "<font color=\"#0000FF\">Correo Electr&oacute;nico Ok  <img src=\"images/ok2.gif\" alt=\"\" border=\"0\"></font> ";	
			}else{
			    echo "<font color=\"#FF0000\">Correo Electr&oacute;nico no Valido <img src=\"images/atencion_pequenia.gif\" alt=\"\" border=\"0\"></font> ";
			}
		   
		 
		 }

?>