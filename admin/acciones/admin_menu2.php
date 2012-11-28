<?php

$id_gru = $_GET['id_gru'];
$id_perfil_vista = $_GET['id_perfil_vista'];


$id_p = $_GET['id_p'];
$opcion = $_GET['opcion'];

	if($id_gru!=""){
	
	 $query= "SELECT id_perfil_vista 
			  FROM  accion_grupo
	 	      WHERE ultima_visita='1'";
	 	//  echo $query;
	 	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 	     list($id_perfil_vista) = mysql_fetch_row($result);
			 
		//echo "hola";
		$Sql ="UPDATE accion_grupo 
			   SET ultima_visita=0,
			   id_perfil_vista=0";
		//echo "hola $Sql";

 		cms_query($Sql)or die (error($Sql,mysql_error(),$php));
			   
	
		if($id_perfil_vista!="" and $id_gru!=""){
		$Sql_e ="UPDATE accion_grupo 
			   SET ultima_visita=1,id_perfil_vista='$id_perfil_vista'
			   WHERE id_grupo ='$id_gru'";
			//echo $Sql_e;

 		cms_query($Sql_e)or die (error($Sql_e,mysql_error(),$php));
		
		   
		}else{
		$Sql_e ="UPDATE accion_grupo 
			   SET ultima_visita=1,id_perfil_vista='$id_perfil'
			   WHERE id_grupo ='$id_gru'";
			//echo $Sql_e;

 		cms_query($Sql_e)or die (error($Sql_e,mysql_error(),$php));
		
		}	
	}
		  
	if($id_perfil_vista!="" and $id_perfil_vista!="all"){
	
	 $query= "SELECT id_grupo 
			  FROM  accion_grupo
	 	      WHERE ultima_visita='1'";
	 	//  echo $query;
	 	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 	     list($id_gru) = mysql_fetch_row($result);
	
	$Sql_e ="UPDATE accion_grupo 
			   SET id_perfil_vista = '$id_perfil_vista'
			   WHERE id_grupo ='$id_gru'";
			//echo $Sql_e;

 	cms_query($Sql_e)or die (error($Sql_e,mysql_error(),$php));
			   
	}elseif($id_perfil_vista=="all"){
		 		$Sql ="UPDATE accion_grupo 
			   			SET id_perfil_vista=0";
				//echo "hola $Sql";

 			cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	
	}

	 $query= "SELECT id_grupo,grupo,id_perfil_vista 
			  FROM  accion_grupo
	 	      WHERE ultima_visita='1'";
	 	//  echo $query;
	 	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 	     if(!list($id_gru,$grupo_name,$id_perfil_vista) = mysql_fetch_row($result)){
			   $id_gru=0;
			   $id_perfil_vista=0;
			 }
	   	
	
	if($nombre_accion!=""){
		//echo "hola";
		$condicion= " and descrip_php_esp like '%$nombre_accion%' ";
		
		     $query_otras= "SELECT  a.id_acc,a.accion,a.php,a.descrip_php_esp,a.home,a.opcion,a.presente,id_grupo 
          				 FROM  acciones a
           				 WHERE a.id_grupo <>'$id_gru' $condicion
           				ORDER BY id_acc";
             $result_otras= mysql_query($query_otras)or die (error($query,mysql_error(),$php));
              while (list($id_acc,$accion_b,$php,$descrip_php_esp,$home,$opcion,$siempre_presente,$id_otro_grupo) = mysql_fetch_row($result_otras)){
        			  
					  
					  $query= "SELECT opcion   
        	           FROM  accion_opciones_menu
        	           WHERE id_opcion_menu='$opcion'";
					   
					 
        	     $result_t= cms_query($query)or die (error($query,mysql_error(),$php));
        	     list($menu) = mysql_fetch_row($result_t);
        	
        	if($siempre_presente==1){
				$siempre_presente="Si";
			}else{
				$siempre_presente="No";
			}
      	       		
					  $query= "SELECT grupo  
           						FROM  accion_grupo
								where id_grupo='$id_otro_grupo'";
				// echo $query;
     				$result= cms_query($query)or die (error($query,mysql_error(),$php));
      				list($otro_grupo) = mysql_fetch_row($result);
					
					
				$listra_otros_resultados .="
					<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"}>
    					<td align=\"left\" width=\"120\"  class=\"textos\" title=\"accion $accion_b\">$descrip_php_esp</td>
      					<td align=\"center\" width=\"120\"  class=\"textos\" title=\"$php\"> $menu </td>
						<td align=\"center\" class=\"textos\">$otro_grupo</td> 
						<td align=\"center\" width=\"30\"  class=\"textos\" title=\"Cargar Siempre\">$siempre_presente </td>
      					<td align=\"center\" width=\"30\" class=\"textos\" title=\"Desplegar o ocultar este menu\">
      						<a href=\"?accion=$accion&act=5&id_gru=$id_gru&id=$accion_b&cambia=si\">no</a></td>
      					<td align=\"center\" width=\"30\" class=\"textos\">
      						<a href=\"?accion=$accion&id=$id_acc&act=17&opcion=$opcion&id_gru=$id_gru\" class=\"textos\">
							<img src=\"images/edit.gif\" alt=\"Editar $descrip_php_esp\" border=\"0\"></a>
      					</td>
						<td align=\"center\" width=\"30\" class=\"textos\">
      						<a href=\"javascript:confirmar('Est&aacute; Seguro de Borrar $descrip_php_esp','?accion=$accion&act=1&id=$accion_b')\">
							<img src=\"images/del.gif\" alt=\"Borrar $descrip_php_esp\" border=\"0\"> </a>
      					</td>
      			</tr>";			 
        		 }
				 if($listra_otros_resultados!=""){
				 $listra_otros_resultados = "
					 <h3>Otros Resultados de la accion \"$nombre_accion\" en otros grupos</h3>
				 <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" class=\"table table-striped table-bordered\">
                                 
								 <tr >
    					<td align=\"center\" width=\"120\"   title=\"\">Accion</td>
      					<td align=\"center\" width=\"120\"  title=\"\">Tipo Acc.</td>
						<td align=\"center\" >Grupo</td> 
						<td align=\"center\"    title=\"Cargar Siempre\">Garga Siempre</td>
      					<td align=\"center\" width=\"30\"  title=\"Desplegar o ocultar este menu\">
      						Menu</td>
      					<td align=\"center\" width=\"30\" >
      						&nbsp;
      					</td>
						<td align=\"center\" width=\"30\" >
      						&nbsp;
      					</td>
      			</tr>
					
								 $listra_otros_resultados
                               </table>";
				 }
				 
	}
	

	
	
	

  $query= "SELECT id_grupo,grupo  
           FROM  accion_grupo";
