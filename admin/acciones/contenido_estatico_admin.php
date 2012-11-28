<?php


$query= "SELECT descrip_php_esp
           FROM   acciones
           WHERE accion='$id'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($descrip_php_esp) = mysql_fetch_row($result);

		  $query= "SELECT id_noticia,titulo  
                   FROM  noticias
				   where id_tipo =3";
             $result_t= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_contenido_accion,$titulo) = mysql_fetch_row($result_t)){
			  $titulo= substr($titulo,0,30);
			  $titulo .="...";
        				$lista_contenido .="<option value=\"index.php?accion=$accion&act=12&id_noticia=$id_contenido_accion&id=$id\">$titulo</option>";
						
						
					$select_contenido="<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">
   	    						<option value=\"#\">--Seleccione Contenido--</option>
   	    						$lista_contenido
   	  						</select>";				   
        		 }


//echo$id_noticia;


$query= "SELECT titulo,id_accion_contenido,id_noticia,defecto 
         FROM  noticias n, accion_contenido ac
         WHERE ac.accion='$id' and n.id_noticia=ac.id_contenido
		 order by id_accion_contenido asc";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($titulo_contenido,$id_accion_contenido,$id_contenido_accion,$defecto) = mysql_fetch_row($result)){
	if($defecto==1){
	$marca= "(*)";
	
    }else{
	$marca="";
	
    }
			  
			  
			  
	$dato_contenido .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#f8f8f8\">
                 <td align=\"center\" class=\"textos\"><a href=\"index.php?accion=$accion&act=14&id_accion_contenido=$id_accion_contenido&id=$id\">$titulo_contenido</a>$marca
			     </td>
			     <td align=\"center\" class=\"textos\">
			     <a href=\"index.php?accion=$accion&act=13&id_accion_contenido=$id_accion_contenido&id=$id\">
			     <img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>
			     </td>			
			    </tr>"; 
      	
		 
		
	$accion_contenido="<table width=\"70%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro\">
    			<tr class=\"cabeza_rojo\">
				    <td align=\"center\" width=\"8%\">Contenido</td>
      				<td align=\"center\" width=\"8%\">Eliminar</td>
					</tr>
      			$dato_contenido
				</table>";
			 
		 
}
//accion_form = "index.php?accion=$accion&act=14&id_contenido=$id_contenido&acc_con=$accion_contenido";

//echo "hola";e
$contenido="<br><br>
			<table width=\"60%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
   			 <tr>
      			<td align=\"center\" class=\"cabeza_rojo\"><h4>Contenidos a $descrip_php_esp</h4></td>
      		</tr>
      		<tr><td align=\"center\" class=\"textos\" colspan=\"2\"> &nbsp;</td></tr>
       		<tr><td align=\"center\" class=\"textos\" colspan=\"2\"> &nbsp;</td></tr>
      		<tr>
      			<td align=\"center\" class=\"textos\"> 
      				<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      					<tr>
       						<td align=\"left\" class=\"textos\">Contenido Estatico</td>
          					<td class=\"textos\" width=\"51%\" align=\"left\"> 
                    		$select_contenido
         					</td>
       					</tr>
     					<tr><td align=\"center\" class=\"textos\" colspan=\"2\"> &nbsp;</td></tr>
       					<tr><td align=\"center\" class=\"textos\" colspan=\"2\"> &nbsp;</td></tr>
       					<tr><td align=\"center\" class=\"textos\" colspan=\"2\">
       						<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
       							<tr><td align=\"left\" class=\"textos\">* Para agregar un contenido estatico a la accion <b>$descrip_php_esp</b>, debe seleccionar el contenido del menu desplegable.</td></tr>
								<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
								<tr><td align=\"left\" class=\"textos\">* Para definir el contenido que quedara por defecto en la accion <b>$descrip_php_esp</b>, haga click sobre el contenido correspondiente en la lista.</td></tr>
								<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
							</table>
       					</td></tr>
	 					</table>
    	  			</td>
      			</tr>
		</table><br>
		$accion_contenido";	
		
     	
		
		
?>