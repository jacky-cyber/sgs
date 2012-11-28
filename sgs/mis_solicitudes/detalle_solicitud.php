<?php

//echo "aca";
		$id_usuario     = id_usuario($id_sesion);
		$folio = $_GET['folio'];

		$query= "SELECT id_solicitud_acceso,folio,id_entidad,id_entidad_padre,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,
					fecha_termino,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,fecha_formulacion,id_digitador,hash,observacion_adicional,respuesta
				  FROM  sgs_solicitud_acceso 
				  WHERE folio='$folio' and id_usuario=$id_usuario";


			 $result= cms_query($query)or die ("ERROR $php <br>$query.<br>".mysql_error());
			 list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$fecha_formulacion,$id_digitador,$hash,$observacion_adicional,$respuesta) = mysql_fetch_row($result);
			
			
				
		
				
				   
			//si hay que rectificar
				$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
				$aEstadosRectificacion = split(",",$Estados_pendiente_rectificacion);
				$glosa_estado_encontrado = Encuentra_estado($id_sub_estado_solicitud,$aEstadosRectificacion); 
				
				if ($glosa_estado_encontrado!=""){
					header("Location:index.php?accion=$accion&act=2&folio=$folio");
				}
				
				//echo "$id_estado_solicitud ==1 and $id_sub_estado_solicitud==1";
				// if($id_estado_solicitud ==1 and $id_sub_estado_solicitud==2){
				 if($id_estado_solicitud !=13 ){
				 	

				 	//<a href=\"#\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=4&folio=$folio&axj=1','contenedor');\">
					//aqu&iacute;</a>
				
				$js .="<script language=\"JavaScript\">

						$(document).ready(function (){
								$('#boton').click(function(){ 
										procesar('index.php?accion=$accion&act=4&folio=$folio&axj=1','div_respuesta');
										//alert('fdsfsdfsdf');
								});
							
								$('#desistir_mostrar').click(function() 
								{ 
										$(\"#div_respuesta\").css(\"display\", \"block\"); 
										$(\"#desistir_mostrar\").css(\"display\", \"none\"); 
										$(\"#desistir_ocultar\").css(\"display\", \"inline\"); 
										
								});
								$('#desistir_ocultar').click(function() 
								{ 
										$(\"#div_respuesta\").css(\"display\", \"none\"); 
										$(\"#desistir_mostrar\").css(\"display\", \"block\"); 
										$(\"#desistir_ocultar\").css(\"display\", \"none\"); 
										
								});
						
							});
						
						
	
	
						</script>
						   
						";
					
					
					
					$mensaje = "
					";
					
					$ficha_fomulario = html_template('contenedor_desistir_solicitud');
					$ficha_fomulario = cms_replace("#FOLIO#","$folio",$ficha_fomulario);
					
				 	
				 }
				
			
				$ficha .= html_template('contenedor_detalle_solicitud',1);	

				$responsable = nombre_usuario($id_responsable);
				$fecha_ingreso= fechas_html($fecha_ingreso);
				$fecha_termino = fechas_html($fecha_termino);
				$fecha_ingreso2 =  date(d)."-".date(m)."-".date(Y);
				$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
				$ficha = cms_replace("#FECHA_TERMINO#","$fecha_termino",$ficha);
				if($id_estado_solicitud==configuracion_cms("finaliza_consulta") && $respuesta!=""){
					$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
				$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;
					$info=configuracion_cms("informacion_respuesta_ciudadano");
					$info= cms_replace("#INSTITUCION#",$entidad_hija,$info);
					$tr_finalizacion="
					
					<table width=\"100%\" border=\"0\"  cellspacing=\"0\" cellpadding=\"0\">
					<tr>
								        <td colspan=\"4\" class=\"alt\"><strong>Respuesta de Consulta Folio :$folio</td>
								      </tr>
					 </table>
					<table width=\"100%\" border=\"0\"  cellspacing=\"0\" cellpadding=\"0\">				  
								      <tr>
								        <td colspan=\"4\" >
											$respuesta
										</td>
								      </tr>
									  </table>
									  <br/>
<div class=\"alert alert-warning\" style=\"width:90%\">$info</div>					 
									  ";
					$ficha = cms_replace("#RESPUESTA_FINALIZADA#",$tr_finalizacion,$ficha);
				}
				
				//dias
				
				
				if ($id_sub_estado_solicitud >=13){//estados retiro pendiente y pago pendiente, se procesan aca  para parar el tiempo ya que no saltan a la bandeja de solicitudes finalizadas
					//echo "<br>entra a finalizada";
					//echo "fecha inicio: ".$fecha_ingreso;
					$fecha_inicio = fechas_bd($fecha_ingreso);
							//	$fecha_termino = fechas_bd($fecha_termino);
					
					//echo "fecha termino: ".$fecha_termino;
					//$fecha_inicio= fechas_bd($fecha_inicio);
					//$fecha_termino = fechas_bd($fecha_termino);
					$sql = "Select fecha from sgs_flujo_estados_solicitud where folio = '$folio' and id_estado_solicitud = $id_sub_estado_solicitud  order by id_flujo_estados_solicitud desc";
					$resultado_fecha = cms_query($sql)or die (error($sql,mysql_error(),$php));
					list($fecha_respuesta) = mysql_fetch_row($resultado_fecha);
					$respondida_en = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_respuesta);
					//$respondida_en = $respondida_en. "&nbsp;d&iacute;as";
					//
					
					//$fecha_termino = fechas_html($fecha_termino);
					//echo "<br>fecha de respuesta:".$fecha_respuesta;
					//echo "<br>fecha de termino:".$fecha_termino;
					
					if ($fecha_respuesta!=""){
						$dias = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_respuesta);
						//echo "<br>dias:".$dias;
						$fecha_respuesta = fechas_html($fecha_respuesta);
						$fecha_termino = $fecha_respuesta;
						$glosa = "$estado_solicitud en ";
					}else{
						$glosa = "";
						$dias = "<span style=\"color:#Ff0000\">???</span>";
					}
				}else{
					$dias = diferencia_entre_fechas($fecha_termino,$fecha_ingreso2);
					$fecha_ingreso = $fecha_ingreso2;
				}
				//echo "<br>folio = $folio &nbsp;&nbsp;&nbsp;id_sub_estado_solicitud:".$id_sub_estado_solicitud."&nbsp;&nbsp;fecha ingreso:$fecha_ingreso";
				$plazo = saca_plazo($folio,$id_sub_estado_solicitud,fechas_bd($fecha_ingreso));
				//echo "plazo:".$plazo;
				if ($dias != "<span style=\"color:#Ff0000\">???</span>"){
					if (abs($dias) > 1)  {
						$dias = $glosa."&nbsp;".$dias."&nbsp; d&iacute;as";
					}else{
						$dias = $glosa."&nbsp;".$dias."&nbsp; d&iacute;a";
					}
				}
				
				
				
				
				$sub_estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'comentario_para_usuario') ;
				$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
				$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;
				

				//$link = " href=\"#\" onclick=\"MM_openBrWindow('?accion=Solicitud-de-Informacion&act=5&folio=$folio&axj=1','','width=600,height=500')\" ";
		
				$link_print = " href=\"?accion=solicitud-de-informacion&act=5&folio=$folio&axj=1\" ";
				
						
				if ($sub_estado_solicitud==""){
					$sub_estado_solicitud= "Sin observaciones";
				}
				
				$ficha = cms_replace("#SUBESTADO#","$sub_estado_solicitud",$ficha);
				$ficha = cms_replace("#ESTADO#","$estado_solicitud",$ficha);
				
				
						
					    $ficha = cms_replace("#FECHA_INGRESO#","$fecha_ingreso",$ficha);
						$ficha = cms_replace("#FECHA_RESPUESTA#","$fecha_respuesta",$ficha);
						$glosa_fecha = "";
						if ($fecha_respuesta!=""){
							$glosa_fecha = "Fecha de respuesta";
						}
						$ficha = cms_replace("#GLOSA_FECH_RESP#","$glosa_fecha",$ficha);
						
						$ficha = cms_replace("#SERVICIO#",acentos($entidad_padre),$ficha);
						//$ficha = cms_replace("#ESTADO#","$estado_solicitud",$ficha);
						
						$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
						$ficha = cms_replace("#ENTIDAD_HIJA#","",$ficha);
						$ficha = cms_replace("#ENTIDAD#",acentos($entidad_hija),$ficha);
										
						$ficha = cms_replace("#LINK_EDITAR#","$link_editar",$ficha);
						$ficha = cms_replace("#DIAS#","$plazo",$ficha);
						
						$identificacion_documentos = acentos($identificacion_documentos);
						$ficha = cms_replace("#OBS#","$identificacion_documentos ",$ficha);
						$ficha = cms_replace("#ACCION#","$accion",$ficha);
						$ficha = cms_replace("#LINK_PRINT#","$link_print",$ficha);
						if($notificacion==0)$notificacion="No";
						if($notificacion==1)$notificacion="Si";
						
						$ficha = cms_replace("#MEDIO_NOTIFICACION#","$notificacion",$ficha);
						//echo "<br>id_forma_recepcion:".$id_forma_recepcion;
						$forma_recepcion = rescata_valor('sgs_forma_recepcion',$id_forma_recepcion,'forma_recepcion') ;
						$ficha = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$ficha);
						$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
						
						$formato_entrega = rescata_valor('sgs_formato_entrega',$id_formato_entrega,'formato_entrega') ;
						$ficha = cms_replace("#FORMA_ENTREGA#","$formato_entrega",$ficha);
						
						if($oficina!=""){
						
						
						$retiro_oficina ="  <tr>
           									 <td><strong>Retiro en Oficina</strong></td>
            								 <td colspan=\"3\">$oficina &nbsp;   </td>
       									 </tr>";
						}
						$ficha = cms_replace("#RETIRO_OFICINA#","$retiro_oficina",$ficha);
						 
						include ("sgs/documentos_sistema/formulario.php"); 
						include ("sgs/documentos_sistema/listado.php");
						$ficha = cms_replace("#DETALLE_ARCHIVOS#","",$ficha);
						$ficha= cms_replace("#LISTADO_ARCHIVOS#",$lista,$ficha);
						
						if($observacion_adicional != ""){
							
							//echo $observacion_adicional;
							
							$contenedor_detalle_solicitud_obs_adicional = html_template('contenedor_detalle_solicitud_obs_adicional',1);
						
							$contenedor_detalle_solicitud_obs_adicional = cms_replace("#OBSERVACIONES_ADICIONALES#","$observacion_adicional",$contenedor_detalle_solicitud_obs_adicional);
								
							$ficha = cms_replace("#OBSERVACION_ADICIONAL#",$contenedor_detalle_solicitud_obs_adicional,$ficha);
							
						}
				
	
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
	

		$boton_imprimir="<input type=\"button\" value=\"Imprimir\" onclick=\"imprimir();\"/>";				
		$ficha = cms_replace("#BOTON_IMPRIMIR#","$boton_imprimir",$ficha);

					
					
		$template_historial = html_template('linea_estado_solicitud_user_registrado');				
		
		
		if(configuracion_cms('mostrar_historial_solicitantes')==1){
		   include("sgs/historial_estado/historial_estado.php");	
		   $contenido = $ficha .$ficha_fomulario.$template_historial;
		}else{
			$contenido = $ficha .$ficha_fomulario  ;
		}
		
		
		$js .=" 
		<script type=\"text/javascript\" src=\"js/jquery/ui/ui.draggable.js\"></script>
          <script type=\"text/javascript\" src=\"js/jquery/ui/ui.dialog.js\"></script>
		  <script type=\"text/javascript\" src=\"js/jquery/jqprint.js\"></script>
		  <link type=\"text/css\" href=\"js/jquery/ui/themes/base/ui.all.css\" rel=\"stylesheet\" />
		  <link href=\"images/sitio/sgs/css/base_print.css\" rel=\"stylesheet\" type=\"text/css\" />
<script type=\"text/javascript\">
    $(function (){
        $('a.comprobante').click(function() {
            var url = this.href;
            var dialog2 = $('<div style=\"display:hidden\" id=\"sitio\"></div>').appendTo('body');
            // load remote content
            dialog2.load( url,{},function (responseText, textStatus, XMLHttpRequest) {
			dialog2.dialog({ bgiframe: true,
                                        height: 650,
                                        width: 660,
                                        modal: true});
			});
            //prevent the browser to follow the link
			
            return false;
        });
    });
	

    </script>
	   <script type=\"text/javascript\">
    $(function (){
        $('a.print_comprobante').click(function() {
           
			$(\"#sitio\").jqprint();
            return false;
        });
    });
	

    </script>
		
		 ";
		 
		 
		 
		 
$js.="<script>
	
		function imprimir(){
			window.open('index.php?accion=$accion&act=7&folio=$folio&axj=1&p=1','ventana','width=800,height=800,resizable=no');
			//window.open('index.php?accion=nueva-consulta&act=7&folio=$folio&axj=1','ventana','width=800,height=800,resizable=no');
		}
		function consulta(opcion){
			document.getElementById('opcion_seleccion').value=opcion;
			document.getElementById('form1').action='index.php?accion=$accion&act=18';
			document.getElementById('form1').submit();
		}
		
		function cancelar_desistir(){
			location.href = 'index.php?accion=$accion&act=1&folio=$folio';
		}
		
    </script>";	
				
		//$ficha = cms_replace("#HISTORIAL#",$template_historial,$ficha);			
					






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