<?php
	
	
	$id_mail = $_POST['id_mail'];
	$nombre = $_POST['nombre'];
	$mail_contacto = $_POST['mail_contacto'];
	$comentario = $_POST['comentario'];
	
	$query= "SELECT id_perfil,descripcion
           FROM contacto_mails
		   WHERE id_contacto = $id_mail";
    $result= cms_query($query)or die (error($query,mysql_error(),$php));
    list($perfil,$descripcion) = mysql_fetch_row($result);
	
	//Email
	$subject_cliente = html_template('subject_correo_contacto');
	$subject_cliente = cms_replace("#DESCRIPCION#",$descripcion,$subject_cliente);
	
	$mensaje_cliente = html_template('cuerpo_correo_contacto');
	$mensaje_cliente = cms_replace("#NOMBRE#",$nombre,$mensaje_cliente);
	$mensaje_cliente = cms_replace("#MAIL_CONTACTO#",$mail_contacto,$mensaje_cliente);
	$mensaje_cliente = cms_replace("#COMENTARIO#",$comentario,$mensaje_cliente);
	$envio_stop = 1;
	
	$query_correo = "SELECT email
					FROM usuario
					WHERE id_perfil LIKE '%$perfil%'";
	$result_correo= cms_query($query_correo)or die (error($query_correo,mysql_error(),$php));
    while(list($email) = mysql_fetch_row($result_correo)){
		
		// Envio correos funcionarios
		cms_mail($email,$subject_cliente,$mensaje_cliente,$headers,$envio_stop);
		$listado_correos .= $email.",";
	}
	$listado_correos = elimina_ultimo_caracter($listado_correos);
	
	$_POST["nombre"] = $nombre;
	$_POST["comentario"] = $comentario;
	$fecha = date(Y)."-".date(m)."-".date(d);
	$_POST["fecha"] = $fecha;
	$_POST["mail"] = $listado_correos;
	$_POST["mail_contacto"] = $mail_contacto;
	
	$contactos = inserta('contactos');
	//$contactos = mysql_insert_id();

	// Envio correo contacto
	if(!cms_mail($mail_contacto,$subject_cliente,$mensaje_cliente,$headers,$envio_stop)){
	
		header("Location:index.php?accion=$accion&act=4&contactos=$contactos&fin=0");

	}else{
	
		header("Location:index.php?accion=$accion&act=4&fin=1&contactos=$contactos&fin=1");

	}
	


?>