// echo $query;
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_grupo2,$grupo) = mysql_fetch_row($result)){
      	if($id_grupo2==$id_gru){
      		$lista_grupo .="<option value=?accion=$accion&act=$act&id_gru=$id_grupo2 selected>$grupo</option>";	
      		//$grupo_name = "$grupo";
      	}else{
      		$lista_grupo .="<option value=?accion=$accion&act=$act&id_gru=$id_grupo2>$grupo</option>";	  
      	}
			 
		 }
	$lista_grupo = "<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\" class=\"textos\">
					       <option value=\"#\">----></option>
					       $lista_grupo
				   </select>";
	
	    $query= "SELECT id_perfil,perfil  
           		 FROM  usuario_perfil";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_perfil_vista2,$perfil_vista) = mysql_fetch_row($result)){
			if($id_perfil_vista==$id_perfil_vista2){
			$lista_perfiles .="<option value=\"index.php?accion=$accion&act=$act&id_perfil_vista=$id_perfil_vista2\" selected>$perfil_vista</option>";			
			}else{
			$lista_perfiles .="<option value=\"index.php?accion=$accion&act=$act&id_perfil_vista=$id_perfil_vista2\">$perfil_vista</option>";			
			}

			
			
		 }
		 
		 $lista_perfiles = "<select name=\"menu2\" onChange=\"MM_jumpMenu('parent',this,0)\" class=\"textos\">
            					<option value=\"index.php?accion=$accion&act=$act&id_perfil_vista=all\">Todos</option>
								$lista_perfiles
            				</select>";
	

$opcion = $_GET['opcion'];

