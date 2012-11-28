<?php

	
function genera_folio($id_entidad,$tipo){


	
//	 echo $max_folio."<br>";
	 $id_servicio= configuracion_cms('id_servicio');
	 $sigla_sevicio = rescata_valor('sgs_entidad_padre',$id_servicio,'sigla') ;
	 $sigla_entidad = rescata_valor('sgs_entidades',$id_entidad,'sigla') ;
	 $cond = $sigla_sevicio.$sigla_entidad .$tipo;
	  $query= "SELECT max(folio) 
			FROM sgs_solicitud_acceso 
			WHERE 1 and folio like '$cond-%'";
    // echo $query."<br>";
	 $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($max_folio) = mysql_fetch_row($result); 
	 
	// echo "$sigla_sevicio d--d $max_folio <br>";
	 $sigla_sevicio = $sigla_sevicio.$sigla_entidad.$tipo;
	// $folio_sin_sigla = str_replace("","",$max_folio);
	      $aux=explode("-", $max_folio);

      $siglas    = ucwords(strtolower(trim($aux[0])));
	  $numero    = ucwords(strtolower(trim($aux[1])));
	

	 $folio_new = $numero+1;
	// echo $folio_new." $folio_sin_sigla+1 <br>";
	 
	 $folio_new = str_pad("$folio_new",7,"0",STR_PAD_LEFT);
	 $folio_new = "$sigla_sevicio"."-$folio_new";
	//echo $folio_new;
	 return $folio_new;


}
function verifica_folio ($fol,$radioOculto){
				//echo "entra a verificar folio";
				
				//se debe validar que no se ingrese un formulario W de la misma entidad cuando se elija Formulario
				
             	//sacar la entidad del usuario conectado
				
				$fol = strtoupper(trim($fol));
				$largo = strlen($fol);
				$aux=explode("-", $fol);
				$sigla = $aux[0];
				$num = $aux[1];
				
				$num2= number_format($num);
				$largo_num = strlen($num);
				
				$sigla_padre = trim(substr($sigla, 0, 2));
				$sigla_hija = trim(substr($sigla, 2, 3));
				$tipo = trim(substr($sigla, 5, 1));
				
				$folio_invalido = $sigla."-0000000";
				
			 if($fol!="" ){
				 
				 if($largo< 14 and $largo_num<7 or $folio_invalido==$fol or $num2==0 or radioOculto!="F"){
					 if($largo_num<7 ){
						$contenido = "radioOculto1 :".$radioOculto."  El folio es demasiado corto<img src=\"images/atencion_pequenia.gif\" alt=\"Folio Existe\" border=\"0\">";
					 }
					 if ($radioOculto=="P"){
						if ($tipo!="P"){
							$contenido = " radioOculto2 :".$radioOculto."  El folio inválido <img src=\"images/atencion_pequenia.gif\" alt=\"Folio Existe\" border=\"0\">";
						}				
					 }
				  		  
				}else{
				 
				 
				    
						$id_p=configuracion_cms('id_servicio');
						      $query= "SELECT sigla   
                                   FROM  sgs_entidad_padre
                                   WHERE id_entidad_padre=$id_p";
                              $result= cms_query($query)or die (error($query,mysql_error(),$php));
                              list($sigla_sev) = mysql_fetch_row($result);
							  
							  if($sigla_padre!=$sigla_sev){
							  
							  
							    $contenido = "El folio no pertenece a esta entidad<img src=\"images/atencion_pequenia.gif\" alt=\"Folio Existe\" border=\"0\">";
							  
							  
							  }else{
							   			$query= "SELECT id_entidad
                                        		FROM  sgs_entidades
                                        		WHERE id_entidad_padre = $id_p and sigla='$sigla_hija'";
                              			$result= cms_query($query)or die (error($query,mysql_error(),$php));
                              			if(!list($sigla_sev) = mysql_fetch_row($result)){
							    				$contenido = "El folio no pertenece a ningun servicio de la entidad<img src=\"images/atencion_pequenia.gif\" alt=\"Folio Existe\" border=\"0\">";
							  			}else{
							  
							     		$query= "SELECT folio    
                        						FROM  sgs_solicitud_acceso
                       					 		WHERE folio='$fol'";
                  						$result= cms_query($query)or die (error($query,mysql_error(),$php));
                  									if (list($id_usuario,$nombre) = mysql_fetch_row($result)){
							  
             											$contenido= " radioOculto3 :".$radioOculto."  Este Folio ya existe <img src=\"images/atencion_pequenia.gif\" alt=\"Folio Existe\" border=\"0\">";
             		 								}else{
						    							$contenido= "ok";
								 					}
							  			}
							 
							  
							  
							  }
							  
							 
				  
					   }
					 
					}  
					return $contenido;
					
}

