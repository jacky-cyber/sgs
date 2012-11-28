<?php



$accion_form="$PHP_SELF?accion=$accion&act=$act&act_all=4";


  $query= "SELECT   id_usuario,nombre,apellido,mail,mail2,telefono1,telefono2,tipo,nomas,id_mailing_nomas,direccion     
           FROM mailing_usuario
           WHERE id_usuario='$id_usuario'";
     $result= cms_query($query)or die ("ERROR 1 <br>$query");
      while (list($id_usuario,$nombre,$apellido,$mail1,$mail2,$telefono1,$telefono2,$tipo,$nomas,$id_mailing_nomas,$direccion) = mysql_fetch_row($result)){
			
			   $query= "SELECT  id_tipo_u,descrip   
                         FROM mailing_usuario_tipo ";
            $resultr= cms_query($query)or die ("ERROR 1 <br>$query");
      
			
			 while (list($id_tipo_u,$descrip) = mysql_fetch_row($resultr)){
			 
		        if($tipo==$id_tipo_u){
		        	$option_sell .="<option value=\"$id_tipo_u\" selected>$descrip</option>";   
						
			       }else{
				   $option_sell .="<option value=\"$id_tipo_u\">$descrip</option>";   
					
				   }
						   }

			
			$formulario = "<table width=\"60%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                            <tr>
                              <td align=\"left\" class=\"textos\">Nombre:</td>
							  <td align=\"center\" class=\"textos\">
							  <input type=\"text\" name=\"nombre\" class=\"textos\" value=\"$nombre\"></td>
                            </tr>
							 <tr>
                              <td align=\"left\" class=\"textos\">Apellido:</td>
							  <td align=\"center\" class=\"textos\">
							  <input type=\"text\" name=\"apellido\" class=\"textos\" value=\"$apellido\"></td>
                            </tr>
							 <tr>
                              <td align=\"left\" class=\"textos\">Mail1:</td>
							  <td align=\"center\" class=\"textos\">
							  <input type=\"text\" name=\"mail1\" class=\"textos\" value=\"$mail1\"></td>
                            </tr>
							 <tr>
                              <td align=\"left\" class=\"textos\">Mail2:</td>
							  <td align=\"center\" class=\"textos\">
							  <input type=\"text\" name=\"mail2\" class=\"textos\" value=\"$mail2\"></td>
                            </tr>
							 <tr>
                              <td align=\"left\" class=\"textos\">Tel&eacute;fono1:</td>
							  <td align=\"center\" class=\"textos\">
							  <input type=\"text\" name=\"telefono1\" class=\"textos\" value=\"$telefono1\"></td>
                            </tr>
							
							 <tr>
                              <td align=\"left\" class=\"textos\">Tel&eacute;fono2:</td>
							  <td align=\"center\" class=\"textos\">
							  <input type=\"text\" name=\"telefono2\" class=\"textos\" value=\"$telefono2\">
							  <input type=\"hidden\" name=\"id_usuario\" value=\"$id_usuario\">
							  </td>
                            </tr>
							<tr>
                              <td align=\"left\" class=\"textos\">Direcci&oacute;n:</td>
							  <td align=\"center\" class=\"textos\">
							     <input type=\"text\" name=\"direccion\" class=\"textos\" value=\"$direccion\" size=\"30\">
							   </td>
                            </tr>
							 <tr>
                              <td align=\"left\" class=\"textos\">Base:</td>
							  <td align=\"center\" class=\"textos\">
							  <select name=\"tipo\">
							   $option_sell
                              </select>
							  </td>
                            </tr>
                          </table>
						    <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                              <tr>
                                <td align=\"center\" class=\"textos\">
								<input name=\"Submit\" type=\"image\" value=\"Enviar\" src=\"images/bot_aceptar.gif\">
                                    </td>
                                </tr>
                          	</table>";			   
		 }
		
		 
		 $contenido .= $formulario;
?>