<?php
include("../../../lib/connect_db.inc");
include("../../../lib/lib.inc");

$tipo = $HTTP_GET_VARS['tipo'];



$ext       = 'csv';
$mime_type = 'text/x-csv';

      $query= "SELECT descrip   
             FROM mailing_usuario_tipo WHERE id_tipo_u = '$tipo'";
            $result= cms_query($query)or die ("ERROR 1 <br>$query");
			
			list($nombre_bd) = mysql_fetch_row($result);

// Se envian los encabezados
header('Content-Type: ' . $mime_type);

// lem9 & loic1: IE necesita encabezados especiales
if (PMA_USR_BROWSER_AGENT == 'IE') {
        header('Content-Disposition: inline; filename="' . $nombre_bd . '.' . $ext . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
}
else {
        header('Content-Disposition: attachment; filename="' . $nombre_bd . '.' . $ext . '"');
        header('Expires: 0');
        header('Pragma: no-cache');
}

  



  $query= "SELECT nombre,apellido,mail,mail2,telefono1,telefono2,direccion  
           FROM mailing_usuario
		   WHERE tipo ='$tipo'
		   ORDER BY nombre ";
           $result= cms_query($query);
		    $num=mysql_num_rows($result);
      echo"Nombre,Apellido,Mail,Mail2,Telefono1,Telefono2,Direccion\n";	
              while (list($nombre,$apellido,$mail,$mail2,$telefono1,$telefono2,$direccion) = mysql_fetch_row($result)){
        				echo"$nombre,$apellido,$mail,$mail2,$telefono1,$telefono2,$direccion\n";		   
        		 }

?>