<?php
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
$query="SELECT a.archivo_solicitudes_doc,t.tipo_documento ,u.nombre,u.paterno,DATE_FORMAT(a.fecha_solicitudes_doc,'%d-%m-%Y')
									FROM sgs_solicitudes_documentos a, usuario u, sgs_solicitud_documentos_tipo t
									WHERE a.id_usuario=u.id_usuario
									AND t.id_solicitud_documentos_tipo = a.id_solicitud_documentos_tipo
									AND folio='$fl'";
							$result_select_archivos= cms_query($query)or die (error($query,mysql_error(),$php));
								while(list($archivo_solicitudes_doc,$tipo_documento,$nombre,$apellido,$fecha ) = mysql_fetch_row($result_select_archivos)){
								$combo_lista_docto.="<option value=\"$idsol\">$archivo_solicitudes_doc--$fecha</option>";
							echo "asdas";
							}
}
?>							