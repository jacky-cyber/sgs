<?php
/*ADMIN MENUS CON AJAX*/
  
//include("../lib/connect_db.inc");   

$id_gru = $_GET['id_gru'];

  $query= "SELECT id_grupo,grupo    
           FROM  accion_grupo";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_grupo2,$grupo) = mysql_fetch_row($result)){
      	if($id_grupo2==$id_gru){
      		$lista_grupo .="<option value=?accion=$accion&act=$act&id_gru=$id_grupo2 selected>$grupo</option>";	
      		$grupo_name = "$grupo";
      	}else{
      		$lista_grupo .="<option value=?accion=$accion&act=$act&id_gru=$id_grupo2>$grupo</option>";	  
      	}
			 
		 }
	$lista_grupo = "<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\" class=\"textos\">
					       <option value=\"#\">----></option>
					       $lista_grupo
				   </select>";
	
	

	
if($id_gru!=""){
	 $query= "SELECT  id_acc,accion,php,descrip_php_esp,home 
           FROM  acciones 
           WHERE id_grupo='$id_gru' and home = 'si'
           ORDER BY id_acc";
	 
	 
     $result22= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_acc,$accion_b,$php,$descrip_php_esp,$home) = mysql_fetch_row($result22)){
				$lista_menu .="<li id=\"mnu_$accion_b\">
				<table  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\"width=\"555\" >
    				<tr>
    				
      					<td align=\"left\" width=\"155\" bgcolor=\"#EBEEF5\" class=\"textos\">$descrip_php_esp</td>
      					<td align=\"center\" width=\"30\"  class=\"textos\">$accion_b</td>
      					<td align=\"left\" width=\"300\"  class=\"textos\">&nbsp;$php</td>
      					<td align=\"center\" width=\"30\" class=\"textos\">$home</td>
      					<td align=\"right\" width=\"30\" class=\"textos\">
      					<a href=\"?accion=$accion&id=$id_acc&edit=ok&id_gru=$id_gru\" class=\"textos\">
						<img src=\"images/edit.gif\" alt=\"\" border=\"0\"></a>
      					</td>
						<td align=\"right\" width=\"30\" class=\"textos\">
						<a href=\"javascript:confirmar('Esta Seguro de Borrar ','?accion=$accion&act=1&id=$accion_b')\">
      					
						<img src=\"images/del.gif\" alt=\"\" border=\"0\"></a>
      					</td>
      				</tr>
				</table></li>\n";
				
		 }
		  
		 $query= "SELECT  id_acc,accion,php,descrip_php_esp,home,id_grupo 
           FROM  acciones 
           WHERE id_grupo='$id_gru' and home = 'no'
           ORDER BY id_acc";
	 
	 
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_acc,$accion_b,$php,$descrip_php_esp,$home,$id_gru) = mysql_fetch_row($result)){
				$lista_menu_no .="
					<tr>
    					<td align=\"left\" width=\"155\" bgcolor=\"#EBEEF5\" class=\"textos\">$descrip_php_esp</td>
      					<td align=\"center\" width=\"30\"  class=\"textos\">$accion_b</td>
      					<td align=\"left\" width=\"300\"  class=\"textos\">&nbsp;$php</td>
      					<td align=\"center\" width=\"30\" class=\"textos\">$home</td>
      					<td align=\"right\" width=\"30\" class=\"textos\">
      					<a href=\"?accion=$accion&id=$id_acc&edit=ok&id_gru=$id_gru\" class=\"textos\">
						<img src=\"images/edit.gif\" alt=\"\" border=\"0\"></a>
      					</td>
						<td align=\"right\" width=\"30\" class=\"textos\">
      					<a href=\"javascript:confirmar('Esta Seguro de Borrar ','?accion=$accion&act=1&id=$accion_b')\">
						<img src=\"images/del.gif\" alt=\"\" border=\"0\"></a>
      					</td>
      				</tr>
					
				";
				
		 }
		 
		$lista_acciones_no ="<table width=\"100%\" border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"1\" >
		$lista_menu_no
		</table>"; 
}

$js .= "  <link rel=\"stylesheet\" type=\"text/css\" href=\"admin/acciones/styles.css\" />
 
        <script type=\"text/javascript\" src=\"admin/acciones/scriptaculous-js-1.6.4/lib/prototype.js\"></script>
        <script type=\"text/javascript\" src=\"admin/acciones/scriptaculous-js-1.6.4/src/scriptaculous.js\"></script>
        
";


$contenido .="
   
    <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td align=\"center\" class=\"textos\">$lista_grupo</td>
      </tr>
      <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
	</table>
    <table width=\"545\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td align=\"center\" class=\"cuadro\">$grupo_name</td>
      </tr>
      <tr><td align=\"center\" class=\"cuadro\"> 
      <table width=\"570\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"  >
    				<tr>
    				
      					<td align=\"center\" width=\"155\"  class=\"cabeza\">Menu</td>
      					<td align=\"center\" width=\"30\"  class=\"cabeza\">Acc</td>
      					<td align=\"center\" width=\"300\"  class=\"cabeza\">Php</td>
      					<td align=\"center\" width=\"30\" class=\"cabeza\">Home</td>
      					<td align=\"center\" width=\"30\" class=\"cabeza\">Edit</td>
      				<td align=\"center\" width=\"30\" class=\"cabeza\">Del</td>
      				</tr>
				</table></td></tr>
      
	 <tr>
      <td align=\"center\" class=\"cuadro\">
      <ul id=\"movies_list\" class=\"sortable-list\">
           $lista_menu
        </ul>
      </td>
      </tr>
	</table>
      <br>
      $lista_acciones_no 
        <script languaje=\"javascript\">
function confirmar( mensaje, destino) {  
  if (confirm(mensaje)) {     
     document.location = destino ;  
	   }
}

</script>
 
          <script type=\"text/javascript\">
            function updateOrder()
            {
                var options = {
                                method : 'post',
                                parameters : Sortable.serialize('movies_list')
                              };
 
                new Ajax.Request('admin/acciones/actualiza.php', options);
            }
 
            Sortable.create('movies_list', { onUpdate : updateOrder });
        </script>

   ";



?>