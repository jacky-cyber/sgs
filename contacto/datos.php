<?php

	$id_contacto = $_POST["idMail"];
	$query= "SELECT ayuda
				   FROM contacto_mails
				   WHERE id_contacto = '$id_contacto'";
				   
	$result= cms_query($query)or die (error($query,mysql_error(),$php));
	if(list($ayuda) = mysql_fetch_row($result)){
	
		exit($ayuda);
		
	}





?>