<?php
//se listan los filtros de los encabezados

	$linea_encabezado_correo = html_template('registro_encabezado_mail');

	$salto = "";
	if ($nivel!= "Detalle"){
		$salto = " onchange='document.form1.submit();'";
		$salto_region = " onchange='document.form1.id_comuna.value=\"\";document.form1.submit();'";
	}
	
	
	//colocar el filtro de año
	//llenar el combobox de responsables de entidad
	$query= "SELECT distinct(DATE_FORMAT(fecha_inicio, '%Y')) anio
			FROM sgs_solicitud_acceso  ORDER BY fecha_inicio DESC";
	$result = mysql_query($query) or die ("aca error: ".mysql_error()."<BR>  <br>".$query);
	//$result= cms_query($query)or die (error($query,mysql_error(),$php));
	
	if ($periodo == ""){
		$periodo_seleccionado = date('Y');
		$periodo = $periodo_seleccionado;
	}else{
		$periodo_seleccionado = $periodo;
	}
	
	$item = "Per&iacute;odo"; 
	$valor = "";
	$seleccionado = "";
	
	
	if ($nivel=="Solicitud"){
		$estados = " <option value=\"\" >TODOS</option>";
	}
	while (list($anio) = mysql_fetch_row($result)){
		
		if ($periodo_seleccionado==$anio){
			$seleccionado = "selected";
			$valor = $periodo_seleccionado;
			
		}else{
			$seleccionado = "";
		}
		$estados .= "<option value=\"$anio\" ".$seleccionado.">".$anio."</option>";
		}
	
	$filtro_anio = "<select name=\"periodo\" id=\"periodo\" class=\"combo\" $salto  >
						".$estados."
				    </select>";
	$encabezado_periodo = completaRegistroEncabezado($linea_encabezado_correo,$item,$valor);	
	$csv_encabezado_periodo = $item.$csv_separador.$valor.$csv_fin_linea;
	
