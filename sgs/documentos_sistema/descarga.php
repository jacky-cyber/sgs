<?php 
$folio_=$_GET['folio'];
$carpeta_=$_GET['iddoc'];


//$nombre_=$_GET['nombrearchivo'];

//$nombre_ = rescata_valor('sgs_solicitudes_documentos',$carpeta_,'archivo_solicitudes_doc');

$query_nombre_archivo = "SELECT archivo_solicitudes_doc  
						 FROM sgs_solicitudes_documentos 
						 WHERE folio = '$folio_'
						 AND id_solicitudes_doc = $carpeta_";
$result_nombre_archivo = cms_query($query_nombre_archivo)or die (error($query_nombre_archivo,mysql_error(),$php));
list($nombre_)= mysql_fetch_row($result_nombre_archivo);


$ruta_descarga = configuracion_cms("ruta_descarga_archivos");
 
$root = "$ruta_descarga/$folio_/$carpeta_/";


$archivo = basename($nombre_);
$path = $root.$archivo;
//echo $path;
$query_numero_descargas="SELECT cantidad_descarga_doc  
						 FROM sgs_solicitudes_documentos 
						 WHERE id_solicitudes_doc=$carpeta_";
			
$result_num_docto= cms_query($query_numero_descargas)or die (error($query_numero_descargas,mysql_error(),$php));

list($contador_descargas)= mysql_fetch_row($result_num_docto);

$totalActualDescarga=$contador_descargas+1;

$query_contador_descargas="UPDATE sgs_solicitudes_documentos  
						 SET cantidad_descarga_doc= $totalActualDescarga
						 WHERE id_solicitudes_doc=$carpeta_";
			
$ress=cms_query($query_contador_descargas)or die (error($query_contador_descargas,mysql_error(),$php));



                                                              
    $type = "application/octet-stream";
    header("Content-Type: $type");                                        
    header("Content-Disposition: attachment; filename=$archivo");         
	$fp=fopen("$path", "r");
    fpassthru($fp);   
	
                                                               
?>