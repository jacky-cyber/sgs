<?php

	$id_perfil_usuario = perfil($id_sesion);	
	$query = "SELECT id_contacto,descripcion,mail_contacto,defecto,id_perfiles_despliegue 
			   FROM contacto_mails
			   WHERE activo = 1";
	
	$result= cms_query($query)or die (error($query,mysql_error(),$php));
	
	$lista_destinos .= "<select id=\"id_mail\" name=\"id_mail\" class=\"required\">";
	$lista_destinos .= "<option value=\"\">--Seleccione--</option>\n";
	while (list($id_contacto ,$descripcion,$mail_contacto,$defecto,$id_perfiles_despliegue) = mysql_fetch_row($result)){	
		$arreglo_perfiles_despliegue = explode(",",$id_perfiles_despliegue);
		if(in_array($id_perfil_usuario,$arreglo_perfiles_despliegue)){
			if($defecto==1){
				$lista_destinos .="<option value=\"$id_contacto\" selected>$descripcion</option>\n";
			}else{
				$lista_destinos .="<option value=\"$id_contacto\">$descripcion</option>\n";
			}
		}
	}
	$lista_destinos .= "</select>";			
	
	$funcionario = rescata_valor('usuario_perfil',$id_perfil_usuario,'funcionario');
	if($funcionario == 0){
		$login_chileatiende = html_template('texto_ayuda_contacto');
	}
	$accion_form = "index.php?accion=$accion&act=2";

	$js = "
	
		<script type=\"text/javascript\">
		
			$().ready(function() {
			
				$(\"#nombre\").keyfilter(/[a-z_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ '\s -]/i);
				$(\"#mail_contacto\").keyfilter(/[a-z0-9_\.\-@]/i);
			
				$(\"#form1\").validate({
					id_mail: {
						required: function(element) {
							return $(\"#id_mail\").val() != '0'
						}
					},
					nombre: {
						required : true
					},
					mail_contacto: {
						required : true
					},
					comentario: {
						required : true
					}
				});
				
				
				$('#id_mail').change(function(){
					$.post('index.php?accion=$accion&act=3&axj=1',{
						idMail:$(this).val()
					}, function(resp){
						if(resp != \"\"){
							//barra_derecha
							$('#div_ayuda').addClass('tabla_verde');
							$('#div_ayuda').html(resp);
						}else{
							$('#div_ayuda').removeClass('tabla_verde');
							$('#div_ayuda').html('');
						}
					});
				});	
				
			});
			
			
			$('#enviar').click(function(){
				if($('#form1').valid()==true){		
					$('#form1').submit();
				}
			});

		</script>
	
	
	";


	$formulario_contacto = html_template('formulario_contacto');

	$nombre_contacto = "<input id=\"nombre\" name=\"nombre\" type=\"text\" class=\"required\"  value=\"\">";
	$mail_contacto = "<input id=\"mail_contacto\" name=\"mail_contacto\" type=\"text\" class=\"required\">";
	$comentario = "<textarea id=\"comentario\" name=\"comentario\" cols=\"20\" rows=\"5\" class=\"required\"></textarea>";
	$boton_enviar = "<input type=\"submit\" name=\"enviar\" id=\"enviar\" value=\"Enviar\" />";

	$formulario_contacto = cms_replace("#CMB_MOTIVO#",$lista_destinos,$formulario_contacto);
	$formulario_contacto = cms_replace("#NOMBRES#",$nombre_contacto,$formulario_contacto);
	$formulario_contacto = cms_replace("#EMAIL#",$mail_contacto,$formulario_contacto);
	$formulario_contacto = cms_replace("#COMENTARIO#",$comentario,$formulario_contacto);
	$formulario_contacto = cms_replace("#BOTON_ENVIAR#",$boton_enviar,$formulario_contacto);
	
	$contenido = $formulario_contacto;



?>