<?php

$hash = $_GET['hash'];

$query= "SELECT ssa.id_solicitud_acceso,ssa.folio,ssa.fecha_formulacion,ssa.fecha_digitacion,ssa.fecha_inicio,ssa.fecha_termino,ssa.id_entidad_padre,ssa.id_entidad,ssa.id_usuario,ssa.identificacion_documentos,ssa.notificacion,ssa.id_forma_recepcion,ssa.oficina,ssa.id_formato_entrega,ssa.orden,ssa.id_estado_solicitud,ssa.id_sub_estado_solicitud,ssa.id_responsable,ssa.id_digitador,ssa.prorroga,ssa.finalizada,ssa.firmada,ssa.hash,ssa.otra_entidad_origen,ssa.fecha_original,ssa.id_entidad_padre_origen,ssa.id_entidad_hija_origen,ssa.url_documento_origen,ssa.observacion_origen,ssa.id_tipo_solicitud,se.entidad,ses.estado_solicitud,u.nombre,u.paterno
			FROM  sgs_solicitud_acceso ssa,usuario u, sgs_entidades se, sgs_estado_solicitudes ses
			WHERE hash = '$hash'
			ORDER BY folio asc";
			
			
	
		 $contenido = html_template('contenedor_lista_solicitudes_busqueda');	
		 $result= mysql_query($query)or die (error($query,mysql_error(),$php));
		 $tot_res= mysql_num_rows($result);
		        while (list($id_solicitud_acceso,$folio,$fecha_formulacion,$fecha_digitacion,$fecha_inicio,$fecha_termino,$id_entidad_padre,$id_entidad,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$id_digitador,$prorroga,$finalizada,$firmada,$hash,$otra_entidad_origen,$fecha_original,$id_entidad_padre_origen,$id_entidad_hija_origen,$url_documento_origen,$observacion_origen,$id_tipo_solicitud,$entidad,$estado_solicitud,$nombre,$paterno) = mysql_fetch_row($result))
				{
			
					
					
					switch ($id_estado_solicitud ) {
                         case 1:
                             $link = "?accion=asignar-solicitudes&act=1&folio=$folio";
                             break;
                    	 case 3:
                             $link = "?accion=gestion-de-solicitudes&act=1&folio=$folio";
                             break;
                        case 13:
                             $link = "?accion=solicitudes-finalizadas&act=1&folio=$folio";
                             break;
                       	default:
                    	   $def ="ok";
                    	 
                           
                     }
			
			
					$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
					
					$aEstadosRectificacion = split(",",$Estados_pendiente_rectificacion);
					
					if(in_array($id_sub_estado_solicitud,$aEstadosRectificacion)){
					$link = "?accion=rectificar-solicitudes&act=1&folio=$folio";
					
					}
					
					
					
			
							$lista_mis_solicitudes = html_template('linea_lista_mis_solicitudes');	
			
							$fecha_ingreso2 =  date(d)."-".date(m)."-".date(Y);
							//$dias = diferencia_entre_fechas(,fechas_html($fecha_ingreso2));
							$fecha_termino=fechas_html($fecha_termino);
							$fecha_inicio=fechas_html($fecha_inicio); 
							$solicitante = "$nombre $paterno";
			
			                $lista_mis_solicitudes = cms_replace("#FOLIO#","$folio",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#FECHA_CREACION#","$fecha_inicio",$lista_mis_solicitudes);
						    $lista_mis_solicitudes = cms_replace("#FECHA_TERMINO#","$fecha_termino",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#ESTADO#","$estado_solicitud",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#LINK_EDITAR#","$link",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#DIAS#","$solicitante",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#GLOSA_LINK#","$glosa_link",$lista_mis_solicitudes);
						    
			
			$lineas .= $lista_mis_solicitudes;
				}
		
$contenido = "$lineas";
?>