//fin filtro 


		
		$id_entidad_padre = configuracion_cms('id_servicio');	
		
		$filtro_servicio = select_tabla("sgs_entidad_padre",trim($id_entidad_padre),"id_entidad_padre","entidad_padre","","");
		$item = "Servicio";
		$valor = "";
		$sql = " select entidad_padre from sgs_entidad_padre where id_entidad_padre = $id_entidad_padre";
		//echo "<br>".$sql;
		//$rsEntp = cms_query($sql) or die("Error en la consulta");
		$rsEntp = mysql_query($sql) or die ("aca error: ".mysql_error()."<BR>  <br>".$sql);
		list($valor) = mysql_fetch_row($rsEntp);
		$encabezado_servicio = completaRegistroEncabezado($linea_encabezado_correo,$item,$valor);
		$csv_encabezado_servicio = $item.$csv_separador.$valor.$csv_fin_linea;
		//$filtro_servicio = cambia_texto($filtro_servicio);
		$filtro_servicio = str_replace ("<select","<select disabled ",$filtro_servicio);
		
		
		//$filtro_entidad = select_tabla("sgs_entidades",trim($id_entidad),"id_entidad","entidad","","");
		//sacar las entidades de configuracion
		
		
		
		$id_entidad_seleccionada = trim($id_entidad);
	
		$selected = "";
		if($id_entidad_seleccionada ==""){
			$selected = "selected";
		}
		  
		
		$sql = "Select valor from cms_configuracion where configuracion='id_entidad'";
		$result = mysql_query($sql) or die ("aca error: ".mysql_error()."<BR>  <br>".$sql);
		//$result = cms_query($sql) or die (error($sql,mysql_error(),$php));
		list($entidades_por_defecto) = mysql_fetch_row($result);
		$aEntidad = split(',',$entidades_por_defecto);
		$item = "Entidad";
		$valor = "";
		
		  $query= "SELECT id_entidad,entidad 
				   FROM  sgs_entidades
				   WHERE id_entidad_padre='$id_entidad_padre' and id_entidad in ($entidades_por_defecto)";
			 //$result= cms_query($query)or die (error($query_a,mysql_error(),$php));
			 $result = mysql_query($query) or die ("aca error: ".mysql_error()."<BR>  <br>".$query);
			 if (count($aEntidad)>1){
			 	$lista_select .= "<option value=\"\"  $selected >TODAS</option>";
				$valor = "TODAS";
			 }
			  $sacaValor=0;
			  if (mysql_num_rows($result)==1){
				  $sacaValor=1;
			  }
			  //echo "\n saca valor:".$sacaValor;
			  while (list($id_entidad_filtro,$entidad_filtro) = mysql_fetch_row($result)){
					
					$entidad_filtro = cambio_texto($entidad_filtro);
					if ($sacaValor==1){
						$valor = $entidad_filtro;
					}
					$encontrado =  buscarCodigo($aEntidad,$id_entidad_filtro);
					if ($encontrado==1){
						$selected= "";
						if($id_entidad_seleccionada==$id_entidad_filtro){
							$selected = "selected";
							$valor = $entidad_filtro;
							//echo "\n pasa por aca \n";
						}
						$lista_select .="<option value=\"$id_entidad_filtro\" $selected >$entidad_filtro</option>";			   
					}
					
				 }
		
		
		$filtro_entidad = "<select name=\"id_entidad\"  id=\"id_entidad\"  class=\"combo\" $salto  >$lista_select</select>";
		//echo "<br> valor:".$valor;
		$encabezado_entidad = completaRegistroEncabezado($linea_encabezado_correo,$item,$valor);
		$csv_encabezado_entidad = $item.$csv_separador.$valor.$csv_fin_linea;
		 
		
		
		
		
		
		switch ($mes){
			case 1:
				$ene = "selected";
				$mes_enc = "Enero";
				break;
			case 2:
				$feb = "selected";
				$mes_enc = "Febrero";
				break;
			case 3:
				$mar = "selected";
				$mes_enc = "Marzo";
				break;
			case 4:
				$abr = "selected";
				$mes_enc = "Abril";
				break;
			case 5:
				$may = "selected";
				$mes_enc = "Mayo";
				break;
			case 6:
				$jun = "selected";
				$mes_enc = "Junio";
				break;
			case 7:
				$jul = "selected";
				$mes_enc = "Julio";
				break;
			case 8:
				$ago = "selected";
				$mes_enc = "Agosto";
				break;
			case 9:
				$sep = "selected";
				$mes_enc = "Septiembre";
				break;
			case 10:
				$oct = "selected";
				$mes_enc = "Octubre";
				break;
			case 11:
				$nov = "selected";
				$mes_enc = "Noviembre";
				break;
			case 12:
				$dic = "selected";
				$mes_enc = "Diciembre";
				break;
		}
		
		$filtro_mes = "<select name='mes' id='mes' class='combo' $salto  >
						  <option value=\"\" >TODOS</option>
						  <option value='1' $ene >Enero</option>
						  <option value='2' $feb >Febrero</option>
						  <option value='3' $mar >Marzo</option>
						  <option value='4' $abr >Abril</option>
						  <option value='5' $may >Mayo</option>
						  <option value='6' $jun >Junio</option>
						  <option value='7' $jul >Julio</option>
						  <option value='8' $ago >Agosto</option>
						  <option value='9' $sep >Septiembre</option>
						  <option value='10' $oct >Octubre</option>
						  <option value='11' $nov >Noviembre</option>
						  <option value='12' $dic >Diciembre</option>
						</select>";
		$item = "Mes";
		$valor = "";
		$valor = $mes_enc;
		$encabezado_mes = completaRegistroEncabezado($linea_encabezado_correo,$item,$valor);
		$csv_encabezado_mes = $item.$csv_separador.$valor.$csv_fin_linea;
		

