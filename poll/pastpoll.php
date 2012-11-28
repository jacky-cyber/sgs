<?php
/***************************************************************************
			MP Poll
			Morgan Andersson @ Morgande Produsctions (www.morgande.com)
			Free to use, a link to www.morgande.com must be present.
***************************************************************************/
//include "admin/pollconfig.php";



$contenido.= "
<br><table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
  <tr>
    <td align=\"center\" class=\"cabeza_rojo\" >Lista de Encuestas Realizadas</td>
  </tr>
  
  <tr>
    <td class=\"textos\" align=\"center\" height=\"5\" bgcolor=\"#f8f8f8\"></td>
  </tr>
  <tr>
    <td class=\"textos\" align=\"center\" >

<table class=\"textos\" width=\"100%\"  border='0' cellspacing='1' cellpadding='0'>";




	$pollquery = cms_query("SELECT * FROM poll");
	
	while($pollrow = mysql_fetch_array($pollquery))
	{
	      
	$contenido .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#f8f8f8\">
	<td align=\"left\" class=\"textos\">&nbsp;". $pollrow['question']."</td><td align=\"left\" class=\"textos\">
	<a href=index.php?accion=$accion&act=2&pollid=".$pollrow['pollid'].">
	<img src=\"images/lupa.gif\" alt=\"\" border=\"0\"></a><br>";
    }
	
$contenido .= "</table></td>
  </tr>
  
  
</table>";
?>