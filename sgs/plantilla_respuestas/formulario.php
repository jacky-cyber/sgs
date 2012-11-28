<?php

	$estado_padre_finalizada = configuracion_cms('estado_padre_finalizada');
	$texto_aviso_borrador_respuesta = configuracion_cms('texto_aviso_borrador_respuesta_funcionario');
	
	$js .= "
	
				<script type=\"text/javascript\" src=\"ckeditor/ckeditor.js\"></script>
				<script type=\"text/javascript\" src=\"ckeditor/adapters/jquery.js\"></script>
	
				<script type=\"text/javascript\">
					$(document).ready(function(){
					
						$('#id_plantilla').change(function(){
							$.post('index.php?accion=$accion&act=14&folio=$folio&axj=1',{
								template:$(this).val(),
								folio: $('#fol').val()
							}, function(resp){
								$('#editor1').val('');
								$('#editor1').val(resp);
								$('#respuesta').val(resp);
								
							});
						});
						
						$('#id_estado_solicitud').change(function(){
						
							var estado = $(this).val();
							if(estado == '$estado_padre_finalizada'){
								$('#div_contenedor_respuestas').show(100);
								$('#habilitado').val('1');
								$('#mensaje_alerta_respuesta').html('$texto_aviso_borrador_respuesta');
								$('#mensaje_alerta_respuesta').show(100);
								
							}else{
								$('#div_contenedor_respuestas').css('display', 'none');
								$('#habilitado').val('0');
								$('#mensaje_alerta_respuesta').css('display', 'none');
							}
						});

						// CKEDITOR
			
						var config = {
									toolbar:
									[
										['Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'],
										['Find','Replace','-','SelectAll','-','SpellChecker'],
										['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList', '-', 'Undo', 'Redo', '-', 'SelectAll'],
										['UIColor']
									]
						}; 
						
						
						$('#editor1').ckeditor(config); // ORIGINAL.
						//$('#editor1').addClass(\"required\"); 
						//$('#editor1').ckeditor(); // ORIGINAL CON TOOLBAR FULL
						
						// CKEDITOR
					
					});
					
					function respuesta_original(){
						if($('#editor1').val() != ''){
							$('#dialogo').html($('#editor1').val());
							$('#dialogo').dialog({
												width: 500,
												modal: true
												
							});
						}
					}
					
				</script>
	
		";
	$area_plantilla = "<textarea id=\"editor1\" name=\"editor1\"></textarea>";
	
	//Plantillas
	$query_plantillas = "
				SELECT id_plantilla,nombre_plantilla
					FROM sgs_plantilla_respuestas
	";
	$result_select_plantillas= mysql_query($query_plantillas)or die (error($query_plantillas,mysql_error(),$php));
	$select_plantillas .= "<select id=\"id_plantilla\" name=\"id_plantilla\"> ";
	$select_plantillas.="<option value=\"\">--Seleccione--</option>";
	while(list($id_plantilla,$nombre_plantilla) = mysql_fetch_row($result_select_plantillas)){
		$select_plantillas.="<option value=\"$id_plantilla\">$nombre_plantilla</option>";
	}
	$select_plantillas .= "</select> <input type=\"hidden\" name=\"respuesta\" id=\"respuesta\"> <input type=\"hidden\" value=\"$folio\" name=\"fol\" id=\"fol\"> <input type=\"hidden\" value=\"0\" name=\"habilitado\" id=\"habilitado\">  ";
	
	$respuesta_original = "<a onmouseover=\"this.style.cursor='pointer'\" onclick=\"respuesta_original();\"> <span class=\"ver_ultima_respuesta\">&nbspVer Borrador de Respuesta</span></a>";

	$formulario_respuestas = html_template('contenedor_plantilla_respuestas');
	$formulario_respuestas = cms_replace("#EDITOR_PLANTILLAS#",$area_plantilla,$formulario_respuestas);
	$formulario_respuestas = cms_replace("#RESPUESTA_ORIGINAL#",$respuesta_original,$formulario_respuestas);
	$formulario_respuestas = cms_replace("#LISTADO_PLANTILLAS#",$select_plantillas,$formulario_respuestas)


?>