switch ($act) {
     case 1:
         //ok ingresadas
		 $condicion_estados_filtros = "";
		 break;
		 
	 case 3:
         $condicion_estados_filtros = "6,8";//ok estados de analisis
         break;
		 
	case 4:
        $condicion_estados_filtros = "21,22";//ok denegadas segun causal
         break;
		 
	case 5:
          $condicion_estados_filtros = "1,2,3,4,5,6,7,8,9,10,11,12";//ok proximas a vencer
         break;
		 
	case 6:
          $condicion_estados_filtros = "1,2,3,4,5,6,7,8,9,10,11,12";//ok vencidas
         break;
	 
	case 8:
         $condicion_estados_filtros = "14,15,16,18,19,20,21,22,23";//ok respondidas no secreto
         break;
	
}		
		if ($condicion_estados_filtros!=""){
			$condicion_estados_filtros = " and id_estado_solicitud in(".$condicion_estados_filtros.")";
		}
		
		$lista_select = "";
		$id_estado_seleccionado = $id_estado_solicitud;
		$item = "Estado";
		$valor = "";
		$lista_select .= "<option value=\"\"  $selected >TODOS</option>";
		$valor = "TODOS";

		$query= "SELECT id_estado_solicitud,estado_solicitud 
			   FROM  sgs_estado_solicitudes
			   WHERE id_estado_solicitud != id_estado_padre and id_estado_padre > 0  ".$condicion_estados_filtros;
		 //$result= cms_query($query)or die (error($query,mysql_error(),$php));
		 $result = mysql_query($query) or die ("aca error: ".mysql_error()."<BR>  <br>".$query);
		 while (list($id_estado_solicitud_filtro,$estado_solicitud_filtro) = mysql_fetch_row($result)){
				$estado_solicitud_filtro = cambio_texto($estado_solicitud_filtro);
				$selected= "";
				if($id_estado_seleccionado==$id_estado_solicitud_filtro){
					$selected = "selected";
					$valor = $estado_solicitud_filtro;
				}
				$lista_select .="<option value=\"$id_estado_solicitud_filtro\" $selected >$estado_solicitud_filtro</option>";			   
		 }
	
		$filtro_estados = "<select name=\"id_estado_solicitud\" id=\"id_estado_solicitud\" class=\"combo\"  $salto  >$lista_select</select>";
		$encabezado_estado = completaRegistroEncabezado($linea_encabezado_correo,$item,$valor);
		$csv_encabezado_estado = $item.$csv_separador.$valor.$csv_fin_linea;
	
	/**********FILTRO TRAMOS*****************/
	
		$lista_select = "";
		$id_tramo_seleccionado = $id_tramo;
		$lista_select .= "<option value=\"\"  $selected >TODOS</option>";
		$item = "Tramos";
		$valor = "";
		$valor = "TODOS";
		$query= "SELECT id_tramo,descripcion_vencimiento 
			   FROM  sgs_tramos ";
			  
		 //$result= cms_query($query)or die (error($query,mysql_error(),$php));
		 $result = mysql_query($query) or die ("aca error: ".mysql_error()."<BR>  <br>".$query);
		 while (list($id_tramo_filtro,$descripcion_vencimiento_filtro) = mysql_fetch_row($result)){
				$estado_solicitud_filtro = cambio_texto($estado_solicitud_filtro);
				$selected= "";
				if($id_tramo_seleccionado==$id_tramo_filtro){
					$selected = "selected";
					$valor = $descripcion_vencimiento_filtro;
				}
				$lista_select .="<option value=\"$id_tramo_filtro\" $selected >$descripcion_vencimiento_filtro</option>";			   
		 }
	
		$filtro_tramos = "<select name=\"id_tramo\" id=\"id_tramo\"  onchange='document.form1.submit();'>$lista_select</select>";
		
		$encabezado_tramo = completaRegistroEncabezado($linea_encabezado_correo,$item,$valor);
		$csv_encabezado_tramo = $item.$csv_separador.$valor.$csv_fin_linea;
	
	/********************************/
	
	
	
	
	
	
	$id_responsable_seleccionado = $id_responsable;
	if($id_responsable_seleccionado==""){
		$seleccionado = "selected";
	}else{
		$seleccionado = "";
	}
	$estados = "<option value=\"\" ".$seleccionado.">TODOS</option>";
	
	if($id_responsable_seleccionado=="0"){
		$seleccionado = "selected";
	}else{
		$seleccionado = "";
	}
	
	$estados = $estados."<option value=\"0\" ".$seleccionado.">Sin Responsable</option>";
	$query= "SELECT id_usuario,nombre,paterno  
	   FROM  usuario u, usuario_perfil up
	   WHERE u.id_perfil=up.id_perfil and up.maneja_solicitudes = 1";
	//$result= cms_query($query)or die (error($query,mysql_error(),$php));
	$result = mysql_query($query) or die ("aca error: ".mysql_error()."<BR>  <br>".$query);
	
    $item = "Responsable";
	$valor = "TODOS";
	while (list($id_responsable_filtro,$nombre,$paterno) = mysql_fetch_row($result)){
		
		if ($id_responsable_seleccionado==$id_responsable_filtro){
			$seleccionado = "selected";
			$valor = $nombre. $paterno;
		}else{
			$seleccionado = "";
		}
		$estados .= "<option value=\"$id_responsable_filtro\" ".$seleccionado.">$nombre $paterno</option>";
	}
	
	$filtro_responsable = "<select name=\"id_responsable\" id=\"id_responsable\" class=\"combo\" $salto  >
					".$estados."
					</select>";
	$encabezado_responsable = completaRegistroEncabezado($linea_encabezado_correo,$item,$valor);
	$csv_encabezado_responsable = $item.$csv_separador.$valor.$csv_fin_linea;
		
		
	function completaRegistroEncabezado($linea_encabezado_correo,$item,$valor){
		$registro = cms_replace("#ITEM#",$item,$linea_encabezado_correo);
		$registro = cms_replace("#VALOR#",$valor,$registro);
		return $registro;
		
	}
	
	//filtro pais region comuna
	$js .= "<script >
	function muestraOcultaRegionComuna(){
	indice = document.form1.id_pais.selectedIndex ;
	if (document.form1.id_pais.options[indice].text == 'Chile' ){//Etiqueta del combo si se selecciona chile
		document.getElementById('region_comuna').style.display = '';
	}else{
		document.getElementById('region_comuna').style.display = 'none';
	}
}
</script>
";
	$filtro_pais = "";
	$item = "Pa&iacute;s";
	$valor = "TODOS";
	
	if ($mes!=""){
		$condicion_filt_mes = " and MONTH(fecha_inicio)= $mes";
	}
	//echo "<br>periodo_seleccionado".$periodo_seleccionado."<br>";
	$sql = "Select c.id_pais, pais
			from sgs_solicitud_acceso a,
				 usuario b,
				 pais c
			where a.id_usuario = b.id_usuario
				  and b.id_pais = c.id_pais
				  and YEAR(fecha_inicio)= $periodo_seleccionado
				  $condicion_filt_mes
			group by id_pais";
	$id_pais_seleccionado = $id_pais;
	//$result= cms_query($sql)or die (error($sql,mysql_error(),$php));
	$result = mysql_query($sql) or die ("aca error: ".mysql_error()."<BR>  <br>".$sql);
	$sacaValor = 0;
	//if (mysql_num_rows($result) > 1){
		$paises .="<option value=\"\" >TODOS</option>";
	//}else{
		//$sacaValor = 1;
	//}
	while (list($id_pais_filtro,$pais) = mysql_fetch_row($result)){
		if ($sacaValor == 1 ){
			$valor = $pais;
		}
		if ($id_pais_seleccionado==$id_pais_filtro){
			$seleccionado = "selected";
			$valor = $pais;
		}else{
			$seleccionado = "";
		}
		$paises .= "<option value=\"$id_pais_filtro\" ".$seleccionado.">".$pais."</option>";
	}

	$filtro_pais = "<select name=\"id_pais\" id=\"id_pais\" class=\"combo\" $salto  >
					
					".$paises."
					</select>";
	$encabezado_pais = completaRegistroEncabezado($linea_encabezado_correo,$item,$valor);
	$csv_encabezado_pais = $item.$csv_separador.$valor.$csv_fin_linea;
					
					
	
	if ($id_pais_seleccionado !="51"){
		$id_region = "";
		$id_comuna = "";
	}
	if ($id_pais_seleccionado ==""){
		$id_region = "";
		$id_comuna = "";
	}
	//echo $id_comuna;
	
	$item = "Regi&oacute;n";
	$valor = "TODAS";
	$filtro_region = "";
	$sql = "Select b.id_region, region
			from sgs_solicitud_acceso a,
			     usuario b,
				 regiones c
			where a.id_usuario = b.id_usuario
				  and b.id_region = c.id_region
				  and YEAR(fecha_inicio)= $periodo_seleccionado
				  $condicion_filt_mes
			group by id_region";
	$id_region_seleccionado = $id_region;
	//$result= cms_query($sql)or die (error($sql,mysql_error(),$php));
	$result = mysql_query($sql) or die ("aca error: ".mysql_error()."<BR>  <br>".$sql);
	$sacaValor = 0;
	//if (mysql_num_rows($result) > 1){
		$regiones .="<option value=\"\" >TODAS</option>";
	//}else{
		//$sacaValor = 1;
	//}
	while (list($id_region_filtro,$region) = mysql_fetch_row($result)){
		if ($sacaValor == 1){
			$valor = $region;
		}
		if ($id_region_seleccionado==$id_region_filtro){
			$seleccionado = "selected";
			$valor = $region;
		}else{
			$seleccionado = "";
		}
		$regiones .= "<option value=\"$id_region_filtro\" ".$seleccionado.">".$region."</option>";
	}
	
	$filtro_region = "<select name=\"id_region\" id=\"id_region\" class=\"combo\" $salto_region  >
					
					".$regiones."
					</select>";
	$encabezado_region = completaRegistroEncabezado($linea_encabezado_correo,$item,$valor);
	$csv_encabezado_region = $item.$csv_separador.$valor.$csv_fin_linea;

	
	
	$item = "Comuna";
	$valor = "TODAS";
	$filtro_comuna = "";
		
		
	if ($id_region_seleccionado!=""){
		$sql = "Select b.id_comuna, c.comuna
				from sgs_solicitud_acceso a,
					 usuario b,
					 comunas c
				where a.id_usuario = b.id_usuario
					  and c.id_region = $id_region_seleccionado
					  and c.id_comuna = b.id_comuna
					  and YEAR(fecha_inicio)= $periodo_seleccionado
					  $condicion_filt_mes
				group by b.id_comuna";
		$id_comuna_seleccionado = $id_comuna;
		//$result= cms_query($sql)or die (error($sql,mysql_error(),$php));
		$result = mysql_query($sql) or die ("aca error: ".mysql_error()."<BR>  <br>".$sql);
		$comunas = "TODAS";
		$sacarValor = 0;
		//if (mysql_num_rows($result) > 1){
			$comunas .="<option value=\"\" >TODAS</option>";
			
		//}else{
		//	$sacarValor = 1;
		//}
		while (list($id_comuna_filtro,$comuna) = mysql_fetch_row($result)){
			if ($sacarValor == 1){
				$valor = $comuna;
			}
			if ($id_comuna_seleccionado==$id_comuna_filtro){
				$seleccionado = "selected";
				$valor = $comuna;
			}else{
				$seleccionado = "";
			}
			$comunas .= "<option value=\"$id_comuna_filtro\" ".$seleccionado.">".$comuna."</option>";
		}
	}
	
	$filtro_comuna = "<select name=\"id_comuna\" id=\"id_comuna\" class=\"combo\" $salto  >
					
					".$comunas."
					</select>";
	$encabezado_comuna = completaRegistroEncabezado($linea_encabezado_correo,$item,$valor);
	$csv_encabezado_comuna = $item.$csv_separador.$valor.$csv_fin_linea;

	
	//fin filtro pais region comuna
		

	$filtro_categoria = "";
	
	
	$sql = "Select a.id_categoria, categoria
			from sgs_solicitud_categoria a,
				 sgs_solicitud_acceso_categoria b
				 left outer join sgs_solicitud_acceso c on b.folio = c.folio
			where a.id_categoria = b.id_categoria
				  and YEAR(c.fecha_inicio)= $periodo_seleccionado
				  $condicion_filt_mes
			
			group by  a.id_categoria, categoria 
			order by categoria asc";
	$id_categoria_seleccionado = $id_categoria;
	
	
	$item = "Categor&iacute;a";
	$valor = "TODAS";
	
	//echo "categoria seleccionada:".$id_categoria_seleccionado;
	$result = mysql_query($sql) or die ("aca error: ".mysql_error()."<BR>  <br>".$sql);
	//$result = cms_query($sql)or die (error($sql,mysql_error(),$php));
	if (mysql_num_rows($result) >= 0){
		$categorias .="<option value=\"\" >TODAS</option>";
	}
	while (list($id_categoria_filtro,$categoria) = mysql_fetch_row($result)){
		
		if ($id_categoria_seleccionado==$id_categoria_filtro){
			$seleccionado = "selected";
			$valor = $categoria;
		}else{
			$seleccionado = "";
		}
		$categorias .= "<option value=\"$id_categoria_filtro\" ".$seleccionado.">".$categoria."</option>";
	}
	
	$filtro_categoria = "<select name=\"id_categoria\" id=\"id_categoria\" class=\"combo\" $salto  >
					
					".$categorias."
					</select>";
	$encabezado_categoria = completaRegistroEncabezado($linea_encabezado_correo,$item,$valor);
	$csv_encabezado_categoria = $item.$csv_separador.utf8_decode($valor).$csv_fin_linea;



 $query= "SELECT id_factor,factor 
				   FROM  sgs_factores  ";
				   
		//echo "<br>".$query;
		 $result= cms_query($query)or die ("ERROR $php <br>$query<br>".mysql_error());
		 
		
		 $id_factor_seleccionado = $id_factor;
		 //echo "<BR>id_factor_seleccionado:".$id_factor_seleccionado;
		 $lista_select = "";
		 $num_registros = mysql_num_rows($result);
		 //echo "<br>num_registros:".$num_registros;
		 /*if ($num_registros >1){
			$lista_select .= "<option value=\"0\"  $selected >Seleccione</option>";
		 }*/
		  while (list($id_factor_filtro,$factor_filtro) = mysql_fetch_row($result)){
		  	
				$factor_filtro = cambio_texto($factor_filtro);
				//$encontrado =  buscarCodigo($aEntidad,$id_entidad_filtro);
				//if ($encontrado==1){
					$selected = "";
					if($id_factor_seleccionado==$id_factor_filtro){
						$selected = "selected";
						$item_tabla = $factor_filtro;
					
					}
					$factor_filtro = acentos($factor_filtro);
					$lista_select .="<option value=\"$id_factor_filtro\" $selected >$factor_filtro</option>";			   				//}
		   		
		 }
		
		
		
		$filtro_factor = "<select name=\"id_factor\"  >$lista_select</select>";
		


?>

