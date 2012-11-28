<?php



	$id_usuario = id_usuario($id_sesion);
//$condicion = " and id_estado_solicitud = 1 ";
	$id_estado_solicitud_seleccionado = $_POST['id_estado_solicitud'];
	
	if (($_POST['id_estado_solicitud']=="")&&($_GET['id_estado_solicitud']!="")){
	$id_estado_solicitud_seleccionado = $_GET['id_estado_solicitud'];
	}
	
	
	$buscar =  trim($_POST['buscar']);
	//echo "buscar :".$buscar;
	
	if ($id_estado_solicitud_seleccionado !="" ){
		 $and = " AND a.id_estado_solicitud =".$id_estado_solicitud_seleccionado ;
	}
	if ($buscar !=""){
		$and .= " AND folio like '%".$buscar ."%'";
	}
	
	$ms = $_POST['ms'];
	if (($_POST['ms']=="")&&($_GET['ms']!="")){
		$ms = $_GET['ms'];
	}
	

	//filtrar las solicitudes en estado de rectificacion
	$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
	
	//Verificar los plazos estados de las solicitudes
	//echo "$Estados_pendiente_rectificacion,$id_usuario<br>";
	//if($tp==2){
	$resultado_int = Verifica_plazo_estado($Estados_pendiente_rectificacion,$id_usuario);
	//}
	

	
	if ($ms=="1"){
		$condicion_mis_solicitudes = " and id_responsable=$id_usuario  and  a.id_sub_estado_solicitud in ($Estados_pendiente_rectificacion)";
		
	}else{
		$condicion_mis_solicitudes = "";
	}
	
	$Estados_etapa_fin= configuracion_cms('Estados_etapa_fin');	
	
	$and .= " and a.id_sub_estado_solicitud in ($Estados_pendiente_rectificacion)";
	
	$condicion = " and a.id_sub_estado_solicitud in ($Estados_pendiente_rectificacion)";
	
	$tipo = $_POST['tipo'];
	
	if($tipo!="" ){
			//$and = $and." AND folio like '%$tipo-%'";
	}
	
	
	
	
	
	if (($_POST['tipo']=="")&&($_GET['tipo']!="")){
		$tipo = $_GET['tipo'];
	}
	
	$tipo_seleccionado = $tipo;
	
	
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
	

	
	$id_responsable_seleccionado = $_POST['id_responsable'];
	if (($_POST['id_responsable']=="")&&($_GET['id_responsable']!="")){
		$id_responsable_seleccionado = $_GET['id_responsable'];
	}
	
	
	if($id_responsable_seleccionado!="" ){
			$and = $and ." AND id_responsable = '$id_responsable_seleccionado'";
	}
	
	$sol_sin_asignar = 0;
	$fecha_sol_mas_antigua = "9999-99-99";
	 
	//sacar el html del contenido
	$contenido = html_template('contenedor_listado_solicitudes_rectificadas');	
	
	//procesar las solicitudes ingresadas
	//como es el panel del reponsable debe contar las solcitudes que aun estan en estado ingresadas id_estado=1
	$query= "SELECT id_solicitud_acceso, fecha_inicio,
					fecha_termino					
			FROM  sgs_solicitud_acceso 
			WHERE id_responsable > 0 
				and id_estado_solicitud = 1
				
			order by fecha_inicio asc";
	//echo "<br> dos: ".$query."<br>";
	$result= cms_query($query)or die (error($query,mysql_error(),$php));
			
	$sol_sin_asignar = mysql_num_rows($result);
	
	while (list($id_solicitud_acceso,$fecha_ingreso,$fecha_termino) = mysql_fetch_row($result)){
			if ($fecha_sol_mas_antigua > $fecha_ingreso ) {
				$fecha_sol_mas_antigua = $fecha_ingreso;
			}
			
	}
	$fecha_sol_mas_antigua = fechas_html($fecha_sol_mas_antigua);
	
	//procesar consulta busqueda
	$query= "SELECT id_solicitud_acceso, 
			   folio, 
			   id_entidad, 
			   id_entidad_padre, 
			   id_usuario, 
			   identificacion_documentos, 
			   notificacion, id_forma_recepcion, 
			   oficina, 
			   id_formato_entrega, fecha_inicio, 
			   fecha_termino, 
			   a.orden, 
			   a.id_estado_solicitud, 
			   b.estado_solicitud as estado_padre, 
			   id_sub_estado_solicitud, 
			   id_responsable, ifnull(c.estado_solicitud,'') estado_solicitud 
			FROM  sgs_solicitud_acceso a, sgs_estado_solicitudes b, sgs_estado_solicitudes c
			WHERE a.id_estado_solicitud = b.id_estado_solicitud  ".$and."
			      and c.id_estado_solicitud = a.id_sub_estado_solicitud
				  and id_responsable > 0 $condicion_mis_solicitudes
			order by $ordenar_datosxx";
			
		
		//echo "<br> ".$query."<br><br><br>";
			
    $result= cms_query($query)or die (error($query,mysql_error(),$php));//(error($query,mysql_error(),$php));

	$tot_registros = mysql_num_rows($result);
	
	
	
	$reg_por_pagina = configuracion_cms('registros_por_pagina');
	
	$cant_pag = ceil($tot_registros/$reg_por_pagina);
	
	
	//echo "<br>cantidad_paginas: ".$cant_pag ;

	if($cant_pag > 0){
		$p = $_GET['p'];
		if($p=="" ){
		$p=0;
		$limit = "limit 0,$reg_por_pagina";
		}else{
		$p2= ($p-1)*$reg_por_pagina;
		
		 $limit = "limit $p2,$reg_por_pagina";
		}
		
	  //procesar consulta busqueda
	  
	    if(!configuracion_cms('listado_simple') ){
			$query .= " $limit";
		}
			
			
      $result= cms_query($query)or die (error($query,mysql_error(),$php));//(error($query,mysql_error(),$php));

		
		
		
		
		$pt = $cant_pag; //Numero total de paginas
		$pa = $p; //Pagina en la que estamos ( $_GET['pagina'] )
		$link = "<a href=\"index.php?accion=$accion&act=$act&p={P}&id_responsable=$id_responsable_seleccionado&tipo=$tipo&id_estado_solicitud=$id_estado_solicitud&ms=$ms\">"; //Link que queremos ocupar en nuestro paginador
		
		$paginas ="";
		if ($cant_pag > 1){
			if ($pa==0){
				$pa = 1;
			}
			$paginas = "P&aacute;gina $pa de $cant_pag";
		}

		$paginacion =Paginacion($pt,$pa,$link);

	}
	   //echo "<br>num registros: ".mysql_num_rows($result);
	   if ($tot_registros==0){
	   		if ($buscar !=""){
				$lineas = html_template('lista_vacia_mis_solicitudes_responsable_folio');	
				$lineas = cms_replace("#BUSCAR#",$buscar,$lineas);
				
			}else{
				$lineas = html_template('lista_vacia_mis_solicitudes_responsable');	
			}
			
			$lineas = cms_replace("#COLSPAN#","7",$lineas);
	   }
	  
	  $lineas = "";
	  if ( mysql_num_rows($result) ==0){
		  $colspan = 5;
		  $mensaje = html_template('mensaje_sin_registros_rectificar_solicitante');
		  $registro = Coloca_registro_vacio($colspan,$mensaje);
		  $linea_lista_mis_solicitudes_rectificadas = $registro;		  
	  }
	  
	  while (list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$estado_padre) = mysql_fetch_row($result)){
          			
				$cont_panel++;
				$fecha_ingreso= fechas_html($fecha_ingreso);
				$fecha_peticion_rectificacion = Recupera_fecha_ultimo_estado($folio);
				
				if($cambia_color ==1){
					$clase= "class=\"alternate\"";
					$cambia_color=0;
				}else{
					$clase="";
					$cambia_color=1;
				}
				
				$link_editar = "?accion=$accion&act=1&folio=$folio";
				$tipo = trim(substr($folio, 5, 1));
				if ($tipo=="W"){
					$glosa_link = "VER DETALLE";
				}else{
					$glosa_link = "RECTIFICAR";
				}
				//$lista_mis_solicitudes = asigna_etiquetas('linea_lista_administracion_solicitudes');
				$lista_mis_solicitudes_rectificadas = html_template('linea_lista_mis_solicitudes_rectificadas');	
				$lista_mis_solicitudes_rectificadas = cms_replace("#FOLIO#","$folio",$lista_mis_solicitudes_rectificadas);
				$lista_mis_solicitudes_rectificadas = cms_replace("#FECHA_INGRESO#","$fecha_ingreso",$lista_mis_solicitudes_rectificadas);
				$lista_mis_solicitudes_rectificadas = cms_replace("#FECHA_PETICION_RECTIFICACION#","$fecha_peticion_rectificacion",$lista_mis_solicitudes_rectificadas);

				$lista_mis_solicitudes_rectificadas = cms_replace("#LINK_EDITAR#","$link_editar",$lista_mis_solicitudes_rectificadas);
				$lista_mis_solicitudes_rectificadas = cms_replace("#GLOSA_LINK#","$glosa_link",$lista_mis_solicitudes_rectificadas);
				
				//if($tp==2){
				$dias_rectificar = Calcula_plazo_rectificar($folio);
				//echo $dias_rectificar."-----$folio<br>";
				//}
				
				
				$lista_mis_solicitudes_rectificadas = cms_replace("#DIAS#","$dias_rectificar",$lista_mis_solicitudes_rectificadas);

				$linea_lista_mis_solicitudes_rectificadas = $linea_lista_mis_solicitudes_rectificadas. $lista_mis_solicitudes_rectificadas;

				
				//$lineas .=$linea_lista_mis_solicitudes_rectificadas;
				
	}
		
	
	if ($sol_sin_asignar > 0 ){
		//template de mensaje de solicitudes sin asignar
		$mensaje_sin_asignar = html_template('mensaje_cantidad_solicitudes_responsable');
		$estado_glosa =  html_template('estado_glosa_responsable');
		$contenido = cms_replace("#MENSAJE_SIN_ASIGNAR#",$mensaje_sin_asignar,$contenido);
		$contenido = cms_replace("#ESTADO_GLOSA#",$estado_glosa,$contenido);

		//template de link sin asignar
		$mensaje_sin_asignar = html_template('link_cantidad_solicitudes_responsable');
		$contenido = cms_replace("#LINK_SOLICITUDES_SIN_ASIGNAR#",$mensaje_sin_asignar,$contenido);
		$contenido = cms_replace("#LINK_ASIGNAR_SOLICITUDES_PENDIENTES#","index.php?accion=$accion&id_estado_solicitud=1",$contenido);	
		
		$contenido = cms_replace("#TOTAL_SOLICITUDES_SIN_ASIGNAR#",$sol_sin_asignar,$contenido);
		$contenido = cms_replace("#FECHA_MAS_ANTIGUA#",$fecha_sol_mas_antigua,$contenido);
		
	}else{
		$mensaje_sin_asignar = html_template('mensaje_vacio_solicitudes_responsable');
		$contenido = cms_replace("#MENSAJE_SIN_ASIGNAR#",$mensaje_sin_asignar,$contenido);
		
		$contenido = cms_replace("#LINK_SOLICITUDES_SIN_ASIGNAR#"," ",$contenido);
		
	}
	

	//reeemplazar la lista en la etiqueta del contenedor
	//$contenido = cms_replace("#LISTA_ADMINISTRACION_SOLICITUDES#","$linea_lista_mis_solicitudes_rectificadas",$contenido);
	$tabla_mis_solicitudes ="
			
			<table width=\"98%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"table1\" class=\"tinytable\" align=\"left\">
    		  <thead>
				<tr>
                  
                        <th  align=\"center\" ><h3>Folio</h3></th>
                        <th  align=\"center\"><h3>Fecha de Solicitud</h3></th>
                        <th  align=\"center\"><h3>Fecha petici&oacute;n rectificaci&oacute;n</h3></th>
                         <th  align=\"center\"><h3>Plazo para Rectificar</h3></th>
                         <th  align=\"center\" class=\"nosort\"><h3>Ver</h3></th>
                       
                </tr>
			 </thead>
			  <tbody>
                $linea_lista_mis_solicitudes_rectificadas
              </tbody>
        </table>";
	
	//llenar el combobox de estados
	$query= "SELECT id_estado_solicitud,
					estado_solicitud
			 FROM  sgs_estado_solicitudes where id_estado_solicitud = id_estado_padre";
	$result= cms_query($query)or die (error($query,mysql_error(),$php));
	
	if ($id_estado_solicitud_seleccionado==0){
			$seleccionado = "selected";
	}else{
		$seleccionado = "";
	}
	  
	$estados = "<option value=\"\" ".$seleccionado.">Todas</option>";
	while (list($id_estado_solicitud,$estado_solicitud) = mysql_fetch_row($result)){
		$estado_solicitud= cambio_texto($estado_solicitud);

		if ($id_estado_solicitud_seleccionado==$id_estado_solicitud){
			$seleccionado = "selected";
		}else{
			$seleccionado = "";
		}
		    $estados .= "<option value=\"$id_estado_solicitud\" ".$seleccionado.">".$estado_solicitud."</option>";
		}
	
	
	$var = "seleccionado$tipo";
	$$var = "selected";
	$filtro = "	<select class=\"combo\"  name=\"id_estado_solicitud\" onChange=\"document.form1.submit()\">
					".$estados."
				</select>";
				
	$tipo="	<select class=\"combo\"  name=\"tipo\" onChange=\"document.form1.submit();\">
				    <option value=\"\" >Todos</option> 
					<option value=\"W\" ".$seleccionadoW.">Web</option>
				    <option value=\"P\" ".$seleccionadoP.">Formulario</option>
				    <option value=\"C\" ".$seleccionadoC.">Carta</option>
				
				</select>
				";
				$filtro = cambio_texto($filtro);
	
	  $id_usuario     = id_usuario($id_sesion);
	  $query= "SELECT count(*)   
              FROM  sgs_solicitud_acceso a, sgs_estado_solicitudes b, sgs_estado_solicitudes c
				WHERE a.id_estado_solicitud = b.id_estado_solicitud 
				
			      and c.id_estado_solicitud = a.id_sub_estado_solicitud
				  $condicion and  id_responsable='$id_usuario' $condicion_mis_solicitudes
            ";
			//echo $query;
         $result= cms_query($query)or die ("error 3");//(error($query,mysql_error(),$php));
          list($tot_mis_solicitudes) = mysql_fetch_row($result);
		  
	
	//responsables
	$query= "SELECT id_usuario,nombre,paterno  
               FROM  usuario u, usuario_perfil up
               WHERE u.id_perfil=up.id_perfil and up.maneja_solicitudes = 1"; 
    $result= cms_query($query)or die ("error 4");//(error($query,mysql_error(),$php));
  	$estados = "<option value=\"\" ".$seleccionado.">Todos</option>";
	while (list($id_responsable,$nombre,$paterno) = mysql_fetch_row($result)){
		
		if ($id_responsable_seleccionado==$id_responsable){
			$seleccionado = "selected";
		}else{
			$seleccionado = "";
		}
		$estados .= "<option value=\"$id_responsable\" ".$seleccionado.">$nombre $paterno</option>";
	}
	
	$responsable = "<select class=\"combo\" name=\"id_responsable\" onChange=\"document.form1.submit()\" >
					".$estados."
				</select>";
	//fin responsables

	$on_click = "index.php?accion=$accion&act=$act&tipo=$tipo_seleccionado&id_responsable=$id_responsable_seleccionado&id_estado_solicitud=$id_estado_solicitud_seleccionado&ms=1";
	
	$contenido = cms_replace("#FILTROS#","$filtro",$contenido);
	$contenido = cms_replace("#TIPO#","$tipo",$contenido);
	$contenido = cms_replace("#ON_CLICK#","$on_click",$contenido);
	$contenido = cms_replace("#TOT_MIS_SOLICITUDES#","$tot_mis_solicitudes",$contenido);
	$contenido = cms_replace("#FILTRO_ENTIDADES#","$select_entidades",$contenido);
	$contenido = cms_replace("#RESPONSABLE#",$responsable,$contenido);
	$contenido = cms_replace("#CANT_PAGINAS#",$paginas, $contenido);
	$contenido = cms_replace("#PAGINACION#","$paginacion", $contenido);
	$contenido = cms_replace("#ACCION#","$accion",$contenido);
	//$contenido = acentos($contenido);

	
		if(configuracion_cms('listado_simple')){
		
		
		
		





			
}



