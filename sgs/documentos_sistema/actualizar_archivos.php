<?php

if($_GET){

	if($_GET["tipo_documento"] != ""){

		$observacion = $_GET["observacion"];
		$tipo_doc = $_GET["tipo_documento"];
		$id_documento = $_GET["id_documento"];
		$version_documento = $_GET["version_documento"];
			
		$query_actualizar = "UPDATE sgs_solicitudes_documentos
							SET observacion_solicitudes_doc = '$observacion',
								id_solicitud_documentos_tipo = '$tipo_doc',
								id_archivo_origen = '$version_documento'
							WHERE id_solicitudes_doc = '$id_documento'";
							
		$result_actualizar_archivos = cms_query($query_actualizar)or die (error($query_actualizar,mysql_error(),$php));
	}
	else{
		echo "<h3>Debe ingresar el tipo de archivo</h3>";
	}

}
	
	
	

?>