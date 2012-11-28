<?php

	$sesion_conectado = session_id();
	$formulario_acceso = html_template('formulario_web_no_registrado');

	$js .="<style type=\"text/css\">


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

					$(\"#nombres\").keyfilter(/[a-z_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ '\s]/i);
					$(\"#apellido_paterno\").keyfilter(/[a-z_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ '\s -]/i);
					$(\"#apellido_materno\").keyfilter(/[a-z_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ '\s -]/i);
					$(\"#direccion\").keyfilter(/[a-z0-9_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ ' .\s]/i);
					$('#correo_$sesion_conectado').keyfilter(/[a-z0-9_\.\-@]/i);
					$(\"#telefono\").keyfilter(/[\d\-\.]/);
					$(\"#texto_ingresado\").keyfilter(/[a-z0-9_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ \s]/i);
					
					// validate signup form on keyup and submit
					$(\"#form1\").validate({
						rules: {
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
							},
							texto_ingresado:{
								required: true
								
							},
							terminos_condiciones:{
								required:true
							}
						},
						messages: { 
							oficina: \"Debe indicar una dirección\",
							texto_ingresado: \" Ingrese Captcha\",
							terminos_condiciones: \"Seleccione terminos y condiciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\",
							identificacion_documentos: \"<br><p>Debe especificar que requerimientos de información o documentos necesita</p>\"
						}
					});
				});



		</script>";
	$formatos_permitidos = configuracion_cms("formato_permitido");
	$formato_per2 = configuracion_cms("formato_permitido2");
   
	$fecha = date(d)."-".date(m)."-".date(Y);
	$mensaje_solicitud_sin_registro = configuracion_cms('mensaje_solicitud_sin_registro');
	$formulario_acceso = cms_replace("#TEXTO_INFORMACION#","$mensaje_solicitud_sin_registro",$formulario_acceso);
	
	$formulario_acceso = cms_replace("#TIPO_PERSONA#","$tipo_persona",$formulario_acceso);
	
	$nombres = "<input type=\"text\" id=\"nombres\" name=\"nombres\" class=\"required\" />";
	$formulario_acceso = cms_replace("#NOMBRES#","$nombres",$formulario_acceso);
	
	$telefono = "<input type=\"text\" id=\"telefono\" name=\"telefono\" />";
	$formulario_acceso = cms_replace("#TELEFONO#","$telefono",$formulario_acceso);
	
	$apellido_paterno = "<input type=\"text\" id=\"apellido_paterno\" name=\"apellido_paterno\" class=\"required\" />";
	$formulario_acceso = cms_replace("#APELLIDO_PATERNO#","$apellido_paterno",$formulario_acceso);
	
	$apellido_materno = "<input type=\"text\" id=\"apellido_materno\" name=\"apellido_materno\" class=\"required\" />";
	$formulario_acceso = cms_replace("#APELLIDO_MATERNO#","$apellido_materno",$formulario_acceso);
	
	$direccion = "<input type=\"text\" id=\"direccion\" name=\"direccion\" />";
	$formulario_acceso = cms_replace("#DIRECCION#","$direccion",$formulario_acceso);
	
	$numero = "<input type=\"text\" id=\"numero\" name=\"numero\" />";
	$formulario_acceso = cms_replace("#NUMERO#","$numero",$formulario_acceso);
	
	$departamento = "<input type=\"text\" id=\"depto\" name=\"depto\" />";
	$formulario_acceso = cms_replace("#DEPTO#","$departamento",$formulario_acceso);
	
	$sexo = radio_tabla('usuario_sexo',$id_sexo,'id_sexo','id_sexo',$js_sel.'checked=\"checked\"','');
	$formulario_acceso = cms_replace("#SEXO#","$sexo",$formulario_acceso);
	
	$rut = "<input type=\"text\" id=\"rut\" name=\"rut\" class=\"rtt\" />";
	$formulario_acceso = cms_replace("#RUT#","$rut",$formulario_acceso);
	
	$correo = "<input type=\"text\" id=\"correo_$sesion_conectado\" name=\"correo_$sesion_conectado\" />";
	$formulario_acceso = cms_replace("#EMAIL#","$correo",$formulario_acceso);
	
	$identificacion_documentos2 =htmlspecialchars_decode($identificacion_documentos2);
	$identificacion_documentos = "<textarea name=\"identificacion_documentos\" id=\"identificacion_documentos\" class=\"textos\" cols=\"96\" rows=\"8\" >$identificacion_documentos2</textarea>";
	$formulario_acceso = cms_replace("#IDENTIFICACION_DOCUMENTOS#","$identificacion_documentos",$formulario_acceso);
	$formulario_acceso = cms_replace("#SERVICIO#","$servicio",$formulario_acceso);
	
	/*
	$condicion = "AND home = 1";
	$select_tipo_consulta = select_tabla('sgs_tipo_solicitud',$id_tipo_consulta2,'id_tipo_solicitud','tipo_solicitud','','required',$condicion);
	$formulario_acceso = cms_replace("#TIPO_CONSULTA#","$select_tipo_solicitud",$formulario_acceso);
	*/
	
	
	///$login_chileatiende = "<div class=\"tabla_verde_sin_ico\"><h1>Help ayuda formulario</h1></div>";
	
	$paises = select_tabla('pais',$id_pais,'id_pais','pais',$js_sel,'','');
	
	$query= "SELECT id_region,region
               FROM regiones
			   order by region";
    $result= cms_query($query)or die (error($query,mysql_error(),$php));
    while(list($id_region,$region) = mysql_fetch_row($result)){
		$region_lista .="<option value=\"$id_region\">$region</option>";
	}
	$region= "<select name=\"id_region\" id=\"id_region\">
				<option value=\"\">--Seleccione--</option>
				$region_lista
			  </select>";

	$comuna = "<select id=\"id_comuna\" name=\"id_comuna\">
							<option value=\"\">--Seleccione--</option>
						 </select>";
	
	$formulario_acceso = cms_replace("#PAIS#","$paises",$formulario_acceso);					 
	$formulario_acceso = cms_replace("#REGION#","$region",$formulario_acceso);					 
	$formulario_acceso = cms_replace("#COMUNA#","$comuna",$formulario_acceso);
	
	$query= "SELECT id_pais 
               FROM  pais
			   WHERE pais LIKE '%Chile%'";
	$result= cms_query($query)or die (error($query,mysql_error(),$php));
	list($id_pais_chile) = mysql_fetch_row($result);
	
	 $query= "SELECT id_entidad_oficina,oficina    
               FROM  sgs_entidades_oficinas";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_entidad_oficina,$oficina) = mysql_fetch_row($result)){
		  			if($id_entidad_oficina==$oficina_select){
					$oficinas .="<option value=\"$oficina\" selected>$oficina</option>";
					}else{
					$oficinas .="<option value=\"$oficina\">$oficina</option>";
					}
    				
    		 }
			 if($oficina2 ==  ""){
				$oficina = "<select name=\"oficina\" id=\"oficina\" disabled >
                    <option value=\"\">Seleccione una oficina</option>
                    $oficinas
                    </select>";
			}else{
				$oficina = "<select name=\"oficina\" id=\"oficina\">
                    <option value=\"\">Seleccione una oficina</option>
                    $oficinas
                    </select>";
			}
	
	
	$query= "SELECT id_forma_recepcion,forma_recepcion,obliga
               FROM sgs_forma_recepcion";
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
					$for_rec.="<option value=\"$id_forma_recepcion\" selected>$forma_recepcion</option>";
					}else{
					$for_rec.="<option value=\"$id_forma_recepcion\">$forma_recepcion</option>";
					}
    		 }
			 
			 $forma_recepcion = "<select name=\"id_forma_recepcion\" id=\"id_forma_recepcion\" onchange='accion()'>
                    <option value=\"\" >Seleccione una forma de recepci&oacute;n</option>
                      $for_rec
                    </select>";
					
					
	$formulario_acceso = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$formulario_acceso);
	$formulario_acceso = cms_replace("#OFICINA#","$oficina (Solo si Retira en Oficina)",$formulario_acceso);
	
	/*Notificación*/
	if($notificacion2==""){
	$notificacion2=1;
	}
	$var = "notificacion_$notificacion2";
	$$var = "checked";
	

	$notificacion = "<input type=\"radio\" name=\"notificacion\" id=\"notificacion\" $notificacion_1 value=\"1\"  > S&iacute;   <input type=\"radio\" $notificacion_0 name=\"notificacion\" id=\"notificacion\" value=\"0\" > No    ";
	
	$formulario_acceso = cms_replace("#SI#","$notificacion",$formulario_acceso);

	if($id_formato_entrega2==""){
		$id_formato_entrega2=1;
	}
	$var= "formato_entrega_$id_formato_entrega2";
	$$var = "checked";	
	
	//$formato_entrega = "<input type=\"radio\" name=\"id_formato_entrega\" id=\"id_formato_entrega\" $formato_entrega_1 value=\"1\" > Copia en Papel   <input type=\"radio\" $formato_entrega_2 name=\"id_formato_entrega\" id=\"id_formato_entrega\" value=\"2\" > Formato electr&oacute;nico / Digital ";
	//$formulario_acceso = cms_replace("#FORMATO_ENTREGA#","$formato_entrega",$formulario_acceso);
	$formulario_acceso = cms_replace("#FECHA#","$fecha",$formulario_acceso);
	
	$boton_guardar = "<input type=\"button\" id=\"btn_guardar\" name=\"btn_guardar\" value=\"Guardar\" />";
	$formulario_acceso = cms_replace("#BOTON_GUARDAR#","$boton_guardar",$formulario_acceso);
	
	include("captcha/captcha.php");
	$formulario_acceso = cms_replace("#CAPTCHA#","$captcha_form $var_div",$formulario_acceso);
	$boton_captcha = html_template('boton_captcha_web_ips');
	$formulario_acceso = cms_replace("#BOTON_CAPTCHA#",$boton_captcha,$formulario_acceso);
	
	$id_entidad_buscar = configuracion_cms('id_entidad');
	   $query= "SELECT id_entidad,entidad 
               FROM  sgs_entidades
               WHERE id_entidad IN ($id_entidad_buscar)";
	$result= cms_query($query)or die (error($query,mysql_error(),$php));
	$lista_select_entidad_hija .= "<option value=\"\" >--Seleccione--</option>";
	 while (list($id_entidad,$entidad) = mysql_fetch_row($result)){
		$lista_select_entidad_hija .="<option value=\"$id_entidad\">$entidad</option>";
	}
	$lista_entidades .= "<br><select name=\"id_entidad\" id=\"id_entidad\" class=\"required\" >$lista_select_entidad_hija</select>";
	$solicitud_defecto_user_no_registrado = configuracion_cms("solicitud_defecto_user_no_registrado");
	$lista_entidades .= "<input type=\"hidden\" id=\"id_tipo_solicitud\" name=\"id_tipo_solicitud\" value=\"$solicitud_defecto_user_no_registrado\" >";				
	$formulario_acceso = cms_replace("#LISTA_ENTIDADES#","$lista_entidades",$formulario_acceso);
	
	//$sexo =            radio_tabla('usuario_sexo',$id_sexo,'id_sexo','id_sexo',$js_sel.'checked=\"checked\"','');
	//$formato_entrega = radio_tabla('sgs_formato_entrega',$id_formato_entrega,'id_formato_entrega','formato_entrega',$js_sel.'checked=\"checked\"','');
	$formato_entrega = "<input type=\"radio\" name=\"id_formato_entrega\" id=\"id_formato_entrega\" $formato_entrega_1 value=\"1\" > Copia en Papel   <input type=\"radio\" $formato_entrega_2 name=\"id_formato_entrega\" id=\"id_formato_entrega\" value=\"2\" > Formato electr&oacute;nico / Digital ";
	$formulario_acceso = cms_replace("#FORMATO_ENTREGA#","$formato_entrega",$formulario_acceso);
	
	
	// Datos opcionales
	$nacionalidad = select_tabla('usuario_nacionalidad',$id_nacionalidad,'id_nacionalidad','nacionalidad',$js_sel,'','');
	$rango_edad = select_tabla("usuario_rango_edad",$id_rango_edad,'id_rango_edad','rango_edad',$js_sel,'','');
	$ocupacion = select_tabla("usuario_ocupacion",$id_ocupacion,'id_usuario_ocupacion','ocupacion',$js_sel,'','');
	$nivel_educacional = select_tabla("usuario_nivel_educacional",$id_nivel_educacional,'id_nivel_educacional','nivel_educacional',$js_sel,'','');
	$organizacion = select_tabla("usuario_organizacion",$id_organizacion,'id_organizacion','organizacion',$js_sel,'','');
	$frecuencia = select_tabla("usuario_frecuencia_organizacion",$id_frecuencia_organizacion,'id_frecuencia_organizacion','frecuencia_organizacion',$js_sel,'','');
	
	$formulario_acceso = cms_replace("#NACIONALIDAD#","$nacionalidad",$formulario_acceso);
	$formulario_acceso = cms_replace("#EDAD#","$rango_edad",$formulario_acceso);
	$formulario_acceso = cms_replace("#OCUPACION#","$ocupacion",$formulario_acceso);
	$formulario_acceso = cms_replace("#NIVEL_EDUCACIONAL#","$nivel_educacional",$formulario_acceso);
	$formulario_acceso = cms_replace("#TIPO_ORGANIZACION#","$organizacion",$formulario_acceso);
	$formulario_acceso = cms_replace("#FRECUENCIA#","$frecuencia",$formulario_acceso);
	
	$observacion_adicional = "<textarea name=\"observacion_adicional\" id=\"observacion_adicional\" cols=\"88\" rows=\"8\" >$identificacion_documentos2</textarea>";
	$formulario_acceso = cms_replace("#OBSERVACIONES_ADICIONALES#","$observacion_adicional",$formulario_acceso);
	
	$archivo_adjuntar = "<input type=\"file\" id=\"archivo_adjuntar\" name=\"archivo_adjuntar\" onChange=\"cargaArchivo();\" >
							</br> Formatos permitidos: $formatos_permitidos";
	$formulario_acceso = cms_replace("#ADJUNTA_ARCHIVO#","$archivo_adjuntar",$formulario_acceso);
		
	$accion_form = "index.php?accion=$accion&act=1";
	
	$contenido = $formulario_acceso;
	
	$js .="
	
	<script src=\"js/jquery/jquery.Rut.min.js\" type=\"text/javascript\"></script>
	<script type=\"text/javascript\"> 
			
		$(document).ready(function(){
		
		
			$('#id_region').attr('disabled', true);
			$('#id_comuna').attr('disabled', true);
			
			
			$('.rtt').focus(function(){
						
				var inputRut=$(this).attr('id');
				$(this).Rut(
				function(){ 
				alert('Rut Inv\u00e1lido');
				$('#'+inputRut).val('');
				});	
			});
			
			$('#btn_guardar').click(function(){
			//$('#btn_guardar').attr('disabled', true);
				//alert ($('#id_forma_recepcion').val());
				
				$('#texto_ingresado').addClass('required');
				$('#terminos_condiciones').addClass('required');

				
				
				
				var valor = $('#id_forma_recepcion').val();
				
				if(valor == 1){
				
					$('#correo_$sesion_conectado').addClass('required email');
					$('#direccion').removeClass('required error');
					$('#numero').removeClass('required error');
					$('#ciudad').removeClass('required error');
					$('#id_pais').removeClass('required error');
					$('#id_region').removeClass('required error');
					$('#id_comuna').removeClass('required error');
				}else if(valor == 4){
				
					$('#correo_$sesion_conectado').removeClass('required');
					$('#correo_$sesion_conectado').addClass('email');
					$('#direccion').addClass('required');
					$('#numero').addClass('required');
					$('#ciudad').addClass('required');
					$('#id_pais').addClass('required');
					$('#id_region').addClass('required');
					$('#id_comuna').addClass('required');
				}else{
					$('#correo_$sesion_conectado').removeClass('required');
					$('#correo_$sesion_conectado').addClass('email');
					$('#direccion').addClass('required');
					$('#numero').addClass('required');
					$('#ciudad').addClass('required');
					$('#id_pais').addClass('required');
					$('#id_region').addClass('required');
					$('#id_comuna').addClass('required');
				}
				
				
				if($('#form1').valid()==true){
								
					$.post('index.php?accion=consultas-web&act=4&axj=1',{
						texto_ingresado:$('#texto_ingresado').val()
					}, function(resp){
					
						if(resp==0){
							ObtenerDatos('captcha/refresh.php','captcha');
							$('#texto_ingresado').val('');
							$('#btn_guardar').click();
						}else{
							if(confirm('Est\u00e1 seguro de ingresar esta informaci\u00f3n')){
								$(\"#btn_guardar\").attr(\"disabled\", \"disabled\");
								$('#form1').submit();
							}else{
								return false;
							}
						}
					});
					
				}
				
			});
			
			$('#id_pais').change(function(){
				if($('#id_pais').val() == '$id_pais_chile'){
					$('#id_region').attr('disabled', false);
					$('#id_comuna').attr('disabled', false);
					
				}else{
					$('#id_region option')['0'].selected = true;
					$('#id_region').attr('disabled', true);
					
					var sele = document.createElement(\"select\");
					var opt = document.createElement(\"option\");
					opt.value = \"\";
					opt.innerHTML = \"--Seleccione--\";
					sele.appendChild(opt);
					sele.disabled = true;
					$('#div_comuna').html(sele);
				}
			});
			
			$('#id_region').change(function(){
				$.post('index.php?accion=$accion&act=3&axj=1',{
							idRegion:$(this).val()
				}, function(resp){
						if($('#id_region').val() != \"\"){
							$('#div_comuna').html('');
							$('#div_comuna').html(resp);
							$('#id_comuna').disabled = false;
						}else{
							var sele = document.createElement(\"select\");
							var opt = document.createElement(\"option\");
							opt.value = \"\";
							opt.innerHTML = \"--Seleccione--\";
							sele.appendChild(opt);
							sele.disabled = true;
							$('#div_comuna').html(sele);
						}
				});
			});
			
			
		});		
	

						
  </script> 
 
";	

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
						
						
			function cargaArchivo(){
			
				var largo=document.getElementsByName('archivo_adjuntar').length-1;
				var objeto=document.getElementById('archivo_adjuntar');
				var extension=(objeto.value.substring(objeto.value.lastIndexOf('.'))).toLowerCase();
				var extensiones_permitidas = new Array($formato_per2); 
				var  txt='';
				var  txt2='';
				var  txt3='';
				var permitida = false;
				for (var i = 0; i < extensiones_permitidas.length; i++) {
					 if (extensiones_permitidas[i] == extension) {
					 permitida = true;
					 break;
					 }
				} 
				 
				if(permitida==true){
					return true;
				}else{
					alert('Debe ingresar archivo con formato v\u00e1lido');
					$('#archivo_adjuntar').val('');
				}
			}
  </script> 
 
";


	


?>