if($id_perfil_vista==0){
 $query= "SELECT  id_acc,accion,php,descrip_php_esp,home,opcion,presente 
           FROM  acciones 
           WHERE id_grupo='$id_gru' and home = 'si'
           $condicion
           ORDER BY id_acc";
}else{
 $query= "SELECT  a.id_acc,a.accion,a.php,a.descrip_php_esp,a.home,a.opcion,a.presente 
           FROM  acciones a,accion_perfil ap
           WHERE a.id_grupo='$id_gru' and a.home = 'si' and a.accion= ap.accion and ap.id_perfil= $id_perfil_vista
           $condicion
           ORDER BY id_acc";
		   
		  

}

	 
     $result22= cms_query($query)or die (error($query,mysql_error(),$php));
        while (list($id_acc,$accion_b,$php,$descrip_php_esp,$home,$opcion,$siempre_presente) = mysql_fetch_row($result22)){
        	
    $query= "SELECT opcion   
        	 FROM  accion_opciones_menu
        	 WHERE id_opcion_menu='$opcion'";
    $result_u= cms_query($query)or die (error($query,mysql_error(),$php));
      list($menu) = mysql_fetch_row($result_u);
        		
        	if($siempre_presente==1){
				$siempre_presente="Si";
			}else{
				$siempre_presente="No";
			}
    			$lista_menu .="<li id=\"item_$accion_b\" >
				
				<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" >
    				<tr>
    				
      					<td align=\"left\" width=\"130\"  class=\"textos\" title=\"accion $accion_b\">$descrip_php_esp</td>
      				
      					<td align=\"center\" width=\"150\"  class=\"textos\" title=\"$php\">&nbsp;$menu</td>
      					<td align=\"left\" width=\"30\"  class=\"textos\" title=\"Cargar Siempre\">$siempre_presente</td>
      					<td align=\"center\" width=\"30\" class=\"textos\" title=\"Desplegar o ocultar este menu\">
      					<a href=\"?accion=$accion&act=5&id_gru=$id_gru&id=$accion_b&cambia=no\">$home</a></td>
      					<td align=\"right\" width=\"30\" class=\"textos\">
      					<a href=\"?accion=$accion&id=$id_acc&act=17&opcion=$opcion&id_gru=$id_gru\" class=\"textos\">
						<img src=\"images/edit.gif\" alt=\"Editar $descrip_php_esp\" border=\"0\"></a>
      					</td>
						<td align=\"right\" width=\"30\" class=\"textos\">
						<a href=\"javascript:confirmar('Est&aacute; Seguro de Borrar $descrip_php_esp','?accion=$accion&act=1&id=$accion_b')\">
						<img src=\"images/del.gif\" alt=\"Borrar $descrip_php_esp\" border=\"0\"></a>
      					</td>
      				</tr>
				</table></li>\n";
				
		 }
		 
		  
if($id_perfil_vista==0){
 $query= "SELECT  a.id_acc,a.accion,a.php,a.descrip_php_esp,a.id_grupo,a.home,a.opcion,a.presente 
           FROM  acciones a 
           WHERE id_grupo='$id_gru' and home = 'no'
           $condicion
           ORDER BY id_acc";
}else{
 $query= "SELECT  a.id_acc,a.accion,a.php,a.descrip_php_esp,a.id_grupo,a.home,a.opcion,a.presente 
           FROM  acciones a,accion_perfil ap
           WHERE a.id_grupo='$id_gru' and a.home = 'no' and a.accion= ap.accion and ap.id_perfil= $id_perfil_vista
           $condicion
           ORDER BY id_acc";
		   
		  

}
	// echo "$query <br>";
	 
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_acc,$accion_b,$php,$descrip_php_esp,$home,$id_gru,$opcion,$siempre_presente) = mysql_fetch_row($result)){

      		  $query= "SELECT opcion   
        	           FROM  accion_opciones_menu
        	           WHERE id_opcion_menu='$opcion'";
					   
					 
        	     $result_t= cms_query($query)or die (error($query,mysql_error(),$php));
        	     list($menu) = mysql_fetch_row($result_t);
        	
        	if($siempre_presente==1){
				$siempre_presente="Si";
			}else{
				$siempre_presente="No";
			}
      	       		
					
					
				$lista_menu_no .="
					<tr >
    					<td align=\"left\" width=\"120\"   title=\"accion $accion_b\">$descrip_php_esp</td>
      					<td align=\"center\" width=\"120\"   title=\"$php\">&nbsp; $menu </td>
						<td align=\"center\" width=\"30\"   title=\"Cargar Siempre\">$siempre_presente </td>
      					<td align=\"center\" width=\"30\"  title=\"Desplegar o ocultar este menu\">
      						<a href=\"?accion=$accion&act=5&id_gru=$id_gru&id=$accion_b&cambia=si\">no</a></td>
      					<td align=\"center\" width=\"30\" >
      						<a href=\"?accion=$accion&id=$id_acc&act=17&opcion=$opcion&id_gru=$id_gru\" >
							<img src=\"images/edit.gif\" alt=\"Editar $descrip_php_esp\" border=\"0\"></a>
      					</td>
						<td align=\"center\" width=\"30\" >
      						<a href=\"javascript:confirmar('Est&aacute; Seguro de Borrar $descrip_php_esp','?accion=$accion&act=1&id=$accion_b')\">
							<img src=\"images/del.gif\" alt=\"Borrar $descrip_php_esp\" border=\"0\"> </a>
      					</td>
      			</tr>";
				
		 }
		 
		 
		 //<a href=\"?accion=$accion&act=6&id=$id_acc&id_gru=$id_gru\" class=\"textos\">
		 //<a href=\"#\" onClick=\"MM_openBrWindow('?accion=$accion&act=6&id=$id_acc&id_gru=$id_gru','','width=450,height=600,scrollbars=yes')\">
		 
		
		
		$lista_acciones_no ="<h3>Acciones ocultas</h3>
                 
		<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"table table-striped table-bordered\">
		
			 <tr >
    					<th align=\"center\" width=\"120\"   title=\"\">Accion</th>
      					<th align=\"center\" width=\"120\"  title=\"\">Tipo Acc.</th>
						<th align=\"center\"    title=\"Cargar Siempre\">Garga Siempre</th>
      					<th align=\"center\" width=\"30\"  title=\"Desplegar o ocultar este menu\">
      						Menu</th>
      					<th align=\"right\" width=\"20\" >
      						&nbsp;
      					</th>
						<th align=\"right\" width=\"20\" >
      						&nbsp;
      					</th>
      			</tr> 
		$lista_menu_no
		</table>"; 






