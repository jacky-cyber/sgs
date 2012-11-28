<?php
//error_reporting(E_ALL);

    //include("../../lib/lib.inc");
//	include("../../lib/connect_db.inc.php");
	
	
	set_time_limit(0);
	
	$sql = "delete from sgs_folio_tramo_estadistica ;";
			cms_query($sql) or die ("Error en la consulta:<br>$sql<br>".mysql_error());
	
	$id_servicio = configuracion_cms('id_servicio');
	
	
	//verificacion y creacion del nuevo tramo
	$sql = "Select count(*) from sgs_tramos where nombre_vencimiento = 'Solicitudes con errores'";
	$result = cms_query($sql) 
		or die("<br>la consulta fallo  <br>$sql<br> ".mysql_error());
	list($cantidad) = mysql_fetch_row($result);
	
	if ($cantidad==0){
		$sql = "INSERT INTO sgs_tramos VALUES (6,'Solicitudes con errores',NULL,'Tienen inconsistencia en el historial');";

		cms_query($sql) 
			or die("<br>la consulta fallo  <br>$sql<br> ".mysql_error());		
	}
	//FIN verificacion y creacion del nuevo tramo
	
	////echo "<br>";
						
	$entidades = configuracion_cms('id_entidad');
	//echo "<br>entidades configuradas:". $entidades."<br>";
	
	$sql = "delete from sgs_estadistica_agregada ";
	$result = cms_query($sql) 
		or die("<br>la consulta fallo 0  <br>$sql<br> ".mysql_error());	
	
	$aValores = split(",",$entidades);
	
	
	for($i=0;$i<count($aValores);$i++){
		//echo "<br>procesa:".$aValores[$i];
		procesarSolicitudes($aValores[$i]);
	}
	
	

	function procesarSolicitudes($id_entidad_funcion){
		//sacar las solicitudes por estado
		////echo "<br> entra a procesar solicitudes ";
		
		$sql = "Select folio,id_entidad,id_sub_estado_solicitud,fecha_termino,folio,fecha_inicio
				from sgs_solicitud_acceso
				where id_entidad = '$id_entidad_funcion'	
				
				order by fecha_termino desc";
				
		//echo "<br>".$sql ."<br><br>";
		$result = cms_query($sql) 
						or die("<br>la consulta fallo 1  <br>$sql<br> ".mysql_error());	
		////echo "<br>cantidad en procesar solicitud:".mysql_num_rows($result);
		$i=1;
		while(list($folio,$id_entidad,$id_sub_estado_solicitud,$fecha_termino,$folio,$fecha_inicio) = mysql_fetch_row($result) ){
			//calculo de dias no habiles
			//echo "<br><br><br>$i .- id entidad:".$id_entidad."  id_sub_estado_solicitud:".$id_sub_estado_solicitud."  fecha_termino".$fecha_termino."   folio:".$folio."  fecha inicio:".$fecha_inicio;
			$fecha_inicio_sol = $fecha_inicio;
			//////echo "<br><br><br>";
			$fecha_inicio = date("Y-m-d");
			//////echo "<br>fecha_termino:".$fecha_termino;
			////echo "<br>antes de calculaDiasHabilesEntreFechas";
			////echo "<br>fecha inicio:  ".$fecha_inicio."   fecha termino:".$fecha_termino;
			$dias = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_termino);
			////echo "<br>dias: ".$dias ;
			////echo "<br>despues de calculaDiasHabilesEntreFechas";
			/* congelar las solicitudes finalizadas */
			$estados_fin = configuracion_cms('Estados_etapa_fin');
			////echo "<br>estados fin:".$estados_fin;
			$aEstados = split(",",$estados_fin);
			$finalizada = 0;
			$j=0;
			////echo "<br>entra al while:";
			while($j < count($aEstados)){
				////echo "<br>id_sub_estado_solicitud:".$id_sub_estado_solicitud;
				if ($id_sub_estado_solicitud ==  $aEstados[$j]){
					$finalizada = 1;
				}
				$j++;
			}
			////echo "<br>sale del while:";
			if ($finalizada == 1){
				$dias = "";
				$sql = "Select fecha from sgs_flujo_estados_solicitud _solicitud where folio = '$folio' and id_estado_solicitud = $id_sub_estado_solicitud";
				//echo "<br>$sql";
				$resultado_fecha = cms_query($sql)or die (error($sql,mysql_error(),$php));
				list($fecha_respuesta) = mysql_fetch_row($resultado_fecha);
				
				////echo "<br>antes de calculaDiasHabilesEntreFechas";
				//echo "<br><b>fecha respuesta:  ".$fecha_respuesta."   fecha termino:".$fecha_termino."</b>";
				////echo "<br><b>fecha respuesta:  ".$fecha_respuesta." </b>";
				
				if (trim($fecha_respuesta)!=""){
					////echo "<br> entra a calcular los dias";
					$dias = calculaDiasHabilesEntreFechas($fecha_respuesta,$fecha_termino);
				}
				////echo "<br>dias aca:".$dias;
				////echo "<br>despues de calculaDiasHabilesEntreFechas";
				
			}
			
			/*  fin congelar solicitudes finalizadas	*/
			//echo "<br><b>dias aca:".$dias."</b>";
			$tramo_consulta = procesaTramos($id_entidad,$id_sub_estado_solicitud,$dias);
			$i++;	
			//insertar solicitud, tramo,entidad
			$sql = "INSERT INTO sgs_folio_tramo_estadistica (id_entidad,folio,id_tramo,id_estado) values ($id_entidad,'$folio',$tramo_consulta,$id_sub_estado_solicitud);";
			cms_query($sql) or die ("Error en la consulta:<br>$sql<br>".mysql_error());
			
			//echo "<br> tramo consulta ".$tramo_consulta;
			
		}
		
		////echo "<br>antes de generaXML";
		//$xml = generaXML($id_entidad_funcion);
		
		return 1;
	}
	
	function generaXML($id_entidad)
	{
		//////echo " <br>id_entidad:".$id_entidad;
		////echo "<br>entra a generaXML ";
		$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
		$xml = $xml."<transaccion>";	
		$xml = $xml."<id_entidad>$id_entidad</id_entidad>";
		
		$sql = "Select id_estado,id_tramo,cantidad from sgs_estadistica_agregada where id_entidad=".$id_entidad;
		$result = cms_query($sql) or die ("la consulta fallo 2  <br>$sql".mysql_error());
		
		while (list($id_estado,$id_tramo,$cantidad)= mysql_fetch_row($result)){
		
			////echo "<br> id_estado:".$id_estado."  id_tramo:".$id_tramo."    cantidad:".$cantidad."<br>";
			$xml = $xml."<sgs_estadistica>";
			$xml = $xml."<id_estado>$id_estado</id_estado>";
			$xml = $xml."<id_tramo>$id_tramo</id_tramo>";
			$xml = $xml."<cantidad>$cantidad</cantidad>";
			$xml = $xml."</sgs_estadistica>";
		
		}
		$xml = $xml."</transaccion>";
	
		return $xml;
	}
	
	
	function procesaTramos($id_entidad,$id_estado,$dias){
		//echo "<br> en procesa tramos:&nbsp;&nbsp;id_estado:$id_estado&nbsp;&nbsp;dias:$dias ";
		 $sql = "Select id_tramo,
						nombre_vencimiento,
						descripcion_vencimiento,
						condicion_vencimiento_dias_habiles 
				FROM sgs_tramos
				where id_tramo <= 5";
		
		$result = cms_query($sql) 
					or die("<br>la consulta fallo 3  <br>$sql<br> ".mysql_error());	
		$tramo_consulta = "";
		if (trim($dias)!=""){
			while (list($id_tramo,$nombre_tramo,$descripcion_tramo,$condicion_vencimiento_dias_habiles) = mysql_fetch_row($result)){
					
					//echo "<br> id_tramo: ".$id_tramo."  nombre_tramo: ".$nombre_tramo."  descripcion:".$descripcion_tramo."   condicion vencimiento:".$condicion_vencimiento_dias_habiles;
					$aCondiciones = split(',',$condicion_vencimiento_dias_habiles);
					//////echo "<br>primero: ".$aCondiciones[0];
					//////echo "<br>segundo: ".$aCondiciones[1]."<br>";
					//////echo "<br>dias:".$dias;
					if ($aCondiciones[0] > 0){
						if ($dias > 0){
							if ($aCondiciones[1] == "mayor"){
								if ($dias >= $aCondiciones[0]){
									//////echo "entra aca";
									$tramo_consulta =  $id_tramo;
								}
							}else{
								if ( ($dias >= $aCondiciones[0]) && ($dias <= $aCondiciones[1]) ){
									$tramo_consulta =  $id_tramo;
								}
							}
						}
					}
					if ($aCondiciones[0] <= 0){
						//////echo "<br>dias:$dias&nbsp;&nbsp;aCondiciones[0]:".$aCondiciones[0]."&nbsp;&nbsp;aCondiciones[1]:".$aCondiciones[1];
						if ($dias <= 0){
							if ($aCondiciones[1] == "menor"){
								//////echo "<br>entro aca 1";
								if ($dias <= $aCondiciones[0]){
									//////echo "<br>entra aca";
									$tramo_consulta =  $id_tramo;
								}
								
							}else{
								
								if ( ($dias <= $aCondiciones[0]) && ($dias >= $aCondiciones[1]) ){
									//////echo "entra abajo";
									$tramo_consulta =  $id_tramo;
								}
							}
						}
					}
					
					//////echo "<br>tramo_consulta:".$tramo_consulta;
				
					
			}
			
	}else{
		$tramo_consulta = 6;
	}
		//////echo "<br> tramo consulta:".$tramo_consulta."<br>";
		//realizar operacion
		//////echo "<br>";
		////echo "<br>antes de cargaTablaEstadistica";
		$cantidad = cargaTablaEstadistica($id_entidad,$id_estado,$tramo_consulta);
		return $tramo_consulta;
	
	}
	
	
	function cargaTablaEstadistica($id_entidad,$id_estado,$id_tramo){
		
		//validar si existe la combinacion
		////echo "<br>entra a cargaTablaEstadistica";
		//echo "<br>";
		$sql = "Select cantidad 
				from sgs_estadistica_agregada
				where id_entidad = '".$id_entidad."' 
					and id_estado = '".$id_estado."' 
					and id_tramo = '".$id_tramo."'";

		//echo "<br>$sql";
		$result = cms_query($sql) 
					or die("<br>la consulta fallo 4  <br>$sql<br> ".mysql_error());	
					
		////echo "<br>consulta: ".$sql."<br>";
		//echo "<br>cantidad registros:".mysql_num_rows($result);
		if (mysql_num_rows($result)>0){
			
			list($cantidad)= mysql_fetch_row($result);
			$cantidad ++;
			$sql = "update sgs_estadistica_agregada set cantidad = ".$cantidad." 
					where id_entidad = '".$id_entidad."' 
						and id_estado = '".$id_estado."' 
						and id_tramo = '".$id_tramo."'";
			$result = cms_query($sql) 
					or die("<br>la consulta fallo 5  <br>$sql<br> ".mysql_error());	
			//echo "<br>$sql";
			
		}else{
			
			$sql = "insert into sgs_estadistica_agregada(id_entidad,id_estado,id_tramo,cantidad,fecha) values
												(".$id_entidad.",".$id_estado.",".$id_tramo.",1,'".date('Y-m-d')."');";
			$result = cms_query($sql) 
					or die("<br>la consulta fallo 6  <br>$sql<br> ".mysql_error());	
			//echo "<br>$sql";
			
		}
		////echo "<br>cantidad:".$cantidad;
		return $cantidad;
	
	
	}



?>