<?php

$url = $_GET['url'];
$id_permiso = $_GET['id_permiso'];


 $query= "SELECT id_perfil,perfil   
           FROM  usuario_perfil
           ";
  //echo "$query<br>";
  
     $result5= cms_query($query)or die (error($query,mysql_error(),$php));
      while(list($id_perfil_u,$perfil) = mysql_fetch_row($result5)){
      	
      	 
      
	 $lista_permiso .="<option value=\"index.php?accion=$accion&act=10&id_perfil_u=$id_perfil_u\">$perfil</option>";


$select_permisos="<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">
   	    						<option value=\"#\">--Autorizar un Perfil--</option>
   	    						$lista_permiso
   	  						</select>";
      
      	
      }
	


$query= "SELECT id_auto_admin_permisos,id_auto_admin,id_perfil,ordenar,listar,ver,editar,crear,borrar,propietario ,configurar,xls   
           FROM  auto_admin_permisos
           	WHERE id_auto_admin=$id_auto_admin";
//echo "$query";

     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_auto_admin_permisos,$id_auto_admin,$id_perfil_usuario,$ordenar,$listar,$ver,$editar,$crear,$borrar,$propietario ,$configurar,$xls) = mysql_fetch_row($result2)){
     
      	
      	$query= "SELECT id_perfil,perfil   
           FROM  usuario_perfil
           WHERE id_perfil ='$id_perfil_usuario'";
  //echo "$query<br>";
  
     $result1= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_perfil,$perfil) = mysql_fetch_row($result1);
      
      
      	
      	$imagen_1 ="<span class=\"icon-ok\"></spam>";
      	$imagen_0 ="<span class=\"icon-remove\"></spam>";
      	
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
      	$var = "imagen_".$propietario ;
      	$ipropietario  = $$var;
      	
      	$var = "imagen_".$configurar;
      	$iconfigurar = $$var;
      	
      	
					
      	$datos .="<tr >
			<td align=\"left\" >$perfil</td>
			<td align=\"center\"  style=\"width:20px; text-align: center;\">
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=ordenar\">
			$iordenar</a></td>
			<td align=\"center\" >
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=listar\">
			$ilistar</a></td>
			<td align=\"center\"  style=\"width:20px; text-align: center;\" >
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=xls\">
			$ixls</a></td>
			<td align=\"center\"  style=\"width:20px; text-align: center;\" >
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=ver\">
			$iver</a></td>
			<td align=\"center\"  style=\"width:20px; text-align: center;\" >
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=editar\">
			$ieditar</a></td>
			<td align=\"center\"  style=\"width:20px; text-align: center;\" >
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=crear\">
			$icrear</a></td>
			<td align=\"center\"  style=\"width:20px; text-align: center;\" >
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=borrar\">
			$iborrar</a></td>
			<td align=\"center\"  style=\"width:20px; text-align: center;\" >
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=propietario\">
			$ipropietario</a></td>
			<td align=\"center\"  style=\"width:20px; text-align: center;\" >
			<a href=\"index.php?accion=$accion&act=9&id_permiso=$id_auto_admin_permisos&campo=configurar\">
			$iconfigurar</a></td>
			<td align=\"center\" >
			<a href=\"index.php?accion=$accion&act=11&id_permiso=$id_auto_admin_permisos\">
			<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>
			</td>
			<td align=\"center\" >
			<a href=\"index.php?accion=$accion&act=$act&id_permiso=$id_auto_admin_permisos&url=ok\">URL</a>
			</td>
			</tr>"; 
      	
		 }
		 

 $contenido ="
 
 				<br><br><table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" >
                   <tr >
                     <td align=\"center\" class=\"texto\">Seleccione un perfil para autorizar $select_permisos</td>
                     </tr>
					 <tr><td align=\"center\" class=\"textos\">
					 
				<div class=\"\">	 
					 
					 <table width=\"100%\" class=\"table table-bordered table-striped\">
    			<tr >
      				
 					<th align=\"center\" style=\"width:20px; text-align: center;\" >Perfil</th>
      				<th align=\"center\"  style=\"width:20px; text-align: center;\">Ordenar</th>
      				<th align=\"center\"  style=\"width:20px; text-align: center;\">Lista</th>
      				<th align=\"center\"  style=\"width:20px; text-align: center;\">Xls</th>
      				<th align=\"center\"  style=\"width:20px; text-align: center;\">Ver</th>
      				<th align=\"center\"  style=\"width:20px; text-align: center;\">Editar</th>
      				<th align=\"center\"  style=\"width:20px; text-align: center;\">Crear</th>
      				<th align=\"center\"  style=\"width:20px; text-align: center;\">Borrar</th>
      				<th align=\"center\"  style=\"width:20px; text-align: center;\">Propiet</th>
      				<th align=\"center\"  style=\"width:20px; text-align: center;\">Configurar</th>
      				<th align=\"center\"  style=\"width:20px; text-align: center;\">Eliminar</th>
      				<th align=\"center\"  style=\"width:20px; text-align: center;\">URL</th>
      			</tr>
      			$datos
			</table>
			</div>
			</td></tr> 
			<tr><td align=\"center\" class=\"textos\">Cantidad de registros por pagina <input type=\"text\" name=\"paginacion\" id=\"paginacion\" size=\"3\"> </td></tr> 
               	</table>
 				";
			
			
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

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
						   
						   
						   $contenido .= "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                           <tr>
                                             <td align=\"center\" class=\"textos\">Url : $url_form</td>
                                           </tr>
                                         </table>";
               	}
				
				
				
			
 
 ?>