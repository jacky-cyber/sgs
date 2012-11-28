<?php


include("../lib/connect_db.inc.php");    

$fp=fopen("hospitales.csv","r");



while ($linea=fgets($fp,1024))
      {
      $aux=explode(";", $linea);

      $cod    = trim($aux[0]);
      $hosp    = strtolower(trim($aux[1]));
		
				$hosp = htmlentities($hosp);
				
				$query="INSERT INTO sgs_entidades  (id_entidad,id_entidad_padre,entidad,sigla,orden)
                    VALUES (null, '16', '$hosp', '$cod','')";
					
					
             //  mysql_query($query) or die("2: Error en insert a la base de datos");
		}
?>