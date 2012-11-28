<?php
 
  /*
       $query= "SELECT hash,identificacion_documentos,id_entidad,notificacion,id_forma_recepcion,oficina,id_formato_entrega  
              FROM  sgs_solicitud_acceso_temp
              WHERE hash='".$_SESSION['hash_temp']."'";
       
		 $result= cms_query($query)or die (error($query,mysql_error(),$php));
         list($hash2,$identificacion_documentos2,$id_entidad2,$notificacion2,$id_forma_recepcion2,$oficina2,$id_formato_entrega2 ) = mysql_fetch_row($result);
		*/
		
		$tabla ="sgs_solicitud_acceso_temp";
        $condicion ="WHERE hash='".$_SESSION['hash_temp']."'"; //WHERE id_reclamo='$id_reclamo'
        $agregar_nombre_campo = "2";
		
        $query = "SELECT hash,identificacion_documentos,id_entidad,notificacion,id_forma_recepcion,oficina,id_formato_entrega 
        		  FROM $tabla 
        		  $condicion";
        
        $result_q= cms_query($query)or die ("ERROR $php <br>$query");
        $num_filas = mysql_num_fields($result_q);
        $resultado = mysql_fetch_row($result_q);
        for ($i = 1; $i < $num_filas; $i++){
        
        $nom_campo = mysql_field_name($result_q,$i);
        $nom_campo .=$agregar_nombre_campo;
        $valor = $resultado[$i];
        $$nom_campo = $valor;
        
        }
		
   $js="<style type=\"text/css\">


.cmxform  p.error  { 

color: red; 
}

input.error { 

border: 2px solid red; 
}
select.error {
	border: 2px solid red; 
}
textarea.error {
	border: 2px solid red; 
}
option.error{  
	border: 2px solid red; 
}


</style>
   <script type=\"text/javascript\">
   
   
$().ready(function() {

	
	// validate signup form on keyup and submit
	$(\"#form1\").validate({
		rules: {
			id_entidad : {
			    required : true
				
			
			},
			oficina: {
			  required : true,
			  required: function(element) {
				 
				  
				  return $(\"#id_forma_recepcion\").val() == '3';
			  }

			},
			identificacion_documentos: {
				required: true
			},
			
			id_forma_recepcion: {
				required: true
			}
		},
		messages: { 
			id_entidad: \"Debe indicar una entidad\",
			oficina: \"Debe indicar una dirección\",
			identificacion_documentos: \"<br><p>Debe especificar que requerimientos de información o documentos necesita</p>\"
		}
	});
});

$(document).ready(function(){
	// Parametros para e id_entidad
   $(\"#id_entidad\").change(function () {
   		$(\"#id_entidad option:selected\").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post(\"sgs/solicitudes/select.php\", { elegido: elegido }, function(data){
				$(\"#oficina\").html(data);
				
			});			
        });
   })
	
});

