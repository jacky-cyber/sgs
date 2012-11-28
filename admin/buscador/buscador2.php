<?php


		 


$tables = mysql_list_tables( $DATABASE );
$contenido = 
	'
		<table width="100%" border="0">
			<tr>
				<td align="left" width="200"><b>Tabla</b></td>
				<td align="center" width="15"><b>Check</b></td>
				<td>&nbsp;</td>
			</tr>
		';
while( $line = mysql_fetch_row( $tables ) )
{




	$contenido .= '
			<tr>
				<td align="left" width="200" >'.$line[0].'</td>
				<td align="center" width="15">'; 
				
		for($i = 0; $i < sizeof($tbl_check); $i++)
		{
			if ($tbl_check[$i] == $line[0]) 
			{
				$contenido .= " <input type=\"checkbox\" name=\"".$line[0]."\" value=\"checkbox\"> ".$line[0];
			}
		}			
				
	$contenido .= '</td>
				<td>&nbsp;</td>
			</tr>
			';

}


?>