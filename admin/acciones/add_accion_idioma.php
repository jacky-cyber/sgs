<?php

	if($_GET['id_a']!=""){
	 $id= $_GET['id_a'];
	    $query= "SELECT accion 
               FROM  acciones
               WHERE id_acc='$id'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          if(list($accion_a) = mysql_fetch_row($result)){
		  
		  $_POST['accion']= $accion_a;
	inserta('accion_idioma'); 
	
		 $query= "SELECT id_accion_idioma,traduccion,id_idioma
               FROM  accion_idioma
			    WHERE accion='$accion_a'";
		 $result23= cms_query($query)or die (error($query,mysql_error(),$php));
         list($id_accion_idioma,$traduccion,$id_idioma) = mysql_fetch_row($result23);
		
	
	
	

			  
          
		  	   $idioma = rescata_valor('deuman_idioma',$id_idioma,'idioma');
		  
    				$lista_idiomas .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
					<td align=\"center\" class=\"textos\">
					$idioma </td>
					<td align=\"center\" class=\"textos\">$traduccion</td> 
					<td align=\"center\" class=\"textos\">
					<a href=\"#\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=23&id_idioma=$id_accion_idioma&axj=1','div_respuesta');\">
					<img src=\"images/del.gif\" alt=\"Eliminar\" border=\"0\"></a>
					</td> </tr> ";		   
    		
			 
			 $contenido ="<table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">
                             $lista_idiomas
                          	</table>";
		  }
		  
	
	}
?>