$js .=" <script languaje=\"javascript\">
      	function confirmar( mensaje, destino) {  
      	  if (confirm(mensaje)) {     
      	     document.location = destino ;  
      		   }
      	}
      	
      	</script>


";







             
             /****************************************/

$css .="<style>

#ordena ul {
	padding:0px;
	margin: 0px;
}

#list li {
	margin: 0 0 3px;
	padding:8px;
	background-color:#DFEFFF;
        border:1px solid #336699;
	color:#000;
	list-style: none;
}
</style>";




$js .="<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js\"></script>
<script type=\"text/javascript\">
$(document).ready(function(){ 	
	  function slideout(){
  setTimeout(function(){
  $(\"#response\").slideUp(\"slow\", function () {
      });
    
}, 2000);}
	
    $(\"#response\").hide();
	$(function() {
	$(\"#list ul\").sortable({ opacity: 0.8, cursor: 'move', update: function() {
			
			var order = $(this).sortable(\"serialize\") + '&update=update'; 
			$.post(\"index.php?accion=$accion&act=24&axj=1\", order, function(theResponse){
				$(\"#response\").html(theResponse);
				$(\"#response\").slideDown('slow');
				//slideout();
			}); 															 
		}								  
		});
	});

});	
</script>";
    
    
    





$contenido .="
   
    <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr>
      <td align=\"center\" class=\"textos\">
	    <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
          <tr >
            <td align=\"left\" class=\"textos\">Perfiles de Usuarios </td>
            <td align=\"right\" class=\"textos\">Grupo de men&uacute; </td>
		  </tr> 
      	 <tr >
            <td align=\"left\" class=\"textos\">$lista_perfiles</td>
            <td align=\"right\" class=\"textos\">$lista_grupo </td>
		  </tr> 
      	</table>
	  </td>
      </tr>
     </table>
	<h3>Menu Grupo \"$grupo_name\"</h3>
         <div id=\"response\" class=\"alert alert-success\"> </div>
    <table width=\"100%\"   border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
    
      <tr><td align=\"center\" > 
      <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
    				<tr >
    					<th align=\"center\" width=\"120\"  >Menu</th>
      		  			<th align=\"center\" width=\"120\"  >Php</th>
      					<th align=\"center\" width=\"30\"   title=\"Carga Siempre\">Crga. Smpre</th>
      					<th align=\"center\" width=\"30\" >Home</th>
      					<th align=\"center\" width=\"30\" >Edit</th>
      					<th align=\"center\" width=\"30\" >Del</th>
      				</tr>
				</table></td>
	</tr>
      
	 <tr>
      <td align=\"center\" >
	
	    <div id=\"list\">
        <ul id=\"ordena\">
           $lista_menu
        </ul>
        </div>
      </td></div>
      </tr>
	</table>
      <br>
      $lista_acciones_no<br>
      $listra_otros_resultados";



?>