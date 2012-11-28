<?php
//formulario


$relacion = $_POST['relacion'];


  $query= "SELECT id_auto_admin  
           FROM  auto_admin
           WHERE  tabla  ='$tbl'";
  //echo "$query";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_auto_admin) = mysql_fetch_row($result);

  $query= "SELECT id_campo,id_tipo_campo,relacion,js,carpeta,help,xml,txt_xml,txt_form,pk,txt,campo_relacion
           FROM  auto_admin_campo 
           WHERE campo ='$nom_campo' and id_auto_admin='$id_auto_admin'";
  //echo "$query";
       $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_campo,$id_tipo,$relacion,$jshtml,$carpeta,$help_campo,$xml,$txt_xml,$txt_form,$pk,$txt,$campo_relacion) = mysql_fetch_row($result);
	 
	 
//echo "$id_campo,$id_tipo,$relacion,$jshtml,$carpeta,$help_campo,$xml,$txt_xml";

$tabla="auto_admin_tipo_campo";
$id_campo_selecionado="$id_tipo";
$nombre_campo_id="id_tipo_campo";
$nombre_campo_texto="tipo_campo";
$js_sel="";
$clase="texto";

$campo_select="id_tipo";
if($pk==1){
$pk_checked="checked";
}

if($txt==1){
$txt_checked="checked";
}


$lista_tipo_campo= select_admin_campo($tabla,$id_campo_selecionado,$nombre_campo_id,$nombre_campo_texto,$js_sel,$clase,$campo_select);



 $tables = mysql_list_tables( $DATABASE );					//conexion con la base de datos
		 
		while( $line = mysql_fetch_row($tables) )
{

		if($relacion==$line[0]){
		$lista_tablas_bd .= "<option value=\"".$line[0]."\" selected>".$line[0]."</option>";
		}else{
		$lista_tablas_bd .= "<option value=\"".$line[0]."\">".$line[0]."</option>";
		}
	
	
}

//para seleccionar la tabla en la pag.			 
$tablas_bd ="<select name=\"relacion\" >		
              <option value=\"#\">Seleccione tabla</option>
			 $lista_tablas_bd
            </select>";

			$tbl2 = str_replace(cpl_, "", $tbl);
			$tbl2 = str_replace(_, " ", $tbl2);
			$tbl2 = ucwords($tbl2);

			$link_tabla="<a href=\"index.php?accion=$accion&act=6&tbl=$tbl&edit=ok\">$tbl2</a>";
             




    
     

     $formulario_campo = 
     "
 <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"well\">
      <tr>
      <th align=\"center\" colspan=\"2\">Tabla $link_tabla
	  </th>
       </tr>
      
      <tr><td align=\"center\" class=\"textos\" colspan=\"2\">&nbsp; </td></tr> 
      <tr>
      <td align=\"left\" class=\"textos\">&nbsp;&nbsp;Tabla</td>
      <td align=\"left\" class=\"textos\">$link_tabla</td>
      </tr>
      <tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
      <tr>
      <td align=\"left\" class=\"textos\">&nbsp;&nbsp;Campo</td>
      <td align=\"left\" class=\"textos\"><input type=\"text\" name=\"campo\" value=\"$nom_campo\"></td>
      </tr>
	
	  <tr>
      <td align=\"left\" class=\"textos\">&nbsp;&nbsp;Tipo Campo</td>
      <td align=\"left\" class=\"textos\">$lista_tipo_campo
      </td>
      </tr>
     
	  <tr>
      <td align=\"left\" class=\"textos\">&nbsp;&nbsp;Texto para Xml</td>
      <td align=\"left\" class=\"textos\"><input type=\"text\" name=\"txt_xml\" value=\"$txt_xml\"></td>
      </tr>
	  <tr>
      <td align=\"left\" class=\"textos\">&nbsp;&nbsp;Texto opcional formulario</td>
      <td align=\"left\" class=\"textos\"><input type=\"text\" name=\"txt_form\" id=\"txt_form\" value=\"$txt_form\"></td>
      </tr>
	  <tr>
      <td align=\"left\" class=\"textos\">&nbsp;&nbsp;Campo opcional relaci&oacute;n</td>
      <td align=\"left\" class=\"textos\"><input type=\"text\" name=\"campo_relacion\" id=\"campo_relacion\" value=\"$campo_relacion\"></td>
      </tr>
	  <tr>
      <td align=\"left\" class=\"textos\">&nbsp;&nbsp;Relaci&oacute;n</td>
      <td align=\"left\" class=\"textos\">$tablas_bd</td>
      </tr>
	  <tr >
      <td align=\"left\" class=\"textos\" valign=\"top\">&nbsp;&nbsp;Js</td>
      <td align=\"left\" class=\"textos\">
      <textarea name=\"jshtml\" cols=\"60\" rows=\"10\" class=\"textos\">$jshtml</textarea></td>
      </tr>
      <tr>
        <td align=\"left\" class=\"textos\">&nbsp;&nbsp;Help</td>
       
      </tr>

       <tr>
        <td align=\"left\" class=\"textos\" colspan=\"2\">
	<textarea id=\"help\" name=\"help\" >$help_campo</textarea>
	</td>
       
      </tr>

	  <tr>
      <td align=\"left\" class=\"textos\"></td>
      <td align=\"left\" class=\"textos\"></td>
      </tr> 
      <tr><td align=\"center\" class=\"textos\" colspan=\"2\">&nbsp; </td></tr> 
     <tr>
      <td align=\"center\" class=\"textos\" colspan=\"2\">
      <input type=\"submit\" name=\"enviar\" value=\"Enviar\" class=\"btn btn-primary\"></td>
       </tr>
       </tr> 
      <tr><td align=\"center\" class=\"textos\" colspan=\"2\">&nbsp; </td></tr> 
     <tr>
  	</table>";
     
     
  
 $js.=" <script type=\"text/javascript\" src=\"fckeditor/fckeditor.js\"></script>
<script type=\"text/javascript\">
      window.onload = function()
      {
     
        var oFCKeditor2 = new FCKeditor( 'help' ) ;
		oFCKeditor2.BasePath = \"fckeditor/\" ;
		oFCKeditor2.ToolbarSet = \"Basic\";
		oFCKeditor2.Height = 100 ;
		oFCKeditor2.ReplaceTextarea() ;

      }
    </script>";    
     
     

$contenido .="$formulario_campo";
?>