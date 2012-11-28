<?php
	
	if($_POST["fecha_inicio"] && $_POST["fecha_termino"]){
		$fecha_inicio = $_POST["fecha_inicio"];
		$fecha_termino = $_POST["fecha_termino"];
		$fecha_inicio = fechas_bd($fecha_inicio);
		$fecha_termino = fechas_bd($fecha_termino);
		
		/*
		$fecha_hora =date('Y-m-d h:i:s');
		$query= "SELECT INTERVAL -1 DAY + '$fecha_hora';";
		$result= mysql_query($query)or die (error($query,mysql_error(),$php));
		list($ayer) = mysql_fetch_row($result);
		*/

		$query= "SELECT tiempo,sqls,online  
				FROM estadisticas_acciones 
				WHERE fecha BETWEEN '$fecha_inicio' AND '$fecha_termino'
				order by id_estadistica  desc
				Limit 0,40";

		$result= mysql_query($query)or die (error($query,mysql_error(),$php));
		$arr = array();
		while ($obj = mysql_fetch_object($result)){
			$arr[] = array('tiempo' => $obj->tiempo,
						   'online' => $obj->online
				);
		}
		exit(json_encode($arr));
	
	}

?>