if($cont_panel>0){
		$tabla = crea_tabla_tiny($tabla_mis_solicitudes);
		}else{
		$tabla = $tabla_mis_solicitudes;
		}



$contenido =" <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
              <tr>
                <td><div align=\"left\">
                  <h3>Rectificar Solicitudes  </h3></div></td>
              </tr>
              <tr>
                <td> </td>
              </tr>
              <tr>
                <td><p align=\"justify\">Las siguientes solicitudes se encuentran pendientes de 
				rectificaci&oacute;n por parte del solicitante. Aquellas que ingresaron por 
				sitios electr&oacute;nicos s&oacute;lo pueden ser modificadas por el solicitante y 
				se puede acceder a cada una de ellas en el enlace \"VER DETALLE\". 
				Para rectificar una solicitud ingresada en forma manual (carta  o formulario), 
				acceda al enlace \"RECTIFICAR\".</p></td>
              </tr>
			  <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr> 
              <tr>
                <td>$tabla </td>
              </tr>
			  </table><br><br><br><br><br><br>";


	
	/*
	
	
	

<tr>

<td>#FOLIO#</td>

<td>#FECHA_INGRESO# </td>
<td>#FECHA_TERMINO# </td>
<td>#DIAS# d&iacute;as</td>
<td width="100">#ESTADO_PADRE#</td>
<td>#ESTADO#</td>
<td class="actions"><a class="edit" href="#LINK#">Editar</a></td>

</tr>
	
	*/
	
	
	
	/*CONTENEDOR
	
	
	
	
	<table cellspacing="0" cellpadding="0" width="98%" border="0">
    <tbody>
        <tr>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top">
                      
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><div align="center"><strong>Panel de Gesti&oacute;n de Solicitudes</strong></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center">Existen <span class="style1">#TOTAL_SOLICITUDES_SIN_ASIGNAR#</span> solicitudes sin asignar. La m&aacute;s antigua fue ingresada el <span class="style1">#FECHA_MAS_ANTIGUA#</span></div></td>
              </tr>
              <tr>
                <td><div align="center"><strong><a href="#LINK_ASIGNAR_SOLICITUDES_PENDIENTES#">Haga click aqu&iacute; para asignar Solicitudes Pendientes (<span class="style1">#TOTAL_SOLICITUDES_SIN_ASIGNAR#</span>)</a></strong></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center">Buscar Solicitud:
                  <input id="buscar" name="buscar" type="text" />
                  <input id="buscar2" type="submit" name="buscar2" value="buscar..." />
                </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><strong>Bandeja de Solicitudes</strong></td>
              </tr>
              <tr>
                <td><strong>Mostrar:</strong> #FILTROS# </td>
              </tr>
			   <tr><td align=\"center\"> </td></tr> 
              <tr>
                <td  valign="top">  <div class="wide" id="table-block">
              <table cellspacing="0" cellpadding="0">
                <tbody>
                    <tr class="header2">
                        <td width="15%">N&ordm; de Solicitud</td>
                        <td width="20%">Fecha de la Solicitud</td>
                        <td width="20%">Fecha T&eacute;rmino de Solicitud</td>
                        <td width="20%">Plazo</td>
                        <td width="23%">Etapa</td>
                        <td width="23%">Estado</td>
                        <td width="14%">Ver</td>
                    </tr>
                    #LISTA_ADMINISTRACION_SOLICITUDES#
                </tbody>
            </table>
            </div></td>
              </tr>
            </table>
            <br />
            <div align="center"><br />
            <br />
            #PAGINACION#</div>            </td>
        </tr>
    </tbody>
</table> 
	
	
		
	
	
	*/
	
?>