<?php


$query= "SELECT id_auto_admin 
           FROM  acciones
           WHERE accion='$accion'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
    list($id_auto_admin) = mysql_fetch_row($result);
    



  $query= "SELECT id_apps,apps,nom_apps,ico_apps,accion,autor,fecha,orden  
           FROM  auto_admin_apps
           WHERE accion =$accion and id_auto_admin =$id_auto_admin"; 

        
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_apps,$apps,$nom_apps,$ico_apps,$acciones,$autor,$fecha,$orden) = mysql_fetch_row($result)){
      	
      	$cont++;
      	
      	
      	 
$query= "SELECT id_apps_permisos,id_apps,id_perfil
		FROM auto_admin_apps_permisos
		WHERE id_apps=$id_apps";
//echo $query;

$result44= cms_query($query)or die (error($query,mysql_error(),$php));
list($id_apps_permisos,$id_apps_o,$id_perfil) = mysql_fetch_row($result44);

  	       
		 include ("admin/administracion_sistema/apps/proc/lista_perfiles_apps.php");          
      	      
  $lista_perfiles_us="";


$query= "SELECT id_apps_permisos,id_apps,id_perfil
		FROM auto_admin_apps_permisos
		WHERE id_apps=$id_apps";
//echo "$query";

$result2E= cms_query($query)or die (error($query,mysql_error(),$php));
while (list($id_apps_permisos,$id_apps_u,$id_perfil_apps) = mysql_fetch_row($result2E)){


		$query= "SELECT perfil
				FROM usuario_perfil
				WHERE id_perfil ='$id_perfil_apps'";
//echo "$query<br>";

			$result1= cms_query($query)or die (error($query,mysql_error(),$php));
			list($perfil_us) = mysql_fetch_row($result1);

		$lista_perfiles_us.= "<tr><td align=\"center\" class=\"textos\" colspan=\"5\"> 
			        	 <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    						<tr>
    						     <td align=\"center\" class=\"textos\">$perfil_us</td>
			         			 <td align=\"center\" class=\"textos\">
			                     <a href=\"javascript:confirmar('Esta Seguro de Borrar','?accion=$accion&act=8&act_apps=d&id_apps=$id_apps_u')\">
	                             <img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a></td>
	                       </tr>
						</table>
			         </td></tr>";
		
		
		
		
}	


		$nom_tabla =tabla($id_auto_admin);

		$ruta= "images/sitio/sistema/$nom_tabla/auto_admin_apps/$apps";


      	 $aplicacion.="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#f8f8f8\">
      	                  <td align=\"center\" class=\"textos\" bgcolor=\"#CCCCCC\"><b>$cont</b></td>
			              <td align=\"center\" class=\"textos\" bgcolor=\"#CCCCCC\"><b>$nom_apps</b></td>
			               <td align=\"center\" class=\"textos\" bgcolor=\"#CCCCCC\" title=\"$ruta\"><b>$apps</b></td>
			               
			              <td align=\"center\" class=\"textos\" bgcolor=\"#CCCCCC\">
			              <a href=\"index.php?accion=$accion&act=8&act_apps=c&id_apps=$id_apps\"><img src=\"images/edit.gif\" alt=\"Editar\" border=\"0\"></a</td>
						  <td align=\"center\" class=\"textos\" bgcolor=\"#CCCCCC\">
			              <a href=\"javascript:confirmar('Esta Seguro de Borrar','?accion=$accion&act=8&act_apps=d&id_apps=$id_apps')\">
	                      <img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a></td>
			         </tr>
			         <tr>
			              <td align=\"center\" class=\"textos\" colspan=\"5\"> $lista_perfiles_apps</td></tr>
			         <tr>
			            <td align=\"center\" class=\"textos\" colspan=\"5\">&nbsp;</td>
			         </tr>			     
				     <tr>
				        <td align=\"center\" class=\"textos\" colspan=\"5\" bgcolor=\"#ccc\" height=\"1\" ></td>
				     </tr> ";
      	 
      	 
      	 
     }	 	 

   

 $listado_aplicacion= "<br><br>
      <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
       <tr>
          <td align=\"right\" class=\"textos\"><a href=\"index.php?accion=$accion&act=8&act_apps=a\"><img src=\"images/new.gif\" alt=\"Nuevo\" border=\"0\"></a></td>
       </tr>
        <tr>
          <td align=\"right\" class=\"textos\"><a href=\"index.php?accion=$accion&act=8&act_apps=a\">Nuevo</a></td>
       </tr>
 	</table>
     <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" class=\"cuadro\">
		     <tr class=\"cabeza\">
		        <td align=\"center\" >Nº</td>
		        <td align=\"center\" >Nombre Aplicaci&oacute;n</td>
		        <td align=\"center\" >PHP</td>		       
		        <td align=\"center\" width=\"10%\">Editar</td>
		        <td align=\"center\" width=\"10%\">Borrar</td>
		     </tr>
		       
		       $aplicacion 
                
		 	</table> 		";

		 	

 
 $contenido.=$listado_aplicacion;
		 
		
?>