<?php

	
	$Estados_etapa_fin = configuracion_cms('Estados_etapa_fin');	
	$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
	$mensaje_rectificacion = acentos_inverso(configuracion_cms('mensaje_rectificacion'));
	
	$folio =  $_GET['folio'];
	$mensaje =  $_GET['mensaje'];
	
	$datos_derivacion = "";
	$datos_derivacion = Recupera_datos_derivacion_tabla($folio);
  
 	$js .= "
		
 		<script language=\"JavaScript\">
	 	   function validaforma(theForm){
		   
	 		if (document.form1.id_estado_solicitud.value == \"0\"){
	 					alert(\"Debe Seleccionar una etapa.\");
	 					document.form1.id_estado_solicitud.focus();
	 					return false;
	 			}
			
			/*	
			if($('#habilitado').val() == '1'){		
				if($('#respuesta').val() == ''){
					alert(\"Debe Ingresar una respuesta.\");
					theForm.editor1.focus();
					return false;
					
				}
			}
			*/

	 		if (document.form1.id_etapas.value == \"0\"){
	 					alert(\"Debe Seleccionar un Estado.\");
	 					document.form1.id_etapas.focus();
	 					return false;
	 			}
		
             estados = \",$Estados_etapa_fin,\";
			valor_seleccionado = document.form1.id_etapas.options[document.form1.id_etapas.selectedIndex].value;
			valor_seleccionado = ','+valor_seleccionado+',';
			
			var valor = estados.indexOf(valor_seleccionado);
			
			if( estados.indexOf(valor_seleccionado)!=-1){
				if (confirm(\"Al finalizar una solicitud ya no podrá modificarla posteriormente. ¿Desea finalizar la solicitud?\")==false){
					return false;
				}
				
			}	
			
			
            estados = \",$Estados_pendiente_rectificacion,\";
			valor_seleccionado = document.form1.id_etapas.options[document.form1.id_etapas.selectedIndex].value;
			valor_seleccionado = ','+valor_seleccionado+',';
			//alert('valor seleccionado:'+valor_seleccionado);
			var valor = estados.indexOf(valor_seleccionado);
			//alert('valor:'+valor);
			if(estados.indexOf(valor_seleccionado)!=-1){
				if (document.form1.observacion.value==\"\"){
					alert('$mensaje_rectificacion');
					document.form1.observacion.focus();
					return false;
				}
				
			}	

			return true;
			
			
		  
            

}

			
			
     function confirmar() {  
      	     if (confirm(\"\u00BFEst\u00E1 seguro de Prorrogar esta solicitud?\")) {     
      	    	 document.form1.prorroga.value=1;
				 document.form1.submit(); 
      		   }
      	}
		
    function confirmar_asignar() {  
	
	  if (confirm(\"Esta solicitud debe ser aceptada por un usuario con perfil de Asignador \u00BFEst\u00E1 seguro de solicitar una reasignaci\u00F3n de esta solicitud?\")) {     
      	    	
      		  
			   if(document.form1.observacion.value == \"\"){
					alert(\"Para solicitar una reasignaci\u00F3n debe ingresar un texto explicativo en el campo Observaci\u00F3n.\");
	 					document.form1.observacion.focus();
						return false;	
					}else{
					document.form1.reasignar.value=1;
					document.form1.submit(); 
					}
				
				
      	     }
      	}
		
		
		function valida1(){
		
		if (validaforma(document.form1)==true){ 
				         if (confirm('\u00BFEst\u00E1 seguro de guardar los cambios?.#AVISO_RESPONSABILIDAD#')==true){document.form1.submit(); }else{ return false};
				 }
		}
		
$(document).ready(function(){
	// Parametros para e id_estado_solicitud cambiara a id_departamento
   $(\"#id_estado_solicitud\").change(function () {
   		$(\"#id_estado_solicitud option:selected\").each(function () {
			//alert($(this).val());
				id_estado_solicitud=$(this).val();
				$.post(\"index.php?accion=$accion&act=5&axj=1\", { id_estado_solicitud: id_estado_solicitud }, function(data){
				$(\"#id_etapas\").html(data);
				
			});			
        });
   })
	
});

$(document).ready(function(){
	
   $(\"#id_etapas\").change(function () {
   		$(\"#id_etapas option:selected\").each(function () {
				id_estado_solicitud=$(this).val();
				
				$.post(\"index.php?accion=$accion&act=7&axj=1\", { id_estado_solicitud: id_estado_solicitud }, function(data){
				$(\"#descrip_estado\").html(data);
				
			});			
        });
   })
	
});


      	</script>";

		
			/*
		
		    
			* 
			else{
		
		}
			
			*/	
	 		
		
           $onsubmit = "onSubmit=\"return validaforma(this)\"";


 //$onsubmit = "onSubmit=\"return validaforma(this)\"";
	

	$Estados_etapa_fin =configuracion_cms('Estados_etapa_fin');
	
	 $query= "SELECT  id_solicitud_acceso 
				FROM sgs_solicitud_acceso 
				WHERE folio='$folio' and id_sub_estado_solicitud in ($Estados_etapa_fin)";
				
				
				$result= cms_query($query)or die (error($query,mysql_error(),$php));
				
				if(!list($idsolicitud) = mysql_fetch_row($result)){
				//$contenido = html_template('detalle_solicitud_mis_solcitudes_asignadas');
				$contenido = html_template('contenedor_admin_solicitudes_ver');
				
				$formulario_cambia_estado = html_template('formulario_cambia_estado_solicitud');
				
				// Modulo contenedor de respuestas
				//include("sgs/plantilla_respuestas/formulario.php");
				//$formulario_cambia_estado = cms_replace("#CONTENEDOR_RESPUESTAS#",$formulario_respuestas,$formulario_cambia_estado);
				
				$contenido = cms_replace("#MENSAJES#",$formulario_cambia_estado,$contenido);
	
				}else{
				//$contenido = html_template('detalle_solicitud_mis_solcitudes_asignadas_finalizada');
				
				$contenido = html_template('contenedor_admin_solicitudes_ver');
				
				$texto_finalizada=  contenido_noticia("Solicitud Finalizada");
				//$texto_finalizada = html_template('Aviso_solicitud_finalizada');
				$texto_finalizada = cuadro_amarillo($texto_finalizada);
				$contenido = cms_replace("#MENSAJES#",$texto_finalizada,$contenido);
				}
	
	//echo $contenido; 
	//sacar el html del contenido
	
	 
	if($mensaje=="ok"){
		$mensaje = configuracion_cms('mensaje_cambio_estado');
		
		if($mensaje=="mensaje_cambio_estado no existe"){
			
			$_POST['configuracion']="mensaje_cambio_estado";
			$_POST['valor']="Gracias, se ha asignado el nuevo estado a esta solicitud";
			$_POST['descripcion']="Mensaje gracias cambio estado ";
			$_POST['publico']="1";
			$_POST['obligatorio']=0;
			inserta("cms_configuracion");
			$mensaje =$_POST['valor'];
		}
		
	}
		
	if($mensaje=="pro"){
		$mensaje = configuracion_cms('mensaje_prorroga');
		if($mensaje=="mensaje_prorroga no existe"){
			
			$_POST['configuracion']="mensaje_prorroga";
			$_POST['valor']="Se ha asignado una prorroga a esta solicitud";
			$_POST['descripcion']="Mensaje gracias prorroga ";
			$_POST['publico']="1";
			$_POST['obligatorio']=0;
			inserta("cms_configuracion");
			$mensaje =$_POST['valor'];
		}
		
	}elseif($mensaje=="rea"){
		
		$mensaje = configuracion_cms('mensaje_reasignacion');
		if($mensaje=="mensaje_reasignacion no existe"){
			
			$_POST['configuracion']="mensaje_reasignacion";
			$_POST['valor']="Se ha solicitado una reasignaci&oacute;n a esta solicitud";
			$_POST['descripcion']="Mensaje gracias se ha solicitado una reasignaci&oacute;n";
			$_POST['publico']="1";
			$_POST['obligatorio']=0;
			inserta("cms_configuracion");
			$mensaje =$_POST['valor'];
			//dfsdfsdf
			
			
		}
		
	}elseif($_GET['mensaje']==""){
	//echo $mensaje;
		$mensaje = "";
	}
	
	if($mensaje!=""){
	$mensaje = cuadro_informacion($mensaje);
	}
	
			
	$contenido = cms_replace("#MENSAJE#",$mensaje,$contenido);
	
	 $and = " and folio = '$folio' ";
	
	$query= "SELECT id_solicitud_acceso,
				folio,
				a.id_entidad,
				a.id_entidad_padre,
				identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,a.orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,fecha_formulacion,id_digitador,hash,id_usuario,firmada,id_tipo_solicitud,prorroga,observacion_adicional
				FROM sgs_solicitud_acceso a
				WHERE folio='$folio' ";
				//echo $query;
				
				$result= cms_query($query)or die (error($query,mysql_error(),$php));
				
				if(list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$fecha_formulacion,$id_digitador,$hash,$id_usuario,$firmada,$id_tipo_solicitud,$prorroga,$observacion_adicional) = mysql_fetch_row($result)){

				
				if($id_usuario==0){
				include("sgs/patch/bug_id_null.php");
				}
				
				if($id_responsable!=0){
					$responsable_solicitud = nombre_usuario2($id_responsable);
				}else{
					$responsable_solicitud = "Aun no se asigna responsable";					
				}
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
					$id_comuna = rescata_valor('usuario',$id_usuario,'id_comuna') ;
					$id_pais = verificaPais($id_region,"usuario","id_usuario",$id_usuario);
					//$id_pais = rescata_valor('usuario',$id_usuario,'id_pais') ;
					$correo_electronico = rescata_valor('usuario',$id_usuario,'email') ;			
				}
		
		//fin validar existencia rectificacion
				//echo " $id_entidad,$id_entidad_padre sdfsfd";				
				$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
				$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;
				
					/*************************************************/
					include("sgs/opcionales/opcionales.php");
					
					/*************************************************/
				
				$estado_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud') ;
				$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_solicitud') ;

				
				if($razon_social!=""){
				$solicitante = $razon_social;
				}else{
				$solicitante = $nombre." ".$paterno." ".$materno;
				}
				  
	
				 $estado_mostrar_cv = $estado_solicitud;
	
	  if($id_estado_solicitud!=13){
	  	  $query= "SELECT id_estado_solicitud,estado_solicitud 
               FROM  sgs_estado_solicitudes
               WHERE id_estado_solicitud=id_estado_padre and id_estado_padre>1";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_estado_solicitud2,$estado_solicitud2) = mysql_fetch_row($result)){
    			
				if($id_estado_solicitud==$id_estado_solicitud2){
				$lista_combo_estados2 .="<option value=\"$id_estado_solicitud2\" selected>$estado_solicitud2</option>";			   
				}else{
				$lista_combo_estados2 .="<option value=\"$id_estado_solicitud2\">$estado_solicitud2</option>";			   
				
				}
				
				
    		 }
	  }else{
	  
	   $query= "SELECT id_estado_solicitud,estado_solicitud 
               FROM  sgs_estado_solicitudes
               WHERE id_estado_solicitud=13";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($id_estado_solicitud2,$estado_solicitud2) = mysql_fetch_row($result);
    			
				
				$lista_combo_estados2 .="<option value=\"$id_estado_solicitud2\" selected>$estado_solicitud2</option>";			   
				
				
    		 
	  
	  
	  }

	
	
		//$sub_estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_solicitud'); 
		//$estado_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
			
			//onChange='cargaContenido(this.id)
			 $combo_estados = "<select class=\"combo\" name=\"id_estado_solicitud\" id=\"id_estado_solicitud\" >
            
            					<option value=\"0\">Seleccione una Etapa</option>
								$lista_combo_estados2
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
	
	  $combo_etapas = "<select class=\"combo\" name=\"id_etapas\" id=\"id_etapas\" >
            
            					<option value=\"0\">Seleccione un Estado</option>
								$lista_combo_sub_estados
           					</select><div id=\"descrip_estado\"></div>";
	
	
	 
	  $query= "SELECT id_estado_fin_si,id_estado_fin_no  
               FROM  sgs_enrutamiento_estados
               WHERE id_estado_inicio='$id_estado_solicitud'";
      $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_estado_fin_si,$id_estado_fin_no) = mysql_fetch_row($result);
		 
		//$estado_solicitud= rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
	 
	 $fecha_inicio = fechas_html($fecha_inicio);
	
	 $nombre_responsable = nombre_usuario($id_responsable);
	 
	$id_usuario = id_usuario($id_sesion);
	//echo "<br>id_usuario:".$id_usuario."&nbsp;&nbsp;&nbsp;responsable:".$id_responsable;
	if ($id_usuario != $id_responsable){
		$aviso_responsabilidad = " Si confirma, esta solicitud se le asignar\u00E1 autom\u00E1ticamente a usted.";
	}
	$js = cms_replace("#AVISO_RESPONSABILIDAD#",$aviso_responsabilidad,$js);
	
	
	
	 $contenido = cms_replace("#COMBO_ESTADOS#",$combo_estados,$contenido);
	 $contenido = cms_replace("#COMBO_ETAPAS#",$combo_etapas,$contenido);
	
	
	  $url_1 = "<input type=\"text\" class=\"combo\" name=\"url_1\" id=\"url_1\" size=\"60\" />";
	  $url_2 = "<input type=\"text\" class=\"combo\" name=\"url_2\" id=\"url_2\" size=\"60\" />";
	  
	  $contenido = cms_replace("#URL_1#","$url_1",$contenido);
	  $contenido = cms_replace("#URL_2#","$url_2",$contenido);
	 $id_usuario_responsable = id_usuario($id_sesion);
	 
	   $query= "SELECT id_solicitud_asignacion,id_estado_asignacion 
	            FROM  sgs_solicitud_asignacion
	            WHERE id_usuario='$id_usuario_responsable' and folio='$folio' and id_estado_asignacion =1";
				//echo $query;
	      $result= cms_query($query)or die (error($query,mysql_error(),$php));
	       if (!list($id_solicitud_asignacion,$id_estado_asignacion) = mysql_fetch_row($result)){
//echo $query;
	       	   $query= "SELECT id_solicitud_acceso 
	       	            FROM  sgs_solicitud_acceso
	       	            WHERE id_responsable ='$id_usuario_responsable' and folio='$folio'";
	       	      $resultw= cms_query($query)or die (error($query,mysql_error(),$php));
	       	       if (list($id_solic) = mysql_fetch_row($resultw)){
	       	 		$boton_asignar_otro_funcionario="<input type='button' class=\"btn btn-primary\" name='reasignar_p' id='reasignar_p' value='Solicitar Reasignaci&oacute;n' onClick=\"javascript: confirmar_asignar();\"> 
	 <input type=\"hidden\" name=\"reasignar\" value=''>";			   
	       	 		 }

	
	       		   
	 		 }else{
	 		 	
	 		 	$estado_asignacion = rescata_valor('sgs_solicitud_asignacion_estado',$id_estado_asignacion,'estado_asignacion');
	 		 	
	 		 	//$boton_asignar_otro_funcionario="$estado_asignacion";
				
	 		 }
	 		 
	 	  	include("sgs/lista_categorias/lista_categorias.php");
			 
	
	//echo "<strong>prorroga antes boton</strong>:".$prorroga;
	 if(trim($prorroga) ==0){
	  //mostrar el boton
	  
	  	$prorrogada = "No";
	  	$prorroga_boton = "<input type=\"button\" class=\"btn btn-primary\" name='prorroga_b' value='Prorrogar Solicitud' onClick=\"javascript: confirmar();\">
			<input type=\"hidden\" name=\"prorroga\" value=''> " ;
	 }else{
	 	//$prorroga = "<font color=\"#FF0000\">Esta solicitud ya fue porrogada una vez</font> ";
		$prorrogada = "Si";
	 }

	 $contenido = cms_replace("#PRORROGA#",$prorroga_boton ,$contenido);
	 $contenido = cms_replace("#REASIGNACION#",$boton_asignar_otro_funcionario ,$contenido);
	 $contenido = cms_replace("#SOLICITUD_PRORROGADA#",$prorrogada, $contenido);
	 $tipo_solicitud = rescata_valor('sgs_tipo_solicitud',$id_tipo_solicitud,'tipo_solicitud') ;
	   
	// $contenido = acentos($contenido);
	 
	 $fecha_termino = fechas_html($fecha_termino);
	 $fecha_inicio2 =  date(d)."-".date(m)."-".date(Y);
	 $fecha_actual =   date(Y)."-".date(m)."-".date(d);
	 //$dias = diferencia_entre_fechas(fechas_bd($fecha_termino),fechas_bd($fecha_actual));
	
	 $plazo = saca_plazo($folio,$id_sub_estado_solicitud,$fecha_ingreso);
	 
	  //$plazo = $dias ." d&iacute;as";
	
	  $contenido = cms_replace("#PLAZO#",$plazo,$contenido);
	  $contenido = cms_replace("Respuesta en:","Plazo:",$contenido);
	  
	/*************************************************/
	
		include("sgs/reemplaza_etiquetas/reemplaza_etiquetas.php");
	
	
	/*********************************************/
	
	
	/*********************************************/
	/* Modulo Archivos */
	/*********************************************/
	$check_archivos .= "<input type=\"checkbox\" name=\"consulta_archivos\" id=\"consulta_archivos\"><span class=\"agregar_archivo\">Agregar Archivo&nbsp</span>";
	$check_archivos .= "<input type=\"hidden\" id=\"fol\" name=\"fol\" value=\"$folio\"> ";
	$check_archivos .= "<input type=\"hidden\" id=\"direccionar\" name=\"direccionar\" value=\"1\"> ";
	$contenido = cms_replace("#DETALLE_ARCHIVOS#",$check_archivos,$contenido);
	include ("sgs/solicitudes/formulario.php");
	include ("sgs/solicitudes/listado.php");
	$contenido= cms_replace("#CARGA_ARCHIVOS#",$formulario,$contenido);
	$contenido= cms_replace("#LISTADO_ARCHIVOS#",$lista,$contenido);
	$accion_form_ = "index.php?accion=$accion&act=8";
	
	$accion_form_archivo = "index.php?accion=$accion&act=8";
	
	
	
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
							
						$('#btnguardar').live('click', function(){
								var objeto =document.getElementById('archivodoc');
								var extension=(objeto.value.substring(objeto.value.lastIndexOf('.'))).toLowerCase();						
								var extensiones_permitidas = new Array($formato_per2); 
								var  txt='';
								var  txt2='';
								var  txt3='';
								var permitida = false;
								  for (var i = 0; i < extensiones_permitidas.length; i++) {
									 if (extensiones_permitidas[i] == extension) {
									 permitida = true;
									 break;
									 }
								  } 

								if(permitida==true){
									document.getElementById('form1').action='$accion_form_archivo';
									$('#form1').submit();
								}else{
									alert('debe ingresar archivo con formato v\u00e1lido');
									return false;
								}
						
						});
						
						});
					
					</script>

				";
	
	
	
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
		
?>