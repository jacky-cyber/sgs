<?php

	/*
	$fecha_actual = date('Y-m-d');
	$cantidad_dias_obtener = configuracion_cms('grafico_dias');
	$query= "SELECT DATE_SUB('$fecha_actual',INTERVAL $cantidad_dias_obtener DAY);";
	$result= cms_query($query)or die(error($query,mysql_error(),$php));
	list($fecha_anterior) = mysql_fetch_row($result);
	*/
	
	$query= "SELECT count(*)
           FROM  estadisticas_acciones";
	$result2= cms_query($query)or die (error($query,mysql_error(),$php));
	list($tot_click) = mysql_fetch_row($result2);
	//echo $tot_click;
	
	/*
	// INSERT estadisticas	
	$query= "SELECT id_accion, fecha, count( * ) 
			FROM estadisticas_acciones
			GROUP BY id_accion, fecha
			ORDER BY id_accion,fecha";
	$result3= cms_query($query)or die (error($query,mysql_error(),$php));
	while(list($id_accion,$fecha_accion,$contador) = mysql_fetch_row($result3)){

		$query_ead = "SELECT id_estadistica_diaria
					   FROM estadisticas_acciones_diaria
						WHERE id_accion = '$id_accion'
						AND fecha = '$fecha_accion'
						AND click = '$contador'";
		$result_ead = cms_query($query_ead) or die (error($query_ead,mysql_error(),$php));
		if(!list($registro) = mysql_fetch_row($result_ead)){
			$qry_insert = "INSERT INTO estadisticas_acciones_diaria (id_accion,fecha,click)
				 values ('$id_accion','$fecha_accion','$contador')";
			$result_insert = cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
		}
	}
	*/
	
	
	
	$query= "SELECT a.descrip_php_esp as descripcion, sum(ead.click) as contador
           FROM  estadisticas_acciones_diaria ead, acciones a
		   WHERE a.accion = ead.id_accion
		   GROUP BY a.accion
		   ORDER BY a.descrip_php_esp";

	$result2= cms_query($query)or die (error($query,mysql_error(),$php));
	$arr = array();
	while ($obj = mysql_fetch_object($result2)){
		if($obj->contador > 0){
			$porcentaje = ($obj->contador*100)/$tot_click;
			$porcentaje = round($porcentaje,0);
			if($porcentaje >=1){
				$arr[] = array('descripcion' => $obj->descripcion,
							   'porcentaje' => $porcentaje
					);
			}
		}
	}
	exit(json_encode($arr));


?>