<?php

	$id_estado_solicitud_seleccionado = $_GET['id_estado_solicitud'];
	$buscar = trim($_POST['buscar']);
	//echo "buscar :".$buscar;
	
	$Etapa_fin= configuracion_cms('Estados_etapa_fin');	
	
	
	if ($Etapa_fin=="Estados_etapa_fin no existe"){
	
	    $qry_insert="INSERT INTO cms_configuracion (id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) (id_configuracion,configuracion,valor,descripcion) 
					 values (null,'Estados_etapa_fin','16,17,18,19,20,21,22,23,24','Estas Etapas seran consideradas dentro del js que filtra los id_estados para enviar mensaje de advertencia')";
                    
                      $result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
	$Etapa_fin= configuracion_cms('Estados_etapa_fin');	
	}
	$and .= " and a.id_sub_estado_solicitud  in ($Etapa_fin)";	
	
	if ($buscar !=""){
		$and .= " AND a.folio like '%".$buscar ."%'";
	}

//para poner el filtro de entidad
	/*$id_entidad = $_POST['id_entidad'];
	if (($_POST['id_entidad']=="")&&($_GET['id_entidad']!="")){
		$id_entidad = $_GET['id_entidad'];
	}
	if($id_entidad!="" ){
			$and = $and." AND id_entidad =  '$id_entidad' ";
	}
	*/
	
	$id_user= id_usuario($id_sesion);
	 
	 $query= "SELECT id_entidad 
               FROM  usuario
               WHERE id_usuario='$id_user'";
         $result= mysql_query($query)or die (error($query,mysql_error(),$php));
          if(list($id_entidad_user) = mysql_fetch_row($result)){
		  	$and = $and." AND a.id_entidad =  '$id_entidad_user' ";
		  }
	
	if ($ms=="1"){
		$id_entidad = "";
	}

	$id_entidad_selecionada = $id_entidad;
	$select_entidades = select_lista_entidades($id_entidad_selecionada);

