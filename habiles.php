<?php
include("lib/connect_db.inc.php");    

$anio = $_GET['anio'];



    $query= "SELECT no_habil
           FROM no_habil";
	$data = array();	   
    $result= mysql_query($query)or die (error($query,mysql_error(),$php));
    while (list($no_habil) = mysql_fetch_row($result)){
		$data[] = $no_habil;
					
	}
	exit(json_encode(array("fechas_no_habil"=>$data)));




?>