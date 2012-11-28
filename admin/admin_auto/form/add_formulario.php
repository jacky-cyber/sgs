<?php
//formulario


if($boton_ok!=""){
	
	    include ("admin/admin_auto/proc/actualizar_form.php");
	//echo "hola";
	
}

  $query= "SELECT formulario,form_activo 
           FROM  auto_admin
           WHERE id_auto_admin='$id_auto_admin'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($html_formulario,$form_activo) = mysql_fetch_row($result);
						   

      
	
$js.=" <script type=\"text/javascript\" src=\"fckeditor/fckeditor.js\"></script>
<script type=\"text/javascript\">
      window.onload = function()
      {
            
        var oFCKeditor3 = new FCKeditor( 'formulario' ) ;
        oFCKeditor3.BasePath = \"fckeditor/\" ;
		oFCKeditor3.Height = 300 ;
		oFCKeditor3.ReplaceTextarea() ;
      }
    </script>";      
      
      
$var= ' \ ';     
$var= trim($var);



if($form_activo==1){


$check="checked";
}else{
$check="";
}


 $html_formulario = str_replace($var,"",$html_formulario);
 

 $html_formulario = str_replace("&quot;","\"",$html_formulario);
 $html_formulario = str_replace("&lt;","<",$html_formulario);
 $html_formulario = str_replace("&gt;",">",$html_formulario);
 
 
 
 
$contenido.= "<table width=\"90%\"  border=\"0\" align=\"center\"  cellpadding=\"0\" cellspacing=\"0\" >		
    		 <tr><td align=\"center\" class=\"textos\">Activar Formulario
			 <input type=\"checkbox\" name=\"form_activo\" value=\"1\" $check> </td></tr> 
			 <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
			  <tr>
				  <td align=\"left\" class=\"textos\">
				  <textarea name=\"formulario\" cols=\"50\" rows=\"8\" class=\"textos\">$html_formulario</textarea></td>
			</tr>
			<tr>
				    <td align=\"center\" class=\"textos\"> &nbsp;</td>
			</tr>
			<tr> 
				 	<td align=\"center\" class=\"textos\">
					<input class=\"boton\" type=\"submit\" name=\"boton_ok\" value=\"Aceptar\"></td>
			</tr>
			<tr>
			       <td align=\"center\" class=\"textos\">&nbsp;</td>
			</tr>				
			</table><br>
			
			
		       $html_formulario
				
		 	";


 
?>