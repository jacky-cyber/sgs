<?php

function ordenar_columnas($tabla){
	
	global $campo_ordena;
	global $campo_ordena_desc;
	global $accion;
	
	
	    $query= "SELECT id_auto_admin 
               FROM  auto_admin 
               WHERE tabla='$tabla'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
         list($id_auto_admin) = mysql_fetch_row($result);
		 
		     $query= "SELECT campo, id_tipo_campo,txt_xml   
                    FROM  auto_admin_campo 
                    WHERE id_auto_admin='$id_auto_admin' and existe_listado=1";
              $result= cms_query($query)or die (error($query,mysql_error(),$php));
               while (list($campo, $id_tipo_campo,$txt_xml) = mysql_fetch_row($result)){
			   
			    $campo_reemplaza =str_replace("id_","",$campo);
				$campo_reemplaza =str_replace("_"," ",$campo_reemplaza);
				if($txt_xml!=""){
				$campo_reemplaza=$txt_xml;
				}
         		if($campo_ordena==$campo){
				$lista_option .= "<option value=\"index.php?accion=$accion&campo_ordena=$campo&campo_ordena_desc=$campo_ordena_desc\" selected>$campo_reemplaza</option>";         						   
				}else{
				$lista_option .= "<option value=\"index.php?accion=$accion&campo_ordena=$campo&campo_ordena_desc=$campo_ordena_desc\">$campo_reemplaza</option>";         						   
				}
				
         		 
				 }
	
	 $campo_ordena_desc = $_SESSION['campo_ordena_desc'];
	 if($campo_ordena_desc==1){
	 $orden= "asc";
	 	$imag_desc = "<a href=\"index.php?accion=$accion&campo_ordena=$campo_ordena&campo_ordena_desc=0\"><img src=\"images/down_over.gif\" alt=\"Descendente\" border=\"0\"></a>";
	 }else{
	 $orden = "desc";
	 
	 	$imag_desc = "<a href=\"index.php?accion=$accion&campo_ordena=$campo_ordena&campo_ordena_desc=1\"><img src=\"images/up_over.gif\" alt=\"Descendente\" border=\"0\"></a>";
	 }
	
	
	
	$select_option = "Ordenar por: <select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">
										<option value=\"#\">---></option>
										$lista_option
                                   </select>$imag_desc";
	
	return $select_option ;
}
	
/**/

