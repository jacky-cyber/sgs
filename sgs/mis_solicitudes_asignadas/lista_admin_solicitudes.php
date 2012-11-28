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
		 $and = " AND a.id_sub_estado_solicitud =".$id_estado_solicitud_seleccionado ;
	}
	if ($buscar !=""){
		$and .= " AND folio like '%".$buscar ."%'";
	}
	
	$ms = $_POST['ms'];
	if (($_POST['ms']=="")&&($_GET['ms']!="")){
		$ms = $_GET['ms'];
	}
	

	$asunto= configuracion_cms('Estados_pendiente_rectificacion');	
	
	$template="Estados_pendiente_rectificacion";
	$valor= "5";
	$tabla = "cms_configuracion";
	$publico = 0;
	if($asunto=="$template no existe"){
			
			$_POST['configuracion']="$template";
			$_POST['valor']=$valor;
			$_POST['descripcion']="Estado de Etapas pendiente de rectificacion";
			
			$_POST['publico']=$publico;
			inserta($tabla);
		
		}
	
	
	$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
	
	
	if ($ms=="1"){
		$condicion_mis_solicitudes = " and id_responsable=$id_usuario  and  a.id_sub_estado_solicitud not in ($Estados_pendiente_rectificacion)";
		
	}else{
		$condicion_mis_solicitudes = "";
	}
	
	$Estados_etapa_fin= configuracion_cms('Estados_etapa_fin');	
	$Estados_etapa_respondida= configuracion_cms('Estados_etapa_respondida');	
	
	$and .= " and a.id_sub_estado_solicitud not in ($Estados_etapa_fin,$Estados_etapa_respondida,$Estados_pendiente_rectificacion)";
	
	$condicion = " and a.id_sub_estado_solicitud not in ($Estados_etapa_fin,$Estados_etapa_respondida,$Estados_pendiente_rectificacion)";
	
	$tipo = $_POST['tipo'];
	
	if($tipo!="" ){
			$and = $and." AND folio like '%$tipo-%'";
	}
	
	
	if (($_POST['tipo']=="")&&($_GET['tipo']!="")){
		$tipo = $_GET['tipo'];
	}
	
     //	anto 89031012
	 
	$tipo_seleccionado = $tipo;
	
	
