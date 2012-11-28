<?php
$sql_tc = "select distinct tabla from tab_busqueda";
$result = cms_query($sql_tc) or die("$MSG_DIE - No Resulto $sql_tc");
array ($tbl_check);

$i=0;
while (list($tabla) = mysql_fetch_row($result))
{
	$tbl_check[$i] = $tabla;
	$i++;
}

$tables = mysql_list_tables( $DATABASE );
$contenido = 
	'
		<table width="100%" border="0">
			<tr>
				<td align="left" width="200" class=\"textos\"><b>Tabla</b></td>
				<td align="center" width="15"><b>Check</b></td>
				<td>&nbsp;</td>
			</tr>
		';
	
while( $line = mysql_fetch_row( $tables ) )
{
	$contenido .= '
			<tr>
				<td align="left" width="200" >'.$line[0].'</td>
				<td align="center" width="15"><input name="tabla[]" type="checkbox" value="'.$line[0].'"'; 
				
		for($i = 0; $i < sizeof($tbl_check); $i++)
		{
			if ($tbl_check[$i] == $line[0]) 
			{
				$contenido .= ' checked ';
			}
		}			
				
		$contenido .= '/></td>
		<td>&nbsp;</td>
		</tr>';
		
}
$contenido .= '
		</table>
		<br />
		<input name="btnvolver" type="submit" value="Volver >>" />
		<input name="volver" type="hidden" value="volver" />
';	


?>