function genera_folio($id_entidad,$tipo){

if($tipo=="")$tipo='P';
$id_servicio= configuracion_cms('id_servicio');
$id_entidad = trim($id_entidad);
if($id_entidad==""){
    $query= "SELECT id_entidad   
           FROM  sgs_entidades
           WHERE id_entidad_padre='$id_servicio'";
     $result= mysql_query($query)or die (error($query,mysql_error(),$php));
     list($id_entidad) = mysql_fetch_row($result);

}
	

	
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



/**/

function verifica_folio ($fol,$radioOculto){


//echo "<br>radio :".$radioOculto;
if($fol!=""){
	
	
$contenido= "ok";
		

		if ($radioOculto != "C"){
             	//sacar el id entidad del usuario conectado para validar que no ingrese un folio web de la misma entidad
				global $id_sesion;			
				$id_usuario = id_usuario($id_sesion);
				//echo "<br>".$id_usuario."<br>";
				$sql = "Select concat(a.sigla,b.sigla) sigla
					   from sgs_entidad_padre a,       
							sgs_entidades b ,
							usuario c          
					   where a.id_entidad_padre = b.id_entidad_padre       
							 and c.id_entidad = b.id_entidad           
							 and c.id_usuario = '$id_usuario'; ";
				$res = mysql_query($sql)or die('error en linea 130');
				list($sigla) = mysql_fetch_row($res);
				if ($sigla==""){
					return "<span class=\"textos-rojo\">Usted no est&aacute; asociado a la entidad. <br>Cont&aacute;ctese con su administrador para solucionar el problema.</span> ";
				}else{
					
					$fol = strtoupper(trim($fol));
					$sigla1 = $sigla."W";
					$sigla2 = $sigla."C";
					
					$acomparar = substr($fol,0,6);
					//echo "<br>acomparar:$acomparar    folio:".$fol." <br> sigla:".$sigla;
					/**************************/
					if ($acomparar==$sigla2){
						//echo "entra al mensaje de carta";
						return "<span class=\"textos-rojo\">No est&aacute; permitido ingresar un folio tipo Carta de la misma entidad </span> ";
						exit;
					}
					if ($acomparar==$sigla1){
						return "<span class=\"textos-rojo\">No est&aacute; permitido ingresar un folio tipo Web de la misma entidad </span> ";
						exit;
					}
					//echo "<br>acomparar:$acomparar    folio:".$fol." <br> sigla2:".$sigla2."<BR>";
					
					
						//revisar si el folio existe
					$query= "SELECT folio    
									 FROM  sgs_solicitud_acceso
									 WHERE folio='$fol'";
					$result= cms_query($query)or die (error($query,mysql_error(),$php));
					if (list($foli) = mysql_fetch_row($result)){
								  
						$contenido= "<span class=\"textos-rojo\">Este Folio ya existe <img src=\"images/atencion_pequenia.gif\" alt=\"Folio Existe\" border=\"0\"></span>";
										
								
					//}
					}
					
					/***********************/
					
					
				}
		}
			/*	$fol = strtoupper(trim($fol));
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
				 
				 if($largo< 14 and $largo_num<7 or $folio_invalido==$fol or $num2==0 or $radioOculto!="C" ){
					 if($largo_num<7 ){
						$contenido = "  El folio es demasiado corto<img src=\"images/atencion_pequenia.gif\" alt=\"\" border=\"0\">";
					 }
					 if ($radioOculto=="P"){
						if ($tipo!="P"){
							$contenido = " El folio inv&aacute;lido,  <img src=\"images/atencion_pequenia.gif\" alt=\"\" border=\"0\">";
						}				
					 }
				    
				$id_p=configuracion_cms('id_servicio');
				$query= "SELECT sigla   
                                   FROM  sgs_entidad_padre
                                   WHERE id_entidad_padre=$id_p";
                              $result= cms_query($query)or die (error($query,mysql_error(),$php));
                              list($sigla_sev) = mysql_fetch_row($result);
							  
				if($sigla_padre!=$sigla_sev){
			
					 $contenido = "El folio no pertenece a esta entidad<img src=\"images/atencion_pequenia.gif\" alt=\"\" border=\"0\">";
							  
				}else{
						
						
						$query= "SELECT id_entidad
                                        		FROM  sgs_entidades
                                        		WHERE id_entidad_padre = $id_p and sigla='$sigla_hija'";
                              			$result= cms_query($query)or die (error($query,mysql_error(),$php));
                              			if(!list($sigla_sev) = mysql_fetch_row($result)){
							$contenido = "El folio no pertenece a ningun servicio de la entidad<img src=\"images/atencion_pequenia.gif\" alt=\"Folio Existe\" border=\"0\">";
						}
							  
				}
				  
			     }
			
		}
		
	if($contenido=="ok"){
		$query= "SELECT folio    
                         FROM  sgs_solicitud_acceso
                       	 WHERE folio='$fol'";
                $result= cms_query($query)or die (error($query,mysql_error(),$php));
                if (list($foli) = mysql_fetch_row($result)){
							  
             		$contenido= "Este Folio ya existe <img src=\"images/atencion_pequenia.gif\" alt=\"Folio Existe\" border=\"0\">";
             	}			
			
	}*/

	return $contenido;				
  }

}
/**/

function Calcula_plazo_rectificar($folio){
		
				//sacar tipo de notificacion para calcularlos plazos
				$sql = "select notificacion,direccion,email
						from sgs_solicitud_acceso a,
							usuario b
						where folio = '$folio' and a.id_usuario = b.id_usuario ";
						
				$resultado_estados = cms_query($sql)or die (error($sql,mysql_error(),$php));
				
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
				$sql = "select fecha 
						from sgs_flujo_estados_solicitud 
						where folio = '$folio' 
							  and id_estado_solicitud in ($Estados_pendiente_rectificacion)
						order by id_flujo_estados_solicitud desc ";
					//echo $sql."<br>";	
				$resultado_estados = cms_query($sql)or die (error($sql,mysql_error(),$php));
				
				if(list($fecha_rectificacion) = mysql_fetch_row($resultado_estados) and $fecha_rectificacion>'2008-01-01'){
				
				    $plazo_rectificar = sumaDiasHabiles($fecha_rectificacion,$dias_rectificacion);
				
					//echo "$fecha_rectificacion    $dias_rectificacion <br>";
					$plazo_rectificar = calculaDiasHabiles($plazo_rectificar);
				
				
					if ($plazo_rectificar > 1){
						$plazo_rectificar = $plazo_rectificar."&nbsp;d&iacute;as ";
					}else{
						$plazo_rectificar = $plazo_rectificar."&nbsp;d&iacute;as ";
					}
				}else{
					//echo "--$folio - $plazo_rectificar - $fecha_rectificacion-- <br>";
					$plazo_rectificar="???";
				}
				
				//sumar 5 días hábiles
				
				
				return $plazo_rectificar;
}


function Verifica_plazo_estado($Estados_pendiente_rectificacion,$id_usuario){

	 $query= "SELECT id_solicitud_acceso,folio,id_entidad,id_entidad_padre,id_usuario,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable     
                     FROM  sgs_solicitud_acceso
					 where id_sub_estado_solicitud in ($Estados_pendiente_rectificacion)
					 order by fecha_termino asc
					 $limit";
		
	$result= cms_query($query)or die (error($query,mysql_error(),$php));
	
	//echo "<br>en funcion:<br>". $query."<br>fin funcion<br>";
	
	while (list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable) = mysql_fetch_row($result)){
	
		$dias_rectificar = Calcula_plazo_rectificar($folio);
		if ($dias_rectificar < 1){
			//cambiar de estado en el historial con la fecha de termino de la rectificacion
			$sql = "select notificacion,
							b.fecha
					from sgs_solicitud_acceso a,
						 sgs_flujo_estados_solicitud b 
					where a.folio = '$folio'
						  and a.folio = b.folio
						  and a.id_sub_estado_solicitud = b.id_estado_solicitud
					order by b.id_flujo_estados_solicitud desc  ";
						
			$resultado_estados = cms_query($sql)or die (error($sql,mysql_error(),$php));
			
			list($notificacion,$fecha) = mysql_fetch_row($resultado_estados);
				
			$dias_rectificacion = 5; //en dias habiles
			if ($notificacion == 0){// no desea ser notificado por correo electrónico 5 mas 3 días para notificarlo
				$dias_rectificacion = 8;
			}
			//calcula fecha final para cambiar el estado
			$fecha = sumaDiasHabiles($fecha,$dias_rectificacion);
			//
			$id_estado = 23; //Desistida por no rectificaci&oacute;n
			$observacion = "La solicitud ha sido Desistida por no rectificaci&oacute;n autom&aacute;ticamente por el Sistema";
			Insertar_historial_rectificacion_automatica($folio,$id_estado,$observacion,$fecha);	
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
			
	$resultado = cms_query($sql) or die (error($sql,mysql_error(),$php));
	list($dato_original) = mysql_fetch_row($resultado);
	//fin recuperar dato original
	
	$sql = "UPDATE sgs_solicitud_acceso set 
						fecha_inicio='$fecha',
						fecha_termino='$fecha_termino',
						identificacion_documentos='$identificacion_documentos'  
				where folio = '$folio'";

 cms_query($sql) or die (error($sql,mysql_error(),$php));
	
	//insertar el historial
	$observacion = "La solicitud ha sido rectificada por el solicitante<br>";
	$observacion = $observacion ."Dato previo a la rectificaci&oacute;n:".$dato_original;
	
	$id_estado = 4; //asignada
	Insertar_historial($folio,$id_estado,$observacion);	
	return 1;

}

function Rectificar_solicitud_digitada($folio,$id_usuario,$id_tipo_persona,$nombre,$paterno,$materno,$razon_social,$apoderado,$email,$direccion,$numero,$depto,$ciudad,$id_region,$id_comuna,$firmada,$id_solicitante,$identificacion_documentos){

	//respaldar los datos en la tabla de rectificacion
	$sql = "Select * from sgs_rectificacion_solicitud where folio = '$folio'";
	$result = cms_query($sql) or die("La consulta fall&oacute;:<br>".mysql_error());
	if (mysql_num_rows($result)==0){
		$sql = "INSERT INTO sgs_rectificacion_solicitud ( 
						folio,
						id_tipo_persona,
						nombre,
						paterno ,
				 		materno,
						razon_social,	
						apoderado ,
						email,
						direccion ,
						numero,
						depto,
						ciudad ,
						id_region ,
						id_comuna)
					VALUES(
						'$folio',
						'$id_tipo_persona',
						'$nombre',
						'$paterno' ,
				 		'$materno',
						'$razon_social',	
						'$apoderado'  ,
						'$email',
						'$direccion',
						'$numero',
						'$depto',
						'$ciudad',
						'$id_region',
						'$id_comuna' );";

 cms_query($sql) or die (error($sql,mysql_error(),$php));
	
	}else{
		$sql = "UPDATE sgs_rectificacion_solicitud set 
						id_tipo_persona='$id_tipo_persona',
						nombre='$nombre',
						paterno ='$paterno' ,
				 		materno ='$materno',
						razon_social ='$razon_social',	
						apoderado='$apoderado'  ,
						email = '$email',
						direccion = '$direccion',
						numero = '$numero',
						depto = '$depto',
						ciudad = '$ciudad',
						id_region = '$id_region',
						id_comuna = '$id_comuna'
				where folio = '$folio'";

 cms_query($sql) or die (error($sql,mysql_error(),$php));
	}
	
	
	//actualizar campos de la solicitud
	$fecha = date("Y-m-d");
	$dias = configuracion_cms('dias_de_plazo');
	$fecha_termino = sumaDiasHabiles($fecha,$dias);
	
	$id_estado = 4; //asignada
	
	//recuperar la información original y dejarla como parte de la observacion
	$sql = "Select identificacion_documentos,firmada,id_responsable,id_usuario
			from sgs_solicitud_acceso
			where folio = '$folio'";
			
	//echo "<br>sql dos<br>".$sql."<br>";
			
	$resultado = cms_query($sql) or die (error($sql,mysql_error(),$php));
	list($dato_original,$firmada_ori,$id_responsable,$id_solicitante) = mysql_fetch_row($resultado);
	
	
	//subjet_rectificacion_usuario 
	//cuerpo_cambio_rectificacion_usuario 
	$subjet_rectifica_usuario = html_template('subjet_rectificacion_usuario');
	$cuerpo_cambio_rectificacion_usuario = html_template ('cuerpo_cambio_rectificacion_usuario');
	$subjet_rectifica_usuario =  str_replace("#FOLIO#",$folio,$subjet_rectifica_usuario);
	$cuerpo_cambio_rectificacion_usuario =  str_replace("#FOLIO#",$folio,$cuerpo_cambio_rectificacion_usuario);
	
	    $query= "SELECT email
               FROM  usuario
               WHERE id_usuario='$id_responsable'";
         $result_envia= cms_query($query)or die (error($query,mysql_error(),$php));
          if (list($mail_responsable) = mysql_fetch_row($result_envia)){
    				cms_mail($mail_responsable,$subjet_rectifica_usuario,$cuerpo_cambio_rectificacion_usuario,$headers);
			   
    		 }
	
	
	$tabla ="usuario ";
    $condicion ="where id_usuario = '$id_solicitante'";//WHERE id_reclamo='$id_reclamo'
    $agregar_nombre_campo = "_ori";
    $query = "SELECT * 
    		  FROM $tabla 
    		  $condicion";
    
    $result_q= mysql_query($query)or die ("ERROR $php <br>$query");
    $num_filas = mysql_num_fields($result_q);
    $resultado = mysql_fetch_row($result_q);
    for ($i = 1; $i < $num_filas; $i++){
    
    $nom_campo = mysql_field_name($result_q,$i);
    $nom_campo .=$agregar_nombre_campo;
    $valor = $resultado[$i];
    $$nom_campo = $valor;
    
    }
	
	//fin recuperar datos del solicitante	
	$region_glosa = rescata_valor('regiones',$id_region_ori,'region');	
	
	$comuna_glosa = rescata_valor('comunas',$id_comuna_ori,'comuna');	
	$pais_glosa = rescata_valor('pais',$id_pais_ori,'pais');	
	//recuperar region y comuna
	
	if($firmada_ori==1){
		$firmada_ori_txt="Si";
	}else{
		$firmada_ori_txt="No";
	
	}
	$dato_original= nl2br($dato_original);
	$identificacion_documentos = str_replace("<br />","",$identificacion_documentos);
	$identificacion_documentos= nl2br($identificacion_documentos);
	
	$datos_previos = "<br>Nombre:$nombre_ori &nbsp;&nbsp; $paterno_ori &nbsp;&nbsp; $materno_ori";
	$datos_previos = $datos_previos."<br>Raz&oacute;n social:$razon_social_ori &nbsp;&nbsp;&nbsp;  Apoderado:$apoderado_ori";
	$datos_previos = $datos_previos."<br>Email :$email_ori ";
	$datos_previos = $datos_previos."<br>Direcci&oacute;n :$direccion_ori  &nbsp;&nbsp;&nbsp; N&uacute;mero:$numero_ori &nbsp;&nbsp;&nbsp;  Depto:$depto_ori";
	$datos_previos = $datos_previos."<br>Pa&iacute;s :$pais_glosa";
	$datos_previos = $datos_previos."<br>Region :$region_glosa &nbsp;&nbsp;&nbsp;  Comuna:$comuna_glosa  &nbsp;&nbsp;&nbsp;&nbsp; Ciudad:$ciudad_ori";
	$datos_previos = $datos_previos."<br><br>Datos de la solicitud";
	$datos_previos = $datos_previos."<br>Informaci&oacute;n solicitada:$dato_original";
	$datos_previos = $datos_previos."<br>Firmada:$firmada_ori_txt";

	$notificacion = $_POST['notificacion'];
	$id_formato_entrega= $_POST['id_formato_entrega'];
	$id_forma_recepcion = $_POST['id_forma_recepcion'];
	$oficina = $_POST['oficina'];
	
	$sql = "UPDATE sgs_solicitud_acceso set 
						fecha_inicio='$fecha',
						fecha_termino='$fecha_termino',
						notificacion ='$notificacion',
						id_formato_entrega='$id_formato_entrega',
						id_forma_recepcion='$id_forma_recepcion',
						oficina='$oficina',
						identificacion_documentos='$identificacion_documentos'
			where folio = '$folio'";

 	cms_query($sql) or die (error($sql,mysql_error(),$php));
	
	//echo "<br>sql uno<br>".$sql."<br>";
	//validacion de existencia de datos en la tabla
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
						numero = '$numero',
						depto = '$depto',
						ciudad = '$ciudad',
						id_region = '$id_region',
						id_comuna = '$id_comuna',
						id_pais = '$id_pais'
				where id_usuario = '$id_solicitante'";

 	cms_query($sql) or die (error($sql,mysql_error(),$php));
	
	//echo "<br>sql dos<br>".$sql."<br>";
	$datos_previos = utf8_encode(str_replace("'"," ",$datos_previos));
	
	
	
	$observacion = "La solicitud ha sido rectificada <br>";
	$observacion = $observacion ."<br>Informaci&oacute;n solicitada previa a la rectificaci&oacute;n:<br>";
	$observacion = $observacion .$datos_previos;

	
	Insertar_historial($folio,$id_estado,$observacion);
	return 1;
}	




function Reactivar_solicitud($folio,$id_usuario,$observacion_reactivar){
	$sql = " select id_estado_solicitud from sgs_flujo_estados_solicitud where folio = '$folio'
order by id_flujo_estados_solicitud desc";
	$resultado = cms_query($sql) or die ("La consulta en la funcion Reactivar_solicitud fallo");
	$i=0;
	while (list($id_estado_solicitud) = mysql_fetch_row($resultado)){
		if ($i>=1){
			//if (($id_estado_solicitud!="") and ($id_estado_solicitud < 5) ){
			if ($id_estado_solicitud!=""){
				$id_estado_anterior = $id_estado_solicitud;
				break;
			}
		}
		$i++;
	}
	//echo "<br>id_estado_anterior:".$id_estado_anterior."<br>";
	//insertar historial con el estado capturado
	//echo "<br>estado anterior: ".$id_estado_anterior;
	if ($id_estado_anterior==""){
		$id_estado_anterior = 4;
	}
	$observacion = "La solicitud fue Reactivada por el Sistema";
	$observacion = $observacion."<br>".$observacion_reactivar;
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
					id_estado_solicitud ='$id_etapas' ,
					id_sub_estado_solicitud ='$id_estado',
					folio_origen=' '
			where folio = '$folio'";

 cms_query($sql) or die (error($qry_insert,mysql_error(),$php));
	
	//echo "update solicitud: <br>".$sql;
	
	$qry_insert="INSERT INTO sgs_flujo_estados_solicitud(folio,id_estado_solicitud,fecha,id_usuario,observacion,id_forma_recepcion,vencido,fecha_ingreso_vencido) 
	 			  values ('$folio','$id_estado','$fecha','$id_usuario','$observacion','0','0','0000-00-00')";
				  
      //echo "<br>".$qry_insert;
    $result_insert = cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
	//echo "<br><br>insertar el nuevo historial:<br>".$qry_insert;
	
	alerta_etapa($id_estado,$folio);
	return 1;
}

function Insertar_historial_rectificacion_automatica($folio,$id_estado,$observacion,$fecha){
	global $id_sesion;
	
	//$fecha = date("Y-m-d");
	$id_usuario = id_usuario($id_sesion);
	$id_etapas = Trae_etapa($id_estado);	 
	//update de la solicitud
	$sql = "UPDATE sgs_solicitud_acceso set 
					id_estado_solicitud ='$id_etapas' ,
					id_sub_estado_solicitud ='$id_estado'
			where folio = '$folio'";

 cms_query($sql) or die (error($qry_insert,mysql_error(),$php));
	
	//echo "update solicitud: <br>".$sql;
	
	$qry_insert="INSERT INTO sgs_flujo_estados_solicitud(folio,id_estado_solicitud,fecha,id_usuario,observacion) 
	 			  values ('$folio','$id_estado','$fecha','$id_usuario','$observacion')";
				  
      //echo "<br>".$qry_insert;
    $result_insert = cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
	//echo "<br><br>insertar el nuevo historial:<br>".$qry_insert;
	
	alerta_etapa($id_estado,$folio);
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

function Recupera_ultimo_estado($folio){
	$sql = "select a.id_estado_solicitud ,b.estado_solicitud
			from sgs_flujo_estados_solicitud  a,
				sgs_estado_solicitudes b				
			where folio = '$folio'
				and a.id_estado_solicitud = b.id_estado_solicitud
			order by id_flujo_estados_solicitud desc";
	$resultado = cms_query($sql) or die ("La consulta en la funcion Recupera_ultimo_estado fallo");
	$i=0;
	$estado_anterior = "";
	
	while (list($id_estado_solicitud,$estado_solicitud) = mysql_fetch_row($resultado)){
		if ($i>=1){
			if (($id_estado_solicitud!="") and ($id_estado_solicitud < 5)){
				$estado_anterior = $estado_solicitud;
				break;
			}
			
		}
		$i++;
	}
	
	return $estado_anterior;
}

function Recupera_datos_derivacion($folio){
	
	$detalle = " ";
	$sql = "select folio_origen,
				otra_entidad_origen,
				fecha_original,
				id_entidad_padre_origen,
				id_entidad_hija_origen,
				url_documento_origen,
				observacion_origen
				
			from sgs_solicitud_acceso  			
			where folio = '$folio'
				";
	$resultado = cms_query($sql) or die ("La consulta en la funcion Recupera_ultimo_estado fallo");
	
	list ($folio_origen,$otra_entidad_origen,$fecha_original,$id_entidad_padre_origen,$id_entidad_hija_origen,$url_documento_origen,$observacion_origen) =mysql_fetch_row ($resultado);
	
	if (($otra_entidad_origen!="") and ($id_entidad_padre_origen!="")){
		$detalle= html_template ('contenedor_datos_derivacion');
		$entidad_origen_colocar = "";		
		if ($otra_entidad_origen!=""){
			$detalle = str_replace("#ENTIDAD_ORIGEN#",$otra_entidad_origen, $detalle);
		}elseif ($id_entidad_padre_origen!=""){
			//rescatar el valo de la entidad padre
			$entidad_origen_colocar = html_template('contenedor_detalle_entidad_padre_origen');
			$entidad_padre_nombre = rescata_valor('sgs_entidad_padre',$id_entidad_padre_origen,'entidad_padre') ;
			$entidad_origen_colocar = str_replace("#SERVICIO_ORIGEN#",$entidad_padre_nombre, $entidad_origen_colocar);
			//rescatar el valor de la entidad hija
			$entidad_nombre = rescata_valor('sgs_entidades',$id_entidad_hija_origen,'entidad');
			$detalle = str_replace("#ENTIDAD_ORIGEN#",$entidad_nombre, $detalle);
		}
		$detalle = str_replace("#DETALLE_ENTIDAD_PADRE_ORIGEN#",$entidad_origen_colocar, $detalle);
		$detalle = str_replace("#SERVICIO_ORIGEN#",$entidad_padre_nombre, $detalle);
		
		
		$url_documento_origen =  "<a href=\"$url_documento_origen\">$url_documento_origen</a>";
		$detalle = str_replace("#URL_ORIGEN#",$url_documento_origen, $detalle);
		$detalle = str_replace("#OBSERVACION_ORIGEN#",$observacion_origen, $detalle);
		$detalle = str_replace("#FECHA_ORIGINAL_FORMULARIO#",fechas_html($fecha_original), $detalle);
	}
	return $detalle;


}
function Recupera_datos_derivacion_tabla($folio){
	//echo  "entra a datos derivacion tabla";
	$detalle = "";
	$sql = "select folio_origen,
				otra_entidad_origen,
				fecha_original,
				id_entidad_padre_origen,
				id_entidad_hija_origen,
				url_documento_origen,
				observacion_origen
				
			from sgs_solicitud_acceso  			
			where folio = '$folio'
				";
	//echo "<br>$sql";
	$resultado = cms_query($sql) or die ("La consulta en la funcion Recupera_ultimo_estado fallo");
	
	list ($folio_origen,$otra_entidad_origen,$fecha_original,$id_entidad_padre_origen,$id_entidad_hija_origen,$url_documento_origen,$observacion_origen) =mysql_fetch_row ($resultado);
	
	if (($id_entidad_hija_origen>0) && ($id_entidad_padre_origen >"0")){
		$detalle= html_template ('contenedor_datos_derivacion_tabla');
		$entidad_origen_colocar = "";		
		if ($otra_entidad_origen!=""){
			$detalle = str_replace("#ENTIDAD_ORIGEN#",$otra_entidad_origen, $detalle);
		}elseif ($id_entidad_padre_origen!=""){
			//rescatar el valo de la entidad padre
			$entidad_origen_colocar = html_template('contenedor_detalle_entidad_padre_origen_tabla');
			$entidad_padre_nombre = rescata_valor('sgs_entidad_padre',$id_entidad_padre_origen,'entidad_padre') ;
			$entidad_origen_colocar = str_replace("#SERVICIO_ORIGEN#",$entidad_padre_nombre, $entidad_origen_colocar);
			//rescatar el valor de la entidad hija
			$entidad_nombre = rescata_valor('sgs_entidades',$id_entidad_hija_origen,'entidad');
			$detalle = str_replace("#ENTIDAD_ORIGEN#",$entidad_nombre, $detalle);
		}
		$detalle = str_replace("#DETALLE_ENTIDAD_PADRE_ORIGEN#",$entidad_origen_colocar, $detalle);
		$detalle = str_replace("#SERVICIO_ORIGEN#",$entidad_padre_nombre, $detalle);
		$detalle = str_replace("#FOLIO_ORIGINAL#",$folio_origen, $detalle);
		
		
		$url_documento_origen =  "<a href=\"$url_documento_origen\">$url_documento_origen</a>";
		$detalle = str_replace("#URL_ORIGEN#",$url_documento_origen, $detalle);
		$detalle = str_replace("#OBSERVACION_ORIGEN#",$observacion_origen, $detalle);
		$detalle = str_replace("#FECHA_ORIGINAL_FORMULARIO#",fechas_html($fecha_original), $detalle);
	}else{
		$detalle = "";
	}
	return $detalle;


}

function select_lista_entidades($id_entidad_selecionada){

$id_entidad_padre = configuracion_cms('id_servicio');	

$entidades_configuradas = configuracion_cms ('id_entidad');

	$aCantidades = split(",",$entidades_configuradas);
	$cantidad = count($aCantidades);
	$select_entidades = "";

	if ($cantidad > 0){
		$query= "SELECT id_entidad, entidad     
				   FROM  sgs_entidades 
				   WHERE id_entidad_padre='$id_entidad_padre'
				   AND id_entidad in ($entidades_configuradas)";
			 $result= cms_query($query)or die (error($query,mysql_error(),$php));
			  while (list($id_entidad, $entidad) = mysql_fetch_row($result)){
				if($id_entidad_selecionada==$id_entidad){
					$lista_select .= "<option value=\"$id_entidad\" selected>$entidad</option>\n";
				}else{
					$lista_select .= "<option value=\"$id_entidad\">$entidad</option>\n";
				}
				
								   
			  }
		
				$select_entidades= "<select  class=\"combo\" name=\"id_entidad\" onChange=\"document.form1.submit();\">
										<option value=\"\">Todas</option>
										$lista_select
									</select>";
			$select_entidades = " Entidad:".$select_entidades."&nbsp;&nbsp;";
	}
	
	
	return $select_entidades;
}

function Recupera_fecha_ultimo_estado($folio){
	$sql = "select a.id_estado_solicitud ,b.estado_solicitud,fecha
			from sgs_flujo_estados_solicitud  a,
				sgs_estado_solicitudes b				
			where folio = '$folio'
				and a.id_estado_solicitud = b.id_estado_solicitud
			order by id_flujo_estados_solicitud desc";
	$resultado = cms_query($sql) or die ("La consulta en la funcion Recupera_ultimo_estado fallo");
	$i=0;
	$estado_anterior = "";
	
	list($id_estado_solicitud,$estado_solicitud,$fecha) = mysql_fetch_row($resultado);
	$fecha = fechas_html($fecha);
	
	return $fecha;
}

function alerta_etapa($id_estado,$folio){
	 
	if( configuracion_cms('parar_mail')==1)	{
	$query= "SELECT id_solicitud_acceso,id_entidad   
               FROM  sgs_solicitud_acceso 
               WHERE folio='$folio'";
	
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
         list($id_solicitud_acceso,$id_entidad) = mysql_fetch_row($result);
			 
			//echo $query;
	//$id_entidad = rescata_valor('sgs_solicitud_acceso',$id_solicitud_acceso,'id_entidad');	

	$sql = "Select estado_solicitud ,perfil_alerta, id_mails_alerta_perfil 
			from sgs_estado_solicitudes 
			where id_estado_solicitud = '$id_estado'
			and alerta=1";
		
	$resultado_estado = cms_query($sql)or die ("error en funcion Trae_etapa<br>".$sql);
	if(list($estado_solicitud ,$perfil_alerta,$id_mails_alerta_perfil ) = mysql_fetch_row($resultado_estado)){
	//echo "sdfsdfdsf ";
	$tot_reg = substr_count($perfil_alerta,',');
	//echo "$tot_reg rrr ";
	
	    $query= "SELECT subjet,cuerpo 
               FROM    deuman_mails_alerta_perfil 
               WHERE id_mails_alerta_perfil='$id_mails_alerta_perfil'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($subjet,$cuerpo) = mysql_fetch_row($result);
		  
		
		  
		  
	if($subjet!="" and $cuerpo!=""){
	
	$aux=explode(",", $perfil_alerta);
	$url = $dias = configuracion_cms('url');
	$estado_solicitud= ucwords($estado_solicitud);
	
	$subjet = str_replace("#FOLIO#","$folio",$subjet);
	$cuerpo = str_replace("#FOLIO#","$folio",$cuerpo);
	
	//$url_html = "<a href=\"http://$url\">$url</a>";
	$cuerpo = str_replace("#URL#","$url_html",$cuerpo);
	
	
		   $a=0;
		   
		
		   if($tot_reg==0 ){
		     $id_perf = $aux[$a];
			$funcionario = rescata_valor('usuario_perfil',$id_perf,'funcionario');
		 
				//echo "$id_perf rr $a <$tot_reg<br>";
			     
		  	if($funcionario==1){
				    $query= "SELECT email
						FROM  usuario
						WHERE id_perfil='$id_perf' and id_entidad='$id_entidad' and estado=1 ";
							      //echo $query."<br>";
					  $result2= cms_query($query)or die (error($query,mysql_error(),$php));
					   while (list($email) = mysql_fetch_row($result2)){
							     cms_mail($email,$subjet,$cuerpo,$headers);			   
						      }
			}else{
			
				    $query= "SELECT id_usuario
						FROM  sgs_solicitud_acceso
						WHERE folio='$folio'";
					  $result= cms_query($query)or die (error($query,mysql_error(),$php));
					  if(list($id_u) = mysql_fetch_row($result)){
									 $query= "SELECT email   
											FROM  usuario
											WHERE id_usuario='$id_u'";
										  $result= cms_query($query)or die (error($query,mysql_error(),$php));
										  list($email) = mysql_fetch_row($result);
									             
										     cms_mail($email,$subjet,$cuerpo,$headers);	
							      }
					     
			}
			
						 
						 
		   }else{
				while($a <$tot_reg){
				     
			     
					 $id_perf = $aux[$a];
					     //echo "$id_perf rr $a <$tot_reg<br>";
					 $funcionario = rescata_valor('usuario_perfil',$id_perf,'funcionario');
			      
					     if($funcionario==1){
						     $query= "SELECT email
							     FROM  usuario
							     WHERE id_perfil='$id_perf' and id_entidad='$id_entidad' ";
									  // echo $query."<br>";
							     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
							      while (list($email) = mysql_fetch_row($result2)){
										cms_mail($email,$subjet,$cuerpo,$headers);			   
									 }
					     }else{
									  
									    $query= "SELECT id_usuario
							     FROM  sgs_solicitud_acceso
							     WHERE folio='$folio'";
							     $result= cms_query($query)or die (error($query,mysql_error(),$php));
							     if(list($id_u) = mysql_fetch_row($result)){
											    $query= "SELECT email   
												     FROM  usuario
												     WHERE id_usuario='$id_u'";
											       $result= cms_query($query)or die (error($query,mysql_error(),$php));
											       list($email) = mysql_fetch_row($result);
											   cms_mail($email,$subjet,$cuerpo,$headers);	
									   }
									   
					     }
					       
				     
					 $a++;
				     }
		   }
	}
	
		   
		   
//		   echo 
			
			   
	}
	//return $id_etapa;
	
	}
		
		
}

function verificaPais($id_region,$tabla,$item,$valor){
	$id_pais = 0;
	if (($id_region!="") and ($id_region >0)){
		$sql = "Select id_pais from pais where pais = 'Chile'";
		$result_pais = cms_query($sql)or die (error($sql,mysql_error(),$php));
		list($id_pais)=  mysql_fetch_row($result_pais);
		
		$sql = "UPDATE $tabla set 
			id_pais = '$id_pais'
			where $item = '$valor'";
	
		cms_query($sql) or die("La consulta fall&oacute;:<br>".mysql_error()."<br>$sql");
	}else{
		$id_pais = rescata_valor('usuario',$valor,'id_pais') ;
	}

	return $id_pais;	
	
}


/**/
function Encuentra_estado($id_estado_solicitud,$aEstadosRectificacion){
	
	$glosa_estado_encontrado = "";
	$i=0;
	$cantidad_total = count($aEstadosRectificacion);
	
	while ($i< $cantidad_total){
		if ($id_estado_solicitud==$aEstadosRectificacion[$i]){
			//sacar el nombre del estado 
			$sql = "Select estado_solicitud 
					from sgs_estado_solicitudes 
					where id_estado_solicitud = ".$id_estado_solicitud;
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

/**/

/*	function saca_plazo($folio,$id_sub_estado_solicitud,$fecha_ingreso){
	 	$estados_con_respuesta = configuracion_cms(Estados_etapa_fin).",".configuracion_cms(Estados_etapa_respondida);
		$aEstados = explode(",",$estados_con_respuesta);
		$esFinalizado = 0;
		$prefijo = "Quedan ";
		for($i=0;$i<count($aEstados);$i++){
			if ($aEstados[$i]==$id_sub_estado_solicitud){
				$esFinalizado = 1;
				$prefijo = "Respondida en ";
				break;
			}
		}
		//$prefijo .= "  $esFinalizado ";
		if ($esFinalizado==1){
			
			
			if ($id_sub_estado_solicitud==28){
				$id_sub_estado_solicitud=14;
			}
			if ($id_sub_estado_solicitud==29){
				$id_sub_estado_solicitud=15;
			}
			
			$query= "SELECT fecha  
					 FROM  sgs_flujo_estados_solicitud
					 WHERE folio='$folio' and id_estado_solicitud='$id_sub_estado_solicitud' 
					 order by id_flujo_estados_solicitud desc";
			$result_resp= cms_query($query)or die (error($query,mysql_error(),$php));	
			list($fecha_respuesta) = mysql_fetch_row($result_resp);
		}else{
			$query= "SELECT fecha_termino
					 FROM  sgs_solicitud_acceso
					 WHERE folio='$folio' ";
			$result_resp= cms_query($query)or die (error($query,mysql_error(),$php));	
			list($fecha_respuesta) = mysql_fetch_row($result_resp);
			
			$fecha_ingreso = date("Y-m-d");		 
		}
				// echo $query;
	      
	       if($fecha_respuesta!=""){
	       		//$cont++; 
	       	   $plazo ="";
	 				// $fecha_termino = $fecha_respuesta
				$aux=explode("-", $fecha_ingreso);
				$aux1=explode("-", $fecha_respuesta);
								
				if($aux[0]>=2009 and $aux1[0]>=2007){
					//echo $aux[0] ." ".$aux1[0]." $fecha_ingreso,$fecha_respuesta<br> ";
				 	$plazo = calculaDiasHabilesEntreFechas($fecha_ingreso,$fecha_respuesta);
					$dias = $plazo;
				}else{
					$plazo = "<span style=\"color:#F00\">???</span>";
				}
				
				if (abs($dias)>1){
					$dias = "d&iacute;as";
					
				}else{
					$dias = "d&iacute;a";
					if ($prefijo=="Quedan "){
						$prefijo = "Queda ";
					}
				}
				if ($plazo < 0){
					$plazo = "Atrasada ". abs($plazo)." $dias";
				}else{
					$plazo = $prefijo.$plazo."&nbsp;".$dias;
				}
				
				
				
				
	       	 $fecha_respuesta = fechas_html($fecha_respuesta); 
	       }else{
	       	$random = rand(0,100);
	
	       	$fecha_respuesta="<a href=\"index.php?accion=help&c=problema_fecha&width=320&axj=1\" class=\"jTip\" id=\"$random\" name=\"Problemas con calculo de fecha\">
				<font color=\"#FF0000\">???</font></a>";
				$random = rand(100,300);
	       	$plazo =  "<a href=\"index.php?accion=help&c=problema_fecha&width=320&axj=1\" class=\"jTip\" id=\"$random\" name=\"Problemas con calculo de fecha\">
					<font color=\"#FF0000\">???</font></a>";
				       }
						
						
			return $plazo;			
						
	}*/
function saca_plazo($folio,$id_sub_estado_solicitud,$fecha_ingreso){
		//echo "\nfolio:$folio    estado:$id_sub_estado_solicitud     fecha ingreso:$fecha_ingreso";	
	 	$estados_con_respuesta = configuracion_cms(Estados_etapa_fin).",".configuracion_cms(Estados_etapa_respondida);
		$aEstados = explode(",",$estados_con_respuesta);
		$esFinalizado = 0;
		$prefijo = "Quedan ";
		for($i=0;$i<count($aEstados);$i++){
			if ($aEstados[$i]==$id_sub_estado_solicitud){
				$esFinalizado = 1;
				$prefijo = "Respondida en ";
				break;
			}
		}
		//$prefijo .= "  $esFinalizado ";
		$elMismoDia = 0;
		if ($esFinalizado==1){
			
			
			$query= "SELECT fecha  
					 FROM  sgs_flujo_estados_solicitud
					 WHERE folio='$folio' and id_estado_solicitud='$id_sub_estado_solicitud' 
					 order by id_flujo_estados_solicitud desc";
			//echo "\n $query";
			$result_resp= cms_query($query)or die (error($query,mysql_error(),$php));	
			list($fecha_respuesta) = mysql_fetch_row($result_resp);
			
		}else{
			$query= "SELECT fecha_termino
					 FROM  sgs_solicitud_acceso
					 WHERE folio='$folio' ";
			$result_resp= cms_query($query)or die (error($query,mysql_error(),$php));	
			list($fecha_respuesta) = mysql_fetch_row($result_resp);
			
			$fecha_ingreso = date("Y-m-d");	
			if ($fecha_respuesta==date("Y-m-d")){
				$elMismoDia = 1;
			}
			
		}
				// echo $query;
			//echo "\n fecha respuesta:$fecha_respuesta \n";
	      
	       if($fecha_respuesta!=""){
	       		//$cont++; 
	       	   $plazo ="";
	 				// $fecha_termino = $fecha_respuesta
				$aux=explode("-", $fecha_ingreso);
				$aux1=explode("-", $fecha_respuesta);
				
								
				if($aux[0]>=2009 and $aux1[0]>=2007){
					$plazo = calculaDiasHabilesEntreFechas($fecha_ingreso,$fecha_respuesta);
					
					$dias = $plazo;
				}else{
					$plazo = "<span style=\"color:#F00\">???</span>";
				}
				
				if (abs($dias)>1){
					$dias = "d&iacute;as";
					
				}else{
					$dias = "d&iacute;a";
					if ($prefijo=="Quedan "){
						$prefijo = "Queda ";
					}
				}
				if ($plazo==0){
						$plazo = "Respondida el d&iacute;a h&aacute;bil de ingreso";
						if ($elMismoDia == 1){
						   $plazo = "El plazo vence hoy";
						}
				}else{
					if ($plazo < 0){
						$plazo = "<font color=\"#FF0000\">Atrasada ". abs($plazo)." $dias</font></a>";
					}else{
						$plazo = $prefijo.$plazo."&nbsp;".$dias;
					}
				}
				
				
				
				/*if (abs($plazo)>1){
					$plazo = $plazo."&nbsp;d&iacute;as";
				}else{
					$plazo = $plazo."&nbsp;d&iacute;a";
				}*/
	 		   // echo "$cont; $folio ;$fecha_ingreso;$fecha_respuesta ; $plazo<br>";
				 //$plazo = $plazo. " d&iacute;as";
	       	$fecha_respuesta = fechas_html($fecha_respuesta); 
	       }else{
	       	$random = rand(0,100);
	
	       	$fecha_respuesta="<a href=\"index.php?accion=help&c=problema_fecha&width=320&axj=1\" class=\"jTip\" id=\"$random\" name=\"Problemas con calculo de fecha\">
				<font color=\"#FF0000\">???</font></a>";
				$random = rand(100,300);
	       	$plazo =  "<a href=\"index.php?accion=help&c=problema_fecha&width=320&axj=1\" class=\"jTip\" id=\"$random\" name=\"Problemas con calculo de fecha\">
					<font color=\"#FF0000\">???</font></a>";
				       }
						
			//echo "\n plazo :$plazo \n\n\n";			
			return $plazo;			
						
	}
function saca_plazo_formulario_consulta($folio,$id_sub_estado_solicitud,$fecha_ingreso){
		//echo "\nfolio:$folio    estado:$id_sub_estado_solicitud     fecha ingreso:$fecha_ingreso";	
	 	$estados_con_respuesta = configuracion_cms(Estados_etapa_fin).",".configuracion_cms(Estados_etapa_respondida);
		$aEstados = explode(",",$estados_con_respuesta);
		$esFinalizado = 0;
		$prefijo = "Quedan ";
		for($i=0;$i<count($aEstados);$i++){
			if ($aEstados[$i]==$id_sub_estado_solicitud){
				$esFinalizado = 1;
				$prefijo = "Respondida en ";
				break;
			}
		}
		//$prefijo .= "  $esFinalizado ";
		$elMismoDia = 0;
		if ($esFinalizado==1){
			
			
			$query= "SELECT fecha  
					 FROM  sgs_flujo_estados_solicitud
					 WHERE folio='$folio' and id_estado_solicitud='$id_sub_estado_solicitud' 
					 order by id_flujo_estados_solicitud desc";
			//echo "\n $query";
			$result_resp= cms_query($query)or die (error($query,mysql_error(),$php));	
			list($fecha_respuesta) = mysql_fetch_row($result_resp);
			
		}else{
			$query= "SELECT fecha_termino
					 FROM  sgs_solicitud_acceso
					 WHERE folio='$folio' ";
			$result_resp= cms_query($query)or die (error($query,mysql_error(),$php));	
			list($fecha_respuesta) = mysql_fetch_row($result_resp);
			
			$fecha_ingreso = date("Y-m-d");	
			if ($fecha_respuesta==date("Y-m-d")){
				$elMismoDia = 1;
			}
			
		}
				// echo $query;
			//echo "\n fecha respuesta:$fecha_respuesta \n";
	      
	       if($fecha_respuesta!=""){
	       		//$cont++; 
	       	   $plazo ="";
	 				// $fecha_termino = $fecha_respuesta
				$aux=explode("-", $fecha_ingreso);
				$aux1=explode("-", $fecha_respuesta);
				
								
				if($aux[0]>=2009 and $aux1[0]>=2007){
					$plazo = calculaDiasHabilesEntreFechas($fecha_ingreso,$fecha_respuesta);
					$dias = $plazo;
				}else{
					//$plazo = "<span style=\"color:#F00\">???</span>";
				}
				
				if (abs($dias)>1){
					$dias = "d&iacute;as";
					
				}else{
					$dias = "d&iacute;a";
					if ($prefijo=="Quedan "){
						$prefijo = "Queda ";
					}
				}
				if ($plazo==0){
						$plazo = "Respondida el d&iacute;a h&aacute;bil de ingreso";
						if ($elMismoDia == 1){
						   $plazo = "El plazo vence hoy";
						}
				}else{
					if ($plazo < 0){
						$plazo = "Atrasada ". abs($plazo)." $dias</a>";
					}else{
						$plazo = $prefijo.$plazo."&nbsp;".$dias;
					}
				}
				
				
				
				/*if (abs($plazo)>1){
					$plazo = $plazo."&nbsp;d&iacute;as";
				}else{
					$plazo = $plazo."&nbsp;d&iacute;a";
				}*/
	 		   // echo "$cont; $folio ;$fecha_ingreso;$fecha_respuesta ; $plazo<br>";
				 //$plazo = $plazo. " d&iacute;as";
	       	$fecha_respuesta = fechas_html($fecha_respuesta); 
	       }else{
	       	$random = rand(0,100);
	/*
	       	$fecha_respuesta="<a href=\"index.php?accion=help&c=problema_fecha&width=320&axj=1\" class=\"jTip\" id=\"$random\" name=\"Problemas con calculo de fecha\">
				<font color=\"#FF0000\">???</font></a>";
				$random = rand(100,300);
	       	$plazo =  "<a href=\"index.php?accion=help&c=problema_fecha&width=320&axj=1\" class=\"jTip\" id=\"$random\" name=\"Problemas con calculo de fecha\">
					<font color=\"#FF0000\">???</font></a>";
	*/
				       }
						
			//echo "\n plazo :$plazo \n\n\n";			
			return $plazo;			
						
	}

	function Calcula_plazo_finalizacion_retiro_pago_pendiente(){
		$Estados_etapa_respondida = configuracion_cms('Estados_etapa_respondida');	
		$dias_finalizacion = configuracion_cms('dias_finalizacion_pago_retiro_pendiente');	
		$sql = "SELECT a.folio, a.id_sub_estado_solicitud, fecha,b.id_usuario
				FROM sgs_solicitud_acceso a, sgs_flujo_estados_solicitud b
				WHERE a.id_sub_estado_solicitud
				IN ( $Estados_etapa_respondida ) 
				AND a.folio = b.folio
				AND a.id_sub_estado_solicitud = b.id_estado_solicitud
			";
		//echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>".$sql;
		$resultado_solicitudes = cms_query($sql)or die (error($sql,mysql_error(),$php));
		$i=1;
		while (list($folio,$id_estado,$fecha,$id_usuario) = mysql_fetch_row($resultado_solicitudes)){
			//tomar la fecha y calcular el plazo
			$id_estado = trim($id_estado);
			
			$fecha_comparar = sumaDiasHabiles($fecha,$dias_finalizacion);
			$fecha_actual = date("Ymd");
			$fecha_comparar = str_replace("-","",$fecha_comparar);
			//echo "<br><br>id_estado:$id_estado     folio:".$folio."   fecha:<b>".$fecha."</b>  dias finalizacion:".$dias_finalizacion."<br> fecha actual:$fecha_actual&nbsp;&nbsp;&nbsp;fecha comparar:$fecha_comparar";
			if ($fecha_comparar <= $fecha_actual){
				//insertar el historial con el cambio
				if ($id_estado=="14"){
					$id_estado="28";
				}
				if ($id_estado=="15"){
					$id_estado="29";
				}
				//echo "<br>fecha:".$fecha;
				//echo "   fecha calculada:<b>".$fecha."</b>";
				$observacion = " Esta solicitud se finaliz&oacute; autom&aacute;ticamente por el Sistema ya que pasaron $dias_finalizacion d&iacute;as h&aacute;biles desde que se marc&oacute; como pendiente de retiro o pago. Para m&aacute;s detalles, revisar el art&iacute;culo N&deg; 20 del Reglamento de la Ley de transparencia ";
				$qry_insert="INSERT INTO sgs_flujo_estados_solicitud(folio,id_estado_solicitud,fecha,id_usuario,observacion) 
				  values ('$folio','$id_estado','$fecha_comparar','$id_usuario','$observacion')";
				cms_query($qry_insert)or die (error($qry_insert,mysql_error(),$php));
				//echo "<br>".$qry_insert;
				$id_etapas = "13";
				$sql = "UPDATE sgs_solicitud_acceso set 
						id_sub_estado_solicitud ='$id_estado'
						where folio = '$folio'";
				//echo "<br>$sql";
	
				cms_query($sql) or die (error($qry_insert,mysql_error(),$php));
			}
			//echo "<br>".$qry_insert;

			/*$i++;
			if ($i==10){
				break;
			}*/
		}
		return 1;
	}
	
	
	function Reversa_calcula_plazo_finalizacion_retiro_pago_pendiente(){
		$Estados_etapa_respondida = "28,29";	
		$dias_finalizacion = configuracion_cms('dias_finalizacion_pago_retiro_pendiente');	
		$sql = "SELECT a.folio, a.id_sub_estado_solicitud 
				FROM sgs_solicitud_acceso a 
				WHERE a.id_sub_estado_solicitud
				IN ( $Estados_etapa_respondida ) 
				
			";
		//echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>".$sql;
		$resultado_solicitudes = cms_query($sql)or die (error($sql,mysql_error(),$php));
		$i=1;
		while (list($folio,$id_estado) = mysql_fetch_row($resultado_solicitudes)){
			//tomar la fecha y calcular el plazo
			$id_estado = trim($id_estado);
			//insertar el historial con el cambio
			if ($id_estado=="28"){
				//$id_estado="28";
				$id_estado="14";
			}
			if ($id_estado=="29"){
				//$id_estado="29";
				$id_estado="15";
			}
			
			$qry_insert = "delete from sgs_flujo_estados_solicitud where folio = '$folio' and id_estado_solicitud >= 28";
			cms_query($qry_insert)or die (error($qry_insert,mysql_error(),$php));
			
			$id_etapas = "13";
			$sql = "UPDATE sgs_solicitud_acceso set 
					id_sub_estado_solicitud ='$id_estado'
					where folio = '$folio'";

			cms_query($sql) or die (error($qry_insert,mysql_error(),$php));

		}
		return 1;
	}

function saca_plazo_excel($folio,$id_sub_estado_solicitud,$fecha_ingreso){
	 	$estados_con_respuesta = configuracion_cms(Estados_etapa_fin).",".configuracion_cms(Estados_etapa_respondida);
		$aEstados = explode(",",$estados_con_respuesta);
		$esFinalizado = 0;
		$prefijo = "Quedan ";
		for($i=0;$i<count($aEstados);$i++){
			if ($aEstados[$i]==$id_sub_estado_solicitud){
				$esFinalizado = 1;
				$prefijo = "Respondida en ";
				break;
			}
		}
		
		if ($esFinalizado==1){
			$query= "SELECT fecha  
					 FROM  sgs_flujo_estados_solicitud
					 WHERE folio='$folio' and id_estado_solicitud='$id_sub_estado_solicitud' 
					 order by id_flujo_estados_solicitud desc";
			$result_resp= cms_query($query)or die (error($query,mysql_error(),$php));	
			list($fecha_respuesta) = mysql_fetch_row($result_resp);
		}else{
			$query= "SELECT fecha_termino
					 FROM  sgs_solicitud_acceso
					 WHERE folio='$folio' ";
			$result_resp= cms_query($query)or die (error($query,mysql_error(),$php));	
			list($fecha_respuesta) = mysql_fetch_row($result_resp);
			
			$fecha_ingreso = date("Y-m-d");		 
		}
				// echo $query;
	      
	       if($fecha_respuesta!=""){
	       		//$cont++; 
	       	   $plazo ="";
	 				// $fecha_termino = $fecha_respuesta
				$aux=explode("-", $fecha_ingreso);
				$aux1=explode("-", $fecha_respuesta);
								
				if($aux[0]>=2009 and $aux1[0]>=2007){
					//echo $aux[0] ." ".$aux1[0]." $fecha_ingreso,$fecha_respuesta<br> ";
				 	$plazo = calculaDiasHabilesEntreFechas($fecha_ingreso,$fecha_respuesta);
					$dias = $plazo;
				}else{
					$plazo = "???";
				}
				
				if (abs($dias)>1){
					$dias = "días";
					
				}else{
					$dias = "día";
					if ($prefijo=="Quedan "){
						$prefijo = "Queda ";
					}
				}
				if ($plazo < 0){
					$plazo = "Atrasada ". abs($plazo)." $dias";
				}else{
					$plazo = $prefijo.$plazo." ".$dias;
				}
				
				
				
	       }else{
	       
	
	       	$fecha_respuesta="???";
				
	       	$plazo =  "???";
				       }
						
						
			return $plazo;			
	}
	
function alerta_ingreso_solicitud($id_estado,$folio){

$query= "SELECT id_consulta,id_entidad ,id_canal  
               FROM  chileatiende_consulta 
               WHERE folio_consulta='$folio'";
	
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
         list($id_consulta,$id_entidad,$id_canal) = mysql_fetch_row($result);
			 
			//echo $query;
	//$id_entidad = rescata_valor('sgs_solicitud_acceso',$id_solicitud_acceso,'id_entidad');	

	$sql = "Select estado_solicitud ,perfil_alerta, id_mails_alerta_perfil 
			from sgs_estado_solicitudes 
			where id_estado_solicitud = '$id_estado'
			and alerta=1";
	
	$resultado_estado = cms_query($sql)or die (error($sql,mysql_error(),$php));
	if(list($estado_solicitud ,$perfil_alerta,$id_mails_alerta_perfil ) = mysql_fetch_row($resultado_estado)){
	//echo "sdfsdfdsf ";
	$tot_reg = substr_count($perfil_alerta,',');
	//echo "$tot_reg rrr ";
	
	    $query= "SELECT subjet,cuerpo 
               FROM    deuman_mails_alerta_perfil 
               WHERE id_mails_alerta_perfil='$id_mails_alerta_perfil'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($subjet,$cuerpo) = mysql_fetch_row($result);
		  
		
		  
		  
	if($subjet!="" and $cuerpo!=""){
	
	$aux=explode(",", $perfil_alerta);
	$url = $dias = configuracion_cms('url');
	$estado_solicitud= ucwords($estado_solicitud);
	
	$subjet = str_replace("#FOLIO#","$folio",$subjet);
	$cuerpo = str_replace("#FOLIO#","$folio",$cuerpo);
	
	//$url_html = "<a href=\"http://$url\">$url</a>";
	$cuerpo = str_replace("#URL#","$url_html",$cuerpo);
	
	
		   $a=0;
		   
		     
		   if($tot_reg==0 ){
		     $id_perf = $aux[$a];
			$funcionario = rescata_valor('usuario_perfil',$id_perf,'funcionario');
		 
				//echo "$id_perf rr $a <$tot_reg<br>";
			     
		  	if($funcionario==1){

		  		if($email!=""){
		  			/////RRRRR
		  			$email = str_replace(",",";",$email);
		  			cms_mail($email,$subjet,$cuerpo,$headers);	

		  		}else{
		  			$query= "SELECT email
                           FROM  usuario
                           WHERE id_perfil='$id_perf' and id_entidad='$id_entidad' and id_canales in('$id_canal') and estado=1 ";
					 //echo $query."<br>";
                     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                      while (list($email) = mysql_fetch_row($result2)){
                			cms_mail($email,$subjet,$cuerpo,$headers);			   
                		 }

		  		}
				    
			}else{
			
				

				    $query= "SELECT id_persona
                           FROM  chileatiende_consulta_persona 
                           WHERE id_consulta='$id_consulta'";
                     $result_pers= cms_query($query)or die (error($query,mysql_error(),$php));
                     while(list($id_u) = mysql_fetch_row($result_pers)){
					 	    $query= "SELECT correo_electronico   
                                   FROM  chileatiende_persona
                                   WHERE id_persona='$id_u'";
                             $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                             list($email) = mysql_fetch_row($result2);
							 cms_mail($email,$subjet,$cuerpo,$headers);	
					 }
			
			}
			
						 
						 
		   }else{
		   while($a <$tot_reg){
			
		
			    $id_perf = $aux[$a];
				//echo "$id_perf rr $a <$tot_reg<br>";
			    $funcionario = rescata_valor('usuario_perfil',$id_perf,'funcionario');
		
		 		if($funcionario==1){
				  $query= "SELECT email
                           FROM  usuario
                           WHERE id_perfil='$id_perf' and id_entidad='$id_entidad' and id_canales in('$id_canal')";
				 //echo $query."<br>";
                     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                      while (list($email) = mysql_fetch_row($result2)){
                			cms_mail($email,$subjet,$cuerpo,$headers);			   
                		 }
				}else{
					
					    $query= "SELECT id_persona
                           FROM  chileatiende_consulta_persona 
                           WHERE id_consulta='$id_consulta'";
                     $result_pers= cms_query($query)or die (error($query,mysql_error(),$php));
                     while(list($id_u) = mysql_fetch_row($result_pers)){
					 	    $query= "SELECT correo_electronico   
                                     FROM  chileatiende_persona
                                     WHERE id_persona='$id_u'";
                             $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                             list($email) = mysql_fetch_row($result2);
							 cms_mail($email,$subjet,$cuerpo,$headers);	
					 }
					 
				}
				  
			
			    $a++;
			}
		   }
	}
	
		   
		   
//		   echo 
			
			   
	}
	//return $id_etapa;
	
	if( configuracion_cms('parar_mail')==1){}
		
}


?>