<?php

$Estados_etapa_fin= configuracion_cms('Estados_etapa_fin');	
$folio =  $_GET['folio'];
$mensaje =  $_GET['mensaje'];
//sacar el html del contenido
//$contenido = html_template('detalle_solicitud_web_rectificar');	
$contenido = html_template('contenedor_admin_solicitudes_ver');	
	

 $js .= "<script src=\"sgs/select_dependientes/js/select_dependientes.js\" type=\"text/javascript\"></script>
 <script language=\"JavaScript\">
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
		
             estados = \",$Estados_etapa_fin,\";
			valor_seleccionado = document.form1.id_etapas.options[document.form1.id_etapas.selectedIndex].value;
			valor_seleccionado = ','+valor_seleccionado+',';
			
			var valor = estados.indexOf(valor_seleccionado);
			
			if( estados.indexOf(valor_seleccionado)!=-1){
				if (confirm(\"Al finalizar una solicitud ya no podr\u00E1 modificarla posteriormente. \u00BFDesea finalizar la solicitud?\")==false){
					return false;
				}
				
			}		
		  
            
}

			
			
     function confirmar() {  
      	     if (confirm(\"\u00BFEst\u00E1 seguro de Prorrogar esta solicitud?\")) {     
      	    	document.form1.prorroga.value=1;
				 document.form1.submit(); 
      		   }
      	}
		
    function confirmar_asignar() {  
	
	  if (confirm(\"Esta solicitud solicitud debe ser aceptada por un usuario con perfil de Asignador \u00BFEst\u00E1 suguro de solicitar una reasignaci\u00F3n de esta solicitud?\")) {     
      	    	
      		  
			   if(document.form1.observacion.value == \"\"){
					alert(\"Para solicitar una Re asignaci\u00F3n debe ingresar un texto explicativo en el campo Observaci\u00F3n.\");
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
	
	/* $query= "SELECT id_solicitud_acceso,
				folio,
				a.id_entidad,
				a.id_entidad_padre,
				identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,a.orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,fecha_formulacion,id_digitador,hash,id_usuario,prorroga,firmada
				FROM sgs_solicitud_acceso a
				WHERE folio='$folio' ";
				
				
				$result= cms_query($query)or die ("ERROR $php <br>$query.<br>".mysql_error());
				
				if(list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_inicio,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$fecha_formulacion,$id_digitador,$hash,$id_usuario,$prorroga,$firmada) = mysql_fetch_row($result)){
				
	*/
	
	$query= "SELECT id_solicitud_acceso,folio,fecha_formulacion,fecha_digitacion,fecha_inicio,fecha_termino,id_entidad_padre,id_entidad,id_usuario,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,id_digitador,prorroga,finalizada,firmada,hash,otra_entidad_origen,fecha_original,id_entidad_padre_origen,id_entidad_hija_origen,url_documento_origen,observacion_origen,id_tipo_solicitud
			FROM sgs_solicitud_acceso 
				WHERE folio='$folio' ";
				
				//echo $query;
				$result= cms_query($query)or die (error($query,mysql_error(),$php));
				
				if(list($id_solicitud_acceso,$folio,$fecha_formulacion,$fecha_digitacion,$fecha_ingreso,$fecha_termino,$id_entidad_padre,$id_entidad,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$id_digitador,$prorroga,$finalizada,$firmada,$hash,$otra_entidad_origen,$fecha_original,$id_entidad_padre_origen,$id_entidad_hija_origen,$url_documento_origen,$observacion_origen,$id_tipo_solicitud) = mysql_fetch_row($result)){
	
				$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
				$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;
				$estado_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud') ;
				$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_solicitud') ;
			
		//validar existencia de rectificacion
				$sql = "Select  id_tipo_persona , nombre , paterno , materno ,razon_social ,apoderado ,email , direccion , numero ,depto ,ciudad ,id_region ,id_comuna, id_pais 						
						from sgs_rectificacion_solicitud
						where folio = '$folio' ";
				$result_rectificar = cms_query($sql)or die (error($sql,mysql_error(),$php));
				
				if (mysql_num_rows($result_rectificar)>0){
					list($id_tipo_persona,$nombre,$paterno,$materno,$razon_social,$apoderado,$correo_electronico,$direccion,$numero,$depto,$ciudad,$id_region,$id_comuna, $id_pais) = mysql_fetch_row($result_rectificar);
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
				$email = rescata_valor('usuario',$id_usuario,'email');	*/			
				
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
			
	
		$sub_estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_solicitud'); 
		$estado_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
			
			
			 $combo_estados = "<select name=\"id_estado_solicitud\" id=\"id_estado_solicitud\" onChange='cargaContenido(this.id)'>
            
            					<option value=\"0\">Seleccione una Etapa</option>
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
	
	// echo "$estado_padre $estado_solicitud";
	
	 $fecha_termino = fechas_html($fecha_termino);
	 $fecha_inicio2 =  date(d)."-".date(m)."-".date(Y);
	 $dias = diferencia_entre_fechas($fecha_termino,$fecha_inicio2);
	
	  
	  
	 //$plazo = $dias ." d&iacute;as";
	 $contenido = str_replace("Respuesta en:","Plazo para rectificar: ",$contenido);
	
	
	 $dias_rectificar = Calcula_plazo_rectificar($folio);
	 $contenido = cms_replace("#DIAS_RECTIFICAR#",$dias_rectificar,$contenido);
	 
	 
	$estado_solicitud .=" <strong> ($dias_rectificar para rectificar)</strong>";
	$contenido = cms_replace("#PLAZO#",$dias_rectificar,$contenido);
	$responsable_solicitud = nombre_usuario2($id_responsable);
	$tipo_solicitud = rescata_valor('sgs_tipo_solicitud',$id_tipo_solicitud,'tipo_solicitud') ;
				
	 //$mensajes = cuadro_amarillo("dsfsdfsdf");
	
	 include("sgs/reemplaza_etiquetas/reemplaza_etiquetas.php");
	
	  $query= "SELECT id_estado_fin_si,id_estado_fin_no  
               FROM  sgs_enrutamiento_estados
               WHERE id_estado_inicio='$id_estado_solicitud'";
      $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_estado_fin_si,$id_estado_fin_no) = mysql_fetch_row($result);
		 
	 $estado_solicitud= rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
	 
	 $fecha_inicio = fechas_html($fecha_inicio);
	
	 $nombre_responsable = nombre_usuario($id_responsable);
	// $identificacion_documentos = "<textarea name=\"identificacion_documentos\" id=\"identificacion_documentos\" cols=\"80\" rows=\"8\" class=\"textos\">$identificacion_documentos</textarea>";
	 	
	 
		
	
	
	
	 /****************************************************/
	 
	 if($firmada==1){
	 $firmada = "si";
	 }else{
	 $firmada= "no";
	 }
	 
	 
	  $contenido = cms_replace("#FIRMADA#","$firmada",$contenido);
	 
	  $contenido = cms_replace("#COMUNA#","$comuna",$contenido);
	 
	  $url_1 = "<input type=\"text\" name=\"url_1\" id=\"url_1\" size=\"70\" />";
	  $url_2 = "<input type=\"text\" name=\"url_2\" id=\"url_2\" size=\"70\" />";
	  
	  $contenido = cms_replace("#URL_1#","$url_1",$contenido);
	  $contenido = cms_replace("#URL_2#","$url_2",$contenido);
	 
	 
	 
	 
	 $boton_asignar_otro_funcionario="<input type='button' name='reasignar_p' id='reasignar_p' value='Asignar a otro funcionario' onClick=\"javascript: confirmar_asignar();\"> 
	 <input type=\"hidden\" name=\"reasignar\" value=''>";
	
	//echo "<strong>prorroga antes boton</strong>:".$prorroga;
	 if(trim($prorroga) ==0){
	  //mostrar el botón
	  	$prorroga = "<input type='button' name='prorroga_b' value='Prorrogar esta Solicitud' onClick=\"javascript: confirmar();\">
			<input type=\"hidden\" name=\"prorroga\" value=''> " ;
	 }else{
	 	$prorroga = "<font color=\"#FF0000\">Esta solicitud ya fue porrogada una vez</font> ";
	 }
	 
	 $contenido = cms_replace("#PRORROGA#",$prorroga . $boton_asignar_otro_funcionario,$contenido);
	 
	 
	 
	// $contenido = acentos($contenido);
	 
	include ("sgs/gestion/gestion.php");	
	include("sgs/historial_estado/historial_estado.php");
	
	$contenido = cms_replace("#HISTORIAL#","$template_historial",$contenido);
	
	$accion_form = "index.php?accion=$accion&act=2&folio=$folio";

			
	include("sgs/mis_solicitudes_asignadas/captura_visita.php");
	
	
	
	 }else{
	 
	   header("Location:index.php");
	 }
	
	/*********************************************/
	/* Modulo Archivos */
	/*********************************************/
	
	$contenido = cms_replace("#DETALLE_ARCHIVOS#","",$contenido);
	include ("sgs/rectificar_solicitudes/listado_archivos.php");
	$contenido= cms_replace("#LISTADO_ARCHIVOS#",$lista,$contenido);	
	
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
		
?>