<?php

$tabla .="  <table width=\"80%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";

  $query= "SELECT id_receptor,nombre,mail   
           FROM mailing_receptores ";
           $result= cms_query($query);
                while (list($id_receptor,$nombre,$mail) = mysql_fetch_row($result)){
                $tabla .="    <tr>
				              <td align=\"leftr\" class=\"textos\">$nombre</td>
							  <td align=\"left\" class=\"textos\">$mail</td>
                              <td align=\"center\" class=\"textos\">
							  <a href=\"$PHP_SELF?accion=$accion&act=3032&id_receptor=$id_receptor\" >Edit</a></td>
                              <td align=\"center\" class=\"textos\">
							  <a href=\"$PHP_SELF?accion=$accion&act=3033&id_receptor=$id_receptor\">Del</a></td>
                             </tr>";						   
				  }
       $tabla .="</table>    <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                               <tr>
                                 <td align=\"center\" class=\"textos\">&nbsp;</td>
                                 </tr>
								 <tr>
                                 <td align=\"center\" class=\"textos\">
								 <a href=\"$PHP_SELF?accion=$accion&act=3031\">Agregar Receptor</a></td>
                                 </tr>
                           	</table>";
	   
	   
	$contenido .= $tabla;
?>