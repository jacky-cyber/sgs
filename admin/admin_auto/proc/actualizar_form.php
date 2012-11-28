<?php


$Sql ="UPDATE auto_admin 
	   SET formulario ='$formulario',form_activo='$form_activo'
	   WHERE id_auto_admin ='$id_auto_admin'";

	// echo "$Sql";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
	   
	   
/*$contenido.="<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"0\" class=\"cuadro\">
		       <tr>
		           <td align=\"center\" class=\"cabeza\">Datos</td>
		       </tr>
		       <tr>
					<td align=\"left\" class=\"textos\">$formulario</td>
				</tr>
		 	</table>";*/

		

//echo "<script>alert('Datos Guardados '); document.location.href='index.php?accion=$accion&act=4&id_auto_admin=$id_auto_admin';</script>\n";
		 
		 
?>