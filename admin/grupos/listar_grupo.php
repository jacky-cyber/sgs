<?php

  $query= "SELECT id_grupo,grupo     
           FROM  accion_grupo";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     
      while (list($id_grupo,$grupo) = mysql_fetch_row($result)){
				$lista_grupo .="<tr>
				                 <td align=\"left\" class=\"textos\">$id_grupo</td>
						         <td align=\"left\" class=\"textos\">$grupo</td>
						         <td align=\"left\" class=\"textos\">
						         <a href=\"index.php?accion=$accion&act=1&id_grupo=$id_grupo\">
						         <img src=\"images/edit.gif\" alt=\"Editar\" border=\"0\"></a></td>
						         <td align=\"left\" class=\"textos\">
						         <a href=\"index.php?accion=$accion&act=3&id_grupo=$id_grupo\">
						 	     <img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a></td>						   	
						      
						    </tr>";		   
		 }
		 

		 $contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		                <tr>
                           <td  width=\"260\" align=\"right\" class=\"textos\" colspan=\"4\">
                           <a href=\"index.php?&accion=$accion&act=2\">
                           <img src=\"images/new.gif\" alt=\"\" border=\"0\"></a></td>
                        </tr>
                        <tr>
                           <td align=\"right\" class=\"textos\" colspan=\"4\">
						   <a href=\"index.php?&accion=$accion&act=2\">Agregar Grupo</a></td>
                        </tr>
		               </table>
		 
		<br><table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" class=\"cuadro\">		                  
                         <tr>
                           <td align=\"left\" class=\"cabeza_rojo\">&nbsp;Acci&oacute;n</td>
                           <td align=\"left\" class=\"cabeza_rojo\">&nbsp;T&iacute;tulo</td>
                           <td align=\"left\" class=\"cabeza_rojo\" width=\"10%\">&nbsp;Editar</td>
                           <td align=\"left\" class=\"cabeza_rojo\" width=\"10%\">&nbsp;Borrar</td>
                         </tr>
						 $lista_grupo
                        					
					   </table>";
		 
		 
		 
?>