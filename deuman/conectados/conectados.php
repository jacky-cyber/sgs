<?php
/*


create table deuman_gente_online ( 
date int not null, 
ip varchar(40) not null 
);



*/


include("../../lib/connect_db.inc.php");    

// nos conectamos a la BD
//require_once('connections.php');
// Tiempo máximo de espera
$time = 5 ;
// Momento que entra en línea
$date = time() ;
// Recuperamos su IP
$ip = $REMOTE_ADDR ;
// Tiempo Limite de espera 
$limite = $date-$time*60 ;
// si se supera el tiempo limite (5 minutos) lo borramos
mysql_query("delete from deuman_gente_online where date < $limite") ;
// tomamos todos los usuarios en linea
$resp = mysql_query("select * from deuman_gente_online where ip='$ip'") ;
// Si son los mismo actualizamos la tabla deuman_gente_online
if(mysql_num_rows($resp) != 0) {
	mysql_query("update deuman_gente_online set date='$date' where ip='$ip'") ;
}
// de lo contrario insertamos los nuevos
else {
	mysql_query("insert into deuman_gente_online (date,ip) values ('$date','$ip')") ;
}
// Seleccionamos toda la tabla
$query = "SELECT * FROM deuman_gente_online";
// Ocultamos algún mensaje de error con @
$resp = @mysql_query($query) or die(mysql_error());
// almacenamos la consulta en la variable $usuarios_online
$usuarios_online = mysql_num_rows($resp);
// Si hay 1 usuarios se muestra en singular; si hay más de uno, en plural
if($usuarios_online > 1 || $usuarios_online == 0){
	echo("Hay ");
}else{
	echo("Hay ");
}
	
if($usuarios_online == 0){
	echo("no ");
}else{
	echo($usuarios_online." ");
}

if($usuarios_online > 1 || $usuarios_online == 0){
	echo("usuarios en línea.");
}else{
	echo("usuario en línea.");
}


?>

