<?php

		$id_usuario     = id_usuario($id_sesion);
		$folio = $_GET['folio'];

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
						hash   
				  FROM  sgs_solicitud_acceso a
				  WHERE folio='$folio' and id_usuario=$id_usuario";


			 $result= cms_query($query)or die ("ERROR $php <br>$query.<br>".mysql_error());
			 list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$fecha_formulacion,$id_digitador,$hash) = mysql_fetch_row($result);
				   
				/*****************PARA RECTIFICAR********************/
				$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
				$aEstadosRectificacion = split(",",$Estados_pendiente_rectificacion);
				$glosa_estado_encontrado = Encuentra_estado($id_sub_estado_solicitud,$aEstadosRectificacion); 
				echo "<br>glosa_estado_encontrado:".$glosa_estado_encontrado;
				$plazo_rectificar = Calcula_plazo_rectificar($folio);
				
				$ficha = html_template('contenedor_detalle_solicitud_rectificar');	

				$responsable = nombre_usuario($id_responsable);
				$fecha_ingreso= fechas_html($fecha_ingreso);
				$fecha_termino = fechas_html($fecha_termino);
				$fecha_ingreso2 =  date(d)."-".date(m)."-".date(Y);
				$dias = diferencia_entre_fechas($fecha_termino,$fecha_ingreso2);
				
				$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
				$estado_solicitud = $estado_solicitud.$glosa_estado_encontrado;
				
				$sub_estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'comentario_para_usuario') ;
				$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
				$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;
				$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
				$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;

				//$link = " href=\"#\" onclick=\"MM_openBrWindow('?accion=Solicitud-de-Informacion&act=5&folio=$folio&axj=1','','width=600,height=500')\" ";
		
				$link_print = " href=\"#\" onclick=\"MM_openBrWindow('?accion=solicitud-de-informacion&act=5&folio=$folio&axj=1','','scrollbars=yes,width=650,height=820')\" ";
				
				//sacar la observación del responsable para mostrarla al solicitante
				 $sql = "Select observacion 
						from sgs_flujo_estados_solicitud 
						where folio='$folio' 
								and id_estado_solicitud in ($Estados_pendiente_rectificacion) 
						order by id_flujo_estados_solicitud desc";
				$resultado_observacion = cms_query($sql)or die("La consulta falló:".mysql_error());
				list($observacion_solicitud) = mysql_fetch_row($resultado_observacion);
										
				if ($sub_estado_solicitud==""){
					if ($observacion_solicitud==""){
						$sub_estado_solicitud = "Sin observaci&oacute;n";
					}else{
						$sub_estado_solicitud = $observacion_solicitud;
					}
				}else{
					$sub_estado_solicitud = $sub_estado_solicitud."<br>".$observacion_solicitud;
				}
				
				$fecha_peticion_rectificacion = Recupera_fecha_ultimo_estado($folio);
				$ficha = cms_replace("#FECHA_PETICION_RECTIFICACION#","$fecha_peticion_rectificacion",$ficha);

				$ficha = cms_replace("#SUBESTADO#","$sub_estado_solicitud",$ficha);
				$ficha = cms_replace("#ESTADO#","$estado_solicitud",$ficha);
				$ficha = cms_replace("#PLAZO_RECTIFICAR#","$plazo_rectificar",$ficha);
						
				$ficha = cms_replace("#FECHA_INGRESO#","$fecha_ingreso",$ficha);
				$ficha = cms_replace("#FECHA_TERMINO#","$fecha_termino",$ficha);
				$ficha = cms_replace("#SERVICIO#",acentos($entidad_padre),$ficha);
				//$ficha = cms_replace("#ESTADO#","$estado_solicitud",$ficha);
				
				$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
				$ficha = cms_replace("#ENTIDAD_HIJA#","",$ficha);
				$ficha = cms_replace("#ENTIDAD#",acentos($entidad_hija),$ficha);
								
				$ficha = cms_replace("#LINK_EDITAR#","$link_editar",$ficha);
				$ficha = cms_replace("#DIAS#","$dias",$ficha);
				
				$ficha = cms_replace("#IDENTIFICACION_DOCUMENTOS#","$identificacion_documentos",$ficha);
				$ficha = cms_replace("#ACCION#","$accion",$ficha);
				$ficha = cms_replace("#LINK_PRINT#","$link_print",$ficha);
				if($notificacion==0)$notificacion="No";
				if($notificacion==1)$notificacion="Si";
				
				$ficha = cms_replace("#MEDIO_NOTIFICACION#","$notificacion",$ficha);
				
				$forma_recepcion = rescata_valor('sgs_forma_recepcion',$id_forma_recepcion,'forma_recepcion') ;
				$ficha = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$ficha);
				$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
				
				$formato_entrega = rescata_valor('sgs_formato_entrega',$id_formato_entrega,'formato_entrega') ;
				$ficha = cms_replace("#FORMA_ENTREGA#","$formato_entrega",$ficha);
				
				if($oficina!=""){
				
				
						$retiro_oficina = "  <tr>
						  <td>Oficina: </td>
						  <td colspan=\"2\"><b>$oficina</b></td>
						  <td colspan=\"2\">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>";

				}
				$ficha = cms_replace("#RETIRO_OFICINA#","$retiro_oficina",$ficha);
						 
				
				
	
	$cont=0;
	$campos ="id_solicitud_acceso,folio,id_entidad,id_entidad_padre,id_usuario,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,fecha_formulacion,id_digitador";
			$comas = substr_count($campos,",");
			$comas++;
      		$aux=explode(",", $campos);
				
				while($cont<$comas){
				
				
					$var    = strtoupper($aux[$cont]);
					//echo "#$var#<br>";
					$ficha = cms_replace("#$var#",$$aux[$cont],$ficha);
					$cont++;
					}
	

						

					
					
		$template_historial = html_template('linea_estado_solicitud_user_registrado');				
		//include("sgs/historial_estado/historial_estado.php");			
		$ficha = cms_replace("#HISTORIAL#",$template_historial,$ficha);			
					
