<?php


//include("admin/administracion_sistema/lista_xls.php ");
 
include("../../../lib/connect_db.inc.php");    
include("../../../lib/lib.inc.php");    





  $query= "SELECT region   
           FROM  regiones
           WHERE id_region='$id_region'";
     $result_r= mysql_query($query)or die (mysql_error());
      list($region) = mysql_fetch_row($result_r);

      $query= "SELECT comuna   
           FROM  comunas
           WHERE id_comuna='$id_comuna'";
     $result_c= mysql_query($query)or die (mysql_error());
      list($comuna) = mysql_fetch_row($result_c);



 $query= "SELECT id_usuario,nombre,apellido,email,direccion,fono,celular,id_region,id_comuna  
           FROM  usuario";
     $result= mysql_query($query)or die (mysql_error());
      while (list($id_usuario,$nombre,$apellido,$email,$direccion,$fono,$celular,$id_region,$id_comuna) = mysql_fetch_row($result)){
		 	 
		 $data .="$id_usuario \t $nombre \t $apellido \t $email \t $direccion \t $fono \t $celular \t $id_region \t $id_comuna \n";                

		 } 
		 
		 
		 $headerp .=" id_usuario \t nombre \t apellido \t email \t direccion \t fono \t celular \t id_region \t id_comuna \n";
		
	

//$ext       = 'csv';+
$ext       = 'xls';
$mime_type = 'text/x-csv';

// Se envian los encabezados
header('Content-Type: ' . $mime_type);
$filename="lista_usuario";
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


/*
$data = str_replace("\r", "", $data);

header("Content-type: application/octet-stream");
   
   
//header("Content-Disposition: attachment; filename=$nombre_archivo.xls");
header("Content-Disposition: attachment; filename=prueba.xls");
header("Pragma: no-cache");
header("Expires: 0");

$css="";
*/
echo $headerp."\n".$data; 


?>