//fin poner filtro entidad	

	$sol_sin_asignar = 0;
	$fecha_sol_mas_antigua = "9999-99-99";
	 
	//sacar el html del contenido
	$contenido = html_template('contenedor_listado_solicitudes_finalizadas');	

	
		//$contenido = ordenar_columnas('sgs_solicitud_acceso').$contenido;
	
	//procesar las solicitudes ingresadas
	$query= "SELECT id_solicitud_acceso,a.folio,fecha_inicio,fecha_termino,id_entidad_padre,id_usuario,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega, a.orden,a.id_estado_solicitud,b.estado_solicitud,id_sub_estado_solicitud,id_responsable,ifnull(c.estado_solicitud,'') estado_padre 
			 FROM  sgs_solicitud_acceso a, sgs_estado_solicitudes b, sgs_estado_solicitudes c
			 WHERE a.id_sub_estado_solicitud = b.id_estado_solicitud  ".$and."
			      and c.id_estado_solicitud = b.id_estado_padre 
			order by $ordenar_datosxx";
			
	
  //echo  "<br>esta: ".$query;
	$result= cms_query($query)or die (error($query,mysql_error(),$php));
			
	$sol_sin_asignar = mysql_num_rows($result);
	
	while (list($id_solicitud_acceso,$fecha_ingreso,$fecha_termino) = mysql_fetch_row($result)){
			if ($fecha_sol_mas_antigua > $fecha_ingreso ) {
				$fecha_sol_mas_antigua = $fecha_ingreso;
			}
			
	}
	
	$fecha_sol_mas_antigua = fechas_html($fecha_sol_mas_antigua);
	
	$tot_registros = $sol_sin_asignar;
	
	//echo "<br>total registros :".$tot_registros;
	
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

	}

	
	if(configuracion_cms('listado_simple')!=1 ){
	$query .= " $limit";
	}
	
		 
      $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 
	  
	   if (mysql_num_rows($result)==0){
	   		if ($buscar !=""){
				$lineas = html_template('lista_vacia_mis_solicitudes_asignador_folio');	
				$lineas = cms_replace("#BUSCAR#",$buscar,$lineas);
				
			}else{
				$lineas = html_template('lista_vacia_mis_solicitudes_asignador');	
			}
			
			$lineas = cms_replace("#COLSPAN#","7",$lineas);
	   }
	  //
	  
	  //
	  while (list($id_solicitud_acceso,$folio,$fecha_ingreso,$fecha_termino,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$orden,$id_estado_solicitud,$estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$estado_padre) = mysql_fetch_row($result)){
	$cont_panel++;
	// echo "$id_solicitud_acceso,$folio,$fecha_ingreso dsfsdfsdf<br>";
	 //	echo "$folio --> $fecha_respuesta,$fecha_ingreso,$fecha_termino <br>";
	 	
	 	//$id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$notificacionXX,$oficina,$id_formato_entrega,$fecha_inicio,$fecha_termino,$orden,$id_estado_solicitud,$estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$estado_solicitud, $estado_padre ,,
	  
	//  while (list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$estado_padre,$fecha_respuesta) = mysql_fetch_row($result)){
          			
			//generar la lista
				
			//	$fecha_inicio = $fecha_ingreso;
			//	$fecha_termino = $fecha_respuesta;
			
			
		$query= "SELECT fecha  
	             FROM  sgs_flujo_estados_solicitud
	             WHERE folio='$folio' and id_estado_solicitud='$id_sub_estado_solicitud' 
				 order by id_flujo_estados_solicitud desc";
				// echo $query;
	      $result_resp= cms_query($query)or die (error($query,mysql_error(),$php));
	       if(list($fecha_respuesta) = mysql_fetch_row($result_resp)){
	       		//$cont++; 
	       	   $plazo ="";
	 				// $fecha_termino = $fecha_respuesta
				$aux=explode("-", $fecha_ingreso);
				$aux1=explode("-", $fecha_respuesta);
								
				if($aux[0]>=2009 and $aux1[0]>=2007){
					//echo $aux[0] ." ".$aux1[0]." $fecha_ingreso,$fecha_respuesta<br> ";
				 	$plazo = calculaDiasHabilesEntreFechas($fecha_ingreso,$fecha_respuesta);
				}else{
					$plazo = "<span style=\"color:#F00\">???</span>";
				}
				
				if (abs($plazo)>1){
					$plazo = $plazo."&nbsp;d&iacute;as";
				}else{
					$plazo = $plazo."&nbsp;d&iacute;a";
				}
	 		   // echo "$cont; $folio ;$fecha_ingreso;$fecha_respuesta ; $plazo<br>";
				 //$plazo = $plazo. " d&iacute;as";
	       	 $fecha_respuesta = fechas_html($fecha_respuesta); 
	       }else{
	       	$random = rand(0,100);
	
	       	$fecha_respuesta="<a href=\"index.php?accion=help&c=problema_fecha&width=320&axj=1\" class=\"jTip\" id=\"$random\" name=\"Problemas con calculo de fecha\">
	<font color=\"#FF0000\">???</font></a>";
	$random = rand(100,300);
	       	$plazo =  "<a href=\"index.php?accion=help&c=problema_fecha&width=320&axj=1\" class=\"jTip\" id=\"$random\" name=\"Problemas con calculo de fecha\">
	<font color=\"#FF0000\">???</font></a>";
	       }
					$dias=""; 
				$aux=explode("-", $fecha_ingreso);
				$aux1=explode("-", $fecha_termino);
				
				if($aux[0]>2007 and $aux1[0]>2007){
						$dias = calculaDiasHabilesEntreFechas($fecha_ingreso,$fecha_termino);
				}
				
				
				

				$lista_mis_solicitudes = html_template('linea_lista_solicitudes_finalizadas');
				//echo "$folio $fecha_ingreso<br>";
				
				 $fecha_ingreso= fechas_html($fecha_ingreso);
					
				 $fecha_termino = fechas_html($fecha_termino);
				
				$link_editar = "?accion=$accion&act=1&folio=$folio";
				
				if($cambia_color ==1){
					$clase= "class=\"alternate\"";
					$cambia_color=0;
				}else{
					$clase="";
					$cambia_color=1;
				}

				
								
				$lista_mis_solicitudes = cms_replace("#INTERLINEADO#","$clase",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#FOLIO#","$folio",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#FECHA_RESPUESTA#","$fecha_respuesta",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#FECHA_INGRESO#","$fecha_ingreso",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#FECHA_TERMINO#","$fecha_termino",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#DIAS# ","$plazo",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#ESTADO#",acentos($estado_solicitud),$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#LINK#","$link_editar",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#ESTADO_PADRE#",acentos($estado_padre),$lista_mis_solicitudes);
				
				
				$lineas .=$lista_mis_solicitudes;
				
			}
		

	
	if ($sol_sin_asignar > 0 ){
		//template de mensaje de solicitudes sin asignar
		$mensaje_sin_asignar = html_template('mensaje_cantidad_solicitudes_responsable');
		//$contenido = cms_replace("#MENSAJE_SIN_ASIGNAR#",$mensaje_sin_asignar,$contenido);
		$contenido = cms_replace("#MENSAJE_SIN_ASIGNAR#","",$contenido);
		//$contenido = cms_replace("#TOTAL_SOLICITUDES_SIN_ASIGNAR#",$sol_sin_asignar,$contenido);
		$contenido = cms_replace("#TOTAL_SOLICITUDES_SIN_ASIGNAR#","",$contenido);
		//$contenido = cms_replace("#FECHA_MAS_ANTIGUA#",$fecha_sol_mas_antigua,$contenido);
		$contenido = cms_replace("#FECHA_MAS_ANTIGUA#","",$contenido);
		
		$estado_glosa =  html_template('estado_glosa_asignador');
		$contenido = cms_replace("#ESTADO_GLOSA#",$estado_glosa,$contenido);
		
		
	}else{
		$mensaje_sin_asignar = html_template('mensaje_vacio_solicitudes_asignador');
		$contenido = cms_replace("#MENSAJE_SIN_ASIGNAR#","",$contenido);
	
	}
	
	
	
	
	//reeemplazar la lista en la etiqueta del contenedor
	$contenido = cms_replace("#LISTA_ADMINISTRACION_SOLICITUDES#","$lineas",$contenido);
	
	
	
	//llenar el combobox de estados
	$query= "SELECT id_estado_solicitud,
					estado_solicitud
			 FROM  sgs_estado_solicitudes";
	$result= cms_query($query)or die (error($query,mysql_error(),$php));
	
	if ($id_estado_solicitud_seleccionado==0){
			$seleccionado = "selected";
	}else{
		$seleccionado = "";
	}
	  
	$estados = "<option value=\"?accion=$accion&id_estado_solicitud=\" ".$seleccionado.">Todas</option>";
	while (list($id_estado_solicitud,$estado_solicitud) = mysql_fetch_row($result)){
		if ($id_estado_solicitud_seleccionado==$id_estado_solicitud){
			$seleccionado = "selected";
		}else{
			$seleccionado = "";
		}
		$estados .= "<option value=\"?accion=$accion&id_estado_solicitud=$id_estado_solicitud\" ".$seleccionado.">".$estado_solicitud."</option>";
		}
	
	$filtro = "	<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">
					".$estados."
				</select>";
	
	$contenido = cms_replace("#FILTROS#","$filtro",$contenido);
	$contenido = cms_replace("#ACCION#","$accion",$contenido);
	$contenido = cms_replace("#FILTRO_ENTIDADES#","$select_entidades",$contenido);
	
	
	//pagina
	
	//paginacion
	

			$contenido = cms_replace("#CANT_PAGINAS#",$paginas, $contenido);
			$contenido = cms_replace("#PAGINACION#","$paginacion", $contenido);
			
		
		
		
		
		
		
			$tabla_mis_solicitudes ="<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"table1\" class=\"tinytable\" align=\"left\">
    		  <thead>
				<tr>
                  
                        <th width=\"110\" align=\"center\"><h3>Folio</h3></th>
                        <th align=\"center\"><h3>Fecha  Solicitud</h3></th>
                        <th align=\"center\"><h3>Fecha estimada de T&eacute;rmino</h3></th>
                        <th  align=\"center\" title=\"Fecha de cierre de solicitud\"><h3>Fecha Finalizaci&oacute;n </h3>
						</th>
                        <th align=\"center\" width=\"70\"><h3>Plazo<a href=\"index.php?accion=help&c=plazo-solicitude-finalizadas&width=320&axj=1\" class=\"jTip\" id=\"Plazo_termino\" name=\"Plazo de t&eacute;rmino de solicitud\"><img src=\"images/help.png\" alt=\"\" border=\"0\" class=\"valign\"></a></h3></th>
                        <th align=\"center\" width=\"190\"><h3>Estado</h3></th>
                        <th  align=\"center\" class=\"nosort\"><h3>Ver</h3></th>
                       
                </tr>
			 </thead>
			  <tbody>
                $lineas
              </tbody>
        </table>";
		
//$tabla = crea_tabla_tiny($tabla_mis_solicitudes);




			
	


		if(configuracion_cms('listado_simple')){
		
		   $tabla = crea_tabla_tiny($tabla_mis_solicitudes);
		}else{
		  $tabla = $tabla_mis_solicitudes;
		}



$contenido = $tabla."<br><br><br><br><br><br><br><br><br><br><br><br><br>";


?>