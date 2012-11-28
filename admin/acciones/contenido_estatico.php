<?php
$url = $_GET['url'];
$id_permiso = $_GET['id_permiso'];


 $query= "SELECT id_noticia,titulo   
           FROM  noticias
           ";
  //echo "$query<br>";
  
     $result5= cms_query($query)or die (error($query,mysql_error(),$php));
      while(list($id_noticias,$contenido_estatico) = mysql_fetch_row($result5)){
      	
      	 
      
	 $lista_contenido .="<option value=\"index.php?accion=$accion&act=10&id_perfil_u=$id_noticias\">$contenido_estatico</option>";


$select_permisos="<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">
   	    						<option value=\"#\">--Seleccione Contenido--</option>
   	    						$lista_contenido
   	  						</select>";
      
      	
      }
	


$query= "SELECT id_auto_admin_permisos,id_auto_admin,id_perfil,ordenar,listar,ver,editar,crear,borrar,configurar,xls   
           FROM  auto_admin_permisos
           	WHERE id_auto_admin=$id_auto_admin";
echo "$id_auto_admin";

     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_auto_admin_permisos,$id_auto_admin,$id_perfil_usuario,$ordenar,$listar,$ver,$editar,$crear,$borrar,$configurar,$xls) = mysql_fetch_row($result2)){
     
      	
      	$query= "SELECT id_perfil,perfil   
           FROM  usuario_perfil
           WHERE id_perfil ='$id_perfil_usuario'";
  //echo "$query<br>";
  
     $result1= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_perfil,$perfil) = mysql_fetch_row($result1);
      
      
      	
      	$imagen_1 ="ok2.gif";
      	$imagen_0 ="not_ok2.gif";
      	
      	$var = "imagen_".$ver;
      	$iver = $$var;
      	
      	$var = "imagen_".$ordenar;
      	$iordenar = $$var;
      	
      	$var = "imagen_".$listar;
      	$ilistar = $$var;
      	
		$var = "imagen_".$xls;
      	$ixls = $$var;
      	
      	$var = "imagen_".$editar;
      	$ieditar = $$var;
      	
      	$var = "imagen_".$crear;
      	$icrear = $$var;
      	
      	$var = "imagen_".$borrar;
      	$iborrar = $$var;
      	
      	$var = "imagen_".$configurar;
      	$iconfigurar = $$var;
      	
      	
					
      	$datos .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#f8f8f8\">
			<td align=\"left\" class=\"textos\">$perfil</td>
			<td align=\"center\" class=\"textos\" width=\"8%\">
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=ordenar\">
			<img src=\"images/$iordenar\" alt=\"ordenar\" border=\"0\"></a></td>
			<td align=\"center\" class=\"textos\" width=\"8%\">
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=listar\">
			<img src=\"images/$ilistar\" alt=\"listar\" border=\"0\"></a></td>
			<td align=\"center\" class=\"textos\" width=\"8%\">
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=xls\">
			<img src=\"images/$ixls\" alt=\"listar\" border=\"0\"></a></td>
			<td align=\"center\" class=\"textos\" width=\"8%\">
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=ver\">
			<img src=\"images/$iver\" alt=\"ver\" border=\"0\"></a></td>
			<td align=\"center\" class=\"textos\" width=\"8%\">
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=editar\">
			<img src=\"images/$ieditar\" alt=\"editar\" border=\"0\"></a></td>
			<td align=\"center\" class=\"textos\" width=\"8%\">
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=crear\">
			<img src=\"images/$icrear\" alt=\"crear\" border=\"0\"></a></td>
			<td align=\"center\" class=\"textos\" width=\"8%\">
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=borrar\">
			<img src=\"images/$iborrar\" alt=\"borrar\" border=\"0\"></a></td>
			<td align=\"center\" class=\"textos\" width=\"8%\">
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=configurar\">
			<img src=\"images/$iconfigurar\" alt=\"configurar\" border=\"0\"></a></td>
			<td align=\"center\" class=\"textos\">
			<a href=\"index.php?accion=$accion&act=11&id_permiso=$id_auto_admin_permisos\">
			<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>
			</td>
			<td align=\"center\" class=\"textos\">
			<a href=\"index.php?accion=$accion&act=$act&id_permiso=$id_auto_admin_permisos&url=ok\">URL</a>
			</td>
			</tr>"; 
      	
		 }
		 

 $contenido ="
 
 				<br><br><table width=\"30%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" >
                   <tr >
                     <td align=\"center\" class=\"texto\">$select_permisos</td>
                     </tr>
               	</table><br>
 				<table width=\"70%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro\">
    			<tr class=\"cabeza_rojo\">
      				
 					<td align=\"center\" width=\"8%\" >Perfil</td>
      				<td align=\"center\" width=\"8%\">Ordenar</td>
      				<td align=\"center\" width=\"8%\">Lista</td>
      				<td align=\"center\" width=\"8%\">Xls</td>
      				<td align=\"center\" width=\"8%\">Ver</td>
      				<td align=\"center\" width=\"8%\">Editar</td>
      				<td align=\"center\" width=\"8%\">Crear</td>
      				<td align=\"center\" width=\"8%\">Borrar</td>
      				<td align=\"center\" width=\"8%\">Configurar</td>
      				<td align=\"center\" width=\"8%\">Eliminar</td>
      				<td align=\"center\" width=\"8%\">URL</td>
      			</tr>
      			$datos
			</table>";
			
			
			$url_form = $_POST['url_form'];
			
				if($url =="ok"){
				$accion_form = "index.php?accion=$accion&act=$act&id_permiso=$id_permiso";
				$contenido .= "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                <tr>
                                  <td align=\"center\" class=\"textos\">Ingrese Url por defecto para $perfil_url</td>
                                </tr>
								<tr><td align=\"center\" class=\"textos\">url :  <input type=\"text\" name=\"url_form\"></td></tr> 
								<tr><td align=\"center\" class=\"textos\"><input type=\"submit\" name=\"Submit\" value=\"Enviar\"> </td></tr> 
                              </table>";
				}elseif($url_form!=""){
				
					$Sql ="UPDATE auto_admin_permisos 
                    	   SET url ='$url_form'
                    	   WHERE id_auto_admin_permisos='$id_permiso'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
						   
						   
						   $contenido .= "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                           <tr>
                                             <td align=\"center\" class=\"textos\">Url : $url_form</td>
                                           </tr>
                                         </table>";
               	}
				
				
				
			


?>