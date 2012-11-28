<?php
include("../../lib/connect_db.inc.php");    
  
$db_table = 'deuman_actualizaciones' ; 
$db_campo_fecha = 'fecha' ; 
$db_campo_titulo = 'titulo' ; 
$db_campo_descripcion = 'descripcion' ; 
$db_campo_hora = 'hora' ; 
$db_campo_fecha = 'fecha' ; 
$pg_titulo = 'Control de cambios Sgs' ; 
$pg_link = 'http://sgs.probidadytransparencia.gob.cl' ; 
$pg_descripcion = 'Actualizaciones de sistema Sgs' ; 
$pg_idioma = 'es' ; 
$perPage=10;

$writer = new XMLWriter(); 
$writer->openURI('php://output'); 
$writer->startDocument("1.0",'UTF-8'); 

$writer->startElement("transaccion"); 

    $query= "SELECT * FROM $db_table 
			 WHERE 1 
			 ORDER BY $db_campo_fecha,$db_campo_hora DESC 
			 LIMIT 0,$perPage";

 $result= cms_query($query)or die (error($query,mysql_error(),$php));
$cont_registro=0;
while ( $row = mysql_fetch_array($result)){

$writer->startElement("cambios"); 
 
			$writer->startElement("titulo"); 
			$writer->text(utf8_encode($row [$db_campo_titulo]));	
			$writer->endElement(); 	
			
			$desc = preg_replace ( "/[(.*?)]/i" , "" , $row [ $db_campo_descripcion ]); 
			$desc = substr ( $desc , 0 , 230 ); 
			$desc = str_replace ( '<' , '&lt;' , $desc ); 
			$desc = str_replace ( '>' , '&gt;' , $desc ); 
			
			$desc = utf8_encode($desc);
			$writer->startElement("descripcion"); 
			$writer->text($desc);	
			$writer->endElement(); 	
			
			 
			$writer->startElement("hora"); 
			$writer->text($row [ $db_campo_hora ]);	
			$writer->endElement(); 	
			
			$writer->startElement("fecha"); 
			$writer->text($row [ $db_campo_fecha]);	
			$writer->endElement(); 	
			
	$writer->endElement(); 	

	$cont_registro++;
}
$writer->endElement(); 	
$writer->endDocument(); 	 
$writer->flush(); 	

?>