<?php

$buscar = trim($_POST['buscar']);
$apellido = trim($_POST['apellido']);
/*if ($buscar !=""){	
}else{

		$contenidorr =  "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                           <tr >
                             <td align=\"center\" >Solicitud no encontrada</td>
                             </tr>
                       	</table>";	
}


*/
		
	//verificar el capcha	
	include("captcha/verificar.php");


	
  $apellido = utf8_decode($apellido);
	
	if($captcha_ok == true and $buscar!="" and $apellido!=""){
		
	
	 $query= "SELECT id_solicitud_acceso,
					folio,
					a.id_entidad,
					a.id_entidad_padre,
					d.entidad_padre,
					a.id_usuario,
					identificacion_documentos,
					notificacion,
					id_forma_recepcion,
					oficina,
					id_formato_entrega,
					a.fecha_inicio,
					fecha_termino,
					a.orden,
					a.id_estado_solicitud,
					b.estado_para_usuario,
					id_sub_estado_solicitud,
					id_responsable,
                    ifnull(c.estado_para_usuario,'') estado_padre,
                    CONCAT(f.nombre,' ', f.paterno,' ', f.materno) solicitante,
					entidad,
					a.prorroga
			FROM  sgs_solicitud_acceso a, 
					sgs_estado_solicitudes b, 
					sgs_estado_solicitudes c,
					sgs_entidad_padre d,
					usuario f, 
					sgs_entidades g
			WHERE a.id_sub_estado_solicitud = b.id_estado_solicitud   
				  and (folio = '$buscar' or folio_origen like '%$buscar%') 
				  and f.paterno = '$apellido'
				  and c.id_estado_solicitud = b.id_estado_padre
				  and a.id_entidad_padre = d.id_entidad_padre
				  and a.id_usuario = f.id_usuario
				  and a.id_entidad = g.id_entidad
			ORDER BY fecha_inicio asc";
					
		   $result= cms_query($query)or die (error($query,mysql_error(),$php));
		
		list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_inicio,$fecha_termino,$orden,$id_estado_solicitud,$estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$estado_padre,$solicitante,$entidad,$prorroga) = mysql_fetch_row($result);
		   if ($id_solicitud_acceso!=""){
				
				
				 $fecha_termino = fechas_html($fecha_termino);
				 $fecha_inicio2 =  date(d)."-".date(m)."-".date(Y);
				 $dias = diferencia_entre_fechas($fecha_termino,$fecha_inicio2);
				 $plazo = saca_plazo_formulario_consulta($folio,$id_sub_estado_solicitud,$fecha_inicio);
		
		
				// $plazo = $dias ." d&iacute;as";
				 
				 $sub_estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_para_usuario'); 
				 $comentario_para_usuario= rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'comentario_para_usuario'); 
				 
				 
				 $fecha_inicio = fechas_html($fecha_inicio);
				
				 $contenido = html_template('contenedor_respuesta_consulta_solicitudes');
				 //Plazo para entregar respuesta
				 
				 if($id_estado_solicitud==13){
				 	$texto_plazo= "Plazo en que se finaliz&oacute; la solicitud";
				 }else{
				 	$texto_plazo= "Plazo para entregar respuesta";
				 }		
				 $contenido = cms_replace("#TEXTO_PLAZO#",$texto_plazo,$contenido);
				 $contenido = cms_replace("#ID_SOLICITUD#",$folio,$contenido);
				 $contenido = cms_replace("#FECHA_INGRESO#",$fecha_inicio,$contenido);
				 $contenido = cms_replace("#SERVICIO#",$entidad_padre,$contenido);
				 
				 $contenido = cms_replace("#RESPONSABLE#",$nombre_responsable,$contenido);
				 $contenido = cms_replace("#ENTIDAD#",$entidad,$contenido);
				 $contenido = cms_replace("#ESTADO_PADRE#",$estado_padre,$contenido); 
				 $contenido = cms_replace("#ESTADO#",$sub_estado_solicitud,$contenido);
				 $contenido = cms_replace("#PLAZO#",$plazo,$contenido);	
				
		   }else{
		  
				   $contenido = html_template('contenedor_respuesta_consulta_solicitudes_vacia');	
					 
						//echo $query;
				

		   
		   }//fin lectura de datos 
			  
			  

		
	}else{
		if($captcha_ok == null){
		 $contenido = cuadro_rojo('Captcha Inv&aacute;lido');
		}elseif($buscar==""){
		 $contenido = cuadro_rojo('Faltan Folio');
		}elseif($apellido==""){
		  $contenido = cuadro_rojo('Faltan Apellido');
		}
                
		
	}
	

	  




?>