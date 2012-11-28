<?php

	$Etapa_fin = configuracion_cms('Etapa_fin');
	$id_estado_solicitud_seleccionado = $_GET['id_estado_solicitud'];
	$buscar =  trim($_POST['buscar']);
	//echo "buscar :".$buscar;
	
	$and = " ";
	
	if ($buscar !=""){
		$and .= " AND folio like '%".$buscar ."%'";
	}

	//para poner el filtro de entidad
	$id_entidad = $_POST['id_entidad'];
	if (($_POST['id_entidad']=="")&&($_GET['id_entidad']!="")){
	
	     
	
		$id_entidad = $_GET['id_entidad'];
	}elseif($_POST['id_entidad']==""){
	$id_user= id_usuario($id_sesion);
	 /*
	 $query= "SELECT id_entidad 
               FROM  usuario
               WHERE id_usuario='$id_user'";
         $result= mysql_query($query)or die (error($query,mysql_error(),$php));
          if(list($id_entidad) = mysql_fetch_row($result)){
		  	$and = $and." AND id_entidad =  '$id_entidad' ";
		  }
		  * */
		//echo $query."<br>";
		//echo $id_entidad."<br>";
		
		 $query= "SELECT id_entidad ,up.super_admin
               FROM  usuario u, usuario_perfil up
               WHERE u.id_usuario='$id_user' and u.id_perfil=up.id_perfil";
         $result= mysql_query($query)or die (error($query,mysql_error(),$php));
          if(list($id_entidad,$super_admin) = mysql_fetch_row($result)){
		 	 if($super_admin==0){
		  		$and = $and." AND id_entidad =  '$id_entidad' ";
		  	$id_entidad_selecionada = $id_entidad;
			$select_entidades = select_lista_entidades($id_entidad_selecionada);
			}
//
		  }
	}
	
	
	
	//if($id_entidad!="" ){
			
