<?php


	$fin = $_GET["fin"];
	if($fin == 0){
	
			/*
			$contenido .="<table width=\"70%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"3\" class=\"cuadro_light\">
				<tr>
				  <td  bgcolor=\"#DEE7F8\" align=\"center\" class=\"textos\">
				  <div align=\"center\"  class=\"textos\">Si existe algun tipo de problema intente mas tarde Gracias.</div></td>
				  </tr>
				</table>";
			*/
			
			$contenido = html_template('error_contacto');
	
	}else{
	
			/*
			$contenido .="
			
						<div class=\"tabla_verde\">
			<table width=\"70%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"3\" class=\"cuadro_light\">
					<tr>
					  <td   align=\"center\" class=\"textos\">
					  Gracias: $nombre </div></td>
					  </tr>
					  <tr><td align=\"center\" class=\"textos\"> la consulta <br>\"$comentario\"</td></tr> 
					  <tr><td align=\"center\" class=\"textos\">ser&aacute; respondida a la brevedad a tu Email $mail_contacto </td></tr> 
					</table>
					</div>";
			*/
	
			$contactos = $_GET["contactos"];
			
			$query = "SELECT nombre,comentario,mail_contacto
			   FROM contactos
			   WHERE id_contactos = '$id_contactos'";
			$result= cms_query($query)or die (error($query,mysql_error(),$php));
			list($nombre,$comentario,$mail_contacto) = mysql_fetch_row($result);
			
			$ok_contacto = html_template('ok_contacto');
			$ok_contacto = cms_replace("#NOMBRE#",$nombre_contacto,$ok_contacto);
			$ok_contacto = cms_replace("#MAIL_CONTACTO#",$mail_contacto,$ok_contacto);
			$ok_contacto = cms_replace("#COMENTARIO#",$comentario,$ok_contacto);
			
			$contenido = $ok_contacto;
	
	}


?>