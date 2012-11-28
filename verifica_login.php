<?php

 
include("lib/connect_db.inc.php");


$fp=fopen("login.txt","r");



while ($linea=fgets($fp,1024))
      {
      $aux=explode(",", $linea);

      $login    = trim(strtolower(trim($aux[0])));

            
            /*
 * Select tabla USUARIOS
 * 
 */
$query= "SELECT id_usuario  
           FROM  usuario
           WHERE login = '$login'";
     $result_USUARIOS= mysql_query($query)or die (mysql_error());
      if(!list($id_usuario) = mysql_fetch_row($result_USUARIOS)){
$cont++;		
                //echo "$cont $login no encontrado<br>";
				echo "$login<br>";
		 }
/** fin select USUARIOS***/		
                
	}
                
                

?>