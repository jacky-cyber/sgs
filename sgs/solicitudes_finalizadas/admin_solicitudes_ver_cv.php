<?php
	echo "<br> hola";
	
	$folio =  $_GET['folio'];
	$mensaje =  $_GET['mensaje'];
	


	//sacar el html del contenido
	$contenido = html_template('detalle_solicitud_finalizada');		
	
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
	
	 //$and = " and a.folio = '$folio' ";
	 $query= "SELECT id_solicitud_acceso,
					a.folio,
					a.id_entidad,
					a.id_entidad_padre,
					f.razon_social,
					d.entidad_padre,
					a.id_usuario,
					identificacion_documentos,
					notificacion,
					id_forma_recepcion,
					oficina,
					id_formato_entrega,
					a.fecha_inicio,
					a.fecha_termino,
					a.orden,
					a.id_estado_solicitud,
					b.estado_solicitud,
					id_sub_estado_solicitud,
					id_responsable,
                    ifnull(c.estado_solicitud,'') estado_padre,
                    CONCAT(f.nombre,' ', f.paterno,' ', f.materno) solicitante,
				    entidad,
					a.prorroga,
					a.firmada,
					h.fecha as fecha_respuesta    
					FROM sgs_solicitud_acceso a 
					LEFT OUTER JOIN sgs_estado_solicitudes b on  a.id_sub_estado_solicitud = b.id_estado_solicitud 
					LEFT OUTER JOIN sgs_estado_solicitudes c on  c.id_estado_solicitud = b.id_estado_padre 
					LEFT OUTER JOIN sgs_entidad_padre d  on  a.id_entidad_padre = d.id_entidad_padre 
					LEFT OUTER JOIN usuario f on a.id_usuario = f.id_usuario  
					LEFT OUTER JOIN sgs_entidades g on a.id_entidad = g.id_entidad  
					LEFT OUTER JOIN sgs_flujo_estados_solicitud h on a.folio =  h.folio and a.id_sub_estado_solicitud = h.id_estado_solicitud
					WHERE  1 and a.folio = '$folio'	 
				    ORDER BY a.fecha_inicio asc";
		
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
  
	 list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$razon_social,$entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_inicio,$fecha_termino,$orden,$id_estado_solicitud,$estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$estado_padre,$solicitante,$entidad,$prorroga,$firmada,$fecha_respuesta) = mysql_fetch_row($result);
	 
	
	 
	 $fecha_termino_1 = fechas_html($fecha_termino);
	 $fecha_respuesta_1 = fechas_html($fecha_respuesta); 
	
	 $fecha_termino = $fecha_respuesta;
	 $plazo = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_termino);
	 $plazo = $plazo. " d&iacute;as";

     $estado_mostrar_cv = $estado_solicitud;
	  
	 $sub_estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_solicitud'); 
	 $estado_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
			
	 $estado_solicitud= rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
	 
	 $fecha_inicio = fechas_html($fecha_inicio);
	
	 $nombre_responsable = nombre_usuario($id_responsable);
	 
	 
	//si esta desistida por no rectificacion
	$coloca_boton = "";
	
	if ($id_sub_estado_solicitud == 23){
		$coloca_boton = "<tr >
						   <td align=\"left\" ><label>
							 <input type=\"submit\" name=\"Reactivar\" id=\"Reactivar\" value=\"Reactivar\" />
							 <input type=\"hidden\" name=\"folio\" id=\"folio\" value=\"#ID_SOLICITUD#\" />
						   </label></td>
					   </tr>";
					
		
		
	}
	$contenido = cms_replace("#DESISTIDA#","$coloca_boton",$contenido);

	 //fin 
	
	/****************************************************/
	 
	 
	 
	
	 $contenido = cms_replace("#ID_SOLICITUD#",trim($folio),$contenido);
	 $contenido = cms_replace("#FECHA_INGRESO#",$fecha_inicio,$contenido);
	 $contenido = cms_replace("#SERVICIO#",$entidad_padre,$contenido);
	 
	 $contenido = cms_replace("#RESPONSABLE#",$nombre_responsable,$contenido);
	 $contenido = cms_replace("#ENTIDAD#",$entidad,$contenido);
	 $contenido = cms_replace("#ESTADO_PADRE#",$estado_padre,$contenido); 
	 $contenido = cms_replace("#ESTADO#",$sub_estado_solicitud,$contenido); 
	 
	 if($razon_social!=""){
	 $contenido = cms_replace("#SOLICITANTE#",$razon_social,$contenido);
	 }else{
	 $contenido = cms_replace("#SOLICITANTE#",$solicitante,$contenido);
	 }
	 $contenido = cms_replace("#SOLICITANTE#",$solicitante,$contenido);
	 $contenido = cms_replace("#IDENTIFICACION_DOCUMENTOS#",$identificacion_documentos,$contenido);
	 $contenido = cms_replace("#BOTON_CANCELAR#",$boton_cancelar,$contenido);
	 $contenido = cms_replace("#ESTADO_SI#",$onClick,$contenido);
	 $contenido = cms_replace("#ONCLICK#",$onClick,$contenido);
	 
	 $contenido = cms_replace("#FECHA_RESPUESTA#",$fecha_respuesta_1,$contenido);
	 $contenido = cms_replace("#FECHA_TERMINO#",$fecha_termino_1,$contenido);
	 
	 if($firmada==1){
	 $firmada = "si";
	 }else{
	 $firmada= "no";
	 }
	 
	 $firma = " <tr >
                     <td align=\"left\" ><strong>Solicitud firmada </strong></td>
                </tr>
                <tr >
                   <td align=\"left\" ><div align=\"left\" style=\"border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px\"><strong>$firmada</strong></div></td>
     			</tr>";
	 
	  $contenido = cms_replace("#FIRMADA#","$firma",$contenido);
	 
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
	
	
	$retiro_oficina ="<tr>
						 <td><strong>Retiro en Oficina</strong></td>
						 <td colspan=\"3\">$oficina &nbsp;   </td>
					 </tr>";
	
	}
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
	
	
	 
	 
	  $url_1 = "<input type=\"text\" name=\"url_1\" id=\"url_1\" size=\"70\" />";
	  $url_2 = "<input type=\"text\" name=\"url_2\" id=\"url_2\" size=\"70\" />";
	  
	  $contenido = cms_replace("#URL_1#","$url_1",$contenido);
	  $contenido = cms_replace("#URL_2#","$url_2",$contenido);
	 
	 
	 
	 
	 
	
	//echo "<strong>prorroga antes boton</strong>:".$prorroga;
	 if(trim($prorroga) =="0"){
	  //mostrar el botón
	  	$prorroga = "<input type='button' name='prorroga_b' value='Prorrogar esta Solicitud' onClick=\"javascript: confirmar();\">
			<input type=\"hidden\" name=\"prorroga\" value=''>" ;
	 }else{
	 	$prorroga = "<font color=\"#FF0000\">Esta solicitud ya fue porrogada una vez</font> ";
	 }
	 
	 $contenido = cms_replace("#PRORROGA#",$prorroga,$contenido);
	 	 
	 
	 //$contenido = acentos($contenido);
	 
	 $fecha_termino = fechas_html($fecha_termino);
	 $fecha_inicio2 =  date(d)."-".date(m)."-".date(Y);
	 $dias = diferencia_entre_fechas($fecha_termino,$fecha_inicio2);
	 
	 
	 
	 $contenido = cms_replace("#PLAZO#",$plazo,$contenido);
	
	 		
	 include("sgs/historial_estado/historial_estado.php");			
	 $contenido = cms_replace("#VER_HISTORIAL#",$template_historial,$contenido);	


			

	
	

		
	


	
	
	
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