<?php
$tipo = $HTTP_GET_VARS['tipo'];
$del = $HTTP_GET_VARS['del'];

	if($del=="ok"){
	
	 $Sql ="DELETE FROM mailing_usuario
	        WHERE tipo = '$tipo'";
      cms_query($Sql);
	
	
	 $Sql ="DELETE FROM mailing_usuario_tipo WHERE id_tipo_u = '$tipo'";
      cms_query($Sql);
	   header("Location:$PHP_SELF?accion=$accion&act=3010");
	
	}	


      $query= "SELECT descrip   
             FROM mailing_usuario_tipo WHERE id_tipo_u = '$tipo'";
            $result= cms_query($query)or die ("ERROR 1 <br>$query");
			
			list($nombre_bd) = mysql_fetch_row($result);
	
	
	
			

$contenido.="  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                 <tr>
                   <td align=\"center\" class=\"textos\">Desea Borrar la Base <b>$nombre_bd</b></td>
                   </tr>
				    <tr>
                   <td align=\"center\" class=\"textos\">&nbsp;</td>
                   </tr>
				   <tr><td class=\"textos\" align=\"center\">
				    <a href=\"$PHP_SELF?accion=$accion&act=$accion&tipo=$tipo&del=ok&act_all=10\">Si</a>&nbsp;&nbsp;&nbsp;&nbsp;
				   <a href=\"$PHP_SELF?accion=$accion&act=3010&tipo=$tipo&act_all=1\">No</a> 
				   </td></tr>
				   </tr> 
             	</table>";

?>