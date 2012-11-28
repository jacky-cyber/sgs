<?php





/*
 * Select tabla estadisticas_acciones
 */


	    $query= "SELECT id_estadistica,id_usuario,datos_post
			FROM  estadisticas_acciones 
			WHERE  fecha >  '2012-06-22' and hora < '2012-06-29 10:00:00'
			AND  url LIKE  '%index.php?accion=ingreso-de-atencion&act=6%'
			and datos_post like '%AL005P-0047433%' and orden = 0";
			  $result_estadisticas_acciones= mysql_query($query)or die ("<br>$query");
	     while (list($id_estadistica,$id_usuario,$datos_post) = mysql_fetch_row($result_estadisticas_acciones)){
		  // echo "$id_usuario,$datos_post<br>";
		  
		   
		         			   
 
		     /*
		    * Select tabla usuario u, chileatiende_sucursal_ips csi
		    * 
		    */
$query= "SELECT csi.sucursal, u.email,u.nombre,u.paterno,u.materno
           FROM  usuario u, chileatiende_sucursal csi
           WHERE u.id_usuario = $id_usuario and u.id_sucursal_ips=csi.id_sucursal_ips";
     $result_usuario= mysql_query($query)or die ("<br>$query");
      list($sucursal_ips,$email,$nombre,$paterno,$materno) = mysql_fetch_row($result_usuario);
      
/** fin select usuario u, chileatiende_sucursal_ips csi***/
		   
		   
                        $aux=explode("<br>", $datos_post);

                       for($i=0;$i<count($aux);$i++){
                            $variable = $aux[$i];

                            $aux2=explode("=", $variable);
                            $variable= trim($aux2[0]);
			    
                            $valor = trim($aux2[1]);
                            
			    $$variable = $valor;
			     //  $cont_fol=0;
			     //  $cont_fol++;
			     //  $cont_fol2++;
				
                              

                        
                         //echo "$variable = $valor<br>";
                       
                        }
			
			
			$qry_insert="INSERT INTO chileatiende_tiket_atencion(id_atencion,nro_atencion,rut,id_sucursal,id_canal,fecha,hora_ini,hora_fin,session_atencion,id_usuario,orden)
				    values (null,'$nro_atencion','$rut','$id_sucursal','$id_canal','$fecha','$hora_ini','$hora_fin','$session_atencion','$id_usuario','$orden')";
			     $contenido .="<br>$qry_insert";
			    $result_insert=mysql_query($qry_insert) or die (mysql_error());
			    $id_atencion= mysql_insert_id();

			    //
					/*
					* Select tabla chileatiende_consulta
					* 
					*/
				       $query= "SELECT id_consulta  
						  FROM  chileatiende_consulta
						  WHERE folio_consulta = '$folio_consulta'";
					$result_chileatiende_consulta= mysql_query($query)or die ("<br>$query");
					    
					    if(list($id_consulta) = mysql_fetch_row($result_chileatiende_consulta)){
						 
						    $query= "SELECT identificador_ingreso   
							    FROM  chileatiende_canales 
							    WHERE id_canal ='$id_canal'";
						      $result= mysql_query($query)or die ("<br>$query");
						      list($identificador_ingreso) = mysql_fetch_row($result);
						 
						$folio_consulta =genera_folio_consulta($id_entidad,$identificador_ingreso);
					    }
						$fecha_ingreso = fechas_bd($fecha_ingreso);
						
					     $qry_insert="INSERT INTO chileatiende_consulta(id_consulta,id_institucion_materia,folio_consulta,id_entidad,id_usuario,id_canal,id_motivo,id_materia,id_origen_llamada,id_sucursal,poder,fecha_ingreso,fecha_termino,fecha_digitacion,consulta,id_llamada,id_tipo_consulta,id_estado,orden,id_submateria,genera_tramite,id_institucion_escalamiento,id_area,id_proceso,id_subproceso,id_forma_recepcion,id_motivo_improcedencia,fecha_ultima_asignacion,notificacion,id_formato_entrega,oficina,reasignacion,id_atencion,hora_ini,hora_fin,id_sucursal_ips,sin_datos_persona,procede_escalamiento,ok)
						     values (null,'$id_institucion_materia','$folio_consulta','$id_entidad','$id_usuario','$id_canal','$id_motivo','$id_materia','$id_origen_llamada','$id_sucursal','$poder','$fecha_ingreso','$fecha_termino','$fecha_digitacion','$consulta','$id_llamada','$id_tipo_consulta','$id_estado','$orden','$id_submateria','$genera_tramite','$id_institucion_escalamiento','$id_area','$id_proceso','$id_subproceso','$id_forma_recepcion','$id_motivo_improcedencia','$fecha_ultima_asignacion','$notificacion','$id_formato_entrega','$oficina','$reasignacion','$id_atencion','$hora_ini','$hora_fin','$id_sucursal_ips','$sin_datos_persona','$procede_escalamiento','$ok')";
							 $contenido .="<br>$qry_insert";
						     $result_insert=mysql_query($qry_insert) or die (mysql_error());
						     $id_consulta= mysql_insert_id();
					/** fin select chileatiende_consulta***/
    			    
				    /*
				    * Select tabla chileatiende_persona
				    * 
				    */
				   $query= "SELECT id_persona  
					      FROM  chileatiende_persona
					      WHERE rut = '$rut_Beneficiario'";
					$result_chileatiende_persona= mysql_query($query)or die ("<br>$query");
					 if(!list($id_persona) = mysql_fetch_row($result_chileatiende_persona)){
							   /** fin select chileatiende_persona***/
    			    
							$qry_insert="INSERT INTO chileatiende_persona(id_persona,nombres,apellidos,fecha_nacimiento,telefono,correo_electronico,id_sexo,rut,direccion,id_pais,id_region,id_comuna,con_poder,orden,id_tipo_apoderado,id_usuario)
								values (null,'$nombres_Beneficiario','$apellidos_Beneficiario','$fecha_nacimiento_Beneficiario','$telefono_Beneficiario','$correo_electronico_Beneficiario','$id_sexo_Beneficiario','$rut_Beneficiario','$direccion_Beneficiario','$id_pais_Beneficiario','$id_region_Beneficiario','$id_comuna_Beneficiario','$poder','$orden_Beneficiario','$id_tipo_apoderado_Beneficiario','$id_usuario')";
							 $contenido .="<br>$qry_insert";
							 $result_insert=mysql_query($qry_insert) or die (mysql_error());
							 $id_persona= mysql_insert_id();	       
						    }
				    
				    
				    $qry_insert="INSERT INTO chileatiende_consulta_persona(id_consulta ,id_tipo_apoderado ,id_persona ,folio_consulta)
						values ('$id_consulta','3','$id_persona','$folio_consulta')";
				     $contenido .="<br>$qry_insert";
				    $result_insert=mysql_query($qry_insert) or die (mysql_error());

				    
				if($rut_Apoderado!=""){
				     $query= "SELECT id_persona  
					      FROM  chileatiende_persona
					      WHERE rut = '$rut_Apoderado'";
					$result_chileatiende_persona= mysql_query($query)or die ("<br>$query");
					 if(!list($id_persona) = mysql_fetch_row($result_chileatiende_persona)){
				
				    
					    $qry_insert="INSERT INTO chileatiende_persona(id_persona,nombres,apellidos,fecha_nacimiento,telefono,correo_electronico,id_sexo,rut,direccion,id_pais,id_region,id_comuna,con_poder,orden,id_tipo_apoderado,id_usuario)
						    values (null,'$nombres_Apoderado','$apellidos_Apoderado','$fecha_nacimiento_Apoderado','$telefono_Apoderado','$correo_electronico_Apoderado','$id_sexo_Apoderado','$rut_Apoderado','$direccion_Apoderado','$id_pais_Apoderado','$id_region_Apoderado','$id_comuna_Apoderado','$poder','$orden_Apoderado','$id_tipo_apoderado_Apoderado','$id_usuario')";
					 $contenido .="<br>$qry_insert";
					    $result_insert=mysql_query($qry_insert) or die (mysql_error());
					    $id_persona = mysql_insert_id();
					 }
					 
				    $qry_insert="INSERT INTO chileatiende_consulta_persona(id_consulta ,id_tipo_apoderado ,id_persona ,folio_consulta)
						values ('$id_consulta','1','$id_persona','$folio_consulta')";
				     $contenido .="<br>$qry_insert";
				    $result_insert=mysql_query($qry_insert) or die (mysql_error());

				}
			    
			    
				if($rut_Tercero!=""){
				     $query= "SELECT id_persona  
					      FROM  chileatiende_persona
					      WHERE rut = '$rut_Tercero'";
					$result_chileatiende_persona= mysql_query($query)or die ("<br>$query");
					 if(!list($id_persona) = mysql_fetch_row($result_chileatiende_persona)){
				
				    
					    $qry_insert="INSERT INTO chileatiende_persona(id_persona,nombres,apellidos,fecha_nacimiento,telefono,correo_electronico,id_sexo,rut,direccion,id_pais,id_region,id_comuna,con_poder,orden,id_tipo_Tercero,id_usuario)
						    values (null,'$nombres_Tercero','$apellidos_Tercero','$fecha_nacimiento_Tercero','$telefono_Tercero','$correo_electronico_Tercero','$id_sexo_Tercero','$rut_Tercero','$direccion_Tercero','$id_pais_Tercero','$id_region_Tercero','$id_comuna_Tercero','$poder','$orden_Tercero','$id_tipo_Tercero_Tercero','$id_usuario')";
					     $contenido .="<br>$qry_insert";
					    $result_insert=mysql_query($qry_insert) or die (mysql_error());
					    $id_persona = mysql_insert_id();
					 }
					 
				    $qry_insert="INSERT INTO chileatiende_consulta_persona(id_consulta ,id_tipo_Tercero ,id_persona ,folio_consulta)
						values ('$id_consulta','1','$id_persona','$folio_consulta')";
				     $contenido .="<br>$qry_insert";
				    $result_insert=mysql_query($qry_insert) or die (mysql_error());

				}
			    
			    $qry_insert="INSERT INTO sgs_flujo_estados_solicitud(folio,id_estado_solicitud,id_estado_respuestas,fecha,id_usuario,observacion,orden,id_flujo_estados_solicitud,id_forma_recepcion,vencido,fecha_ingreso_vencido)
			    values ('$folio_consulta','1',0,'$fecha','$id_usuario','Ingreso de consulta','$orden',null,'$id_forma_recepcion','$vencido','$fecha_ingreso_vencido)";
			    
			    
			    $contenido .="<br>$qry_insert";
			    
			    
			    $result_insert=mysql_query($qry_insert) or die (mysql_error());

			    /*
			      echo utf8_decode("   <tr>
							<td align=\"left\" class=\"textos\">$cont_fol2</td> 
							  <td align=\"left\" class=\"textos\">$valor</td>
							  <td align=\"left\" class=\"textos\">$nombre $paterno $materno ($email)</td>
							  <td align=\"left\" class=\"textos\">$sucursal_ips</td> 
						     </tr> ");
			      */

	$Sql ="UPDATE estadisticas_acciones
 	   SET orden='1'
 	   WHERE id_estadistica ='$id_estadistica'";
 		$contenido .="<br>$Sql<br>";		  
 	  mysql_query($Sql)or die ("ERROR $php <br>$Sql");
		 }
		 $total_folios = count($folios);
		// echo "</table>Total Folio $cont_fol<br>Total de folios $total_folios";  





/*		
$datos_post ="estado_consulta =1<br> 
institucion_final =20<br> 
id_canal =7<br> 
fecha_ingreso =25-06-2012<br> 
id_origen_llamada =5<br> 
id_sucursal =33<br> 
id_tipo_consulta =6<br> 
id_institucion =20<br> 
id_materia =65<br> 
id_submateria =126<br> 
consulta_beneficiario =1<br> 
sin_datos_persona =0<br> 
rut_Beneficiario =116449633<br> 
nombres_Beneficiario =hector enrique<br> 
id_tipo_apoderado_Beneficiario =3<br> 
apellidos_Beneficiario =gallardo cortez<br> 
correo_electronico_Beneficiario =<br> 
fecha_nacimiento_Beneficiario =23-07-1970<br> 
id_sexo_Beneficiario =1<br> 
telefono_Beneficiario =91811065<br> 
direccion_Beneficiario =villa santa teresa, sitio 3, chacabuco<br> 
id_pais_Beneficiario =51<br> 
id_region_Beneficiario =13<br> 
id_comuna_Beneficiario =283<br> 
rut_Apoderado =<br> 
nombres_Apoderado =<br> 
id_tipo_apoderado_Apoderado =1<br> 
apellidos_Apoderado =<br> 
correo_electronico_Apoderado =<br> 
fecha_nacimiento_Apoderado =<br> 
id_sexo_Apoderado =1<br> 
telefono_Apoderado =<br> 
direccion_Apoderado =<br> 
id_pais_Apoderado =51<br> 
id_region_Apoderado =<br> 
poder_Apoderado =1<br> 
rut_Tercero =<br> 
nombres_Tercero =<br> 
id_tipo_apoderado_Tercero =2<br> 
apellidos_Tercero =<br> 
correo_electronico_Tercero =<br> 
fecha_nacimiento_Tercero =<br> 
id_sexo_Tercero =1<br> 
telefono_Tercero =<br> 
direccion_Tercero =<br> 
id_pais_Tercero =51<br> 
id_region_Tercero =<br> 
select_tipo_archivo0 =1<br> 
obs_archivo_temporal0 =<br> 
listado_length =10<br> 
act =<br> 
id_motivo =6<br> 
poder =1<br> 
finaliza =1<br> 
hora_ini =09:19:04<br> 
hora_fin =09:22:39<br> 
id_atencion =78117<br> 
id_entidad =173<br> 
id_usuario =150<br> 
pertinente =<br> 
fecha =2012-06-25<br> 
hora =09:22:39<br> 
folio_consulta =AL005P-0047433<br> 
orden =52865<br> 
id_entidad_padre =<br> 
id_persona =57966<br> 
consulta =<br> 
id_sucursal_ips =29<br> 
id_estado =1<br> 
id_institucion_materia =20<br> 
fecha_digitacion =2012-06-25<br> 
fecha_termino =2012-07-03<br> 
fecha_ultima_asignacion =2012-06-25<br> 
id_llamada =0<br> 
genera_tramite =0<br> 
id_institucion_escalamiento =0<br> 
id_area =0<br> 
id_proceso =0<br> 
id_subproceso =0<br> 
id_forma_recepcion =0<br> 
id_motivo_improcedencia =0<br> 
notificacion =0<br> 
id_formato_entrega =0<br> 
reasignacion =0<br> 
procede_escalamiento =0<br> 
ok =0<br> 
nombres =hector enrique<br> 
apellidos =gallardo cortez<br> 
fecha_nacimiento =1970-07-23<br> 
telefono =91811065<br> 
correo_electronico =<br> 
id_sexo =1<br> 
rut =116449633<br> 
direccion =villa santa teresa, sitio 3, chacabuco<br> 
id_pais =51<br> 
id_region =13<br> 
id_comuna =283<br> 
con_poder =<br> 
id_tipo_apoderado =3<br> 
remitente =sach_chileatiende@ips.gob.cl<br> 
destinatario =experto@servicio.gov.cl;experto2@servicio.gov.cl;experto3@servicio.gov.cl;experto4@servicio.gov.cl<br> 
asunto =Existe una nueva solicitud folio AL005P-0047433<br> 
cuerpo =<p>Estimada/o,</p>
<p>Se ha generado una nueva solicitud en el Sistema de Atenci&oacute;n Ciudadana, ingrese a la plataforma para gestionar la consulta.</p>
<p><a href=\"http:///index.php?accion=asignar-solicitudes&amp;act=1&amp;folio=AL005P-0047433\">Ir a la Solicitud</a></p>
<p><a href=\"http:///index.php\">Sistema de Atenci&oacute;n Ciudadana<br />
</a></p><br> 
id_destinatario =<br> 
error_envio =<br> 
enviado =0<br> 
tiempo_ejecucion_correo =<br> 
id_consulta =76945<br>";
		
		
		



 $aux=explode("<br>", $datos_post);
                        for($i=0;$i<count($aux);$i++){
                            $variable = $aux[$i];
                            
			    $aux2=explode("=", $variable);
			    $variable= $aux2[0];
			    $valor = $aux2[1];
                         
			    
			}
*/
?>