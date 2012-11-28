<?php

include("lib/connect_db.inc.php");


$tabla="chileatiende_consulta";
$sql_master = "DESCRIBE $tabla";

$res = mysql_query($sql_master);
while($row = mysql_fetch_array($res)) {
    if($row['Key']=='PRI'){
        $nom_campo =$row['Field'];
        $condicion_pk="$nom_campo='$id_valorpk'";
    }
}


echo $condicion_pk;

                                                                
      phpinfo();                                                          
                                                                
?>