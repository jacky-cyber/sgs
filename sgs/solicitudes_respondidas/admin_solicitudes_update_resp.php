<?php

	
	$folio =  $_GET['folio'];
	$id_responsable =  $_POST['id_responsable'];	
	 
	//hacer la asignación del responsable
	if($folio!="")&&($id_responsable!=""){

	
	
	$query= "UPDATE sgs_solicitud_acceso 
			 SET id_responsable = ".$id_responsable." 
             WHERE folio = '".$folio."'";
			
      $result= cms_query($query)or die (error($query,mysql_error(),$php));
	  
	
	 
	  }
	  
	

			
	
	
	


	
?>