$contenido = $ficha;





/*


<h3>Detalle de la solicitud - N&ordm; #FOLIO#</h3>
<div class="mensaje" id="mensaje"><a #LINK_PRINT#><img height="28" alt="" width="27" align="right" border="0" src="images/sitio/sgs/img/imprimir.gif" />Imprimir</a></div>
<p>Dirigida a: <strong>#SERVICIO#</strong><br />
#ENTIDAD_HIJA#</p>
<div class="wide" id="table-block">
<table cellspacing="0" cellpadding="0">
    <tbody>
        <tr class="header">
            <td width="23%">Entidad</td>
            <td colspan="3">#ENTIDAD#</td>
        </tr>
        <tr>
            <td><strong>Fecha de la solicitud</strong></td>
            <td width="30%">#FECHA_INGRESO#</td>
            <td width="11%"><strong>Estado </strong></td>
            <td width="36%">#ESTADO#</td>
        </tr>
        <tr>
            <td><strong>Plazo para responder</strong></td>
            <td>#DIAS# d&iacute;as</td>
          <td>&nbsp;  </td>
            <td>&nbsp;  </td>
        </tr>
          <tr>
            <td><strong>Desea Notificaci&oacute;n</strong></td>
            <td colspan="3">#MEDIO_NOTIFICACION#  &nbsp;  </td>
        </tr>
       <tr>
            <td><strong>Forma de Recepci&oacute;n</strong></td>
            <td colspan="3">#FORMA_RECEPCION# &nbsp;   </td>
        </tr>
      #RETIRO_OFICINA# 
       <tr>
            <td><strong>Forma de Entrega</strong></td>
            <td colspan="3">#FORMA_ENTREGA# &nbsp;   </td>
        </tr>
      
        <tr>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr class="header">
          <td colspan="4">Informaci&oacute;n solicitada</td>
        </tr>
        <tr>
          <td colspan="4">#OBS#</td>
        </tr>
        <tr>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr class="header">
          <td colspan="2">Observaciones</td>
          <td>  </td>
          <td>  </td>
        </tr>
        <tr>
          <td colspan="4">#SUBESTADO#</td>
        </tr>
    </tbody>
</table>
<p>  </p>
</div>
<p align="center"><a href="?accion=#ACCION#"><img height="20" alt="" width="71" border="0" src="images/sitio/sgs/img/boton_volver.gif" /></a></p>

*/
?>