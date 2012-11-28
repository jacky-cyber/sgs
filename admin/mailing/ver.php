<?php

$accion = $HTTP_GET_VARS['accion'];

  $query= "SELECT id_mailing,titulo   
                           FROM  mailing";
                           $result= cms_query($query);
          $contenido ="<table width=\"450\" border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"2\">";
						   while (list($id_mailing,$titulo) = mysql_fetch_row($result)){
						 $fecha= fecha($id_mailing); 
						   $contenido .="<tr>
                                            <td align=\"left\" class=\"textos\">$titulo</td>
											<td align=\"left\" class=\"textos\">$fecha</td>
											 
											<td align=\"left\" class=\"textos\"><a href=\"mailing.php?ver=ok&accion=1\">Ver</a></td>
                                          <td align=\"left\" class=\"textos\"><a href=\"mailing.php?ver=ok&accion=2\">Reenviar</a></td>
                                         <td align=\"left\" class=\"textos\"><a href=\"mailing.php?ver=ok&accion=3\">Borrar</a></td>
                                          </tr>";
						   
						   
						   
						   }
						   
						   $contenido .=" </table>";

?>