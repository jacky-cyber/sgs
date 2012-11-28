<?php





  $query= "SELECT id_mailing,titulo     
            FROM  mailing_mailing
			Where estado='' or estado=5
			ORDER BY id_mailing DESC";
                          
			$result= cms_query($query)or die ("ERROR 1 <br>$query");	
					   
				$tabla .="<script languaje=\"javascript\">
function confirmar( mensaje, destino) {  
  if (confirm(mensaje)) {     
     document.location = destino ;  
	   }
}

</script><table width=\"80%\" border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
                           <tr>
                               <td align=\"left\" class=\"textos\">&nbsp;</td>
							   <td align=\"left\" class=\"textos\">&nbsp;</td>
                               <td align=\"left\" class=\"textos\">&nbsp;</td>
                               <td align=\"center\" class=\"textos\">&nbsp;</td>
							   <td align=\"center\" class=\"textos\">&nbsp;</td>
							   <td align=\"center\" class=\"textos\">&nbsp;</td>
                             </tr>";
                           while (list($id_mailing,$titulo) = mysql_fetch_row($result)){
						 
						   $fecha =fechacorta($id_mailing);
						   $hora = hora($id_mailing);
						   $tabla.="  <tr>
                               <td align=\"left\" class=\"textos\">$fecha</td>
							   <td align=\"left\" class=\"textos\">$hora</td>
                               <td align=\"left\" class=\"textos\">$titulo</td>
                               <td align=\"center\" class=\"textos\">
							   <a href=\"javascript:confirmar('Esta Seguro de Borrar $titulo','?accion=$accion&act=3021&id_mailing=$id_mailing&del=ok')\">Borrar</a></td>
							   <td align=\"center\" class=\"textos\">
							   <a href=\"$PHP_SELF?accion=$accion&act=1007&id_mailing=$id_mailing\">Re-Enviar</a></td>
                            <td align=\"center\" class=\"textos\">
							   <a href=\"$PHP_SELF?accion=$accion&act=1007&id_mailing=$id_mailing&t=1\">Re-Enviar 2</a></td>
                             </tr>
                           ";
						   }

				$tabla.="</table>";
						   
	$contenido .= $tabla;					   
?>