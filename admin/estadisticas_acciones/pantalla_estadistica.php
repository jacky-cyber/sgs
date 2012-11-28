<?php 

	$formulario_estadistica = html_template('contenedor_estadisticas');

	$query= "SELECT AVG(tiempo) from estadisticas_acciones where cache=1";
    $result_estadisticas_acciones= cms_query($query)or die (error($query,mysql_error(),$php));
    list($promedio_con_cache) = mysql_fetch_row($result_estadisticas_acciones);
     
	$query= "SELECT AVG(tiempo) from estadisticas_acciones where cache=0";
    $result_estadisticas_acciones= cms_query($query)or die (error($query,mysql_error(),$php));
    list($promedio_sin_cache) = mysql_fetch_row($result_estadisticas_acciones);
	 
	$query= "SELECT ROUND(AVG(online),0) from estadisticas_acciones";
    $result_estadisticas_acciones= cms_query($query)or die (error($query,mysql_error(),$php));
    list($promedio_conectados) = mysql_fetch_row($result_estadisticas_acciones);
	
	$query= "SELECT ROUND(AVG(sqls),0) from estadisticas_acciones";
    $result_estadisticas_acciones= cms_query($query)or die (error($query,mysql_error(),$php));
    list($promedio_sqls) = mysql_fetch_row($result_estadisticas_acciones);
	
	$ver_detalle_conectados = "<a id=\"ver_detalle_conectados\" name=\"ver_detalle_conectados\" onmouseover=\"this.style.cursor='pointer'\">Ver Detalle</a>";
	$ver_detalle_con_cache = "<a id=\"ver_detalle_con_cache\" name=\"ver_detalle_con_cache\" onmouseover=\"this.style.cursor='pointer'\">Ver Detalle</a>";
	$ver_detalle_sin_cache = "<a id=\"ver_detalle_sin_cache\" name=\"ver_detalle_sin_cache\" onmouseover=\"this.style.cursor='pointer'\">Ver Detalle</a>";
	$ver_detalle_sql = "<a id=\"ver_detalle_sql\" name=\"ver_detalle_sql\" onmouseover=\"this.style.cursor='pointer'\">Ver Detalle</a>";
	
	$formulario_estadistica = cms_replace("#CONECTADOS_PROMEDIO#",$promedio_conectados,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#CONECTADOS_DETALLE#",$ver_detalle_conectados,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#CON_CACHE_PROMEDIO#",$promedio_con_cache,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#CON_CACHE_DETALLE#",$ver_detalle_con_cache,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#SIN_CACHE_PROMEDIO#",$promedio_sin_cache,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#SIN_CACHE_DETALLE#",$ver_detalle_sin_cache,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#SQL_PROMEDIO#",$promedio_sqls,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#SQL_DETALLE#",$ver_detalle_sql,$formulario_estadistica);
	
	$dia_conectados = "<a id=\"ver_dia_conectados\" name=\"ver_dia_conectados\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">D&iacute;a</a>";
	$semana_conectados = "<a id=\"ver_semana_conectados\" name=\"ver_semana_conectados\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">Semanal</a>";
	$mes_conectados = "<a id=\"ver_mes_conectados\" name=\"ver_mes_conectados\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">Mes</a>";
	$formulario_estadistica = cms_replace("#DIA_CONECTADOS#",$dia_conectados,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#SEMANAS_CONECTADOS#",$semana_conectados,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#MES_CONECTADOS#",$mes_conectados,$formulario_estadistica);
	
	$dia_con_cache = "<a id=\"ver_dia_con_cache\" name=\"ver_dia_con_cache\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">D&iacute;a</a>";
	$semana_con_cache = "<a id=\"ver_semana_con_cache\" name=\"ver_semana_con_cache\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">Semanal</a>";
	$mes_con_cache = "<a id=\"ver_mes_con_cache\" name=\"ver_mes_con_cache\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">Mes</a>";
	$formulario_estadistica = cms_replace("#DIA_CON_CACHE#",$dia_con_cache,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#SEMANAS_CON_CACHE#",$semana_con_cache,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#MES_CON_CACHE#",$mes_con_cache,$formulario_estadistica);
	
	$dia_sin_cache = "<a id=\"ver_dia_sin_cache\" name=\"ver_dia_sin_cache\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">D&iacute;a</a>";
	$semana_sin_cache = "<a id=\"ver_semana_sin_cache\" name=\"ver_semana_sin_cache\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">Semanal</a>";
	$mes_sin_cache = "<a id=\"ver_mes_sin_cache\" name=\"ver_mes_sin_cache\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">Mes</a>";
	$formulario_estadistica = cms_replace("#DIA_SIN_CACHE#",$dia_sin_cache,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#SEMANAS_SIN_CACHE#",$semana_sin_cache,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#MES_SIN_CACHE#",$mes_sin_cache,$formulario_estadistica);
	
	$dia_sqls = "<a id=\"ver_dia_sqls\" name=\"ver_dia_sqls\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">D&iacute;a</a>";
	$semana_sqls = "<a id=\"ver_semana_sqls\" name=\"ver_semana_sqls\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">Semanal</a>";
	$mes_sqls = "<a id=\"ver_mes_sqls\" name=\"ver_mes_sqls\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">Mes</a>";
	$formulario_estadistica = cms_replace("#DIA_SQLS#",$dia_sqls,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#SEMANAS_SQLS#",$semana_sqls,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#MES_SQLS#",$mes_sqls,$formulario_estadistica);
	
	$dia_visitas = "<a id=\"ver_dia_visitas\" name=\"ver_dia_visitas\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">D&iacute;a</a>";
	$semana_visitas = "<a id=\"ver_semana_visitas\" name=\"ver_semana_visitas\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">Semanal</a>";
	$mes_visitas = "<a id=\"ver_mes_visitas\" name=\"ver_mes_visitas\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">Mes</a>";
	$formulario_estadistica = cms_replace("#DIA_VISITAS#",$dia_visitas,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#SEMANAS_VISITAS#",$semana_visitas,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#MES_VISITAS#",$mes_visitas,$formulario_estadistica);
	
	$fecha_inicio = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_inicio\" id=\"fecha_inicio\">";
	$fecha_termino = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_termino\" id=\"fecha_termino\">";
	$buscar_rango_visitas = "<input type=\"button\" name=\"buscar_rango_visitas\" id=\"buscar_rango_visitas\" value=\"Buscar\">";
	$formulario_estadistica = cms_replace("#FECHA_INICIO_VISITAS#",$fecha_inicio,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#FECHA_TERMINO_VISITAS#",$fecha_termino,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#BOTON_BUSCAR_VISITAS#",$buscar_rango_visitas,$formulario_estadistica);
	
	$fecha_inicio_conectados = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_inicio_conectados\" id=\"fecha_inicio_conectados\">";
	$fecha_termino_conectados = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_termino_conectados\" id=\"fecha_termino_conectados\">";
	$buscar_rango_conectados = "<input type=\"button\" name=\"buscar_rango_conectados\" id=\"buscar_rango_conectados\" value=\"Buscar\">";
	$formulario_estadistica = cms_replace("#FECHA_INICIO_CONECTADOS#",$fecha_inicio_conectados,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#FECHA_TERMINO_CONECTADOS#",$fecha_termino_conectados,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#BOTON_BUSCAR_CONECTADOS#",$buscar_rango_conectados,$formulario_estadistica);
	
	$fecha_inicio_cache = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_inicio_cache\" id=\"fecha_inicio_cache\">";
	$fecha_termino_cache = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_termino_cache\" id=\"fecha_termino_cache\">";
	$buscar_rango_cache = "<input type=\"button\" name=\"buscar_rango_cache\" id=\"buscar_rango_cache\" value=\"Buscar\">";
	$formulario_estadistica = cms_replace("#FECHA_INICIO_CACHE#",$fecha_inicio_cache,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#FECHA_TERMINO_CACHE#",$fecha_termino_cache,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#BOTON_BUSCAR_CACHE#",$buscar_rango_cache,$formulario_estadistica);
	
	$fecha_inicio_sin_cache = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_inicio_sin_cache\" id=\"fecha_inicio_sin_cache\">";
	$fecha_termino_sin_cache = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_termino_sin_cache\" id=\"fecha_termino_sin_cache\">";
	$buscar_rango_sin_cache = "<input type=\"button\" name=\"buscar_rango_sin_cache\" id=\"buscar_rango_sin_cache\" value=\"Buscar\">";
	$formulario_estadistica = cms_replace("#FECHA_INICIO_SINCACHE#",$fecha_inicio_sin_cache,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#FECHA_TERMINO_SINCACHE#",$fecha_termino_sin_cache,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#BOTON_BUSCAR_SINCACHE#",$buscar_rango_sin_cache,$formulario_estadistica);
	
	$fecha_inicio_sqls = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_inicio_sqls\" id=\"fecha_inicio_sqls\">";
	$fecha_termino_sqls = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_termino_sqls\" id=\"fecha_termino_sqls\">";
	$buscar_rango_sqls = "<input type=\"button\" name=\"buscar_rango_sqls\" id=\"buscar_rango_sqls\" value=\"Buscar\">";
	$formulario_estadistica = cms_replace("#FECHA_INICIO_SQLS#",$fecha_inicio_sqls,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#FECHA_TERMINO_SQLS#",$fecha_termino_sqls,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#BOTON_BUSCAR_SQLS#",$buscar_rango_sqls,$formulario_estadistica);
	
	//include("admin/estadisticas_acciones/graficar_tiempo_conectados.php");
	$fecha_hora =date('Y-m-d h:i:s');
	$query= "SELECT INTERVAL -1 DAY + '$fecha_hora';";
	$result= mysql_query($query)or die (error($query,mysql_error(),$php));
	list($ayer) = mysql_fetch_row($result);

	$query= "SELECT tiempo,sqls,online  
			FROM estadisticas_acciones 
			WHERE hora > '$ayer  $hora'
			AND hora < '$fecha_hora'
			order by id_estadistica  desc
			Limit 0,40";
echo $query;
	$result= mysql_query($query)or die (error($query,mysql_error(),$php));
	while (list($tiempo,$sqls,$online) = mysql_fetch_row($result)){

		$conectados .="$online ,";
		$tiempos .="$tiempo ,";
	}

	$conectados = elimina_ultimo_caracter($conectados);
	$tiempos = elimina_ultimo_caracter($tiempos);
	
	$dia_respuestas = "<a id=\"ver_dia_respuestas\" name=\"ver_dia_respuestas\" class=\"btn btn-primary\" onmouseover=\"this.style.cursor='pointer'\">D&iacute;a</a>";
	$fecha_inicio_respuesta = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_inicio_respuesta\" id=\"fecha_inicio_respuesta\">";
	$fecha_termino_respuesta = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_termino_respuesta\" id=\"fecha_termino_respuesta\">";
	$buscar_rango_respuesta = "<input type=\"button\" name=\"buscar_rango_respuesta\" id=\"buscar_rango_respuesta\" value=\"Buscar\">";
	$formulario_estadistica = cms_replace("#DIA_RESPUESTA#",$dia_respuestas,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#FECHA_INICIO_RESPUESTA#",$fecha_inicio_respuesta,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#FECHA_TERMINO_RESPUESTA#",$fecha_termino_respuesta,$formulario_estadistica);
	$formulario_estadistica = cms_replace("#BOTON_BUSCAR_RESPUESTA#",$buscar_rango_respuesta,$formulario_estadistica);
			
	$contenido = $formulario_estadistica;
	
	
	 
     /*
 * Select tabla deuman_slqs
 * 
 */
$query= "SELECT AVG(tiempo) as avg_tiempo,accion from deuman_sqls where tiempo > '0,0001' group by accion ";
     $result_deuman_slqs2= mysql_query($query)or die (error($query,mysql_error(),$php));
      while (list($tiempo_respuesta,$accion_ver) = mysql_fetch_row($result_deuman_slqs2)){
	$cont_ti++;
			if($accion_ver ==""){
				$accion_ver = "defecto";
			}
			
			if($cont_ti==1){
				$activo="class=\"active\"";
				$active_pane ="class=\"tab-pane active\"";
			}else{
				$activo="";
				$active_pane =" class=\"tab-pane\"";
			}
			
			//$accion_ver = $_GET['accion_ver'];
		
			 /*
			 * Select tabla count(*)
			 * 
			 */
			$query= "SELECT count(*)  
				   FROM  deuman_sqls
				   WHERE accion = '$accion_ver' and tiempo > '0,0001'";
			     $result_deuman_sqls= mysql_query($query)or die (error($query,mysql_error(),$php));
			      list($total_registros) = mysql_fetch_row($result_deuman_sqls);
			      
			/** fin select deuman_sqls***/
				
				$update_sql = "update";
				$select_sql = "select";
				$insert_sql = "insert";
				$deleta_sql = "delete";
			       /*
				* Select tabla deuman_mails
				* 
				*/
			       $query= "SELECT avg(tiempo)  
					  FROM  deuman_sqls
					  WHERE sql2 like '%$update_sql%' and accion='$accion_ver' and tiempo > '0,0001'";
				    $result_deuman_mails= mysql_query($query)or die (error($query,mysql_error(),$php));
				    list($prom_update) = mysql_fetch_row($result_deuman_mails);
			      
			      $query= "SELECT avg(tiempo)  
					  FROM  deuman_sqls
					  WHERE sql2 like '%$select_sql%' and accion='$accion_ver' and tiempo > '0,0001'";
				    $result_deuman_mails= mysql_query($query)or die (error($query,mysql_error(),$php));
				    list($prom_select) = mysql_fetch_row($result_deuman_mails);
			       
			         $query= "select avg(tiempo)  
					  FROM  deuman_sqls
					  WHERE sql2 like '%$insert_sql%' and accion='$accion_ver' and tiempo > '0,0001'";
				    $result_deuman_mails= mysql_query($query)or die (error($query,mysql_error(),$php));
				    list($prom_insert) = mysql_fetch_row($result_deuman_mails);
			      
			       $query= "select avg(tiempo)  
					  FROM  deuman_sqls
					  WHERE sql2 like '%$delete_sql%' and accion='$accion_ver' and tiempo > '0,0001'";
				    $result_deuman_mails= mysql_query($query)or die (error($query,mysql_error(),$php));
				    list($prom_deletex) = mysql_fetch_row($result_deuman_mails);
			       /** fin select deuman_mails***/
						       
				$lista_panes .="
				<div $active_pane id=\"tab$cont_ti\">\n
				<p>Select $prom_select</p>\n
				<p>Update $prom_update</p>\n
				<p>Insert $prom_insert</p>\n
				<p>Delete $prom_deletex</p>\n
							
					</div>\n";
						
				$lista_resultados .=" <li $activo><a href=\"#tab$cont_ti\" data-toggle=\"tab\">$accion_ver $tiempo_respuesta seg</a></li>\n";
		
					}
		
		
			 //<a href=\"index.php?accion=$accion&accion_ver=$accion_sql\">
		 
		 
	        $tabla_promedios_tiempos_accion="<!--ini-->
							<div class=\"tabbable tabs-left\">
									
							<ul class=\"nav nav-tabs\">
							  $lista_resultados
							</ul>
								<div class=\"tab-content\">
									  $lista_panes
									</div>
							
						      </div><!--fin-->";
	       
					       
			 

     
	$contenido .= $tabla_promedios_tiempos_accion;
	
	/*
	 <style type='text/css'>
    .nav-tabs > li, .nav-pills > li {
    float:none;
    display:inline-block;
}

.nav-tabs {
    text-align:center;
}

  </style>
	*/
	$js .=" 
			<script type=\"text/javascript\" src=\"js/jquery/highcharts2_1_9/js/highcharts.js\"></script>
			<script type=\"text/javascript\" src=\"js/jquery/highcharts2_1_9/js/modules/exporting.js\"></script>
			
			<!-- datepicker -->
			<script type=\"text/javascript\" src=\"js/jquery/jquery-ui/js/jquery-ui-1.8.16.custom.min.js\"></script>
			<script type=\"text/javascript\" src=\"js/jquery/jquery.ui.datepicker-es.js\"></script>
			<link rel=\"stylesheet\" href=\"js/jquery/jquery-ui/css/ui-lightness/jquery-ui-1.8.16.custom.css\">

			
			<script type=\"text/javascript\">
				
				$(document).ready(function(){
				
					ocultar_divs();
					grafico_defecto_visitas();

					$('#ver_detalle_conectados').click(function (){
						$('#div_rangos').css(\"display\", \"none\");
						ocultar_divs();
						ocultar_botones();
						$('#container').html('');
						cargando_imagen();
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Promedio usuarios conectados diariamente' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'conectados promedio' },min: 0},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=1&axj=1',{
								defecto:'defecto'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Promedios',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								xData.push(datos[i].fecha);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						$('#div_botones').show(100);
						$('#div_conectados').show(100);
					});
					
					$('#ver_detalle_sql').click(function (){
						$('#container').html('');
						ocultar_divs();
						ocultar_botones();
						cargando_imagen();
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Consultas SQL' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Consultas promedio' },min: 0},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=4&axj=1',{
								defecto:'defecto'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Consultas',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								xData.push(datos[i].fecha);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_sqls').show(100);
						
					});
					
					$('#ver_detalle_con_cache').click(function (){
						$('#container').html('');
						ocultar_divs();
						ocultar_botones();
						cargando_imagen();
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Tiempos promedio respuesta con cache' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Seg' }},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=2&axj=1',{
							defecto:'defecto'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Segundos',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								xData.push(datos[i].fecha);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_con_cache').show(100);
						
						
					});
					
					$('#ver_detalle_sin_cache').click(function (){
						$('#container').html('');
						ocultar_divs();
						ocultar_botones();
						cargando_imagen();
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Tiempos promedio respuesta sin cache' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Seg' }},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=3&axj=1',{
							defecto:'defecto'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Consultas',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								xData.push(datos[i].fecha);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_sin_cache').show(100);
						
					});
					
					function grafico_visitas_diarias(fecha_inicio,fecha_termino){
						cargar_load_visitas();
						var options = {
							chart: { renderTo: 'container_visitas'  },
							title: { text: 'Total visitas diarias' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'visitas diarias' }},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=5&axj=1',{
								diaVisitas:'diaVisitas',
								fecha_inicio: fecha_inicio,
								fecha_termino: fecha_termino
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Visitas',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].cantidad));
								xData.push(datos[i].fecha);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						$('#load_visitas').html('');
					}
					
					function grafico_defecto_visitas(){
						$('#div_fechas_visitas').css(\"display\", \"none\");
						cargar_load_visitas();
						var options = {
							chart: { renderTo: 'container_visitas'  },
							title: { text: 'Total visitas diarias' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'visitas diarias' }},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=5&axj=1',{
								defecto:'defecto',
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Visitas',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].cantidad));
								xData.push(datos[i].fecha);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						$('#load_visitas').html('');
						
						//GRAFICAR PIE
						//return '<b>'+ this.point.name +'</b>: '+ this.y;
						$('#volver').hide();
						var chart2;
						var opciones = {
									chart: {
										renderTo: 'container_pie',
										plotBackgroundColor: null,
										plotBorderWidth: null,
										plotShadow: false
									},
									title: {
										text: 'Ingresos por Modulo SACH'
									},
									tooltip: {
										formatter: function() {
											return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
										}
									},
									plotOptions: {
										pie: {
											allowPointSelect: true,
											cursor: 'pointer',
											dataLabels: {
												enabled: true,
												color: '#000000',
												connectorColor: '#000000',
												formatter: function() {
													return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
												}
											}
										}
									},
									series: [{
									   type: 'pie',
									   data: []
									}]
						};
						
						$.post('index.php?accion=$accion&act=6&axj=1',{
								
							}, function(data){
							var datos = JSON.parse(data);
							$(datos).each(function(i,e){
								var aux = [datos[i].descripcion,parseInt(datos[i].porcentaje)];
								opciones.series[0].data.push(aux);
							});
							chart2 = new Highcharts.Chart(opciones);
						});
						//FIN GRAFICAR PIE
						
						// GRAFICAR TIEMPO DE RESPUESTA VS USUARIOS CONECTADOS
						var chart;
						chart = new Highcharts.Chart({
							chart: {
								renderTo: 'container_respuesta_conectados',
								zoomType: 'xy'
							},
							title: {
								text: 'Tiempo de respuesta v/s Usuarios Conectados'
							},
							subtitle: {
								text: 'Datos de la últimas 24 Hrs'
							},
							xAxis: [{
								categories: [$conectados]
							}],
							yAxis: [{ // Primary yAxis
								labels: {
									formatter: function() {
										return this.value +'seg';
									},
									style: {
										color: '#89A54E'
									}
								},
								title: {
									text: 'Tiempo respuesta',
									style: {
										color: '#89A54E'
									}
								}
							}, { // Secondary yAxis
								title: {
									text: 'Conectados',
									style: {
										color: '#4572A7'
									}
								},
								labels: {
									formatter: function() {
										return this.value +' online';
									},
									style: {
										color: '#4572A7'
									}
								},
								opposite: true
							}],
							tooltip: {
								formatter: function() {
									return ''+ this.y +
										(this.series.name == 'Usuarios' ? ' Online' : ' Seg');
								}
							},
							legend: {
								layout: 'vertical',
								align: 'left',
								x: 120,
								verticalAlign: 'top',
								y: 100,
								floating: true,
								backgroundColor: '#FFFFFF'
							},
							series: [{
								name: 'Usuarios',
								color: '#4572A7',
								type: 'spline',
								yAxis: 1,
								data: [$conectados]		
							
							}, {
								name: 'Tiempo Respuesta',
								color: '#89A54E',
								type: 'spline',
								data: [$tiempos]
							}]
						});	
					}
				
					function ocultar_divs(){
						$('#div_botones').css(\"display\", \"none\");
						$('#div_conectados').css(\"display\", \"none\");
						$('#div_con_cache').css(\"display\", \"none\");
						$('#div_sin_cache').css(\"display\", \"none\");
						$('#div_sqls').css(\"display\", \"none\");
						//$('#div_fechas_visitas').css(\"display\", \"none\");
					}
					
					function ocultar_botones(){
						
						$('#div_rangos_conectados').css(\"display\", \"none\");
						$('#div_rangos_cache').css(\"display\", \"none\");
						$('#div_rangos_sincache').css(\"display\", \"none\");
						$('#div_rangos_sqls').css(\"display\", \"none\");
						
						//$('#div_fechas_rangos').css(\"display\", \"none\");
					}
					
					function ocultar_div_visitas(){
						$('#div_botones_visita').css(\"display\", \"none\");
					}
					
					function cargar_load_visitas(){
						$('#container_visitas').html('<img src=\"admin/estadisticas_acciones/loader.gif\"/>');
					}
					
					function cargando_imagen(){
						$('#container').html('<img src=\"admin/estadisticas_acciones/loader.gif\"/>');
					}
					
					function getMes(mes){
						var textomes = new Array (12);
						textomes[1]=\"Enero\";
						textomes[2]=\"Febrero\";
						textomes[3]=\"Marzo\";
						textomes[4]=\"Abril\";
						textomes[5]=\"Mayo\";
						textomes[6]=\"Junio\";
						textomes[7]=\"Julio\";
						textomes[7]=\"Agosto\";
						textomes[9]=\"Septiembre\";
						textomes[10]=\"Octubre\";
						textomes[11]=\"Noviembre\";
						textomes[12]=\"Diciembre\";
						for(var i=0; i<textomes.length; i++){
							if(mes == i){
								return textomes[i];
							}
						}
					}
					
					$('#ver_dia_conectados').click(function (){
						$('#div_rangos_conectados').show(100);
					});
					
					// USUARIOS CONECTADOS
					
					$('#buscar_rango_conectados').click(function (){
						if( $('#fecha_inicio_conectados').val() != '' && $('#fecha_termino_conectados').val() != ''){
							var finicio = $('#fecha_inicio_conectados').val();
							var ftermino = $('#fecha_termino_conectados').val();
							grafico_conectados_diarias(finicio,ftermino);
						}else{
							alert('Debe ingresar ambas fechas');
							return false;
						}
					});
					
					function grafico_conectados_diarias(fecha_inicio, fecha_termino){
						ocultar_divs();
						$('#container').html('');
						cargando_imagen();
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Promedio usuarios conectados diariamente' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Usuarios conectados' },min: 0},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=1&axj=1',{
								diaConectados:'diaconectados',
								fecha_inicio: fecha_inicio,
								fecha_termino: fecha_termino
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'conectados',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								xData.push(datos[i].fecha);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_conectados').show(100);
					}
					
					$('#ver_semana_conectados').click(function (){
						$('#div_rangos_conectados').css(\"display\", \"none\");
						ocultar_divs();
						$('#container').html('');
						$('#fecha_inicio_conectados').val('');
						$('#fecha_termino_conectados').val('');
						cargando_imagen();
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Promedio usuarios conectados semanalmente' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Usuarios conectados' },min: 0},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=1&axj=1',{
								semanaConectados:'semanaconectados'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'conectados',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								var nombre_mes = getMes(datos[i].mes);
								var cabecera;
								if(datos[i].minimo != datos[i].maximo){
									cabecera = nombre_mes+' semana del '+datos[i].minimo+' al '+datos[i].maximo;
								}else{
									cabecera = nombre_mes+' semana del '+datos[i].minimo;
								}
								//xData.push(nombre_mes+' semana del ' +datos[i].minimo+ ' al '+datos[i].maximo);
								xData.push(cabecera);
								
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_conectados').show(100);
						
					});
					
					$('#ver_mes_conectados').click(function (){
						$('#div_rangos_conectados').css(\"display\", \"none\");
						ocultar_divs();
						$('#container').html('');
						$('#fecha_inicio_conectados').val('');
						$('#fecha_termino_conectados').val('');
						cargando_imagen();
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Promedio usuarios conectados mensualmente' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Usuarios conectados' },min: 0},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=1&axj=1',{
								mesConectados:'mesconectados'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Promedios',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								var nombre_mes = getMes(datos[i].mes);
								xData.push(nombre_mes +'-'+ datos[i].aao);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_conectados').show(100);
						
					});

					// CON CACHE
					
					$('#ver_dia_con_cache').click(function (){
						$('#div_rangos_cache').show(100);
					});
					
					$('#buscar_rango_cache').click(function (){
						if( $('#fecha_inicio_cache').val() != '' && $('#fecha_termino_cache').val() != ''){
							var finicio = $('#fecha_inicio_cache').val();
							var ftermino = $('#fecha_termino_cache').val();
							grafico_cache_diarias(finicio,ftermino);
						}else{
							alert('Debe ingresar ambas fechas');
							return false;
						}
					});
					
					function grafico_cache_diarias(fecha_inicio,fecha_termino){
					
						$('#container').html('');
						ocultar_divs();
						cargando_imagen();
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Tiempos promedio diario respuesta con cache' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Seg' }},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
											
						$.post('index.php?accion=$accion&act=2&axj=1',{
								diaCache:'diaCache',
								fecha_inicio:fecha_inicio,
								fecha_termino:fecha_termino
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Segundos',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								xData.push(datos[i].fecha);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_con_cache').show(100);
					}
					
					$('#ver_semana_con_cache').click(function (){
						ocultar_divs();
						$('#container').html('');
						cargando_imagen();
						$('#div_rangos_cache').css(\"display\", \"none\");
						$('#fecha_inicio_cache').val('');
						$('#fecha_termino_cache').val('');
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Tiempos promedio semanales respuesta con cache' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'conectados promedio' }},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=2&axj=1',{
								semanaCache:'semanaCache'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Segundos',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								var nombre_mes = getMes(datos[i].mes);
								var cabecera;
								if(datos[i].minimo != datos[i].maximo){
									cabecera = nombre_mes+' semana del '+datos[i].minimo+' al '+datos[i].maximo;
								}else{
									cabecera = nombre_mes+' semana del '+datos[i].minimo;
								}
								//xData.push(nombre_mes+' semana del ' +datos[i].minimo+ ' al '+datos[i].maximo);
								xData.push(cabecera);
								
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_con_cache').show(100);
						
					});
					
					$('#ver_mes_con_cache').click(function (){
						ocultar_divs();
						$('#container').html('');
						cargando_imagen();
						$('#div_rangos_cache').css(\"display\", \"none\");
						$('#fecha_inicio_cache').val('');
						$('#fecha_termino_cache').val('');
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Tiempos promedio mensuales respuesta con cache' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Segundos' },min: 0},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=2&axj=1',{
								mesCache:'mesCache'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Seg',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								var nombre_mes = getMes(datos[i].mes);
								xData.push(nombre_mes +'-'+ datos[i].aao);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_con_cache').show(100);
						
					});
					
					// SIN CACHE
					$('#ver_dia_sin_cache').click(function (){
						$('#div_rangos_sincache').show(100);
					});
					
					$('#buscar_rango_sin_cache').click(function (){
						if( $('#fecha_inicio_sin_cache').val() != '' && $('#fecha_termino_sin_cache').val() != ''){
							var finicio = $('#fecha_inicio_sin_cache').val();
							var ftermino = $('#fecha_termino_sin_cache').val();
							grafico_sin_cache_diarias(finicio,ftermino);
						}else{
							alert('Debe ingresar ambas fechas');
							return false;
						}
					});
					
					function grafico_sin_cache_diarias(fecha_inicio,fecha_termino){
						$('#container').html('');
						ocultar_divs();
						cargando_imagen();
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Tiempos promedio respuesta sin cache' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Seg' }},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=3&axj=1',{
								diaSincache:'diaSincache',
								fecha_inicio:fecha_inicio,
								fecha_termino:fecha_termino
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Consultas',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								xData.push(datos[i].fecha);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_sin_cache').show(100);
						
					}
					
					$('#ver_semana_sin_cache').click(function (){
						ocultar_divs();
						$('#container').html('');
						cargando_imagen();
						$('#div_rangos_sincache').css(\"display\", \"none\");
						$('#fecha_inicio_sin_cache').val('');
						$('#fecha_termino_sin_cache').val('');
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Tiempos promedio semanales respuesta sin cache' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Segundos' }},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=3&axj=1',{
								semanaSincache:'semanaSincache'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Segundos',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								var nombre_mes = getMes(datos[i].mes);
								var cabecera;
								if(datos[i].minimo != datos[i].maximo){
									cabecera = nombre_mes+' semana del '+datos[i].minimo+' al '+datos[i].maximo;
								}else{
									cabecera = nombre_mes+' semana del '+datos[i].minimo;
								}
								//xData.push(nombre_mes+' semana del ' +datos[i].minimo+ ' al '+datos[i].maximo);
								xData.push(cabecera);
								
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_sin_cache').show(100);
						
					});
					
					$('#ver_mes_sin_cache').click(function (){
						ocultar_divs();
						$('#container').html('');
						cargando_imagen();
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Tiempos promedio mensuales respuesta sin cache' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Segundos' },min: 0},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=3&axj=1',{
								mesSincache:'mesSincache'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Seg',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								var nombre_mes = getMes(datos[i].mes);
								xData.push(nombre_mes +'-'+ datos[i].aao);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_sin_cache').show(100);
						
					});
					
					// SQLS
					
					$('#ver_dia_sqls').click(function (){
						$('#div_rangos_sqls').show(100);
					});
					
					$('#buscar_rangos_sqls').click(function (){
						if( $('#fecha_inicio_sqls').val() != '' && $('#fecha_termino_sqls').val() != ''){
							var finicio = $('#fecha_inicio_sqls').val();
							var ftermino = $('#fecha_termino_sqls').val();
							grafico_sqls_diarias(finicio,ftermino);
						}else{
							alert('Debe ingresar ambas fechas');
							return false;
						}
					});
					/**/
					function grafico_sqls_diarias(fecha_inicio, fecha_termino){
						$('#container').html('');
						ocultar_divs();
						cargando_imagen();
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Consultas diarias promedio' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Consultas promedio' },min: 0},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=4&axj=1',{
								diaSql:'diaSql',
								fecha_inicio:fecha_inicio,
								fecha_termino:fecha_termino
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Consultas',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								xData.push(datos[i].fecha);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_sqls').show(100);
						
					}
					
					$('#ver_semana_sqls').click(function (){
						ocultar_divs();
						$('#container').html('');
						cargando_imagen();
						$('#div_rangos_sqls').css(\"display\", \"none\");
						$('#fecha_inicio_sqls').val('');
						$('#fecha_termino_sqls').val('');
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Consultas semanales promedio' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Consultas promedio' }},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=4&axj=1',{
								semanaSql:'semanaSql'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Consultas',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								var nombre_mes = getMes(datos[i].mes);
								var cabecera;
								if(datos[i].minimo != datos[i].maximo){
									cabecera = nombre_mes+' semana del '+datos[i].minimo+' al '+datos[i].maximo;
								}else{
									cabecera = nombre_mes+' semana del '+datos[i].minimo;
								}
								//xData.push(nombre_mes+' semana del ' +datos[i].minimo+ ' al '+datos[i].maximo);
								xData.push(cabecera);
								
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_sqls').show(100);
						
					});
					
					$('#ver_mes_sqls').click(function (){
						ocultar_divs();
						$('#container').html('');
						cargando_imagen();
						$('#div_rangos_sqls').css(\"display\", \"none\");
						$('#fecha_inicio_sqls').val('');
						$('#fecha_termino_sqls').val('');
						var options = {
							chart: { renderTo: 'container'  },
							title: { text: 'Consultas mensuales promedio' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'Consultas promedio' },min: 0},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=4&axj=1',{
								mesSqls:'mesSqls'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Consultas',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].promedio));
								var nombre_mes = getMes(datos[i].mes);
								xData.push(nombre_mes +'-'+ datos[i].aao);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
						
						$('#div_botones').show(100);
						$('#div_sqls').show(100);
						
					});
					
					/**/
					
					// VISITAS
					$('#ver_dia_visitas').click(function (){
						$('#div_fechas_visitas').show(100);
						$('#fecha_inicio').val('');
						$('#fecha_termino').val('');
					});
					
					$('#ver_semana_visitas').click(function (){
						$('#div_fechas_visitas').css(\"display\", \"none\");
						cargar_load_visitas();
						var options = {
							chart: { renderTo: 'container_visitas'  },
							title: { text: 'Total visitas semanales' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'visitas semanales' }},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=5&axj=1',{
								semanaVisitas:'semanaVisitas'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Visitas',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].cantidad));
								var nombre_mes = getMes(datos[i].mes);
								var cabecera;
								if(datos[i].minimo != datos[i].maximo){
									cabecera = nombre_mes+' semana del '+datos[i].minimo+' al '+datos[i].maximo;
								}else{
									cabecera = nombre_mes+' semana del '+datos[i].minimo;
								}
								//xData.push(nombre_mes+' semana del ' +datos[i].minimo+ ' al '+datos[i].maximo);
								xData.push(cabecera);
								
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
					});
					
					$('#ver_mes_visitas').click(function (){
						$('#div_fechas_visitas').css(\"display\", \"none\");
						cargar_load_visitas();
						var options = {
							chart: { renderTo: 'container_visitas'  },
							title: { text: 'Total visitas mensuales' },
							tooltip:
							{
								enabled: true,
								formatter: function()
								{
									return '<b>' + this.x + '</b><br/>' + this.y + ' ' + this.series.name;
								}
							},
							xAxis: { categories: [] },
							yAxis: { title: { text: 'visitas mensuales' },min: 0},
							series: [],
							plotOptions:{ line: { lineWidth : 2 } }
						};
					  						
						$.post('index.php?accion=$accion&act=5&axj=1',{
								mesVisitas:'mesVisitas'
							}, function(data){
							var datos = JSON.parse(data);
							var series = 
							{
								type: 'line',
								name: 'Visitas',
								data: [],
								marker: { enabled: true, radius : 3 }
							};
							var xData = options.xAxis.categories;
							
							$(datos).each(function(i, e){
								series.data.push(parseInt(datos[i].cantidad));
								var nombre_mes = getMes(datos[i].mes);
								xData.push(nombre_mes +'-'+ datos[i].aao);
							});
							options.series.push(series);
							var chart = new Highcharts.Chart(options);							
						});
					});
					
					$('#buscar_rango_visitas').click(function (){
						if( $('#fecha_inicio').val() != '' && $('#fecha_termino').val() != ''){
							var finicio = $('#fecha_inicio').val();
							var ftermino = $('#fecha_termino').val();
							grafico_visitas_diarias(finicio,ftermino);
						}else{
							alert('Debe ingresar ambas fechas');
							return false;
						}
					});
					
					// RESPUESTAS
					$('#buscar_rango_respuesta').click(function (){
						if( $('#fecha_inicio_respuesta').val() != '' && $('#fecha_termino_respuesta').val() != ''){
							var finicio = $('#fecha_inicio_respuesta').val();
							var ftermino = $('#fecha_termino_respuesta').val();
							grafico_respuestas_rango(finicio,ftermino);
						}else{
							alert('Debe ingresar ambas fechas');
							return false;
						}
					});
					
					/*
					function grafico_respuestas_rango(fecha_inicio, fecha_termino){
						var chart;
						chart = new Highcharts.Chart({
							chart: {
								renderTo: 'container_respuesta_conectados',
								zoomType: 'xy'
							},
							title: {
								text: 'Tiempo de respuesta v/s Usuarios Conectados'
							},
							subtitle: {
								text: 'Datos de la últimas 24 Hrs'
							},
							xAxis: [{
								categories: []
							}],
							yAxis: [{ // Primary yAxis
								labels: {
									formatter: function() {
										return this.value +'seg';
									},
									style: {
										color: '#89A54E'
									}
								},
								title: {
									text: 'Tiempo respuesta',
									style: {
										color: '#89A54E'
									}
								}
							}, { // Secondary yAxis
								title: {
									text: 'Conectados',
									style: {
										color: '#4572A7'
									}
								},
								labels: {
									formatter: function() {
										return this.value +' online';
									},
									style: {
										color: '#4572A7'
									}
								},
								opposite: true
							}],
							tooltip: {
								formatter: function() {
									return ''+ this.y +
										(this.series.name == 'Usuarios' ? ' Online' : ' Seg');
								}
							},
							legend: {
								layout: 'vertical',
								align: 'left',
								x: 120,
								verticalAlign: 'top',
								y: 100,
								floating: true,
								backgroundColor: '#FFFFFF'
							},
							series: [{
								name: 'Usuarios',
								color: '#4572A7',
								type: 'spline',
								yAxis: 1,
								data: []		
							
							}, {
								name: 'Tiempo Respuesta',
								color: '#89A54E',
								type: 'spline',
								data: []
							}]
						});
						$.post('index.php?accion=$accion&act=7&axj=1',{
								fecha_inicio:fecha_inicio,
								fecha_termino:fecha_termino
							}, function(data){
							var datos = JSON.parse(data);
							var series_online = 
							{
								name: 'Usuarios',
								color: '#4572A7',
								type: 'spline',
								yAxis: 1
							};
							var series_tiempo = 
							{
								name: 'Tiempo Respuesta',
								color: '#89A54E',
								type: 'spline'
							};
							
							$(datos).each(function(i, e){
								series_online.data.push(parseInt(datos[i].online));
								series_tiempo.data.push(parseInt(datos[i].tiempo));
							});
							options.series.push(series_online);
							options.series.push(series_tiempo);
							var chart = new Highcharts.Chart(options);		

												
						});
						
					}
					*/
										
				});	// FIN JS
				
				
			
			</script>

	";

$fecha_input = date("d-m-Y");
	
$js .= "
				<script>
					$(function() {
						$(\".calendario_datepicker\").datepicker({ minxDate: \"+1M +10D\", maxDate: 0 });
						$(\".calendario_datepicker\").datepicker( \"option\", \"dateFormat\",'dd-mm-yy');
						$(\".calendario_datepicker\").datepicker( \"option\", \"changeYear\",false);
						
					});
				</script>

		";

?>