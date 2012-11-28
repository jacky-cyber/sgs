<?php

	

	$folio =  $_GET['folio'];
	$mensaje =  $_GET['mensaje'];
	
	$datos_derivacion = "";
	$datos_derivacion = Recupera_datos_derivacion_tabla($folio);
	$Estados_etapa_fin	= configuracion_cms('Estados_etapa_fin');
	$Estados_etapa_respondida =  configuracion_cms('Estados_etapa_respondida');
	$Estados_pendiente_rectificacion =  configuracion_cms('Estados_pendiente_rectificacion');
	 
	//echo $datos_derivacion;
	//sacar el html del contenido
	$contenido = html_template('contenedor_admin_solicitudes_ver2');
	
	//detalle_solicitud_mis_solcitudes_asignadas_finalizada	
	
	if($mensaje=="ok"){
	
		 $query= "SELECT id_responsable
				FROM sgs_solicitud_acceso 
				WHERE folio='$folio' ";
				
				//echo $query;
				$result= cms_query($query)or die (error($query,mysql_error(),$php));
				
				list($id_resp) = mysql_fetch_row($result);
				
		$nombre_responsable = nombre_usuario2($id_resp); 
		$mensaje = " <div class=\"alert alert-success\">
						Esta solicitud fue asignada a <strong>$nombre_responsable</strong> correctamente
				</div>";
		
		
	}else{
		$mensaje = "";
	}
	$contenido = cms_replace("#MENSAJE#",$mensaje,$contenido);
	$contenido = str_replace("Respuesta en:","Plazo :",$contenido);
		
	
	$query= "SELECT id_solicitud_acceso,folio,fecha_formulacion,fecha_digitacion,fecha_inicio,fecha_termino,id_entidad_padre,id_entidad,id_usuario,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,id_digitador,prorroga,finalizada,firmada,hash,otra_entidad_origen,fecha_original,id_entidad_padre_origen,id_entidad_hija_origen,url_documento_origen,observacion_origen,id_tipo_solicitud,observacion_adicional
			FROM sgs_solicitud_acceso 
				WHERE folio='$folio' ";
				
				//echo $query;
				$result= cms_query($query)or die (error($query,mysql_error(),$php));
				
				list($id_solicitud_acceso,$folio,$fecha_formulacion,$fecha_digitacion,$fecha_ingreso,$fecha_termino,$id_entidad_padre,$id_entidad,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$id_digitador,$prorroga,$finalizada,$firmada,$hash,$otra_entidad_origen,$fecha_original,$id_entidad_padre_origen,$id_entidad_hija_origen,$url_documento_origen,$observacion_origen,$id_tipo_solicitud,$observacion_adicional) = mysql_fetch_row($result);
				
							
				$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
				$tipo_solicitud = rescata_valor('sgs_tipo_solicitud',$id_tipo_solicitud,'tipo_solicitud') ;
				$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;
				
				$estado_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud') ;
				$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_solicitud') ;
				
				if($id_responsable!=0){
					$responsable_solicitud = nombre_usuario2($id_responsable);
				}else{
					$responsable_solicitud = "A&uacute;n no se asigna responsable";					
				}
				


				
				$nombre = rescata_valor('usuario',$id_usuario,'nombre');
				
				$paterno = rescata_valor('usuario',$id_usuario,'paterno');
				$materno = rescata_valor('usuario',$id_usuario,'materno');
				$razon_social = rescata_valor('usuario',$id_usuario,'razon_social');
				$apoderado = rescata_valor('usuario',$id_usuario,'apoderado');
				$correo_electronico = rescata_valor('usuario',$id_usuario,'email');				
				
				if($razon_social!=""){
				$solicitante = $razon_social;
				}else{
				$solicitante = $nombre." ".$paterno." ".$materno;
				}
				  
				
	 
	 $fecha_ingreso = fechas_html($fecha_ingreso);
	//echo "responsable:".$id_responsable;
	
		
	
	
	
	if ($id_responsable==""){
		$id_responsable_seleccionado = 0;
	}else{
		$id_responsable_seleccionado = $id_responsable;
	}
	
	$estados = "<option value=\"0\" ".$seleccionado.">Seleccione responsable..</option>";
	
	
	  $query= "SELECT id_usuario,nombre,paterno , up.perfil 
               FROM  usuario u, usuario_perfil up
               WHERE u.id_perfil=up.id_perfil and up.maneja_solicitudes = 1 
			   and id_entidad= '$id_entidad' and u.estado=1
			   order by perfil,nombre,paterno asc";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
  
	while (list($id_responsable,$nombre,$paterno, $perfil_user) = mysql_fetch_row($result)){
		
		    $query= "SELECT count(*)
                   FROM  sgs_solicitud_acceso 
                   WHERE id_responsable='$id_responsable' and id_sub_estado_solicitud not in ($Estados_etapa_fin,$Estados_etapa_respondida,$Estados_pendiente_rectificacion)";
           
			 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
              list($tot_asigaciones) = mysql_fetch_row($result2);
			  
			  
		
		
		if ($id_responsable_seleccionado==$id_responsable){
			$seleccionado = "selected";
		}else{
			$seleccionado = "";
		}
		$estados .= "<option value=\"$id_responsable\" ".$seleccionado.">$nombre $paterno ($perfil_user), $tot_asigaciones solicitudes asignadas</option>";
		}
	
	
	  $query= "SELECT id_usuario,nombre,paterno , up.perfil 
               FROM  usuario u, usuario_perfil up
               WHERE u.id_perfil=up.id_perfil 
			   and up.super_admin= '1' and u.estado=1
			   order by perfil,nombre,paterno asc";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
  
	while (list($id_responsable,$nombre,$paterno, $perfil_user) = mysql_fetch_row($result)){
		
		    $query= "SELECT count(*)
                   FROM  sgs_solicitud_acceso 
                   WHERE id_responsable='$id_responsable' and id_sub_estado_solicitud not in ($Estados_etapa_fin,$Estados_etapa_respondida,$Estados_pendiente_rectificacion)";
           
			 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
              list($tot_asigaciones) = mysql_fetch_row($result2);
			  
			  
		
		
		if ($id_responsable_seleccionado==$id_responsable){
			$seleccionado = "selected";
		}else{
			$seleccionado = "";
		}
		$estados .= "<option value=\"$id_responsable\" ".$seleccionado.">$nombre $paterno ($perfil_user), $tot_asigaciones solicitudes asignadas</option>";
		}
	
	
	
	$responsable = "<select name=\"id_responsable\" id=\"id_responsable\" onblur=\"this.style.width = '350px';\" style=\"width:350px;\">
					".$estados."
				</select>";
	
	 $boton_cancelar = "<input type=\"button\" name=\"button\" id=\"button\" value=\"Cancelar\"  onclick=\"location.href('index.php?accion=$accion');\" />";
	
	 
	 

	
 	  $fecha_inicio2 =  date(Y)."-".date(m)."-".date(d);
	  //$dias = diferencia_entre_fechas($fecha_termino,$fecha_inicio2);
	 // echo "$fecha_inicio2,$fecha_termino";
	   //$dias =calculaDiasHabilesEntreFechas($fecha_inicio2,$fecha_termino);
	   $plazo = saca_plazo($folio,$id_sub_estado_solicitud,$fecha_ingreso);
	  // echo "diassssss $dias";
	 $fecha_termino = fechas_html($fecha_termino);
	 
	 //detalle_solicitud_mis_solcitudes_asignadas_finalizada
	 
	 //$plazo = $dias ."d&iacute;as";
	
	
	    $query= "SELECT id_departamento,departamento 
               FROM  sgs_departamentos
               WHERE id_entidad='$id_entidad'";
         $result= mysql_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_departamento,$departamento) = mysql_fetch_row($result)){
    				$lista_oficinas .="<option value=\"$id_departamento\">$departamento</option>\n";		   
    		 }
	
	 
	   /**************************************/
	   $onClick = "";
	   
	   $asignar = html_template('asignar_responsable');
	   $asignar = cms_replace("#LISTA_OFICINAS#","$lista_oficinas",$asignar);
	  /* $asignar ="<tr>
          <td class=\"alt\">Asignar a:</td>
          <td colspan=\"5\"><div id=\"div_filtros\" style=\"padding-left: 2px; display: none;\">
				<div class=\"semilla\"><input type=\"text\" name=\"filtro_responsable\" id=\"filtro_responsable\">
				Ingrese nombre de Persona</div>
				<div class=\"semilla\"><select name=\"filtro_oficina\" id=\"filtro_oficina\" class=\"filtro_of\">
          				<option value=\"\">---></option>
          				$lista_oficinas
          				</select> Filtro por Oficina
				</div>		
				</div>#RESPONSABLE# <input type=\"checkbox\" id=\"ver_filtros\" name=\"ver_filtros\" value=\"1\">
		  Ver Filtros<br>
          	  
		 	
			
			</td>
        </tr>
     		 <td  align=\"center\" colspan=\"6\">
	  <input type=\"button\" name=\"Aceptar\" id=\"Aceptar\" value=\"Asignar responsable\" class=\"btn btn-success\" onclick=\"validaforma(document.form1); \" /></td>
            </tr>";*/
	   
	  
			
			
			  $query= "SELECT id_categoria   
                           FROM  sgs_solicitud_acceso_categoria
                           WHERE folio='$folio' ";
                     $result_sol_cat= mysql_query($query)or die (error($query,mysql_error(),$php));
                      while(list($id_categorias) = mysql_fetch_row($result_sol_cat)){
					   $query= "SELECT id_categoria,categoria   
                            FROM  sgs_solicitud_categoria
                            WHERE id_categoria ='$id_categorias'";
                      $result_cat= mysql_query($query)or die (error($query,mysql_error(),$php));
                       while (list($id_categoria,$categoria) = mysql_fetch_row($result_cat)){
					   
                 			$lista_categorias_folio .= "<li id=\"id_cat_$id_categoria\" class=\"link_cat\">
									<img src=\"images/not_ok2.gif\" title=\"Borar esta Categoria\" border=\"0\">&nbsp;
									<a href=\"?accion=$accion&act=9&id=$id_categoria&axj=1\" id=\"link_id_cat_$id_categoria\" name=\"Descripci&oacute;n Categoria\"   class=\"jTip\" >$categoria</a>
									 </li> ";		   
                 		 }
					  }	
                    
			
			   
						
						$lista_categorias_folio = "<ul >
						$lista_categorias_folio</ul>
						<div id=\"mensaje_borra\"></div>" ;
						
						$css .="<style>
								#div_categorias ul {
								 
								  list-style-type: none;
								  padding-left: 0;
								}
								#div_categorias li{
									float: left;
									padding : 5px;
									
								}
								#div_categorias ul li a:hover {
								  text-decoration: none;
								
								  
								}
                        </style>";
						
			
			
			   $query= "SELECT id_categoria,categoria  
                FROM  sgs_solicitud_categoria";
          $result= mysql_query($query)or die (error($query,mysql_error(),$php));
           while (list($id_categoria,$categoria ) = mysql_fetch_row($result)){
		  // $categoria = utf8_decode($categoria);
     					$lista_categorias  .="<option value=\"$id_categoria\">$categoria</option>";	   
     		 }
	 
	 
	
	$lista_categorias_folio = "   <table width=\"100%\" border=\"0\"  cellspacing=\"0\" cellpadding=\"0\">
		
		
                <tr>
					<th >Categor&iacute;as de la Solicitud </th>
				</tr>
                   
		  <td  class=\"alt\" >Asignar Categor&iacute;a
		  <select name=\"add_categorias\" id=\"add_categorias\">
     <option value=\"\">Seleccione</option>
     $lista_categorias
     </select> </td>
	 </tr><tr>
	 <td  >
	  <div id=\"div_categorias\" >$lista_categorias_folio</div> 
		
		</td></tr> 
				
				</table>
      
         
         ";
			
			
			/*
			* $add_categorias = $_POST['add_categorias'];
			$folio = $_GET['folio'];
			
			*/
			//$contenido = $add_categorias;
			
			
                		
						
						
					
						
						
	   
	   /***********************************/
	//style=\"padding-left: 2px; display: none;\"
	include("sgs/reemplaza_etiquetas/reemplaza_etiquetas.php");
	
	// $contenido = acentos($contenido);

	 $js .= "<script language=\"JavaScript\">
			function validaforma(theForm){
			theForm.Aceptar.disabled=true;
				if (theForm.id_responsable.value == \"0\"){
					alert(\"Debe Seleccionar al responsable.\");
					theForm.id_responsable.focus();
					theForm.Aceptar.disabled=false;
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
				$(\"#add_categorias\").change(function () {
   						$(\"#add_categorias option:selected\").each(function () {
			
							add_categorias=$(\"#add_categorias\").val();
							filtro_responsable=$(\"#filtro_responsable\").val();
							$.post(\"?accion=$accion&act=8&axj=1&folio=$folio\", { add_categorias: add_categorias}, function(data){
								
								$(\"#div_categorias\").hide();
								$(\"#div_categorias\").delay(200).fadeIn();
								$(\"#div_categorias\").html(data); 
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
	$accion_form = "index.php?accion=$accion&act=2&folio=$folio";
	
	include("sgs/gestion/gestion.php");
	//$template_historial = html_template('linea_estado_solicitud_user_registrado');				
	include("sgs/historial_estado/historial_estado.php");
	
	include ("sgs/solicitudes/formulario.php");
	include("sgs/admin_solicitudes/listado_archivos.php");
	$contenido = cms_replace("#DETALLE_ARCHIVOS#","",$contenido);
	$contenido= cms_replace("#LISTADO_ARCHIVOS#",$lista,$contenido);
	
	
	$contenido = cms_replace("#HISTORIAL#","$template_historial",$contenido);
	//$contenido .= $template_historial;	
	
	
?>