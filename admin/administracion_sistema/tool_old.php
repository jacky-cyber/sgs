<?php


//barra de herramientas (tool.php)
$id_perfil = perfil($id_sesion);
$query= "SELECT id_auto_admin   
           FROM  acciones
           WHERE accion='$accion'";

   		$result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_auto_admin) = mysql_fetch_row($result);


if(verfica_permiso($id_auto_admin,$id_perfil,'configurar') ){
			
	$configurar_perfiles = " <td align=\"right\"   class=\"textos\">
	<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		     
				<tr>
		        <td align=\"center\" class=\"textos\">
		        <a href=\"?accion=$accion&act=8\">
		        <img src=\"images/b_tblops.jpg\" alt=\"configurar\" border=\"0\"></a></td>		 
		     </tr>
		      <tr>
		        <td align=\"center\" class=\"textos_simple\">
		        <a href=\"?accion=$accion&act=8\">Configurar</a>
		        </td>
		    </tr>
		    
	</table></td>";
	
}elseif($id_perfil==999){

$configurar_perfiles = " <td align=\"right\"   class=\"textos\">
	<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		     
				<tr>
		        <td align=\"center\" class=\"textos\">
		        <a href=\"?accion=$accion&act=8\">
		        <img src=\"images/b_tblops.jpg\" alt=\"configurar\" border=\"0\"></a></td>		 
		     </tr>
		      <tr>
		        <td align=\"center\" class=\"textos_simple\">
		        <a href=\"?accion=$accion&act=8\">Configurar</a>
		        </td>
		    </tr>
		    
	</table></td>";

}

	if(verfica_permiso($id_auto_admin,$id_perfil,'ordenar')){
		
			
	$configurar_ordenar = "<td align=\"right\" class=\"textos\">
	<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		     
				<tr>
		        <td align=\"center\" class=\"textos\">
		        <a href=\"?accion=$accion&act=5\">
		        <img src=\"images/ordenar.gif\" alt=\"ordenar\" border=\"0\"></a></td>		 
		     </tr>
		      <tr>
		        <td align=\"center\" class=\"textos_simple\">
		        <a href=\"?accion=$accion&act=5\">Ordenar</a>
		        </td>
		    </tr>
		    
	</table></td>";
		
	}
	
	if(verfica_permiso($id_auto_admin,$id_perfil,'crear')){
		
		$configurar_crear = "<td align=\"right\"   class=\"textos\">
	<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		      <tr>
		        <td align=\"center\" class=\"textos\">
		        <a href=\"?accion=$accion&act=1&id_a=$id_auto_admin\">
		        <img src=\"images/new.gif\" alt=\"nuevo\" border=\"0\"></a></td>		 
		     </tr>
		    <tr>
		        <td align=\"center\" class=\"textos_simple\">
		        <a href=\"?accion=$accion&act=1&id_a=$id_auto_admin\">Nuevo $nom_camp</a>
		        </td>
				</tr>
	</table></td>";
		
	}

	//if(verfica_permiso($id_auto_admin,$id_perfil,'ver')){
	if($id_perfil==999){	
		$busqueda = "<td align=\"right\"   >
	<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		      <tr>
		        <td align=\"center\" class=\"textos\">
		        <a href=\"?accion=$accion&act=14&id_auto_admin=$id_auto_admin\">
		        <img src=\"images/lupa.gif\" alt=\"Busqueda Avanzada\" border=\"0\"></a></td>		 
		     </tr>
		    <tr>
		        <td align=\"center\" class=\"textos_simple\">
		        <a href=\"?accion=$accion&act=14&id_auto_admin=$id_auto_admin\" >Busqueda <br>Avanzada</a>
		        </td>
				</tr>
	</table></td>";
		
	}
	
	if(verfica_permiso($id_auto_admin,$id_perfil,'xls')){
		
		$xls = "<td align=\"right\"   >
	<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		      <tr>
		        <td align=\"center\" class=\"textos\">
		        <a href=\"?accion=$accion&act=16&id_auto_admin=$id_auto_admin\">
		        <img src=\"images/excel_min.jpg\" alt=\"Busqueda Avanzada\" border=\"0\"></a></td>		 
		     </tr>
		    <tr>
		        <td align=\"right\" class=\"textos_simple\">
		        <a href=\"?accion=$accion&act=16&id_auto_admin=$id_auto_admin\" >Exportar<br>Importar</a>
		        </td>
				</tr>
	</table></td>";
		
	}
	
	
	  $query= "SELECT help,control_version
               FROM  auto_admin 
               WHERE id_auto_admin='$id_auto_admin'";
			   
			  
         $result3= cms_query($query)or die (error($query,mysql_error(),$php));
		 list($help_txt,$control_version) = mysql_fetch_row($result3);
          if ($help_txt!=""){
    			$help="<td align=\"right\">
	<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		      <tr>
		        <td align=\"center\" class=\"textos\">
		        <a href=\"#\" rel=\"tooltip\" class=\"tooltipss\" title=\"$help_txt\">
				<img src=\"images/help_auto.gif\" alt=\"\" border=\"0\">
				</a>
				
				</td>		 
		     </tr>
		    <tr>
		        <td align=\"right\" class=\"textos\">
		        Help
		        </td>
				</tr>
	</table></td>
				
				";
				
    		 }else{
			 	$help="";
			 }
	
	
	
	
	
	

	
	
	
	  $query= "SELECT ass.id_apps,ass.apps,ass.nom_apps, ass.id_auto_admin, ass.ico_apps
	   FROM auto_admin_apps ass, auto_admin_apps_permisos aps 
	   WHERE aps.id_perfil= $id_perfil and ass.id_apps=aps.id_apps and accion =$accion and id_auto_admin =$id_auto_admin ";
	  //echo $query;
         $result_8= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_apps,$apps,$nom_apps, $id_auto_admin,$icono_apps) = mysql_fetch_row($result_8)){
		  $cont_apps++;
		  
		
				
	
    			$lista_barra_custom .="<li><a href=\"index.php?accion=$accion&act=17&id_apps=$id_apps\">$nom_apps</a></li>\n";				
						   
    		
    		 
			 if($cont_apps>0){
			$barra_custom  ="<ul id=\"nav\"><li>&nbsp;</li>
			<li>$cont_apps Aplicaciones <img src=\"images/down_over.gif\" alt=\"\" border=\"0\"></li>
			
			     <ul> $lista_barra_custom </ul>
      				</ul>"; 
 
			 }
			 
			 $tabla = tabla($id_auto_admin);
			 
			 $barra_cust = "<td align=\"right\"   >
	<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		      <tr>
		        <td align=\"center\" class=\"textos\">
		        <a href=\"index.php?accion=$accion&act=17&id_apps=$id_apps\">
		        <img src=\"images/sitio/sistema/$tabla/auto_admin_apps/ico_apps/$icono_apps\" alt=\"$nom_apps\" border=\"0\"></a></td>		 
		     </tr>
		    <tr>
		        <td align=\"right\" class=\"textos_simple\">
		        <a href=\"index.php?accion=$accion&act=17&id_apps=$id_apps\" >$nom_apps</a>
		        </td>
				</tr>
	</table></td>";
			 
			
	
	 }
	
	// echo "dfffsdfsdfsdf";
	
	if($nombre_tabla!=""){
	  $query= "SELECT  count(*) 
	               FROM  $nom_tabla";
	        // echo "$query";   

	     $result33= cms_query($query)or die (error($query,mysql_error(),$php)); 
	     list($tot_res) = mysql_fetch_row($result33);

	}
		
	
$tool="
<div class=\"row well\">
  <div class=\"span2\">$tot_res Registros Totales</div>
  <div class=\"span10\">
   <table border=\"0\"  align=\"right\" border=\"0\"  cellpadding=\"8\" cellspacing=\"0\">
                          
                        	
						  $barra_cust
						  $configurar_perfiles
						  $configurar_ordenar
			   			  $configurar_crear
						  $busqueda
						  $xls
						  $help
						  </table>
						  <ul class=\"nav nav-pills\">
  <li class=\"active\">
    <a href=\"#\">Home</a>
  </li>
  <li><a href=\"#\">...</a></li>
  <li><a href=\"#\">...</a></li>
</ul>
  </div>
</div>


			
			";
	
  $js .="<script type=\"text/javascript\"> 
  
				$('.tooltipss').tooltip(hidden);
	</script>";
?>