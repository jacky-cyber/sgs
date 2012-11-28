<?php

$accion_form = "index.php?accion=$accion";

$contenido .= "<table width=\"90%\" border='0' align='center' cellpadding='5' cellspacing='0' >";

$contenido .= "<tr><td >";
//$contenido .= "<form name='polladminform' method='post'>";

$contenido .= "<table witch=\"100%\" border='0' align='center' cellpadding='2' cellspacing='0' class=\"cuadro\">
				<tr >
				<td colspan='4' align='center' class=\"cabeza_rojo\">
				<strong> <font color=\"#ffffff\">Agregar Encuesta</font></strong>
				</td>
				</tr>
				<tr >
				<td align='center' class=\"textos\" colspan='2'>
				<strong>Pregunta</strong>:
				</td>
				<td class=\"textos\" colspan='2'> 
				<input class=\"textos\" name='newquestion' type='text'>
				</td>
				</tr>";


$pollquery = cms_query("SELECT * FROM poll");
for($counter=1;$counter<11;$counter++)
{
	$contenido .= "<tr >
			<td class=\"textos\" colspan='2'> 
			Respuesta ".$counter.":
			</td>
			<td class=\"textos\" colspan='2'> 
			<input class=\"textos\" name='answer".$counter."' type='text'>
			</td></tr>";
}
// Add new poll button
$contenido .= "<tr><td align=\"center\" class=\"textos\" colspan='4'>$cuadro_perfiles_colegios </td></tr>
<tr >
				
				<td class=\"textos\" colspan=\"4\" align=\"center\">
				<input class=\"boton\" name='addpoll' type='submit' value='Agregar'>			
				</td></tr>
				<td class=\"textos\" colspan=\"4\" align=\"center\">
				&nbsp;		
				</td></tr></table>
				<br><br>
				<table witch=\"90%\" border=0 align='center' cellpadding=2 cellspacing=0 class=\"cuadro\">
				<tr class=\"cabeza_rojo\" bgcolor='#336699'>
				<td colspan='4'align='center'>
				<font size='2' color=\"#ffffff\">
				Borrar/Editar/Encuesta Activa						
				</font></td></tr>";
// Edit Title first screen

	while($pollrow = mysql_fetch_array($pollquery))
	{
    	$contenido .= "<tr bgcolor='ffffff'>";
		$contenido .= "<td class=\"textos\" align=\"left\">";
		$contenido .= $pollrow['question'];
		$contenido .= "</td>";
		$contenido .= "<td bgcolor='ffffff' class=\"textos\">";
		$contenido .= "Borrar&nbsp;";
		$contenido .= "<input class=\"textos\" name='dopoll' type='radio' value='".$pollrow['pollid']."_delete'>";	// Delete radiobutton
		$contenido .= "</td>";
		$contenido .= "<td bgcolor='ffffff' class=\"textos\"> ";
		$contenido .= "Editar&nbsp;";
		$contenido .= "<input class=\"textos\" type='radio' name='dopoll' value='".$pollrow['pollid']."_edit'>";		// Edit radiobutton
		$contenido .= "</td>";
		$contenido .= "<td bgcolor='ffffff' class=\"textos\">";

	if($pollrow['active']=='yes')
	     {
		$contenido .= "<center><strong><b>Activa!</b></strong></center>";
	     }
	else
	    {
		$contenido .= "<font size='1' color=\"#000000\">Activate&nbsp;";
		$contenido .= "<input class=\"textos\"type='radio' name='dopoll' value='".$pollrow['pollid']."_activate'></font>";	// Activate Radio button
	     }
		$contenido .= "</td></tr>";
	}
		$contenido .= " 
		<tr bgcolor='ffffff'>";
		$contenido .= "<td colspan='4'><div align='center'>
		               <font size='1' face='Verdana, Arial, Helvetica, sans-serif'>";
		$contenido .= "<br><input class=\"boton\" name='doit' type='submit' value='Aceptar' ><br>";			// Submit Button
		$contenido .= "</font></div></td>
							</tr></table>";
		
$contenido .= "</td></tr></table>";



 

?>