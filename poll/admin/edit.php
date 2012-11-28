<?php


$val=0;
	$query = cms_query("SELECT * FROM poll WHERE pollid=$pollid");
		
		while($row = mysql_fetch_array($query))
		{
			$question = $row['question'];
		}		
		
		$query = cms_query("SELECT * FROM poll_answers WHERE pollid='$pollid' ORDER BY answerid ASC");

		while($therow = mysql_fetch_array($query))
		{
			$answerid = $therow['answerid'];
			$answer = $therow['answers'];
			$answerarray[] = $answerid."_".$answer;
		}
		$counter=1;

		$contenido ="<div align=center class=\"textos\">
						<b>$question</b><br></div>
						<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                          <tr>
                            <td align=\"center\" class=\"textos\">&nbsp;</td>
                          </tr>
                        </table>
						<table width=300 border=0 cellspacing=0 cellpadding=2 align=\"center\">";

		foreach ( $answerarray as $val )
		{
			$data = explode("_", $val);
	
			$answerid = $data[0];
			$answer = $data[1];

		$contenido .="<tr>
		<td class=\"textos\">
		Respuesta&nbsp;".$counter.":
		</td>
		<td class=\"textos\">
		<input class=\"textos\" name='answerarray[]' type='text' value='".$answer."'>
		</td>
		<td class=\"textos\" aling=\"center\">
		<input name='deletebox' type='radio' value='".$answerid."' checked>
		</td></tr>
		<input name='ansid[]' type='hidden' value='".$answerid."'>";

		$counter++;
		}
		
		//include("lib/cuadro_perfiles.php");
		
		
		
		 
		$contenido .="<tr><td align=\"center\" class=\"textos\" colspan=3>&nbsp; </td></tr>
		<tr><td align=\"center\" class=\"textos\" colspan=3>$cuadro_perfiles_colegios</td></tr>
		<tr><td align=\"center\" class=\"textos\" colspan=3>&nbsp; </td></tr>
		<tr><td colspan=2>
					<input class=\"boton\"   name=\"modify\" type=submit value='Cambiar'></td>
					<td >
					<input class=\"boton\"   name=deleteanswer type=submit value=Delete></td></tr>
					<tr><td colspan=3>&nbsp;</td></tr>
					<tr><td colspan=2 >
					<input class=\"textos\"   name=addanswertext type=text></td>
					<td >
					<input class=\"boton\"   name=addanswer type=submit value='Add Opción'></td></tr>
        			</table>
					<div align=center>
					<br><input class=\"boton\"   name='deleteno' type='submit' value='Cancelar'>
					</div><input name='pollid' type='hidden' value='".$pollid."'>";
	
	

?>