<?php




  $tabla .="<script languaje=\"javascript\">
function confirmar( mensaje, destino) {  
  if (confirm(mensaje)) {     
     document.location = destino ;  
	   }
}

</script>
<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";

  $query= "SELECT id_mailing,estado,titulo,subjet  
           FROM  mailing_mailing";
             $result= cms_query($query);
               while (list($id_mailing,$estado,$titulo,$subjet) = mysql_fetch_row($result)){
					  $query= "SELECT descrip,accion   
                               FROM  mailing_estado 
                               WHERE id_estado='$estado'";
                            $result2= cms_query($query);
							
                   list($descrip,$acc) = mysql_fetch_row($result2);
					
					$fecha = fechacorta($id_mailing);
					
					$tabla .="<tr>
                                    <td align=\"center\" class=\"textos\">$fecha</td>
                                    <td align=\"center\" class=\"textos\">$titulo</td>
                                    <td align=\"center\" class=\"textos\">$subjet</td>
                                    <td align=\"center\" class=\"textos\">
									<a href=\"index.php?accion=$accion&id_mailing=$id_mailing&act=$acc\">$descrip</a></td>
                                    <td align=\"center\" class=\"textos\">
									<a href=\"javascript:confirmar('Esta Seguro de Borrar este mail','$PHP_SELF?accion=$accion&act=3022&id_mailing=$id_mailing&del=ok')\">
									Borrar</a></td>
                             </tr>";
					
						   
				  }
       $tabla .="</table>";
	   
	   $contenido .= $tabla;
?>