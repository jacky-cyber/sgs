<?php
//listado de plantillas



$query= "SELECT id_plantilla_noticia, nombre_plantilla,defecto   
           FROM  noticia_plantilla";
           
//echo "$query";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_plantilla,$nombre_plantilla,$defecto) = mysql_fetch_row($result)){
      	
if($defecto==1){
	$marca= "(*)";
	
}else{
	$marca="";
	
}
      			
      	$lista_plantilla .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"
>
      	<td align=\"left\" class=\"textos\">&nbsp;&nbsp;<a href=\"index.php?accion=$accion&act=8&id=$id_plantilla\">$nombre_plantilla</a>$marca</td>
			<td align=\"center\" class=\"textos\">
			 <a href=\"index.php?accion=$accion&act=10&id_plantilla=$id_plantilla\">
			 <img src=\"images/edit.gif\" alt=\"Editar\" border=\"0\"></a>
			</td>
			<td align=\"center\" class=\"textos\">
			 <a href=\"index.php?accion=$accion&act=11&id_plantilla=$id_plantilla\">
			 <img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>
			</td></tr>"; 
		 }
		 
		

		 
		 $contenido = "<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		     <tr>
		       <td align=\"left\" class=\"textos\">&nbsp;</td>
		       <td align=\"right\" width=\"70\"  class=\"textos\">
		       <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		      <tr>
		        <td align=\"center\" class=\"textos\">
		        <a href=\"?accion=$accion&act=6\">
		   <img src=\"images/new.gif\" alt=\"\" border=\"0\">
		   </a></td>
		        </tr>
		  	<tr>
		        <td align=\"center\" class=\"textos\">
		        <a href=\"?accion=$accion&act=6\">Nuevo</a>
		        </td>
		        </tr>
		        <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
		  	</table>
		       
		       </td>
		       </tr>
		 	</table>
		 
		 
		 
		 
		 <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" class=\"cuadro\">
		     <tr>
		       <td align=\"center\" class=\"cabeza_rojo\">Plantilla</td>
		       <td align=\"center\" width=\"8%\" class=\"cabeza_rojo\">Editar</td>
		       <td align=\"center\" width=\"8%\" class=\"cabeza_rojo\">Borrar</td>
		       </tr>
		       $lista_plantilla
		 	</table>";


?>