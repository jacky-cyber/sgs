<?php



$query= "SELECT * 
		FROM usuario
		WHERE id_usuario=$id_user"; 

$result= cms_query($query)or die ("ERROR $php <br>$query"); 
$num_filas = mysql_num_fields($result); 
$resultado = mysql_fetch_row($result); 
$i=0;
for (
$i = 1; $i < $num_filas; $i++){ 
$nom_campo = mysql_field_name($result,$i); 
$valor = $resultado[$i]; 

$$nom_campo = $valor; 
} 


?>