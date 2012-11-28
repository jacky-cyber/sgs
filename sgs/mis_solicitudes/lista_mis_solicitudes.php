<?php

$buscar = $_POST['buscar'];

if($buscar!=""){
$condicion = " and folio like '%$buscar%' ";
}
    	$id_usuario = id_usuario($id_sesion);
		$rectificaciones = "";
		$lista_mis_solicitudes_rectificadas = "";
		if(!configuracion_cms('listado_simple')){
				$contenido = html_template('contenedor_lista_mis_solicitudes');	
			}else{
				$contenido = html_template('contenedor_lista_mis_solicitudes2');	
			}
		

		//$tot_registros = total_tabla('sgs_solicitud_acceso',$condicion);
		$Etapa_fin = configuracion_cms('Etapa_fin');
		$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
		//width=\"300\"
		$formulario_folio="  <table   border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                               <tr >
                                 <td align=\"center\" class=\"textos\">&nbsp;</td>
                                 </tr>
                           	</table>";
		
		if($Etapa_fin=="Etapa_fin no existe"){
			$qry_insert="INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (null, 'Etapa_fin', '13', '<p>Representa el estado de finalizacion de una solicitud con esto verificamos el&nbsp;ID si la solicutud tiene estado ID la sacamos de la lista</p>', 0, 14, 0, 0);";
			$result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
		}
		
		if($Estados_pendiente_rectificacion == "Estados_pendiente_rectificacion no existe"){
			$qry_insert="INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) VALUES (null,'Estados_pendiente_rectificacion','5','',0,0,0,0);";
			$result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
			
			$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
		}
		
		$aEstadosRectificacion = split(",",$Estados_pendiente_rectificacion);
	
		
		//and id_estado_solicitud <>$Etapa_fin
	   $query= "SELECT id_solicitud_acceso,folio,id_entidad,id_entidad_padre,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable     
                     FROM  sgs_solicitud_acceso
					 where id_usuario= $id_usuario 
					 and id_sub_estado_solicitud not in ($Estados_pendiente_rectificacion) 
					 $condicion
					 order by fecha_termino asc ";
		echo $query;
		if(!configuracion_cms('listado_simple')){
		
		$result= cms_query($query)or die (error($query,mysql_error(),$php));
		
		
		//list($tot_registros) = mysql_fetch_row($result);
		$tot_registros = mysql_num_rows($result);
		
		//echo $tot_registros;
		$reg_por_pagina =configuracion_cms('registros_por_pagina');	
		$cant_pag = ceil($tot_registros/$reg_por_pagina);
		
		$cant_pag = ceil($cant_pag);
		
		if($cant_pag > 0){
		$p = $_GET['p'];
		if($p=="" ){
		$p=0;
		$limit = "limit 0,$reg_por_pagina";
		}else{
		$p2= ($p-1)*$reg_por_pagina;
		
		$limit = "limit $p2,$reg_por_pagina";
		}
			
		
		$pt = $cant_pag; //Numero total de paginas
        $pa = $p; //Pagina en la que estamos ( $_GET['pagina'] )
        $link = "<a href=\"index.php?accion=$accion&act=$act&p={P}\">"; //Link que queremos ocupar en nuestro paginador
   		
		$paginas ="";
		if ($cant_pag > 1){
			if ($pa==0){
				$pa = 1;
			}
			$paginas = "P&aacute;gina $pa de $cant_pag";
		}
		$paginacion =Paginacion($pt,$pa,$link);
		
		}else{ 
		
		$paginas = "";
		$paginacion ="";
		
		}

		//Verificar los plazos estados de las solicitudes
		
		/*******************************************/
		$resultado_int = Verifica_plazo_estado($Estados_pendiente_rectificacion,$id_usuario);
		


//and id_estado_solicitud <> $Etapa_fin y distinta de los pendiente de rectificacion
	
	
				$query .= " $limit";
			}
	
		//$query .= $limit;
		$result= cms_query($query)or die (error($query,mysql_error(),$php));
		

			//order by fecha_inicio desc
			
            
			
		   
			   if (mysql_num_rows($result)==0){
			   		$lineas = html_template('lista_vacia_mis_solicitudes');	
					$lineas = cms_replace("#COLSPAN#","6",$lineas);

			   }
               while (list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable) = mysql_fetch_row($result)){
          				$cont_soli++;
						$lista_mis_solicitudes = html_template('linea_lista_mis_solicitudes');	
						$link_editar = "?accion=$accion&act=1&folio=$folio";
						
						$fecha_ingreso= fechas_html($fecha_ingreso);
						$fecha_termino = fechas_html($fecha_termino);
						$fecha_ingreso2 =  date(d)."-".date(m)."-".date(Y);
						 	
						$dias = diferencia_entre_fechas($fecha_termino,$fecha_ingreso2);
						$lista_mis_solicitudes = cms_replace("#FECHA_TERMINO#","$fecha_termino",$lista_mis_solicitudes);
/***********************/
				//echo "<br>id_sub_estado_solicitud:".$id_sub_estado_solicitud ; 
				if (($id_sub_estado_solicitud >=13)&&($id_sub_estado_solicitud != 26)){//estados retiro pendiente y pago pendiente, se procesan aca  para parar el tiempo ya que no saltan a la bandeja de solicitudes finalizadas
					//echo "<br>entra a finalizada";
					//echo "fecha inicio: ".$fecha_ingreso;
					$fecha_inicio= fechas_bd($fecha_ingreso);
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
							if (abs($dias) > 1)  {
								$dias = $dias."&nbsp; d&iacute;as";
							}else{
								$dias = $dias."&nbsp; d&iacute;a";
							}
							$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
							$dias = "$estado_solicitud <br>en ".$dias;
					}else{
						$dias = "<span style=\"color:#Ff0000\">???</span>";
					}
							
					
				}else{

/***********************/
						
					
						if ($dias != "<span style=\"color:#Ff0000\">???</span>"){
							if (abs($dias) > 1)  {
								$dias = $dias."&nbsp; d&iacute;as";
							}else{
								$dias = $dias."&nbsp; d&iacute;a";
							}
						}
				}
								
						
						$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
						
						$glosa_estado_encontrado = Encuentra_estado($id_sub_estado_solicitud,$aEstadosRectificacion); 
						if ($glosa_estado_encontrado!=""){
							$glosa_link = "RECTIFICAR";
							$fecha_termino = "&nbsp;";
							$dias = "&nbsp;";
							
							
							//completar las rectificaciones
							$lista_mis_solicitudes_rectificadas = html_template('linea_lista_mis_solicitudes_rectificadas');	
							$lista_mis_solicitudes_rectificadas = cms_replace("#FOLIO#","$folio",$lista_mis_solicitudes_rectificadas);
							$lista_mis_solicitudes_rectificadas = cms_replace("#FECHA_INGRESO#","$fecha_ingreso",$lista_mis_solicitudes_rectificadas);
							$lista_mis_solicitudes_rectificadas = cms_replace("#LINK_EDITAR#","$link_editar",$lista_mis_solicitudes_rectificadas);
							$lista_mis_solicitudes_rectificadas = cms_replace("#GLOSA_LINK#","$glosa_link",$lista_mis_solicitudes_rectificadas);
							$dias_rectificar = Calcula_plazo_rectificar($folio);
							$lista_mis_solicitudes_rectificadas = cms_replace("#DIAS#","$dias_rectificar",$lista_mis_solicitudes_rectificadas);

							$linea_lista_mis_solicitudes_rectificadas = $linea_lista_mis_solicitudes_rectificadas. $lista_mis_solicitudes_rectificadas;
							// FIN completar las rectificaciones
							
						}else{
							$glosa_link = "VER DETALLE";
						}
						
						if ($glosa_link == "VER DETALLE"){
							$estado_solicitud = acentos($estado_solicitud.$glosa_estado_encontrado);
							$lista_mis_solicitudes = cms_replace("#FOLIO#","$folio",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#FECHA_CREACION#","$fecha_ingreso",$lista_mis_solicitudes);
							//$lista_mis_solicitudes = cms_replace("#FECHA_TERMINO#","$fecha_termino",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#ESTADO#","$estado_solicitud",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#LINK_EDITAR#","$link_editar",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#DIAS#","$dias",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#GLOSA_LINK#","$glosa_link",$lista_mis_solicitudes);
							
							
							if($cambia_color ==1){
								$clase= "class=\"alternate\"";
								$cambia_color=0;
							}else{
								$clase="";
								$cambia_color=1;
							}
									  
							$lista_mis_solicitudes = cms_replace("#CLASE_TR#","$clase",$lista_mis_solicitudes);
							
							
							$lineas .=$lista_mis_solicitudes;
						
						}
						
						 
          		 }
		
		
