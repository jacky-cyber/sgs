<?php

	$Estados_etapa_fin= configuracion_cms('Estados_etapa_fin');	
	$Estados_etapa_respondida = configuracion_cms('Estados_etapa_respondida');	

	$folio =  $_GET['folio'];
	$mensaje =  $_GET['mensaje'];
	
	$datos_derivacion = "";
	$datos_derivacion = Recupera_datos_derivacion_tabla($folio);

	

 $js .= "<script src=\"sgs/select_dependientes/js/select_dependientes.js\" type=\"text/javascript\"></script>
 <script language=\"JavaScript\">
			function valida1(){
				if (validaforma(document.form1)==true){ 
						 if (confirm('\u00BFEst\u00E1 seguro de guardar los cambios?.')==true){document.form1.submit(); }else{ return false};
				 }
			}
 
	 	   function validaforma(theForm){
		   
	 		if (theForm.id_estado_solicitud.value == \"0\"){
	 					alert(\"Debe Seleccionar una etapa.\");
	 					theForm.id_estado_solicitud.focus();
	 					return false;
	 			}

	 		if (theForm.id_etapas.value == \"0\"){
	 					alert(\"Debe Seleccionar un Estado.\");
	 					theForm.id_etapas.focus();
	 					return false;
	 			}
		
             estados = \",$Estados_etapa_fin,$Estados_etapa_respondida,\";
			valor_seleccionado = document.form1.id_etapas.options[document.form1.id_etapas.selectedIndex].value;
			valor_seleccionado = ','+valor_seleccionado+',';
			
			var valor = estados.indexOf(valor_seleccionado);
			
			if( estados.indexOf(valor_seleccionado)!=-1){
				if (confirm(\"Al finalizar una solicitud ya no podrá modificarla posteriormente. ¿Desea finalizar la solicitud?\")==false){
					return false;
				}else{
					return true;
				}
				
			}		
		  
            
}

			
			
     function confirmar() {  
      	     if (confirm(\"Esta seguro de Prorrogar esta solicitud\")) {     
      	    	document.form1.prorroga.value=1;
				 document.form1.submit(); 
      		   }
      	}
		
    function confirmar_asignar() {  
	
	  if (confirm(\"Esta solicitud solicitud debe ser aceptada por un usuario con perfil de Asignador ¿Esta suguro de solicitar una reasignación de esta solicitud?\")) {     
      	    	
      		  
			   if(document.form1.observacion.value == \"\"){
					alert(\"Para solicitar una Re asignación debe ingresar un texto explicativo en el campo Observación.\");
	 					document.form1.observacion.focus();
						return false;	
					}else{
					document.form1.reasignar.value=1;
					document.form1.submit(); 
					}
				
				
      	     }
      	}
      	</script>";

		
			/*
		
		    
			* 
			else{
		
		}
			
			*/	
	 		
		    
           $onsubmit = "onSubmit=\"return validaforma(this)\"";

 
 //$onsubmit = "onSubmit=\"return validaforma(this)\"";
	

	
	
		
	
	//sacar el html del contenido
	$Estados_etapa_fin =configuracion_cms('Estados_etapa_fin');
	
	 $query= "SELECT  id_solicitud_acceso 
				FROM sgs_solicitud_acceso 
				WHERE folio='$folio' and id_sub_estado_solicitud in ($Estados_etapa_fin)";
				
				
				$result= cms_query($query)or die (error($query,mysql_error(),$php));
				
				if(!list($idsolicitud) = mysql_fetch_row($result)){
				//$contenido = html_template('detalle_solicitud_mis_solcitudes_respondidas');
				$contenido = html_template('contenedor_admin_solicitudes_ver');
				$formulario_cambia_estado = html_template('formulario_cambia_estado_solicitud'); 
				$contenido = cms_replace("#MENSAJES#",$formulario_cambia_estado,$contenido);
				
				
				
				$contenido = cms_replace("#PRORROGA#",$prorroga_boton ,$contenido);
				$contenido = cms_replace("#REASIGNACION#",$boton_asignar_otro_funcionario ,$contenido);
	
				
				}else{
				//$contenido = html_template('detalle_solicitud_mis_solcitudes_asignadas_finalizada');	
				$contenido = html_template('contenedor_admin_solicitudes_ver_finalizada');
				$texto_finalizada=  contenido_noticia("Solicitud Finalizada");
				$texto_finalizada = cuadro_amarillo($texto_finalizada);
				$contenido = cms_replace("#MENSAJE_FINALIZADA#",$texto_finalizada,$contenido);
				}
	
	
	
			
	
	if($mensaje=="ok"){
		$mensaje = configuracion_cms('mensaje_cambio_estado');
		
	}
	if($mensaje=="pro"){
		$mensaje = configuracion_cms('mensaje_prorroga');
		
	}
	else{
		$mensaje = "";
	}
	$contenido = cms_replace("#MENSAJE#",$mensaje,$contenido);
	
	$and = " and folio = '$folio' ";
	$query= "SELECT id_solicitud_acceso,
					folio,
					a.id_entidad,
					a.id_entidad_padre,
					identificacion_documentos,
					notificacion,
					id_forma_recepcion,
					oficina,
					id_formato_entrega,
					fecha_inicio,
					fecha_termino,
					a.orden,
					id_estado_solicitud,
					id_sub_estado_solicitud,
					id_responsable,
					fecha_formulacion,
					id_digitador,
					hash,
					id_usuario,
					firmada,
					id_tipo_solicitud,
					observacion_adicional
				FROM sgs_solicitud_acceso a
				WHERE folio='$folio' ";
				
				
				
				$result= cms_query($query)or die ("ERROR $php <br>$query.<br>".mysql_error());
				
				if(list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$fecha_formulacion,$id_digitador,$hash,$id_usuario,$firmada,$id_tipo_solicitud,$observacion_adicional) = mysql_fetch_row($result)){
				
				
				$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
				$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;
				
				$estado_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud') ;
				$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_solicitud') ;

		//validar existencia de rectificacion
				$sql = "Select  id_tipo_persona , nombre , paterno , materno ,razon_social ,apoderado ,email , direccion , numero ,depto ,ciudad ,id_region ,id_comuna ,id_pais 						
						from sgs_rectificacion_solicitud
						where folio = '$folio' ";
						
				$result_rectificar = cms_query($sql)or die (error($sql,mysql_error(),$php));
				
				if (mysql_num_rows($result_rectificar)>0){
					list($id_tipo_persona,$nombre,$paterno,$materno,$razon_social,$apoderado,$correo_electronico,$direccion,$numero,$depto,$ciudad,$id_region,$id_comuna,$id_pais) = mysql_fetch_row($result_rectificar);
					$id_pais = verificaPais($id_region,"sgs_rectificacion_solicitud","folio",$folio);
				}else{
					$nombre = rescata_valor('usuario',$id_usuario,'nombre');
					$paterno = rescata_valor('usuario',$id_usuario,'paterno');
					$materno = rescata_valor('usuario',$id_usuario,'materno');
					$razon_social = rescata_valor('usuario',$id_usuario,'razon_social');
					$apoderado = rescata_valor('usuario',$id_usuario,'apoderado');
					$email = rescata_valor('usuario',$id_usuario,'email');	
					$direccion = rescata_valor('usuario',$id_usuario,'direccion') ;
					
					$numero = rescata_valor('usuario',$id_usuario,'numero') ;
					$depto = rescata_valor('usuario',$id_usuario,'depto') ;
					$ciudad = rescata_valor('usuario',$id_usuario,'ciudad') ;
					$id_region = rescata_valor('usuario',$id_usuario,'id_region') ;
					$id_pais = verificaPais($id_region,"usuario","id_usuario",$id_usuario);
					$id_comuna = rescata_valor('usuario',$id_usuario,'id_comuna') ;
					$correo_electronico = rescata_valor('usuario',$id_usuario,'email') ;			
				}
		//fin validar existencia rectificacion




				/*$nombre = rescata_valor('usuario',$id_usuario,'nombre');
				$paterno = rescata_valor('usuario',$id_usuario,'paterno');
				$materno = rescata_valor('usuario',$id_usuario,'materno');
				$razon_social = rescata_valor('usuario',$id_usuario,'razon_social');
				$apoderado = rescata_valor('usuario',$id_usuario,'apoderado');
				$email = rescata_valor('usuario',$id_usuario,'email');		*/		
				
				if($razon_social!=""){
					$solicitante = $razon_social;
				}else{
					$solicitante = $nombre." ".$paterno." ".$materno;
				}
				  
	 
				 $estado_mostrar_cv = $estado_solicitud;
	  
	  $query= "SELECT id_estado_solicitud,estado_solicitud 
               FROM  sgs_estado_solicitudes
               WHERE id_estado_solicitud=id_estado_padre
			   and id_estado_solicitud = 13";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_estado_solicitud2,$estado_solicitud2) = mysql_fetch_row($result)){
    			
				if($id_estado_solicitud==$id_estado_solicitud2){
				$lista_combo_estados .="<option value=\"$id_estado_solicitud2\" selected>$estado_solicitud2</option>";			   
				}else{
				$lista_combo_estados .="<option value=\"$id_estado_solicitud2\">$estado_solicitud2</option>";			   
				
				}
				
				
    		 }
			
	/*
		$sub_estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_solicitud'); 
		$estado_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
			
*/	
		$combo_estados = "<select name=\"id_estado_solicitud\" id=\"id_estado_solicitud\" onChange='cargaContenido(this.id)'>
            
            					
								$lista_combo_estados
           					</select>  ";
							
		
	  $query= "SELECT id_estado_solicitud,estado_solicitud 
               FROM  sgs_estado_solicitudes
               WHERE id_estado_padre=$id_estado_solicitud and id_estado_solicitud!=$id_estado_solicitud";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_estado_solicitud2,$estado_solicitud2) = mysql_fetch_row($result)){
    			
				if($id_sub_estado_solicitud==$id_estado_solicitud2){
				$lista_combo_sub_estados .="<option value=\"$id_estado_solicitud2\" selected>$estado_solicitud2</option>";			   
				}else{
				$lista_combo_sub_estados .="<option value=\"$id_estado_solicitud2\">$estado_solicitud2</option>";			   
				
				}
				
				
    		 }
	
	  $combo_etapas = "<select name=\"id_etapas\" id=\"id_etapas\" >
            
            					<option value=\"0\">Seleccione un Estado</option>
								$lista_combo_sub_estados
           					</select>";
	
	
	 
	  $query= "SELECT id_estado_fin_si,id_estado_fin_no  
               FROM  sgs_enrutamiento_estados
               WHERE id_estado_inicio='$id_estado_solicitud'";
      $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_estado_fin_si,$id_estado_fin_no) = mysql_fetch_row($result);
		 
		//$estado_solicitud= rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
	 
	 $fecha_ingreso = fechas_html($fecha_ingreso);
	
	 $nombre_responsable = nombre_usuario($id_responsable);
	 
	// $contenido = cms_replace("#FECHA_INICIO#","$fecha_inicio",$contenido);
			
	 
	 // $fecha_ingreso=$fecha_inicio;
	
	// $contenido = acentos($contenido);
	 
	 $fecha_termino = fechas_html($fecha_termino);
	 $fecha_inicio2 =  date(d)."-".date(m)."-".date(Y);
	 
	 //calcular el plazo en base a la fecha de respuesta
	/*$sql = "select fecha 
			from sgs_flujo_estados_solicitud 
			where folio = '".$folio."' 
				and id_estado_solicitud = ".$id_sub_estado_solicitud."  
			order by id_flujo_estados_solicitud desc ";
	$result_fecha = mysql_query($sql) 
					or die("<br>la consulta fallo 2  <br>$sql<br> ".mysql_error());	
	list($fecha_respuesta) = mysql_fetch_row($result_fecha);
	echo "fecha respuesta:".$fecha_respuesta;*/
	
	//fin sacar fecha de estado actual
	 
	 
	 
	 //$dias = diferencia_entre_fechas($fecha_termino,$fecha_inicio);
	
	 
	 
	  $plazo = saca_plazo($folio,$id_sub_estado_solicitud,$fecha_ingreso);
      $contenido = str_replace("Respuesta en:","Plazo :",$contenido);
	 // $contenido = cms_replace("#PLAZO#",$plazo,$contenido);
	
	
		//$estado_solicitud= rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
	 
	
	/* 
	
	 /*************************************************/
	 $tipo_solicitud = rescata_valor('sgs_tipo_solicitud',$id_tipo_solicitud,'tipo_solicitud') ;
	 $responsable_solicitud = nombre_usuario2($id_responsable);
	 include("sgs/reemplaza_etiquetas/reemplaza_etiquetas.php");
	
	
	
	$contenido = cms_replace("#COMBO_ESTADOS#",$combo_estados,$contenido);
	$contenido = cms_replace("#COMBO_ETAPAS#",$combo_etapas,$contenido);
	 
	 
	/*********************************************/
	
	 
	/*
	 $contenido = cms_replace("#ID_SOLICITUD#",$folio,$contenido);
	 $contenido = cms_replace("#FECHA_INGRESO#",$fecha_inicio,$contenido);
	 $contenido = cms_replace("#SERVICIO#",$entidad_padre,$contenido);
	 
	 $contenido = cms_replace("#RESPONSABLE#",$nombre_responsable,$contenido);
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
	 
	 
	 
	 $fecha_termino = fechas_html($fecha_termino);
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

	
	
	$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
	$contenido = cms_replace("#ENTIDAD_HIJA#","",$contenido);
	$contenido = cms_replace("#ENTIDAD#",acentos($entidad_hija),$contenido);
					
	$contenido = cms_replace("#LINK_EDITAR#","$link_editar",$contenido);
	$contenido = cms_replace("#DIAS#","$dias",$contenido);
	$contenido = cms_replace("#OBS#","$identificacion_documentos",$contenido);
	$contenido = cms_replace("#ACCION#","$accion",$contenido);
	$contenido = cms_replace("#LINK_PRINT#","$link_print",$contenido);
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
						  <td>Oficina: </td>
						  <td colspan=\"2\"><b>$oficina</b></td>
						  <td colspan=\"2\">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>";
	}
	$contenido = cms_replace("#RETIRO_OFICINA#","$retiro_oficina",$contenido);
	
	$contenido = cms_replace("#DATOS_DERIVACION#","$datos_derivacion",$contenido);
	
	//$direccion = rescata_valor('usuario',$id_usuario,'direccion') ;
	$contenido = cms_replace("#DIRECCION#","$direccion",$contenido);
	
	//$numero = rescata_valor('usuario',$id_usuario,'numero') ;
	$contenido = cms_replace("#NUMERO#","$numero",$contenido);
	
	//$depto = rescata_valor('usuario',$id_usuario,'depto') ;
	$contenido = cms_replace("#DEPARTAMENTO#","$depto",$contenido);
	
	//$ciudad = rescata_valor('usuario',$id_usuario,'ciudad') ;
	$contenido = cms_replace("#CIUDAD#","$ciudad",$contenido);
	
	//$id_region = rescata_valor('usuario',$id_usuario,'id_region') ;
	$region = rescata_valor('regiones',$id_region,'region') ;
	$contenido = cms_replace("#REGION#","$region",$contenido);
	
	$pais = rescata_valor('pais',$id_pais,'pais') ;
	$contenido = cms_replace("#PAIS#","$pais",$contenido);

	//$correo_electronico = rescata_valor('usuario',$id_usuario,'email') ;
	$contenido = cms_replace("#CORREO_ELECTRONICO#",$correo_electronico,$contenido);
	
	$id_comuna = rescata_valor('usuario',$id_usuario,'id_comuna') ;
	$comuna = rescata_valor('comunas',$id_comuna,'comuna') ;
	$contenido = cms_replace("#COMUNA#","$comuna",$contenido);
	
	 
	 if($firmada==1){
	 $firmada = "si";
	 }else{
	 $firmada= "no";
	 }
	 
	 
	  $contenido = cms_replace("#FIRMADA#","$firmada",$contenido);
	 
	  $contenido = cms_replace("#COMUNA#","$comuna",$contenido);
	 */
	  $url_1 = "<input type=\"text\" name=\"url_1\" id=\"url_1\" size=\"70\" />";
	  $url_2 = "<input type=\"text\" name=\"url_2\" id=\"url_2\" size=\"70\" />";
	  
	  $contenido = cms_replace("#URL_1#","$url_1",$contenido);
	  $contenido = cms_replace("#URL_2#","$url_2",$contenido);
	 
	
	 
	 
	 $boton_asignar_otro_funcionario="<input type='button' name='reasignar_p' id='reasignar_p' value='Asignar a otro funcionario' onClick=\"javascript: confirmar_asignar();\"> 
	 <input type=\"hidden\" name=\"reasignar\" value=''>";
	
	//echo "<strong>prorroga antes boton</strong>:".$prorroga;
	 if(trim($prorroga) ==0){
		$prorrogada = "No";
	 }else{
		$prorrogada = "Si";
	 }
	 $contenido = cms_replace("#SOLICITUD_PRORROGADA#",$prorrogada, $contenido);
	
	include ("sgs/solicitudes_respondidas/listado_archivos.php");
	$contenido = cms_replace("#DETALLE_ARCHIVOS#","",$contenido);
	$contenido= cms_replace("#LISTADO_ARCHIVOS#",$lista,$contenido); 
	 
	 
	// $contenido = acentos($contenido);
	 /*
	 $fecha_termino = fechas_html($fecha_termino);
	 $fecha_inicio2 =  date(d)."-".date(m)."-".date(Y);
	 $dias = diferencia_entre_fechas($fecha_termino,$fecha_inicio2);
	
	 
	 
	  $plazo = $dias ." d&iacute;as";
	 $contenido = cms_replace("#PLAZO#",$plazo,$contenido);
					  */
	/* 		
	 include("sgs/historial_estado/historial_estado.php");			
	 $contenido = cms_replace("#VER_HISTORIAL#",$template_historial,$contenido);	
							       */
	 include("sgs/gestion/gestion.php");
	 include("sgs/historial_estado/historial_estado.php");
	
	$contenido = cms_replace("#HISTORIAL#","$template_historial",$contenido);
	
	
	$accion_form = "index.php?accion=$accion&act=2&folio=$folio";

			
	include("sgs/mis_solicitudes_asignadas/captura_visita.php");
	
	
	
	 }else{
	 
	   header("Location:index.php");
	 }
	
	


	
	
	
//template
/*


<p><strong>Editar Solicitud</strong><br />

</p>
	  <table width="100%"  border="0" align="left" cellpadding="2" cellspacing="2">
        <tr >
          <td width="308" align="left" >N&ordm; de Solicitud: <span class="style1"><strong>#ID_SOLICITUD#</strong></span></td>
          <td width="461" align="left" >Fecha Ingreso: <span class="style1"><strong>#FECHA_INGRESO#</strong></span></td>
          </tr>
    	 <tr >
    	   <td align="left" >&nbsp;</td>
    	   <td align="left" >Plazo :#PLAZO#</td>
  	   </tr>
    	 <tr >
    	   <td colspan="2" align="left" >Solicitante:<span class="style1"><strong>#SOLICITANTE#</strong></span></td>
  	   </tr>
    	 <tr >
          <td colspan="2" align="left" >Dirigida a:<span class="style1">#SERVICIO#</span></td>
          </tr>
    	 <tr >
    	   <td colspan="2" align="left" >Entidad : <span class="style1">#ENTIDAD#</span></td>
   	    </tr>
    	 <tr >
          <td align="left" >Etapa actual: <span class="style1"><strong>#ESTADO_PADRE#</strong></span></td>
          <td align="left" ></td>
          </tr>
     <tr >
          <td align="left" > Estado Actual: <span class="style1"><strong>#ESTADO#</strong></span></td>
          <td align="left" >&nbsp;</td>
          </tr>
     <tr >
       <td align="left" colspan="2" >Seleccione Etapa&nbsp;</td>
     </tr>
     <tr >
       <td colspan="2" align="left" >#COMBO_ESTADOS#</td>
     </tr>
     <tr >
       <td colspan="2" align="left" >Seleccione la Estado</td>
       </tr>
     <tr >
       <td colspan="2" align="left" > #COMBO_ETAPAS#</td>
       </tr>
     <tr >
       <td align="left" >Observaci&oacute;n</td>
       <td align="left" >&nbsp;</td>
     </tr>
     <tr >
       <td colspan="2" align="left" ><textarea name="observacion" cols="50" rows="7" id="observacion"></textarea></td>
       </tr>
     <tr >
       <td align="left" ><input type="submit" name="Submit" value="Enviar" /></td>
       <td align="left" >&nbsp;</td>
     </tr>
     <tr >
       <td colspan="2" align="left" ><div align="center">#MENSAJE#
       </div></td>
       </tr>
     <tr >
       <td align="left" >&nbsp;</td>
       <td align="left" >&nbsp;</td>
     </tr>
     <tr >
       <td colspan="2" align="left" ><div align="left"><strong>Informaci&oacute;n de la solicitud <br />
         </strong><strong><br />
                 Solicitud:</strong><br />
  <br />
       #IDENTIFICACION_DOCUMENTOS#</div></td>
       </tr>
     <tr >
       <td colspan="2" align="left" >&nbsp;</td>
     </tr>
     <tr >
       <td colspan="2" align="left" >#VER_HISTORIAL# </td>
     </tr>
  </table>




*/
		include ("sgs/documentos_sistema/formulario.php");
	include ("sgs/solicitudes_finalizadas/listado_archivos.php");		
?>