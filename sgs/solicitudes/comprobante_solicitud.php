<?php


$js .="
	<script type=\"text/javascript\" src=\"js/jquery/ui/ui.draggable.js\"></script>
          <script type=\"text/javascript\" src=\"js/jquery/ui/ui.dialog.js\"></script>
		  <script type=\"text/javascript\" src=\"js/jquery/jqprint.js\"></script>

		  <link type=\"text/css\" href=\"js/jquery/ui/themes/base/ui.all.css\" rel=\"stylesheet\" />

<script type=\"text/javascript\">
    $(function (){
        $('a.comprobante').click(function() {
            var url = this.href;
            var dialog2 = $('<div style=\"display:hidden\" id=\"sitio\"></div>').appendTo('body');
            // load remote content
            dialog2.load( url,{},function (responseText, textStatus, XMLHttpRequest) {
			dialog2.dialog({ bgiframe: true,
                                        height: 750,
                                        width: 680,
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

$folio = $_GET['folio'];
    	
			   $query= "SELECT id_solicitud_acceso,folio,id_entidad,id_entidad_padre,id_usuario,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,fecha_formulacion,id_digitador,hash,observacion_adicional
                        FROM  sgs_solicitud_acceso 
                        WHERE id_usuario='$id_usuario' and folio= '$folio'";
                  $result= cms_query($query)or die (error($query,mysql_error(),$php));
                  if (list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$fecha_formulacion,$id_digitador,$hash,$observacion_adicional) = mysql_fetch_row($result)){
             		$fecha = fechas_html($fecha_ingreso);
					//$nombre =  nombre_usuario2($id_usuario);	
					
					$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre'); 
					$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
					$entidad_padre= acentos($entidad_padre);
				$entidad= acentos($entidad);
				if($axj==1){
				$comprobante = html_template('comprobante_electronico_de_ingreso_print');	
				}else{
				$comprobante = html_template('comprobante_electronico_de_ingreso2');	
				}
				
				

				$contenido = $comprobante; 
     		  	$contenido = cms_replace("#USUARIO#","$nombre",$contenido);	
				$contenido = cms_replace("#FOLIO#","$folio",$contenido);	
				$contenido = cms_replace("#SERVICIO#","$entidad_padre",$contenido);	
				$contenido = cms_replace("#ENTIDAD#","$entidad",$contenido);	
				$contenido = cms_replace("#IDENTIFICACION_DOCUMENTOS#","$identificacion_documentos",$contenido);
				$url_servidor = configuracion_cms('url_servidor');
				$contenido = cms_replace("#URL_SERVIDOR#","$url_servidor",$contenido);
				$contenido = cms_replace("#FECHA#","$fecha",$contenido);	
				$link = " href=\"#\" onclick=\"MM_openBrWindow('?accion=$accion&act=5&folio=$folio&axj=1','','scrollbars=yes,width=650,height=800')\" ";
				$link = " href=\"?accion=$accion&act=5&folio=$folio&axj=1\" class=\"comprobante\" ";
				
				
					$contenido = cms_replace("#LINK_EDITAR#","$link_editar",$contenido);
						$contenido = cms_replace("#DIAS#","$dias",$contenido);
						$contenido = cms_replace("#OBS#","$identificacion_documentos",$contenido);
						$contenido = cms_replace("#OBSERVACIONES_ADICIONALES#","$observacion_adicional",$contenido);
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
						
						
						$retiro_oficina ="  <tr>
           									 <td><strong>Retiro en Oficina</strong></td>
            								 <td colspan=\"3\">$oficina &nbsp;   </td>
       									 </tr>";
						}
						$contenido = cms_replace("#RETIRO_OFICINA#","$retiro_oficina",$contenido);
						 	$img ="<img src=\"code39/html/image.php?code=code128&o=1&t=30&r=1&text=$hash&f1=Arial.ttf&f2=8&a1=&a2=B&a3=\" alt=\"\" border=\"0\">";

					$contenido = cms_replace("#IMG#","$img",$contenido);	
				
				if($axj==1){
				//$html = html_template('html_vacio');	
				$html = "#CONTENIDO#";
				$link = " href=\"javascript:window.print();\" ";
				
				
				$html = cms_replace("#CONTENIDO#","$contenido",$html);	
				$contenido = cms_replace("#LINK#","$link",$html);	
				
				}else{
				
				
				 $ingreso_solicitud =
				 "<div align=\"center\" class=\"tabla_verde\" >
				   <table   border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                     <tr>
                       
                       <td align=\"center\" class=\"textos\"><h4 align=\"center\" >Su solicitud ha sido enviada correctamente</h4></td>
                       </tr>
                 	</table>
				 
				 
				 </div><br>";
				 
				// $ingreso_solicitud = cuadro_verde("<h4 align=\"center\" >Su solicitud ha sido enviada correctamente</h4>");
			        
				  
				$boton_terminar= "<div align=\"center\">
    <input type=\"button\" name=\"Button\" value=\"Volver a mis Solicitudes\" onClick=\"MM_goToURL('parent','index.php');return document.MM_returnValue\">
  </div> ";
				
				}
				
				/*$check_archivos = "<input type=\"checkbox\" name=\"consulta_archivos\" id=\"consulta_archivos\"><span class=\"agregar_archivo\">Agregar Archivo&nbsp</span>";
				$contenido = cms_replace("#DETALLE_ARCHIVOS#",$check_archivos,$contenido);
				// Modulo Archivos
				include ("sgs/solicitudes/formulario.php");
				include ("sgs/solicitudes/listado.php");
				$contenido= cms_replace("#CARGA_ARCHIVOS#",$formulario,$contenido);
				$contenido= cms_replace("#LISTADO_ARCHIVOS#",$lista,$contenido);*/
				$accion_form_ = "index.php?accion=$accion&act=5";
				
				$contenido = cms_replace("#LINK#","$link",$contenido);	
				$contenido = cms_replace("#SOLICITUD_ENVIADA#","$ingreso_solicitud",$contenido);	
				$contenido = cms_replace("#BOTON_TERMINAR#","$boton_terminar",$contenido);	
				
				$accion_form = "index.php";
				$boton_volver = "<input type=\"submit\" name=\"btn_aceptar\" id=\"btn_aceptar\" value=\"Aceptar\" >";
				//$contenido = cms_replace("#BOTON_VOLVER#","$boton_volver",$contenido);
								   
             		 }else{
					 header("Location:index.php");
					 }

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
					 
		if($axj==1){
		$contenido = "$contenido";
		}			 
			

?>