/***************************************************************************************************************/				 
//listar las solicitudes rectificadas
$id_usuario = id_usuario($id_sesion);
	   $query2= "SELECT id_solicitud_acceso,folio,id_entidad,id_entidad_padre,id_usuario,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable     
	                 FROM  sgs_solicitud_acceso
					 where id_usuario= $id_usuario 
					 and id_sub_estado_solicitud in ($Estados_pendiente_rectificacion)
					 order by fecha_inicio desc ";

		$result_rec= cms_query($query2)or die (mysql_error());//(error($query,mysql_error(),$php));
		
	   while (list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable) = mysql_fetch_row($result_rec)){
				
				
				$lista_mis_solicitudes = html_template('linea_lista_mis_solicitudes');	
				$link_editar = "?accion=$accion&act=1&folio=$folio";
				
				$fecha_ingreso= fechas_html($fecha_ingreso);
				$fecha_termino = fechas_html($fecha_termino);
				$fecha_ingreso2 =  date(d)."-".date(m)."-".date(Y);
				
				
//$dias = diferencia_entre_fechas($fecha_termino,$fecha_ingreso2);

				
				if (abs($dias) > 1)  {
					$dias = $dias."&nbsp; d&iacute;as";
				}else{
					$dias = $dias."&nbsp; d&iacute;a";
				}
						
				
				$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
				$fecha_peticion_rectificacion = Recupera_fecha_ultimo_estado($folio);
				
				$glosa_estado_encontrado = Encuentra_estado($id_sub_estado_solicitud,$aEstadosRectificacion); 
				if ($glosa_estado_encontrado!=""){
					$glosa_link = "RECTIFICAR";
					$fecha_termino = "&nbsp;";
					$dias = "&nbsp;";
					
					
					//completar las rectificaciones
					$lista_mis_solicitudes_rectificadas = html_template('linea_lista_mis_solicitudes_rectificadas');	
					$lista_mis_solicitudes_rectificadas = cms_replace("#FOLIO#","$folio",$lista_mis_solicitudes_rectificadas);
					$lista_mis_solicitudes_rectificadas = cms_replace("#FECHA_INGRESO#","$fecha_ingreso",$lista_mis_solicitudes_rectificadas);
					$lista_mis_solicitudes_rectificadas = cms_replace("#FECHA_PETICION_RECTIFICACION#","$fecha_peticion_rectificacion",$lista_mis_solicitudes_rectificadas);
					$lista_mis_solicitudes_rectificadas = cms_replace("#LINK_EDITAR#","$link_editar",$lista_mis_solicitudes_rectificadas);
					$lista_mis_solicitudes_rectificadas = cms_replace("#GLOSA_LINK#","$glosa_link",$lista_mis_solicitudes_rectificadas);
					
					/**/
					$dias_rectificar = Calcula_plazo_rectificar($folio);
					/**/
					
					$lista_mis_solicitudes_rectificadas = cms_replace("#DIAS#","$dias_rectificar",$lista_mis_solicitudes_rectificadas);

					$linea_lista_mis_solicitudes_rectificadas = $linea_lista_mis_solicitudes_rectificadas. $lista_mis_solicitudes_rectificadas;
					// FIN completar las rectificaciones
					
				}					
				 
		 }

