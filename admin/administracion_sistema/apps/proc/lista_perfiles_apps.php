<?php
//lista perfiles apps
$lista_perfiles_apps="";
$lista_permiso2="";
 $query= "SELECT id_perfil,perfil   
           FROM  usuario_perfil
           ";
  //echo "$query<br>";
  
     $result5= cms_query($query)or die (error($query,mysql_error(),$php));
      while(list($id_perfil_us,$perfil_us) = mysql_fetch_row($result5)){
      	
      	 
      
	 $lista_permiso2 .="<option value=\"index.php?accion=$accion&act=8&act_apps=f&id_apps=$id_apps&id_perfil_us=$id_perfil_us\">$perfil_us</option>";


      
      	
      }
	

    $query= "SELECT id_apps_permisos,id_perfil  
             FROM  auto_admin_apps_permisos
             WHERE id_apps='$id_apps'";
			 
		 
       $result_ap= cms_query($query)or die (error($query,mysql_error(),$php));
        while (list($id_apps_permisos,$id_perfil_us) = mysql_fetch_row($result_ap)){
		
			$query= "SELECT perfil
				FROM usuario_perfil
				WHERE id_perfil ='$id_perfil_us'";


			$result1_ap= cms_query($query)or die (error($query,mysql_error(),$php));
			list($perfil_us) = mysql_fetch_row($result1_ap);
		
		
  			$lista_perfiles_apps .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
			<td align=\"left\" class=\"textos\">$perfil_us </td>
			<td align=\"left\" class=\"textos\" width=\"20\">
			<a href=\"index.php?accion=$accion&act=8&act_apps=g&id_apps=$id_apps&id_apps_permisos=$id_apps_permisos\">
			<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>
			</td> </tr> ";			   
  		 }

$lista_perfiles_apps="<table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
    <tr >
      <td align=\"right\" class=\"textos\" >
	  Seleccione un perfil para dar permisos a esta aplicaci&oacute;n
	  <select name=\"menu2\" onChange=\"MM_jumpMenu('parent',this,0)\">
   	    						<option value=\"#\">--Seleccione Perfil--</option>
   	    						$lista_permiso2
   	  						</select>
	  </td>
	  <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
      </tr>
	  <tr><td align=\"center\" class=\"textos\">
	    <table width=\"60%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
         $lista_perfiles_apps
      	</table>
	   </td></tr> 
	  
	  
	</table>

";


?>