//	}
	if ($ms=="1"){
		$id_entidad = "";
	}

	fin poner filtro entidad	

	
	
	$sol_sin_asignar = 0;
	$fecha_sol_mas_antigua = "9999-99-99";
	 
	//sacar el html del contenido
	$contenido = html_template('contenedor_listado_solicitudes_sin_asignar');	
	



	//procesar las solicitudes ingresadas
	$query= "SELECT id_solicitud_acceso,
					fecha_inicio,
					fecha_termino,
					folio,
					id_entidad,
					id_entidad_padre,
					id_usuario,
					identificacion_documentos,
					notificacion,
					id_forma_recepcion,
					oficina,
					id_formato_entrega, fecha_inicio,
					fecha_termino,
					a.orden,
					a.id_estado_solicitud,
					b.estado_solicitud,
					id_sub_estado_solicitud,
					id_responsable,
                   ifnull(c.estado_solicitud,'') estado_padre     
			FROM  sgs_solicitud_acceso a, sgs_estado_solicitudes b, sgs_estado_solicitudes c
			WHERE a.id_sub_estado_solicitud = b.id_estado_solicitud 
			AND a.id_responsable = 0 and a.id_estado_solicitud=1 ".$and."
			      and c.id_estado_solicitud = b.id_estado_padre 
			order by fecha_termino asc ";
			
			//echo $query;
	$result= cms_query($query)or die (error($query,mysql_error(),$php));
			
	$sol_sin_asignar = mysql_num_rows($result);
	
	while (list($id_solicitud_acceso,$fecha_ingreso,$fecha_termino) = mysql_fetch_row($result)){
	
			if ($fecha_sol_mas_antigua > $fecha_ingreso ) {
				$fecha_sol_mas_antigua = $fecha_ingreso;
			}
			
	}
	
	$fecha_sol_mas_antigua = fechas_html($fecha_sol_mas_antigua);
	
	
	
	$tot_registros = $sol_sin_asignar;
	$reg_por_pagina =configuracion_cms('registros_por_pagina');
	
	$cant_pag = ($tot_registros/$reg_por_pagina);
	
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

	//procesar consulta busqueda
	 if(configuracion_cms('listado_simple')==0 ){
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
	  
	  while (list($id_solicitud_acceso,$fecha_ingreso,$fecha_termino,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$estado_padre) = mysql_fetch_row($result)){
          			
			//generar la lista
				$lista_mis_solicitudes = html_template('linea_lista_administracion_solicitudes_asignacion');
				
				 $fecha_ingreso= fechas_html($fecha_ingreso);
					
				 $fecha_termino = fechas_html($fecha_termino);
				 
				
					$dias = diferencia_entre_fechas($fecha_termino,$fecha_ingreso);
				
				
				
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
				$lista_mis_solicitudes = cms_replace("#FECHA_INGRESO#","$fecha_ingreso",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#FECHA_TERMINO#","$fecha_termino",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#DIAS# ","$dias ",$lista_mis_solicitudes);
				//$lista_mis_solicitudes = cms_replace("#ESTADO#",acentos($estado_solicitud),$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#LINK#","$link_editar",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#ESTADO_PADRE#",acentos($estado_padre),$lista_mis_solicitudes);
				
				$lineas .=$lista_mis_solicitudes;
				
			}
		
	
	
	if ($sol_sin_asignar > 0 ){
		//template de mensaje de solicitudes sin asignar
		$mensaje_sin_asignar = html_template('mensaje_cantidad_solicitudes_responsable');
		$contenido = cms_replace("#MENSAJE_SIN_ASIGNAR#",$mensaje_sin_asignar,$contenido);
		$contenido = cms_replace("#TOTAL_SOLICITUDES_SIN_ASIGNAR#",$sol_sin_asignar,$contenido);
		$contenido = cms_replace("#FECHA_MAS_ANTIGUA#",$fecha_sol_mas_antigua,$contenido);
		
		$estado_glosa =  html_template('estado_glosa_asignador');
		$contenido = cms_replace("#ESTADO_GLOSA#",$estado_glosa,$contenido);
		
		
	}else{
		$mensaje_sin_asignar = html_template('mensaje_vacio_solicitudes_asignador');
		$contenido = cms_replace("#MENSAJE_SIN_ASIGNAR#",$mensaje_sin_asignar,$contenido);
	
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
	$contenido = cms_replace("#FILTRO_ENTIDADES#","$select_entidades",$contenido);

	$contenido = cms_replace("#ACCION#","$accion",$contenido);
	$contenido = cms_replace("#CANT_PAGINAS#",$paginas, $contenido);
	$contenido = cms_replace("#PAGINACION#","$paginacion", $contenido);

	
	if(configuracion_cms('listado_simple')){
		
		
		
		
			$tabla_mis_solicitudes ="<table width=\"98%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"table1\" class=\"tinytable\" align=\"left\">
    		  <thead>
				<tr>
                  
                        <th width=\"160\"><h3>Folio</h3></th>
                        <th width=\"120\" ><h3>Fecha de Ingreso</h3></th>
                        <th width=\"190\" ><h3>Fecha estimada de T&eacute;rmino</h3></th>
                        <th width=\"80\" title=\"Fecha de cierre de solicitud\"><h3>Plazo<a href=\"index.php?accion=help&c=plazo-solicitude-finalizadas&width=320&axj=1\" class=\"jTip\" id=\"Plazo_termino\" name=\"Plazo de t&eacute;rmino de solicitud\"><img src=\"images/help.png\" alt=\"\" border=\"0\"></a></h3></th>
                        
                        <th width=\"60\" ><h3>Estado</h3></th>
                        <th  class=\"nosort\"><h3>Editar</h3></th>
                       
                </tr>
			 </thead>
			  <tbody>
                $lineas
              </tbody>
        </table>";
		
$tabla = crea_tabla_tiny($tabla_mis_solicitudes);


$contenido =   "<table width=\"95%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr><td align=\"left\" class=\"textos\"><h3>Asignar solicitudes</h3></td></tr> 
				 <tr>
                   <td align=\"center\" class=\"textos\">$tabla</td>
                   </tr>
             	</table><br><br><br><br><br><br><br><br><br><br><br><br>";
			
}
	
?>