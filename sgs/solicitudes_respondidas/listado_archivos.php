<?php

	$query_count = "SELECT COUNT(id_solicitudes_doc) as contador
					FROM sgs_solicitudes_documentos
					WHERE folio = '$folio'";
	$result_count= cms_query($query_count)or die (error($query_count,mysql_error(),$php));
	list($contador) = mysql_fetch_row($result_count);
	if($contador == 0){
		$lista.= "
				<table cellspacing=\"0\" class=\"alerta\" width=\"100%\">
					<tr>
						<td align=\"center\">La solicitud no contiene archivos </td>
					</tr>
				</table>	
				";
	}
	else{
	
	$lista = html_template('contenedor_listado_archivos');
		
		$query="SELECT a.id_solicitudes_doc,a.archivo_solicitudes_doc, t.tipo_documento,u.nombre,u.paterno,DATE_FORMAT(a.fecha_solicitudes_doc,'%d-%m-%Y'), a.cantidad_descarga_doc
				FROM sgs_solicitudes_documentos a
				left outer join usuario u on  a.id_usuario = u.id_usuario
				left outer join  sgs_solicitud_documentos_tipo  t on  t.id_solicitud_documentos_tipo = a.id_solicitud_documentos_tipo
				WHERE folio='$folio'
				ORDER BY id_solicitudes_doc DESC";
				
		$result_select_archivos= cms_query($query)or die (error($query,mysql_error(),$php));
		while(list($idsol,$archivo_solicitudes_doc,$tipo_documento,$nombre,$apellido,$fecha,$cantidad_descargas) = mysql_fetch_row($result_select_archivos)){
			$link_sistema = "index.php?accion=$accion&act=5&iddoc=$idsol&folio=$folio&axj=1";
			$div_carga = "carga";
			$nombre_completo=$nombre." ".$apellido;
			$link_descarga = "chileatiende/documentos_sistema/docs/$folio/$idsol/";
			
				$link_descarga = "chileatiende/documentos_sistema/docs/$folio/$idsol/";
				$lista_ficha.="<tr>
							<td>$archivo_solicitudes_doc</td>
							<td>$nombre_completo</td>
							<td>$fecha</td>
							
							<td class=\"descarga\"><a  onmouseover=\"this.style.cursor='pointer'\" onclick='descarga_archivo(\"index.php?accion=$accion&act=9&iddoc=$idsol&folio=$folio&axj=1\");' >Descargar aqu&iacute;</a></td>
						</tr>
				";
			
			$combo_lista_docto.="<option value=\"$idsol\">$archivo_solicitudes_doc--$fecha</option>";
		}
		
		$lista = cms_replace("#LISTA_DESCARGA#","$lista_ficha",$lista);
		
		
	}
	







		
?>	