//fin las solicitudes rectificadas
		
		
	
	if(configuracion_cms('listado_simple')){
		

		
		
			$tabla_mis_solicitudes ="<table width=\"98%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"table1\" class=\"tinytable\" align=\"left\">
    		  <thead>
			            <tr >
        					<th width=\"18%\"><h3>N&ordm; de Solicitud</h3></th>
        					<th width=\"18%\"><h3>Fecha Solicitud</h3></th>
        					<th width=\"24%\"><h3>Fecha estimada de T&eacute;rmino</h3></th>
        					<th width=\"14%\"><h3>Plazo<a href=\"index.php?accion=help&c=Help-plazo-solicitante&width=320&axj=1\" class=\"jTip\" id=\"Plazo_termino\" name=\"Plazo de t&eacute;rmino de solicitud\"><img src=\"images/help.png\" alt=\"\" border=\"0\"></a></h3></th>
        					<th width=\"14%\"><h3>Estado</h3></th>
        					<th width=\"12%\" class=\"nosort\"><h3>&nbsp;</h3></th>
      				  </tr>
           </thead>
			  <tbody>
                $lineas
              </tbody>
        </table>";
		
	if($cont_soli>0){
	$lineas = crea_tabla_tiny($tabla_mis_solicitudes);
	}else{
	$lineas = $tabla_mis_solicitudes;
	}	




			
} 

   if ($linea_lista_mis_solicitudes_rectificadas != ""){
			$rectificaciones = html_template('contenedor_lista_mis_solicitudes_rectificadas');	
			$rectificaciones = cms_replace("#REGISTROS_RECTIFICACIONES#","$linea_lista_mis_solicitudes_rectificadas", $rectificaciones);
		}
			//echo $rectificaciones;	
		$contenido = cms_replace("#CANT_PAGINAS#",$paginas, $contenido);
		$contenido = cms_replace("#PAGINACION#","$paginacion", $contenido);
		$contenido = cms_replace("#RECTIFICACIONES#","$rectificaciones", $contenido);
		$contenido = cms_replace("#LINEAS_MIS_SOLICITUDES#","$lineas",$contenido);
?>