function Encuentra_estado($id_estado_solicitud,$aEstadosRectificacion){
	$glosa_estado_encontrado = "";
	$i=0;
	$cantidad_total = count($aEstadosRectificacion);
	
	while ($i< $cantidad_total){
		if ($id_estado_solicitud==$aEstadosRectificacion[$i]){
			//sacar el nombre del estado 
			$sql = "Select estado_solicitud from sgs_estado_solicitudes where id_estado_solicitud = ".$id_estado_solicitud;
			$result = cms_query($sql)or die("<br>La consulta fallo en la función Encuentra_estado:".mysql_error());
			list($glosa_estado_encontrado) = mysql_fetch_row($result);
			
			if ($glosa_estado_encontrado!=""){
				$glosa_estado_encontrado = ":&nbsp;".$glosa_estado_encontrado;
			}
		}
		$i = $i + 1;
	}
	
	return $glosa_estado_encontrado;
}

function Calcula_plazo_rectificar($folio){
		
				//sacar tipo de notificacion para calcularlos plazos
				$sql = "select notificacion,direccion,email 
						from sgs_solicitud_acceso 
						where folio = '$folio' ";
						
				$resultado_estados = cms_query($sql)
								or die("La consulta falló".mysql_error());
				list($notificacion,$direccion,$email) = mysql_fetch_row($resultado_estados);
				
				$dias_rectificacion = 5; //en dias habiles
				if ($direccion!="" and  $email!=""){
					if ($notificacion == 0){// no desea ser notificado por correo electrónico 5 mas 3 días para notificarlo
						$dias_rectificacion = 8;
					}
				}
				//FIN sacar tipo de notificacion para calcularlos plazos
				
				$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
				//sacar la fecha del ultimo cambio de estado de rectificacion
				$sql = "select fecha from sgs_flujo_estados_solicitud 
						where folio = '$folio' 
							  and id_estado_solicitud in ($Estados_pendiente_rectificacion)
						order by id_flujo_estados_solicitud desc ";
				$resultado_estados = cms_query($sql)
								or die("La consulta falló".mysql_error());
				list($fecha_rectificacion) = mysql_fetch_row($resultado_estados);
				
				//sumar 5 días hábiles
				$plazo_rectificar = sumaDiasHabiles($fecha_rectificacion,$dias_rectificacion);
				
				$plazo_rectificar = calculaDiasHabiles($plazo_rectificar);
				
				
				if ($plazo_rectificar > 1){
					$plazo_rectificar = $plazo_rectificar."&nbsp;d&iacute;as ";
				}else{
					$plazo_rectificar = $plazo_rectificar."&nbsp;d&iacute;a ";
				}
				
				return $plazo_rectificar;
}
function Verifica_plazo_estado($Estados_pendiente_rectificacion,$id_usuario){

	 $query= "SELECT id_solicitud_acceso,folio,id_entidad,id_entidad_padre,id_usuario,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable     
                     FROM  sgs_solicitud_acceso
					 where id_sub_estado_solicitud in ($Estados_pendiente_rectificacion)
					 order by fecha_termino asc
					 $limit";
		
	$result= cms_query($query)or die ("la consulta falló<br>".mysql_error());
	
	//echo "<br>en funcion:<br>". $query."<br>fin funcion<br>";
	
	while (list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable) = mysql_fetch_row($result)){
	
		$dias_rectificar = Calcula_plazo_rectificar($folio);
		if ($dias_rectificar < 1){
			//cambiar de estado en el historial
			$id_estado = 23; //Desistida por no rectificaci&oacute;n
			
			
			$observacion = "La solicitud ha sido Desistida por no rectificaci&oacute;n ";
			Insertar_historial($folio,$id_estado,$observacion);	
		}
		
	}
	return 1;

}

