<?php

	$folio =  $_GET['folio'];
	$id_responsable =  $_POST['id_responsable'];	
	
	$id_etapas = 3; //En proceso
	$id_estado = 4; //asignada
	 
	//hacer la asignación del responsable
	if(($folio!="")&&($id_responsable!="")){

		$query= "UPDATE sgs_solicitud_acceso 
				 SET id_responsable = ".$id_responsable.",
				 	id_estado_solicitud =".$id_etapas." ,
				 	id_sub_estado_solicitud =".$id_estado." 				 	
				 WHERE folio = '".$folio."'";
				
		$result= cms_query($query)or die (error($query,mysql_error(),$php));
		

		


		envia_asignacion_solicitud($id_responsable,$folio);
		
		$fecha = date ('Y-m-d');
		$id_usuario = id_usuario($id_sesion);
		$observacion = html_template('observacion_asignacion_responsable');
		
		$nombre = rescata_valor('usuario',$id_responsable,'nombre');
		$paterno = rescata_valor('usuario',$id_responsable,'paterno');
		
		$nombre_responsable = $nombre." ".$paterno;
		$observacion = $observacion. ": ".$nombre_responsable;


		//Insertar_historial($folio,$id_estado,$observacion);	 

 		
		$qry_insert="INSERT INTO sgs_flujo_estados_solicitud (folio,id_estado_solicitud,id_estado_respuestas,fecha,id_usuario,observacion) 
					 values ('$folio','$id_etapas','$id_estado_respuestas','$fecha','$id_usuario','$observacion')";
		$result_insert=cms_query($qry_insert) or die (error($query,mysql_error(),$php));
		
		//alerta_etapa($id_estado,$folio);
	  
	  }
	  
	

			
	
	
	


	
?>