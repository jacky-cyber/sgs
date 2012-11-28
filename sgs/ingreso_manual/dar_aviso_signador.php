<?php

$id_aviso_asig = $_POST['id_aviso_asig'];



    $query= "SELECT nombre ,paterno, email 
           FROM  usuario
           WHERE id_usuario='$id_aviso_asig'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($nombre_asig,$paterno_asig, $email_asig) = mysql_fetch_row($result);
	 
	 $destinatario = $email_asig;
	 
	     $query= "SELECT subjet,cuerpo   
                FROM  deuman_mails_alerta_perfil 
                WHERE descripcion ='Aviso ingreso solicitud'";
          $result= cms_query($query)or die (error($query,mysql_error(),$php));
           list($subjet,$cuerpo) = mysql_fetch_row($result);
		   $url=configuracion_cms("url");
		   
		   $subjet = cms_replace("#FOLIO#","$folio",$subjet);
	 	   
		   $cuerpo = cms_replace("#FOLIO#","$folio",$cuerpo);
		   $cuerpo = cms_replace("#URL#","$url",$cuerpo);
		   
		   cms_mail($destinatario,$subjet,$cuerpo,$headers);
		   
?>