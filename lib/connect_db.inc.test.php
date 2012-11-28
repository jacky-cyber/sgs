<?php
date_default_timezone_set('America/Santiago');

$HOST_NAME="localhost"; // por lo general es localhost puede ser otra configuracion pero depende del server 

$DB_USERNAME="root";  //usuarios con permisos en la base

$DB_PASSWORD="alvarez"; //pass del usuario

$DATABASE="sgs12_test"; //nombre de la base de datos 


$html_bd ="<html>
<head>
<title>Deuman 1.0</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
</head>
<style type=\"text/css\">
<!--
.h3 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
<body bgcolor=\"#FFFFFF\" text=\"#000000\">
  <table width=\"500\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    <tr><td align=\"center\" class=\"textos\"><img src=\"images/db_remove.png\" alt=\"\" border=\"0\"> </td></tr> 
	<tr>
      <td align=\"center\" class=\"h3\"><p><h3>Lo sentimos, existen problemas con nuestra base de datos.</h3></p>
	  El sitio se encuentra en mantenci&oacute;n</td>
      </tr>
	  <tr><td align=\"center\" class=\"textos\"> </td></tr> 
	</table>
</body>
</html>";


$DB = mysql_connect($HOST_NAME, $DB_USERNAME, $DB_PASSWORD);
$BASE= @mysql_select_db($DATABASE, $DB);
if($BASE==false){


	
include("cache/cache.php");
$cache1 = new cache();
$cache1->iniciar('cache/tmp/',3600,$no_cache);

}


	    $query= "SELECT valor   
               FROM  cms_configuracion
               WHERE configuracion ='charset'";
         $result= mysql_query($query);
          list($codificacion_caracteres) = mysql_fetch_row($result);
		  
	
	mysql_query("SET CHARACTER SET $codificacion_caracteres");
	mysql_query("SET NAMES $codificacion_caracteres"); 
	
//mysql_query("SET CHARACTER SET utf8");
//mysql_query("SET NAMES utf8"); 



//echo get_html_translation_table(HTML_ENTITIES);



function cms_query($sql, $guarda=0){ 
	
	global $consultas_ejecutadas;
	global $id_estadistica_insert;
	$consultas_ejecutadas++;
    
	
	$starttim = microtime();
	$starttim = explode(' ', $starttim);
	$starttime = $starttim[1] + $starttim[0];

	$query_cms = mysql_query($sql);
	
	$micro = microtime();
	$micro = explode(' ', $micro);
	$endtime = $micro[1] + $micro[0];	
	

	 $tiempo_tot= round(($endtime - $starttime),7);
	 if($tiempo_tot>0.00001){
	   //    $tiempo_tot =0;
	 
	$query2= "SELECT id_configuracion 
			   FROM  cms_configuracion
			   WHERE configuracion ='monitorear_sql' and valor = 1";
		 $result2= mysql_query($query2);
		 if (list($id_configuracion) = mysql_fetch_row($result2) or $guarda==1){
		    $id_estadistica_insert =  session_id();
		    $sql2= trim($sql);
		    $sql2 = str_replace("'","\'",$sql2);
		    $act= $_GET['act'];
		    $accion = $_GET['accion'];
    			$qry_insert="INSERT INTO deuman_sqls(id_sqls,id_estadistica,sql2,tiempo,act,accion)
				       values (null,'$id_estadistica_insert','$sql2','$tiempo_tot','$act','$accion')";
			if($_GET['tp']==8){
			      $result_insert= mysql_query($qry_insert) ;
			}
					   
    		 } 
	 }
	return $query_cms;
     
     
}




?>