</script>";

   

   
   $formulario_acceso = html_template('formulario_solicitud_informacion');	
   
   $fecha = date(d)."-".date(m)."-".date(Y);
   
	$formulario_acceso = cms_replace("#TIPO_PERSONA#","$tipo_persona",$formulario_acceso);
	$formulario_acceso = cms_replace("#NOMBRES#","$nombre",$formulario_acceso);
	$formulario_acceso = cms_replace("#PATERNO#","$paterno",$formulario_acceso);
	$formulario_acceso = cms_replace("#MATERNO#","$materno",$formulario_acceso);
	$formulario_acceso = cms_replace("#RAZON_SOCIAL#","$razon_social $nombre $paterno $materno",$formulario_acceso);
	
	$texto_apoderado = "";
	if (trim($apoderado) != ""){
		$texto_apoderado = "$apoderado";
	}
	
	
	$formulario_acceso = cms_replace("#APODERADO#","$texto_apoderado",$formulario_acceso);
	
	/*domicilio*/
	$id_comuna = rescata_valor('usuario',$id_usuario,'id_comuna');
	
	$comuna =  rescata_valor('comunas',$id_comuna,'comuna'); 
	$id_region = rescata_valor('usuario',$id_usuario,'id_region');
	$region =  utf8_encode(rescata_valor('regiones',$id_region,'region')); 
	$id_pais = rescata_valor('usuario',$id_usuario,'id_pais');
	$pais =  rescata_valor('pais',$id_pais,'pais'); 
	
	$formulario_acceso = cms_replace("#DIRECCION#","$direccion",$formulario_acceso);
	$formulario_acceso = cms_replace("#PAIS#","$pais",$formulario_acceso);
	
	
	$formulario_acceso = cms_replace("#NUMERO#","$numero",$formulario_acceso);
	
	$formulario_acceso = cms_replace("#DEPTO#","$depto",$formulario_acceso);
	$glosa_depto = "";
	if ($depto!=""){
		$glosa_depto = "Departamento";
	}
	$formulario_acceso = cms_replace("#GLOSA_DEPARTAMENTO#","$glosa_depto",$formulario_acceso);
	$formulario_acceso = cms_replace("#REGION#","$region",$formulario_acceso);
	$formulario_acceso = cms_replace("#CIUDAD#","$ciudad",$formulario_acceso);
	$formulario_acceso = cms_replace("#COMUNA#","$comuna",$formulario_acceso);
	
	/*Datos de Ingreso al sistema*/
	$formulario_acceso = cms_replace("#MAIL#","$email",$formulario_acceso);
	

	/*Información de la solicitud*/
	
	$id_servicio = configuracion_cms('id_servicio');	
	
	$servicio = rescata_valor('sgs_entidad_padre',$id_servicio,'entidad_padre'); 
	
	$servicio = acentos($servicio);
	$servicio = ucwords(strtolower(trim($servicio)));
	
	//$nombre_caja = str_replace("$prod ","",$nombre_caja);
	
	//$lista_entidades = select_admin_campo_simple("sgs_entidades",$id_entidad, $js_sel, $clase,$id_opcional);
	//sacar las entidades de configuracion
	$sql = "Select valor from cms_configuracion where configuracion='id_entidad'";
	$result = cms_query($sql) or die (error($query,mysql_error(),$php));
	list($valor) = mysql_fetch_row($result);
	$aEntidad = split(',',$valor);

	  $query= "SELECT id_entidad,entidad 
               FROM  sgs_entidades
               WHERE id_entidad_padre='$id_servicio'
			   ORDEr BY orden";
        $result= cms_query($query)or die (error($query,mysql_error(),$php));
		//$lista_select .= "<option value=\"\" selected >Seleccione...</option>";
          while (list($id_entidad,$entidad) = mysql_fetch_row($result)){
		  		$entidad = cambio_texto($entidad);
				$encontrado =  buscarCodigo($aEntidad,$id_entidad);
				if ($encontrado==1){
				    if($id_entidad2==$id_entidad ){
						$lista_select .="<option value=\"$id_entidad\" selected>$entidad</option>";	
					}else{
						$lista_select .="<option value=\"$id_entidad\">$entidad</option>";	
					}
							   
				}
				
    		 }
	
	
	$lista_entidades = "<select name=\"id_entidad\" id=\"id_entidad\">$lista_select</select>";
	
	$identificacion_documentos = "<textarea name=\"identificacion_documentos\" id=\"identificacion_documentos\" class=\"textos\" cols=\"60\" rows=\"8\" >$identificacion_documentos2</textarea>";
	//$formulario_acceso = cms_replace("#LISTA_ENTIDADES#","$lista_entidades",$formulario_acceso);
	$formulario_acceso = cms_replace("#IDENTIFICACION_DOCUMENTOS#","$identificacion_documentos",$formulario_acceso);
	$formulario_acceso = cms_replace("#SERVICIO#","$servicio",$formulario_acceso);
	
	
	
	/*Notificación*/
	if($notificacion2==""){
	$notificacion2=1;
	}
	$var = "notificacion_$notificacion2";
	$$var = "checked";
	

	$notificacion = "<input type=\"radio\" name=\"notificacion\" id=\"notificacion\" $notificacion_1 value=\"1\"  > S&iacute;   <input type=\"radio\" $notificacion_0 name=\"notificacion\" id=\"notificacion\" value=\"0\" > No    ";
	
	$formulario_acceso = cms_replace("#SI#","$notificacion",$formulario_acceso);
	
	/*Forma de recepción de la información solicitada*/
	$forma_recepcion = select_admin_campo_simple("sgs_forma_recepcion",$id_forma_recepcion, $js_sel, "",$id_opcional);
	//$oficina = select_admin_campo_simple("sgs_entidades_oficinas",$id_entidad_oficina, $js_sel, "",$id_opcional);
	  
	  $query= "SELECT id_entidad_oficina,oficina    
               FROM  sgs_entidades_oficinas";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_entidad_oficina,$oficina) = mysql_fetch_row($result)){
		  			if($id_entidad_oficina==$id_entidad_oficina2){
					$oficinas .="<option value=\"$oficina\" selected>$oficina</option>";
					}else{
					$oficinas .="<option value=\"$oficina\">$oficina</option>";
					}
    				
    		 }
			 
			 $oficina = "<select name=\"oficina\" id=\"oficina\" disabled >
                    <option value=\"\" >Seleccione una oficina</option>
                    $oficinas
                    </select>";
	
	
	$query= "SELECT  id_forma_recepcion,forma_recepcion,obliga      
               FROM  sgs_forma_recepcion";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_forma_recepcion,$forma_recepcion,$obliga) = mysql_fetch_row($result)){
		 $cont_obliga++;
		  			if($obliga ==1){
					$case_js .="case $cont_obliga:\n 
						       oficina.disabled = false;\n 
							   break;\n";
					}else{
					$case_js .="case $cont_obliga:\n 
						       oficina.disabled = true;\n 
       						   break;\n";
					}
					
					
					if($id_forma_recepcion==$id_forma_recepcion2){
					$for_rec.="<option value=\"$id_forma_recepcion\" selected>$forma_recepcion ssds</option>";
					}else{
					$for_rec.="<option value=\"$id_forma_recepcion\">$forma_recepcion</option>";
					}
		  		
    				
    		 }
			 
			 $forma_recepcion = "<select name=\"id_forma_recepcion\" id=\"id_forma_recepcion\" onchange='accion()'>
                    <option value=\"\" >Seleccione una forma de recepci&oacute;n</option>
                      $for_rec
                    </select>";
	$js.="<script language='javascript'> 

   				function accion(){ 
    						with (document.form1){ 
     						switch (id_forma_recepcion.selectedIndex){ 
     
	 						case 0:\n 
						       oficina.disabled = true;\n 
       						   break;
	    					$case_js
     																	} 
    								  } 
   						
						
						
     					    switch (document.form1.id_forma_recepcion.selectedIndex){ 
     
	 				       
						  case 0:
 						       document.form1.id_formato_entrega[1].checked=true;
						       document.form1.id_formato_entrega[0].disabled=false;
						      
       						   break;
						  case 3:
 						       document.form1.id_formato_entrega[1].checked=true;
						       document.form1.id_formato_entrega[0].disabled=false;
						      
       						   break;
						 case 1:
 						       document.form1.id_formato_entrega[1].checked=true;
						       document.form1.id_formato_entrega[0].disabled=true;
						     
       						   break;
						 case 2:
 						       document.form1.id_formato_entrega[1].checked=true;
						       document.form1.id_formato_entrega[0].disabled=false;
						      
       						   break;
						
						 } 
					    } 
  </script> 
 
