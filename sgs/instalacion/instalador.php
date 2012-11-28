<?php
		function armaComboServicio($i){
	
			$sql = "Select id_entidad_padre,entidad_padre 
					from sgs_entidad_padre ";
			$result_entidad_padre = cms_query($sql)or die ("La consulta fallo aca<br>".mysql_error());
	
	
			$combo = "<select name=\"caja_$i\" onChange=\"document.form1.entidad_padre.value=this.value;document.form1.opcion.value=1;document.form1.submit();\">";
			$combo = $combo."<option value=\"\">Seleccione Instituci&oacute;n Padre</option>";
			 while (list($id_entidad_padre,$entidad_padre) = mysql_fetch_row($result_entidad_padre))
			 {
             	$combo = $combo."<option value=\"$id_entidad_padre\">$entidad_padre</option>";
           
			 }
			 
			$combo = $combo." </select>";
	
		 	return $combo;
	
	}
			
			
			
	
	$js .=" <script language=\"javascript\">
			function setSelectCombo(fval,SelectObj)//selecciona el valor del combobox segun corresponda
			{
				  with (SelectObj)
				  for (var i=0; i<length; i++)
				  {
					  if (options[i].value == fval) 
					  {
						options[i].selected = true;
						
						break;
					  }
				 }
			}
			
			";



	 $sql = "Select id_configuracion,configuracion,valor,descripcion 
	 		 from cms_configuracion 
			 where publico=1 order by orden asc";
	$result = cms_query($sql)or die ("La consulta fallo<br>".mysql_error());
	$cantidad = mysql_num_rows($result);
	
	
	$sql = "select contenido from noticias where id_noticia = '2009012010144481'";
	$result_noticia = cms_query($sql)or die ("la Consulta fallo");
	list($politicas) = mysql_fetch_row($result_noticia);


	$contenido = html_template('contenedor_instalador');
	
	
	
	
	$jscript = " function valida(){";
	$i=1;
	while (list($id_configuracion,$configuracion,$valor,$descripcion) = mysql_fetch_row($result))
	{
			$linea = html_template('registro_valor_instalador');
			$campo = "";
			//validar si es combo o caja de texto
			if (trim($configuracion)=="id_servicio"){ 
				//crea combo servicio
				$campo = armaComboServicio($i);
				if ($_POST['opcion']==1){
					$entidad_padre = $_POST['entidad_padre'];
				 }else{
					$entidad_padre = $valor;
				}
				$js2 = "setSelectCombo('$entidad_padre',document.form1.caja_$i);";
				
			}elseif (trim($configuracion)=="id_entidad"){
				//crea combo entidad 
				if($entidad_padre!="") {
					$sql = "Select id_entidad,entidad from sgs_entidades where id_entidad_padre = $entidad_padre ";
					$result_entidad = cms_query($sql)or die ("La consulta fallo<br>".mysql_error());
				}
				$aEntidad = split(',',$valor);
				$campo =  armaComboEntidad($i,$result_entidad,$aEntidad);
				
				
				
				
				//$js2 = $js2."setSelectCombo('$valor',document.form1.caja_$i);";
			}else{
				$campo = "<input name=\"caja_$i\" type=\"text\" value=\"$valor\" size=\"75\">";
			
			}
			
			$linea = cms_replace("#I#","$i",$linea);
			$linea = cms_replace("#ID_CONFIGURACION#","$id_configuracion",$linea);
			$linea = cms_replace("#DESCRIPCION#","$descripcion",$linea);
			$linea = cms_replace("#CAMPO#","$campo",$linea);
			
			$registros = $registros.$linea;
			
			if(trim($configuracion)!="id_entidad"){
				 $jscript =   $jscript." if (document.form1.caja_".$i.".value == ''){
								alert('Campo obligatorio ');
								document.form1.caja_".$i.".focus();
								return false;
						}
					";
			}
			
			
			
			$i++;
				
	}
	
	$jscript = $jscript." else{
					return true;
	   					}
			}";
	
		
	$js .= $jscript;
	$js .= "</script>" ;
	
	$suma = $i-1;
	$contenido = cms_replace("#REGISTROS_INSTALADOR#","$registros",$contenido);
	$contenido = cms_replace("#SUMA#","$suma",$contenido);
	$contenido = cms_replace("#SELECCIONA_COMBO#","$js2",$contenido);
	$contenido = cms_replace("#MENSAJE#"," ",$contenido);
	$contenido = cms_replace("#POLITICAS#","$politicas",$contenido);
	//$contenido = acentos($contenido);
	
	
	
	
	
	function armaComboEntidad($i,$result_entidad,$aEntidad){
		
		//$combo = "<select name=\"caja_$i\" > ";
		//$combo = $combo . "<option value=\"\">Seleccione el nombre de la instituci&oacute;n</option>";
        while (list($id_entidad,$entidad) = mysql_fetch_row($result_entidad))
		{
            
			 $encontrado = buscarCodigo($aEntidad,$id_entidad);
				//echo "<br>encontrado:".$encontrado;
				
				$checked="";
				if($encontrado==1){
					$checked = "checked";
				}
			 //$combo = $combo ."<option value=\"$id_entidad\">$entidad</option>";
			 $combo = $combo ."<input type=\"checkbox\" name=\"ckb_$j\" id=\"ckb_$j\" value=\"$id_entidad\" $checked >$entidad <br>";
        }
		
        //$combo = $combo ." </select>";
	
		return $combo;
	
	}
	
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

	
	
 
	
	
?>