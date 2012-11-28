<?php


include("lib/connect_db.inc.php");    
include("lib/lib.inc.php");    
include("lib/lib.inc2.php");    
   

$id = $_GET['id'];
$campo_url = $_GET['campo'];
$valor_url = $_GET['valor'];

$query2 = "";


if ($campo_url!=""){
	if ($valor_url=="hoy"){
		
		$valor_url = date( 'Y-m-d' );
	}
	$query2 = " WHERE  ".$campo_url." = '".$valor_url."'";
	
}





if($id!=""){
if(is_numeric($id)){
 $query= "SELECT tabla
           FROM  auto_admin
		    WHERE id_auto_admin ='$id' ";
 $result= cms_query($query);
      list($tabla) = mysql_fetch_row($result);
	  
	
}else{
 $query= "SELECT id_auto_admin
           FROM  auto_admin
		    WHERE tabla ='$id' ";
	$result= cms_query($query);
 $tabla = $id;
 list($id) = mysql_fetch_row($result);
 
}

 
   
   

$writer = new XMLWriter(); 
$writer->openURI('php://output'); 
$writer->startDocument("1.0",'iso-8859-1'); 

$writer->startElement("transaccion"); 

  $query= "SELECT count(*)   
           FROM  $tabla ".$query2;
     $result= cms_query($query);
     list($tot_registros_tabla) = mysql_fetch_row($result);

$cont_registro=0;
while ($cont_registro < $tot_registros_tabla){

$writer->startElement("$tabla"); 

 
 
     $query= "SELECT campo ,txt_xml   
           FROM  auto_admin_campo
           WHERE id_auto_admin ='$id' and xml=1 ";
     $result= cms_query($query);
      while (list($campo,$txt_xml) = mysql_fetch_row($result)){
				
				   $query= "SELECT $campo   
                           FROM  $tabla
                           ".$query2."
						   limit $cont_registro,1";
                     $result_campos= cms_query($query);
                     list($valor) = mysql_fetch_row($result_campos);
			
			if($txt_xml!=""){
				$campo= $txt_xml;
				}
			
			
			$valor = utf8_encode($valor);
			$writer->startElement("$campo"); 
			$writer->text($valor);	
			$writer->endElement(); 	
		    
		 }
	$writer->endElement(); 	

	$cont_registro++;
}
$writer->endElement(); 	
$writer->endDocument(); 	 




$writer->flush(); 	


}
 
   


?>