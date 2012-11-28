<?php

	     $query= "SELECT id_solicitud_acceso
                    FROM  sgs_solicitud_acceso
                    WHERE folio='$folio'";
              $result= mysql_query($query)or die (error($query,mysql_error(),$php));
               if(!list($id_solicitud_acceso) = mysql_fetch_row($result)){
         				
						
                        $qry_insert="INSERT INTO sgs_solicitud_acceso(folio,fecha_formulacion,fecha_digitacion,fecha_inicio,fecha_termino,id_entidad_padre,id_entidad,id_usuario,identificacion_documentos,id_forma_recepcion,oficina,id_formato_entrega,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,id_digitador,prorroga,finalizada,firmada,hash,otra_entidad_origen,fecha_original,id_entidad_padre_origen,id_entidad_hija_origen,url_documento_origen,observacion_origen,id_tipo_solicitud,archivada) 
									 values ('$folio','$fecha_formulacion','$fecha_digitacion','$fecha_inicio','$fecha_termino','$id_entidad_padre','$id_entidad','$id_usuario','$identificacion_documentos','$id_forma_recepcion','$oficina','$id_formato_entrega','$orden','$id_estado_solicitud','$id_sub_estado_solicitud','$id_responsable','$id_digitador','$prorroga','$finalizada','$firmada','$hash','$otra_entidad_origen','$fecha_original','$id_entidad_padre_origen','$id_entidad_hija_origen','$url_documento_origen','$observacion_origen','$id_tipo_solicitud','$archivada')";
                        $result_insert=mysql_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar qry_insert");
						
						$qry_insert="INSERT INTO sgs_solicitud_acceso(folio,id_estado_solicitud,id_estado_respuestas,fecha,id_usuario,observacion) 
									 values ('$folio','$id_estado_solicitud','$id_estado_respuestas','$fecha','$id_usuario','$observacion')";
                        $result_insert=mysql_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar qry_insert");
						
						
						
								   
         		 }
		 

?>