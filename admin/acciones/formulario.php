<?php
//formulario




  $query= "SELECT descrip_php_esp
           FROM   acciones
           WHERE id_acc='$id'";
 // echo $query;
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($descrip_php_esp) = mysql_fetch_row($result);

		  $query= "SELECT id_noticia,titulo  
                   FROM  noticias
				   where id_tipo =3";
             $result_t= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_noticia,$titulo) = mysql_fetch_row($result_t)){
			  $titulo= substr($titulo,0,30);
			  $titulo .="...";
        				$lista_contenido .="<option value=\"$id_noticia\">$titulo</option>";		   
        		 }






$accion_form = "index.php?accion=$accion&act=8&id_gru=$id_gru&id=$id";


$contenido="
			<table width=\"60%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
   			 <tr >
      			<td align=\"center\" class=\"cabeza_rojo\">Contenidos y Etiquetas</td>
      		</tr>
      		<tr>
      			<td align=\"center\" class=\"textos\"> 
      				<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      					<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
      					<tr>
       						<td align=\"left\" class=\"textos\">Acci&oacute;n</td>
          					<td align=\"left\" class=\"textos\">: <b>$descrip_php_esp</b></td>
       					</tr>	
       					<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
      					<tr>
       						<td align=\"left\" class=\"textos\">Contenido</td>
          					<td class=\"textos\" width=\"51%\" align=\"left\"> 
                    		<select name=\"id_contenido\">
                   				$lista_contenido
                    		</select>
         					</td>
       					</tr>
     					<tr>
       						<td align=\"left\" class=\"textos\">Etiqueta</td>
          					<td align=\"left\" class=\"textos\">
          					<input type=\"text\" name=\"etiqueta\" value=\"$etiqueta\"></td>
       					</tr>
       					<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
       					<tr>
       						<td align=\"center\" class=\"textos\">
       							<input type=\"hidden\" name=\"accion\" value=\"$id\">
       						</td>
       					</tr>
       					<tr><td align=\"center\" class=\"textos\">
       						<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    							<tr>       						
       								<td align=\"center\" class=\"textos\">
	       							<input type=\"submit\" name=\"Submit\" value=\"Enviar\"></td>
    	   						</tr>
       							<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
							</table>
       						</td>
       						</tr>
	 					</table>
    	  			</td>
      			</tr>
		</table>
		";
		


?>