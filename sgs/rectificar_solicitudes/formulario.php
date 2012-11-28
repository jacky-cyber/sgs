<?php
	$formato_per2=configuracion_cms("formato_permitido2");
$js.="
<script>
			$(document).ready(function(){
			
				$(\"#form1\").validate({
						rules: {
							archivodoc: {
								required: true
							},
							tipo_documento: {
								required : true
							}
						},
						messages: {
							archivodoc: \"<br>Ingrese el archivo\"
						}
				});
				
					
				$('#btnguardar').live('click', function(){
					var objeto =document.getElementById('archivodoc');
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
							$('#form1').submit();
						}else{
							//alert('debe ingresar archivo con formato válido');
							return false;
						}
				});
				
			});
														
			function modificar(idSol){
			
				if($(\"#form1\").valid()){
				
				var observacion = $(\"#observacion_adjunto\").val();
				var tipo_documento = $(\"#tipo_documento\").val();
				var version_documento = $(\"#docto\").val();
				var link = \"index.php?accion=$accion&act=6&id_documento=\"+idSol+\"&observacion=\"+observacion+\"&tipo_documento=\"+tipo_documento+\"&version_documento=\"+version_documento+\"&folio=$folio&axj=1\";
				var div_listado_archivos = \"listado_archivos\";
				ObtenerDatos(link,div_listado_archivos);
				//resetForm('form1');
				var link = \"index.php?accion=$accion&iddoc=$idsol&folio=$folio&act=5&axj=1\";
				var div_carga = \"carga\";
				ObtenerDatos(link,div_carga);
				$('#consulta_archivos').attr('checked',false);
				$('#carga').css(\"display\", \"none\");
				}
			}
			
			function descarga_archivo(url){
				location.href=url;
			}
			
			function agregarNuevo(){
				$(\"#btnnuevo_archivo\").attr(\"style\", \"display:none\");
				var link = \"index.php?accion=$accion&iddoc=$idsol&folio=$folio&act=5&axj=1\";
				var div_carga = \"carga\";
				ObtenerDatos(link,div_carga);
				
			}
				
	</script>";
	
$css.="<style type=\"text/css\">

	input.error { 
		border: 2px solid red; 
	}
	select.error {
		border: 2px solid red; 
	}
	</style>
";

	$query_combo="SELECT id_solicitud_documentos_tipo,tipo_documento
				  FROM sgs_solicitud_documentos_tipo 
				 ";
	if($_GET["iddoc"]){			 
		$idSol=$_GET["iddoc"];
		$query_opcion_seleccionada="SELECT id_solicitud_documentos_tipo,archivo_solicitudes_doc,observacion_solicitudes_doc,id_archivo_origen 
									FROM sgs_solicitudes_documentos 
									WHERE id_solicitudes_doc='$idSol'		
									";		
		$result_opcion_seleccionada= cms_query($query_opcion_seleccionada)or die (error($query_opcion_seleccionada,mysql_error(),$php));
		list($id_doc,$nombre_archivo,$observacion_solicitudes,$archivo_origen) = mysql_fetch_row($result_opcion_seleccionada);
	}

	$result_select_combo= cms_query($query_combo)or die (error($query_combo,mysql_error(),$php));


	$opciones_combo.="<select id=\"tipo_documento\" name=\"tipo_documento\">";
	$opciones_combo.= "<option value=\"\">seleccione</option>";
	while(list($id_tipo_doc,$tipo_doc) = mysql_fetch_row($result_select_combo)){
		if(!$id_doc){
			$opciones_combo.="<option value=\"$id_tipo_doc\">$tipo_doc</option>";
		}else{
			if($id_doc==$id_tipo_doc)
				$opciones_combo.="<option value=\"$id_tipo_doc\" selected=\"selected\">$tipo_doc</option>";
			else
				$opciones_combo.="<option value=\"$id_tipo_doc\">$tipo_doc</option>";
		}
	}
	$opciones_combo.="</select>";


	$query_archivos="SELECT id_solicitudes_doc,archivo_solicitudes_doc, DATE_FORMAT(fecha_solicitudes_doc,'%d-%m-%Y')
			FROM sgs_solicitudes_documentos 
			WHERE folio='$folio'";
	$result_select_archivos= cms_query($query_archivos)or die (error($query_archivos,mysql_error(),$php));

	$versiones_archivo = "<select id=\"docto\" name=\"docto\">";
	$versiones_archivo .= "<option value=\"0\">seleccione</option>";
	while(list($idsol,$archivo_solicitudes_doc,$fecha) = mysql_fetch_row($result_select_archivos)){
		if(!$id_doc){
			$versiones_archivo.="<option value=\"$idsol\">$archivo_solicitudes_doc--$fecha</option>";
		}else{
			if($archivo_origen == $idsol)		
				$versiones_archivo.="<option value=\"$idsol\" selected=\"selected\">$archivo_solicitudes_doc--$fecha</option>";
			else
				$versiones_archivo.="<option value=\"$idsol\">$archivo_solicitudes_doc--$fecha</option>";
		}	
	}
	$formato_per=configuracion_cms("formato_permitido");
	$formato_per=str_replace("'","",$formato_per);
	$versiones_archivo.="</select>";

	if(!$id_doc)
		$inputfile = "<input type=\"file\" id=\"archivodoc\" name=\"archivodoc\"><br>Formatos v&aacute;lidos de los archivos adjuntos: ($formato_per)";
	else
		$inputfile = "<h3>$nombre_archivo<input style=\"float:right\" type=\"button\" id=\"btnnuevo_archivo\" name=\"btnnuevo_archivo\" value=\"Agregar Nuevo Archivo\" onclick=\"agregarNuevo($idSol);\" /></h3> Formatos v&aacute;lidos de los archivos adjuntos: ($formato_per)";

	if(!$id_doc)
		$observacion = "<textarea id=\"observacion_adjunto\" name=\"observacion_adjunto\"></textarea>";
	else
		$observacion = "<textarea id=\"observacion_adjunto\" name=\"observacion_adjunto\">$observacion_solicitudes</textarea>";

	if(!$id_doc){
		$boton_guardar = "<input type=\"button\" id=\"btnguardar\" name=\"btnguardar\" value=\"Guardar\"/>";
	}else{
		$boton_guardar = "<input type=\"button\" id=\"btnactualizar\" name=\"btnactualizar\" value=\"Actualizar\" onclick=\"modificar($idSol);\" />";	
	}
	
	$folio_hidden_oculto = "<input type=\"hidden\" id=\"userid\" name=\"userid\" value=\"$id_usuario\"/><input type=\"hidden\" id=\"fol\" name=\"fol\" value=\"$folio\"/>";

$formulario = html_template('formulario_lista_archivos_web');
$formulario= cms_replace("#FILE_DOCUMENTO#",$inputfile,$formulario);
$formulario= cms_replace("#OBSERVACION#",$observacion,$formulario);
$formulario= cms_replace("#BOTON#",$boton_guardar,$formulario);
$formulario= cms_replace("#OCULTO#",$folio_hidden_oculto,$formulario);

?>