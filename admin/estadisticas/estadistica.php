<?php
function estadistica($DB,$BASE,$accion,$_POST,$id_usuario,$date){




$id_sesion = session_id();	
global $consultas_ejecutadas;	





$time = 1 ;
// Momento que entra en línea
//$date = time() ;
// Recuperamos su IP
$ip = $_SERVER['REMOTE_ADDR'];
// Tiempo Limite de espera 
$limite = $date-$time*60 ;
// si se supera el tiempo limite (5 minutos) lo borramos
mysql_query("delete from deuman_gente_online where date < $limite") ;
// tomamos todos los usuarios en linea
$resp = @mysql_query("select * from deuman_gente_online where ip='$ip' and session ='$id_sesion'") ;
// Si son los mismo actualizamos la tabla deuman_gente_online
if(mysql_num_rows($resp) != 0) {
	@mysql_query("update deuman_gente_online set date='$date' where ip='$ip' and session ='$id_sesion'") ;
}
// de lo contrario insertamos los nuevos
else {
	@mysql_query("insert into deuman_gente_online (date,ip,session,id_usuario) values ('$date','$ip','$id_sesion','$id_usuario')") ;
}


$query = "SELECT * FROM deuman_gente_online";
// Ocultamos algún mensaje de error con @
$resp = @mysql_query($query) or die(mysql_error());
// almacenamos la consulta en la variable $usuarios_online
$usuarios_online = mysql_num_rows($resp);



foreach($_POST as $variable=>$valor){ 
	if($variable =="password" or $variable =="pass" or $variable =="contrasenia" or $variable =="pass_actual" or $variable =="pass" or $variable =="pass2" ){
			$datos_post .="$variable =****/<br> \n";
	}else{
	//$_POST[$variable] = str_replace("'","\'",$_POST[$variable]);
			$reg = $_POST[$variable];
			$reg = str_replace("'","\'",$reg);
   			$datos_post .="$variable =$reg<br> \n";
	}
   			
}

if($accion==""){
		$id_perfil      = perfil($id_sesion);
	  $query= "SELECT url_defecto 
		   FROM  usuario_perfil
		   WHERE id_perfil='$id_perfil'";

     $result= mysql_query($query)or die (error($query,mysql_error(),$php));
   		 if(list($url_defecto) = mysql_fetch_row($result) and $url_defecto!=""){
	
	  		$accion=explode("=", $url_defecto);
			$accion=$accion[1];
			
		 }		
}

$fecha = date(y)."-".date(m)."-".date(d);
$fecha_hora =date('Y-m-d h:i:s');
if($act==""){
$act=0;
}

if(!is_numeric($accion)){
$accion_num = traduce_accion($accion);
}


$url =$_SERVER["REQUEST_URI"];

/*
 * Select tabla cms_configuracion
 * 
 */
$query= "SELECT valor  
           FROM  cms_configuracion
           WHERE configuracion = 'activar cache'";
     $result_cms_configuracion= mysql_query($query);
      list($cache) = mysql_fetch_row($result_cms_configuracion);
/** fin select cms_configuracion***/


$origen = $_SERVER['HTTP_REFERER'];
$id_usuario     = id_usuario($id_sesion);
$datos_post= trim($datos_post);
$qry_insert="INSERT INTO estadisticas_acciones(id_accion,act,fecha,id_usuario,hora,click,url,datos_post,ip,origen,online,tiempo,sqls,cache) 
values ('$accion_num','$act','$fecha','$id_usuario','$fecha_hora',1,'$url','$datos_post','$ip','$origen','$usuarios_online','$tiempo_ejecucion2','$consultas_ejecutadas','$cache')";
      
	if(mysql_query($qry_insert)){
	//echo $qry_insert;    
	}else{
	//echo mysql_error();
	}
	
	/*
 * Select tabla estadisticas_acciones_diaria
 * 
 */


$query2= "SELECT id_estadistica_diaria  
           FROM  estadisticas_acciones_diaria
           WHERE id_accion = '$accion' and fecha ='$fecha'";

 
       $result_estadisticas_acciones_diaria= mysql_query($query2);
    
         if(list($id_estadisticas_acciones_diarias) = mysql_fetch_row($result_estadisticas_acciones_diaria)){
		$Sql ="UPDATE estadisticas_acciones_diaria
		  SET click =click+1
		  WHERE fecha ='$fecha' and id_accion='$accion'";
					 
		  mysql_query($Sql);
		
		
      }else{
		$Sql="INSERT INTO estadisticas_acciones_diaria('id_estadistica_diaria','id_accion','fecha','click')
		values (null,'$accion','$fecha',1)";
              
		mysql_query($Sql);

	
      }


/** fin select estadisticas_acciones_diaria***/

	
	
global $id_estadistica_insert;	
$id_estadistica_insert =@mysql_insert_id();
//echo $id_estadistica_insert."<br>";
$id_sesion = session_id();
$Sql ="UPDATE deuman_sqls
 	   SET id_estadistica='$id_estadistica_insert'
 	   WHERE id_estadistica ='$id_sesion'";
 				  
 	   mysql_query($Sql)or die ("ERROR $php <br>$Sql");




	$micro = microtime();
	$micro = explode(" ",$micro);
	$time_fin  = $micro[1] + $micro[0];
        
    
        $tiempo_ejecucion = $time_fin-$date;
        $tiempo_ejecucion2= round($tiempo_ejecucion,5);
	
$Sql ="UPDATE estadisticas_acciones
	   SET sqls ='$consultas_ejecutadas',tiempo='$tiempo_ejecucion2'
	   WHERE id_estadistica ='$id_estadistica_insert'";
				  
	   @mysql_query($Sql);
  if($_GET['tp']==7){
	echo $Sql;
  }
}

$date = time() ;
$accion2 = traduce_accion($_GET['accion']);

register_shutdown_function('estadistica',$DB,$BASE,$accion2,$_POST,$id_usuario,$date);




?>