function Rectificar_solicitud_web($folio,$identificacion_documentos){
		//actualizar los datos de la solicitud y dejarla como ingresada y en la observacion del historial dejar constancia
	
	//actualizar campos de la solicitud
	$fecha = date("Y-m-d");
	$dias = configuracion_cms('dias_de_plazo');
	$fecha_termino = sumaDiasHabiles($fecha,$dias);
	$identificacion_documentos = acentos($identificacion_documentos);
	
	//recuperar la información original y dejarla como parte de la observacion
	$sql = "Select identificacion_documentos 
			from sgs_solicitud_acceso
			where folio = '$folio'";
			
	$resultado = cms_query($sql) or die ("La consulta falló:<br>".mysql_error());
	list($dato_original) = mysql_fetch_row($resultado);
	//fin recuperar dato original
	
	$sql = "UPDATE sgs_solicitud_acceso set 
						fecha_inicio='$fecha',
						fecha_termino='$fecha_termino',
						identificacion_documentos='$identificacion_documentos'  
				where folio = '$folio'";

 cms_query($sql) or die("La consulta fall&oacute;:<br>".mysql_error());
	
	//insertar el historial
	$observacion = "La solicitud ha sido rectificada por el solicitante<br>";
	$observacion = $observacion ."Dato previo a la rectificaci&oacute;n:".$dato_original;
	
	$id_estado = 4; //asignada
	Insertar_historial($folio,$id_estado,$observacion);	
	return 1;

}

function Rectificar_solicitud_digitada($folio,$id_usuario,$id_tipo_persona,$nombre,$paterno,$materno,$razon_social,$apoderado,$email,$direccion,$numero,$depto,$ciudad,$id_region,$id_comuna,$firmada,$id_solicitante,$identificacion_documentos,$id_pais){

	//actualizar campos de la solicitud
	$fecha = date("Y-m-d");
	$dias = configuracion_cms('dias_de_plazo');
	$fecha_termino = sumaDiasHabiles($fecha,$dias);
	
	$id_estado = 4; //asignada
	
	//recuperar la información original y dejarla como parte de la observacion
	$sql = "Select identificacion_documentos,firmada
			from sgs_solicitud_acceso
			where folio = '$folio'";
			
	$resultado = cms_query($sql) or die ("La consulta falló:<br>".mysql_error());
	list($dato_original,$firmada_ori) = mysql_fetch_row($resultado);
	//fin recuperar dato original
	//recuperar datos del solicitante
	$sql = "Select	id_tipo_persona,
					nombre,
					paterno,
					materno,
					razon_social,	
					apoderado,
					email,
					direccion,
					email,
					numero,
					depto,
					ciudad,
					id_region,
					id_comuna,
					id_pais
			from usuario 
			where id_usuario = '$id_solicitante'";	
			
	$resultado = cms_query($sql) or die ("La consulta falló:<br>".mysql_error());
	list($id_tipo_persona_ori,$nombre_ori,$paterno_ori,$materno_ori,$razon_social_ori,$apoderado_ori,$email_ori,$direccion_ori,$numero_ori,$depto_ori,$ciudad_ori,$id_region_ori,$id_comuna_ori,$id_pais_ori) = mysql_fetch_row($resultado);
	
	//fin recuperar datos del solicitante	
	$region_glosa = rescata_valor('regiones',$id_region_ori,'region');	
	$comuna_glosa = rescata_valor('comunas',$id_comuna_ori,'comuna');	
	$pais_glosa = rescata_valor('pais',$id_pais_ori,'pais');	
	//recuperar region y comuna
	
	
	$datos_previos = "<br>Nombre:$nombre_ori &nbsp;&nbsp; $paterno_ori &nbsp;&nbsp; $materno_ori";
	$datos_previos = $datos_previos."<br>Raz&oacute;n social:$razon_social_ori &nbsp;&nbsp;&nbsp;  Apoderado:$apoderado_ori";
	$datos_previos = $datos_previos."<br>Email :$email_ori ";
	$datos_previos = $datos_previos."<br>Direcci&oacute;n :$direccion_ori  &nbsp;&nbsp;&nbsp; N&uacute;mero:$numero_ori &nbsp;&nbsp;&nbsp;  Depto:$depto_ori";
	$datos_previos = $datos_previos."<br>Pa&iacute;s :$pais_glosa";
	$datos_previos = $datos_previos."<br>Region :$region_glosa &nbsp;&nbsp;&nbsp;  Comuna:$comuna_glosa  &nbsp;&nbsp;&nbsp;&nbsp; Ciudad:$ciudad_ori";
	$datos_previos = $datos_previos."<br><br>Datos de la solicitud";
	$datos_previos = $datos_previos."<br>Informaci&oacute;n solicitada:$dato_original";
	$datos_previos = $datos_previos."<br>Firmada:$firmada_ori";

	
	$sql = "UPDATE sgs_solicitud_acceso set 
						fecha_inicio='$fecha',
						fecha_termino='$fecha_termino',
						identificacion_documentos='$identificacion_documentos',
						firmada = '$firmada'
				where folio = '$folio'";

 cms_query($sql) or die("La consulta fall&oacute;:<br>".mysql_error());
	
	//echo "<br>sql uno<br>".$sql."<br>";
	if (($id_pais!="") and ($id_pais >0)){
			$sql = "Select pais from pais where id_pais = $id_pais";
			$result_pais = cms_query($sql)or die (error($sql,mysql_error(),$php));
			list($pais)=  mysql_fetch_row($result_pais);
			if ($pais != "Chile"){
				$id_region = 0;
				$id_comuna = 0;
			}
			
	}
	
	$sql = "UPDATE usuario set 
						id_tipo_persona='$id_tipo_persona',
						nombre='$nombre',
						paterno ='$paterno' ,
				 		materno ='$materno',
						razon_social ='$razon_social',	
						apoderado='$apoderado'  ,
						email = '$email',
						direccion = '$direccion',
						email = '$email',
						numero = '$numero',
						depto = '$depto',
						ciudad = '$ciudad',
						id_region = '$id_region',
						id_comuna = '$id_comuna',
						id_pais = '$id_pais'
				where id_usuario = '$id_solicitante'";

 cms_query($sql) or die("La consulta fall&oacute;:<br>".mysql_error());
	
	//echo "<br>sql dos<br>".$sql."<br>";
	
	$observacion = "La solicitud ha sido rectificada por el usuario interno<br>";
	$observacion = $observacion ."<br>Informaci&oacute;n solicitada previa a la rectificaci&oacute;n:<br>";
	$observacion = $observacion .$datos_previos;

	
	Insertar_historial($folio,$id_estado,$observacion);
	return 1;
}	

