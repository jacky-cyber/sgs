<?php

	if (!isset($_SERVER['PHP_AUTH_USER'])) {
	    	header('WWW-Authenticate: Basic realm="Minsegpres"');
	    	header('HTTP/1.0 401 Unauthorized');
	    	echo 'No autorizado';
	    	exit;
		}
		else {

			//if ($_SERVER['PHP_AUTH_USER']=='minsegpres' && md5($_SERVER['PHP_AUTH_PW'])=='e10adc3949ba59abbe56e057f20f883e' and $_SERVER['REMOTE_ADDR']=='163.247.57.10'){
		    	//Aqui debe ir el codigo que genera el XML
			if ($_SERVER['PHP_AUTH_USER']=='minsegpres' && md5($_SERVER['PHP_AUTH_PW'])=='01b2fd3cfae597cb856983b8af0858bd' ){
				
				
	error_reporting(E_ERROR);

	include("../../lib/lib.inc.php");
	include("../../lib/lib.inc2.php");
	
	include("../../lib/connect_db.inc.php");
	
	
	set_time_limit(0);
	
	$id_entidad = $_GET['id_entidad'];//"128";//;configuracion_cms('id_entidad');
	//////echo "<br>aca :".$id_entidad;
	
	/*$sql = "SELECT a.id_entidad, b.entidad, 
				 COUNT( * ) cantidad 
			FROM sgs_solicitud_acceso a, sgs_entidades b 
			WHERE a.id_entidad = b.id_entidad 
			AND a.id_entidad_padre = b.id_entidad_padre 
			AND a.id_entidad in(139) 
			
			GROUP BY id_entidad, b.entidad ORDER BY id_entidad,MONTH (fecha_inicio)";
	
	
	$result = mysql_query($sql) 
						or die("<br>la consulta fallo  <br>$sql<br> ".mysql_error());
	list($id_entidad, $entidad,$cantidad_w) = mysql_fetch_row($result);
	
	echo "total solicitudes : ".$cantidad_w."<br>";
	*/
	
	//verificacion y creacion del nuevo tramo
	$sql = "Select count(*) from sgs_tramos where nombre_vencimiento = 'Solicitudes con errores'";
	$result_1 = mysql_query($sql) 
		or die("<br>la consulta fallo  <br>$sql<br> ".mysql_error());
	list($cantidad) = mysql_fetch_row($result_1);
	
	if ($cantidad==0){
		$sql = "INSERT INTO sgs_tramos VALUES (6,'Solicitudes con errores',NULL,'Tienen inconsistencia en el historial');";
		mysql_query($sql) 
			or die("<br>la consulta fallo  <br>$sql<br> ".mysql_error());		
	}
	//FIN verificacion y creacion del nuevo tramo
	
	////echo "<br>";
	
	echo $xml = procesarSolicitudes($id_entidad);
	

	
	
	
	
	
	


			//	echo "hola ".$_SERVER['PHP_AUTH_USER']." ip->".$_SERVER['REMOTE_ADDR'];
		    	return;
			}
		    else{
		    	header('WWW-Authenticate: Basic realm="My Realm"');
		    	header('HTTP/1.0 401 Unauthorized');
		    	echo 'No autorizado ' ;
		    	exit;
		    }
		}
		
	function procesarSolicitudes($id_entidad_funcion){
		//sacar las solicitudes por estado
		////echo "<br> entra a procesar solicitudes ";
		$continuar = 1;
		$grilla = crearMatriz();
		
		$sql = "Select id_entidad,id_sub_estado_solicitud,fecha_termino,folio,fecha_inicio
				from sgs_solicitud_acceso
				where id_entidad = '$id_entidad_funcion'	
				
				order by fecha_termino desc";
				
		//echo "<br>".$sql ."<br><br>";
		$result_3 = mysql_query($sql) 
				or die("<br>la consulta fallo 1  <br>$sql<br> ".mysql_error());	
		$cantidad_total = mysql_num_rows($result_3);
		$i=1;
		while(list($id_entidad,$id_sub_estado_solicitud,$fecha_termino,$folio,$fecha_inicio) = mysql_fetch_row($result_3) ){
			//calculo de dias no habiles
			//echo "<br><br>$i .- id entidad:".$id_entidad."  id_sub_estado_solicitud:".$id_sub_estado_solicitud."  fecha_termino".$fecha_termino."   folio:".$folio."  fecha inicio:".$fecha_inicio;
			$fecha_inicio_sol = $fecha_inicio;
			//////echo "<br><br><br>";
			$fecha_inicio = date("Y-m-d");
			//////echo "<br>fecha_termino:".$fecha_termino;
			////echo "<br>antes de calculaDiasHabilesEntreFechas";
			////echo "<br>fecha inicio:  ".$fecha_inicio."   fecha termino:".$fecha_termino;
			
			if($fecha_termino=="0000-00-00"){
				$mensaje .= "<br>La solicitud $folio tiene fecha de termino en 0000-00-00";
				$continuar = 0;
			}
			if($fecha_inicio=="0000-00-00"){
				$mensaje .= "<br>La solicitud $folio tiene fecha de inicio en 0000-00-00";
				$continuar = 0;
				
			}
			
			////echo "<br>dias: ".$dias ;
			////echo "<br>despues de calculaDiasHabilesEntreFechas";
			/* congelar las solicitudes finalizadas */
			$estados_fin = configuracion_cms('Estados_etapa_fin').",". configuracion_cms('Estados_etapa_respondida');
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
				if ($id_estado_solicitud==28){
					$id_estado_solicitud=14;
				}
				if ($id_estado_solicitud==29){
					$id_estado_solicitud=15;
				}
				$sql = "Select fecha from sgs_flujo_estados_solicitud _solicitud where folio = '$folio' and id_estado_solicitud = $id_sub_estado_solicitud";
				//echo "<br>$sql";
				$resultado_fecha = mysql_query($sql)or die("error:<br>$sql<br> ".mysql_error());
				list($fecha_respuesta) = mysql_fetch_row($resultado_fecha);
				if($fecha_respuesta=="0000-00-00"){
					$mensaje .= "<br>La solicitud $folio tiene fecha de inicio en 0000-00-00";
					$continuar = 0;
					
				}

				
				////echo "<br>antes de calculaDiasHabilesEntreFechas";
				//echo "<br><b>fecha respuesta:  ".$fecha_respuesta."   fecha termino:".$fecha_termino."</b>";
				////echo "<br><b>fecha respuesta:  ".$fecha_respuesta." </b>";
				
				if ((trim($fecha_respuesta)!="")and($fecha_respuesta!="0000-00-00")){
					////echo "<br> entra a calcular los dias";
					if ($continuar == 1){
						$dias = calculaDiasHabilesEntreFechas($fecha_respuesta,$fecha_termino);
					}
				}
				////echo "<br>dias aca:".$dias;
				////echo "<br>despues de calculaDiasHabilesEntreFechas";
				
			}else{
				if ($continuar == 1){
					$dias = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_termino);
				}
			}
			
			/*  fin congelar solicitudes finalizadas	*/
			//echo "<br><b>dias aca:".$dias."</b>";
			$id_tramo = procesaTramos($id_entidad,$id_sub_estado_solicitud,$dias);
			//echo "<br>id_estado:".$id_sub_estado_solicitud."   id_tramo:".$id_tramo;
			$grilla = almacenaValor($id_sub_estado_solicitud,$id_tramo,$grilla);
			if ($i>=$cantidad_total){
				break;
			}
			$i++;
			
			//echo "<br> tramo consulta ".$tramo_consulta;
		}
		
		////echo "<br>antes de generaXML";
		$xml = "";
		if ($continuar == 1){
			$xml = generaXML($grilla,$id_entidad);
		}else{
			echo $mensaje ;
		}
		
		return $xml;
	}
	
	function almacenaValor($id_estado,$id_tramo,$grilla){
	
		for($i=0;$i<count($grilla);$i++){
			   if(($grilla[$i][0] == $id_estado) and ($grilla[$i][1] == $id_tramo) ){
				 $cantidad =  $grilla[$i][2] ;
				 $cantidad = $cantidad + 1;
				 $grilla[$i][2] = $cantidad;
				 break;
			   }
		}		       
	
		return $grilla;
	}
	function crearMatriz(){

		//crear una matriz
		//Inicializar la grilla
		$sql = "select id_estado_solicitud,estado_solicitud from sgs_estado_solicitudes";
		$result = mysql_query($sql)
					or die ("<br>ERROR $php <br>$query<br><br><span style='color:#FF0000'><b>".mysql_error()."</b></span>");
									
		$i=0;
		while (list($id_estado,$estado)=mysql_fetch_row($result)){
		     //para cada estado crear la combinatoria de los tramos
		     $sql = "select id_tramo from sgs_tramos;";
		     $result_tramo = mysql_query($sql)
				  or die ("<br>ERROR $php <br>$query<br><br><span style='color:#FF0000'><b>".mysql_error()."</b></span>");
		     while (list($id_tramo)= mysql_fetch_row($result_tramo)){
			 $grilla[$i][0]= $id_estado;//id_estado
			 $grilla[$i][1]= $id_tramo;//id_tramo
			 $grilla[$i][2]= 0;//cantidad
			 $i++;
		     }
			  
		}
		return $grilla;
		
	}
	
		function procesaTramos($id_entidad,$id_estado,$dias){
		//echo "<br> en procesa tramos:&nbsp;&nbsp;id_estado:$id_estado&nbsp;&nbsp;dias:$dias ";
		$cantidad = 0;
		$sql = "Select id_tramo,
				nombre_vencimiento,
				descripcion_vencimiento,
				condicion_vencimiento_dias_habiles 
			FROM sgs_tramos
			where id_tramo <= 5";
		
		$result_5 = mysql_query($sql) 
					or die("<br>la consulta fallo 3  <br>$sql<br> ".mysql_error());	
		$tramo_consulta = "";
		if (trim($dias)!=""){
			while (list($id_tramo,$nombre_tramo,$descripcion_tramo,$condicion_vencimiento_dias_habiles) = mysql_fetch_row($result_5)){
					
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
		return $tramo_consulta;
	
	}
	function generaXML($grilla,$id_entidad)
	{
		header('Content-Type: text/xml');
		$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
		$xml = $xml."<transaccion>";	
		$xml = $xml."<id_entidad>$id_entidad</id_entidad>";
		
		//echo "<br>cantidad grilla:". count($grilla)."<br>";
		for($i=0;$i<count($grilla);$i++){
		
			//echo "<br> id_estado:".$id_estado."  id_tramo:".$id_tramo."    cantidad:".$cantidad."<br>";
			if ($grilla[$i][2]>0){
				$xml = $xml."<sgs_estadistica>";
				$xml = $xml."<id_estado>".$grilla[$i][0]."</id_estado>";
				$xml = $xml."<id_tramo>".$grilla[$i][1]."</id_tramo>";
				$xml = $xml."<cantidad>".$grilla[$i][2]."</cantidad>";
				$xml = $xml."</sgs_estadistica>";
			}
			
			//$suma = $suma + $cantidad;
		
		}
		//echo "<br> cantidad de solicitudes :".$suma;
		$xml = $xml."</transaccion>";
		return $xml;
		
	}





?>