<?php


include("admin/administracion_sistema/lista_xls.php ");


  $query= "SELECT campo  
           FROM  auto_admin_campo
           WHERE id_auto_admin='$id_auto_admin'";
  //echo "$query";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($campos) = mysql_fetch_row($result)){

      	
      	$headerp .=" campo \t";
      	
      	
      	
      	 
		 $data .="$campos \t";                

		 } 
		 
/*		 
$ext       = 'csv';
$mime_type = 'text/x-csv';

// Se envian los encabezados
header('Content-Type: ' . $mime_type);

// lem9 & loic1: IE necesita encabezados especiales
if (PMA_USR_BROWSER_AGENT == 'IE') {
        header('Content-Disposition: inline; filename="' . $filename . '.' . $ext . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
}
else {
        header('Content-Disposition: attachment; filename="' . $filename . '.' . $ext . '"');
        header('Expires: 0');
        header('Pragma: no-cache');
}
*/
$data = str_replace("\r", "", $data);

header("Content-type: application/octet-stream");
   
   
header("Content-Disposition: attachment; filename=$nombre_archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");

$css="";

echo $header."\n".$data; 


?>