//para poner el filtro de entidad
	
	/*
	$id_entidad = $_POST['id_entidad'];
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
//	$select_entidades = select_lista_entidades($id_entidad_selecionada);


	
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
	$contenido = html_template('contenedor_listado_admin_solicitudes');	
	
	//procesar las solicitudes ingresadas
	//como es el panel del reponsable debe contar las solcitudes que aun estan en estado ingresadas id_estado=1
	
	$query= "SELECT folio,id_solicitud_acceso, fecha_inicio,
					fecha_termino					
			FROM  sgs_solicitud_acceso 
			WHERE id_responsable = 0 
				and id_estado_solicitud = 1
			and id_sub_estado_solicitud = 2
			order by fecha_inicio asc";
	//echo "<br> dos: ".$query."<br>";
	$result= cms_query($query)or die (error($query,mysql_error(),$php));
			
	$sol_sin_asignar = mysql_num_rows($result);
	
	while (list($folio,$id_solicitud_acceso,$fecha_ingreso,$fecha_termino) = mysql_fetch_row($result)){
	//echo $folio."<br>";
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
				   $condicion_mis_solicitudes
			order by $ordenar_datosxx";
		//echo $query;
	if(!configuracion_cms('listado_simple') ){	
		//
			
    $result= cms_query($query)or die (error($query,mysql_error(),$php));

	$tot_registros = mysql_num_rows($result);
	
	
	
	$reg_por_pagina = configuracion_cms('registros_por_pagina');
	
	$cant_pag = ceil($tot_registros/$reg_por_pagina);
	
	

	/******************************/
	$reg = $cant_pag * $reg_por_pagina;
	if ( $tot_registros < $reg ){
		$_GET['p'] = "";
		 
	}
	//echo "pa:".$pa;
	/*******************************/
	//echo "<br>cant_pag:".$cant_pag;

	
	
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

			
			
				$query .= " $limit";
			
			//echo $query;
      

		
		
		
		
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
	  
	  $id_enti = "";
	  $mostrar = 0;
	  }
	  
	  $result= cms_query($query)or die (error($query,mysql_error(),$php));
	  while (list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$estado_padre) = mysql_fetch_row($result)){
          		//echo "<br>folio :".$folio;
				 $cont_panel++;
				 $fecha_ingreso= fechas_html($fecha_ingreso);
					
				
				if($cambia_color ==1){
					$clase= "class=\"alternate\"";
					$cambia_color=0;
				}else{
					$clase="";
					$cambia_color=1;
				}
				
				
				//echo $fecha_termino;
				
				//estados retiro pendiente y pago pendiente, se procesan aca  
				//para parar el tiempo ya que no saltan a la bandeja de solicitudes finalizadas
				if (($id_sub_estado_solicitud==14)or($id_sub_estado_solicitud==15)){
					//echo "<br>entra a finalizada";
					//echo "fecha inicio: ".$fecha_ingreso;
					$fecha_inicio= fechas_bd($fecha_ingreso);
							//	$fecha_termino = fechas_bd($fecha_termino);
					
					//echo "fecha termino: ".$fecha_termino;
					//$fecha_inicio= fechas_bd($fecha_inicio);
					//$fecha_termino = fechas_bd($fecha_termino);
					$sql = "Select fecha 
							from sgs_flujo_estados_solicitud 
							where folio = '$folio' and id_estado_solicitud = $id_sub_estado_solicitud";
					$resultado_fecha = cms_query($sql)or die (error($sql,mysql_error(),$php));
					list($fecha_respuesta) = mysql_fetch_row($resultado_fecha);
					$respondida_en = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_respuesta);
					//$respondida_en = $respondida_en. "&nbsp;d&iacute;as";
					//
					
					//$fecha_termino = fechas_html($fecha_termino);
					//echo "<br>fecha de respuesta:".$fecha_respuesta;
					//echo "<br>fecha de termino:".$fecha_termino;
					$dias = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_respuesta);
					//echo "<br>dias:".$dias;
					$fecha_respuesta = fechas_html($fecha_respuesta);
					$fecha_termino = $fecha_respuesta;
					
					$glosa_dias = "d&iacute;a";
					if($dias > 1){
						$glosa_dias = "d&iacute;as";
					}
					
					$dias = "Respondida <br>en ".$dias."&nbsp;".$glosa_dias ;
							
					
				}else{
					//echo "<br>NO entra a finalizada";
					$dias = calculaDiasHabiles($fecha_termino);
					
					$fecha_termino = fechas_html($fecha_termino);
										
					$glosa_dias = "d&iacute;a";
					if($dias<-1){
						$glosa_dias = "d&iacute;as";
						$dias = "<font color=\"#FF0000\">$dias&nbsp;$glosa_dias</font>";
					
					}else{
						if($dias > 1){
							$glosa_dias = "d&iacute;as";
						}
						$dias = "$dias&nbsp;$glosa_dias";
					}
				}
				
				
				
				
				
				$link_editar = "?accion=$accion&act=1&folio=$folio";
				$lista_mis_solicitudes = asigna_etiquetas('linea_lista_administracion_solicitudes');
				$lineas .=$lista_mis_solicitudes;
				
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
		$contenido = cms_replace("#LINK_ASIGNAR_SOLICITUDES_PENDIENTES#","index.php?accion=$accion&id_estado_solicitud=2",$contenido);	
		
		$contenido = cms_replace("#TOTAL_SOLICITUDES_SIN_ASIGNAR#",$sol_sin_asignar,$contenido);
		$contenido = cms_replace("#FECHA_MAS_ANTIGUA#",$fecha_sol_mas_antigua,$contenido);
		
	}else{
		$mensaje_sin_asignar = html_template('mensaje_vacio_solicitudes_responsable');
		$contenido = cms_replace("#MENSAJE_SIN_ASIGNAR#",$mensaje_sin_asignar,$contenido);
		
		$contenido = cms_replace("#LINK_SOLICITUDES_SIN_ASIGNAR#"," ",$contenido);
		
	}
	

	//reeemplazar la lista en la etiqueta del contenedor
	$contenido = cms_replace("#LISTA_ADMINISTRACION_SOLICITUDES#","$lineas",$contenido);
	
	
	//llenar el combobox de estados
	$query= "SELECT id_estado_solicitud,
					estado_solicitud
			 FROM  sgs_estado_solicitudes 
			 where id_estado_padre=3 and id_estado_solicitud<>3 ";
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
		    $estados .= "<option value=\"$id_estado_solicitud\" $seleccionado>$estado_solicitud </option>";
		}
	
	
	$var = "seleccionado$tipo";
	$$var = "selected";
	$filtro = "	<select  class=\"combo\"  name=\"id_estado_solicitud\" onChange=\"document.form1.submit()\">
					".$estados."
				</select><br>";
				
	$tipo="	<select  class=\"combo\"  name=\"tipo\" onChange=\"document.form1.submit();\">
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
				  AND a.id_entidad =  '$id_entidad_user'  ";
			//echo $query;
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($tot_mis_solicitudes) = mysql_fetch_row($result);
		  
	
	//responsables
	$query= "SELECT id_usuario,nombre,paterno  
               FROM  usuario u, usuario_perfil up
               WHERE u.id_perfil=up.id_perfil 
			   and up.maneja_solicitudes = 1 
			   and u.id_entidad='$id_entidad_user'"; 

    $result= cms_query($query)or die (error($query,mysql_error(),$php));
  	$estados = "<option value=\"\" ".$seleccionado.">Todos</option>";
	while (list($id_responsable,$nombre,$paterno) = mysql_fetch_row($result)){
		
		if ($id_responsable_seleccionado==$id_responsable){
			$seleccionado = "selected";
		}else{
			$seleccionado = "";
		}
		$estados .= "<option value=\"$id_responsable\" ".$seleccionado.">$nombre $paterno</option>";
	}
	
	$responsable = "<select  class=\"combo\" name=\"id_responsable\"  onChange=\"document.form1.submit()\" >
					".$estados."
				</select>";
	//fin responsables

	$on_click = "index.php?accion=$accion&act=$act&tipo=$tipo_seleccionado&id_responsable=$id_responsable_seleccionado&id_estado_solicitud=$id_estado_solicitud_seleccionado&ms=1";
	
	$contenido = cms_replace("#FILTROS#","$filtro",$contenido);
	$contenido = cms_replace("#TIPO#","$tipo",$contenido);
	$contenido = cms_replace("#ON_CLICK#","$on_click",$contenido);
	$contenido = cms_replace("#TOT_MIS_SOLICITUDES#","$tot_mis_solicitudes",$contenido);
	$contenido = cms_replace("#RESPONSABLE#",$responsable,$contenido);
	$contenido = cms_replace("#FILTRO_ENTIDADES#","$select_entidades",$contenido);
	$contenido = cms_replace("#CANT_PAGINAS#",$paginas, $contenido);
	$contenido = cms_replace("#PAGINACION#","$paginacion", $contenido);
	$contenido = cms_replace("#ACCION#","$accion",$contenido);
	//$contenido = acentos($contenido);

	
	if(configuracion_cms('listado_simple') ){
		
		
		
		
			$tabla_mis_solicitudes ="<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"table1\" class=\"tinytable\" align=\"left\">
    		  <thead>
				<tr>
                  
                        <th width=\"100\"><h3>Folio</h3></th>
                        <th width=\"80\"><h3>Fecha  Solicitud</h3></th>
                        <th width=\"110\"><h3>Fecha estimada de T&eacute;rmino</h3></th>
                        <th  width=\"80\" title=\"Fecha de cierre de solicitud\"><h3>Plazo<a href=\"index.php?accion=help&c=plazo_termino&width=320&axj=1\" class=\"jTip\" id=\"Plazo_termino\" name=\"Plazo de t&eacute;rmino de solicitud\"><img src=\"images/help.png\" alt=\"\" border=\"0\"></a></h3></th>
                        <th width=\"80\"><h3>Etapa</h3></th>
                        <th ><h3>Estado</h3></th>
                        <th class=\"nosort\"><h3>Ver</h3></th>
                       
                </tr>
			 </thead>
			  <tbody>
                $lineas
              </tbody>
        </table>
			  ";
		if($cont_panel>0){
		$tabla = crea_tabla_tiny($tabla_mis_solicitudes);
		}else{
		$tabla = $tabla_mis_solicitudes;
		}



$contenido = "<table width=\"98%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                
				<tr><td align=\"left\" class=\"textos\">Seleccione un estado $filtro</td></tr> 
				<tr><td align=\"left\" class=\"textos\">Seleccione un Tipo $tipo</td></tr> 
				
				<tr>
                <td align=\"left\" width=\"98%\" class=\"textos\">Responsable :$responsable    <a href=\"#\" onclick=\"document.form1.ms.value=1;document.form1.submit();\">Mis Solicitudes ($tot_mis_solicitudes)
                  <input name=\"ms\" type=\"hidden\" id=\"ms\" value=\"0\" />
                </a></td>
              </tr>
            	 <tr>
                  <td align=\"center\" class=\"textos\">$tabla
			</td>
                  </tr>
            	</table><br><br><br><br><br><br><br><br><br><br>";
			
}
	
	
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