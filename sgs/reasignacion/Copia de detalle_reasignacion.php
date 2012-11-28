<?php

	 $js .= "<script language=\"JavaScript\">
			function validaforma(theForm){
				if (theForm.id_responsable.value == \"0\"){
					alert(\"Debe Seleccionar al responsable.\");
					theForm.id_responsable.focus();
				}else{
					theForm.submit();
				}
				
			}
			
			
			
			 $(document).ready(function(){
				
				$('.link_cat').live(\"click\", function () {
     					var id = $(this).attr('id');
						//alert(id);
						$('#'+id).hide(\"slow\"); 	
						$.post(\"?accion=$accion&act=10&axj=1\", { id: id,folio:'$folio' }, function(data){
								$(\"#mensaje_borra\").html(data);
							});			
						
				});
				
 				$('#ver_filtros').click(function () {
 					
					if ($(\"#ver_filtros\").attr(\"checked\")){
        
	 				  $(\"#div_filtros\").show(100);
	
      				}else{
         			  $(\"#div_filtros\").hide(\"fast\");
	 	
      				}


 				});

				
				  $(\"#filtro_oficina\").change(function () {
   						$(\"#filtro_oficina option:selected\").each(function () {
			
							filtro_oficina=$(\"#filtro_oficina\").val();
							filtro_responsable=$(\"#filtro_responsable\").val();
							$.post(\"?accion=$accion&act=7&axj=1\", { filtro_oficina: filtro_oficina,filtro_responsable:filtro_responsable }, function(data){
								$(\"#id_responsable\").html(data);
							});			
        				});
   					})
					
				 $(\"#filtro_responsable\").keypress(function () {

						 var value = $(\"#filtro_responsable\").val();

   						if(value.length > 2){
						filtro_responsable=$(\"#filtro_responsable\").val();
						filtro_oficina=$(\"#filtro_oficina\").val();
						$.post(\"?accion=$accion&act=7&axj=1\", { filtro_oficina: filtro_oficina,filtro_responsable: filtro_responsable }, function(data){
								$(\"#id_responsable\").html(data);
								
								});		
						}
							
        				
   					})
					
					
				
				
				
 			});
			
				
			
			</script>";
			
	 $onClick = "onclick=\"validaforma(document.form1);\"";

	$folio =  $_GET['folio'];
	
	$contenido = html_template('contenedor_admin_solicitudes_ver');	
	$datos_derivacion = Recupera_datos_derivacion($folio);
	
	$Estados_etapa_fin	= configuracion_cms('Estados_etapa_fin');
	$Estados_etapa_respondida =  configuracion_cms('Estados_etapa_respondida');
	$Estados_pendiente_rectificacion =  configuracion_cms('Estados_pendiente_rectificacion');

	
	 $query= "SELECT id_solicitud_asignacion ,fecha_solicita,hora_solicita,observacion,id_estado_asignacion,id_usuario,respuesta,id_asignador  
           	  FROM  sgs_solicitud_asignacion
           	  WHERE folio ='$folio'
           	  ORDER BY fecha_solicita desc";
			  
			  
       $result= cms_query($query)or die (error($query,mysql_error(),$php));
        while (list($id_solicitud_asignacion ,$fecha_solicita,$hora_solicita,$observacion,$id_estado_asignacion, $id_usuario_reasig,$respuesta,$id_asignador) = mysql_fetch_row($result)){
			
			$nombre_solicitante = nombre_usuario2($id_usuario_reasig);
			$fecha_solicita = fechas_html($fecha_solicita);
			$nombre_respuesta= nombre_usuario($id_asignador);
			
			if($id_estado_asignacion==1){
			
			/*	 <tr >
			       <td align=\"center\" >
			      
        	<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" >
        	*/
			$lista_obs_solicitud ="
        <tr>
        	<td align=\"left\" class=\"textos\">Responsable reasignaci&oacute;n:<strong> $nombre_solicitante</strong></td>
        	<td align=\"right\" class=\"textos\">Fecha solicitud :<strong> $fecha_solicita $hora_solicita</strong></td>        	
        	</tr>
        	<tr>
        	<td align=\"left\" class=\"textos\" colspan=\"2\">Observaci&oacute;n de Solicitud:</td>        	
        	</tr>
        	<tr>
        	<td align=\"left\" class=\"textos\" colspan=\"2\"><strong><em>$observacion</em></strong></td>        	
        	</tr>
        	
        	  
				 <tr>
        	<td align=\"left\" class=\"textos\" colspan=\"2\">Observaci&oacute;n :</td>        	
        	</tr>
			
			
        	<tr>
        	<td align=\"center\" class=\"textos\" colspan=\"2\">
        	<textarea name=\"obs_rechazo\" cols=\"80\" rows=\"2\" class=\"textos\"></textarea>
        	</td>        	
        	</tr>
        	
                    ";
					
					
					$boton_rechazada = "  <table width=\"100%\" class=\"tabla_amarillo_sin_ico\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                        <tr>
        	<td align=\"center\"  >
        	<input type=\"hidden\" name=\"rechazo_reasignar\" value=\"\">        	
			<input type=\"hidden\" name=\"id_solicitud_asignacion\" value=\"$id_solicitud_asignacion\">
			<input type=\"hidden\" name=\"id_usuario_reasig\" value=\"$id_usuario_reasig\">
			</td></tr> <tr><td align=\"center\" class=\"textos\"> 
			 
        	<input type=\"button\" name=\"rechaza_solicitud\" value=\"Rechazar Reasignaci&oacute;n\" onClick=\"javascript: confirmar();\">
        	</td>        	
        	</tr>
                                      	</table>";
					/**/
        		/*	</table>
				    </td></tr>*/
			}else{
				
			$lista_obs_solicitud ="<tr>
        	<td align=\"left\" class=\"textos\">Responsable reasignaci&oacute;n:<strong> $nombre_solicitante</strong></td>
        	<td align=\"right\" class=\"textos\">Fecha soliciutd :<strong> $fecha_solicita $hora_solicita</strong></td>        	
        	</tr>
        	<tr><td align=\"center\" class=\"textos\" colspan=\"2\">&nbsp; </td></tr> 
			
			<tr>
        	<td align=\"left\" class=\"textos\" colspan=\"2\">Observaci&oacute;n de Solicitud :</td>        	
        	</tr>
        	<tr>
        	<td align=\"left\" class=\"textos\" colspan=\"2\"><strong><em>$observacion</em></strong></td>        	
        	</tr>
			<tr><td align=\"center\" class=\"textos\" colspan=\"2\">&nbsp; </td></tr> 
        	<tr>
        	<td align=\"left\" class=\"textos\" colspan=\"2\">Respuesta de $nombre_respuesta a esta Solicitud:</td>        	
        	</tr>
        	
			<tr>
        	<td align=\"left\" class=\"textos\" colspan=\"2\"><strong><em>$respuesta</em></strong></td>        	
        	</tr>
        	
            <tr><td align=\"center\" class=\"textos\" colspan=\"2\">&nbsp; </td></tr> 
			
        	
				  
				   ";
				
			}
        	
        	
        	
			 }
 	

 $js .= "
 <script language=\"JavaScript\">
	 	  		

			
			
     function confirmar() {  
      	     if (confirm(\"\u00BFEst\u00E1 seguro de rechazar esta solicitud?\")) {     
      	    	   if(document.form1.obs_rechazo.value == \"\"){
					alert(\"Para solicitar una reasignaci\u00F3n debe ingresar un texto explicativo en el campo Observaci\u00F3n.\");
	 					document.form1.obs_rechazo.focus();
						return false;	
					}else{
				     document.form1.rechazo_reasignar.value=1;
					 document.form1.submit(); 
					}
				
				
      		   }
      	}
		
   
      	</script>";
			 
			
$tabla_solicitud_reasignacion ="<tr><td align=\"center\" class=\"datos_sgs\">
				<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
			  <tr><th align=\"center\"  colspan=\"2\"> 
			  <strong>Motivo de solicitud de reasignaci&oacute;n de responsable <i>$nombre_solicitante</i> </strong></th>
			  </tr> <tbody>
			    $lista_obs_solicitud
			 	</table> 
				
				</td></tr>
				 <tr><td align=\"center\" >$boton_rechazada </td></tr> 
				";
			 
	
	
	
	//	echo $contenido;
 $query= "SELECT id_solicitud_acceso,
				folio,
				a.id_entidad,
				a.id_entidad_padre,
				identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,a.orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,fecha_formulacion,id_digitador,hash,id_usuario,prorroga,firmada,id_tipo_solicitud
				FROM sgs_solicitud_acceso a
				WHERE folio='$folio' ";
				
				
				$result= cms_query($query)or die (error($query,mysql_error(),$php));
				
				if(list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_inicio,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$fecha_formulacion,$id_digitador,$hash,$id_usuario,$prorroga,$firmada,$id_tipo_solicitud) = mysql_fetch_row($result)){
		
								
				$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
				$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;
				
				$estado_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud') ;
				$estado_padre .="<input type=\"hidden\" name=\"id_estado_solicitud\" value=\"$id_estado_solicitud\">";
				$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_solicitud') ;

				$nombre = rescata_valor('usuario',$id_usuario,'nombre');
				$paterno = rescata_valor('usuario',$id_usuario,'paterno');
				$materno = rescata_valor('usuario',$id_usuario,'materno');
				$razon_social = rescata_valor('usuario',$id_usuario,'razon_social');
				$apoderado = rescata_valor('usuario',$id_usuario,'apoderado');
				$email = rescata_valor('usuario',$id_usuario,'email');				
				
				$responsable_solicitud = nombre_usuario2($id_responsable);
				
				
				if($razon_social!=""){
				$solicitante = $razon_social;
				}else{
				$solicitante = $nombre." ".$paterno." ".$materno;
				}
				  
	 
				 $estado_mostrar_cv = $estado_solicitud;
	  
	  $query= "SELECT id_estado_solicitud,estado_solicitud 
               FROM  sgs_estado_solicitudes
               WHERE id_estado_solicitud=id_estado_padre ";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_estado_solicitud2,$estado_solicitud2) = mysql_fetch_row($result)){
    			
				if($id_estado_solicitud==$id_estado_solicitud2){
				$lista_combo_estados .="<option value=\"$id_estado_solicitud2\" selected>$estado_solicitud2</option>";			   
				}else{
				$lista_combo_estados .="<option value=\"$id_estado_solicitud2\">$estado_solicitud2</option>";			   
				
				}
				
				
    		 }
			
    		 
    		 $select_responsables = "<option value=\"0\" ".$seleccionado.">Seleccione responsable..</option>";
	
	
	
	  $query= "SELECT id_usuario,nombre,paterno  , up.perfil ,id_entidad 
               FROM  usuario u, usuario_perfil up
               WHERE u.id_perfil=up.id_perfil and up.maneja_solicitudes = 1 and id_entidad = '$id_entidad'  order by perfil,nombre,paterno asc";
			   
			 //  echo $query;
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
  
	while (list($id_responsable2,$nombre,$paterno,$perfil_user,$id_ent) = mysql_fetch_row($result)){
		
	
			    $query= "SELECT count(*)
                   FROM  sgs_solicitud_acceso 
                   WHERE id_responsable='$id_responsable2'  and id_sub_estado_solicitud not in ($Estados_etapa_fin,$Estados_etapa_respondida,$Estados_pendiente_rectificacion)";
           
			 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
              list($tot_asigaciones) = mysql_fetch_row($result2);
			  
			  if ($id_responsable2!=$id_responsable){
			
		 
		
		
						if ($id_responsable_seleccionado==$id_responsable){
							$seleccionado = "selected";
						}else{
							$seleccionado = "";
						}
					$select_responsables .= "<option value=\"$id_responsable2\" ".$seleccionado.">$nombre $paterno($perfil_user), $tot_asigaciones solicitudes asignadas</option>";
					
		  } 
	 }
	
	
	  $query= "SELECT id_departamento,departamento 
               FROM  sgs_departamentos
               WHERE id_entidad='$id_entidad'";
         $result= mysql_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_departamento,$departamento) = mysql_fetch_row($result)){
    				$lista_oficinas .="<option value=\"$id_departamento\">$departamento</option>\n";		   
    		 }
	
	 
	   /**************************************/
	   
	   
	 
	 
	//$onClick = "";
	
	$filtro_div =" <input type=\"checkbox\" id=\"ver_filtros\" name=\"ver_filtros\" value=\"1\">Ver Filtros
	<div id=\"div_filtros\" style=\"padding-left: 2px; display: none;\">
				<div class=\"semilla\"><input type=\"text\" name=\"filtro_responsable\" id=\"filtro_responsable\">
				Ingrese nombre de Persona</div>
				<div class=\"semilla\"><select name=\"filtro_oficina\" id=\"filtro_oficina\" class=\"filtro_of\">
          				<option value=\"\">---></option>
          				$lista_oficinas
          				</select> Filtro por Oficina
				</div>		
				</div>";
	

		
	
	$responsable_list = "<select name=\"id_responsable\"  id=\"id_responsable\" >
							$select_responsables
						 </select>";
	

    		
		
		$sub_estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_solicitud'); 
		$estado_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
			
		
	
	  $query= "SELECT id_estado_fin_si,id_estado_fin_no  
               FROM  sgs_enrutamiento_estados
               WHERE id_estado_inicio='$id_estado_solicitud'";
      $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_estado_fin_si,$id_estado_fin_no) = mysql_fetch_row($result);
		 
		$estado_solicitud= rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
	 
	 $fecha_inicio  = fechas_html($fecha_inicio);
	 $fecha_termino = fechas_html($fecha_termino);
	
	// $nombre_responsable = nombre_usuario($id_responsable);
	 
	
	  
	/*$contenido = cms_replace("#ID_SOLICITUD#",$folio,$contenido);
	 $contenido = cms_replace("#SERVICIO#",$entidad_padre,$contenido);
	 $contenido = cms_replace("#RESPONSABLE#",$responsable,$contenido);
	 $contenido = cms_replace("#ENTIDAD#",$entidad,$contenido);
	 $contenido = cms_replace("#ESTADO_PADRE#",$estado_padre,$contenido); 
	 $contenido = cms_replace("#ESTADO#",$sub_estado_solicitud,$contenido); 
	 $contenido = cms_replace("#SOLICITANTE#",$solicitante,$contenido);
	 $contenido = cms_replace("#IDENTIFICACION_DOCUMENTOS#",$identificacion_documentos,$contenido);
	 $contenido = cms_replace("#BOTON_CANCELAR#",$boton_cancelar,$contenido);
	 $contenido = cms_replace("#ESTADO_SI#",$onClick,$contenido);
	 $contenido = cms_replace("#ONCLICK#",$onClick,$contenido);
	 $contenido = cms_replace("#COMBO_ESTADOS#",$combo_estados,$contenido);
	 $contenido = cms_replace("#COMBO_ETAPAS#",$combo_etapas,$contenido);
         $contenido = cms_replace("#DATOS_DERIVACION#","$datos_derivacion",$contenido);

	*/
	  $contenido = cms_replace("#FECHA_INGRESO#",$fecha_inicio,$contenido);
	
	 
	 
	 
	 /*************************************************/
	$contenido = cms_replace("#FECHA_INGRESO#","$fecha_ingreso",$contenido);
	$contenido = cms_replace("#FECHA_TERMINO#","$fecha_termino",$contenido);
	$contenido = cms_replace("#SERVICIO#",acentos($entidad_padre),$contenido);
	//$contenido = cms_replace("#ESTADO#","$estado_solicitud",$contenido);
	
	$apoderado = rescata_valor('usuario',$id_usuario,'apoderado') ;
	if(trim($apoderado)!=""){
	   	$apoderado ="<tr><td>Apoderado:</td><td colspan=\"5\"><strong>$apoderado </strong></td></tr>";
	}else{
		$apoderado="";
	}
	$contenido = cms_replace("#APODERADO#","$apoderado",$contenido);

	
	 /*
	$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
	$contenido = cms_replace("#ENTIDAD_HIJA#","",$contenido);
	$contenido = cms_replace("#ENTIDAD#",acentos($entidad_hija),$contenido);
					
	$contenido = cms_replace("#LINK_EDITAR#","$link_editar",$contenido);
	$contenido = cms_replace("#DIAS#","$dias",$contenido);
	$contenido = cms_replace("#OBS#","$identificacion_documentos",$contenido);
	$contenido = cms_replace("#ACCION#","$accion",$contenido);
	$contenido = cms_replace("#LINK_PRINT#","$link_print",$contenido);
	 */
	if($notificacion==0)$notificacion="No";
	if($notificacion==1)$notificacion="Si";
	
	$contenido = cms_replace("#MEDIO_NOTIFICACION#","$notificacion",$contenido);
	
	$forma_recepcion = rescata_valor('sgs_forma_recepcion',$id_forma_recepcion,'forma_recepcion') ;
	$contenido = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$contenido);
	$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
	
	$formato_entrega = rescata_valor('sgs_formato_entrega',$id_formato_entrega,'formato_entrega') ;
	$contenido = cms_replace("#FORMA_ENTREGA#","$formato_entrega",$contenido);
	
	if($oficina!=""){
	
	
			$retiro_oficina = "  <tr>
						  <td class=\"alt\">Oficina: </td>
						  <td colspan=\"5\">$oficina</td>
						  
						
						</tr>";

	}
	/*
	$contenido = cms_replace("#RETIRO_OFICINA#","$retiro_oficina",$contenido);
	
	
	$direccion = rescata_valor('usuario',$id_usuario,'direccion') ;
	$contenido = cms_replace("#DIRECCION#","$direccion",$contenido);
	
	$numero = rescata_valor('usuario',$id_usuario,'numero') ;
	$contenido = cms_replace("#NUMERO#","$numero",$contenido);
	
	$depto = rescata_valor('usuario',$id_usuario,'depto') ;
	$contenido = cms_replace("#DEPARTAMENTO#","$depto",$contenido);
	
	$ciudad = rescata_valor('usuario',$id_usuario,'ciudad') ;
	$contenido = cms_replace("#CIUDAD#","$ciudad",$contenido);
	
	$id_region = rescata_valor('usuario',$id_usuario,'id_region') ;
	$region = rescata_valor('regiones',$id_region,'region') ;
	$contenido = cms_replace("#REGION#","$region",$contenido);

	$correo_electronico = rescata_valor('usuario',$id_usuario,'email') ;
	$contenido = cms_replace("#CORREO_ELECTRONICO#",$correo_electronico,$contenido);
	
	$id_comuna = rescata_valor('usuario',$id_usuario,'id_comuna') ;
	$comuna = rescata_valor('comunas',$id_comuna,'comuna') ;
	$contenido = cms_replace("#COMUNA#","$comuna",$contenido);
	*/
	 /****************************************************/
	 
	 if($firmada==1){
	 $firmada = "si";
	 }else{
	 $firmada= "no";
	 }
	 
	/* $firma = " <tr >
       <td align=\"left\" ><strong>Solicitud firmada </strong></td>
     </tr>
    <tr >
       <td align=\"left\" ><div align=\"left\" style=\"border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px\"><strong>$firmada</strong></div></td>
     </tr>";*/
	 
	  $contenido = cms_replace("#FIRMADA#","$firmada",$contenido);
	 
	  $contenido = cms_replace("#COMUNA#","$comuna",$contenido);
	 
	  $url_1 = "<input type=\"text\" name=\"url_1\" id=\"url_1\" size=\"60\" />";
	  $url_2 = "<input type=\"text\" name=\"url_2\" id=\"url_2\" size=\"60\" />";
	  
	  $contenido = cms_replace("#URL_1#","$url_1",$contenido);
	  $contenido = cms_replace("#URL_2#","$url_2",$contenido);
	 $id_usuario_responsable = id_usuario($id_sesion);
	
	   $query= "SELECT id_solicitud_asignacion,id_estado_asignacion 
	            FROM  sgs_solicitud_asignacion
	            WHERE id_usuario='$id_usuario_responsable' and folio='$folio' and id_estado_asignacion =1";
	      $result= cms_query($query)or die (error($query,mysql_error(),$php));
	       if (!list($id_solicitud_asignacion,$id_estado_asignacion) = mysql_fetch_row($result)){
		   
  //echo $query;
	       	   $query= "SELECT id_solicitud_acceso 
	       	            FROM  sgs_solicitud_acceso
	       	            WHERE id_responsable ='$id_usuario_responsable' and folio='$folio'";
	       	      $resultw= cms_query($query)or die (error($query,mysql_error(),$php));
	       	       if (list($id_solic) = mysql_fetch_row($resultw)){
	       	 		//echo "dfgfdgdfg";
					
					$boton_asignar_otro_funcionario="<input type='button' name='reasignar_p' id='reasignar_p' value='Asignar a otro funcionario' onClick=\"javascript: confirmar_asignar();\"> 
	 						<input type=\"hidden\" name=\"reasignar\" value=''>";			   
	       	 		 }else{
					 
					 $boton_asignar_otro_funcionariox = "<tr><td align=\"center\" > 
           <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabla_verde\">
              <td>Asignar a:</td>
          <td ><strong>$responsable_list</strong></td>
          
        </tr>
     
          
        <tr>
         
          <td colspan=\"2\" align=\"center\">
		  <input type=\"button\" name=\"Aceptar\" id=\"Aceptar\" value=\"Reasignar esta solicitud\" onclick=\"validaforma(document.form1);\" /></td>
          </tr>
         	</table>
			</td></tr> 
";
	 		 	$estado_asignacion = rescata_valor('sgs_solicitud_asignacion_estado',$id_estado_asignacion,'estado_asignacion');
	 		
			
					 }

	
	       		   
	 		 }else{
	 		 	$boton_asignar_otro_funcionario= "<tr><td align=\"center\" > 
           <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabla_verde\">
              <td valign=\"top\" >Asignar a:</td>
          <td ><strong>$responsable_list</strong>$filtro_div</td>
          
        </tr>
     
          
        <tr>
         
          <td colspan=\"2\" align=\"center\">
		  <input type=\"button\" name=\"Aceptar\" id=\"Aceptar\" value=\"Reasignar esta solicitud\" onclick=\"validaforma(document.form1);\" /></td>
          </tr>
         	</table>
			</td></tr> 
";
	 		 	$estado_asignacion = rescata_valor('sgs_solicitud_asignacion_estado',$id_estado_asignacion,'estado_asignacion');
	 		 	
	 		 	//$boton_asignar_otro_funcionario="$responsable_list $estado_asignacion";
	 		 }
			 
			
			 
	 		 

	
	//echo "<strong>prorroga antes boton</strong>:".$prorroga;
	/*
	 if(trim($prorroga) ==0){
	  //mostrar el bot�n
	  	$prorroga = "<input type='button' name='prorroga_b' value='Prorrogar esta Solicitud' onClick=\"javascript: confirmar();\">
			<input type=\"hidden\" name=\"prorroga\" value=''> " ;
	 }else{
	 	$prorroga = "<font color=\"#FF0000\">Esta solicitud ya fue prorogada una vez</font> ";
	 }
	 
	 
	 */
	  $contenido = cms_replace("#PRORROGA#",$prorroga . $boton_asignar_otro_funcionario,$contenido);
	
	// $contenido = acentos($contenido);
	 
	 $fecha_termino = fechas_html($fecha_termino);
	 $fecha_inicio2 =  date(d)."-".date(m)."-".date(Y);
	 $dias = diferencia_entre_fechas($fecha_termino,$fecha_inicio2);
	
	 
	  $tipo_solicitud = rescata_valor('sgs_tipo_solicitud',$id_tipo_solicitud,'tipo_solicitud') ;
	
	  $plazo = $dias ." d&iacute;as";
	 $contenido = cms_replace("#PLAZO#",$plazo,$contenido);
	$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
				$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;
				
					/*************************************************/
					include("sgs/opcionales/opcionales.php");
					
					/*************************************************/
			
			
	/*************************************************/
	
		include("sgs/reemplaza_etiquetas/reemplaza_etiquetas.php");
	
	
	/*********************************************/
	
	
	/*********************************************/
	/* Modulo Archivos */
	/*********************************************/
	$check_archivos = "<input type=\"checkbox\" name=\"consulta_archivos\" id=\"consulta_archivos\"><span class=\"agregar_archivo\">Agregar Archivo&nbsp</span>";
	$contenido = cms_replace("#DETALLE_ARCHIVOS#",$check_archivos,$contenido);
	include ("sgs/solicitudes/formulario.php");
	include ("sgs/reasignacion/listado_archivos.php");
	$contenido= cms_replace("#CARGA_ARCHIVOS#",$formulario,$contenido);
	$contenido= cms_replace("#LISTADO_ARCHIVOS#",$lista,$contenido);
	$accion_form_ = "index.php?accion=$accion&act=11";
	
		$js .="

					<script type=\"text/javascript\">
					
						$(document).ready(function(){
						
							$('#consulta_archivos').click(function(){
								var checkeado=$(\"#consulta_archivos\").attr(\"checked\");
								if(checkeado){
									// div_archivos
									$('#carga').show(100);
								}else{
									$('#carga').css(\"display\", \"none\");
								}
							});
							
							$('#btnguardar').click(function(){
								$('#archivodoc').addClass('required');
								$('#form1').valid();
								if($(\"#archivodoc\").val()!=''){
									document.getElementById('form1').action='$accion_form_';	
									$('#form1').submit();
								}
								
							});
						
						});
					
					</script>

				";
	 
	
	include("sgs/gestion/gestion.php");

	 		
	include("sgs/historial_estado/historial_estado.php");
	//$template_historial = $boton_asignar_otro_funcionario.$template_historial;
	$contenido = cms_replace("#HISTORIAL#","$template_historial",$contenido);
			
	 		
	 //include("sgs/historial_estado/historial_estado.php");			
	// $contenido = cms_replace("#VER_HISTORIAL#",$template_historial,$contenido);	

	$accion_form = "index.php?accion=$accion&act=4";
	
	 $contenido = cms_replace("Asignar responsable","Reasignar esta solicitud",$contenido);
	 $contenido = cms_replace("#MENSAJE#",$boton_asignar_otro_funcionario.$tabla_solicitud_reasignacion,$contenido);
	 
			
	include("sgs/mis_solicitudes_asignadas/captura_visita.php");
	
	
				}
	
	//$contenido = acentos($contenido);
?>