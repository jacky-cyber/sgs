<?php
//class=\"banner_home\"
/*
*/
$tabla.="<style>
.api_titulo{
font-size: 1.5em;
    margin-bottom: 10px;
    margin-top: 20px;
    color: #2571B7;
    font-weight: normal;
}
</style>	
";

$tabla.="<table cellpadding=\"0\" id=\"listado2\" cellspacing=\"0\" width=\"100%\">";
$tabla.="<tr>";
$tabla.="<th class=\"alt\">Nombre App</th><th class=\"alt\">Fecha Creaci&oacute;n</th><th class=\"alt\">Token</th><th class=\"alt\">Ping</th><th class=\"alt\">Editar</th>";	
$tabla.="</tr>";
$tabla.="<tr>";
$tabla.="<td style=\"background-color:#fff;\">asds</td><td style=\"background-color:#fff;\">asds</td><td style=\"background-color:#fff;\">asds</td><td style=\"background-color:#fff;\">asds</td><td style=\"background-color:#fff;\">asds</td>";	
$tabla.="</tr>";
$tabla.="</table>";
//style=\"border-top:1px solid #D9D9D9;background-color:#fff;\"
//<img height=\"42\" width=\"44\" src=\"sgs/css/../images/home/preferencias.png\" border=\"0\" />
	$div.="
	<br />
	<h2>Mis Apps</h2>
	<div  class=\"banner_home\">";
		$div.="
		<div>$tabla</div>";
	$div.="</div>";
$contenido=$div;

?>