function Reactivar_solicitud($folio,$id_usuario){
	$sql = " select id_estado_solicitud from sgs_flujo_estados_solicitud where folio = '$folio'
order by id_flujo_estados_solicitud desc";
	$resultado = cms_query($sql) or die ("La consulta en la funcion Reactivar_solicitud fallo");
	$i=0;
	while (list($id_estado_solicitud) = mysql_fetch_row($resultado)){
		if ($i>=1){
			if ($id_estado_solicitud!=""){
				$id_estado_anterior = $id_estado_solicitud;
				break;
			}
			
		}
		$i++;
	}
	//echo "<br>id_estado_anterior:".$id_estado_anterior."<br>";
	//insertar historial con el estado capturado
	if ($id_estado_anterior==""){
		$id_estado_anterior = 4;
	}
	$observacion = "La solicitud fue Reactivada por Sistema";
	Insertar_historial($folio,$id_estado_anterior,$observacion);
	
	return 1;
	
}

function Insertar_historial($folio,$id_estado,$observacion){
	global $id_sesion;
	
	$fecha = date("Y-m-d");
	$id_usuario = id_usuario($id_sesion);
	$id_etapas = Trae_etapa($id_estado);	 
	//update de la solicitud
	$sql = "UPDATE sgs_solicitud_acceso set 
					id_estado_solicitud =$id_etapas ,
					id_sub_estado_solicitud =$id_estado
			where folio = '$folio'";

 cms_query($sql) or die("La consulta fall&oacute;:<br>".mysql_error());

	
	$qry_insert="INSERT INTO sgs_flujo_estados_solicitud(folio,id_estado_solicitud,fecha,id_usuario,observacion) 
	 			  values ('$folio','$id_estado','$fecha','$id_usuario','$observacion')";
				  
                  
    $result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
	return 1;
}

function Trae_etapa($id_estado){
	$sql = "Select id_estado_padre from sgs_estado_solicitudes where id_estado_solicitud = $id_estado";
	$resultado_estado = cms_query($sql)or die ("error en funcion Trae_etapa<br>".$sql);
	list($id_etapa) = mysql_fetch_row($resultado_estado);
	return $id_etapa;
}

function Coloca_registro_vacio($colspan,$mnesaje){
	
	$fila = "<tr>
			<td colspan=\"$colspan\">&nbsp;$mnesaje</td>
		</tr>";
	return $fila;
	
}
?>