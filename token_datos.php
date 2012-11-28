<?php

	include("lib/connect_db.inc.php");
	include("lib/lib.inc.php");  
	include("lib/lib.inc2.php"); 


	if($id==""){
		$id=$_GET['id'];
	}
	
		
	$query = "SELECT token_app
			FROM app_desarrollo
			WHERE id = '$id'";
	$result = cms_query($query)or die(mysql_error());
	list($token_app) = mysql_fetch_row($result);
	
	
	if($sa==""){
		$sa=$_GET['sa'];
	}
	$query = "SELECT sgs.folio, u.paterno
			FROM sgs_solicitud_acceso sgs, usuario u
			WHERE sgs.id_usuario = u.id_usuario
			AND sgs.id_solicitud_acceso = '$sa'";
	$result = cms_query($query)or die(mysql_error());
	list($folio,$a_paterno) = mysql_fetch_row($result);
	$json = json_encode(array("Token" => $token_app,"Folio" => $folio, "apellidos_Beneficiario" => $a_paterno));
    $html ="<html>
 <head>
 <title></title>
 <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
 </head>
 
 <body bgcolor=\"#FFFFFF\" text=\"#000000\">
<form action=\"http://sgs.probidadytransparencia.gob.cl/bkp_101/sgs1.3/token_login.php\" method=\"post\" enctype=\"multipart/form-data\" name=\"form1\" accept-charset=\"UTF-8\">

<br>   <textarea name=\"json\"  id=\"json\" cols=\"60\" rows=\"10\" class=\"textos\">
$json
</textarea><br>
<input type=\"submit\" name=\"Submit\" value=\"Enviar\">
    
</form>
 </body>
 </html>";

echo $html;






















?>