";

	$formulario_acceso = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$formulario_acceso);
	$formulario_acceso = cms_replace("#OFICINA#","$oficina (Solo si Retira en Oficina)",$formulario_acceso);
	
	/*Formato de entrega*/
	//echo "$notificacion2 <br>";
	if($notificacion2==""){
	$notificacion2=1;
	}
	$var= "notificacion_$notificacion2";
	$$var = "checked";
	
	$formato_entrega = "<input type=\"radio\" name=\"id_formato_entrega\" id=\"id_formato_entrega\" $notificacion_1 value=\"1\" > Copia en Papel   <input type=\"radio\" $notificacion_0 name=\"id_formato_entrega\" id=\"id_formato_entrega\" value=\"2\" > Formato electr&oacute;nico / Digital ";
	$formulario_acceso = cms_replace("#FORMATO_ENTREGA#","$formato_entrega",$formulario_acceso);
	$formulario_acceso = cms_replace("#FECHA#","$fecha",$formulario_acceso);
	
	$observacion_adicional .= "<textarea name=\"observacion_adicional\" id=\"observacion_adicional\" class=\"textos\" cols=\"89\" rows=\"4\">$observacion_adicional2</textarea>";
	$solicitud_defecto_user_no_registrado = configuracion_cms("solicitud_defecto_user_no_registrado");
	$observacion_adicional .= "<input type=\"hidden\" id=\"id_tipo_consulta\" name=\"id_tipo_consulta\" value=\"$solicitud_defecto_user_no_registrado\" >";				
	$formulario_acceso = cms_replace("#OBSERVACIONES_ADICIONALES#","$observacion_adicional",$formulario_acceso);
	
	
	$id_entidad_buscar = configuracion_cms('id_entidad');
	$query= "SELECT COUNT(id_entidad)
               FROM sgs_entidades
               WHERE id_entidad IN ($id_entidad_buscar)";
	$result= cms_query($query)or die (error($query,mysql_error(),$php));
	list($cantidad_entidades) = mysql_fetch_row($result);
	
	if($cantidad_entidades > 1){
		$query= "SELECT id_entidad,entidad 
				   FROM  sgs_entidades
				   WHERE id_entidad IN ($id_entidad_buscar)";
		
		$result= cms_query($query)or die (error($query,mysql_error(),$php));
		$lista_select_entidad_hija .= "<option value=\"\">--Seleccione--</option>";
		 while (list($id_entidad,$entidad) = mysql_fetch_row($result)){
			$lista_select_entidad_hija .="<option value=\"$id_entidad\">$entidad</option>";
		}
		$lista_entidades = "<br><select name=\"id_entidad\" id=\"id_entidad\" class=\"required\">$lista_select_entidad_hija</select>";
	}else{
		$query= "SELECT id_entidad,entidad 
				   FROM sgs_entidades
				   WHERE id_entidad IN ($id_entidad_buscar)";
		$result= cms_query($query)or die (error($query,mysql_error(),$php));
		list($id_entidad,$entidad) = mysql_fetch_row($result);
		$lista_entidades = "$entidad <input type=\"hidden\" name=\"id_entidad\" id=\"id_entidad\" value=\"$id_entidad\">";
	}
	$formulario_acceso = cms_replace("#LISTA_ENTIDADES#","$lista_entidades",$formulario_acceso);
	
	$check_datos = "<input type=\"checkbox\" name=\"consulta_datos\" id=\"consulta_datos\"><span class=\"ver_datos\">Ver mis datos&nbsp</span>";
	$formulario_acceso = cms_replace("#DETALLE_SOLICITANTE#","$check_datos",$formulario_acceso);
	
			$js .="

					<script type=\"text/javascript\">
						$(document).ready(function(){
						
							$('#consulta_datos').click(function(){
								var checkeado=$(\"#consulta_datos\").attr(\"checked\");
								if(checkeado){
									$('#div_datos_solicitante').show(100);
								}else{
									$('#div_datos_solicitante').css(\"display\", \"none\");
								}
							});
						});
					
					</script>
				";
	
	$contenido= $formulario_acceso;
	
	
?>