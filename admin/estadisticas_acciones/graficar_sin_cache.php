<?php

	if($_POST["defecto"]){
		$fecha_actual = date('Y-m-d');
		$cantidad_dias_obtener = configuracion_cms('grafico_dias');
		$query= "SELECT DATE_SUB('$fecha_actual',INTERVAL $cantidad_dias_obtener DAY);";
		$result= cms_query($query)or die(error($query,mysql_error(),$php));
		list($fecha_anterior) = mysql_fetch_row($result);
		$query= "SELECT DATE_FORMAT(fecha,'%d-%m-%y') as fecha, avg(tiempo) AS promedio
					FROM estadisticas_acciones
					WHERE cache = 0
					AND fecha BETWEEN '$fecha_anterior' AND '$fecha_actual'
					GROUP BY fecha";
		$result= cms_query($query)or die(error($query,mysql_error(),$php));
		$arr = array();
		while ($obj = mysql_fetch_object($result)){
			$arr[] = array('fecha' => $obj->fecha,
						   'promedio' => $obj->promedio
				);
		}
		exit(json_encode($arr));
	}
	
	if($_POST["diaSincache"] && $_POST["fecha_inicio"] && $_POST["fecha_termino"] ){
		$fecha_inicio = $_POST["fecha_inicio"];
		$fecha_termino = $_POST["fecha_termino"];
		$fecha_inicio = fechas_bd($fecha_inicio);
		$fecha_termino = fechas_bd($fecha_termino);
		$query= "SELECT DATE_FORMAT(fecha,'%d-%m-%y') as fecha, avg(tiempo) AS promedio
					FROM estadisticas_acciones
					WHERE cache = 0
					AND fecha BETWEEN '$fecha_inicio' AND '$fecha_termino'
					GROUP BY fecha";
		$result= cms_query($query)or die(error($query,mysql_error(),$php));
		$arr = array();
		while ($obj = mysql_fetch_object($result)){
			$arr[] = array('fecha' => $obj->fecha,
						   'promedio' => $obj->promedio
				);
		}
		exit(json_encode($arr));
	}
	
	if($_POST["semanaSincache"]){
		$arr = array();
		$cantidad_meses_obtener = configuracion_cms('grafico_meses');
		$meses = array();
		$aao_actual = date("Y");
		$mes_actual = date("m");
		array_push($meses,$mes_actual);
		$j=1;
		while($j < $cantidad_meses_obtener){
			$mes_obtener = date("m",strtotime("-$j month"));
			array_push($meses,$mes_obtener);
			$j++;
		}
		$meses = implode(",", $meses);
		$query= "SELECT WEEK(fecha) semana
				FROM estadisticas_acciones
				WHERE month(fecha) IN ($meses)
				AND YEAR(fecha) = '$aao_actual'
				GROUP BY WEEK(fecha)";
		
		$result= cms_query($query)or die(error($query,mysql_error(),$php));
		$semanas = array();
		while(list($numero_semana) = mysql_fetch_row($result)){
			array_push($semanas,$numero_semana);
		}
		$semanas = implode(",", $semanas);
		
		$query = "
				SELECT month(fecha) mes,min(DAYOFMONTH(fecha)) minimo, max(DAYOFMONTH(fecha)) maximo, avg(tiempo) promedio
				FROM estadisticas_acciones
				WHERE year(fecha) = '$aao_actual'
				AND cache = 0
				AND month(fecha)
				AND month(fecha) in ($meses)
				AND week(fecha,1) in ($semanas)
				GROUP BY month(fecha), WEEK(fecha,1) 
				ORDER BY month(fecha), WEEK(fecha,1) ASC
				";				
		//echo $query."<br>";
		
		
		$result= cms_query($query)or die(error($query,mysql_error(),$php));
		while ($obj = mysql_fetch_object($result)){
			$arr[] = array('mes' => $obj->mes,
						   'minimo' => $obj->minimo,
						   'maximo' => $obj->maximo,
						   'promedio' => $obj->promedio
				);
		}
		exit(json_encode($arr));
	}
	
	if($_POST["mesSincache"]){
		$fecha_actual = date('Y-m-d');
		$intervalo_meses = configuracion_cms('grafico_cantidad_meses');
		$query= "SELECT DATE_SUB('$fecha_actual',INTERVAL $intervalo_meses MONTH);";
		$result= cms_query($query)or die(error($query,mysql_error(),$php));
		list($fecha_anterior) = mysql_fetch_row($result);
		$query= " SELECT YEAR(fecha) aao, MONTH(fecha) mes, avg(tiempo) promedio
					FROM estadisticas_acciones
					WHERE fecha
					BETWEEN '$fecha_anterior'
					AND '$fecha_actual'
					AND cache = 0
					GROUP BY MONTH(fecha)
				";
		$result= cms_query($query)or die(error($query,mysql_error(),$php));
		$arr = array();
		while ($obj = mysql_fetch_object($result)){
			$arr[] = array('aao' => $obj->aao,
						   'mes' => $obj->mes,
						   'promedio' => $obj->promedio
				);
		}
		exit(json_encode($arr));
	
	}
	
?>