<?php

    
	
	
	
$url=$_SERVER['HTTP_REFERER']; 
$ip= $_SERVER['REMOTE_ADDR']; 





$jsdd ="
<style type=\"text/css\">


.cmxform  p.error  { 

color: red; 
}

input.error { 

border: 2px solid red; 
}

</style>





<script type=\"text/javascript\">

$.validator.setDefaults({
	//submitHandler: function() { alert(\"submitted!\"); }
});






$().ready(function() {

	
	// validate signup form on keyup and submit
	$(\"#form1\").validate({
		rules: {
			
			$js_valida
		},
		messages: {
			
		}
	});
});







</script>";



$accion_form = "index.php?accion=$accion&act=1";

  $query= "SELECT id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio     
           FROM  cms_configuracion
           WHERE publico=1";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_configuracion,$configuracion,$valor,$descripcion,$publico,$orden,$txt,$obligatorio) = mysql_fetch_row($result)){
			
			if($obligatorio==1){
			$astr= "*";
			$js_validad .=",campo_$id_configuracion : {
							required : true

						}";
			}else{
			$astr= "";
			}
			
			
			if($txt==1){
				$campo = "   <textarea name=\"campo_$id_configuracion\" cols=\"60\" rows=\"10\" >$valor</textarea>";
			}else{
				$campo = "<input type=\"text\" name=\"campo_$id_configuracion\" size=\"50\" value=\"$valor\">";
			}
			
			
			
			$tabla_configuraciones .="<tr>
										<td align=\"left\" ><strong>$descripcion </strong></td>
										 
										</tr>
										<tr><td align=\"left\" >$campo $astr</td></tr>  ";		
										
										
		   
		 }
		
		$id_p = $_GET['id_p'];
		

				$query= "SELECT valor     
                 FROM  cms_configuracion
                 WHERE configuracion='id_servicio'";
        $result= cms_query($query)or die (error($query,mysql_error(),$php));
        if(list($id_serv) = mysql_fetch_row($result) and $id_p==""){
		$id_p= $id_serv;
		}
			
	$query= "SELECT valor     
           FROM  cms_configuracion
           WHERE configuracion='id_entidad'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($aEntidad) = mysql_fetch_row($result);
	 	
		//$aEntidad = substr ($aEntidad, 0, strlen($aEntidad) - 1);

		$os = explode(",", $aEntidad);
		
		
		if($id_p!=""){
		  $query= "SELECT id_entidad,entidad     
                   FROM  sgs_entidades
				   Where id_entidad_padre=$id_p order by sigla asc";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_entidad,$entidad) = mysql_fetch_row($result)){
			    
				
				
        		$encontrado = in_array($id_entidad,$os);
				//echo "<br>$aEntidad $id_entidad encontrado:".$encontrado;
				$checked="";
				if(in_array($id_entidad,$os)){
					$checked = "checked";
				}
				
					$lista_check .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
								<td align=\"left\" >$entidad</td>
									<td align=\"center\">
									<input type=\"checkbox\" name=\"check_e_$id_entidad\" value=\"1\" $checked>
									 </td>
									 </tr> 
									</tr> ";			   
        		 
				 }
		
		
		$lista_check = " <tr><td align=\"center\" class=\"textos\">  
		   <table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"1\" cellspacing=\"1\">
                            $lista_check
                        	</table></td></tr> ";
		
		
		}
		
		

			
		
		
		
		
		  $query= "SELECT id_entidad_padre, entidad_padre  
                   FROM  sgs_entidad_padre";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_entidad_p, $entidad_padre) = mysql_fetch_row($result)){
        				
						if($id_entidad_p==$id_p){
					
							$lista_sel .="<option value=\"?accion=$accion&id_p=$id_entidad_p\" selected>$entidad_padre</option>" ;
						}else{
							$lista_sel .="<option value=\"?accion=$accion&id_p=$id_entidad_p\">$entidad_padre</option>" ;	
						}
					
						
						   
        		 }
				 
				$lista_sel ="<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">
                                      <option value=\"#\">Seleccione...</option>
									  $lista_sel
                                    </select>" ;
				 
		
		
		
		$tabla_configuraciones = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                                      <tr >
                                        <td align=\"center\" ><strong>Configuraciones de sistema</strong></td>
                                        </tr>
									 
										$tabla_configuraciones
										
										 
										<tr><td align=\"center\" >
										</td></tr> 
										
                                  	</table>";

									
	
  
	$sql = "select contenido from noticias where id_noticia = '2009012010144481'";
	$result_noticia = cms_query($sql)or die ("la Consulta fallo");
	list($politicas) = mysql_fetch_row($result_noticia);
  

$js.=" <script type=\"text/javascript\" src=\"fckeditor/fckeditor.js\"></script>
<script type=\"text/javascript\">
window.onload = function()
{


var oFCKeditor2 = new FCKeditor( 'politicas' ) ;
oFCKeditor2.BasePath = \"fckeditor/\" ;
oFCKeditor2.ToolbarSet = \"Basic\";
oFCKeditor2.Height = 300 ;
oFCKeditor2.ReplaceTextarea() ;


}
</script>";



								

$contenido = "<input type=\"hidden\" name=\"id_entidad_padre\" value=\"$id_p\" >
<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" ><strong>Cuenta del Administrador de Sistemas</strong></td>
                </tr>
              <tr>
			
                  <td align=\"center\" >
				    <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                      <tr >
                        <td align=\"center\" >Usuario</td>
						<td align=\"center\" ><input type=\"text\" name=\"user\"></td> 
                        </tr>
                  	 <tr >
                        <td align=\"center\" >contrase&ntilde;a</td>
						<td align=\"center\" ><input type=\"text\" name=\"pass\"></td> 
                        </tr>
                  	</table>
				  </td>
                </tr>
				<tr><td align=\"center\"> &nbsp;</td></tr> 
					<tr><td align=\"left\" > <strong>Instituci&oacute;n  </strong> </td></tr>  
										<tr><td align=\"left\" >$lista_sel </td></tr>
										<tr><td align=\"left\" >Seleccione los servicios de los cuales quiere recibir solicitudes
 </td></tr> 
										  $lista_check 
										
              			</table>
						
						<br/>
			  $tabla_configuraciones
			  
			  <br>
			  
			    <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                  <tr>
      <td>&nbsp;</td>
      <td>Pol&iacute;tica de Privacidad </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><textarea name=\"politicas\"  id=\"politicas\" cols=\"100\" rows=\"30\"> $politicas</textarea></td>
      <td>&nbsp;</td>
    </tr>
              	</table>
			  
			  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr >
                  <td align=\"center\"><input type=\"submit\" name=\"Submit\" value=\"Configurar\"></td>
                  </tr>
            	</table>
			  ";

?>