<?php

 $fecha = date(Y)."-".date(m)."-".date(d);
	 $id_usuario     = id_usuario($id_sesion);
	 
	 
	 
     $qry_insert="INSERT INTO sgs_flujo_estados_solicitud(folio,id_estado_solicitud,id_estado_respuestas,fecha,id_usuario,observacion) 
	 			  values ('$folio','$id_estado_solicitud','$id_estado_respuestas','$fecha','$id_usuario','$observacion')";
                   
                     $result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
	 

?>